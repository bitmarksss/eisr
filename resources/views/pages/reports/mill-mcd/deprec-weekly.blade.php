@extends('layouts.app')

@section('page-title', 'Weekly Explosives Consumption Report')

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



    
    <div class="relative bg-white w-full rounded-xl shadow-2xl border border-gray-200 overflow-hidden">
        
        <!-- Header Strip -->
        <div class="px-6 py-4 bg-brand-green text-white flex justify-between items-center shrink-0">
            <div>
                <h3 class="font-bold tracking-wider uppercase text-lg" id="summaryModalTitle">Explosive Weekly Consumption Summary</h3>
                <p class="text-xs text-brand-gold font-medium" id="summaryModalDateRange">MAY 31–JUNE 6, 2026</p>
            </div>
        </div>

        <!-- Scrollable Matrix Viewport -->
        <div class="p-4 overflow-auto flex-1">
            <table class="w-full border-collapse border border-gray-300 text-xs text-center font-medium">
                
                <!-- 5-Tier Column Headers -->
                <thead class="bg-gray-50 text-gray-800 uppercase tracking-tight sticky top-0 z-20 shadow-xs">
                    
                    <!-- Tier 1: Supplier -->
                    <tr class="bg-gray-100 font-bold text-brand-navy">
                        <th class="border border-gray-300 p-2 min-w-[50px] bg-gray-200 sticky z-30" colspan="2" rowspan="">Supplier</th>
                        <th class="border border-gray-300 p-1" colspan="2">Mt. Rock</th>
                        <th class="border border-gray-300 p-1" colspan="2">Expedition</th>
                        <th class="border border-gray-300 p-1">Mt Rock / Expedition</th>
                        <th class="border border-gray-300 p-1" colspan="3">Mt. Rock</th>
                        <th class="border border-gray-300 p-1" colspan="2">Expedition</th>
                        <th class="border border-gray-300 p-1"></th>
                        <th class="border border-gray-300 p-1" colspan="2">Mt Rock / Expedition</th>
                        <th class="border border-gray-300 p-1">Expedition</th>
                        <th class="border border-gray-300 p-1" colspan="2">Mt. Rock</th>
                        <th class="border border-gray-300 p-1">Mt Rock / Expedition</th>
                        <th class="border border-gray-300 p-1">Mt. Rock</th>
                        <th class="border border-gray-300 p-1">Expedition</th>
                    </tr>

                    <!-- Tier 2: Category -->
                    <tr class="bg-slate-100/80 font-bold text-gray-700">
                        <th class="border border-gray-300 p-2 min-w-[50px] bg-gray-200 sticky left-0 z-30" rowspan="5">Date</th>
                        <th class="border border-gray-300 p-2 min-w-[50px] bg-gray-200 sticky z-30" rowspan="5">Description</th>
                        <th class="border border-gray-300 p-1" colspan="4">Package Emulsion</th>
                        <th class="border border-gray-300 p-1" rowspan="3">Anfo</th>
                        <th class="border border-gray-300 p-1" colspan="8">Detonators</th>
                        <th class="border border-gray-300 p-1" colspan="3">Detonating Cord</th>
                        <th class="border border-gray-300 p-1"></th>
                        <th class="border border-gray-300 p-1"></th>
                        <th class="border border-gray-300 p-1"></th>
                    </tr>

                    <!-- Tier 3: Model / Specification -->
                    <tr class="bg-gray-50">
                        <th class="border border-gray-300 p-1" colspan="2">200</th>
                        <th class="border border-gray-300 p-1" colspan="2">215</th>
                        <th class="border border-gray-300 p-1" colspan="2">Nonel</th>
                        <th class="border border-gray-300 p-1 font-bold">Supreme</th>
                        <th class="border border-gray-300 p-1 font-bold" colspan="3">Exel</th>
                        <th class="border border-gray-300 p-1">OBC</th>
                        <th class="border border-gray-300 p-1">EBC</th>
                        <th class="border border-gray-300 p-1">Cordtex</th>
                        <th class="border border-gray-300 p-1">Cordtex</th>
                        <th class="border border-gray-300 p-1">Cordtex</th>
                        <th class="border border-gray-300 p-1">S/Fuse</th>
                        <th class="border border-gray-300 p-1">Billwire</th>
                        <th class="border border-gray-300 p-1">Fuse</th>
                    </tr>

                    <!-- Tier 4: Brand & Specs -->
                    <tr class="bg-gray-50 text-[11px]">
                        <th class="border border-gray-300 p-1" colspan="2">Neogel</th>
                        <th class="border border-gray-300 p-1" colspan="2">Senatel/Pulsar</th>
                        <th class="border border-gray-300 p-1">2.4</th>
                        <th class="border border-gray-300 p-1">3.6</th>
                        <th class="border border-gray-300 p-1">2.4</th>
                        <th class="border border-gray-300 p-1">3.6</th>
                        <th class="border border-gray-300 p-1">2.4</th>
                        <th class="border border-gray-300 p-1">4.9</th>
                        <th class="border border-gray-300 p-1"></th>
                        <th class="border border-gray-300 p-1"></th>
                        <th class="border border-gray-300 p-1">5</th>
                        <th class="border border-gray-300 p-1">10</th>
                        <th class="border border-gray-300 p-1">40</th>
                        <th class="border border-gray-300 p-1"></th>
                        <th class="border border-gray-300 p-1"></th>
                        <th class="border border-gray-300 p-1">LIGHTER</th>
                    </tr>

                    <!-- Tier 5: Item Codes & UoM -->
                    <tr class="bg-gray-100 text-[10px] text-gray-600 font-bold">
                        <th class="border border-gray-300 p-0.5 bg-gray-200/80" colspan="2">35245</th>
                        <th class="border border-gray-300 p-0.5 bg-gray-200/80" colspan="2">11082</th>
                        <th class="border border-gray-300 p-0.5 bg-gray-200/80">10128</th>
                        <th class="border border-gray-300 p-0.5 bg-gray-200/80">10962</th>
                        <th class="border border-gray-300 p-0.5 bg-gray-200/80">15427</th>
                        <th class="border border-gray-300 p-0.5 bg-gray-200/80">16623</th>
                        <th class="border border-gray-300 p-0.5 bg-gray-200/80">10966</th>
                        <th class="border border-gray-300 p-0.5 bg-gray-200/80">10965</th>
                        <th class="border border-gray-300 p-0.5 bg-gray-200/80">21809</th>
                        <th class="border border-gray-300 p-0.5 bg-gray-200/80">11966</th>
                        <th class="border border-gray-300 p-0.5 bg-gray-200/80">11089</th>
                        <th class="border border-gray-300 p-0.5 bg-gray-200/80">10960</th>
                        <th class="border border-gray-300 p-0.5 bg-gray-200/80">10961</th>
                        <th class="border border-gray-300 p-0.5 bg-gray-200/80">10959</th>
                        <th class="border border-gray-300 p-0.5 bg-gray-200/80">12487</th>
                        <th class="border border-gray-300 p-0.5 bg-gray-200/80">16823</th>
                        <th class="border border-gray-300 p-0.5 bg-gray-200/80">11342</th>
                    </tr>

                    <!-- Units Row -->
                    <tr class="bg-gray-200/90 text-gray-700 font-bold text-[11px]">
                        <th class="border border-gray-300 p-1 w-16">Pcs</th>
                        <th class="border border-gray-300 p-1 w-16">Kls</th>
                        <th class="border border-gray-300 p-1 w-16">Pcs</th>
                        <th class="border border-gray-300 p-1 w-16">Kls</th>
                        <th class="border border-gray-300 p-1 w-16">Kls</th>
                        <th class="border border-gray-300 p-1 w-14">Pcs</th>
                        <th class="border border-gray-300 p-1 w-14">Pcs</th>
                        <th class="border border-gray-300 p-1 w-14">Pcs</th>
                        <th class="border border-gray-300 p-1 w-14">Pcs</th>
                        <th class="border border-gray-300 p-1 w-14">Pcs</th>
                        <th class="border border-gray-300 p-1 w-14">Pcs</th>
                        <th class="border border-gray-300 p-1 w-14">Pcs</th>
                        <th class="border border-gray-300 p-1 w-14">Pcs</th>
                        <th class="border border-gray-300 p-1 w-16">Mtrs</th>
                        <th class="border border-gray-300 p-1 w-16">Mtrs</th>
                        <th class="border border-gray-300 p-1 w-16">Mtrs</th>
                        <th class="border border-gray-300 p-1 w-16">Mtrs</th>
                        <th class="border border-gray-300 p-1 w-16">Mtrs</th>
                        <th class="border border-gray-300 p-1 w-14">Pcs</th>
                    </tr>
                </thead>

                <!-- Vertical Data Matrix -->
                <tbody id="weeklySummaryTableBody" class="divide-y divide-gray-200 text-gray-800">
                    
                    <!-- Row 1: Physical Count -->
                    <tr class="bg-white">
                        <td class="border border-gray-300 p-2 font-bold bg-white sticky left-0 z-10">31-May-26</td>
                        <td class="border border-gray-300 p-2 font-semibold text-left bg-white sticky left-[90px] z-10">Based on Annual Physical Count</td>
                        <td class="border border-gray-300 p-1 font-bold">28,882</td>
                        <td class="border border-gray-300 p-1">3,610</td>
                        <td class="border border-gray-300 p-1 font-bold">101,880</td>
                        <td class="border border-gray-300 p-1">11,811</td>
                        <td class="border border-gray-300 p-1 font-bold">82,113</td>
                        <td class="border border-gray-300 p-1">264</td>
                        <td class="border border-gray-300 p-1">847</td>
                        <td class="border border-gray-300 p-1">16,364</td>
                        <td class="border border-gray-300 p-1">12,254</td>
                        <td class="border border-gray-300 p-1">47,869</td>
                        <td class="border border-gray-300 p-1">646</td>
                        <td class="border border-gray-300 p-1">7,558</td>
                        <td class="border border-gray-300 p-1">276</td>
                        <td class="border border-gray-300 p-1">10,608</td>
                        <td class="border border-gray-300 p-1">13,681</td>
                        <td class="border border-gray-300 p-1">1,060</td>
                        <td class="border border-gray-300 p-1">19,706</td>
                        <td class="border border-gray-300 p-1">1,945</td>
                        <td class="border border-gray-300 p-1">275</td>
                    </tr>

                    <!-- Row 2: Stock Withdrawals -->
                    <tr class="bg-white">
                        <td class="border border-gray-300 p-2 font-bold bg-white sticky left-0 z-10"></td>
                        <td class="border border-gray-300 p-2 text-left bg-white sticky left-[90px] z-10">Withdrawal of Stock from Main Magazine Mill</td>
                        <td class="border border-gray-300 p-1"></td>
                        <td class="border border-gray-300 p-1">0.00</td>
                        <td class="border border-gray-300 p-1"></td>
                        <td class="border border-gray-300 p-1">0.00</td>
                        <td class="border border-gray-300 p-1" colspan="15"></td>
                    </tr>

                    <!-- Row 3: Total On Hand -->
                    <tr class="bg-gray-100 font-bold">
                        <td class="border border-gray-300 p-2 sticky left-0 bg-gray-100"></td>
                        <td class="border border-gray-300 p-2 text-left sticky left-[90px] bg-gray-100">TOTAL ON HAND</td>
                        <td class="border border-gray-300 p-1">28,882</td>
                        <td class="border border-gray-300 p-1">3,610</td>
                        <td class="border border-gray-300 p-1">101,880</td>
                        <td class="border border-gray-300 p-1">11,810.70</td>
                        <td class="border border-gray-300 p-1">82,113.2</td>
                        <td class="border border-gray-300 p-1">264</td>
                        <td class="border border-gray-300 p-1">847</td>
                        <td class="border border-gray-300 p-1">16,364</td>
                        <td class="border border-gray-300 p-1">12,254</td>
                        <td class="border border-gray-300 p-1">47,869</td>
                        <td class="border border-gray-300 p-1">646</td>
                        <td class="border border-gray-300 p-1">7,558</td>
                        <td class="border border-gray-300 p-1">276</td>
                        <td class="border border-gray-300 p-1">10,608</td>
                        <td class="border border-gray-300 p-1">13,681</td>
                        <td class="border border-gray-300 p-1">1,060</td>
                        <td class="border border-gray-300 p-1">19,705.94</td>
                        <td class="border border-gray-300 p-1">1,945</td>
                        <td class="border border-gray-300 p-1">275</td>
                    </tr>

                    <!-- Row 4: Less Weekly Consumption -->
                    <tr class="bg-white font-semibold">
                        <td class="border border-gray-300 p-2 sticky left-0 bg-white"></td>
                        <td class="border border-gray-300 p-2 text-left sticky left-[90px] bg-white">Less: Total Weekly Consumption</td>
                        <td class="border border-gray-300 p-1">10,904</td>
                        <td class="border border-gray-300 p-1">1,363.00</td>
                        <td class="border border-gray-300 p-1">9,312</td>
                        <td class="border border-gray-300 p-1">1,082.79</td>
                        <td class="border border-gray-300 p-1">7,658.60</td>
                        <td class="border border-gray-300 p-1"></td>
                        <td class="border border-gray-300 p-1"></td>
                        <td class="border border-gray-300 p-1"></td>
                        <td class="border border-gray-300 p-1">591</td>
                        <td class="border border-gray-300 p-1">10,412</td>
                        <td class="border border-gray-300 p-1"></td>
                        <td class="border border-gray-300 p-1">1,250</td>
                        <td class="border border-gray-300 p-1">28</td>
                        <td class="border border-gray-300 p-1">2,431</td>
                        <td class="border border-gray-300 p-1">2,804</td>
                        <td class="border border-gray-300 p-1"></td>
                        <td class="border border-gray-300 p-1">3,037.50</td>
                        <td class="border border-gray-300 p-1">26</td>
                        <td class="border border-gray-300 p-1">2</td>
                    </tr>

                    <!-- Row 5: Stock Balance (Highlighted Green) -->
                    <tr class="bg-emerald-100/80 font-bold text-brand-dark">
                        <td class="border border-gray-300 p-2 sticky left-0 bg-emerald-100">06-Jun-26</td>
                        <td class="border border-gray-300 p-2 text-left sticky left-[90px] bg-emerald-100">STOCK BALANCE</td>
                        <td class="border border-gray-300 p-1">17,978</td>
                        <td class="border border-gray-300 p-1">2,247</td>
                        <td class="border border-gray-300 p-1">92,568</td>
                        <td class="border border-gray-300 p-1">10,727.91</td>
                        <td class="border border-gray-300 p-1">74,454.62</td>
                        <td class="border border-gray-300 p-1">264</td>
                        <td class="border border-gray-300 p-1">847</td>
                        <td class="border border-gray-300 p-1">16,364</td>
                        <td class="border border-gray-300 p-1">11,663</td>
                        <td class="border border-gray-300 p-1">37,457</td>
                        <td class="border border-gray-300 p-1">646</td>
                        <td class="border border-gray-300 p-1">6,308</td>
                        <td class="border border-gray-300 p-1">248</td>
                        <td class="border border-gray-300 p-1">8,177</td>
                        <td class="border border-gray-300 p-1">10,877</td>
                        <td class="border border-gray-300 p-1">1,060</td>
                        <td class="border border-gray-300 p-1">16,668.44</td>
                        <td class="border border-gray-300 p-1">1,919</td>
                        <td class="border border-gray-300 p-1">273</td>
                    </tr>

                    <!-- Row 6: Mine Mag. Stock Usable -->
                    <tr class="bg-gray-100 font-bold text-brand-navy">
                        <!-- <td class="border border-gray-300 p-2 sticky left-0 bg-gray-100"></td> -->
                        <td class="border border-gray-300 p-2 text-left sticky bg-gray-100"
                            colspan="2">MINE MAG. STOCK USABLE</td>
                        <td class="border border-gray-300 p-1">17,978</td>
                        <td class="border border-gray-300 p-1">2,247</td>
                        <td class="border border-gray-300 p-1">92,568</td>
                        <td class="border border-gray-300 p-1">10,727.91</td>
                        <td class="border border-gray-300 p-1">74,454.62</td>
                        <td class="border border-gray-300 p-1">264</td>
                        <td class="border border-gray-300 p-1">847</td>
                        <td class="border border-gray-300 p-1">16,364</td>
                        <td class="border border-gray-300 p-1">11,663</td>
                        <td class="border border-gray-300 p-1">37,457</td>
                        <td class="border border-gray-300 p-1">646</td>
                        <td class="border border-gray-300 p-1">6,308</td>
                        <td class="border border-gray-300 p-1">248</td>
                        <td class="border border-gray-300 p-1">8,177</td>
                        <td class="border border-gray-300 p-1">10,877</td>
                        <td class="border border-gray-300 p-1">1,060</td>
                        <td class="border border-gray-300 p-1">16,668.44</td>
                        <td class="border border-gray-300 p-1">1,919</td>
                        <td class="border border-gray-300 p-1">273</td>
                    </tr>
                </tbody>
            </table>
        </div>
x
    </div>

</div>

@endsection


@push('scripts')
<script type="module">

</script>
@endpush