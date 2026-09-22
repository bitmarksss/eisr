@extends('layouts.app')

@section('page-title', 'Supplier Management')
@section('sidebar') @include('components.sidebar') @endsection

@section('content')
<div class="space-y-6">
    @if(session('success'))
        <div class="bg-green-100 border border-brand-green/30 text-brand-green p-4 rounded-xl text-sm font-semibold flex items-center shadow-xs">
            <span class="mr-2">✓</span> {{ session('success') }}
        </div>
    @endif
    @if($errors->any())
        <div class="bg-red-100 border border-red-300 text-red-600 p-4 rounded-xl text-sm font-semibold shadow-xs">
            <div class="mb-2">
                Invalid data submitted, please check the errors and try again.
            </div>
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
        <div class="p-6 flex items-center justify-between border-b border-gray-100">
            <div>
                <h2 class="text-xl font-bold text-brand-navy">Suppliers</h2>
                <p class="text-sm text-gray-500 mt-1">Manage inventory suppliers.</p>
            </div>
            <a href="{{ route('maintenance.supplier.create') }}" class="px-4 py-2 bg-brand-gold hover:bg-brand-gold-hover text-white rounded-lg font-semibold text-sm">
                <i class="fa-solid fa-plus mr-2"></i>Add Supplier
            </a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-gray-50 text-xs font-bold text-brand-navy uppercase">
                    <tr>
                        <th class="px-6 py-4">Name</th>
                        <th class="px-6 py-4">Items</th>
                        <th class="px-6 py-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-sm">
                    @forelse($suppliers as $supplier)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 font-semibold">{{ $supplier->name }}</td>
                            <td class="px-6 py-4 text-gray-500">{{ $supplier->items_count }}</td>
                            <td class="px-6 py-4 text-right">
                                <x-tooltip text="Edit"
                                    bg_color="bg brand navy"
                                    text_color="text-white"
                                >
                                    <a href="{{ route('maintenance.supplier.edit', $supplier) }}" 
                                        class="rounded-lg bg-amber-500 py-2 px-2.5 text-white hover:underline text-xs font-bold cursor-pointer">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>

                                </x-tooltip>
                            </td>
                        </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="px-6 py-12 text-center text-gray-400">No suppliers found.</td>
                    </tr>@endforelse
                </tbody>
            </table>
        </div>
        @if($suppliers->hasPages())
            <div class="p-4 bg-gray-50 border-t border-gray-100">
                {{ $suppliers->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
