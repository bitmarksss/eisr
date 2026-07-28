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
                <h3 class="font-bold tracking-wider uppercase text-lg" id="reportModalTitle">MONTHLY COMPARATIVE REPORT</h3>
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
                    
                    <!-- Current Month Consumption -->
                    <tr class="bg-white">
                        <td class="border border-gray-400 p-2 font-bold">MAY 2026 Usage / Consumption</td>
                        <td class="border border-gray-400 p-1">46,364</td>
                        <td class="border border-gray-400 p-1">5,572.60</td>
                        <td class="border border-gray-400 p-1">42,223</td>
                        <td class="border border-gray-400 p-1">4,909.65</td>
                        <td class="border border-gray-400 p-1">30,961.50</td>
                        <td class="border border-gray-400 p-1">0</td>
                        <td class="border border-gray-400 p-1">0</td>
                        <td class="border border-gray-400 p-1">0</td>
                        <td class="border border-gray-400 p-1">0</td>
                        <td class="border border-gray-400 p-1">3,453</td>
                        <td class="border border-gray-400 p-1">44,222</td>
                        <td class="border border-gray-400 p-1"></td>
                        <td class="border border-gray-400 p-1">5,002</td>
                        <td class="border border-gray-400 p-1">128</td>
                        <td class="border border-gray-400 p-1">12,260</td>
                        <td class="border border-gray-400 p-1">8,724</td>
                        <td class="border border-gray-400 p-1"></td>
                        <td class="border border-gray-400 p-1"></td>
                        <td class="border border-gray-400 p-1">12,154.86</td>
                        <td class="border border-gray-400 p-1">330</td>
                        <td class="border border-gray-400 p-1">0</td>
                    </tr>

                    <!-- Less -->
                    <tr class="bg-white">
                        <td class="border border-gray-400 p-2 font-bold">Less:</td>
                        @for($i = 0; $i < 21; $i++)
                        <td class="border border-gray-400 p-1"></td>
                        @endfor
                    </tr>

                    <!-- Previous Month Consumption -->
                    <tr class="bg-gray-100 font-bold">
                        <td class="border border-gray-400 p-2 font-bold">APRIL 2026 Usage / Consumption</td>
                        <td class="border border-gray-400 p-1">16,788</td>
                        <td class="border border-gray-400 p-1">2,017.79</td>
                        <td class="border border-gray-400 p-1">63,497</td>
                        <td class="border border-gray-400 p-1">7,383.37</td>
                        <td class="border border-gray-400 p-1">26,252.20</td>
                        <td class="border border-gray-400 p-1">0</td>
                        <td class="border border-gray-400 p-1">0</td>
                        <td class="border border-gray-400 p-1">0</td>
                        <td class="border border-gray-400 p-1">0</td>
                        <td class="border border-gray-400 p-1">570</td>
                        <td class="border border-gray-400 p-1">39,526</td>
                        <td class="border border-gray-400 p-1"></td>
                        <td class="border border-gray-400 p-1">4,599</td>
                        <td class="border border-gray-400 p-1">148</td>
                        <td class="border border-gray-400 p-1">10,819</td>
                        <td class="border border-gray-400 p-1">8,389</td>
                        <td class="border border-gray-400 p-1"></td>
                        <td class="border border-gray-400 p-1"></td>
                        <td class="border border-gray-400 p-1">11,175.57</td>
                        <td class="border border-gray-400 p-1">30</td>
                        <td class="border border-gray-400 p-1">0</td>
                    </tr>


                    <!-- Difference -->
                    <tr class="bg-emerald-100 font-bold text-brand-dark">
                        <td class="border border-gray-400 p-2 font-bold">Total difference</td>
                        <td class="border border-gray-400 p-1">29,576</td>
                        <td class="border border-gray-400 p-1">3,554.81</td>
                        <td class="border border-gray-400 p-1">-21,274</td>
                        <td class="border border-gray-400 p-1">-2,473.72</td>
                        <td class="border border-gray-400 p-1">4709</td>
                        <td class="border border-gray-400 p-1">0</td>
                        <td class="border border-gray-400 p-1">0</td>
                        <td class="border border-gray-400 p-1">0</td>
                        <td class="border border-gray-400 p-1">0</td>
                        <td class="border border-gray-400 p-1">2,883</td>
                        <td class="border border-gray-400 p-1">4,696</td>
                        <td class="border border-gray-400 p-1">0</td>
                        <td class="border border-gray-400 p-1">403</td>
                        <td class="border border-gray-400 p-1">-20</td>
                        <td class="border border-gray-400 p-1">1441</td>
                        <td class="border border-gray-400 p-1">335</td>
                        <td class="border border-gray-400 p-1">0</td>
                        <td class="border border-gray-400 p-1">0</td>
                        <td class="border border-gray-400 p-1">979.29</td>
                        <td class="border border-gray-400 p-1">300</td>
                        <td class="border border-gray-400 p-1">0</td>
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