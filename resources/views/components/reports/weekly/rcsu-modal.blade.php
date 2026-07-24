<div id="rcsuModal" class="fixed inset-0 z-110 flex items-center justify-center p-2 sm:p-4 opacity-0 pointer-events-none transition-opacity duration-200">

    <!-- Backdrop -->
    <div id="rcsuModalBackdrop" class="absolute z-100 inset-0 bg-brand-dark/20 backdrop-blur-xs" onclick="closeRcsuModal()"></div>

    <!-- Central Window Frame (Extra wide to fit matrix columns) -->
    <div class="relative bg-white w-full max-w-[98vw] rounded-2xl shadow-2xl border border-gray-200 overflow-hidden transform transition-all z-110 flex flex-col max-h-[92vh]">
        
        <!-- Header Strip -->
        <div class="px-6 py-4 bg-brand-green text-white flex justify-between items-center shrink-0">
            <div>
                <h3 class="font-bold tracking-wider uppercase text-lg" id="reportModalTitle">Explosives Weekly Consumption</h3>
                <p class="text-xs text-brand-gold font-medium" id="reportModalDateRange">JUNE 1–7, 2026</p>
            </div>
            <button type="button" onclick="closeRcsuModal()" class="text-white/70 hover:text-white font-bold text-xl cursor-pointer p-1">✕</button>
        </div>

        <!-- Scrollable Matrix Grid -->
        <div class="p-4 overflow-auto flex-1">
            <table class="w-full border-collapse border border-gray-300 text-xs text-center font-medium">
                <!-- Multi-Tier Header Structure -->
                <thead class="bg-emerald-50/70 text-gray-800 uppercase tracking-tight sticky top-0 z-20 shadow-xs">
                    
                    <!-- Tier 1: Supplier Grouping -->
                    <tr>
                        <th class="border border-gray-300 p-2 min-w-[50px] bg-emerald-100/80 sticky left-0 z-30" rowspan="3">Date</th>
                        <th class="border border-gray-300 p-2 min-w-[180px] bg-emerald-100/80 sticky left-[100px] z-30" rowspan="3" colspan="2">Description</th>
                        <th class="border border-gray-300 p-1 font-bold text-brand-navy" colspan="2">Mt. Rock</th>
                        <th class="border border-gray-300 p-1 font-bold text-brand-navy" colspan="2">Expedition</th>
                        <th class="border border-gray-300 p-1 font-bold text-brand-navy" colspan="3">Mt. Rock / Expedition</th>
                        <th class="border border-gray-300 p-1 font-bold text-brand-navy">Expedition</th>
                        <th class="border border-gray-300 p-1 font-bold text-brand-navy" colspan="3">Mt. Rock / Expedition</th>
                        <th class="border border-gray-300 p-1 font-bold text-brand-navy" colspan="2">Mt. Rock / Expedition</th>
                    </tr>

                    <!-- Tier 2: Product Name / Specification -->
                    <tr>
                        <th class="border border-gray-300 p-1" colspan="2">Emulsion 200 (Neogel)</th>
                        <th class="border border-gray-300 p-1" colspan="2">Emulsion 215 (Senatel/Pulsar)</th>
                        <th class="border border-gray-300 p-1">Anfo</th>
                        <th class="border border-gray-300 p-1">S/Fuse</th>
                        <th class="border border-gray-300 p-1">OBC</th>
                        <th class="border border-gray-300 p-1">Fuse Lighter</th>
                        <th class="border border-gray-300 p-1">Nonel (2.4/3.6)</th>
                        <th class="border border-gray-300 p-1">Exel (2.4/3.6/4.9)</th>
                        <th class="border border-gray-300 p-1">Supreme (2.4/3.6)</th>
                        <th class="border border-gray-300 p-1">Cordtex (5/10/5/40)</th>
                        <th class="border border-gray-300 p-1">Billwire</th>
                        <th class="border border-gray-300 p-1">EBC</th>
                    </tr>

                    <!-- Tier 3: Units of Measurement (UoM) -->
                    <tr class="bg-gray-100/80 text-gray-600 font-bold">
                        <th class="border border-gray-300 p-1 w-20">Pcs</th>
                        <th class="border border-gray-300 p-1 w-20">Kls</th>
                        <th class="border border-gray-300 p-1 w-20">Pcs</th>
                        <th class="border border-gray-300 p-1 w-20">Kls</th>
                        <th class="border border-gray-300 p-1 w-20">Kls</th>
                        <th class="border border-gray-300 p-1 w-20">Mtrs</th>
                        <th class="border border-gray-300 p-1 w-20">Pcs</th>
                        <th class="border border-gray-300 p-1 w-20">Pcs</th>
                        <th class="border border-gray-300 p-1 w-20">Pcs</th>
                        <th class="border border-gray-300 p-1 w-20">Pcs</th>
                        <th class="border border-gray-300 p-1 w-20">Pcs</th>
                        <th class="border border-gray-300 p-1 w-20">Mtrs</th>
                        <th class="border border-gray-300 p-1 w-20">Mtrs</th>
                        <th class="border border-gray-300 p-1 w-20">Pcs</th>
                    </tr>
                </thead>

                <!-- Dynamic/Populated Row Structure -->
                <tbody id="rcsuModalTableBody" class="divide-y divide-gray-200 text-gray-800">
                    
                    <!-- Beginning Balance Grouping -->
                    <tr class="bg-white">
                        <td class="border border-gray-300 p-2 font-bold bg-white sticky left-0 z-10" rowspan="3">1-Jun-26</td>
                        <td class="border border-gray-300 p-2 font-bold text-left bg-white sticky left-[100px] z-10" rowspan="3">Beginning Balance</td>
                        <td class="border border-gray-300 p-1 font-semibold text-left bg-gray-50">Surface</td>
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
                    </tr>
                    <tr class="bg-white">
                        <td class="border border-gray-300 p-1 font-semibold text-left bg-gray-50">Underground</td>
                        <td class="border border-gray-300 p-1">11,350</td>
                        <td class="border border-gray-300 p-1">1,418.75</td>
                        <td class="border border-gray-300 p-1">41,019</td>
                        <td class="border border-gray-300 p-1">4,769.65</td>
                        <td class="border border-gray-300 p-1">13,762</td>
                        <td class="border border-gray-300 p-1">5,788</td>
                        <td class="border border-gray-300 p-1">2,377</td>
                        <td class="border border-gray-300 p-1">95</td>
                        <td class="border border-gray-300 p-1">0</td>
                        <td class="border border-gray-300 p-1">40,800</td>
                        <td class="border border-gray-300 p-1">0</td>
                        <td class="border border-gray-300 p-1">12,123</td>
                        <td class="border border-gray-300 p-1">1,030</td>
                        <td class="border border-gray-300 p-1">244</td>
                    </tr>
                    <tr class="bg-gray-100 font-bold">
                        <td class="border border-gray-300 p-1 text-left bg-gray-100">TOTAL</td>
                        <td class="border border-gray-300 p-1">27,350</td>
                        <td class="border border-gray-300 p-1">6,503.49</td>
                        <td class="border border-gray-300 p-1">101,004</td>
                        <td class="border border-gray-300 p-1">17,114.07</td>
                        <td class="border border-gray-300 p-1">81,336.82</td>
                        <td class="border border-gray-300 p-1">19,387.61</td>
                        <td class="border border-gray-300 p-1">7,427</td>
                        <td class="border border-gray-300 p-1">275</td>
                        <td class="border border-gray-300 p-1">1,111.0</td>
                        <td class="border border-gray-300 p-1">59,596</td>
                        <td class="border border-gray-300 p-1">16,364.0</td>
                        <td class="border border-gray-300 p-1">24,783.0</td>
                        <td class="border border-gray-300 p-1">1,945</td>
                        <td class="border border-gray-300 p-1">334</td>
                    </tr>

                    <!-- Entry From Consignee Row -->
                    <tr class="bg-white">
                        <td class="border border-gray-300 p-2 font-bold sticky left-0 bg-white"></td>
                        <td class="border border-gray-300 p-2 font-bold text-left sticky left-[100px] bg-white" colspan="2">Entry From Consignee Magazine</td>
                        <td class="border border-gray-300 p-1"></td>
                        <td class="border border-gray-300 p-1">0.00</td>
                        <td class="border border-gray-300 p-1"></td>
                        <td class="border border-gray-300 p-1">0.00</td>
                        <td class="border border-gray-300 p-1" colspan="10"></td>
                    </tr>

                    <!-- Total Stock On Hand Row -->
                    <tr class="bg-gray-100 font-bold">
                        <td class="border border-gray-300 p-2 sticky left-0 bg-gray-100"></td>
                        <td class="border border-gray-300 p-2 text-left sticky left-[100px] bg-gray-100" colspan="2">Total Stock On Hand</td>
                        <td class="border border-gray-300 p-1">27,350</td>
                        <td class="border border-gray-300 p-1">6,503.49</td>
                        <td class="border border-gray-300 p-1">101,004</td>
                        <td class="border border-gray-300 p-1">17,114.07</td>
                        <td class="border border-gray-300 p-1">81,336.82</td>
                        <td class="border border-gray-300 p-1">19,387.61</td>
                        <td class="border border-gray-300 p-1">7,427</td>
                        <td class="border border-gray-300 p-1">275</td>
                        <td class="border border-gray-300 p-1">1,111</td>
                        <td class="border border-gray-300 p-1">59,596</td>
                        <td class="border border-gray-300 p-1">16,364</td>
                        <td class="border border-gray-300 p-1">24,783</td>
                        <td class="border border-gray-300 p-1">1,945</td>
                        <td class="border border-gray-300 p-1">334</td>
                    </tr>

                    <!-- Weekly Consumption Row -->
                    <tr class="bg-white font-bold">
                        <td class="border border-gray-300 p-2 sticky left-0 bg-white"></td>
                        <td class="border border-gray-300 p-2 text-left sticky left-[100px] bg-white" colspan="2">Less: Total Weekly Consumption</td>
                        <td class="border border-gray-300 p-1">11,066</td>
                        <td class="border border-gray-300 p-1">1,383.25</td>
                        <td class="border border-gray-300 p-1">9,351</td>
                        <td class="border border-gray-300 p-1">1,087.33</td>
                        <td class="border border-gray-300 p-1">7,770</td>
                        <td class="border border-gray-300 p-1">3,071.52</td>
                        <td class="border border-gray-300 p-1">1,264</td>
                        <td class="border border-gray-300 p-1">2</td>
                        <td class="border border-gray-300 p-1"></td>
                        <td class="border border-gray-300 p-1">11,115</td>
                        <td class="border border-gray-300 p-1"></td>
                        <td class="border border-gray-300 p-1">5,278</td>
                        <td class="border border-gray-300 p-1">26</td>
                        <td class="border border-gray-300 p-1">28</td>
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
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Footer Bar -->
        <div class="px-6 py-3 bg-gray-50 border-t border-gray-200 flex justify-between items-center shrink-0">
            <span class="text-xs text-gray-500 font-semibold">Note: Scroll horizontally to view all product categories.</span>
            <button type="button" onclick="closeRcsuModal()" class="px-5 py-2 rounded-lg bg-brand-gold hover:bg-brand-gold-hover text-white text-xs font-bold transition cursor-pointer">
                Close Report
            </button>
        </div>
    </div>
</div>