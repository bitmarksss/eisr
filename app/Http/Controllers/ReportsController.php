<?php

namespace App\Http\Controllers;

use App\Models\{
    ActivityLog, 
};

use Illuminate\Http\Request;

class ReportsController extends Controller
{
    
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
