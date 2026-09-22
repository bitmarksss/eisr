@extends('layouts.app')
@section('page-title', 'Create Supplier')
@section('sidebar') @include('components.sidebar') @endsection
@section('content')
<div class="max-w-2xl bg-white rounded-xl border border-gray-200 shadow-sm p-6">
    <h2 class="text-xl font-bold text-brand-navy">Create Supplier</h2>
    <form method="POST" action="{{ route('maintenance.supplier.store') }}" class="mt-6 space-y-4">@csrf
        <label class="block text-sm font-bold text-brand-dark">Supplier Name<input name="name" value="{{ old('name') }}" required class="mt-1 w-full border border-gray-300 rounded-lg px-3 py-2 @error('name') border-red-500 @enderror">@error('name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror</label>
        <div class="flex justify-end gap-3"><a href="{{ route('maintenance.supplier.index') }}" class="px-4 py-2 text-gray-500">Cancel</a><button class="px-5 py-2 bg-brand-gold text-white rounded-lg font-bold">Save Supplier</button></div>
    </form>
</div>
@endsection
