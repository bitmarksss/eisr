<div class="relative bg-white w-full max-w-[98vw] rounded-xl shadow-2xl border border-gray-200 overflow-hidden transform transition-all z-110 flex flex-col max-h-[92vh]">
    
    <!-- Header Section (Placed Before Foreach) -->
    <div class="bg-white p-6 text-center space-y-2">
        <h2 class="text-base md:text-lg font-black uppercase tracking-wide text-gray-800">
            EXPLOSIVES WEEKLY CONSUMPTION
        </h2>
        <p class="text-sm font-bold text-gray-700">
            Period Covered : {{ request('start_date') ? \Carbon\Carbon::parse(request('start_date'))->format('F j, Y') : 'JUNE 1-7, 2026' }}
            @if(request('end_date')) - {{ \Carbon\Carbon::parse(request('end_date'))->format('F j, Y') }} @endif
        </p>
    </div>

    <!-- Scrollable Matrix Grid -->
    <div class="p-4 overflow-auto flex-1">
        <table class="w-full border-collapse border border-gray-300 text-xs text-center font-medium">
            <!-- Multi-Tier Header Structure -->
            <thead class="bg-emerald-50/70 text-gray-800 uppercase tracking-tight sticky top-0 z-20 shadow-xs">
                
                <tr class="bg-gray-100/80">
                    <th class="border border-gray-300 p-1 font-bold text-brand-navy" colspan="2">SUPPLIER</th>
                    <th class="border border-gray-300 p-1 font-bold text-brand-navy" colspan="16">Mt. Rock</th>
                </tr>
                <!-- Tier 1: Supplier Grouping -->
                <tr class="bg-gray-100/80">
                    <th class="border border-gray-300 p-2 sticky left-0 z-30" rowspan="5">Date</th>
                    <th class="border border-gray-300 p-2 sticky z-30" rowspan="5">Description</th>
                </tr>

                <!-- Tier 2: Product Name / Specification -->
                <tr class="bg-gray-100/80">
                    <th class="border border-gray-300 p-1" colspan="2">NEO PRIME</th>
                    <th class="border border-gray-300 p-1" colspan="2">NEOGEL</th>
                    <th class="border border-gray-300 p-1" colspan="2">NEOGEL</th>
                    <th class="border border-gray-300 p-1">Anfo</th>
                    <th class="border border-gray-300 p-1">S/Fuse</th>
                    <th class="border border-gray-300 p-1">OBC</th>
                    <th class="border border-gray-300 p-1">SUPREME TLD</th>
                    <th class="border border-gray-300 p-1">SUPREME</th>
                    <th class="border border-gray-300 p-1">SUPREME</th>
                    <th class="border border-gray-300 p-1">RIONEL IHD</th>
                    <th class="border border-gray-300 p-1">NEOCORD</th>
                    <th class="border border-gray-300 p-1">DETCORD</th>
                    <th class="border border-gray-300 p-1">EBC</th>
                </tr>
                <tr class="bg-gray-100/80">
                    <th class="border border-gray-300 p-1" colspan="2"></th>
                    <th class="border border-gray-300 p-1" colspan="2">901</th>
                    <th class="border border-gray-300 p-1" colspan="2">901</th>
                    <th class="border border-gray-300 p-1"></th>
                    <th class="border border-gray-300 p-1"></th>
                    <th class="border border-gray-300 p-1"></th>
                    <th class="border border-gray-300 p-1">17/MS25MS/42MS</th>
                    <th class="border border-gray-300 p-1">2.4</th>
                    <th class="border border-gray-300 p-1">4.9</th>
                    <th class="border border-gray-300 p-1">500MS/6M</th>
                    <th class="border border-gray-300 p-1">10</th>
                    <th class="border border-gray-300 p-1">40</th>
                    <th class="border border-gray-300 p-1"></th>
                </tr>
                <tr class="bg-gray-100/80">
                    <th class="border border-gray-300 p-1" colspan="2">93</th>
                    <th class="border border-gray-300 p-1" colspan="2">91</th>
                    <th class="border border-gray-300 p-1" colspan="2">200</th>
                    <th class="border border-gray-300 p-1"></th>
                    <th class="border border-gray-300 p-1"></th>
                    <th class="border border-gray-300 p-1"></th>
                    <th class="border border-gray-300 p-1"></th>
                    <th class="border border-gray-300 p-1"></th>
                    <th class="border border-gray-300 p-1"></th>
                    <th class="border border-gray-300 p-1"></th>
                    <th class="border border-gray-300 p-1"></th>
                    <th class="border border-gray-300 p-1"></th>
                    <th class="border border-gray-300 p-1"></th>
                </tr>

                <!-- Tier 3: Units of Measurement (UoM) -->
                <tr class="bg-gray-100/80 text-gray-600 font-bold">
                    <th class="border border-gray-300 p-1 w-20">Pcs</th>
                    <th class="border border-gray-300 p-1 w-20">Kls</th>
                    <th class="border border-gray-300 p-1 w-20">Pcs</th>
                    <th class="border border-gray-300 p-1 w-20">Kls</th>
                    <th class="border border-gray-300 p-1 w-20">Pcs</th>
                    <th class="border border-gray-300 p-1 w-20">Kls</th>
                    <th class="border border-gray-300 p-1 w-20">Kls</th>
                    <th class="border border-gray-300 p-1 w-20">Mtrs</th>
                    <th class="border border-gray-300 p-1 w-20">Pcs</th>
                    <th class="border border-gray-300 p-1 w-20">Mtrs</th>
                    <th class="border border-gray-300 p-1 w-20">Pcs</th>
                    <th class="border border-gray-300 p-1 w-20">Pcs</th>
                    <th class="border border-gray-300 p-1 w-20">Mtrs</th>
                    <th class="border border-gray-300 p-1 w-20">Mtrs</th>
                    <th class="border border-gray-300 p-1 w-20">Mtrs</th>
                    <th class="border border-gray-300 p-1 w-20">Pcs</th>
                </tr>
            </thead>

            <!-- Dynamic/Populated Row Structure -->
            <tbody id="rcsuModalTableBody" class="divide-y divide-gray-200 text-gray-800">
                
                <!-- Beginning Balance Grouping -->
                <tr class="bg-white">
                    <td class="border border-gray-300 p-2 font-bold bg-white sticky left-0 z-10">1-Jun-26</td>
                    <td class="border border-gray-300 p-2 font-bold text-left bg-white sticky z-10">Beginning Balance</td>
                    <!-- Dynamic values via JS -->
                    <td class="border border-gray-300 p-1">16,000</td>
                    <td class="border border-gray-300 p-1">5,084.74</td>
                    <td class="border border-gray-300 p-1">59,985</td>
                    <td class="border border-gray-300 p-1">12,344.4</td>
                    <td class="border border-gray-300 p-1">67,575.0</td>
                    <td class="border border-gray-300 p-1">13,600.00</td>
                    <td class="border border-gray-300 p-1">5,050</td>
                    <td class="border border-gray-300 p-1">180</td>
                    <td class="border border-gray-300 p-1">1,111.0</td>
                    <td class="border border-gray-300 p-1">18,796</td>
                    <td class="border border-gray-300 p-1">16,364.0</td>
                    <td class="border border-gray-300 p-1">12,660.0</td>
                    <td class="border border-gray-300 p-1">915</td>
                    <td class="border border-gray-300 p-1">90.0</td>
                    <td class="border border-gray-300 p-1">90.0</td>
                    <td class="border border-gray-300 p-1">90.0</td>
                </tr>

                <!-- Entry From Consignee -->
                <tr class="bg-white">
                    <td class="border border-gray-300 p-1 font-semibold text-left bg-gray-50" colspan="2">Entry From Consignee Magazine</td>
                    <td class="border border-gray-300 p-1"></td>
                    <td class="border border-gray-300 p-1">0</td>
                    <td class="border border-gray-300 p-1">27,300</td>
                    <td class="border border-gray-300 p-1">7,500</td>
                    <td class="border border-gray-300 p-1"></td>
                    <td class="border border-gray-300 p-1">0</td>
                    <td class="border border-gray-300 p-1"></td>
                    <td class="border border-gray-300 p-1">980</td>
                    <td class="border border-gray-300 p-1">500</td>
                    <td class="border border-gray-300 p-1">150</td>
                    <td class="border border-gray-300 p-1"></td>
                    <td class="border border-gray-300 p-1">6,820</td>
                    <td class="border border-gray-300 p-1">155</td>
                    <td class="border border-gray-300 p-1"></td>
                    <td class="border border-gray-300 p-1"></td>
                    <td class="border border-gray-300 p-1"></td>
                </tr>

                <!-- Total Stock On Hand Row -->
                <tr class="bg-gray-100 font-bold">
                    <td class="border border-gray-300 p-2 text-left sticky bg-gray-100" colspan="2">Total Stock On Hand</td>
                    <td class="border border-gray-300 p-1">6,882</td>
                    <td class="border border-gray-300 p-1">1,850</td>
                    <td class="border border-gray-300 p-1">40,586</td>
                    <td class="border border-gray-300 p-1">11,150</td>
                    <td class="border border-gray-300 p-1">15,400</td>
                    <td class="border border-gray-300 p-1">1,925</td>
                    <td class="border border-gray-300 p-1">1,800</td>
                    <td class="border border-gray-300 p-1">1,710</td>
                    <td class="border border-gray-300 p-1">1,296</td>
                    <td class="border border-gray-300 p-1">150</td>
                    <td class="border border-gray-300 p-1">1,757</td>
                    <td class="border border-gray-300 p-1">17,567</td>
                    <td class="border border-gray-300 p-1">155</td>
                    <td class="border border-gray-300 p-1">7724</td>
                    <td class="border border-gray-300 p-1">3375</td>
                    <td class="border border-gray-300 p-1">96</td>
                </tr>

                <!-- Weekly Consumption Row -->
                <tr class="bg-white font-bold">
                    <td class="border border-gray-300 p-2 text-left sticky bg-white" colspan="2">Less: Total Weekly Consumption</td>
                    <td class="border border-gray-300 p-1">651</td>
                    <td class="border border-gray-300 p-1">175</td>
                    <td class="border border-gray-300 p-1">182</td>
                    <td class="border border-gray-300 p-1">50</td>
                    <td class="border border-gray-300 p-1">0</td>
                    <td class="border border-gray-300 p-1">0</td>
                    <td class="border border-gray-300 p-1">125</td>
                    <td class="border border-gray-300 p-1">10</td>
                    <td class="border border-gray-300 p-1">10</td>
                    <td class="border border-gray-300 p-1">0</td>
                    <td class="border border-gray-300 p-1">0</td>
                    <td class="border border-gray-300 p-1">87</td>
                    <td class="border border-gray-300 p-1">0</td>
                    <td class="border border-gray-300 p-1">120</td>
                    <td class="border border-gray-300 p-1">150</td>
                    <td class="border border-gray-300 p-1">0</td>
                </tr>

                <!-- Remaining Stock Balance Row (Green highlighted footer row) -->
                <tr class="bg-emerald-100 font-bold text-brand-dark">
                    <td class="border border-gray-300 p-2 sticky left-0 bg-emerald-100">07-Jun-26</td>
                    <td class="border border-gray-300 p-2 text-left sticky left-[100px] bg-emerald-100" colspan="2">Remaining Stock Balance</td>
                    <td class="border border-gray-300 p-1">16,284</td>
                    <td class="border border-gray-300 p-1">5,120</td>
                    <td class="border border-gray-300 p-1">91,653</td>
                    <td class="border border-gray-300 p-1">16,027</td>
                    <td class="border border-gray-300 p-1">73,567.02</td>
                    <td class="border border-gray-300 p-1">16,316.09</td>
                    <td class="border border-gray-300 p-1">6,163</td>
                    <td class="border border-gray-300 p-1">273</td>
                    <td class="border border-gray-300 p-1">1,111</td>
                    <td class="border border-gray-300 p-1">48,481</td>
                    <td class="border border-gray-300 p-1">16,364</td>
                    <td class="border border-gray-300 p-1">19,505</td>
                    <td class="border border-gray-300 p-1">1,919</td>
                    <td class="border border-gray-300 p-1">306</td>
                    <td class="border border-gray-300 p-1">306</td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Footer / Signatures Block -->
    <div class="p-6 bg-white border-t border-gray-200">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 text-sm">
            
            <!-- Prepared By (2 columns on wide screens or stacked) -->
            <div class="space-y-6">
                <span class="font-bold text-gray-700 block">Prepared By:</span>
                <div>
                    <div class="font-bold underline text-gray-900">MR. JOHNNY U. GALENG</div>
                    <div class="text-gray-600">Blaster Foreman</div>
                    <div class="text-gray-500">Mount Rock Powder Corp.</div>
                </div>
            </div>

            <div class="space-y-6">
                <span class="font-bold text-gray-700 block">&nbsp;</span>
                <div>
                    <div class="font-bold underline text-gray-900">MR. JOHN XERCES C. ANTIPUESTO</div>
                    <div class="text-gray-600">Blaster Foreman Expedition</div>
                    <div class="text-gray-500">Expedition MBDI Inc.</div>
                </div>
            </div>

            <!-- Checked By -->
            <div class="space-y-6">
                <span class="font-bold text-gray-700 block">Checked by:</span>
                <div>
                    <div class="font-bold underline text-gray-900">MR. NHOLL GREAL O. LOZADA</div>
                    <div class="text-gray-600">Inventory/Warehouseman Supervisor</div>
                    <div class="text-gray-500">Mine Explosive Dept.</div>
                </div>
            </div>

            <!-- Certified Correct By -->
            <div class="space-y-6">
                <span class="font-bold text-gray-700 block">Certified Correct by:</span>
                <div>
                    <div class="font-bold underline text-gray-900">ENGR. EDWIN B. BATAL</div>
                    <div class="text-gray-600">Mine Explosives Asst. Manager</div>
                </div>
            </div>
            
            <div class="space-y-6">
                <span class="font-bold text-gray-700 block">&nbsp;</span>
                <div>
                    <div class="font-bold underline text-gray-900">MR. JOHN XERCES C. ANTIPUESTO</div>
                    <div class="text-gray-600">Blaster Foreman Expedition</div>
                    <div class="text-gray-500">Expedition MBDInc</div>
                </div>
            </div>

        </div>
    </div>
</div>