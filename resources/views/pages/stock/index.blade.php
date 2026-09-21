@extends('layouts.app')

@section('page-title', ucfirst($location) . " Stock")

@section('sidebar')
    @include('components.sidebar')
@endsection

@section('modals')
    @include('components.backdrop')

    @include('components.stock.edit-modal')

    @if(request()->routeIs('surface.stock.*'))
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
    <div class="bg-white p-4 rounded-xl border border-gray-200 shadow-sm flex flex-col md:flex-row md:items-center md:justify-between gap-6">
        <div>
            <p class="text-xs font-bold text-gray-500 uppercase tracking-wider text-nowrap">{{ ucfirst($location) }} Magazine</p>
            <h2 class="text-xl font-bold text-brand-navy mt-1 text-nowrap">
            Inventory Stocks
            </h2>
        </div>
        
        <div class="flex flex-wrap items-center justify-end gap-6 w-full">
            <!-- Search and Filters -->
            <form method="GET" action="{{ route($location . '.stock.index') }}" 
                class="flex flex-wrap items-center justify-end gap-3 flex-1 w-full">

                @if(request()->routeIs('underground.*'))
                <!-- Level Filter -->
                <select name="level_filter" onchange="this.form.submit()" 
                    class="bg-gray-50 border border-gray-300 text-brand-dark text-sm rounded-lg p-2 focus:outline-none focus:border-brand-gold">
                    <option value="" {{ request('level_filter') == '' ? 'selected' : '' }}>
                        All Levels
                    </option>
                    @foreach($levels as $level)
                        <option value="{{$level->id}}" {{ request('level_filter') == $level->id ? 'selected' : '' }}>{{ $level->name }}</option>
                    @endforeach
                </select>
                @endif
                
                <!-- Search Filter -->
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

                <!-- Category Filter -->
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

                <!-- Request Items from Mill -->
                @if(request()->routeIs('surface.stock.index')) <!-- limited receiving to SURFACE -->
                <a href="{{ route('surface.stock.receive.index') }}" class="bg-brand-green border-0  hover:bg-brand-green-hover text-white font-semibold px-4 py-2 space-x-1 rounded-lg shadow transition text-sm cursor-pointer active:translate-y-0.5">
                    <i class="fa-solid fa-file-lines"></i>
                    <span>Request Stock</span>
                </a>
                @endif

                <!-- Receive Items from Mill -->
                @if(false)
                <a href="{{ route('surface.stock.receive.index') }}" class="bg-brand-green border-0  hover:bg-brand-green-hover text-white font-semibold px-4 py-2 space-x-1 rounded-lg shadow transition text-sm cursor-pointer active:translate-y-0.5">
                    <i class="fa-solid fa-truck-ramp-box"></i>
                    <span>Receive Items</span>
                </a>
                
                <!-- Issue Items to Underground -->
                <a href="{{ route('surface.stock.issuance.index') }}" class="bg-brand-navy border-0  hover:bg-brand-navy-hover text-white font-semibold px-4 py-2 space-x-1 rounded-lg shadow transition text-sm cursor-pointer active:translate-y-0.5">
                    <i class="fa-solid fa-dolly"></i>
                    <span>Issue Items</span>
                </a>
                @endif
                

                <!-- DEPRECATED: Converted modals to page forms  -->
                @if(false)
                <!-- Receive Items from Supplier -->
                <button class="bg-brand-green border-0  hover:bg-brand-green-hover text-white font-semibold px-4 py-2 space-x-1 rounded-lg shadow transition text-sm cursor-pointer active:translate-y-0.5"
                    onclick="window.openModal('receivingModal')">
                    <i class="fa-solid fa-truck-ramp-box"></i>
                    <span>Receive Items</span>
                </button>
                
                <!-- Issue Items to Underground -->
                <button class="bg-brand-navy border-0  hover:bg-brand-navy-hover text-white font-semibold px-4 py-2 space-x-1 rounded-lg shadow transition text-sm cursor-pointer active:translate-y-0.5"
                    onclick="window.openModal('issuanceModal')">
                    <i class="fa-solid fa-dolly"></i>
                    <span>Issue Items</span>
                </button>
                @endif
                

                <!-- DEPRECATED: Issue Items to Underground -->
                @if(request()->routeIs('underground.stock.index') && false) <!-- added false to hide -->
                    <button class="bg-brand-navy border-0  hover:bg-brand-navy-hover text-white font-semibold px-4 py-2 space-x-1 rounded-lg shadow transition text-sm cursor-pointer active:translate-y-0.5"
                    onclick="window.openModal('issuanceModal')">
                        <i class="fa-solid fa-cart-flatbed"></i>
                        <span>Transfer Items</span>
                    </button>
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
                        @if(request()->routeIs('underground.*'))
                            <th class="px-6 py-4">Level</th>
                        @endif
                        <th class="px-6 py-4">Variant</th>
                        <th class="px-6 py-4">Supplier</th>
                        <th class="px-6 py-4">Kind</th>
                        <th class="px-6 py-4">Cost</th>
                        <th class="px-6 py-4">Available Quantity</th>
                        <th class="px-6 py-4">Status Flag</th>
                        @if(auth()->user()?->role->role == 'admin')
                            <th class="px-6 py-4 text-right">Actions</th>
                        @endif
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-sm text-gray-700">
                    
                    @forelse($stocks as $item)
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

                        <!-- Level Column -->
                        @if(request()->routeIs('underground.*'))
                        <td class="px-6 py-4 font-semibold text-brand-dark">
                            <span class="px-3 py-1 bg-slate-100 text-brand-navy/80 text-xs font-bold rounded-full border border-brand-navy/20">
                                {{ $item->level->name }}
                            </span>
                        </td>
                        @endif

                        <!-- Supplier Column -->
                        <td class="px-6 py-4 text-brand-dark">
                            {{ $item->item->variant ?? 'Unassigned' }}
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

                        <!-- Quantity Column -->
                        <td class="px-6 py-4 font-bold">
                            <span class="{{ $item->quantity <= 10 ? 'text-brand-gold' : ($item->quantity == 0 ? 'text-red-600' : 'text-brand-dark') }}">
                                {{ number_format($item->quantity) }}
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
                            @if(request()->routeIs('surface.*'))
                            <x-tooltip text="View Stock Card"
                                bg_color="bg brand navy"
                                text_color="text-white"
                            >
                                <button type="button" 
                                    data-action="stock-card"
                                    data-stock-id="{{ $item->id }}"
                                    class="py-2 px-2.5 bg-brand-navy text-white rounded-lg hover:underline text-xs font-bold cursor-pointer">
                                    <i class="fa-solid fa-eye"></i>
                                </button>
                            </x-tooltip>
                            @endif

                            <!-- Edit -->
                            <x-tooltip text="Edit Inventory Stock"
                                bg_color="bg brand navy"
                                text_color="text-white"
                            >
                                <button 
                                    data-action="edit-stock"
                                    data-stock-id="{{ $item->id }}"
                                    data-supplier="{{ $item->supplier->name }}"
                                    data-name="{{ $item->name }}"
                                    data-kind="{{ $item->kind->kind }}"
                                    data-quantity="{{ $item->quantity }}"
                                    class="py-2 px-2.5 bg-amber-400 text-white rounded-lg hover:underline text-xs font-bold cursor-pointer">
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
        @if(method_exists($stocks, 'hasPages') && $inventoryItems->hasPages())
            <div class="p-4 bg-gray-50 border-t border-gray-100">
                {{ $stocks->appends(request()->query())->links() }}
            </div>
        @endif
    </div>

