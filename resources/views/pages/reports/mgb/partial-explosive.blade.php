<!-- Header Strip -->
@include('pages.reports.mgb.header')

<!-- Main Report Body Container -->
<div class="p-6 text-xs text-gray-800 space-y-6 overflow-auto flex-1">
    
    <!-- Top Project Details / Metadata Header Table -->
    <div class="">
        <table class="w-full border-collapse text-left text-xs">
            <tbody>
                <tr>
                    <td class="py-1.5 font-bold text-gray-700 w-44">Company</td>
                    <td class="py-1.5 font-bold text-red-600">: PHILSAGA MINING CORPORATION. - EXPLORATION PROJECT<br><span class="text-xs text-red-500 font-semibold">(MPSA No. 262-2008-XIII PARCEL-2)</span></td>
                    <td class="py-1.5 font-bold text-gray-700 text-right w-24">DATE</td>
                    <td class="py-1.5 font-bold text-gray-900 text-right w-40">MAY 1-31,2026</td>
                </tr>
                <tr>
                    <td class="py-1.5 font-bold text-gray-700">Project site Address</td>
                    <td class="py-1.5 font-bold text-red-600">: BAYUGAN 3, ROSARIO, AGUSAN DEL SUR</td>
                    <td class="py-1.5 font-bold text-gray-700 text-right">PPEL No.P-</td>
                    <td class="py-1.5 font-bold text-gray-900 text-right">0425-298-2011</td>
                </tr>
                <tr>
                    <td class="py-1.5 font-bold text-gray-700">Head of Project</td>
                    <td class="py-1.5 font-bold text-red-600">: ENGR. EARL M. SON</td>
                    <td class="py-1.5 font-bold text-gray-700 text-right">BPL No.F-</td>
                    <td class="py-1.5 font-bold text-gray-900 text-right">EXPL-0411128</td>
                </tr>
                <tr>
                    <td class="py-1.5 font-bold text-gray-700">Drilling and Blasting Engineer/s</td>
                    <td class="py-1.5 font-bold text-red-600">: ENGR. RAFFY D. TORRES</td>
                    <td class="py-1.5" colspan="2"></td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Items Inventory Table Viewport -->
    <div class="relative overflow-auto border border-gray-400 rounded-lg shadow-2xs">
        <table class="w-full border-collapse border border-gray-400 text-xs text-center font-medium">
            
            <!-- Table Headers -->
            <thead class="bg-gray-100 text-gray-900 font-bold uppercase tracking-tight sticky top-0 z-20">
                <tr class="border-b border-gray-400">
                    <th class="border border-gray-400 p-2.5 text-left w-1/4">ITEM</th>
                    <th class="border border-gray-400 p-2.5 w-28">UNIT</th>
                    <th class="border border-gray-400 p-2.5">BRAND</th>
                    <th class="border border-gray-400 p-2.5">SUPPLIERS/CONTRACTOR</th>
                    <th class="border border-gray-400 p-2.5">SPECIFICATION</th>
                    <th class="border border-gray-400 p-2.5 w-28">QUANTITY USED<br><span class="text-[10px] text-gray-600">PCS/METERS</span></th>
                    <th class="border border-gray-400 p-2.5 w-24">QUANTITY USED<br><span class="text-[10px] text-gray-600">KLS</span></th>
                </tr>
            </thead>

            <!-- Table Body with Dynamic Watermark Overlay -->
            <tbody class="divide-y divide-gray-300 text-gray-800 relative bg-white">
                
                <!-- A. DYNA / EMULSION -->
                <tr>
                    <td class="border border-gray-400 p-2 font-bold text-left bg-gray-50/50">A. DYNA / EMULSION</td>
                    <td class="border border-gray-400 p-2 font-semibold">Pieces/Kilograms</td>
                    <td class="border border-gray-400 p-2">SENATEL PULSAR 215</td>
                    <td class="border border-gray-400 p-2">EXPEDITION MBDInc.</td>
                    <td class="border border-gray-400 p-2 text-gray-600">25x 200mm</td>
                    <td class="border border-gray-400 p-2">—</td>
                    <td class="border border-gray-400 p-2">—</td>
                </tr>

                <!-- B. Ammonium Nitrate fuel oil (ANFO) -->
                <tr>
                    <td class="border border-gray-400 p-2 font-bold text-left bg-gray-50/50">B. Ammonium Nitrate fuel oil (ANFO)</td>
                    <td class="border border-gray-400 p-2 font-semibold">Kilograms</td>
                    <td class="border border-gray-400 p-2">PEXPO ANFO</td>
                    <td class="border border-gray-400 p-2">EXPEDITION MBDInc.</td>
                    <td class="border border-gray-400 p-2 text-gray-600">25 KGS/BAG</td>
                    <td class="border border-gray-400 p-2">—</td>
                    <td class="border border-gray-400 p-2">—</td>
                </tr>

                <!-- C. Slurry -->
                <tr>
                    <td class="border border-gray-400 p-2 font-bold text-left bg-gray-50/50">C. Slurry</td>
                    <td class="border border-gray-400 p-2 font-semibold">Kilograms</td>
                    <td class="border border-gray-400 p-2">—</td>
                    <td class="border border-gray-400 p-2">EXPEDITION MBDInc.</td>
                    <td class="border border-gray-400 p-2">—</td>
                    <td class="border border-gray-400 p-2">—</td>
                    <td class="border border-gray-400 p-2">—</td>
                </tr>

                <!-- D. Electric Blasting CAP -->
                <tr>
                    <td class="border border-gray-400 p-2 font-bold text-left bg-gray-50/50">D. Electric Blasting CAP</td>
                    <td class="border border-gray-400 p-2 font-semibold">Pieces</td>
                    <td class="border border-gray-400 p-2">EBC</td>
                    <td class="border border-gray-400 p-2">EXPEDITION MBDInc.</td>
                    <td class="border border-gray-400 p-2">—</td>
                    <td class="border border-gray-400 p-2">—</td>
                    <td class="border border-gray-400 p-2">—</td>
                </tr>

                <!-- E. Ordinary Blasting CAP -->
                <tr>
                    <td class="border border-gray-400 p-2 font-bold text-left bg-gray-50/50">E. Ordinary Blasting CAP</td>
                    <td class="border border-gray-400 p-2 font-semibold">Pieces</td>
                    <td class="border border-gray-400 p-2">OBC</td>
                    <td class="border border-gray-400 p-2">EXPEDITION MBDInc.</td>
                    <td class="border border-gray-400 p-2 text-gray-600">(#8)</td>
                    <td class="border border-gray-400 p-2">—</td>
                    <td class="border border-gray-400 p-2">—</td>
                </tr>

                <!-- F. Non Electric / LP Detonator (Row 1) -->
                <tr>
                    <td class="border border-gray-400 p-2 font-bold text-left bg-gray-50/50" rowspan="2">F. Non Electric / LP Detonator</td>
                    <td class="border border-gray-400 p-2 font-semibold">Pieces</td>
                    <td class="border border-gray-400 p-2">EXEL LP</td>
                    <td class="border border-gray-400 p-2">EXPEDITION MBDInc.</td>
                    <td class="border border-gray-400 p-2 text-gray-600">2.4 METER</td>
                    <td class="border border-gray-400 p-2">—</td>
                    <td class="border border-gray-400 p-2">—</td>
                </tr>

                <!-- F. Non Electric / LP Detonator (Row 2) -->
                <tr>
                    <td class="border border-gray-400 p-2 font-semibold">Pieces</td>
                    <td class="border border-gray-400 p-2">EXEL LP</td>
                    <td class="border border-gray-400 p-2">EXPEDITION MBDInc.</td>
                    <td class="border border-gray-400 p-2 text-gray-600">3.6 METER</td>
                    <td class="border border-gray-400 p-2">—</td>
                    <td class="border border-gray-400 p-2">—</td>
                </tr>

                <!-- G. Safety Fuse -->
                <tr>
                    <td class="border border-gray-400 p-2 font-bold text-left bg-gray-50/50">G. Safety Fuse</td>
                    <td class="border border-gray-400 p-2 font-semibold">Meter</td>
                    <td class="border border-gray-400 p-2">SAFETY FUSE</td>
                    <td class="border border-gray-400 p-2">EXPEDITION MBDInc.</td>
                    <td class="border border-gray-400 p-2 text-gray-600">410mmx410mmx270mm</td>
                    <td class="border border-gray-400 p-2">—</td>
                    <td class="border border-gray-400 p-2">—</td>
                </tr>

                <!-- H. Detonating Cords -->
                <tr>
                    <td class="border border-gray-400 p-2 font-bold text-left bg-gray-50/50">H. Detonating Cords</td>
                    <td class="border border-gray-400 p-2 font-semibold">Meter</td>
                    <td class="border border-gray-400 p-2">CORDTEX</td>
                    <td class="border border-gray-400 p-2">EXPEDITION MBDInc.</td>
                    <td class="border border-gray-400 p-2 text-gray-600">5 GRAMS/METER</td>
                    <td class="border border-gray-400 p-2">—</td>
                    <td class="border border-gray-400 p-2">—</td>
                </tr>

                <!-- I. Primer (Row 1) -->
                <tr>
                    <td class="border border-gray-400 p-2 font-bold text-left bg-gray-50/50" rowspan="2">I. Primer</td>
                    <td class="border border-gray-400 p-2 font-semibold" rowspan="2">Pieces</td>
                    <td class="border border-gray-400 p-2">PENTEX(STOPE PRIME)</td>
                    <td class="border border-gray-400 p-2">EXPEDITION MBDInc.</td>
                    <td class="border border-gray-400 p-2 text-gray-600">250 GRAMS/PIECE</td>
                    <td class="border border-gray-400 p-2">—</td>
                    <td class="border border-gray-400 p-2">—</td>
                </tr>

                <!-- I. Primer (Row 2) -->
                <tr>
                    <td class="border border-gray-400 p-2">PENTEX(PRIME SPIDER)</td>
                    <td class="border border-gray-400 p-2">EXPEDITION MBDInc.</td>
                    <td class="border border-gray-400 p-2">—</td>
                    <td class="border border-gray-400 p-2">—</td>
                    <td class="border border-gray-400 p-2">—</td>
                </tr>

                <!-- J. Connector Cord -->
                <tr>
                    <td class="border border-gray-400 p-2 font-bold text-left bg-gray-50/50" rowspan="2">J. Connector Cord</td>
                    <td class="border border-gray-400 p-2 font-semibold" rowspan="2">Meter</td>
                    <td class="border border-gray-400 p-2">—</td>
                    <td class="border border-gray-400 p-2">—</td>
                    <td class="border border-gray-400 p-2">—</td>
                    <td class="border border-gray-400 p-2">—</td>
                    <td class="border border-gray-400 p-2">—</td>
                </tr>
                <tr>
                    <td class="border border-gray-400 p-2">—</td>
                    <td class="border border-gray-400 p-2">—</td>
                    <td class="border border-gray-400 p-2">—</td>
                    <td class="border border-gray-400 p-2">—</td>
                    <td class="border border-gray-400 p-2">—</td>
                </tr>

                <!-- K. Fuse Lighter -->
                <tr>
                    <td class="border border-gray-400 p-2 font-bold text-left bg-gray-50/50">K. Fuse Lighter</td>
                    <td class="border border-gray-400 p-2 font-semibold">Pieces</td>
                    <td class="border border-gray-400 p-2">FIRE FUSE</td>
                    <td class="border border-gray-400 p-2">EXPEDITION MBDInc.</td>
                    <td class="border border-gray-400 p-2">—</td>
                    <td class="border border-gray-400 p-2">—</td>
                    <td class="border border-gray-400 p-2">—</td>
                </tr>

                <!-- L. Spitter/Igniter Cord -->
                <tr>
                    <td class="border border-gray-400 p-2 font-bold text-left bg-gray-50/50">L. Spitter/Igniter Cord</td>
                    <td class="border border-gray-400 p-2 font-semibold">Meter</td>
                    <td class="border border-gray-400 p-2">—</td>
                    <td class="border border-gray-400 p-2">—</td>
                    <td class="border border-gray-400 p-2">—</td>
                    <td class="border border-gray-400 p-2">—</td>
                    <td class="border border-gray-400 p-2">—</td>
                </tr>

                <!-- M. Bill Wire -->
                <tr>
                    <td class="border border-gray-400 p-2 font-bold text-left bg-gray-50/50">M. Bill Wire</td>
                    <td class="border border-gray-400 p-2 font-semibold">Meter</td>
                    <td class="border border-gray-400 p-2">—</td>
                    <td class="border border-gray-400 p-2">—</td>
                    <td class="border border-gray-400 p-2">—</td>
                    <td class="border border-gray-400 p-2">—</td>
                    <td class="border border-gray-400 p-2">—</td>
                </tr>

                <!-- Diagonal Watermark Overlay Text -->
                <!-- <tr class="pointer-events-none select-none">
                    <td colspan="7" class="p-0 border-0">
                        <div class="absolute inset-x-0 top-1/2 -translate-y-1/2 flex items-center justify-center pointer-events-none z-10">
                            <span class="text-red-600/80 font-black tracking-widest text-xl sm:text-2xl md:text-3xl border-2 md:border-4 border-red-600/80 px-6 py-2 rounded-md -rotate-12 uppercase drop-shadow-xs bg-white/70 backdrop-blur-[1px]">
                                NO BLASTING OPERATION
                            </span>
                        </div>
                    </td>
                </tr> -->

            </tbody>
        </table>
    </div>
</div>

@include('pages.reports.mgb.footer')