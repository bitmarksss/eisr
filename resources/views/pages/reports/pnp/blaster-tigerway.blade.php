@extends('layouts.app')

@section('page-title', 'Tigerway Daily Blaster Report')

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
                <h3 class="font-bold tracking-wider uppercase text-lg" id="blasterModalTitle">Daily Blaster Report</h3>
                <p class="text-xs text-brand-gold font-medium" id="blasterModalDate">07-JUN-26</p>
            </div>
        </div>

        <!-- Scrollable Modal Content Body -->
        <div class="p-6 overflow-auto flex-1 space-y-6 text-xs text-gray-800">

            <!-- Report Header Info Grid -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 p-4 bg-gray-50 rounded-xl border border-gray-200">
                <div class="space-y-1.5 col-span-1 md:col-span-3">
                    <div class="flex">
                        <span class="font-bold w-32 shrink-0">Location:</span>
                        <span class="font-semibold text-red-600">MINE SITE, CO-O, CONSUELO, BUNAWAN , AGUSAN DEL SUR</span>
                    </div>
                    <div class="flex">
                        <span class="font-bold w-32 shrink-0">Time of Blasting:</span>
                        <span class="font-semibold text-red-600">6:45 AM / 2:45 PM / 10:45 PM</span>
                    </div>
                </div>
                <div class="space-y-1.5 col-span-1">
                    <div class="flex">
                        <span class="font-bold w-20">Date:</span>
                        <span class="font-semibold">07-Jun-26</span>
                    </div>
                    <div class="flex">
                        <span class="font-bold w-20">Shift:</span>
                        <span class="font-semibold">1ST SHIFT/2ND SHIFT/3RD SHIFT</span>
                    </div>
                </div>
            </div>

            <!-- SECTION I: EXPLOSIVE USED -->
            <div>
                <h4 class="font-bold text-sm text-brand-navy uppercase mb-3 flex items-center gap-2">
                    <span>I.</span> Explosive Used
                </h4>
                
                <div class="overflow-x-auto border border-gray-300 rounded-lg">
                    <table class="w-full border-collapse text-xs text-center">
                        <thead class="bg-gray-100 text-gray-800 font-bold uppercase tracking-wider">
                            <tr>
                                <th class="border-b border-r border-gray-300 p-2 text-left w-2/5" rowspan="2">Item Description</th>
                                <th class="border-b border-r border-gray-300 p-2" colspan="3">Requisitioned</th>
                                <th class="border-b border-r border-gray-300 p-2" colspan="3">Consumed</th>
                                <th class="border-b border-gray-300 p-2" colspan="3">Required</th>
                            </tr>
                            <tr class="bg-gray-200/80 text-[11px] text-gray-700">
                                <th class="border-b border-r border-gray-300 p-1 w-20">(KLS)</th>
                                <th class="border-b border-r border-gray-300 p-1 w-28" colspan="2">(PCS)</th>
                                <th class="border-b border-r border-gray-300 p-1 w-20">(KLS)</th>
                                <th class="border-b border-r border-gray-300 p-1 w-28" colspan="2">(PCS)</th>
                                <th class="border-b border-r border-gray-300 p-1 w-20">(KLS)</th>
                                <th class="border-b border-gray-300 p-1 w-28" colspan="2">(PCS)</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            <tr>
                                <td class="border-r border-gray-300 p-2 text-left font-medium">Emulsion Senatel Pulsar 38</td>
                                <td class="border-r border-gray-300 p-2">0.00</td>
                                <td class="border-r border-gray-300 p-2"></td>
                                <td class="border-r border-gray-300 p-2 text-left">pcs</td>
                                <td class="border-r border-gray-300 p-2">0.00</td>
                                <td class="border-r border-gray-300 p-2 text-right">0</td>
                                <td class="border-r border-gray-300 p-2 text-left">pcs</td>
                                <td class="border-r border-gray-300 p-2">0.00</td>
                                <td class="border-r border-gray-300 p-2 text-right">0</td>
                                <td class="p-2 text-left">pcs</td>
                            </tr>
                            <tr>
                                <td class="border-r border-gray-300 p-2 text-left font-medium">Emulsion Senatel Pulsar 135</td>
                                <td class="border-r border-gray-300 p-2">0.00</td>
                                <td class="border-r border-gray-300 p-2 text-right"></td>
                                <td class="border-r border-gray-300 p-2 text-left">pcs</td>
                                <td class="border-r border-gray-300 p-2">0.00</td>
                                <td class="border-r border-gray-300 p-2 text-right">0</td>
                                <td class="border-r border-gray-300 p-2 text-left">pcs</td>
                                <td class="border-r border-gray-300 p-2">0.00</td>
                                <td class="border-r border-gray-300 p-2 text-right">0</td>
                                <td class="p-2 text-left">pcs</td>
                            </tr>
                            <tr>
                                <td class="border-r border-gray-300 p-2 text-left ">Emulsion Senatel Pulsar 215 P</td>
                                <td class="border-r border-gray-300 p-2">106.40</td>
                                <td class="border-r border-gray-300 p-2 text-right">915</td>
                                <td class="border-r border-gray-300 p-2 text-left">pcs</td>
                                <td class="border-r border-gray-300 p-2">106.40</td>
                                <td class="border-r border-gray-300 p-2 text-right">915</td>
                                <td class="border-r border-gray-300 p-2 text-left">pcs</td>
                                <td class="border-r border-gray-300 p-2">106.40</td>
                                <td class="border-r border-gray-300 p-2 text-right">915</td>
                                <td class="p-2 text-left">pcs</td>
                            </tr>
                            <tr>
                                <td class="border-r border-gray-300 p-2 text-left ">Anfo</td>
                                <td class="border-r border-gray-300 p-2">887.60</td>
                                <td class="border-r border-gray-300 p-2"></td>
                                <td class="border-r border-gray-300 p-2"></td>
                                <td class="border-r border-gray-300 p-2">887.60</td>
                                <td class="border-r border-gray-300 p-2"></td>
                                <td class="border-r border-gray-300 p-2"></td>
                                <td class="border-r border-gray-300 p-2">887.60</td>
                                <td class="border-r border-gray-300 p-2"></td>
                                <td class="p-2"></td>
                            </tr>
                            <tr>
                                <td class="border-r border-gray-300 p-2 text-left">OBC</td>
                                <td class="border-r border-gray-300 p-2"></td>
                                <td class="border-r border-gray-300 p-2 text-right">72</td>
                                <td class="border-r border-gray-300 p-2 text-left">pcs</td>
                                <td class="border-r border-gray-300 p-2"></td>
                                <td class="border-r border-gray-300 p-2 text-right">72</td>
                                <td class="border-r border-gray-300 p-2 text-left">pcs</td>
                                <td class="border-r border-gray-300 p-2"></td>
                                <td class="border-r border-gray-300 p-2 text-right">72</td>
                                <td class="p-2 text-left">pcs</td>
                            </tr>
                            <tr>
                                <td class="border-r border-gray-300 p-2 text-left">Safety Fuse</td>
                                <td class="border-r border-gray-300 p-2"></td>
                                <td class="border-r border-gray-300 p-2 text-right">174.96</td>
                                <td class="border-r border-gray-300 p-2 text-left">meters</td>
                                <td class="border-r border-gray-300 p-2"></td>
                                <td class="border-r border-gray-300 p-2 text-right">174.96</td>
                                <td class="border-r border-gray-300 p-2 text-left">meters</td>
                                <td class="border-r border-gray-300 p-2"></td>
                                <td class="border-r border-gray-300 p-2 text-right">174.96</td>
                                <td class="p-2 text-left">meters</td>
                            </tr>
                            <tr>
                                <td class="border-r border-gray-300 p-2 text-left">EXEL Detonator (3.6)</td>
                                <td class="border-r border-gray-300 p-2"></td>
                                <td class="border-r border-gray-300 p-2 text-right">52</td>
                                <td class="border-r border-gray-300 p-2 text-left">pcs</td>
                                <td class="border-r border-gray-300 p-2"></td>
                                <td class="border-r border-gray-300 p-2 text-right">52</td>
                                <td class="border-r border-gray-300 p-2 text-left">pcs</td>
                                <td class="border-r border-gray-300 p-2"></td>
                                <td class="border-r border-gray-300 p-2 text-right">52</td>
                                <td class="p-2 text-left">pcs</td>
                            </tr>
                            <tr>
                                <td class="border-r border-gray-300 p-2 text-left">EXEL Detonator (2.4)</td>
                                <td class="border-r border-gray-300 p-2"></td>
                                <td class="border-r border-gray-300 p-2 text-right">1,233</td>
                                <td class="border-r border-gray-300 p-2 text-left">pcs</td>
                                <td class="border-r border-gray-300 p-2"></td>
                                <td class="border-r border-gray-300 p-2 text-right">1,233</td>
                                <td class="border-r border-gray-300 p-2 text-left">pcs</td>
                                <td class="border-r border-gray-300 p-2"></td>
                                <td class="border-r border-gray-300 p-2 text-right">1,233</td>
                                <td class="p-2 text-left">pcs</td>
                            </tr>
                            <tr>
                                <td class="border-r border-gray-300 p-2 text-left">EXEL Detonator (4.9)</td>
                                <td class="border-r border-gray-300 p-2"></td>
                                <td class="border-r border-gray-300 p-2 text-right"></td>
                                <td class="border-r border-gray-300 p-2 text-left">pcs</td>
                                <td class="border-r border-gray-300 p-2"></td>
                                <td class="border-r border-gray-300 p-2 text-right">0</td>
                                <td class="border-r border-gray-300 p-2 text-left">pcs</td>
                                <td class="border-r border-gray-300 p-2"></td>
                                <td class="border-r border-gray-300 p-2 text-right">0</td>
                                <td class="p-2 text-left">pcs</td>
                            </tr>
                            <tr>
                                <td class="border-r border-gray-300 p-2 text-left">Cordtex (Detonating Cord) 5</td>
                                <td class="border-r border-gray-300 p-2"></td>
                                <td class="border-r border-gray-300 p-2 text-right">203</td>
                                <td class="border-r border-gray-300 p-2 text-left">meters</td>
                                <td class="border-r border-gray-300 p-2"></td>
                                <td class="border-r border-gray-300 p-2 text-right">203</td>
                                <td class="border-r border-gray-300 p-2 text-left">meters</td>
                                <td class="border-r border-gray-300 p-2"></td>
                                <td class="border-r border-gray-300 p-2 text-right">203</td>
                                <td class="p-2 text-left">meters</td>
                            </tr>
                            <tr>
                                <td class="border-r border-gray-300 p-2 text-left">Cordtex (DCORD I) 5</td>
                                <td class="border-r border-gray-300 p-2"></td>
                                <td class="border-r border-gray-300 p-2 text-right"></td>
                                <td class="border-r border-gray-300 p-2 text-left">meters</td>
                                <td class="border-r border-gray-300 p-2 text-right">0</td>
                                <td class="border-r border-gray-300 p-2"></td>
                                <td class="border-r border-gray-300 p-2 text-left">meters</td>
                                <td class="border-r border-gray-300 p-2"></td>
                                <td class="border-r border-gray-300 p-2 text-right">0</td>
                                <td class="p-2 text-left">meters</td>
                            </tr>
                            <tr>
                                <td class="border-r border-gray-300 p-2 text-left">Cordtex (Detonating Cord) 40</td>
                                <td class="border-r border-gray-300 p-2"></td>
                                <td class="border-r border-gray-300 p-2 text-right"></td>
                                <td class="border-r border-gray-300 p-2 text-left">meters</td>
                                <td class="border-r border-gray-300 p-2 text-right">0</td>
                                <td class="border-r border-gray-300 p-2"></td>
                                <td class="border-r border-gray-300 p-2 text-left">meters</td>
                                <td class="border-r border-gray-300 p-2"></td>
                                <td class="border-r border-gray-300 p-2 text-right">0</td>
                                <td class="p-2 text-left">meters</td>
                            </tr>
                            <tr>
                                <td class="border-r border-gray-300 p-2 text-left">MS 12</td>
                                <td class="border-r border-gray-300 p-2"></td>
                                <td class="border-r border-gray-300 p-2 text-right"></td>
                                <td class="border-r border-gray-300 p-2 text-left">meters</td>
                                <td class="border-r border-gray-300 p-2 text-right">0</td>
                                <td class="border-r border-gray-300 p-2"></td>
                                <td class="border-r border-gray-300 p-2 text-left">meters</td>
                                <td class="border-r border-gray-300 p-2"></td>
                                <td class="border-r border-gray-300 p-2 text-right">0</td>
                                <td class="p-2 text-left">meters</td>
                            </tr>
                            <tr>
                                <td class="border-r border-gray-300 p-2 text-left">MS 18</td>
                                <td class="border-r border-gray-300 p-2"></td>
                                <td class="border-r border-gray-300 p-2 text-right"></td>
                                <td class="border-r border-gray-300 p-2 text-left">meters</td>
                                <td class="border-r border-gray-300 p-2 text-right">0</td>
                                <td class="border-r border-gray-300 p-2"></td>
                                <td class="border-r border-gray-300 p-2 text-left">meters</td>
                                <td class="border-r border-gray-300 p-2"></td>
                                <td class="border-r border-gray-300 p-2 text-right">0</td>
                                <td class="p-2 text-left">meters</td>
                            </tr>
                            <tr>
                                <td class="border-r border-gray-300 p-2 text-left">Fuse Lighter</td>
                                <td class="border-r border-gray-300 p-2"></td>
                                <td class="border-r border-gray-300 p-2"></td>
                                <td class="border-r border-gray-300 p-2 text-left">pcs</td>
                                <td class="border-r border-gray-300 p-2"></td>
                                <td class="border-r border-gray-300 p-2 text-right">0</td>
                                <td class="border-r border-gray-300 p-2 text-left">pcs</td>
                                <td class="border-r border-gray-300 p-2"></td>
                                <td class="border-r border-gray-300 p-2 text-right">0</td>
                                <td class="p-2 text-left">pcs</td>
                            </tr>
                            <tr>
                                <td class="border-r border-gray-300 p-2 text-left">BILL WIRE</td>
                                <td class="border-r border-gray-300 p-2"></td>
                                <td class="border-r border-gray-300 p-2"></td>
                                <td class="border-r border-gray-300 p-2 text-left">pcs</td>
                                <td class="border-r border-gray-300 p-2"></td>
                                <td class="border-r border-gray-300 p-2 text-right">0</td>
                                <td class="border-r border-gray-300 p-2 text-left">pcs</td>
                                <td class="border-r border-gray-300 p-2"></td>
                                <td class="border-r border-gray-300 p-2 text-right">0</td>
                                <td class="p-2 text-left">pcs</td>
                            </tr>
                            <tr>
                                <td class="border-r border-gray-300 p-2 text-left">EBC</td>
                                <td class="border-r border-gray-300 p-2"></td>
                                <td class="border-r border-gray-300 p-2 text-right">2</td>
                                <td class="border-r border-gray-300 p-2 text-left">pcs</td>
                                <td class="border-r border-gray-300 p-2"></td>
                                <td class="border-r border-gray-300 p-2 text-right">2</td>
                                <td class="border-r border-gray-300 p-2 text-left">pcs</td>
                                <td class="border-r border-gray-300 p-2"></td>
                                <td class="border-r border-gray-300 p-2 text-right">2</td>
                                <td class="p-2 text-left">pcs</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- SECTION II: CHARGED DRILL HOLES -->
            <div>
                <h4 class="font-bold text-sm text-brand-navy uppercase mb-3 flex items-center gap-2">
                    <span>II.</span> Charged Drill Holes
                </h4>
                
                <div class="border border-gray-300 rounded-lg p-4 bg-gray-50/50 space-y-3">
                    <!-- Primary -->
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 items-center bg-white p-3 rounded-md border border-gray-200">
                        <div class="flex items-center gap-2">
                            <span class="font-bold text-gray-600">(a)</span>
                            <span class="font-bold">PRIMARY:</span>
                            <span class="font-semibold text-brand-navy bg-gray-100 px-2 py-0.5 rounded">47</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="font-semibold text-gray-600">No. of holes:</span>
                            <span class="font-bold text-gray-900">1,266</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="font-semibold text-gray-600">Depth:</span>
                            <span class="font-bold text-gray-900">5'X11"</span>
                        </div>
                    </div>

                    <!-- Secondary -->
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 items-center bg-white p-3 rounded-md border border-gray-200">
                        <div class="flex items-center gap-2">
                            <span class="font-bold text-gray-600">(b)</span>
                            <span class="font-bold">SECONDARY:</span>
                            <span class="font-semibold text-brand-navy bg-gray-100 px-2 py-0.5 rounded">3</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="font-semibold text-gray-600">No. of holes:</span>
                            <span class="font-bold text-gray-900">19</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="font-semibold text-gray-600">Depth:</span>
                            <span class="font-bold text-gray-900">3'X11"</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- SECTION III: ESTIMATED TONNAGE OF BLASTED MATERIAL / REMARKS -->
            <div class="space-y-4">
                <div>
                    <h4 class="font-bold text-sm text-brand-navy uppercase mb-2 flex items-center gap-2">
                        <span>III.</span> Estimated Tonnage of Blasted Material
                    </h4>
                    <div class="p-3 bg-gray-50 border border-gray-200 rounded-lg min-h-[42px] flex items-center">
                        <span class="text-gray-400 italic">No value provided</span>
                    </div>
                </div>

                <div>
                    <h4 class="font-bold text-sm text-brand-navy uppercase mb-2">Remarks:</h4>
                    <div class="p-3 bg-gray-50 border border-gray-200 rounded-lg min-h-[60px]">
                        <span class="text-gray-400 italic">No additional remarks</span>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>

@endsection


@push('scripts')
<script type="module">

</script>
@endpush