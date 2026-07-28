@extends('layouts.app')

@section('page-title', 'Explosives Receipts & Disposition Report')

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
        <div class="flex flex-wrap justify-between items-center w-full">
            
            <!-- Search and Filters -->
            <form method="GET" action="{{ route('reports.mgb.index', ['type' => $type]) }}" class="flex flex-wrap items-center gap-3 flex-1 w-full">

                <!-- Month Filter -->
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
                
                <!-- Location Filter -->
                <div class="space-y-1">
                    <label class="block text-xs font-semibold">Location:</label>
                    <select name="location" onchange="this.form.submit()" 
                        class="bg-gray-50 border border-gray-300 text-brand-dark text-sm rounded-lg p-2 focus:outline-none focus:border-brand-gold">
                        <option value=""> Select a location </option>
                        <option value="PMC" {{ request('location') == 'PMC' ? 'selected' : '' }}> 
                            PMC
                         </option>
                        <option value="EXPLO" {{ request('location') == 'EXPLO' ? 'selected' : '' }}> 
                            EXPLO
                         </option>
                        <option value="TIGERWAY" {{ request('location') == 'TIGERWAY' ? 'selected' : '' }}> 
                            TIGERWAY
                         </option>
                    </select>
                </div>
            </form>
            
            <button type="button" class="px-4 py-2 rounded-lg bg-brand-green hover:bg-brand-green-hover active:translate-y-0.5 text-white text-sm font-bold transition cursor-pointer flex items-center gap-1.5">
                <i class="fa-solid fa-file-excel text-white"></i>
                Export
            </button>
        </div>
    </div>

    <!-- Main Report Card -->
    <div class="relative bg-white w-full rounded-xl shadow-2xl border border-gray-200 overflow-hidden flex flex-col">
        
        <!-- Header Strip -->
        <div class="px-6 py-4 bg-brand-green text-white flex justify-between items-center shrink-0">
            <div>
                <h3 class="font-bold tracking-wider uppercase text-lg">Explosives Receipts & Disposition Report</h3>
                <p class="text-xs text-brand-gold font-medium">PMC- TIGERWAY DECLINE PROJECT (MPSA No. 262-2008-XIII PARCEL 1) &nbsp;|&nbsp; MAY 1-31, 2026</p>
            </div>
        </div>

        <!-- Scrollable Matrix Viewport -->
        <div class="p-4 overflow-auto flex-1">
            <table class="w-full border-collapse border border-gray-400 text-xs text-center font-medium">
                
                <!-- Multi-Tiered Header -->
                <thead class="bg-gray-50 text-gray-800 uppercase tracking-tight sticky top-0 z-20 shadow-xs">
                    
                    <!-- Tier 1: Top Major Category Groups -->
                    <tr class="bg-gray-100 font-bold text-gray-900 border-b border-gray-300">
                        <th class="border border-gray-400 p-2 min-w-[70px] bg-gray-200" rowspan="4">RECEIPTS</th>
                        <th class="border border-gray-400 p-2 min-w-[110px] bg-gray-200" rowspan="4">MAY 1-31,2026</th>
                        <th class="border border-gray-400 p-2 min-w-[180px] bg-gray-200" rowspan="4">NAME</th>
                        <th class="border border-gray-400 p-2 min-w-[120px] bg-gray-200" rowspan="4">ADDRESS</th>
                        <th class="border border-gray-400 p-2 min-w-[130px] bg-gray-200" rowspan="4">LICENSE NO.</th>
                        <th class="border border-gray-400 p-1.5" colspan="3">PACKAGE EMULSION</th>
                        <th class="border border-gray-400 p-1.5" rowspan="3">ANFO</th>
                        <th class="border border-gray-400 p-1.5" colspan="7">DETONATORS</th>
                        <th class="border border-gray-400 p-1.5" colspan="3">DETONATING CORD</th>
                        <th class="border border-gray-400 p-1.5" rowspan="3">SAFETY FUSE</th>
                        <th class="border border-gray-400 p-1.5" rowspan="3">BILL WIRE</th>
                        <th class="border border-gray-400 p-1.5" rowspan="3">FUSE LIGHTER</th>
                        <th class="border border-gray-400 p-1.5 min-w-[140px]">NAME OF PERSON</th>
                    </tr>

                    <!-- Tier 2: Specific Sub-Categories -->
                    <tr class="bg-gray-50 font-bold border-b border-gray-300">
                        <th class="border border-gray-400 p-1" colspan="2">NEOGEL 901</th>
                        <th class="border border-gray-400 p-1">NEO PRIME</th>
                        <th class="border border-gray-400 p-1" colspan="4">SUPREME</th>
                        <th class="border border-gray-400 p-1">RIONEL</th>
                        <th class="border border-gray-400 p-1" rowspan="2">OBC</th>
                        <th class="border border-gray-400 p-1" rowspan="2">EBC</th>
                        <th class="border border-gray-400 p-1" rowspan="2">NEOCORD 10 GRAMS</th>
                        <th class="border border-gray-400 p-1" rowspan="2">DETCORD 10 GRAMS</th>
                        <th class="border border-gray-400 p-1" rowspan="2">40 GRAMS</th>
                        <th class="border border-gray-400 p-1 font-bold">(LICENSE)</th>
                    </tr>

                    <!-- Tier 3: Model / Specs / Delivery Header -->
                    <tr class="bg-gray-50 text-[11px]">
                        <th class="border border-gray-400 p-1">91/CASE</th>
                        <th class="border border-gray-400 p-1">200/CASE</th>
                        <th class="border border-gray-400 p-1">93/CASE</th>
                        <th class="border border-gray-400 p-1">2.4</th>
                        <th class="border border-gray-400 p-1">4.9</th>
                        <th class="border border-gray-400 p-1">4.5</th>
                        <th class="border border-gray-400 p-1">TLD</th>
                        <th class="border border-gray-400 p-1">6</th>
                        <th class="border border-gray-400 p-1 font-bold">MAKING DELIVERY</th>
                    </tr>

                    <!-- Tier 5: Unit of Measures (UOM) -->
                    <tr class="bg-gray-200/90 text-gray-900 font-bold text-[10px]">
                        <th class="border border-gray-400 p-1">PIECES</th>
                        <th class="border border-gray-400 p-1">PIECES</th>
                        <th class="border border-gray-400 p-1">PIECES</th>
                        <th class="border border-gray-400 p-1">KILOS</th>
                        <th class="border border-gray-400 p-1">PIECES</th>
                        <th class="border border-gray-400 p-1">PIECES</th>
                        <th class="border border-gray-400 p-1">PIECES</th>
                        <th class="border border-gray-400 p-1">PIECES</th>
                        <th class="border border-gray-400 p-1">PIECES</th>
                        <th class="border border-gray-400 p-1">PIECES</th>
                        <th class="border border-gray-400 p-1">PIECES</th>
                        <th class="border border-gray-400 p-1">METERS</th>
                        <th class="border border-gray-400 p-1">METERS</th>
                        <th class="border border-gray-400 p-1">METERS</th>
                        <th class="border border-gray-400 p-1">METERS</th>
                        <th class="border border-gray-400 p-1">METERS</th>
                        <th class="border border-gray-400 p-1">PIECES</th>
                        <th class="border border-gray-400 p-1 bg-gray-200"></th>
                    </tr>
                </thead>

                <!-- Table Body -->
                <tbody class="divide-y divide-gray-300 text-gray-900">
                    
                    <!-- Row 1: Beginning Stock -->
                    <tr class="bg-rose-50/60 font-bold italic">
                        <td class="border border-gray-400 p-2 text-left bg-rose-50/80 sticky left-0 z-10" colspan="5">Beginning Stock as of May 1, 2026</td>
                        <td class="border border-gray-400 p-1">17,563</td>
                        <td class="border border-gray-400 p-1">15,400</td>
                        <td class="border border-gray-400 p-1">14,508</td>
                        <td class="border border-gray-400 p-1">4,225</td>
                        <td class="border border-gray-400 p-1">1,761</td>
                        <td class="border border-gray-400 p-1">12,096</td>
                        <td class="border border-gray-400 p-1">0</td>
                        <td class="border border-gray-400 p-1">190</td>
                        <td class="border border-gray-400 p-1">210</td>
                        <td class="border border-gray-400 p-1">971</td>
                        <td class="border border-gray-400 p-1">96</td>
                        <td class="border border-gray-400 p-1">8,790</td>
                        <td class="border border-gray-400 p-1">0</td>
                        <td class="border border-gray-400 p-1">4,950</td>
                        <td class="border border-gray-400 p-1">905</td>
                        <td class="border border-gray-400 p-1">0</td>
                        <td class="border border-gray-400 p-1">0</td>
                        <td class="border border-gray-400 p-1"></td>
                    </tr>

                    <!-- Row 2: Supplier Record (Mount Rock Powder Corp.) -->
                    <tr class="bg-white">
                        <td class="border border-gray-400 p-2"></td>
                        <td class="border border-gray-400 p-2"></td>
                        <td class="border border-gray-400 p-2 font-bold text-left">MOUNT ROCK POWDER CORP.</td>
                        <td class="border border-gray-400 p-2 font-semibold">AGUSAN DEL SUR</td>
                        <td class="border border-gray-400 p-2 font-semibold">PPB08-220509-03374</td>
                        @for($i = 0; $i < 17; $i++)
                            <td class="border border-gray-400 p-1"></td>
                        @endfor
                        <td class="border border-gray-400 p-2 font-bold">V. S. GUEVARA</td>
                    </tr>

                    <!-- Row 3: Found -->
                    <tr class="bg-white">
                        <td class="border border-gray-400 p-2 font-bold text-left">FOUND</td>
                        @for($i = 0; $i < 22; $i++)
                            <td class="border border-gray-400 p-1"></td>
                        @endfor
                    </tr>

                    <!-- Row 4: Taken Up -->
                    <tr class="bg-white">
                        <td class="border border-gray-400 p-2 font-bold text-left">Taken Up</td>
                        @for($i = 0; $i < 22; $i++)
                            <td class="border border-gray-400 p-1"></td>
                        @endfor
                    </tr>

                    <!-- Row 5: TOTAL Stock Row -->
                    <tr class="bg-rose-50/60 font-bold">
                        <td class="border border-gray-400 p-2 text-left bg-rose-50/80 uppercase">TOTAL</td>
                        @for($i = 0; $i < 3; $i++)
                            <td class="border border-gray-400 p-1"></td>
                        @endfor

                        <td class="border border-gray-400 p-1">17,563</td>
                        <td class="border border-gray-400 p-1">15,400</td>
                        <td class="border border-gray-400 p-1">14,508</td>
                        <td class="border border-gray-400 p-1">4,225</td>
                        <td class="border border-gray-400 p-1">1,761</td>
                        <td class="border border-gray-400 p-1">12,096</td>
                        <td class="border border-gray-400 p-1">0</td>
                        <td class="border border-gray-400 p-1">190</td>
                        <td class="border border-gray-400 p-1">210</td>
                        <td class="border border-gray-400 p-1">971</td>
                        <td class="border border-gray-400 p-1">96</td>
                        <td class="border border-gray-400 p-1">8,790</td>
                        <td class="border border-gray-400 p-1">0</td>
                        <td class="border border-gray-400 p-1">4,950</td>
                        <td class="border border-gray-400 p-1">905</td>
                        <td class="border border-gray-400 p-1">0</td>
                        <td class="border border-gray-400 p-1">0</td>
                        <td class="border border-gray-400 p-1"></td>
                        <td class="border border-gray-400 p-1"></td>
                    </tr>

                    <!-- Row 6: Disposition Label -->
                    <tr class="bg-white">
                        <td class="border border-gray-400 p-2 font-semibold text-left" colspan="2">Disposition</td>
                        @for($i = 0; $i < 21; $i++)
                            <td class="border border-gray-400 p-1"></td>
                        @endfor
                    </tr>

                    <!-- Row 7: USAGE (Green Highlight) -->
                    <tr class="bg-emerald-100/70 font-bold">
                        <td class="border border-gray-400 p-2 text-center bg-emerald-100 uppercase" colspan="2">USAGE</td>
                        <td class="border border-gray-400 p-2 text-center bg-emerald-100 uppercase text-[11px]" colspan="3">
                            MONTHLY USAGE / CONSUMPTION OF<br>
                            PMC- TIGERWAY DECLINE PROJECT<br>
                            <span class="font-normal text-[10px]">(MPSA No. 262-2008-XIII PARCEL 1)</span>
                        </td>
                        <td class="border border-gray-400 p-1">4,277</td>
                        <td class="border border-gray-400 p-1">0</td>
                        <td class="border border-gray-400 p-1">7,626</td>
                        <td class="border border-gray-400 p-1">2,425</td>
                        <td class="border border-gray-400 p-1">4</td>
                        <td class="border border-gray-400 p-1">1,349</td>
                        <td class="border border-gray-400 p-1">0</td>
                        <td class="border border-gray-400 p-1">190</td>
                        <td class="border border-gray-400 p-1">210</td>
                        <td class="border border-gray-400 p-1">175</td>
                        <td class="border border-gray-400 p-1">0</td>
                        <td class="border border-gray-400 p-1">1,066</td>
                        <td class="border border-gray-400 p-1">0</td>
                        <td class="border border-gray-400 p-1">1,575</td>
                        <td class="border border-gray-400 p-1">175</td>
                        <td class="border border-gray-400 p-1">0</td>
                        <td class="border border-gray-400 p-1">0</td>
                        <td class="border border-gray-400 p-1"></td>
                    </tr>

                    <!-- Row 8: Remaining Stock -->
                    <tr class="bg-rose-50/60 font-bold italic">
                        <td class="border border-gray-400 p-2 text-left bg-rose-50/80 sticky left-0 z-10" colspan="5">Remaining Stock as of May 31, 2026</td>
                        <td class="border border-gray-400 p-1">13,286</td>
                        <td class="border border-gray-400 p-1">15,400</td>
                        <td class="border border-gray-400 p-1">6,882</td>
                        <td class="border border-gray-400 p-1">1,800</td>
                        <td class="border border-gray-400 p-1">1,757</td>
                        <td class="border border-gray-400 p-1">10,747</td>
                        <td class="border border-gray-400 p-1">0</td>
                        <td class="border border-gray-400 p-1">0</td>
                        <td class="border border-gray-400 p-1">0</td>
                        <td class="border border-gray-400 p-1">796</td>
                        <td class="border border-gray-400 p-1">96</td>
                        <td class="border border-gray-400 p-1">7,724</td>
                        <td class="border border-gray-400 p-1">0</td>
                        <td class="border border-gray-400 p-1">3,375</td>
                        <td class="border border-gray-400 p-1">730</td>
                        <td class="border border-gray-400 p-1">0</td>
                        <td class="border border-gray-400 p-1">0</td>
                        <td class="border border-gray-400 p-1"></td>
                    </tr>
                </tbody>
            </table>
        </div>

        {{--
        <!-- Excel-Style Bottom Tabs Container -->
        <div class="bg-gray-100 border-t border-gray-300 px-4 pt-2 flex items-center justify-between shrink-0">
            <div class="flex items-end gap-1">
                <!-- Tab 1 (Inactive) -->
                <button type="button" class="bg-gray-200/70 hover:bg-white text-gray-600 font-medium border-t border-x border-gray-300 px-4 py-1.5 text-xs rounded-t transition cursor-pointer">
                    MAY 2026-PMC
                </button>

                <!-- Tab 2 (Inactive) -->
                <button type="button" class="bg-gray-200/70 hover:bg-white text-gray-600 font-medium border-t border-x border-gray-300 px-4 py-1.5 text-xs rounded-t transition cursor-pointer">
                    MAY 2026- EXPLO
                </button>

                <!-- Tab 3 (Active) -->
                <button type="button" class="bg-white text-emerald-800 font-bold border-t-2 border-x border-t-emerald-700 border-x-gray-300 px-4 py-1.5 text-xs rounded-t shadow-xs flex items-center gap-2 cursor-pointer relative -mb-[1px] z-10">
                    <span class="border-b-2 border-emerald-700 pb-0.5">MAY 2026- TIGERWAY</span>
                </button>
            </div>

            <!-- Export Button -->
            <div class="pb-2">
                <button type="button" class="px-4 py-1.5 rounded-lg bg-brand-green hover:bg-brand-green-hover active:translate-y-0.5 text-white text-xs font-bold transition cursor-pointer flex items-center gap-1.5">
                    <i class="fa-solid fa-file-excel text-white"></i>
                    Export
                </button>
            </div>
        </div>
        --}}

    </div>

</div>
@endsection

@push('scripts')
<script type="module">

</script>
@endpush