</div>
@endsection

@push('scripts')
<script type="module">
document.addEventListener('DOMContentLoaded', function() {
    
window.modal = document.getElementById('stockCardModal');
window.modal?.addEventListener('click', function(event) {
    if (event.target === window.modal || event.target.closest('button')) {
        resetStockCard();
    }
});
                                
document.addEventListener('click', function (event) {
    const button = event.target.closest('[data-action]');

    if (!button) return;

    const action = button.dataset.action;

    switch (action) {
        case 'close-modal':
            console.log('action', action);
            closeStockCardModal();
            break;    
        case 'stock-card':
            stockCardModal(button.dataset.stockId);
            break;

        case 'edit-stock':
            editStock(
                button.dataset.stockId,
                button.dataset.supplier,
                button.dataset.name,
                button.dataset.kind,
                button.dataset.quantity
            );
            break;
    }
});

function stockCardModal(id) {
    if (!modal) return;
    
    resetStockCard();
    loadStockCard(id);

    window.openModal('stockCardModal');
}

async function loadStockCard(stockId) {
    try {
        const response = await fetch('/surface/stock/load-stock/' + stockId, {
            method: 'GET',
            headers: {
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            }
        });

        if (!response.ok) throw new Error('Unable to load supplier items.');

        const data = await response.json();

        populateStockCard(data);
    } catch (error) {
        console.error('Error loading stock card:', error);
        alert('An error occurred while loading the stock card. Please try again later.');
    }
}

function populateStockCard(data) {
    const nameEl = document.getElementById('modal_item_name');
    if (nameEl) {
        const nameText = data.stock.item.name;
        const variantText = data.stock.item.variant ? ` (${data.stock.item.variant})` : '';
        nameEl.innerHTML = `${nameText} ${variantText}`;
    }
    
    const kindEl = document.getElementById('modal_item_kind');
    if (kindEl) {
        const kindText = data.stock.item.kind?.kind ?? '';
        kindEl.innerHTML = kindText;
    }

    const rowsEl = document.getElementById('stockFormRows');
    const stockRows = data.stock_card ?? [];
    const minimumRows = Math.max(stockRows.length, 5);
    const blankRows = Array.from({ length: minimumRows - stockRows.length }, () => null);
    const rows = [...stockRows, ...blankRows];

    // rowsEl.innerHTML = rows.length ? rows.map(row => row ? `
    rowsEl.innerHTML = rows.map(row => row ? `
        <tr class="text-center hover:bg-gray-50 transition-colors">
            <td class="border border-gray-200 p-2.5 font-semibold">${row.date}</td>
            <td class="border border-gray-200 p-2.5">${Number(row.beginning).toLocaleString()}</td>
            <td class="border border-gray-200 p-2.5 text-green-600 font-semibold">${Number(row.incoming).toLocaleString()}</td>
            <td class="border border-gray-200 p-2.5 text-red-600 font-semibold">${Number(row.outgoing).toLocaleString()}</td>
            <td class="border border-gray-200 p-2.5 font-bold text-brand-dark">${Number(row.ending).toLocaleString()}</td>
            <td class="border border-gray-200 p-2.5 lowercase text-gray-500">${row.uom ?? ''}</td>
        </tr>` : `
        <tr class="text-center" aria-hidden="true">
            <td class="border border-gray-200 p-2.5">&nbsp;</td>
            <td class="border border-gray-200 p-2.5">&nbsp;</td>
            <td class="border border-gray-200 p-2.5">&nbsp;</td>
            <td class="border border-gray-200 p-2.5">&nbsp;</td>
            <td class="border border-gray-200 p-2.5">&nbsp;</td>
            <td class="border border-gray-200 p-2.5">&nbsp;</td>
        </tr>`).join('');
}

function resetStockCard() {
    document.getElementById('modal_item_name').textContent = 'Loading...';
    document.getElementById('modal_item_kind').textContent = 'Loading...';
    const rowsEl = document.getElementById('stockFormRows');
    let rows = '';
    for(let i = 0; i < 5; i++) {
        rows += `<tr class="animate-pulse">`;

        const grays = ['100', '200'];
        for(let j = 0; j < 6; j++) {
            rows += `
                <td class="border border-gray-200 p-0">
                    <div class="space-y-3 p-4">
                        <div class="h-4 rounded bg-gray-${grays[Math.floor(Math.random() * grays.length)]}"></div>
                    </div>
                </td>`;
        }

        rows += `</tr>`;
    }
    rowsEl.innerHTML = rows;
}

function closeStockCardModal() {
    resetStockCard();
    window.closeModal();
}

});
</script>
@endpush
