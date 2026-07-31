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
    <div class="bg-white p-4 mb-6 rounded-xl border border-gray-200 shadow-sm flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div class="flex flex-wrap items-center justify-between w-full">
            
            <!-- Search and Filters -->
            <form method="GET" action="{{ route('reports.pmc-tigerway.consumption') }}" class="flex flex-wrap items-center gap-3 flex-1 w-full">

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
                        <option {{ request('location') == 'Surface' ? 'selected' : '' }}
                            value="Surface"> Surface </option>
                        <option {{ request('location') == 'Underground' ? 'selected' : '' }}
                            value="Underground"> Underground </option>
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

    <!-- Selected Items Cards -->
    @foreach($selectedItems as $item)
    <div class="relative bg-white w-full rounded-xl shadow-lg border border-gray-200 overflow-hidden transform transition-all flex flex-col mb-6">
        
        <!-- Header -->
        @include('pages.reports.pmc-tigerway.header')

        <div class="px-6 py-3 bg-gray-50 border-b border-gray-200 text-brand-navy flex justify-between items-center shrink-0">
            <div class="flex items-center space-x-3">
                <span class="font-bold uppercase tracking-wider text-gray-500">Item Name:</span>
                <span class="font-bold tracking-wide text-gray-800">{{ $item->item->name ?? 'Select an item...'}}</span>
            </div>
        </div>
        <!-- Table Container -->
        <div class="p-6 overflow-auto flex-1">
            <table class="w-full text-left text-sm border-collapse border border-gray-300">
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
                        <td class="border border-gray-300 p-2">{{ $item->item->name }} / {{ $item->item->kind->kind ?? '' }}</td>
                        <td class="border border-gray-300 p-2">{{ $item->item->unit->unit ?? 'Pcs'}}</td>
                        <td class="border border-gray-300 p-2">{{ $item->entry_date ?? '06-June-2026' }}</td>
                        <td class="border border-gray-300 p-2">10,750</td>
                        <td class="border border-gray-300 p-2 font-semibold">06-June-2026</td>
                        <td class="border border-gray-300 p-2">250</td>
                        <td class="border border-gray-300 p-2 font-bold">10,500</td>
                        <td class="border border-gray-300 p-2 text-left font-bold">{{ $item->remarks ?? 'Stock Balance' }}</td>
                    </tr>
                    <tr class="text-center hover:bg-gray-50">
                        <td class="border border-gray-300 p-2">{{ $item->item->name }} / {{ $item->item->kind->kind ?? '' }}</td>
                        <td class="border border-gray-300 p-2">{{ $item->item->unit->unit ?? 'Pcs'}}</td>
                        <td class="border border-gray-300 p-2">{{ $item->entry_date ?? '06-June-2026' }}</td>
                        <td class="border border-gray-300 p-2">10,750</td>
                        <td class="border border-gray-300 p-2 font-semibold">06-June-2026</td>
                        <td class="border border-gray-300 p-2">250</td>
                        <td class="border border-gray-300 p-2 font-bold">10,500</td>
                        <td class="border border-gray-300 p-2 text-left font-bold">{{ $item->remarks ?? 'Deposit Supply' }}</td>
                    </tr>
                    <tr class="text-center hover:bg-gray-50">
                        <td class="border border-gray-300 p-2">{{ $item->item->name }} / {{ $item->item->kind->kind ?? '' }}</td>
                        <td class="border border-gray-300 p-2">{{ $item->item->unit->unit ?? 'Pcs'}}</td>
                        <td class="border border-gray-300 p-2">{{ $item->entry_date ?? '06-June-2026' }}</td>
                        <td class="border border-gray-300 p-2">10,750</td>
                        <td class="border border-gray-300 p-2 font-semibold">06-June-2026</td>
                        <td class="border border-gray-300 p-2">250</td>
                        <td class="border border-gray-300 p-2 font-bold">10,500</td>
                        <td class="border border-gray-300 p-2 text-left font-bold">{{ $item->remarks ?? 'Transfer to Underground' }}</td>
                    </tr>
                    <tr class="text-center hover:bg-gray-50">
                        @for($i = 0; $i < 6; $i++)
                        <td class="border border-gray-300 p-2">&nbsp;</td>
                        @endfor
                        <td class="border border-gray-300 p-2 font-bold bg-yellow-100">{{ number_format($item->placehold ?? 49235, 2) }}</td>
                        <td class="border border-gray-300 p-2 text-left font-bold bg-yellow-100">{{ $item->remarks ?? 'Stock Balance' }}</td>
                    </tr>

                    @for($r = 0; $r < 7; $r++)
                        <tr class="text-center hover:bg-gray-50">
                            @for($i = 0; $i < 8; $i++)
                            <td class="border border-gray-300 p-2">&nbsp;</td>
                            @endfor
                        </tr>
                    @endfor
                </tbody>
            </table>
        </div>

        <!-- Footer / Signatures Block -->
        <div class="p-6 bg-white border-t border-gray-200">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 text-sm">
                
                <!-- Prepared By (2 columns on wide screens or stacked) -->
                <div class="space-y-6">
                    <span class="font-bold text-gray-700 block">Prepared By:</span>
                    <div>
                        <div class="font-bold underline text-gray-900">MR. JOHNNY U. GALENG</div>
                        <div class="text-gray-600">Blaster Foreman</div>
                        <div class="text-gray-500">Mount Rock Powder Corp.</div>
                    </div>
                </div>

                <div class="space-y-6">
                    <span class="font-bold text-gray-700 block">&nbsp;</span>
                    <div>
                        <div class="font-bold underline text-gray-900">MR. JOHN XERCES C. ANTIPUESTO</div>
                        <div class="text-gray-600">Blaster Foreman Expedition</div>
                        <div class="text-gray-500">Expedition MBDI Inc.</div>
                    </div>
                </div>

                <!-- Checked By -->
                <div class="space-y-6">
                    <span class="font-bold text-gray-700 block">Checked by:</span>
                    <div>
                        <div class="font-bold underline text-gray-900">MR. NHOLL GREAL O. LOZADA</div>
                        <div class="text-gray-600">Inventory/Warehouseman Supervisor</div>
                        <div class="text-gray-500">Mine Explosive Dept.</div>
                    </div>
                </div>

                <!-- Certified Correct By -->
                <div class="space-y-6">
                    <span class="font-bold text-gray-700 block">Certified Correct by:</span>
                    <div>
                        <div class="font-bold underline text-gray-900">ENGR. EDWIN B. BATAL</div>
                        <div class="text-gray-600">Mine Explosives Asst. Manager</div>
                    </div>
                </div>

            </div>
        </div>

    </div>
    @endforeach

</div>
@endsection

@push('scripts')
<script type="module">

</script>
@endpush