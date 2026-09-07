<?php

namespace App\Http\Controllers;

use App\Models\{StockMovementApproverAssignment, User};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StockMovementApprovalController extends Controller
{
    public function index()
    {
        abort_unless(auth()->user()?->role?->role === 'admin', 403);
        $assignments = StockMovementApproverAssignment::with('user')->orderBy('approver_slot')->get();
        $users = User::orderBy('last_name')->orderBy('first_name')->get();
        return view('pages.maintenance.stock-approvers.index', compact('assignments', 'users'));
    }

    public function update(Request $request)
    {
        abort_unless(auth()->user()?->role?->role === 'admin', 403);
        $data = $request->validate([
            'approvers' => ['required', 'array', 'size:5'],
            'approvers.*' => ['nullable', 'integer', 'exists:users,id'],
        ]);

        $users = collect($data['approvers'])->filter()->values();
        if ($users->count() !== $users->unique()->count()) {
            return back()->withErrors(['approvers' => 'Each approver slot must have a different user.']);
        }

        DB::transaction(function () use ($data) {
            foreach ($data['approvers'] as $slot => $userId) {
                StockMovementApproverAssignment::where('approver_slot', $slot + 1)
                    ->update(['user_id' => $userId ?: null]);
            }
        });

        return back()->with('success', 'Stock movement approvers updated successfully.');
    }
}
