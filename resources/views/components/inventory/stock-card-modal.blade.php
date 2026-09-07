<div id="stockCardModal" class="fixed inset-0 z-110 flex items-center justify-center p-4 opacity-0 pointer-events-none">

    <!-- Backdrop -->
    <div class="absolute inset-0 bg-gray-950/40 backdrop-blur-xs" onclick="window.closeModal()"></div>

    <!-- Modal Box Container -->
    <div class="relative bg-white w-full max-w-7xl rounded-xl shadow-xl overflow-hidden border border-gray-200 flex flex-col max-h-[90vh]">
        
        <!-- Header Section -->
        <div class="p-6 border-b border-gray-100 flex items-center justify-between">
            <h3 class="text-lg font-bold text-brand-navy uppercase cursor-pointer tracking-wider">Explosives Stock Card View</h3>
            <button type="button" onclick="window.closeModal()" class="text-gray-400 hover:text-gray-600 text-xl font-bold">✕</button>
        </div>

        <!-- Context Metadata Row -->
        <div class="p-6 bg-gray-50 border-b border-gray-100 flex flex-wrap gap-6 items-center">
            <div class="flex items-center space-x-3">
                <span class="text-xs font-bold uppercase tracking-wider text-gray-500">Item Name:</span>
                <span id="modal_item_name" class="text-sm font-semibold text-brand-dark">Dynamite (Emulsion Type)</span>
            </div>
            <div class="flex items-center space-x-3">
                <span class="text-xs font-bold uppercase tracking-wider text-gray-500">Kind:</span>
                <span id="modal_item_kind" class="text-sm font-bold text-brand-navy">High Explosive</span>
            </div>
        </div>

        <!-- Scrollable Dynamic Form Table Grid -->
        <div class="overflow-auto flex-1 p-6">
            <table class="w-full text-left border border-gray-200 rounded-lg text-xs uppercase font-medium text-gray-600">
                <thead class="bg-gray-50 text-center select-none sticky top-0 z-10">
                    <tr>
                        <th rowspan="2" class="border border-gray-200 p-2 text-brand-navy">Date</th>
                        <th rowspan="2" class="border border-gray-200 p-2 text-brand-navy">Beginning</th>
                        <th rowspan="2" class="border border-gray-200 p-2 text-brand-navy">Incoming</th>
                        <th rowspan="2" class="border border-gray-200 p-2 text-brand-navy">Outgoing</th>
                        <th rowspan="2" class="border border-gray-200 p-2 text-brand-navy">Ending</th>
                        <th rowspan="2" class="border border-gray-200 p-2 text-brand-navy">UoM</th>
                        <!-- <th colspan="2" class="border border-gray-200 p-1.5 bg-gray-100 text-[10px] text-brand-navy">Checked By</th>
                        <th colspan="3" class="border border-gray-200 p-1.5 bg-gray-100 text-[10px] text-brand-navy">Witnessed By</th>
                        <th rowspan="2" class="border border-gray-200 p-2 text-center text-brand-navy">Actions</th> 
                        -->
                    </tr>
                    <!-- <tr class="bg-gray-50 text-[9px] font-normal text-gray-500">
                        <th class="border border-gray-200 p-1">Mag. Warehouseman</th>
                        <th class="border border-gray-200 p-1">Foreman Blaster</th>
                        <th class="border border-gray-200 p-1">Security On Duty</th>
                        <th class="border border-gray-200 p-1">PNP Rep.</th>
                        <th class="border border-gray-200 p-1">Army Rep.</th>
                    </tr> -->
                </thead>
                <tbody id="stockFormRows" class="bg-white divide-y divide-gray-200 text-gray-700">
                    
                    <!-- Rows are populated when the stock card is opened. -->

                </tbody>
            </table>
        </div>

        <!-- Modal Actions Control Footer -->
        <div class="p-4 bg-gray-50 border-t border-gray-100 flex justify-end items-center">
            <button type="button" onclick="window.closeModal()" 
                class="bg-white hover:bg-gray-100 border border-gray-300 text-brand-dark font-bold px-5 py-2.5 rounded-lg shadow-2xs text-xs cursor-pointer tracking-wider transition">
                Close
            </button>
        </div>
    </div>
</div>
