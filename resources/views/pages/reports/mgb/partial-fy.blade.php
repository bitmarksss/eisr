<!-- Header -->
@include('pages.reports.mgb.header')


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
                <td class="border border-gray-400 p-2 text-left bg-rose-50/80" colspan="5">Beginning Stock as of May 1, 2026</td>
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
                <td class="border border-gray-400 p-2 text-left bg-rose-50/80" colspan="5">Remaining Stock as of May 31, 2026</td>
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

<!-- Footer -->
<!-- Footer / Sign-off Section -->
<div class="p-4 text-xs font-sans text-gray-900 leading-relaxed">
    <div class="grid grid-cols-12 gap-4">
        
        <!-- Column 1: Jurat / Notary Details -->
        <div class="col-span-3 space-y-3">
            <div>
                <p>Subscribed and sworn to before me this ____________ day</p>
                <p>of __________________, 20 _____</p>
            </div>

            <div class="pt-4 space-y-1 text-xs">
                <div class="flex items-center">
                    <span class="w-20 font-semibold">Doc. No.</span>
                    <span class="border-b border-gray-800 w-36 inline-block">&nbsp;</span>
                </div>
                <div class="flex items-center">
                    <span class="w-20 font-semibold">Page of</span>
                    <span class="border-b border-gray-800 w-36 inline-block">&nbsp;</span>
                </div>
                <div class="flex items-center">
                    <span class="w-20 font-semibold">Book of</span>
                    <span class="border-b border-gray-800 w-36 inline-block">&nbsp;</span>
                </div>
                <div class="flex items-center">
                    <span class="w-20 font-semibold">Series of</span>
                    <span class="border-b border-gray-800 w-36 inline-block">&nbsp;</span>
                </div>
            </div>
        </div>

        <!-- Column 2: License Form & Notary Public Signature Block -->
        <div class="col-span-3 flex flex-col justify-between">
            <div class="grid grid-cols-2 gap-2">
                <div>
                    <span class="font-semibold">Form of License</span>
                </div>
                <div class="border-b border-gray-800 font-bold uppercase">
                    BLASTER FOREMAN
                </div>
            </div>

            <div class="pt-6 space-y-1 text-start">
                <div class="border-b border-gray-800 w-full mb-1"></div>
                <p class="font-bold uppercase tracking-wide">NOTARY PUBLIC</p>
                <p>Until Dec. 31, 20_______________</p>
                <p>Ptr No. ________________________</p>
            </div>
        </div>

        <div class="col-span-3 flex flex-col justify-between">
            <span class="border-b border-gray-800 font-bold tracking-wider inline-block">
                FKB15 - 080917- 04562
            </span>
        </div>


        <!-- Column 3: License No. & Respectfully Submitted Block -->
        <div class="col-span-3 flex flex-col justify-between">
            <div class="space-y-1">
                <p class="font-semibold">Very respectfully</p>
                <div class="pt-4">
                    <p class="font-bold underline uppercase tracking-wide">MR. RAFFY D. TORRES</p>
                    <p>Con. Tax. Cert. No. CC1202213000572</p>
                    <p>Issued at Consuelo Bunawan Agusan del Sur</p>
                    <p>Dated Issued: June 5, 2025</p>
                </div>
            </div>
        </div>

    </div>
</div>