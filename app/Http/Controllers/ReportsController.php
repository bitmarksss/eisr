<?php

namespace App\Http\Controllers;

use App\Models\{
    ActivityLog, 
    InventoryKind,
    InventoryItem,
    InventoryStock,
    StockMovement
};

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    private const WEEKLY_REPORT_TYPES = [
        1 => 'Surface Consumption',
        2 => 'Underground Consumption',
        3 => 'RCSU Report - PMC-RSU',
        4 => 'Tigerway Weekly Consumption',
        5 => 'RCSU Report - Tigerway',
    ];

    public function index(Request $request) 
    {
        $selectedTypeId = (int) $request->input('type', 1);

        $types = collect(self::WEEKLY_REPORT_TYPES)
            ->map(fn ($name, $id) => (object) [
                'id' => $id,
                'name' => $name,
            ])
            ->values();

        $selectedTypeObj = $types->firstWhere('id', $selectedTypeId) ?? $types->first();
        $report_type = $selectedTypeObj->name; 

        // Eager load stockMovements along with item relations
        $items = InventoryItem::with(['supplier', 'unit'])->limit(5)->get();

        // dd($items);
        return view('pages.reports.index', [
            'report_type' => $report_type,
            'type' => $selectedTypeId,
            'types' => $types,
            'items' => $items,
        ]);
    }

    public function weekly_index(Request $request) 
    {
        $selectedTypeId = (int) $request->input('type', 1);

        $types = collect(self::WEEKLY_REPORT_TYPES)
            ->map(fn ($name, $id) => (object) [
                'id' => $id,
                'name' => $name,
            ])
            ->values();

        $selectedTypeObj = $types->firstWhere('id', $selectedTypeId) ?? $types->first();
        $report_type = $selectedTypeObj->name; 

        // Eager load stockMovements along with item relations
        $items = InventoryItem::with(['supplier', 'unit'])->limit(5)->get();

        // dd($items);
        return view('pages.reports.weekly.index', [
            'report_type' => $report_type,
            'type' => $selectedTypeId,
            'types' => $types,
            'items' => $items,
        ]);
    }

    public function surface(Request $request) 
    {
        $filterInputs = [
            'search' => $request->input('search'),
            'item' => $request->input('item'),
            'kind' => $request->input('kind'),
        ];

        $selected_item = InventoryStock::query()

            // Search Filter
            ->when($filterInputs['search'], function ($query) use ($filterInputs) {
                $query->where('item.name', 'LIKE', '%'. $filterInputs['search'] .'%');
            })
            
            // Item Filter
            ->when($filterInputs['item'], function ($query) use ($filterInputs) {
                $query->where('item_id', $filterInputs['item']);
            })

            ->with(['item'])
            ->first();

        // dd($filterInputs, $selected_item);
        
        $items = InventoryItem::select('id', 'name')->get();
        $categories = InventoryKind::get();
        return view('pages.reports.pmc-tigerway.surface-consumption', [
            'items' => $items,
            'categories' => $categories,
            'selectedItem' => $selected_item
        ]);
    }

    public function underground(Request $request) {
        
        return view('pages.reports.pmc-tigerway.underground-consumption');
    }
    
    public function movement_data(Request $request)
    {
        $query = StockMovement::with([
            'user', 
            'items.item.unit', 
            'items.destinationLevel'
        ])
            ->withCount('items')
            ->latest();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('reference_no', 'like', "%{$search}%")
                ->orWhere('notes', 'like', "%{$search}%");
        }

        if ($request->filled('type_filter')) {
            $query->where('type', $request->type_filter);
        }

        // dd($query->first());

        $movements = $query->paginate(15);

        return view('pages.reports.movement-data', compact('movements'));
    }
    
    public function logs(Request $request)
    {
        $location = $request->segment(1) ?? null; // Default to 'empty' if not provided

        // 1. Start with base query scoped tightly to our target model type
        $query = ActivityLog::with('user')
            // ->where('auditable_type', InventoryStock::class)
            ->latest('id'); // Order by newest logs first

        // 2. Filter by specific action (created, updated, deleted) if provided
        if ($request->filled('action_filter')) {
            $query->where('action', $request->action_filter);
        }

        // 3. Search filter handling (Checks user names, actions, or specific record IDs)
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            
            $query->where(function ($q) use ($searchTerm) {
                $q->where('action', 'like', "%{$searchTerm}%")
                  ->orWhere('auditable_id', $searchTerm) // Exact numeric match for stock IDs
                  ->orWhere('ip_address', 'like', "%{$searchTerm}%")
                  ->orWhereHas('user', function ($userQuery) use ($searchTerm) {
                      $userQuery->where('name', 'like', "%{$searchTerm}%");
                  });
            });
        }

        // 4. Paginate results while preserving current query parameters
        $logs = $query->paginate(15)->withQueryString();

        // 5. Return the view with the required variables
        return view('pages.stock.logs', [
            'logs'     => $logs,
            'location' => $location,
        ]);
    }

    
}
