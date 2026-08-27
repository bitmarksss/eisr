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
    private const MONTHS = [
        1 => 'January',
        2 => 'February',
        3 => 'March',
        4 => 'April',
        5 => 'May',
        6 => 'June',
        7 => 'July',
        8 => 'August',
        9 => 'September',
        10 => 'October',
        11 => 'November',
        12 => 'December',
    ];
    private const VIEWS_PMC_TIGERWAY = [
        'consumption' => [
            'surface' => 'pages.reports.pmc-tigerway.surface-consumption',
            'underground' =>  'pages.reports.pmc-tigerway.underground-consumption',
            'tigerway' => 'pages.reports.pmc-tigerway.tigerway-consumption'
        ],

        'rcsu' => [
            'pmc' => 'pages.reports.pmc-tigerway.pmc-rcsu',
            'tigerway' => 'pages.reports.pmc-tigerway.tigerway-rcsu'
        ]
    ];
    private const VIEWS_MILL_MCD = [
        'daily' => 'pages.reports.mill-mcd.weekly-daily',
        'weekly' => 'pages.reports.mill-mcd.weekly'
    ];
    private const VIEWS_PNP = [
        'pmc' => 'pages.reports.pnp.blaster-pmc',
        'tigerway' => 'pages.reports.pnp.blaster-tigerway'
    ];
    private const VIEWS_MGB = [
        'daily' => 'pages.reports.mgb.daily',
        'br' => 'pages.reports.mgb.br',
        'fy' => 'pages.reports.mgb.fy',
        'explosive' => 'pages.reports.mgb.explosive'
    ];
    private const VIEWS_EXPLOSIVES = [
        'daily' => 'pages.reports.explosives.daily',
        'costing' => 'pages.reports.explosives.costing',
        'monthly' => 'pages.reports.explosives.monthly',
        'comparative' => 'pages.reports.explosives.comparative',
        'deliveries' => 'pages.reports.explosives.deliveries',

        'usage' => 'pages.reports.explosives.usage'
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

        return view('pages.reports.index', [
            'report_type' => $report_type,
            'type' => $selectedTypeId,
            'types' => $types,
            'items' => $items,
            'months' => self::MONTHS
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

        $selected_items = InventoryStock::query()

            // Search Filter
            ->when($filterInputs['search'], function ($query) use ($filterInputs) {
                $query->where('item.name', 'LIKE', '%'. $filterInputs['search'] .'%');
            })
            
            // Item Filter
            ->when($filterInputs['item'], function ($query) use ($filterInputs) {
                $query->where('item_id', $filterInputs['item']);
            })

            ->with(['item.kind'])
            ->limit(5)
            ->get();

        
        $items = InventoryItem::select('id', 'name')->get();
        $categories = InventoryKind::get();
        return view('pages.reports.pmc-tigerway.surface-consumption', [
            'items' => $items,
            'categories' => $categories,
            'selectedItems' => $selected_items
        ]);
    }

    public function underground(Request $request) {
         $filterInputs = [
            'search' => $request->input('search'),
            'item' => $request->input('item'),
            'kind' => $request->input('kind'),
        ];

        $selected_items = InventoryStock::query()

            // Search Filter
            ->when($filterInputs['search'], function ($query) use ($filterInputs) {
                $query->where('item.name', 'LIKE', '%'. $filterInputs['search'] .'%');
            })
            
            // Item Filter
            ->when($filterInputs['item'], function ($query) use ($filterInputs) {
                $query->where('item_id', $filterInputs['item']);
            })

            ->with(['item.kind'])
            ->limit(5)
            ->get();

        $items = InventoryItem::select('id', 'name')->get();
        $categories = InventoryKind::get();

        return view('pages.reports.pmc-tigerway.underground-consumption', [
            'items' => $items,
            'categories' => $categories,
            'selectedItems' => $selected_items
        ]);
    }

    public function weekly_consumption(Request $request) {
        $filterInputs = [
            'search' => $request->input('search'),
            'item' => $request->input('item'),
            'kind' => $request->input('kind'),
            'location' => $request->input('location')
        ];

        $selected_items = InventoryStock::query()

            // Search Filter
            ->when($filterInputs['search'], function ($query) use ($filterInputs) {
                $query->where('item.name', 'LIKE', '%'. $filterInputs['search'] .'%');
            })
            
            // Item Filter
            ->when($filterInputs['item'], function ($query) use ($filterInputs) {
                $query->where('item_id', $filterInputs['item']);
            })

            ->with(['item.kind'])
            ->limit(5)
            ->get();

        $items = InventoryItem::select('id', 'name')->get();
        $categories = InventoryKind::get();

        // $view = self::VIEWS_PMC_TIGERWAY['consumption'][$type];
        $view = 'pages.reports.pmc-tigerway.consumption';
        return view($view, [
            'type' => 'consumption',
            'items' => $items,
            'categories' => $categories,
            'selectedItems' => $selected_items,
            'location' => $filterInputs['location']
        ]);
    }
    public function weekly_rcsu(Request $request) {
        $filterInputs = [
            'search' => $request->input('search'),
            'item' => $request->input('item'),
            'kind' => $request->input('kind'),
            'location' => $request->input('location')
        ];

        $selected_items = InventoryStock::query()

            // Search Filter
            ->when($filterInputs['search'], function ($query) use ($filterInputs) {
                $query->where('item.name', 'LIKE', '%'. $filterInputs['search'] .'%');
            })
            
            // Item Filter
            ->when($filterInputs['item'], function ($query) use ($filterInputs) {
                $query->where('item_id', $filterInputs['item']);
            })

            ->with(['item.kind'])
            ->limit(5)
            ->get();

        $items = InventoryItem::select('id', 'name')->get();
        $categories = InventoryKind::get();

        $view = 'pages.reports.pmc-tigerway.rcsu';
        // $view = self::VIEWS_PMC_TIGERWAY['rcsu'][$type];
        return view($view,[
            'type' => 'rcsu',
            'items' => $items,
            'categories' => $categories,
            'selectedItems' => $selected_items,
            'location' => $filterInputs['location']
        ]);
    }

    public function weekly_mill_mcd(Request $request, String $type) {
        $filterInputs = [
            'search' => $request->input('search'),
            'item' => $request->input('item'),
            'kind' => $request->input('kind'),
            'type' => $request->input('type')
        ];

        $selected_items = InventoryStock::query()

            // Search Filter
            ->when($filterInputs['search'], function ($query) use ($filterInputs) {
                $query->where('item.name', 'LIKE', '%'. $filterInputs['search'] .'%');
            })
            
            // Item Filter
            ->when($filterInputs['item'], function ($query) use ($filterInputs) {
                $query->where('item_id', $filterInputs['item']);
            })

            ->with(['item.kind'])
            ->limit(5)
            ->get();

        $items = InventoryItem::select('id', 'name')->get();
        $categories = InventoryKind::get();

        // $view = self::VIEWS_MILL_MCD[$type];
        $view = 'pages.reports.mill-mcd.index';
        return view($view, [
            'items' => $items,
            'categories' => $categories,
            'selectedItems' => $selected_items,
            'type' => $filterInputs['type'] ?? 'daily'
        ]);
    }

    public function blaster(Request $request) {
        $filterInputs = [
            'start' => $request->input('start_date'),
            'end' => $request->input('end_date'),
            'kind' => $request->input('kind'),
            'location' => $request->input('location') ?? 'pmc',
        ];

        // $view = self::VIEWS_PNP[$type];
        $view = 'pages.reports.pnp.index';
        return view($view, [
            'location' => $filterInputs['location']
        ]);
    }

    public function mgb(Request $request) {
        $filterInputs = [
            'search' => $request->input('search'),
            'item' => $request->input('item'),
            'kind' => $request->input('kind'),
            'type' => $request->input('type')
        ];

        $view = 'pages.reports.mgb.index';
        return view($view, [
            'type' => $filterInputs['type'], 
            'months' => self::MONTHS,
        ]);
    }

    public function explosives(Request $request, String $type) {
        $filterInputs = [
            'search' => $request->input('search'),
            'item' => $request->input('item'),
            'kind' => $request->input('kind'),
        ];

        $selected_items = InventoryStock::query()

            // Search Filter
            ->when($filterInputs['search'], function ($query) use ($filterInputs) {
                $query->where('item.name', 'LIKE', '%'. $filterInputs['search'] .'%');
            })
            
            // Item Filter
            ->when($filterInputs['item'], function ($query) use ($filterInputs) {
                $query->where('item_id', $filterInputs['item']);
            })

            ->with(['item.kind'])
            ->limit(5)
            ->get();

        $items = InventoryItem::select('id', 'name')->get();
        $categories = InventoryKind::get();

        $view = self::VIEWS_EXPLOSIVES[$type];
        return view($view, [
            'type' => $type, 
            'items' => $items,
            'categories' => $categories,
            'selectedItems' => $selected_items,
            'months' => self::MONTHS,
        ]);
    }

    public function explo_usage(Request $request) 
    {
        $filterInputs = [
            'search' => $request->input('search'),
            'item' => $request->input('item'),
            'kind' => $request->input('kind'),
        ];

        $selected_items = InventoryStock::query()

            // Search Filter
            ->when($filterInputs['search'], function ($query) use ($filterInputs) {
                $query->where('item.name', 'LIKE', '%'. $filterInputs['search'] .'%');
            })
            
            // Item Filter
            ->when($filterInputs['item'], function ($query) use ($filterInputs) {
                $query->where('item_id', $filterInputs['item']);
            })

            ->with(['item.kind'])
            ->limit(5)
            ->get();

        $items = InventoryItem::select('id', 'name')->get();
        $categories = InventoryKind::get();

        return view('pages.reports.explosives.usage', [
            'items' => $items,
            'categories' => $categories,
            'selectedItems' => $selected_items,
            'months' => self::MONTHS,
        ]);
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
