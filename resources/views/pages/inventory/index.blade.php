@extends('layouts.app')

@section('page-title', ucfirst($location) . " Inventory")

@section('sidebar')
    @include('components.sidebar')
@endsection

@section('modals')
    @include('components.backdrop')
    @include('components.add-inventory-modal')
    @include('components.edit-inventory-modal')

    @if(request()->routeIs('underground.inventory.*'))
        @include('components.inventory.update-and-record-modal')
    @endif
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
        
        
        <div class="flex flex-wrap items-center justify-between w-full">
            <!-- Search and Filters -->
            <form method="GET" action="{{ route('surface.inventory.index') }}" class="flex flex-wrap items-center gap-3 flex-1 w-full">
                <div class="flex w-90">
                    <div class="relative min-w-70 flex-1 max-w-md">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by name, item code, or category..." 
                            class="w-full bg-gray-50 border border-gray-300 text-brand-dark text-sm rounded-tl-lg rounded-bl-lg pl-3 pr-10 py-2 focus:border-brand-gold focus:outline-none focus:ring-2 focus:ring-brand-gold/20 transition">
                    </div>
                    <button type="submit" class="px-2.5 cursor-pointer active:translate-y-0.5 transition
                    bg-brand-gold hover:bg-brand-gold-hover border border-brand-gold border-l-0 rounded-tr-lg rounded-br-lg">
                        <i class="fa-solid fa-magnifying-glass text-white"></i>
                    </button>
                </div>

                <select name="category_filter" onchange="this.form.submit()" 
                    class="bg-gray-50 border border-gray-300 text-brand-dark text-sm rounded-lg p-2 focus:outline-none focus:border-brand-gold">
                    <option value="" {{ request('category_filter') == '' ? 'selected' : '' }}>
                        All Categories
                    </option>
                    @foreach($categories as $category)
                        <option value="{{$category->id}}" {{ request('category_filter') == $category->id ? 'selected' : '' }}>{{ $category->kind }}</option>
                    @endforeach
                </select>

                
            </form>
            
            <div class="flex items-center space-x-4">
                <!-- Dynamic Quick Action Accent Button Based on Role -->
                @if(auth()->user()?->role_id == 1 &&
                    request()->routeIs('inventory.*'))
                    <button class="bg-brand-gold border-0  hover:bg-brand-gold-hover text-white font-semibold px-4 py-2 rounded-lg shadow transition text-sm cursor-pointer active:translate-y-0.5"
                    onclick="window.openModal('addInventoryModal')">
                        + Add New Item
                    </button>
                @else
                    <!-- <button class="bg-brand-navy hover:bg-brand-dark text-white font-semibold px-4 py-2 rounded-lg shadow transition text-sm">
                        Request Stock Pull
                    </button> -->
                @endif

                <button class="bg-brand-gold border-0  hover:bg-brand-gold-hover text-white font-semibold px-4 py-2 rounded-lg shadow transition text-sm cursor-pointer active:translate-y-0.5"
                onclick="window.openModal('addInventoryModal')">
                    + Add New Item
                </button>
            </div>
        </div>
    </div>

    <!-- Inventory Model Table Structure -->
    <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 text-xs font-bold text-brand-navy uppercase tracking-wider border-b border-gray-200">
                        <th class="px-6 py-4">Item Code</th>
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
                            <!-- item_code Column -->
                            <td class="px-6 py-4 font-mono text-xs font-semibold text-brand-navy">
                                <span class="bg-brand-navy/5 text-brand-navy px-2 py-1 rounded">
                                    {{ $item->item_code }}
                                </span>
                            </td>

                            <!-- Name Column -->
                            <td class="px-6 py-4 font-semibold text-brand-dark">
                                {{ $item->name }}
                            </td>

                            <!-- Category Column -->
                            <td class="px-6 py-4">
                                <span class="px-2.5 py-0.5 bg-slate-100 text-slate-700 text-xs font-medium rounded-md border border-slate-200">
                                    {{ $item->kind->kind ?? 'Unassigned' }}
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
                                <td class="px-6 py-4 text-right whitespace-nowrap space-x-3">
                                    
                                    <!-- Update & Record -->
                                    @if(request()->routeIs('underground.inventory.*'))
                                        <!-- <a href="{{ route('underground.inventory.update-record', ['item_id' => $item->id]) }}" 
                                        class="text-brand-navy hover:underline text-xs font-bold cursor-pointer">
                                            Update & Record
                                        </a> -->

                                        <button type="button" 
                                                onclick="viewStockRecordModal('{{ $item->id }}'" 
                                                class="text-brand-navy hover:underline text-xs font-bold cursor-pointer">
                                            View Stock Record
                                        </button>

                                        <button type="button" 
                                                onclick="updateAndRecordModal('{{ $item->id }}', '{{ addslashes($item->name) }}', '{{ $item->kind->kind ?? 'ANFO' }}', '{{ $item->quantity }}')" 
                                                class="text-brand-navy hover:underline text-xs font-bold cursor-pointer">
                                            Update & Record
                                        </button>
                                    @endif

                                    <!-- Edit -->
                                    <button onclick="openEditInventoryModal('{{ $item->id }}', '{{ $item->item_code }}', '{{ addslashes($item->name) }}', '{{ $item->kind }}', '{{ $item->quantity }}')" 
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