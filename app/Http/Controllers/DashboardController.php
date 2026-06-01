<?php

namespace App\Http\Controllers;

use App\Models\EmployeeSearch;
use App\Models\CarenderiaItem;
use App\Models\LoanItem;
use App\Models\GroceryItem;
use App\Models\PaymentItem;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // 1. Get Grand Totals for Summary Cards
        // Using cache or standard queries (Indexes on the tables keep this fast!)
        $stats = [
            'carenderia' => CarenderiaItem::sum('total'),
            'loans'      => LoanItem::sum('total'),
            'grocery'    => GroceryItem::sum('total'),
            'payments'   => PaymentItem::sum('total'),
        ];

        // 2. Handle Search Query against the DB View
        $search = $request->input('search');

        $results = EmployeeSearch::with('employee')
            ->when($search, function ($query) use ($search) {
                $query->whereHas('employee', function ($q) use ($search) {
                    $q->where('employee_code', 'LIKE', "%{$search}%")
                      ->orWhere('name', 'LIKE', "%{$search}%");
                });
            })
            ->latest('date')
            ->take(50) // Limit to top 50 results for rapid UI rendering
            ->get();

        return view('pages.dashboard', compact('stats', 'results', 'search'));
    }
}