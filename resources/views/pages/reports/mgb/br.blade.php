@extends('layouts.app')

@section('page-title', 'Blasting Report')

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
                        <option value=""> PMC </option>
                        <option value=""> EXPLO </option>
                        <option value=""> TIGERWAY </option>
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
                <h3 class="font-bold tracking-wider uppercase text-lg">Blasting Report for the Month of May 2026</h3>
                <p class="text-xs text-brand-gold font-medium">MONTHLY SUMMARY DETAILS</p>
            </div>
        </div>

        <!-- Report Content Container -->
        <div class="p-6 text-sm text-gray-800 space-y-6 overflow-auto max-w-5xl mx-auto w-full">
            
            <!-- General Parameters Table -->
            <table class="w-full border-collapse text-left">
                <tbody>
                    <tr class="border-b border-gray-200">
                        <td class="py-2.5 font-bold w-1/3">A. Mining Method</td>
                        <td class="py-2.5 font-semibold text-gray-900">: SHRINKAGE STOPING AND ROOM & PILLAR (SLOT) STOPING</td>
                    </tr>
                    <tr class="border-b border-gray-200">
                        <td class="py-2.5 font-bold">B. Type of Rock Blasted</td>
                        <td class="py-2.5 font-semibold text-gray-900">: Andesite porphyry and volcaniclastic</td>
                    </tr>
                    <tr class="border-b border-gray-200">
                        <td class="py-2.5 font-bold">C. Ore/Minerals</td>
                        <td class="py-2.5 font-semibold text-gray-900">: (VEIN) QUARTS, CALCITE / GOLD</td>
                    </tr>
                </tbody>
            </table>

            <!-- D. No. of Holes Blasted -->
            <div class="space-y-3">
                <div class="font-bold">
                    D. No. of Holes Blasted <span class="font-medium text-xs text-gray-600">( Specify diameter of holes <span class="underline font-bold">32 mm</span> )</span>
                </div>

                <div class="border border-gray-200 rounded-lg overflow-hidden bg-gray-50/50">
                    <table class="w-full text-xs text-left border-collapse">
                        <thead class="bg-gray-100 text-gray-700 font-bold uppercase tracking-wider border-b border-gray-200">
                            <tr>
                                <th class="p-2.5 pl-4">Category</th>
                                <th class="p-2.5">Type / Specification</th>
                                <th class="p-2.5 text-right">Holes Count</th>
                                <th class="p-2.5 text-center">Average Depth</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 font-medium">
                            <!-- Primary Blasting -->
                            <tr>
                                <td class="p-2.5 pl-4 font-bold text-gray-900 bg-white" rowspan="4">1. Primary :</td>
                                <td class="p-2.5 bg-white">a) Using OBC</td>
                                <td class="p-2.5 text-right bg-white">—</td>
                                <td class="p-2.5 text-center bg-white">—</td>
                            </tr>
                            <tr>
                                <td class="p-2.5 bg-white">b) Using EBC / Non-Elec. Det</td>
                                <td class="p-2.5 text-right bg-white">—</td>
                                <td class="p-2.5 text-center bg-white">—</td>
                            </tr>
                            <tr>
                                <td class="p-2.5 pl-6 bg-white text-gray-600">SUPREME</td>
                                <td class="p-2.5 text-right bg-white font-bold">0</td>
                                <td class="p-2.5 text-center bg-white">—</td>
                            </tr>
                            <tr>
                                <td class="p-2.5 pl-6 bg-white text-gray-600">EXEL</td>
                                <td class="p-2.5 text-right bg-white font-bold">47,155</td>
                                <td class="p-2.5 text-center bg-white font-bold">5'X11"</td>
                            </tr>

                            <!-- Secondary Blasting -->
                            <tr class="border-t-2 border-gray-200">
                                <td class="p-2.5 pl-4 font-bold text-gray-900 bg-white" rowspan="4">2. Secondary :</td>
                                <td class="p-2.5 bg-white">a) Using OBC</td>
                                <td class="p-2.5 text-right bg-white font-bold">378</td>
                                <td class="p-2.5 text-center bg-white">—</td>
                            </tr>
                            <tr>
                                <td class="p-2.5 bg-white">b) Using EBC / Non-Elec. Det</td>
                                <td class="p-2.5 text-right bg-white">—</td>
                                <td class="p-2.5 text-center bg-white">—</td>
                            </tr>
                            <tr>
                                <td class="p-2.5 pl-6 bg-white text-gray-600">SUPREME</td>
                                <td class="p-2.5 text-right bg-white font-bold">0</td>
                                <td class="p-2.5 text-center bg-white font-bold">3'X11"</td>
                            </tr>
                            <tr>
                                <td class="p-2.5 pl-6 bg-white text-gray-600">EXEL</td>
                                <td class="p-2.5 text-right bg-white font-bold">520</td>
                                <td class="p-2.5 text-center bg-white">—</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- E. Total No. of Blasting Activity -->
            <div class="flex items-center gap-2 py-1 border-b border-gray-200">
                <span class="font-bold">E. Total No. of Blasting Activity for the month :</span>
                <span class="font-bold text-base text-gray-900 pl-2">1,982 Blast</span>
            </div>

            <!-- F. Tonnage Blasted -->
            <div class="space-y-2 border-b border-gray-200 pb-4">
                <div class="font-bold">F. Tonnage Blasted :</div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pl-6">
                    <div class="bg-gray-50 border border-gray-200 rounded-lg p-3 flex justify-between items-center">
                        <span class="font-semibold text-gray-700">Ore</span>
                        <span class="font-bold text-base text-gray-900">33,607.29</span>
                    </div>
                    <div class="bg-gray-50 border border-gray-200 rounded-lg p-3 flex justify-between items-center">
                        <span class="font-semibold text-gray-700">Waste</span>
                        <span class="font-bold text-base text-gray-900">6,543.20</span>
                    </div>
                </div>
            </div>

            <!-- G. Hole Spacing Used -->
            <div class="space-y-2 border-b border-gray-200 pb-4">
                <div class="font-bold">G. Hole Spacing Used :</div>
                <div class="pl-6 space-y-1">
                    <div class="flex items-center gap-2">
                        <span class="font-semibold text-gray-700 w-28">1. Primary :</span>
                        <span class="font-bold text-gray-900">18 INCHES OR MORE <span class="text-xs font-normal text-gray-500">(VARIES DEPENDS ON ROCK HARDNESS)</span></span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="font-semibold text-gray-700 w-28">2. Secondary :</span>
                        <span class="font-bold text-gray-900">24 INCHES OR MORE</span>
                    </div>
                </div>
            </div>

            <!-- H. Remarks -->
            <div class="space-y-2">
                <div class="font-bold">H. REMARKS <span class="text-xs font-normal text-gray-500">(regarding blasting problems encountered / explosion / fragmentation, etc.)</span></div>
                <div class="pl-6 pt-1">
                    <div class="bg-emerald-50 border border-emerald-200 text-emerald-900 p-3 rounded-lg font-semibold italic text-xs">
                        NO BLASTING PROBLEM ENCOUNTERED
                    </div>
                </div>
            </div>

        </div>

        {{--
        <!-- Excel-Style Bottom Tabs Container -->
        <div class="bg-gray-100 border-t border-gray-300 px-4 pt-2 flex items-center justify-end shrink-0">
            
            <div class="flex items-end gap-1">
                <!-- Tab 1 (Active) -->
                <button type="button" class="bg-white text-emerald-800 font-bold border-t-2 border-x border-t-emerald-700 border-x-gray-300 px-4 py-1.5 text-xs rounded-t shadow-xs flex items-center gap-2 cursor-pointer relative -mb-[1px] z-10">
                    <span class="border-b-2 border-emerald-700 pb-0.5">MAY 2026-PMC</span>
                </button>

                <!-- Tab 2 (Inactive) -->
                <button type="button" class="bg-emerald-50/60 hover:bg-white text-gray-700 font-medium border-t border-x border-gray-300 px-4 py-1.5 text-xs rounded-t transition cursor-pointer">
                    MAY 2026- EXPLO
                </button>

                <!-- Tab 3 (Inactive) -->
                <button type="button" class="bg-gray-200/70 hover:bg-white text-gray-600 font-medium border-t border-x border-gray-300 px-4 py-1.5 text-xs rounded-t transition cursor-pointer">
                    MAY 2026- TIGERWAY
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