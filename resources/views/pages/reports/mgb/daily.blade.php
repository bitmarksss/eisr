@extends('layouts.app')

@section('page-title', 'Explosive Daily Consumption - Exploration Project')

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
                <h3 class="font-bold tracking-wider uppercase text-lg">Explosive Daily Consumption - Exploration Project</h3>
                <p class="text-xs text-brand-gold font-medium">MPSA No. 262-2008-XIII PARCEL-2 &nbsp;|&nbsp; MONTH OF MAY 2026</p>
            </div>
        </div>

        <!-- Scrollable Matrix Viewport -->
        <div class="p-4 overflow-auto flex-1 relative">
            <table class="w-full border-collapse border border-gray-400 text-xs text-center font-medium">
                
                <!-- Multi-Tiered Column Headers -->
                <thead class="bg-emerald-50/50 text-gray-800 uppercase tracking-tight shadow-xs">
                    
                    <!-- Tier 1: Supplier -->
                    <tr class="bg-emerald-100/60 font-bold text-gray-900 border-b border-gray-400">
                        <th class="border border-gray-400 p-2 bg-emerald-100">SUPPLIER</th>
                        <th class="border border-gray-400 p-2" colspan="11">EXPEDITION</th>
                    </tr>

                    <!-- Tier 2: Category -->
                    <tr class="bg-gray-50 font-bold text-gray-800 border-b border-gray-400">
                        <th class="border border-gray-400 p-1.5 bg-gray-100" rowspan="4">Date</th>
                        <th class="border border-gray-400 p-1.5" colspan="2">EMULSION</th>
                        <th class="border border-gray-400 p-1.5" rowspan="3">Anfo</th>
                        <th class="border border-gray-400 p-1.5" colspan="3">DETONATOR</th>
                        <th class="border border-gray-400 p-1.5">DETONATING</th>
                        <th class="border border-gray-400 p-1.5" rowspan="3">S/Fuse</th>
                        <th class="border border-gray-400 p-1.5" rowspan="3">Billwire</th>
                        <th class="border border-gray-400 p-1.5" rowspan="3">FUSE LIGHTER</th>
                    </tr>

                    <!-- Tier 3: Model / Spec -->
                    <tr class="bg-gray-50 font-semibold text-gray-700">
                        <th class="border border-gray-400 p-1" colspan="2">215</th>
                        <th class="border border-gray-400 p-1" colspan="2">EXEL</th>
                        <th class="border border-gray-400 p-1">OBC</th>
                        <th class="border border-gray-400 p-1">EBC</th>
                        <th class="border border-gray-400 p-1">Cordtex</th>
                    </tr>

                    <!-- Tier 4: Brand -->
                    <tr class="bg-gray-50 text-[11px] text-gray-700">
                        <th class="border border-gray-400 p-1" colspan="2">Senatel/Pulsar</th>
                        <th class="border border-gray-400 p-1">3.6</th>
                        <th class="border border-gray-400 p-1">2.4</th>
                        <th class="border border-gray-400 p-1"></th>
                        <th class="border border-gray-400 p-1"></th>
                        <th class="border border-gray-400 p-1">5</th>
                    </tr>

                    <!-- Units Row -->
                    <tr class="bg-gray-100 text-gray-900 font-bold text-[11px] border-b-2 border-gray-400">
                        <th class="border border-gray-400 p-1 w-16">Pcs</th>
                        <th class="border border-gray-400 p-1 w-16">Kls</th>
                        <th class="border border-gray-400 p-1 w-16">Kls</th>
                        <th class="border border-gray-400 p-1 w-16">Pcs</th>
                        <th class="border border-gray-400 p-1 w-16">Pcs</th>
                        <th class="border border-gray-400 p-1 w-16">Pcs</th>
                        <th class="border border-gray-400 p-1 w-16">Pcs</th>
                        <th class="border border-gray-400 p-1 w-16">Mtrs</th>
                        <th class="border border-gray-400 p-1 w-16">Mtrs</th>
                        <th class="border border-gray-400 p-1 w-16">Mtrs</th>
                        <th class="border border-gray-400 p-1 w-16">Pcs</th>
                    </tr>
                </thead>

                <!-- Table Body -->
                <tbody class="divide-y divide-gray-300 text-gray-800 relative">
                    
                    <!-- Empty Matrix Rows (8 rows as shown in report image) -->
                    @for ($i = 0; $i < 8; $i++)
                    <tr class="h-8 hover:bg-gray-50/50">
                        <td class="border border-gray-400 p-1 bg-white"></td>
                        <td class="border border-gray-400 p-1"></td>
                        <td class="border border-gray-400 p-1"></td>
                        <td class="border border-gray-400 p-1"></td>
                        <td class="border border-gray-400 p-1"></td>
                        <td class="border border-gray-400 p-1"></td>
                        <td class="border border-gray-400 p-1"></td>
                        <td class="border border-gray-400 p-1"></td>
                        <td class="border border-gray-400 p-1"></td>
                        <td class="border border-gray-400 p-1"></td>
                        <td class="border border-gray-400 p-1"></td>
                        <td class="border border-gray-400 p-1"></td>
                    </tr>
                    @endfor

                    <!-- Diagonal Watermark Overlay Text -->
                    <!-- <tr class="pointer-events-none select-none">
                        <td colspan="12" class="p-0 border-0">
                            <div class="absolute inset-x-0 top-1/2 -translate-y-1/2 flex items-center justify-center pointer-events-none z-10">
                                <span class="text-red-600/80 font-black tracking-widest text-xl sm:text-2xl md:text-3xl border-2 md:border-4 border-red-600/80 px-6 py-2 rounded-md -rotate-12 uppercase drop-shadow-xs bg-white/70 backdrop-blur-[1px]">
                                    NO BLASTING OPERATION
                                </span>
                            </div>
                        </td>
                    </tr> -->

                </tbody>

                <!-- Table Footer: Total Consumption -->
                <tfoot>
                    <tr class="bg-gray-200/90 text-gray-900 font-bold border-t-2 border-gray-400">
                        <td class="border border-gray-400 p-2 text-center bg-gray-200">Total Consumption</td>
                        <td class="border border-gray-400 p-1.5">0.0</td>
                        <td class="border border-gray-400 p-1.5">0.00</td>
                        <td class="border border-gray-400 p-1.5">0.00</td>
                        <td class="border border-gray-400 p-1.5">0.0</td>
                        <td class="border border-gray-400 p-1.5">0.0</td>
                        <td class="border border-gray-400 p-1.5">0.0</td>
                        <td class="border border-gray-400 p-1.5">0.0</td>
                        <td class="border border-gray-400 p-1.5">0.0</td>
                        <td class="border border-gray-400 p-1.5">0.00</td>
                        <td class="border border-gray-400 p-1.5">0.0</td>
                        <td class="border border-gray-400 p-1.5">0.0</td>
                    </tr>
                </tfoot>
            </table>
        </div>

        {{--
        <!-- Excel-Style Bottom Tabs Container -->
        <div class="bg-gray-100 border-t border-gray-300 px-4 pt-2 flex items-center justify-end shrink-0">
            <div class="flex items-end gap-1">
                <!-- Tab 1 (Inactive) -->
                <button type="button" class="bg-gray-200/70 hover:bg-white text-gray-600 font-medium border-t border-x border-gray-300 px-4 py-1.5 text-xs rounded-t transition cursor-pointer">
                    MAY 2026-PMC
                </button>

                <!-- Tab 2 (Active) -->
                <button type="button" class="bg-white text-emerald-800 font-bold border-t-2 border-x border-t-emerald-700 border-x-gray-300 px-4 py-1.5 text-xs rounded-t shadow-xs flex items-center gap-2 cursor-pointer relative -mb-[1px] z-10">
                    <span class="border-b-2 border-emerald-700 pb-0.5">MAY 2026- EXPLO</span>
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