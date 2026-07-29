@extends('layouts.app')

@section('page-title', 'Dashboard')

@section('sidebar')
    @include('components.sidebar')
@endsection

@section('content')
<!-- Metric Cards Overview -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <div class="bg-white p-6 rounded-xl border border-gray-100 shadow-sm border-l-4 hover:border-rose-400 transition">
        <p class="text-sm font-medium text-gray-500">Pending Inventory Requests</p>
        <p class="text-3xl font-bold text-rose-400 mt-1">6 Requests</p>
    </div>
    <div class="bg-white p-6 rounded-xl border border-gray-100 shadow-sm border-l-4 hover:border-gray-500 transition">
        <p class="text-sm font-medium text-gray-500">Total Unique Item Codes</p>
        <p class="text-3xl font-bold text-brand-navy mt-1">{{ $item_count }}</p>
    </div>
    <div class="bg-white p-6 rounded-xl border border-gray-100 shadow-sm border-l-4 hover:border-brand-gold transition">
        <p class="text-sm font-medium text-gray-500">Low Stock Items</p>
        <p class="text-3xl font-bold text-brand-gold mt-1">{{ $low_stock_count }} Items</p>
    </div>
</div>

<!-- Reports Component -->
<div class="grid grid-cols-2 gap-4 mb-8">
    
    <!-- Daily Report -->
    <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
        <div class="px-6 py-4 bg-gray-50 border-b border-gray-200 flex justify-between items-center">
            <h3 class="font-bold text-brand-navy">Daily Consumption Report Condensed</h3>

            <div class="flex gap-2">
                <a href="#" class="text-sm font-bold text-brand-gold">
                    Go to reports 
                    <i class="fa-solid fa-arrow-right"></i>
                </a>
                <!-- <input type="text" placeholder="Search item code..." class="px-3 py-1.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-brand-gold"> -->
            </div>
        </div>
        
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-100 text-xs font-semibold text-gray-600 uppercase tracking-wider border-b border-gray-200">
                    <th class="px-6 py-3">Placeholder</th>
                    <th class="px-6 py-3">Placeholder</th>
                    <th class="px-6 py-3">Placeholder</th>
                    <th class="px-6 py-3">Placeholder</th>
                    <th class="px-6 py-3 text-right"></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 text-sm text-gray-700">
                <tr class="hover:bg-gray-50/70 transition">
                    <td class="px-6 py-4">Placeholder</td>
                    <td class="px-6 py-4">Placeholder</td>
                    <td class="px-6 py-4">Placeholder</td>
                    <td class="px-6 py-4">Placeholder</td>
                    <td class="px-6 py-4">Placeholder</td>
                </tr>
            </tbody>
        </table>
    </div>
    
    
    <!-- Weekly Report -->
    <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
        <div class="px-6 py-4 bg-gray-50 border-b border-gray-200 flex justify-between items-center">
            <h3 class="font-bold text-brand-navy">Weekly Consumption Report Condensed</h3>

            <div class="flex gap-2">
                <a href="#" class="text-sm font-bold text-brand-gold">
                    Go to reports 
                    <i class="fa-solid fa-arrow-right"></i>
                </a>
                <!-- <input type="text" placeholder="Search item code..." class="px-3 py-1.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-brand-gold"> -->
            </div>
        </div>
        
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-100 text-xs font-semibold text-gray-600 uppercase tracking-wider border-b border-gray-200">
                    <th class="px-6 py-3">Placeholder</th>
                    <th class="px-6 py-3">Placeholder</th>
                    <th class="px-6 py-3">Placeholder</th>
                    <th class="px-6 py-3">Placeholder</th>
                    <th class="px-6 py-3 text-right"></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 text-sm text-gray-700">
                <tr class="hover:bg-gray-50/70 transition">
                    <td class="px-6 py-4">Placeholder</td>
                    <td class="px-6 py-4">Placeholder</td>
                    <td class="px-6 py-4">Placeholder</td>
                    <td class="px-6 py-4">Placeholder</td>
                    <td class="px-6 py-4">Placeholder</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<!-- Stock Management Table Component -->
<div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
    <div class="px-6 py-4 bg-gray-50 border-b border-gray-200 flex justify-between items-center">
        <h3 class="font-bold text-brand-navy">Current Total Inventory Items</h3>
        <input type="text" placeholder="Search item code..." class="px-3 py-1.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-brand-gold">
    </div>
    
    <table class="w-full text-left border-collapse">
        <thead>
            <tr class="bg-gray-100 text-xs font-semibold text-gray-600 uppercase tracking-wider border-b border-gray-200">
                <th class="px-6 py-3">Item Code</th>
                <th class="px-6 py-3">Item Name</th>
                <th class="px-6 py-3">Stocky Quantity</th>
                <th class="px-6 py-3">Status</th>
                <th class="px-6 py-3 text-right">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100 text-sm text-gray-700">
            @foreach($inventory as $item)
            <!-- Row 1 (Normal Stock Level) -->
            <tr class="hover:bg-gray-50/70 transition">
                <td class="px-6 py-4 font-mono font-semibold text-brand-navy">{{ $item->item->item_code }}</td>
                <td class="px-6 py-4 font-medium">{{ $item->item->name }}</td>
                <td class="px-6 py-4 
                {{ $item->quantity > 100 ? '' : 'text-brand-gold font-bold' }}">{{ $item->quantity }} Units</td>
                <td class="px-6 py-4">
                    <span class="px-2.5 py-1 {{ $item->quantity > 100 ? 'bg-green-100 text-brand-green' : 'bg-amber-100 text-brand-gold' }} font-semibold text-xs rounded-full">
                        {{ $item->quantity > 100 ? 'In Stock' : 'Low Stock'}}
                    </span>
                </td>

                {{-- <td class="px-6 py-4 text-right space-x-2">
                    <button class="text-brand-navy hover:underline text-xs font-medium">View</button>
                    @if(auth()->user()?->role->role == 'admin')
                        <button class="text-brand-gold hover:underline text-xs font-medium">Edit Master</button>
                    @endif
                </td> --}}
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection