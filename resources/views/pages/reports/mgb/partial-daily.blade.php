
<!-- Header Strip -->
@include('pages.reports.mgb.header')

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

<!-- Footer -->
@include('pages.reports.mgb.footer')

