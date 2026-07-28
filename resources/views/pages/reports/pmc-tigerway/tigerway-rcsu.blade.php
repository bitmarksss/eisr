@extends('layouts.app')

@section('page-title', 'Tigerway RCSU Report')

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
                    <input type="date" name="date" value="{{ request('date') }}"
                                class="w-70 bg-gray-50 border border-gray-300 text-brand-dark text-sm rounded-lg pl-3 pr-3 py-2 focus:border-brand-gold focus:outline-none focus:ring-2 focus:ring-brand-gold/20 transition">
                </div>
            </form>
            
            <button type="button" class="px-4 py-2 rounded-lg bg-brand-green hover:bg-brand-green-hover active:translate-y-0.5 text-white text-sm font-bold transition cursor-pointer flex items-center gap-1.5">
                <i class="fa-solid fa-file-excel text-white"></i>
                Export
            </button>
        </div>
    </div>



    <div class="relative bg-white w-full max-w-[98vw] rounded-xl shadow-2xl border border-gray-200 overflow-hidden transform transition-all z-110 flex flex-col max-h-[92vh]">
        
        <!-- Header Strip -->
        <div class="px-6 py-4 bg-brand-green text-white flex justify-between items-center shrink-0">
            <div>
                <h3 class="font-bold tracking-wider uppercase text-lg" id="reportModalTitle">EXPLOSIVES WEEKLY CONSUMPTION</h3>
                <p class="text-sm text-brand-gold font-medium" id="reportModalDateRange">JUNE 1–7, 2026</p>
            </div>
        </div>

        <!-- Scrollable Matrix Grid -->
        <div class="p-4 overflow-auto flex-1">
            <table class="w-full border-collapse border border-gray-300 text-xs text-center font-medium">
                <!-- Multi-Tier Header Structure -->
                <thead class="bg-emerald-50/70 text-gray-800 uppercase tracking-tight sticky top-0 z-20 shadow-xs">
                    
                    <tr class="bg-gray-100/80">
                        <th class="border border-gray-300 p-1 font-bold text-brand-navy" colspan="2">SUPPLIER</th>
                        <th class="border border-gray-300 p-1 font-bold text-brand-navy" colspan="16">Mt. Rock</th>
                    </tr>
                    <!-- Tier 1: Supplier Grouping -->
                    <tr class="bg-gray-100/80">
                        <th class="border border-gray-300 p-2 sticky left-0 z-30" rowspan="5">Date</th>
                        <th class="border border-gray-300 p-2 sticky z-30" rowspan="5">Description</th>
                    </tr>

                    <!-- Tier 2: Product Name / Specification -->
                    <tr class="bg-gray-100/80">
                        <th class="border border-gray-300 p-1" colspan="2">NEO PRIME</th>
                        <th class="border border-gray-300 p-1" colspan="2">NEOGEL</th>
                        <th class="border border-gray-300 p-1" colspan="2">NEOGEL</th>
                        <th class="border border-gray-300 p-1">Anfo</th>
                        <th class="border border-gray-300 p-1">S/Fuse</th>
                        <th class="border border-gray-300 p-1">OBC</th>
                        <th class="border border-gray-300 p-1">SUPREME TLD</th>
                        <th class="border border-gray-300 p-1">SUPREME</th>
                        <th class="border border-gray-300 p-1">SUPREME</th>
                        <th class="border border-gray-300 p-1">RIONEL IHD</th>
                        <th class="border border-gray-300 p-1">NEOCORD</th>
                        <th class="border border-gray-300 p-1">DETCORD</th>
                        <th class="border border-gray-300 p-1">EBC</th>
                    </tr>
                    <tr class="bg-gray-100/80">
                        <th class="border border-gray-300 p-1" colspan="2"></th>
                        <th class="border border-gray-300 p-1" colspan="2">901</th>
                        <th class="border border-gray-300 p-1" colspan="2">901</th>
                        <th class="border border-gray-300 p-1"></th>
                        <th class="border border-gray-300 p-1"></th>
                        <th class="border border-gray-300 p-1"></th>
                        <th class="border border-gray-300 p-1">17/MS25MS/42MS</th>
                        <th class="border border-gray-300 p-1">2.4</th>
                        <th class="border border-gray-300 p-1">4.9</th>
                        <th class="border border-gray-300 p-1">500MS/6M</th>
                        <th class="border border-gray-300 p-1">10</th>
                        <th class="border border-gray-300 p-1">40</th>
                        <th class="border border-gray-300 p-1"></th>
                    </tr>
                    <tr class="bg-gray-100/80">
                        <th class="border border-gray-300 p-1" colspan="2">93</th>
                        <th class="border border-gray-300 p-1" colspan="2">91</th>
                        <th class="border border-gray-300 p-1" colspan="2">200</th>
                        <th class="border border-gray-300 p-1"></th>
                        <th class="border border-gray-300 p-1"></th>
                        <th class="border border-gray-300 p-1"></th>
                        <th class="border border-gray-300 p-1"></th>
                        <th class="border border-gray-300 p-1"></th>
                        <th class="border border-gray-300 p-1"></th>
                        <th class="border border-gray-300 p-1"></th>
                        <th class="border border-gray-300 p-1"></th>
                        <th class="border border-gray-300 p-1"></th>
                        <th class="border border-gray-300 p-1"></th>
                    </tr>

                    <!-- Tier 3: Units of Measurement (UoM) -->
                    <tr class="bg-gray-100/80 text-gray-600 font-bold">
                        <th class="border border-gray-300 p-1 w-20">Pcs</th>
                        <th class="border border-gray-300 p-1 w-20">Kls</th>
                        <th class="border border-gray-300 p-1 w-20">Pcs</th>
                        <th class="border border-gray-300 p-1 w-20">Kls</th>
                        <th class="border border-gray-300 p-1 w-20">Pcs</th>
                        <th class="border border-gray-300 p-1 w-20">Kls</th>
                        <th class="border border-gray-300 p-1 w-20">Kls</th>
                        <th class="border border-gray-300 p-1 w-20">Mtrs</th>
                        <th class="border border-gray-300 p-1 w-20">Pcs</th>
                        <th class="border border-gray-300 p-1 w-20">Mtrs</th>
                        <th class="border border-gray-300 p-1 w-20">Pcs</th>
                        <th class="border border-gray-300 p-1 w-20">Pcs</th>
                        <th class="border border-gray-300 p-1 w-20">Mtrs</th>
                        <th class="border border-gray-300 p-1 w-20">Mtrs</th>
                        <th class="border border-gray-300 p-1 w-20">Mtrs</th>
                        <th class="border border-gray-300 p-1 w-20">Pcs</th>
                    </tr>
                </thead>

                <!-- Dynamic/Populated Row Structure -->
                <tbody id="rcsuModalTableBody" class="divide-y divide-gray-200 text-gray-800">
                    
                    <!-- Beginning Balance Grouping -->
                    <tr class="bg-white">
                        <td class="border border-gray-300 p-2 font-bold bg-white sticky left-0 z-10">1-Jun-26</td>
                        <td class="border border-gray-300 p-2 font-bold text-left bg-white sticky z-10">Beginning Balance</td>
                        <!-- Dynamic values via JS -->
                        <td class="border border-gray-300 p-1">16,000</td>
                        <td class="border border-gray-300 p-1">5,084.74</td>
                        <td class="border border-gray-300 p-1">59,985</td>
                        <td class="border border-gray-300 p-1">12,344.4</td>
                        <td class="border border-gray-300 p-1">67,575.0</td>
                        <td class="border border-gray-300 p-1">13,600.00</td>
                        <td class="border border-gray-300 p-1">5,050</td>
                        <td class="border border-gray-300 p-1">180</td>
                        <td class="border border-gray-300 p-1">1,111.0</td>
                        <td class="border border-gray-300 p-1">18,796</td>
                        <td class="border border-gray-300 p-1">16,364.0</td>
                        <td class="border border-gray-300 p-1">12,660.0</td>
                        <td class="border border-gray-300 p-1">915</td>
                        <td class="border border-gray-300 p-1">90.0</td>
                        <td class="border border-gray-300 p-1">90.0</td>
                        <td class="border border-gray-300 p-1">90.0</td>
                    </tr>

                    <!-- Entry From Consignee -->
                    <tr class="bg-white">
                        <td class="border border-gray-300 p-1 font-semibold text-left bg-gray-50" colspan="2">Entry From Consignee Magazine</td>
                        <td class="border border-gray-300 p-1"></td>
                        <td class="border border-gray-300 p-1">0</td>
                        <td class="border border-gray-300 p-1">27,300</td>
                        <td class="border border-gray-300 p-1">7,500</td>
                        <td class="border border-gray-300 p-1"></td>
                        <td class="border border-gray-300 p-1">0</td>
                        <td class="border border-gray-300 p-1"></td>
                        <td class="border border-gray-300 p-1">980</td>
                        <td class="border border-gray-300 p-1">500</td>
                        <td class="border border-gray-300 p-1">150</td>
                        <td class="border border-gray-300 p-1"></td>
                        <td class="border border-gray-300 p-1">6,820</td>
                        <td class="border border-gray-300 p-1">155</td>
                        <td class="border border-gray-300 p-1"></td>
                        <td class="border border-gray-300 p-1"></td>
                        <td class="border border-gray-300 p-1"></td>
                    </tr>

                    <!-- Total Stock On Hand Row -->
                    <tr class="bg-gray-100 font-bold">
                        <td class="border border-gray-300 p-2 text-left sticky bg-gray-100" colspan="2">Total Stock On Hand</td>
                        <td class="border border-gray-300 p-1">6,882</td>
                        <td class="border border-gray-300 p-1">1,850</td>
                        <td class="border border-gray-300 p-1">40,586</td>
                        <td class="border border-gray-300 p-1">11,150</td>
                        <td class="border border-gray-300 p-1">15,400</td>
                        <td class="border border-gray-300 p-1">1,925</td>
                        <td class="border border-gray-300 p-1">1,800</td>
                        <td class="border border-gray-300 p-1">1,710</td>
                        <td class="border border-gray-300 p-1">1,296</td>
                        <td class="border border-gray-300 p-1">150</td>
                        <td class="border border-gray-300 p-1">1,757</td>
                        <td class="border border-gray-300 p-1">17,567</td>
                        <td class="border border-gray-300 p-1">155</td>
                        <td class="border border-gray-300 p-1">7724</td>
                        <td class="border border-gray-300 p-1">3375</td>
                        <td class="border border-gray-300 p-1">96</td>
                    </tr>

                    <!-- Weekly Consumption Row -->
                    <tr class="bg-white font-bold">
                        <td class="border border-gray-300 p-2 text-left sticky bg-white" colspan="2">Less: Total Weekly Consumption</td>
                        <td class="border border-gray-300 p-1">651</td>
                        <td class="border border-gray-300 p-1">175</td>
                        <td class="border border-gray-300 p-1">182</td>
                        <td class="border border-gray-300 p-1">50</td>
                        <td class="border border-gray-300 p-1">0</td>
                        <td class="border border-gray-300 p-1">0</td>
                        <td class="border border-gray-300 p-1">125</td>
                        <td class="border border-gray-300 p-1">10</td>
                        <td class="border border-gray-300 p-1">10</td>
                        <td class="border border-gray-300 p-1">0</td>
                        <td class="border border-gray-300 p-1">0</td>
                        <td class="border border-gray-300 p-1">87</td>
                        <td class="border border-gray-300 p-1">0</td>
                        <td class="border border-gray-300 p-1">120</td>
                        <td class="border border-gray-300 p-1">150</td>
                        <td class="border border-gray-300 p-1">0</td>
                    </tr>

                    <!-- Remaining Stock Balance Row (Green highlighted footer row) -->
                    <tr class="bg-emerald-100 font-bold text-brand-dark">
                        <td class="border border-gray-300 p-2 sticky left-0 bg-emerald-100">07-Jun-26</td>
                        <td class="border border-gray-300 p-2 text-left sticky left-[100px] bg-emerald-100" colspan="2">Remaining Stock Balance</td>
                        <td class="border border-gray-300 p-1">16,284</td>
                        <td class="border border-gray-300 p-1">5,120</td>
                        <td class="border border-gray-300 p-1">91,653</td>
                        <td class="border border-gray-300 p-1">16,027</td>
                        <td class="border border-gray-300 p-1">73,567.02</td>
                        <td class="border border-gray-300 p-1">16,316.09</td>
                        <td class="border border-gray-300 p-1">6,163</td>
                        <td class="border border-gray-300 p-1">273</td>
                        <td class="border border-gray-300 p-1">1,111</td>
                        <td class="border border-gray-300 p-1">48,481</td>
                        <td class="border border-gray-300 p-1">16,364</td>
                        <td class="border border-gray-300 p-1">19,505</td>
                        <td class="border border-gray-300 p-1">1,919</td>
                        <td class="border border-gray-300 p-1">306</td>
                        <td class="border border-gray-300 p-1">306</td>
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