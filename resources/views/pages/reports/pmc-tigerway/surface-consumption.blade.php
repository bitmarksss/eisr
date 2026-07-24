@extends('layouts.app')

@section('page-title', 'Surface Consumption Report')

@section('sidebar')
    @include('components.sidebar')
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
            <form method="GET" action="{{ route('reports.pmc-tigerway.surface') }}" class="flex flex-wrap items-center gap-3 flex-1 w-full">
                
                <!-- Search Filter -->
                <div class="space-y-1">
                    <label class="block text-xs font-semibold">Search:</label>
                    <div class="flex w-90">
                        <div class="relative min-w-70 flex-1 max-w-md">
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Type item by name, or category..." 
                                class="w-full bg-gray-50 border border-gray-300 text-brand-dark text-sm rounded-tl-lg rounded-bl-lg pl-3 pr-10 py-2 focus:border-brand-gold focus:outline-none focus:ring-2 focus:ring-brand-gold/20 transition">
                        </div>
                        <button type="submit" class="px-2.5 cursor-pointer active:translate-y-0.5 transition
                        bg-brand-gold hover:bg-brand-gold-hover border border-brand-gold border-l-0 rounded-tr-lg rounded-br-lg">
                            <i class="fa-solid fa-magnifying-glass text-white"></i>
                        </button>
                    </div>
                </div>

                <!-- Item Filter -->
                <div class="space-y-1">
                    <label class="block text-xs font-semibold">Inventory Item:</label>
                    <select name="item" onchange="this.form.submit()" 
                        class="bg-gray-50 border border-gray-300 text-brand-dark text-sm rounded-lg p-2 focus:outline-none focus:border-brand-gold">
                        <option value="" {{ request('item') == '' ? 'selected' : '' }}> All Items </option>
                        @foreach($items as $item)
                            <option value="{{ $item->id }}" {{ request('item') == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Item Category -->
                <div class="space-y-1">
                    <label class="block text-xs font-semibold">Inventory Item:</label>
                    <select name="category" onchange="this.form.submit()" 
                        class="bg-gray-50 border border-gray-300 text-brand-dark text-sm rounded-lg p-2 focus:outline-none focus:border-brand-gold">
                        <option value="" {{ request('category') == '' ? 'selected' : '' }}> All Categories </option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>{{ $category->kind }}</option>
                        @endforeach
                    </select>
                </div>
            </form>
            
            <!-- Dynamic Quick Action Accent Button Based on Role -->
            <div class="flex items-center space-x-4">

                <!-- Receive Items from Supplier -->
                @if(request()->routeIs('surface.stock.index')) <!-- limited receiving to SURFACE -->
                <a href="{{ route('surface.stock.receive') }}" class="bg-brand-green border-0  hover:bg-brand-green-hover text-white font-semibold px-4 py-2 space-x-1 rounded-lg shadow transition text-sm cursor-pointer active:translate-y-0.5">
                    <i class="fa-solid fa-truck-ramp-box"></i>
                    <span>Receive Items</span>
                </a>
                
                <!-- Issue Items to Underground -->
                <a href="{{ route('surface.stock.issuance') }}" class="bg-brand-navy border-0  hover:bg-brand-navy-hover text-white font-semibold px-4 py-2 space-x-1 rounded-lg shadow transition text-sm cursor-pointer active:translate-y-0.5">
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
    <div class="relative bg-white w-full rounded-xl shadow-2xl border border-gray-200 overflow-hidden transform transition-all z-110 animate-fade-in flex flex-col max-h-[90vh]">
        <div class="px-6 py-4 bg-brand-green text-white flex justify-between items-center shrink-0">
            <div class="flex items-center space-x-3">
                <span class="text-xs font-bold uppercase tracking-wider text-white">Item Name:</span>
                <span class="font-bold tracking-wide text-lg">{{ $selectedItem->item->name ?? 'Select an item...'}}</span>
            </div>
        </div>

        <!-- Modal Body / Table Container -->
        <div class="pb-4 overflow-auto flex-1">
            <table class="w-full text-left border-collapse border border-gray-300 text-xs">
                <thead>
                    <tr class="bg-gray-100 text-brand-navy font-bold uppercase text-center tracking-wider border-b border-gray-300">
                        <th class="border border-gray-300 p-2">Kind</th>
                        <th class="border border-gray-300 p-2">UoM</th>
                        <th class="border border-gray-300 p-2">Entry Date</th>
                        <th class="border border-gray-300 p-2">Quantity</th>
                        <th class="border border-gray-300 p-2">Date Withdrawn</th>
                        <th class="border border-gray-300 p-2">Quantity Withdrawn</th>
                        <th class="border border-gray-300 p-2">Balance</th>
                        <th class="border border-gray-300 p-2">Remarks</th>
                    </tr>
                </thead>
                <tbody id="stockCardTableBody" class="divide-y divide-gray-200 bg-white font-medium text-gray-700">
                    <tr class="text-center hover:bg-gray-50">
                        <td class="border border-gray-300 p-2">{{ $selectedItem->kind ?? 'd'}}</td>
                        <td class="border border-gray-300 p-2">{{ $selectedItem->unit ?? ''}}</td>
                        <td class="border border-gray-300 p-2">{{ $selectedItem->item->name ?? ''}}</td>
                        <td class="border border-gray-300 p-2">${log.quantity_added || ''}</td>
                        <td class="border border-gray-300 p-2 font-semibold">${log.date_withdrawn || ''}</td>
                        <td class="border border-gray-300 p-2">${log.quantity_withdrawn || ''}</td>
                        <td class="border border-gray-300 p-2 font-bold">${log.balance ?? 0}</td>
                        <td class="border border-gray-300 p-2 text-left">${log.remarks || 'No Usage'}</td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>

</div>

@endsection


@push('scripts')
<script type="module">

</script>
@endpush