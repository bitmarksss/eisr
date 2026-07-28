@extends('layouts.app')

@section('page-title', 'Explosive Delivery Report')

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
                    <label class="block text-xs font-semibold">Month:</label>
                    <select name="month" onchange="this.form.submit()" 
                        class="bg-gray-50 border border-gray-300 text-brand-dark text-sm rounded-lg p-2 focus:outline-none focus:border-brand-gold">
                        <option value=""> Select a month </option>
                        @foreach($months as $key => $month)
                            <option value="{{ $key }}" {{ request('month') == $key ? 'selected' : '' }}> {{ $month }} </option>
                        @endforeach
                    </select>
                </div>
            </form>
            
            <button type="button" class="px-4 py-2 rounded-lg bg-brand-green hover:bg-brand-green-hover active:translate-y-0.5 text-white text-sm font-bold transition cursor-pointer flex items-center gap-1.5">
                <i class="fa-solid fa-file-excel text-white"></i>
                Export
            </button>
        </div>
    </div>

    <div class="relative bg-white w-full max-w-[98vw] rounded-xl shadow-2xl border border-gray-200 overflow-hidden">
        
        <!-- Header Strip -->
        <div class="px-6 py-4 bg-brand-green text-white flex justify-between items-center shrink-0">
            <div>
                <h3 class="font-bold tracking-wider uppercase text-lg" id="reportModalTitle">RE: MOUNT ROCK POWDER EXPLOSIVES STOCK INVENTORY AS OF TODAY</h3>
                <p class="text-sm text-brand-gold font-medium" id="reportModalDateRange">NAMELY: DYNA,OBC,SAFETY FUSE, NON-ELEC LP 2.4, ANFO & DETCORD</p>
            </div>
        </div>

        <!-- Scrollable Matrix Grid -->
        <div class="grid grid-cols-1 md:grid-cols-5 gap-4">

            <!-- ITEMS -->
            <div class="col-span-3 p-4 overflow-auto flex-1">
                <table class="w-full border-collapse border border-gray-400 text-xs text-center font-medium">
                    <!-- Multi-Tier Header Structure -->
                    <thead class="bg-emerald-50/70 text-gray-800 uppercase tracking-tight sticky top-0 z-20 shadow-xs">
                        
                        <tr class="bg-gray-100/80 text-sm">
                            <th class="border border-gray-400 p-2 font-bold text-brand-navy min-w-50" rowspan="2">DESCRIPTION</th>
                            <th class="border border-gray-400 p-1 font-bold text-brand-navy" colspan="4">Quantity</th>
                            <th class="border border-gray-400 p-1 font-bold text-brand-navy" rowspan="2">Unit Price</th>
                            <th class="border border-gray-400 p-1 font-bold text-brand-navy" rowspan="2">Costing</th>
                        </tr>
                        <tr class="bg-gray-100/80 text-sm">
                            <th class="border border-gray-400 p-1">BOXES / SACKS</th>
                            <th class="border border-gray-400 p-1">PCS</th>
                            <th class="border border-gray-400 p-1">KLS</th>
                            <th class="border border-gray-400 p-1">METERS</th>
                        </tr>
                    </thead>

                    <!-- Dynamic/Populated Row Structure -->
                    <tbody id="rcsuModalTableBody" class="divide-y divide-gray-200 text-gray-800">
                        
                        <!-- Tier 1: Supplier Grouping -->
                        <tr class="bg-gray-100/80">
                            <th class="border border-gray-400 p-1 text-left">DYNA SUPERPOWER 208</th>
                            <td class="border border-gray-400 p-1"></td>
                            <td class="border border-gray-400 p-1"></td>
                            <td class="border border-gray-400 p-1">0.00</td>
                            <td class="border border-gray-400 p-1"></td>
                            <td class="border border-gray-400 p-1">29.45</td>
                            <td class="border border-gray-400 p-1 text-sm font-bold">0.00</td>
                        </tr>
                        
                        <tr class="bg-gray-100/80">
                            <th class="border border-gray-400 p-1 text-left">DYNA NEOGEL 200</th>
                            <td class="border border-gray-400 p-1">195</td>
                            <td class="border border-gray-400 p-1"></td>
                            <td class="border border-gray-400 p-1">39,000.00</td>
                            <td class="border border-gray-400 p-1"></td>
                            <td class="border border-gray-400 p-1">27.34</td>
                            <td class="border border-gray-400 p-1 text-sm font-bold">1,066,408.20</td>
                        </tr>
                        
                        <tr class="bg-gray-100/80">
                            <th class="border border-gray-400 p-1 text-left">ANFO</th>
                            <td class="border border-gray-400 p-1"></td>
                            <td class="border border-gray-400 p-1"></td>
                            <td class="border border-gray-400 p-1"></td>
                            <td class="border border-gray-400 p-1"></td>
                            <td class="border border-gray-400 p-1">155.50</td>
                            <td class="border border-gray-400 p-1 text-sm font-bold">0.00</td>
                        </tr>
                        
                        <tr class="bg-gray-100/80">
                            <th class="border border-gray-400 p-1 text-left">S/FUSE</th>
                            <td class="border border-gray-400 p-1"></td>
                            <td class="border border-gray-400 p-1"></td>
                            <td class="border border-gray-400 p-1"></td>
                            <td class="border border-gray-400 p-1"></td>
                            <td class="border border-gray-400 p-1">29.50</td>
                            <td class="border border-gray-400 p-1 text-sm font-bold">0.00</td>
                        </tr>
                        
                        <tr class="bg-gray-100/80">
                            <th class="border border-gray-400 p-1 text-left">OBC</th>
                            <td class="border border-gray-400 p-1"></td>
                            <td class="border border-gray-400 p-1"></td>
                            <td class="border border-gray-400 p-1"></td>
                            <td class="border border-gray-400 p-1"></td>
                            <td class="border border-gray-400 p-1">25.44642857</td>
                            <td class="border border-gray-400 p-1 text-sm font-bold">0.00</td>
                        </tr>
                        
                        <tr class="bg-gray-100/80">
                            <th class="border border-gray-400 p-1 text-left">SUPREME 2.4</th>
                            <td class="border border-gray-400 p-1">6</td>
                            <td class="border border-gray-400 p-1">2,160</td>
                            <td class="border border-gray-400 p-1"></td>
                            <td class="border border-gray-400 p-1"></td>
                            <td class="border border-gray-400 p-1">180.3571429</td>
                            <td class="border border-gray-400 p-1 text-sm font-bold">389,571.43</td>
                        </tr>
                        
                        <tr class="bg-gray-100/80">
                            <th class="border border-gray-400 p-1 text-left">EBC</th>
                            <td class="border border-gray-400 p-1">967</td>
                            <td class="border border-gray-400 p-1">120</td>
                            <td class="border border-gray-400 p-1"></td>
                            <td class="border border-gray-400 p-1"></td>
                            <td class="border border-gray-400 p-1">267.18</td>
                            <td class="border border-gray-400 p-1 text-sm font-bold">32.061.60</td>
                        </tr>
                        
                        <tr class="bg-gray-100/80">
                            <th class="border border-gray-400 p-1 text-left">CORDTEXT 10</th>
                            <td class="border border-gray-400 p-1"></td>
                            <td class="border border-gray-400 p-1"></td>
                            <td class="border border-gray-400 p-1"></td>
                            <td class="border border-gray-400 p-1"></td>
                            <td class="border border-gray-400 p-1">40.20</td>
                            <td class="border border-gray-400 p-1 text-sm font-bold">0.00</td>
                        </tr>

                        <!-- Total -->
                        <tr class="bg-emerald-100 text-lg font-bold text-brand-navy">
                            <th class="border border-gray-400 p-1 text-left" colspan="6">TOTAL COST</th>
                            <td class="border border-gray-400 p-1">1,488,041.23</td>
                        </tr>

                    </tbody>
                </table>
            </div>

            <!-- ITEMS -->
            <div class="col-span-2 p-4 overflow-auto flex-1">
                <table class="w-full border-collapse border border-gray-400 text-xs text-center font-medium">
                    <!-- Multi-Tier Header Structure -->
                    <thead class="bg-emerald-50/70 text-gray-800 uppercase tracking-tight sticky top-0 z-20 shadow-xs">
                        
                        <tr class="bg-gray-100/80 text-sm">
                            <th class="border border-gray-400 p-2 font-bold text-brand-navy min-w-50" rowspan="2">SUPREME 2.4m DELAY #</th>
                            <th class="border border-gray-400 p-1 font-bold text-brand-navy">MILL MAGAZINE</th>
                            <th class="border border-gray-400 p-1 font-bold text-brand-navy">Unit Price</th>
                            <th class="border border-gray-400 p-1 font-bold text-brand-navy">Costing</th>
                        </tr>
                        <tr class="bg-gray-100/80 text-sm">
                            <th class="border border-gray-400 p-1">PCS</th>
                            <th class="border border-gray-400 p-1"></th>
                            <th class="border border-gray-400 p-1"></th>
                        </tr>
                    </thead>

                    <!-- Dynamic/Populated Row Structure -->
                    <tbody id="rcsuModalTableBody" class="divide-y divide-gray-200 text-gray-800">
                        
                        @for($i = 1; $i <= 12; $i++)
                        <tr class="bg-gray-100/80">
                            <td class="border border-gray-400 p-1">{{$i}}</td>
                            @if($i == 12)
                                <td class="border border-gray-400 p-1">2,160</td>
                            @else
                                <td class="border border-gray-400 p-1">0</td>
                            @endif

                            <td class="border border-gray-400 p-1">202.00</td>
                            
                            
                            @if($i == 12)
                                <td class="border border-gray-400 p-1">436,320.00</td>
                            @else
                                <td class="border border-gray-400 p-1">0</td>
                            @endif
                        </tr>
                        @endfor
                        @for($i = 0; $i < 3; $i++)
                        <tr class="bg-gray-100/80">
                            <td class="border border-gray-400 p-1">{{$i + 12}}</td>
                            <td class="border border-gray-400 p-1">-</td>
                            <td class="border border-gray-400 p-1"></td>
                            <td class="border border-gray-400 p-1"></td>
                        </tr>
                        @endfor

                        <!-- Total -->
                        <tr class="bg-emerald-100 text-sm font-bold text-brand-navy">
                            <th class="border border-gray-400 p-1">TOTAL</th>
                            <td class="border border-gray-400 p-1">2,160.00</td>
                            <td class="border border-gray-400 p-1"></td>
                            <td class="border border-gray-400 p-1">436,320.00</td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

@endsection


@push('scripts')
<script type="module">

</script>
@endpush