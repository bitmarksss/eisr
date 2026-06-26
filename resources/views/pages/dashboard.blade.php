@extends('layouts.app')

@section('page-title', 'Dashboard')

@section('sidebar')
    @include('components.sidebar')
@endsection

@section('content')
<!-- Metric Cards Overview -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <div class="bg-white p-6 rounded-xl border border-gray-100 shadow-sm border-l-4 hover:border-gray-500 transition">
        <p class="text-sm font-medium text-gray-500">Total Unique SKUs</p>
        <p class="text-3xl font-bold text-brand-navy mt-1">1,248</p>
    </div>
    <div class="bg-white p-6 rounded-xl border border-gray-100 shadow-sm border-l-4 hover:border-brand-gold transition">
        <p class="text-sm font-medium text-gray-500">Low Stock Items</p>
        <p class="text-3xl font-bold text-brand-gold mt-1">14 Items</p>
    </div>
    <div class="bg-white p-6 rounded-xl border border-gray-100 shadow-sm border-l-4 hover:border-brand-green transition">
        <p class="text-sm font-medium text-gray-500">Active Users Logged In</p>
        <p class="text-3xl font-bold text-brand-green mt-1">6 Staff</p>
    </div>
</div>

<!-- Stock Management Table Component -->
<div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
    <div class="px-6 py-4 bg-gray-50 border-b border-gray-200 flex justify-between items-center">
        <h3 class="font-bold text-brand-navy">Current Warehouse Inventory</h3>
        <input type="text" placeholder="Search item code..." class="px-3 py-1.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-brand-gold">
    </div>
    
    <table class="w-full text-left border-collapse">
        <thead>
            <tr class="bg-gray-100 text-xs font-semibold text-gray-600 uppercase tracking-wider border-b border-gray-200">
                <th class="px-6 py-3">SKU Code</th>
                <th class="px-6 py-3">Item Name</th>
                <th class="px-6 py-3">Stock Level</th>
                <th class="px-6 py-3">Status</th>
                <th class="px-6 py-3 text-right">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100 text-sm text-gray-700">
            <!-- Row 1 (Normal Stock Level) -->
            <tr class="hover:bg-gray-50/70 transition">
                <td class="px-6 py-4 font-mono font-semibold text-brand-navy">PMC-9082-XL</td>
                <td class="px-6 py-4 font-medium">Industrial Heavy Duty Gaskets</td>
                <td class="px-6 py-4">450 Units</td>
                <td class="px-6 py-4">
                    <span class="px-2.5 py-1 bg-green-100 text-brand-green font-semibold text-xs rounded-full">In Stock</span>
                </td>
                <td class="px-6 py-4 text-right space-x-2">
                    <button class="text-brand-navy hover:underline text-xs font-medium">View</button>
                    @if(auth()->user()?->is_admin)
                        <button class="text-brand-gold hover:underline text-xs font-medium">Edit Master</button>
                    @endif
                </td>
            </tr>

            <!-- Row 2 (Warning State utilizing Brand Gold) -->
            <tr class="hover:bg-gray-50/70 transition">
                <td class="px-6 py-4 font-mono font-semibold text-brand-navy">PMC-1104-MD</td>
                <td class="px-6 py-4 font-medium">Copper Compression Couplings</td>
                <td class="px-6 py-4 text-brand-gold font-bold">12 Units</td>
                <td class="px-6 py-4">
                    <span class="px-2.5 py-1 bg-amber-100 text-brand-gold font-semibold text-xs rounded-full">Low Stock</span>
                </td>
                <td class="px-6 py-4 text-right space-x-2">
                    <button class="text-brand-navy hover:underline text-xs font-medium">View</button>
                    @if(auth()->user()?->is_admin)
                        <button class="text-brand-gold hover:underline text-xs font-medium">Reorder Item</button>
                    @endif
                </td>
            </tr>
        </tbody>
    </table>
</div>
@endsection