<?php

namespace App\Http\Controllers;

use App\Models\{StockMovementApproverAssignment, User};

class ApprovalController extends Controller
{
    public function index()
    {
        abort_unless(auth()->user()?->role?->role === 'admin', 403);
        $assignments = StockMovementApproverAssignment::with('user')->orderBy('approver_slot')->get();
        $users = User::orderBy('last_name')->orderBy('first_name')->get();
        return view('pages.maintenance.stock-approvers.index', compact('assignments', 'users'));
    }
}
