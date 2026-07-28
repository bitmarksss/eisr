@extends('layouts.app')

@section('page-title', 'Explosive Monthly Report')

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
            <form method="GET" action="{{ route('reports.explosives.index', ['type' => $type]) }}" class="flex flex-wrap items-center gap-3 flex-1 w-full">

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



    <div class="relative bg-white w-full max-w-[98vw] rounded-xl shadow-2xl border border-gray-200 overflow-hidden transform transition-all z-110 flex flex-col max-h-[92vh]">
        
        <!-- Header Strip -->
        <div class="px-6 py-4 bg-brand-green text-white flex justify-between items-center shrink-0">
            <div>
                <h3 class="font-bold tracking-wider uppercase text-lg" id="reportModalTitle">EXPLOSIVES MONTHLY REPORT</h3>
                <p class="text-sm text-brand-gold font-medium" id="reportModalDateRange">MAY 1–31, 2026</p>
            </div>
        </div>

        <!-- Scrollable Matrix Grid -->
        <div class="p-4 overflow-auto flex-1">
            <table class="w-full border-collapse border border-gray-400 text-xs text-center font-medium">
                <!-- Multi-Tier Header Structure -->
                <thead class="bg-emerald-50/70 text-gray-800 uppercase tracking-tight sticky top-0 z-20 shadow-xs">
                    
                    <tr class="bg-gray-100/80">
                        <th class="border border-gray-400 p-2 font-bold text-brand-navy min-w-80" rowspan="7">Description</th>
                        <th class="border border-gray-400 p-1 font-bold text-brand-navy" colspan="2" rowspan="2">Mt. Rock</th>
                        <th class="border border-gray-400 p-1 font-bold text-brand-navy" colspan="2" rowspan="2">Expedition</th>
                        <th class="border border-gray-400 p-1 font-bold text-brand-navy">Mt. Rock</th>
                        <th class="border border-gray-400 p-1 font-bold text-brand-navy" colspan="4" rowspan="2">Mt. Rock</th>
                        <th class="border border-gray-400 p-1 font-bold text-brand-navy" colspan="3" rowspan="2">Expedition</th>
                        <th class="border border-gray-400 p-1 font-bold text-brand-navy" colspan="2">Mt. Rock</th>
                        <th class="border border-gray-400 p-1 font-bold text-brand-navy" rowspan="2">Expedition</th>
                        <th class="border border-gray-400 p-1 font-bold text-brand-navy" rowspan="2">Mt. Rock</th>
                        <th class="border border-gray-400 p-1 font-bold text-brand-navy" colspan="2" rowspan="2">Expedition</th>
                        <th class="border border-gray-400 p-1 font-bold text-brand-navy">Mt. Rock</th>
                        <th class="border border-gray-400 p-1 font-bold text-brand-navy" colspan="2" rowspan="2">Expedition</th>
                    </tr>
                    <!-- Tier 1: Supplier Grouping -->
                    <tr class="bg-gray-100/80">
                        <th class="border border-gray-400 p-1">Expedition</th>
                        <th class="border border-gray-400 p-1" colspan="2">Expedition</th>
                        <th class="border border-gray-400 p-1">Expedition</th>
                    </tr>
                    <!-- Tier 1: Supplier Grouping -->
                    <tr class="bg-gray-100/80">
                        <th class="border border-gray-400 p-1" colspan="4"></th>
                        <th class="border border-gray-400 p-1" rowspan="3">Anfo</th>
                        <th class="border border-gray-400 p-1" colspan="8">Detonators</th>
                        <th class="border border-gray-400 p-1" colspan="5">Detonating Cord</th>
                        <th class="border border-gray-400 p-1"></th>
                        <th class="border border-gray-400 p-1"></th>
                        <th class="border border-gray-400 p-1"></th>
                    </tr>

                    <!-- Tier 2: Product Name / Specification -->
                    <tr class="bg-gray-100/80">
                        <th class="border border-gray-400 p-1" colspan="2">200</th>
                        <th class="border border-gray-400 p-1" colspan="2">215</th>
                        <th class="border border-gray-400 p-1" colspan="2">NONEL</th>
                        <th class="border border-gray-400 p-1" colspan="2">SUPREME</th>
                        <th class="border border-gray-400 p-1" colspan="3">EXEL</th>
                        <th class="border border-gray-400 p-1">OBC</th>
                        <th class="border border-gray-400 p-1">EBC</th>
                        <th class="border border-gray-400 p-1" colspan="4">Cordtex</th>
                        <th class="border border-gray-400 p-1">S/Fuse</th>
                        <th class="border border-gray-400 p-1">Billwire</th>
                        <th class="border border-gray-400 p-1">FUSE</th>
                    </tr>
                    <tr class="bg-gray-100/80">
                        <th class="border border-gray-400 p-1" colspan="2">Neogel</th>
                        <th class="border border-gray-400 p-1" colspan="2">Senatel/Pulsar</th>
                        <th class="border border-gray-400 p-1">2.4</th>
                        <th class="border border-gray-400 p-1">3.6</th>
                        <th class="border border-gray-400 p-1">2.4</th>
                        <th class="border border-gray-400 p-1">3.6</th>
                        <th class="border border-gray-400 p-1">3.6</th>
                        <th class="border border-gray-400 p-1">2.4</th>
                        <th class="border border-gray-400 p-1">4.9</th>
                        <th class="border border-gray-400 p-1"></th>
                        <th class="border border-gray-400 p-1"></th>
                        <th class="border border-gray-400 p-1">5</th>
                        <th class="border border-gray-400 p-1">10</th>
                        <th class="border border-gray-400 p-1">15</th>
                        <th class="border border-gray-400 p-1">40</th>
                        <th class="border border-gray-400 p-1"></th>
                        <th class="border border-gray-400 p-1"></th>
                        <th class="border border-gray-400 p-1">LIGHTER</th>
                    </tr>
                    <tr class="bg-gray-100/80">
                        <th class="border border-gray-400 p-1" colspan="2">35245</th>
                        <th class="border border-gray-400 p-1" colspan="2">11082</th>
                        <th class="border border-gray-400 p-1">10128</th>
                        <th class="border border-gray-400 p-1">10962</th>
                        <th class="border border-gray-400 p-1">15427</th>
                        <th class="border border-gray-400 p-1">16623</th>
                        <th class="border border-gray-400 p-1">16967</th>
                        <th class="border border-gray-400 p-1">10966</th>
                        <th class="border border-gray-400 p-1">10965</th>
                        <th class="border border-gray-400 p-1">21809</th>
                        <th class="border border-gray-400 p-1">11966</th>
                        <th class="border border-gray-400 p-1">11089</th>
                        <th class="border border-gray-400 p-1">10960</th>
                        <th class="border border-gray-400 p-1">10961</th>
                        <th class="border border-gray-400 p-1">33442</th>
                        <th class="border border-gray-400 p-1">10959</th>
                        <th class="border border-gray-400 p-1">12487</th>
                        <th class="border border-gray-400 p-1">16823</th>
                        <th class="border border-gray-400 p-1">11342</th>
                    </tr>

                    <!-- Tier 3: Units of Measurement (UoM) -->
                    <tr class="bg-gray-100/80 text-gray-600 font-bold">
                        <th class="border border-gray-400 p-1 w-20">Pcs</th>
                        <th class="border border-gray-400 p-1 w-20">Kls</th>
                        <th class="border border-gray-400 p-1 w-20">Pcs</th>
                        <th class="border border-gray-400 p-1 w-20">Kls</th>
                        <th class="border border-gray-400 p-1 w-20">Kls</th>
                        <th class="border border-gray-400 p-1 w-20">Pcs</th>
                        <th class="border border-gray-400 p-1 w-20">Pcs</th>
                        <th class="border border-gray-400 p-1 w-20">Pcs</th>
                        <th class="border border-gray-400 p-1 w-20">Pcs</th>
                        <th class="border border-gray-400 p-1 w-20">Pcs</th>
                        <th class="border border-gray-400 p-1 w-20">Pcs</th>
                        <th class="border border-gray-400 p-1 w-20">Pcs</th>
                        <th class="border border-gray-400 p-1 w-20">Pcs</th>
                        <th class="border border-gray-400 p-1 w-20">Pcs</th>
                        <th class="border border-gray-400 p-1 w-20">Mtrs</th>
                        <th class="border border-gray-400 p-1 w-20">Mtrs</th>
                        <th class="border border-gray-400 p-1 w-20">Mtrs</th>
                        <th class="border border-gray-400 p-1 w-20">Mtrs</th>
                        <th class="border border-gray-400 p-1 w-20">Mtrs</th>
                        <th class="border border-gray-400 p-1 w-20">Mtrs</th>
                        <th class="border border-gray-400 p-1 w-20">Pcs</th>
                    </tr>
                </thead>

                <!-- Dynamic/Populated Row Structure -->
                <tbody id="rcsuModalTableBody" class="divide-y divide-gray-200 text-gray-800">
                    
                    <!-- Beginning Balance Grouping -->
                    <tr class="bg-white">
                        <td class="border border-gray-400 p-2 font-bold">Beginning Stocks as of May 1, 2026</td>
                        <td class="border border-gray-400 p-1">16,000</td>
                        <td class="border border-gray-400 p-1">5,084.74</td>
                        <td class="border border-gray-400 p-1">59,985</td>
                        <td class="border border-gray-400 p-1">12,344.4</td>
                        <td class="border border-gray-400 p-1">67,575.0</td>
                        <td class="border border-gray-400 p-1">13,600.00</td>
                        <td class="border border-gray-400 p-1">5,050</td>
                        <td class="border border-gray-400 p-1">180</td>
                        <td class="border border-gray-400 p-1">1,111.0</td>
                        <td class="border border-gray-400 p-1">18,796</td>
                        <td class="border border-gray-400 p-1">16,364.0</td>
                        <td class="border border-gray-400 p-1">12,660.0</td>
                        <td class="border border-gray-400 p-1">915</td>
                        <td class="border border-gray-400 p-1">90.0</td>
                        <td class="border border-gray-400 p-1">90.0</td>
                        <td class="border border-gray-400 p-1">90.0</td>
                        <td class="border border-gray-400 p-1">90.0</td>
                        <td class="border border-gray-400 p-1">90.0</td>
                        <td class="border border-gray-400 p-1">90.0</td>
                        <td class="border border-gray-400 p-1">90.0</td>
                        <td class="border border-gray-400 p-1">90.0</td>
                    </tr>

                    <!-- Entry From Consignee -->
                    <tr class="bg-white">
                        <td class="border border-gray-400 p-2 font-bold">THIS MONTH WITHDRAWAL</td>
                        <td class="border border-gray-400 p-1"></td>
                        <td class="border border-gray-400 p-1">0</td>
                        <td class="border border-gray-400 p-1">27,300</td>
                        <td class="border border-gray-400 p-1">7,500</td>
                        <td class="border border-gray-400 p-1"></td>
                        <td class="border border-gray-400 p-1">0</td>
                        <td class="border border-gray-400 p-1"></td>
                        <td class="border border-gray-400 p-1">980</td>
                        <td class="border border-gray-400 p-1">500</td>
                        <td class="border border-gray-400 p-1">150</td>
                        <td class="border border-gray-400 p-1"></td>
                        <td class="border border-gray-400 p-1">6,820</td>
                        <td class="border border-gray-400 p-1">155</td>
                        <td class="border border-gray-400 p-1"></td>
                        <td class="border border-gray-400 p-1"></td>
                        <td class="border border-gray-400 p-1"></td>
                        <td class="border border-gray-400 p-1"></td>
                        <td class="border border-gray-400 p-1"></td>
                        <td class="border border-gray-400 p-1"></td>
                        <td class="border border-gray-400 p-1"></td>
                        <td class="border border-gray-400 p-1"></td>
                    </tr>

                    <!-- Total Stock On Hand Row -->
                    <tr class="bg-gray-100 font-bold">
                        <td class="border border-gray-400 p-2 font-bold">Total Stock on Hand</td>
                        <td class="border border-gray-400 p-1">6,882</td>
                        <td class="border border-gray-400 p-1">1,850</td>
                        <td class="border border-gray-400 p-1">40,586</td>
                        <td class="border border-gray-400 p-1">11,150</td>
                        <td class="border border-gray-400 p-1">15,400</td>
                        <td class="border border-gray-400 p-1">1,925</td>
                        <td class="border border-gray-400 p-1">1,800</td>
                        <td class="border border-gray-400 p-1">1,710</td>
                        <td class="border border-gray-400 p-1">1,296</td>
                        <td class="border border-gray-400 p-1">150</td>
                        <td class="border border-gray-400 p-1">1,757</td>
                        <td class="border border-gray-400 p-1">17,567</td>
                        <td class="border border-gray-400 p-1">155</td>
                        <td class="border border-gray-400 p-1">7724</td>
                        <td class="border border-gray-400 p-1">3375</td>
                        <td class="border border-gray-400 p-1">96</td>
                        <td class="border border-gray-400 p-1">96</td>
                        <td class="border border-gray-400 p-1">96</td>
                        <td class="border border-gray-400 p-1">96</td>
                        <td class="border border-gray-400 p-1">96</td>
                        <td class="border border-gray-400 p-1">96</td>
                    </tr>

                    <!-- Weekly Consumption Row -->
                    <tr class="bg-white font-bold">
                        <td class="border border-gray-400 p-2 font-bold">Less: MONTHLY CONSUMPTION</td>
                        <td class="border border-gray-400 p-1">651</td>
                        <td class="border border-gray-400 p-1">175</td>
                        <td class="border border-gray-400 p-1">182</td>
                        <td class="border border-gray-400 p-1">50</td>
                        <td class="border border-gray-400 p-1">0</td>
                        <td class="border border-gray-400 p-1">0</td>
                        <td class="border border-gray-400 p-1">125</td>
                        <td class="border border-gray-400 p-1">10</td>
                        <td class="border border-gray-400 p-1">10</td>
                        <td class="border border-gray-400 p-1">0</td>
                        <td class="border border-gray-400 p-1">0</td>
                        <td class="border border-gray-400 p-1">87</td>
                        <td class="border border-gray-400 p-1">0</td>
                        <td class="border border-gray-400 p-1">120</td>
                        <td class="border border-gray-400 p-1">150</td>
                        <td class="border border-gray-400 p-1">0</td>
                        <td class="border border-gray-400 p-1">0</td>
                        <td class="border border-gray-400 p-1">0</td>
                        <td class="border border-gray-400 p-1">0</td>
                        <td class="border border-gray-400 p-1">0</td>
                        <td class="border border-gray-400 p-1">0</td>
                    </tr>

                    <!-- Remaining Stock Balance Row (Green highlighted footer row) -->
                    <tr class="bg-emerald-100 font-bold text-brand-dark">
                        <td class="border border-gray-400 p-2 font-bold">Remaining Stocks as of May 31, 2026</td>
                        <td class="border border-gray-400 p-1">16,284</td>
                        <td class="border border-gray-400 p-1">5,120</td>
                        <td class="border border-gray-400 p-1">91,653</td>
                        <td class="border border-gray-400 p-1">16,027</td>
                        <td class="border border-gray-400 p-1">73,567.02</td>
                        <td class="border border-gray-400 p-1">16,316.09</td>
                        <td class="border border-gray-400 p-1">6,163</td>
                        <td class="border border-gray-400 p-1">273</td>
                        <td class="border border-gray-400 p-1">1,111</td>
                        <td class="border border-gray-400 p-1">48,481</td>
                        <td class="border border-gray-400 p-1">16,364</td>
                        <td class="border border-gray-400 p-1">19,505</td>
                        <td class="border border-gray-400 p-1">1,919</td>
                        <td class="border border-gray-400 p-1">306</td>
                        <td class="border border-gray-400 p-1">306</td>
                        <td class="border border-gray-400 p-1">306</td>
                        <td class="border border-gray-400 p-1">306</td>
                        <td class="border border-gray-400 p-1">306</td>
                        <td class="border border-gray-400 p-1">306</td>
                        <td class="border border-gray-400 p-1">306</td>
                        <td class="border border-gray-400 p-1">306</td>
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