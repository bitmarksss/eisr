@extends('layouts.app')

@section('page-title', 'Monthly Consumption and Costing Report')

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
            <form method="GET" action="{{ route('reports.explosives.index', ['type' => $type]) }}" class="flex flex-wrap items-center gap-3 flex-1 w-full">

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
        @include('pages.reports.explosives.header')

        <!-- Report Content Container -->
        <div class="p-6 text-sm text-gray-800 space-y-6 overflow-auto mx-auto w-full">
            
            <!-- <div class="border border-gray-200 rounded-lg overflow-hidden bg-white shadow-xs"> -->
                <table class="w-full border-collapse border border-gray-400 text-xs text-center font-medium">
                    <thead class="bg-gray-100 text-gray-700 font-bold uppercase tracking-wider border-b border-gray-200">
                        <tr>
                            <th class="p-2.5 pl-4 border-r border-gray-200" rowspan="2">Supplier</th>
                            <th class="p-2.5 border-r border-gray-200" rowspan="2">Description</th>
                            <th class="p-2.5 text-center border-r border-gray-200" colspan="2">Monthly Consumption</th>
                            <th class="p-2.5 text-right border-r border-gray-200">Monthly Cost</th>
                            <th class="p-2.5 text-right" rowspan="2">Unit Price</th>
                        </tr>
                        <tr class="border-t border-gray-200">
                            <th class="p-2 text-right border-r border-gray-200">Pcs</th>
                            <th class="p-2 text-right border-r border-gray-200">Kls</th>
                            <th class="p-2 text-right border-r border-gray-200">Pesos</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 font-medium">
                        
                        <!-- Section 1: Explosives/Gels -->
                        <tr>
                            <td class="p-2.5 pl-4 font-semibold text-gray-900 border-r border-gray-200">MT. ROCK</td>
                            <td class="p-2.5 border-r border-gray-200">DYNA NEOGEL 200</td>
                            <td class="p-2.5 text-right border-r border-gray-200 font-semibold">46,364</td>
                            <td class="p-2.5 text-right border-r border-gray-200">5,572.60</td>
                            <td class="p-2.5 text-right border-r border-gray-200 font-semibold">1,267,767.94</td>
                            <td class="p-2.5 text-right">27.344</td>
                        </tr>
                        <tr>
                            <td class="p-2.5 pl-4 font-semibold text-gray-900 border-r border-gray-200">EXPEDITION</td>
                            <td class="p-2.5 border-r border-gray-200">DYNAPULSAR 215</td>
                            <td class="p-2.5 text-right border-r border-gray-200 font-semibold">42,223</td>
                            <td class="p-2.5 text-right border-r border-gray-200">4,909.65</td>
                            <td class="p-2.5 text-right border-r border-gray-200 font-semibold">1,248,276.55</td>
                            <td class="p-2.5 text-right">29.5639</td>
                        </tr>

                        <!-- Subtotal Row -->
                        <tr class="bg-emerald-100/70 text-emerald-950 font-bold border-y-2 border-emerald-300">
                            <td class="p-2.5 pl-4 text-center border-r border-emerald-200" colspan="2">TOTAL</td>
                            <td class="p-2.5 text-right border-r border-emerald-200">88,587</td>
                            <td class="p-2.5 text-right border-r border-emerald-200">10,482.25</td>
                            <td class="p-2.5 text-right border-r border-emerald-200">2,516,044.49</td>
                            <td class="p-2.5 bg-emerald-100/40"></td>
                        </tr>

                        <!-- Section 2: Other Materials -->
                        <tr>
                            <td class="p-2.5 pl-4 font-semibold text-gray-900 border-r border-gray-200" rowspan="4">
                                EXPEDITION/<br>MT.ROCK
                            </td>
                            <td class="p-2.5 border-r border-gray-200">ANFO</td>
                            <td class="p-2.5 text-right border-r border-gray-200">—</td>
                            <td class="p-2.5 text-right border-r border-gray-200">30,961.50</td>
                            <td class="p-2.5 text-right border-r border-gray-200 font-semibold">4,516,663.62</td>
                            <td class="p-2.5 text-right">145.88</td>
                        </tr>
                        <tr>
                            <td class="p-2.5 border-r border-gray-200">S/FUSE</td>
                            <td class="p-2.5 text-right border-r border-gray-200 font-semibold">12,154.86</td>
                            <td class="p-2.5 text-right border-r border-gray-200">—</td>
                            <td class="p-2.5 text-right border-r border-gray-200 font-semibold">336,203.43</td>
                            <td class="p-2.5 text-right">27.66</td>
                        </tr>
                        <tr>
                            <td class="p-2.5 border-r border-gray-200">OBC</td>
                            <td class="p-2.5 text-right border-r border-gray-200 font-semibold">5,002</td>
                            <td class="p-2.5 text-right border-r border-gray-200">—</td>
                            <td class="p-2.5 text-right border-r border-gray-200 font-semibold">131,302.50</td>
                            <td class="p-2.5 text-right">26.25</td>
                        </tr>
                        <tr>
                            <td class="p-2.5 border-r border-gray-200">F/LIGHTER</td>
                            <td class="p-2.5 text-right border-r border-gray-200">0</td>
                            <td class="p-2.5 text-right border-r border-gray-200">—</td>
                            <td class="p-2.5 text-right border-r border-gray-200">0.00</td>
                            <td class="p-2.5 text-right">20.62</td>
                        </tr>

                        <!-- Section 3: MT. ROCK Detonators/Nonels -->
                        <tr>
                            <td class="p-2.5 pl-4 font-semibold text-gray-900 border-r border-gray-200" rowspan="4">MT. ROCK</td>
                            <td class="p-2.5 border-r border-gray-200">NONEL 2.4</td>
                            <td class="p-2.5 text-right border-r border-gray-200">—</td>
                            <td class="p-2.5 text-right border-r border-gray-200">—</td>
                            <td class="p-2.5 text-right border-r border-gray-200">0.00</td>
                            <td class="p-2.5 text-right">171.74</td>
                        </tr>
                        <tr>
                            <td class="p-2.5 border-r border-gray-200">NONEL 3.6</td>
                            <td class="p-2.5 text-right border-r border-gray-200">—</td>
                            <td class="p-2.5 text-right border-r border-gray-200">—</td>
                            <td class="p-2.5 text-right border-r border-gray-200">0.00</td>
                            <td class="p-2.5 text-right">176.79</td>
                        </tr>
                        <tr>
                            <td class="p-2.5 border-r border-gray-200">SUPREME 2.4</td>
                            <td class="p-2.5 text-right border-r border-gray-200">—</td>
                            <td class="p-2.5 text-right border-r border-gray-200">—</td>
                            <td class="p-2.5 text-right border-r border-gray-200">0.00</td>
                            <td class="p-2.5 text-right">180.36</td>
                        </tr>
                        <tr>
                            <td class="p-2.5 border-r border-gray-200">SUPREME 3.6</td>
                            <td class="p-2.5 text-right border-r border-gray-200">—</td>
                            <td class="p-2.5 text-right border-r border-gray-200">—</td>
                            <td class="p-2.5 text-right border-r border-gray-200">0.00</td>
                            <td class="p-2.5 text-right">185.71</td>
                        </tr>

                        <!-- Section 4: EXPEDITION Products -->
                        <tr>
                            <td class="p-2.5 pl-4 font-semibold text-gray-900 border-r border-gray-200" rowspan="5">EXPEDITION</td>
                            <td class="p-2.5 border-r border-gray-200">EXEL 2.4</td>
                            <td class="p-2.5 text-right border-r border-gray-200 font-semibold">44,222</td>
                            <td class="p-2.5 text-right border-r border-gray-200">—</td>
                            <td class="p-2.5 text-right border-r border-gray-200 font-semibold">8,374,762.36</td>
                            <td class="p-2.5 text-right">189.38</td>
                        </tr>
                        <tr>
                            <td class="p-2.5 border-r border-gray-200">EXEL 4.9</td>
                            <td class="p-2.5 text-right border-r border-gray-200">—</td>
                            <td class="p-2.5 text-right border-r border-gray-200">—</td>
                            <td class="p-2.5 text-right border-r border-gray-200">0</td>
                            <td class="p-2.5 text-right">195.00</td>
                        </tr>
                        <tr>
                            <td class="p-2.5 border-r border-gray-200">EXEL 3.6</td>
                            <td class="p-2.5 text-right border-r border-gray-200 font-semibold">3,453</td>
                            <td class="p-2.5 text-right border-r border-gray-200">—</td>
                            <td class="p-2.5 text-right border-r border-gray-200 font-semibold">673,335</td>
                            <td class="p-2.5 text-right">195.00</td>
                        </tr>
                        <tr>
                            <td class="p-2.5 border-r border-gray-200">CORDTEX 5</td>
                            <td class="p-2.5 text-right border-r border-gray-200 font-semibold">12,260</td>
                            <td class="p-2.5 text-right border-r border-gray-200">—</td>
                            <td class="p-2.5 text-right border-r border-gray-200 font-semibold">430,939.00</td>
                            <td class="p-2.5 text-right">35.15</td>
                        </tr>
                        <tr>
                            <td class="p-2.5 border-r border-gray-200">DCORD 15</td>
                            <td class="p-2.5 text-right border-r border-gray-200">—</td>
                            <td class="p-2.5 text-right border-r border-gray-200">—</td>
                            <td class="p-2.5 text-right border-r border-gray-200">0.00</td>
                            <td class="p-2.5 text-right">37.50</td>
                        </tr>

                        <!-- Section 5: MT. ROCK Cordtex -->
                        <tr>
                            <td class="p-2.5 pl-4 font-semibold text-gray-900 border-r border-gray-200" rowspan="2">MT. ROCK</td>
                            <td class="p-2.5 border-r border-gray-200">CORDTEX 10</td>
                            <td class="p-2.5 text-right border-r border-gray-200 font-semibold">8,724.0</td>
                            <td class="p-2.5 text-right border-r border-gray-200">—</td>
                            <td class="p-2.5 text-right border-r border-gray-200 font-semibold">313,129.29</td>
                            <td class="p-2.5 text-right">35.8929</td>
                        </tr>
                        <tr>
                            <td class="p-2.5 border-r border-gray-200">CORDTEX 40</td>
                            <td class="p-2.5 text-right border-r border-gray-200">—</td>
                            <td class="p-2.5 text-right border-r border-gray-200">—</td>
                            <td class="p-2.5 text-right border-r border-gray-200">0</td>
                            <td class="p-2.5 text-right">81.9</td>
                        </tr>

                        <!-- Section 6: EXPEDITION Misc -->
                        <tr>
                            <td class="p-2.5 pl-4 font-semibold text-gray-900 border-r border-gray-200" rowspan="2">EXPEDITION</td>
                            <td class="p-2.5 border-r border-gray-200">BILL WIRE</td>
                            <td class="p-2.5 text-right border-r border-gray-200 font-semibold">330.0</td>
                            <td class="p-2.5 text-right border-r border-gray-200">—</td>
                            <td class="p-2.5 text-right border-r border-gray-200 font-semibold">2,475</td>
                            <td class="p-2.5 text-right">7.5</td>
                        </tr>
                        <tr>
                            <td class="p-2.5 border-r border-gray-200">EBC</td>
                            <td class="p-2.5 text-right border-r border-gray-200 font-semibold">128</td>
                            <td class="p-2.5 text-right border-r border-gray-200">—</td>
                            <td class="p-2.5 text-right border-r border-gray-200 font-semibold">34,199.04</td>
                            <td class="p-2.5 text-right">267.18</td>
                        </tr>
                        <tr class="bg-gray-100">
                            <td class="p-2.5 border-r border-gray-200"></td>
                            <td class="p-2.5 text-center border-r border-gray-200 font-semibold text-base" colspan="2">MONTH OF MAY 2026 COST</td>
                            <td class="p-2.5 text-right border-r border-gray-200"></td>
                            <td class="p-2.5 text-right border-r border-gray-200 font-semibold text-base"> ₱17,329,053.73</td>
                            <td class="p-2.5 text-right"></td>
                        </tr>
                    </tbody>
                </table>
            <!-- </div> -->

            <!-- Grand Total Bar -->
            <!-- <div class="bg-brand-green text-white rounded-lg p-4 flex flex-col sm:flex-row justify-between items-center gap-2 shadow-md">
                <span class="font-bold tracking-wider text-sm uppercase text-brand-gold">
                    MONTH OF MAY 2026 COST
                </span>
                <span class="font-extrabold text-xl tracking-tight text-white">
                    ₱17,329,053.73
                </span>
            </div> -->

        </div>

        <!-- Footer -->
         @include('pages.reports.explosives.footer')
    </div>

</div>
@endsection

@push('scripts')
<script type="module">

</script>
@endpush