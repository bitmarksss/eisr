@extends('layouts.app')

@section('page-title', ucfirst($location))

@section('sidebar')
    @include('components.sidebar')
@endsection

@section('modals')
    @include('components.backdrop')

    @if(request()->routeIs('maintenance.inventory.*'))
        @include('components.add-inventory-modal')
        @include('components.edit-inventory-modal')
        @include('components.inventory.item-modal')
    @endif

    @if(request()->routeIs('surface.inventory.*'))
        @include('components.inventory.stock-card-modal')
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
        <div>
            <p class="text-xs font-bold text-gray-500 uppercase tracking-wider">Maintenance</p>
            <h2 class="text-xl font-bold text-brand-navy mt-1 text-nowrap">
            Inventory Items
            </h2>
        </div>
        
        <div class="flex flex-wrap items-center justify-end gap-6 w-full">
            <!-- Search and Filters -->
            <form method="GET" action="{{ route('maintenance.inventory.index') }}" class="flex flex-wrap items-center justify-end gap-3 flex-1 w-full">
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
            
            <!-- Dynamic Quick Action Accent Button Based on Role -->
            <div class="flex items-center space-x-4">

                <!-- Add New Inventory Item -->
                @if(auth()->user()?->role_id == 1)
                    <button class="bg-brand-gold border-0  hover:bg-brand-gold-hover text-white font-semibold px-4 py-2 space-x-1 rounded-lg shadow transition text-sm cursor-pointer active:translate-y-0.5"
                    onclick="window.openModal('addInventoryModal')">
                        + Add New Item
                    </button>
                @endif
                
                @if(false) <!-- FALSED for testing-->
                    <!-- Receive Items from Supplier -->
                    @if(request()->routeIs('*.inventory.index'))
                        <button class="bg-brand-green border-0  hover:bg-brand-green-hover text-white font-semibold px-4 py-2 space-x-1 rounded-lg shadow transition text-sm cursor-pointer active:translate-y-0.5"
                        onclick="window.openModal('receivingModal')">
                            <i class="fa-solid fa-truck-ramp-box"></i>
                            <span>Receive Items</span>
                        </button>
                    @endif
                    
                    <!-- Issue Items to Underground -->
                    @if(request()->routeIs('*.inventory.index'))
                        <button class="bg-brand-navy border-0  hover:bg-brand-navy-hover text-white font-semibold px-4 py-2 space-x-1 rounded-lg shadow transition text-sm cursor-pointer active:translate-y-0.5"
                        onclick="window.openModal('issuanceModal')">
                            <i class="fa-solid fa-dolly"></i>
                            <span>Issue Items</span>
                        </button>
                    @endif
                @endif
            </div>
        </div>
    </div>

    <!-- Inventory Model Table Structure -->
    <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 text-xs font-bold text-brand-navy uppercase tracking-wider border-b border-gray-200">
                        <!-- <th class="px-6 py-4">Item Code</th> -->
                        <th class="px-6 py-4">Item Name</th>
                        <th class="px-6 py-4 text-center">Variant</th>
                        <th class="px-6 py-4">Supplier</th>
                        <th class="px-6 py-4">Kind</th>
                        <th class="px-6 py-4">Cost</th>

                        @if(auth()->user()?->role->role == 'admin')
                            <th class="px-6 py-4 text-right">Actions</th>
                        @endif
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-sm text-gray-700">
                    
                    @forelse($inventory_items as $item)
                        <tr class="hover:bg-gray-50/50 transition">
                            <!-- item_code Column -->
                            <!-- <td class="px-6 py-4 font-mono text-xs font-semibold text-brand-navy">
                                <span class="bg-brand-navy/5 text-brand-navy px-2 py-1 rounded">
                                    {{ $item->item_code }}
                                </span>
                            </td> -->

                            <!-- Name Column -->
                            <td class="px-6 py-4 font-semibold text-brand-dark">
                                {{ $item->name }}
                            </td>
                            
                            <!-- Variant Column -->
                            <td class="px-6 py-4 font-semibold text-brand-dark text-center">
                                {{ $item->variant }}
                            </td>

                            <!-- Supplier Column -->
                            <td class="px-6 py-4 font-semibold text-brand-dark">
                                {{ $item->supplier->name }}
                            </td>

                            <!-- Category Column -->
                            <td class="px-6 py-4">
                                <span class="px-2.5 py-0.5 bg-slate-100 text-slate-700 text-xs font-medium rounded-md border border-slate-200">
                                    {{ $item->kind->kind ?? 'Unassigned' }}
                                </span>
                            </td>

                            <!-- Cost Column -->
                            <td class="px-6 py-4">
                                <span class="px-2.5 py-0.5 bg-slate-100 text-slate-700 text-xs font-medium rounded-md border border-slate-200">
                                    {{ $item->cost ? '₱ '. $item->cost : 'Unassigned' }}
                                </span>
                            </td>

                            <!-- Protected Actions Triggering adjustments -->
                            @if(auth()->user()?->role->role == 'admin')
                                <td class="px-6 py-4 text-right whitespace-nowrap space-x-3">
                                    
                                    <!-- DEPRECATED -->
                                    <!-- Update & Record -->
                                    @if(request()->routeIs('surface.inventory.*'))
                                    <button type="button" 
                                            onclick="stockCardModal('{{ $item->id }}')"
                                            class="text-brand-navy hover:underline text-xs font-bold cursor-pointer">
                                        View Stock Card
                                    </button>
                                    @endif
                                    <!-- DEPRECATED -->

                                    <!-- Edit -->
                                    <x-tooltip text="Edit"
                                        bg_color="bg brand navy"
                                        text_color="text-white"
                                    >
                                        <button onclick="openEditInventoryModal('{{ $item->id }}', '{{ $item->supplier->id }}', '{{ $item->item_code }}', '{{ addslashes($item->name) }}', '{{ $item->kind->id }}', '{{ $item->cost }}', '{{ $item->variant }}', '{{ $item->uom }}', '{{ $item->quantity }}')" 
                                            class="rounded-lg bg-amber-500 py-2 px-2.5 text-white hover:underline text-xs font-bold cursor-pointer">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </button>

                                    </x-tooltip>
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
