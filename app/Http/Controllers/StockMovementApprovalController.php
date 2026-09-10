<?php

namespace App\Http\Controllers;

use App\Models\{StockMovement, StockMovementApproverAssignment, User};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StockMovementApprovalController extends Controller
{
    public function approve(StockMovement $movement)
    {
        abort_unless($movement->status === 'pending_approval', 403, 'This movement is no longer awaiting approval.');
        DB::transaction(function () use ($movement) {
            $assignments = StockMovementApproverAssignment::orderBy('approver_slot')->get();
            $approved = $movement->approvals()->where('status', 'approved')->pluck('user_id');
            $next = $assignments->first(fn ($a) => $a->user_id && !$approved->contains($a->user_id));
            abort_unless($next && $next->user_id === auth()->id(), 403, 'You are not the current approver for this movement.');
            $movement->approvals()->updateOrCreate(['user_id' => $next->user_id], ['approver_slot' => $next->approver_slot, 'status' => 'approved', 'approved_at' => now()]);
            if ($assignments->filter(fn ($a) => $a->user_id && !$approved->contains($a->user_id) && $a->user_id !== auth()->id())->isEmpty()) $movement->update(['status' => 'approved']);
        });
        return back()->with('success', 'Movement approved successfully.');
    }

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
