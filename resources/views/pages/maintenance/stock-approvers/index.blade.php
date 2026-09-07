@extends('layouts.app')

@section('page-title', 'Stock Movement Approvers')
@section('sidebar') @include('components.sidebar') @endsection
@section('content')
<div class="max-w-3xl space-y-6">
    @if(session('success'))<div class="bg-green-100 text-green-700 p-4 rounded-lg">{{ session('success') }}</div>@endif
    @if($errors->any())<div class="bg-red-100 text-red-700 p-4 rounded-lg">{{ $errors->first() }}</div>@endif
    <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-6">
        <h2 class="text-xl font-bold text-brand-navy">Stock Movement Approvers</h2>
        <p class="text-sm text-gray-500 mt-1">Assign five distinct users. Approval is completed only after all five assigned users approve.</p>
        <form method="POST" action="{{ route('maintenance.stock-approvers.update') }}" class="mt-6 space-y-4">
            @csrf @method('PUT')
            @foreach($assignments as $assignment)
            <div class="grid grid-cols-3 gap-3 items-center">
                <label class="font-semibold text-sm">Approver {{ $assignment->approver_slot }}</label>
                <select name="approvers[{{ $assignment->approver_slot - 1 }}]" class="col-span-2 border border-gray-300 rounded-lg p-2" required>
                    <option value="">Select user</option>
                    @foreach($users as $user)
                    <option value="{{ $user->id }}" @selected($assignment->user_id === $user->id)>{{ $user->last_name }}, {{ $user->first_name }} ({{ $user->username }})</option>
                    @endforeach
                </select>
            </div>
            @endforeach
            <button class="px-5 py-2 bg-brand-gold text-white rounded-lg font-bold">Save Approvers</button>
        </form>
    </div>
</div>
@endsection
