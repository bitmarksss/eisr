@extends('layouts.app')

@section('page-title', 'Inventory Items')

@section('sidebar')
    @include('components.sidebar')
@endsection

@section('content')
<div class="space-y-6">

    @if(session('success'))
        <div class="bg-green-100 border border-brand-green/30 text-brand-green p-4 rounded-xl text-sm font-semibold flex items-center shadow-xs">
            <span class="mr-2">✓</span> {{ session('success') }}
        </div>
    @endif

    @if(request('action') === 'adjust' && request('sku'))
        <div class="bg-white rounded-xl border border-brand-gold/30 shadow-md overflow-hidden max-w-2xl">
            <div class="px-6 py-4 bg-brand-green text-white flex justify-between items-center">
                <h3 class="font-bold tracking-wide">Adjust Stock Level — SKU: {{ request('sku') }}</h3>
                <a href="{{ route('inventory.index') }}" class="text-white/70 hover:text-white font-bold text-lg">✕</a>
            </div>
            
            <form action="#" method="POST" class="p-6 space-y-4">
                @csrf
                <input type="hidden" name="sku" value="{{ request('sku') }}">
                
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="adjustment_type" class="block text-xs font-bold text-brand-dark uppercase tracking-wider mb-1">Adjustment Action</label>
                        <select id="adjustment_type" name="type" class="w-full bg-gray-50 border border-gray-300 rounded-lg p-2.5 text-sm focus:border-brand-gold focus:outline-none">
                            <option value="add">Add Stock (+) </option>
                            <option value="remove">Remove / Pull Stock (-)</option>
                            <option value="audit">Set Absolute Count (=)</option>
                        </select>
                    </div>
                    <div>
                        <label for="quantity" class="block text-xs font-bold text-brand-dark uppercase tracking-wider mb-1">Quantity</label>
                        <input type="number" id="quantity" name="quantity" min="1" required placeholder="0"
                            class="w-full bg-gray-50 border border-gray-300 rounded-lg px-3 py-2 text-sm focus:border-brand-gold focus:outline-none">
                    </div>
                </div>

                <div>
                    <label for="reason" class="block text-xs font-bold text-brand-dark uppercase tracking-wider mb-1">Log Modification Reason</label>
                    <input type="text" id="reason" name="reason" required placeholder="e.g., Damaged item replacement, monthly audit variance, incoming supplier batch"
                        class="w-full bg-gray-50 border border-gray-300 rounded-lg px-3 py-2 text-sm focus:border-brand-gold focus:outline-none">
                </div>

                <div class="pt-4 flex justify-end space-x-3 border-t border-gray-100">
                    <a href="{{ route('inventory.index') }}" class="px-4 py-2 text-sm font-semibold text-gray-500 hover:text-gray-700 transition">Cancel</a>
                    <button type="submit" class="px-5 py-2 rounded-lg bg-brand-gold hover:bg-brand-gold-hover text-white text-sm font-bold shadow-xs transition cursor-pointer">
                        Apply Adjustments
                    </button>
                </div>
            </form>
        </div>
    @endif

    <div class="bg-white p-4 rounded-xl border border-gray-200 shadow-sm flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        
        <form method="GET" action="{{ route('inventory.index') }}" class="flex flex-wrap items-center gap-3 flex-1 w-full">
            <div class="relative min-w-[280px] flex-1 max-w-md">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search inventory by title, SKU, or rack location..." 
                    class="w-full bg-gray-50 border border-gray-300 text-brand-dark text-sm rounded-lg pl-3 pr-10 py-2 focus:border-brand-gold focus:outline-none focus:ring-2 focus:ring-brand-gold/20 transition">
            </div>

            <select name="status_filter" onchange="this.form.submit()" 
                class="bg-gray-50 border border-gray-300 text-brand-dark text-sm rounded-lg p-2 focus:outline-none focus:border-brand-gold">
                <option value="">All Stock Levels</option>
                <option value="in_stock" {{ request('status_filter') == 'in_stock' ? 'selected' : '' }}>In Stock</option>
                <option value="low_stock" {{ request('status_filter') == 'low_stock' ? 'selected' : '' }}>Low Stock</option>
                <option value="out_of_stock" {{ request('status_filter') == 'out_of_stock' ? 'selected' : '' }}>Out of Stock</option>
            </select>
        </form>

        @if(auth()->user()?->is_admin)
            <a href="#" class="bg-brand-gold hover:bg-brand-gold-hover text-white font-bold px-5 py-2.5 rounded-lg shadow-sm text-sm transition text-center whitespace-nowrap">
                + Catalog New Item
            </a>
        @else
            <a href="#" class="bg-brand-navy hover:bg-brand-dark text-white font-bold px-5 py-2.5 rounded-lg shadow-sm text-sm transition text-center whitespace-nowrap">
                Request Stock Disbursement
            </a>
        @endif
    </div>

    <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 text-xs font-bold text-brand-navy uppercase tracking-wider border-b border-gray-200">
                        <th class="px-6 py-4">Product Details / SKU</th>
                        <th class="px-6 py-4">Warehouse Grid Location</th>
                        <th class="px-6 py-4">Available Quantity</th>
                        <th class="px-6 py-4">System Threshold Flag</th>
                        <th class="px-6 py-4 text-right">Operational Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-sm text-gray-700">
                    
                    <tr class="hover:bg-gray-50/50 transition">
                        <td class="px-6 py-4">
                            <div class="font-bold text-brand-dark text-base">Industrial Carbide Drillbits (Pack of 10)</div>
                            <span class="font-mono text-xs text-gray-400 bg-gray-100 px-1.5 py-0.5 rounded">PMC-DRL-552</span>
                        </td>
                        <td class="px-6 py-4 font-medium text-gray-600">Aisle 4, Shelf C-3</td>
                        <td class="px-6 py-4 font-semibold text-brand-dark">340 Units</td>
                        <td class="px-6 py-4">
                            <span class="px-2.5 py-1 bg-green-50 text-brand-green border border-brand-green/20 font-bold text-xs rounded-full">In Stock</span>
                        </td>
                        <td class="px-6 py-4 text-right space-x-3 whitespace-nowrap">
                            <a href="{{ route('inventory.index', ['action' => 'adjust', 'sku' => 'PMC-DRL-552']) }}" 
                               class="text-brand-gold hover:underline text-xs font-bold">Quick Update</a>
                        </td>
                    </tr>

                    <tr class="hover:bg-gray-50/50 transition">
                        <td class="px-6 py-4">
                            <div class="font-bold text-brand-dark text-base">High-Pressure Hydraulic Sealant</div>
                            <span class="font-mono text-xs text-gray-400 bg-gray-100 px-1.5 py-0.5 rounded">PMC-HYD-990</span>
                        </td>
                        <td class="px-6 py-4 font-medium text-gray-600">Aisle 2, Shelf A-1</td>
                        <td class="px-6 py-4 font-bold text-brand-gold">8 Units</td>
                        <td class="px-6 py-4">
                            <span class="px-2.5 py-1 bg-amber-50 text-brand-gold border border-brand-gold/20 font-bold text-xs rounded-full">Low Stock</span>
                        </td>
                        <td class="px-6 py-4 text-right space-x-3 whitespace-nowrap">
                            <a href="{{ route('inventory.index', ['action' => 'adjust', 'sku' => 'PMC-HYD-990']) }}" 
                               class="text-brand-gold hover:underline text-xs font-bold">Reorder / Adjust</a>
                        </td>
                    </tr>

                    <tr class="hover:bg-gray-50/50 transition bg-red-50/20">
                        <td class="px-6 py-4">
                            <div class="font-bold text-brand-dark text-base">Titanium Alloy Structural Couplings</div>
                            <span class="font-mono text-xs text-gray-400 bg-gray-100 px-1.5 py-0.5 rounded">PMC-TIT-012</span>
                        </td>
                        <td class="px-6 py-4 font-medium text-gray-600">Aisle 7, Shelf F-9</td>
                        <td class="px-6 py-4 font-bold text-red-600">0 Units</td>
                        <td class="px-6 py-4">
                            <span class="px-2.5 py-1 bg-red-100 text-red-700 border border-red-200 font-bold text-xs rounded-full">Out of Stock</span>
                        </td>
                        <td class="px-6 py-4 text-right space-x-3 whitespace-nowrap">
                            <a href="{{ route('inventory.index', ['action' => 'adjust', 'sku' => 'PMC-TIT-012']) }}" 
                               class="text-brand-gold hover:underline text-xs font-bold">Emergency Restock</a>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection