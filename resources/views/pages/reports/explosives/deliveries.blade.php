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
                <h3 class="font-bold tracking-wider uppercase text-lg" id="reportModalTitle">SUMMARY OF EXPLOSIVE PURCHASED</h3>
                <p class="text-sm text-brand-gold font-medium" id="reportModalDateRange">MAY 1–31, 2026</p>
            </div>
        </div>

        <!-- Scrollable Matrix Grid -->
        <div class="p-4 overflow-auto flex-1">
            <table class="w-full border-collapse border border-gray-400 text-xs text-center font-medium">
                <!-- Multi-Tier Header Structure -->
                <thead class="bg-emerald-50/70 text-gray-800 uppercase tracking-tight sticky top-0 z-20 shadow-xs">
                    
                    <tr class="bg-gray-100/80">
                        <th class="border border-gray-400 p-2 font-bold text-brand-navy min-w-50" rowspan="6">Date</th>
                        <th class="border border-gray-400 p-1 font-bold text-brand-navy" colspan="2">Mt. Rock</th>
                        <th class="border border-gray-400 p-1 font-bold text-brand-navy" colspan="2">Expedition</th>
                        <th class="border border-gray-400 p-1 font-bold text-brand-navy">Expedition</th>
                        <th class="border border-gray-400 p-1 font-bold text-brand-navy">Mt. Rock</th>
                        <th class="border border-gray-400 p-1 font-bold text-brand-navy" colspan="2">Mt. Rock</th>
                        <th class="border border-gray-400 p-1 font-bold text-brand-navy" colspan="3">Expedition</th>
                        <th class="border border-gray-400 p-1 font-bold text-brand-navy">Expedition</th>
                        <th class="border border-gray-400 p-1 font-bold text-brand-navy">Mt. Rock</th>
                        <th class="border border-gray-400 p-1 font-bold text-brand-navy">Expedition</th>
                        <th class="border border-gray-400 p-1 font-bold text-brand-navy">Mt. Rock</th>
                        <th class="border border-gray-400 p-1 font-bold text-brand-navy" colspan="5">Expedition</th>
                        <th class="border border-gray-400 p-1 font-bold text-brand-navy">Mt. Rock</th>
                        <th class="border border-gray-400 p-1 font-bold text-brand-navy" colspan="3">Expedition</th>
                    </tr>
                    <!-- Tier 1: Supplier Grouping -->
                    <tr class="bg-gray-100/80">
                        <th class="border border-gray-400 p-1" colspan="4">Package Emulsion</th>
                        <th class="border border-gray-400 p-1" colspan="2" rowspan="3">Anfo</th>
                        <th class="border border-gray-400 p-1" colspan="9">Detonators</th>
                        <th class="border border-gray-400 p-1" colspan="4">Detonating Cord</th>
                        <th class="border border-gray-400 p-1" colspan="2" rowspan="3">Safety Fuse</th>
                        <th class="border border-gray-400 p-1" rowspan="3">Bill Wire</th>
                        <th class="border border-gray-400 p-1" colspan="2" rowspan="3">Fuse Lighter</th>
                    </tr>

                    <!-- Tier 2: Product Name / Specification -->
                    <tr class="bg-gray-100/80">
                        <th class="border border-gray-400 p-1" colspan="2">200</th>
                        <th class="border border-gray-400 p-1" colspan="2">215</th>
                        <th class="border border-gray-400 p-1" colspan="2">SUPREME</th>
                        <th class="border border-gray-400 p-1" colspan="3">EXEL</th>
                        <th class="border border-gray-400 p-1" colspan="2" rowspan="2">OBC</th>
                        <th class="border border-gray-400 p-1" colspan="2" rowspan="2">EBC</th>
                        <th class="border border-gray-400 p-1" colspan="4">Cordtex</th>
                    </tr>
                    <tr class="bg-gray-100/80">
                        <th class="border border-gray-400 p-1" colspan="2">Neogel</th>
                        <th class="border border-gray-400 p-1" colspan="2">Senatel/Pulsar</th>
                        <th class="border border-gray-400 p-1">2.4</th>
                        <th class="border border-gray-400 p-1">3.6</th>
                        <th class="border border-gray-400 p-1">3.6</th>
                        <th class="border border-gray-400 p-1">2.4</th>
                        <th class="border border-gray-400 p-1">4.9</th>
                        <th class="border border-gray-400 p-1">5</th>
                        <th class="border border-gray-400 p-1">10</th>
                        <th class="border border-gray-400 p-1">DCORD 15</th>
                        <th class="border border-gray-400 p-1">40</th>
                    </tr>
                    <tr class="bg-gray-100/80">
                        <th class="border border-gray-400 p-1" colspan="2">35245</th>
                        <th class="border border-gray-400 p-1" colspan="2">11082</th>
                        <th class="border border-gray-400 p-1" colspan="2">10128</th>
                        <th class="border border-gray-400 p-1">16623</th>
                        <th class="border border-gray-400 p-1">16967</th>
                        <th class="border border-gray-400 p-1">10966</th>
                        <th class="border border-gray-400 p-1">10965</th>
                        <th class="border border-gray-400 p-1">21809</th>
                        <th class="border border-gray-400 p-1" colspan="2">11966</th>
                        <th class="border border-gray-400 p-1" colspan="2">11089</th>
                        <th class="border border-gray-400 p-1">10960</th>
                        <th class="border border-gray-400 p-1">10961</th>
                        <th class="border border-gray-400 p-1">33442</th>
                        <th class="border border-gray-400 p-1">10959</th>
                        <th class="border border-gray-400 p-1" colspan="2">12487</th>
                        <th class="border border-gray-400 p-1">16823</th>
                        <th class="border border-gray-400 p-1">11342</th>
                        <th class="border border-gray-400 p-1">11342</th>
                    </tr>

                    <!-- Tier 3: Units of Measurement (UoM) -->
                    <tr class="bg-gray-100/80 text-gray-600 font-bold">
                        <th class="border border-gray-400 p-1 w-20">Pcs</th>
                        <th class="border border-gray-400 p-1 w-20">Kls</th>
                        <th class="border border-gray-400 p-1 w-20">Pcs</th>
                        <th class="border border-gray-400 p-1 w-20">Kls</th>
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
                        <th class="border border-gray-400 p-1 w-20">Mtrs</th>
                        <th class="border border-gray-400 p-1 w-20">Pcs</th>
                        <th class="border border-gray-400 p-1 w-20">Pcs</th>
                    </tr>
                </thead>


                <!-- Dynamic/Populated Row Structure -->
                <tbody id="rcsuModalTableBody" class="divide-y divide-gray-200 text-gray-800">
                    
                    <!-- First Purchase -->
                    <tr class="bg-white">
                        <td class="border border-gray-400 p-2 font-bold">May 20, 2026</td>
                        <td class="border border-gray-400 p-1">20,000</td>
                        <td class="border border-gray-400 p-1">2,500</td>
                        <td class="border border-gray-400 p-1">21,500</td>
                        <td class="border border-gray-400 p-1">2,500</td>
                        <td class="border border-gray-400 p-1">8750</td>
                        <td class="border border-gray-400 p-1">0</td>
                        <td class="border border-gray-400 p-1"></td>
                        <td class="border border-gray-400 p-1"></td>
                        <td class="border border-gray-400 p-1"></td>
                        <td class="border border-gray-400 p-1">25,500</td>
                        <td class="border border-gray-400 p-1"></td>
                        <td class="border border-gray-400 p-1">1,500</td>
                        <td class="border border-gray-400 p-1">1,500</td>
                        <td class="border border-gray-400 p-1">40</td>
                        <td class="border border-gray-400 p-1">40</td>
                        <td class="border border-gray-400 p-1">2,700</td>
                        <td class="border border-gray-400 p-1">3,000</td>
                        <td class="border border-gray-400 p-1"></td>
                        <td class="border border-gray-400 p-1"></td>
                        <td class="border border-gray-400 p-1">4,000</td>
                        <td class="border border-gray-400 p-1"></td>
                        <td class="border border-gray-400 p-1"></td>
                        <td class="border border-gray-400 p-1"></td>
                        <td class="border border-gray-400 p-1"></td>
                    </tr>

                    <!-- Second Purchase -->
                    <tr class="bg-white">
                        <td class="border border-gray-400 p-2 font-bold">May 26, 2026</td>
                        <td class="border border-gray-400 p-1">15,000</td>
                        <td class="border border-gray-400 p-1">1,875</td>
                        <td class="border border-gray-400 p-1">16,125</td>
                        <td class="border border-gray-400 p-1">1,875</td>
                        <td class="border border-gray-400 p-1">8,750</td>
                        <td class="border border-gray-400 p-1">0</td>
                        <td class="border border-gray-400 p-1"></td>
                        <td class="border border-gray-400 p-1"></td>
                        <td class="border border-gray-400 p-1"></td>
                        <td class="border border-gray-400 p-1">6,000</td>
                        <td class="border border-gray-400 p-1"></td>
                        <td class="border border-gray-400 p-1">1,000</td>
                        <td class="border border-gray-400 p-1">1,000</td>
                        <td class="border border-gray-400 p-1"></td>
                        <td class="border border-gray-400 p-1"></td>
                        <td class="border border-gray-400 p-1">2,700</td>
                        <td class="border border-gray-400 p-1">3,000</td>
                        <td class="border border-gray-400 p-1"></td>
                        <td class="border border-gray-400 p-1"></td>
                        <td class="border border-gray-400 p-1">4,000</td>
                        <td class="border border-gray-400 p-1"></td>
                        <td class="border border-gray-400 p-1"></td>
                        <td class="border border-gray-400 p-1"></td>
                        <td class="border border-gray-400 p-1"></td>
                    </tr>


                    <!-- Total -->
                    <tr class="bg-emerald-100 font-bold text-brand-dark">
                        <td class="border border-gray-400 p-2 font-bold">Total</td>
                        <td class="border border-gray-400 p-1">35,000</td>
                        <td class="border border-gray-400 p-1">4,375</td>
                        <td class="border border-gray-400 p-1">37,625</td>
                        <td class="border border-gray-400 p-1">4,375</td>
                        <td class="border border-gray-400 p-1">17,500</td>
                        <td class="border border-gray-400 p-1">0</td>
                        <td class="border border-gray-400 p-1">0</td>
                        <td class="border border-gray-400 p-1">0</td>
                        <td class="border border-gray-400 p-1">0</td>
                        <td class="border border-gray-400 p-1">31,500</td>
                        <td class="border border-gray-400 p-1">0</td>
                        <td class="border border-gray-400 p-1">2,500</td>
                        <td class="border border-gray-400 p-1">2,500</td>
                        <td class="border border-gray-400 p-1">40</td>
                        <td class="border border-gray-400 p-1">40</td>
                        <td class="border border-gray-400 p-1">5,400</td>
                        <td class="border border-gray-400 p-1">6,000</td>
                        <td class="border border-gray-400 p-1">0</td>
                        <td class="border border-gray-400 p-1">0</td>
                        <td class="border border-gray-400 p-1">8,000</td>
                        <td class="border border-gray-400 p-1">0</td>
                        <td class="border border-gray-400 p-1">0</td>
                        <td class="border border-gray-400 p-1">0</td>
                        <td class="border border-gray-400 p-1">0</td>
                    </tr>

                    <!-- Grand Total -->
                    <tr class="bg-gray-100 font-bold text-brand-dark">
                        <td class="border border-gray-400 p-2 font-bold">GRAND TOTAL</td>
                        <td class="border border-gray-400 p-1">35,000</td>
                        <td class="border border-gray-400 p-1">4,375</td>
                        <td class="border border-gray-400 p-1">37,625</td>
                        <td class="border border-gray-400 p-1">4,375</td>
                        <td class="border border-gray-400 p-1"colspan="2">17,500</td>
                        <td class="border border-gray-400 p-1">0</td>
                        <td class="border border-gray-400 p-1">0</td>
                        <td class="border border-gray-400 p-1">0</td>
                        <td class="border border-gray-400 p-1">31,500</td>
                        <td class="border border-gray-400 p-1">0</td>
                        <td class="border border-gray-400 p-1" colspan="2">5,000</td>
                        <td class="border border-gray-400 p-1" colspan="2">80</td>
                        <td class="border border-gray-400 p-1">5,400</td>
                        <td class="border border-gray-400 p-1">6,000</td>
                        <td class="border border-gray-400 p-1">0</td>
                        <td class="border border-gray-400 p-1">0</td>
                        <td class="border border-gray-400 p-1" colspan="2">8,000</td>
                        <td class="border border-gray-400 p-1">0</td>
                        <td class="border border-gray-400 p-1" colspan="2">0</td>
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