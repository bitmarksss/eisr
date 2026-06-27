@extends('layouts.app')

@section('page-title', 'Warehouse Inventory Matrix')

@section('sidebar')
    @include('components.sidebar')
@endsection

@section('modals')
    @include('components.backdrop')
    @include('components.edit-inventory-modal')
@endsection

@section('content')
<div class="space-y-6">

    <!-- Flash Messages -->
    @if(session('success'))
        <div class="bg-green-100 border border-brand-green/30 text-brand-green p-4 rounded-xl text-sm font-semibold flex items-center shadow-xs">
            <span class="mr-2">✓</span> {{ session('success') }}
        </div>
    @endif

    <!-- Control Matrix Panel -->
    <div class="bg-white p-4 rounded-xl border border-gray-200 shadow-sm flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        
        <!-- Search and Filters -->
        <form method="GET" action="{{ route('inventory.index') }}" class="flex flex-wrap items-center gap-3 flex-1 w-full">
            <div class="relative min-w-[280px] flex-1 max-w-md">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by name, SKU, or category..." 
                    class="w-full bg-gray-50 border border-gray-300 text-brand-dark text-sm rounded-lg pl-3 pr-10 py-2 focus:border-brand-gold focus:outline-none focus:ring-2 focus:ring-brand-gold/20 transition">
            </div>

            <select name="category_filter" onchange="this.form.submit()" 
                class="bg-gray-50 border border-gray-300 text-brand-dark text-sm rounded-lg p-2 focus:outline-none focus:border-brand-gold">
                <option value="" {{ request('category_filter') == '' ? 'selected' : '' }}>
                    All Categories
                </option>
                @foreach($categories as $category)
                    <option value="{{$category->category}}" {{ request('category_filter') == $category->category ? 'selected' : '' }}>{{ $category->category }}</option>
                @endforeach
            </select>
        </form>

        <!-- Access Guard Button Triggering our plain JS Modal -->
        @if(auth()->user()?->is_admin)
            <button onclick="openModal()" 
                class="bg-brand-gold hover:bg-brand-gold-hover text-white font-bold px-5 py-2.5 rounded-lg shadow-sm text-sm transition text-center whitespace-nowrap cursor-pointer">
                + Catalog New Item
            </button>
        @endif
    </div>

    <!-- Inventory Model Table Structure -->
    <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 text-xs font-bold text-brand-navy uppercase tracking-wider border-b border-gray-200">
                        <th class="px-6 py-4">SKU Code</th>
                        <th class="px-6 py-4">Item Name</th>
                        <th class="px-6 py-4">Category</th>
                        <th class="px-6 py-4">Available Quantity</th>
                        <th class="px-6 py-4">Status Flag</th>
                        @if(auth()->user()?->role->role == 'admin')
                            <th class="px-6 py-4 text-right">Actions</th>
                        @endif
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-sm text-gray-700">
                    
                    @forelse($inventory_items as $item)
                        <tr class="hover:bg-gray-50/50 transition">
                            <!-- SKU Column -->
                            <td class="px-6 py-4 font-mono text-xs font-semibold text-brand-navy">
                                <span class="bg-brand-navy/5 text-brand-navy px-2 py-1 rounded">
                                    {{ $item->sku }}
                                </span>
                            </td>

                            <!-- Name Column -->
                            <td class="px-6 py-4 font-semibold text-brand-dark">
                                {{ $item->name }}
                            </td>

                            <!-- Category Column -->
                            <td class="px-6 py-4">
                                <span class="px-2.5 py-0.5 bg-slate-100 text-slate-700 text-xs font-medium rounded-md border border-slate-200">
                                    {{ $item->category ?? 'Unassigned' }}
                                </span>
                            </td>

                            <!-- Quantity Column -->
                            <td class="px-6 py-4 font-bold">
                                <span class="{{ $item->quantity <= 10 ? 'text-brand-gold' : ($item->quantity == 0 ? 'text-red-600' : 'text-brand-dark') }}">
                                    {{ number_format($item->quantity) }} Units
                                </span>
                            </td>

                            <!-- Status Badge Logic based on Quantity Field -->
                            <td class="px-6 py-4">
                                @if($item->quantity == 0)
                                    <span class="px-2.5 py-1 bg-red-100 text-red-700 border border-red-200 font-bold text-xs rounded-full">Out of Stock</span>
                                @elseif($item->quantity <= 10)
                                    <span class="px-2.5 py-1 bg-amber-50 text-brand-gold border border-brand-gold/20 font-bold text-xs rounded-full">Low Stock</span>
                                @else
                                    <span class="px-2.5 py-1 bg-green-50 text-brand-green border border-brand-green/20 font-bold text-xs rounded-full">In Stock</span>
                                @endif
                            </td>

                            <!-- Protected Actions Triggering adjustments -->
                            @if(auth()->user()?->role->role == 'admin')
                                <td class="px-6 py-4 text-right whitespace-nowrap">
                                    <!-- We populate the JS modal fields directly using custom data attributes -->
                                    <button onclick="openEditInventoryModal('{{ $item->id }}', '{{ $item->sku }}', '{{ addslashes($item->name) }}', '{{ $item->category }}', '{{ $item->quantity }}')" 
                                       class="text-brand-gold hover:underline text-xs font-bold cursor-pointer">
                                        Edit
                                    </button>
                                </td>
                            @endif
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-gray-400 font-medium">
                                No warehouse products matched the search query parameters.
                            </td>
                        </tr>
                    @endforelse

                </tbody>
            </table>
        </div>

        <!-- Pagination Blocks -->
        @if(method_exists($inventory_items, 'hasPages') && $inventoryItems->hasPages())
            <div class="p-4 bg-gray-50 border-t border-gray-100">
                {{ $inventory_items->appends(request()->query())->links() }}
            </div>
        @endif
    </div>

</div>
@endsection