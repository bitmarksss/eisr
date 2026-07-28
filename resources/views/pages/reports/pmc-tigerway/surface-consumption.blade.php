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
    <div class="bg-white p-4 mb-10 rounded-xl border border-gray-200 shadow-sm flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div class="flex flex-wrap items-center justify-between w-full">
            
            <!-- Search and Filters -->
            <form method="GET" action="{{ route('reports.pmc-tigerway.surface') }}" class="flex flex-wrap items-center gap-3 flex-1 w-full">

                <!-- Date Filter -->
                <div class="space-y-1">
                    <label class="block text-xs font-semibold">Date Start:</label>
                    <input type="date" name="start_date" value="{{ request('start_date') }}"
                                class="w-70 bg-gray-50 border border-gray-300 text-brand-dark text-sm rounded-lg pl-3 pr-3 py-2 focus:border-brand-gold focus:outline-none focus:ring-2 focus:ring-brand-gold/20 transition">
                </div>
                <div class="space-y-1">
                    <label class="block text-xs font-semibold">Date End:</label>
                    <input type="date" name="end_date" value="{{ request('end_date') }}"
                                class="w-70 bg-gray-50 border border-gray-300 text-brand-dark text-sm rounded-lg pl-3 pr-3 py-2 focus:border-brand-gold focus:outline-none focus:ring-2 focus:ring-brand-gold/20 transition">
                </div>

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

                <!-- Location Filter -->
                <div class="space-y-1">
                    <label class="block text-xs font-semibold">Location:</label>
                    <select name="location" onchange="this.form.submit()" 
                        class="bg-gray-50 border border-gray-300 text-brand-dark text-sm rounded-lg p-2 focus:outline-none focus:border-brand-gold">
                        <option {{ request('location') == 'PMC' ? 'selected' : '' }}
                            value="PMC"> PMC </option>
                        <option {{ request('location') == 'EXPLO' ? 'selected' : '' }}
                            value="EXPLO"> EXPLO </option>
                        <option {{ request('location') == 'TIGERWAY' ? 'selected' : '' }}
                            value="TIGERWAY"> TIGERWAY </option>
                    </select>
                </div>
            </form>
            
            <button type="button" class="px-4 py-2 rounded-lg bg-brand-green hover:bg-brand-green-hover active:translate-y-0.5 text-white text-sm font-bold transition cursor-pointer flex items-center gap-1.5">
                <i class="fa-solid fa-file-excel text-white"></i>
                Export
            </button>
        </div>
    </div>

    @foreach($selectedItems as $item)
    <div class="relative bg-white w-full rounded-xl shadow-2xl border border-gray-200 overflow-hidden transform transition-all z-110 animate-fade-in flex flex-col max-h-[90vh]">
        <div class="px-6 py-4 bg-brand-green text-white flex justify-between items-center shrink-0">
            <div class="flex items-center space-x-3">
                <span class="text-xs font-bold uppercase tracking-wider text-white">Item Name:</span>
                <span class="font-bold tracking-wide text-lg">{{ $item->item->name ?? 'Select an item...'}}</span>
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
                        <td class="border border-gray-300 p-2">{{ $item->item->name }} / {{ $item->item->kind->kind}}</td>
                        <td class="border border-gray-300 p-2">{{ $item->item->unit->unit ?? 'PCS'}}</td>
                        <td class="border border-gray-300 p-2">{{ $item->item->name ?? ''}}</td>
                        <td class="border border-gray-300 p-2">{{ $item->quantity ?? ''}}</td>
                        <td class="border border-gray-300 p-2 font-semibold">June 06, 2026</td>
                        <td class="border border-gray-300 p-2">200</td>
                        <td class="border border-gray-300 p-2 font-bold">{{$item->placehold ?? 6500}}</td>
                        <td class="border border-gray-300 p-2 text-left">{{$item->remarks ?? 'No Usage'}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    @endforeach

</div>

@endsection


@push('scripts')
<script type="module">

</script>
@endpush