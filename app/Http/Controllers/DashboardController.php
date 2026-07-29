<?php

namespace App\Http\Controllers;

use App\Models\{
    InventoryItem, 
    InventoryStock,
    Role, 
    User
};
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // 1. Handle Search Query against the DB View
        $search = $request->input('search');

        // $results = EmployeeSearch::with('employee')
        //     ->when($search, function ($query) use ($search) {
        //         $query->whereHas('employee', function ($q) use ($search) {
        //             $q->where('employee_code', 'LIKE', "%{$search}%")
        //               ->orWhere('name', 'LIKE', "%{$search}%");
        //         });
        //     })
        //     ->latest('date')
        //     ->take(50) // Limit to top 50 results for rapid UI rendering
        //     ->get();

        $results = [];
            
        // 2. Get Grand Totals for Summary Cards
        // Using cache or standard queries (Indexes on the tables keep this fast!)
        $stats = [
            'carenderia' => null,
            'loans'      => null,
            'grocery'    => null,
            'payments'   => null,
            'balance'   => null
        ];

        $stats = null;

        // $stats['balance'] = $stats['payments'] - ($stats['loans'] + $stats['carenderia'] + $stats['grocery']);

        $inventory = InventoryStock::with('item')->get();

        $item_count = $inventory->count();
        $low_stock_count = InventoryStock::with('item')->where('quantity', '<', 100)->get()->count();

        return view('pages.dashboard', compact('stats', 'results', 'search', 'inventory', 'item_count', 'low_stock_count'));
    }
}