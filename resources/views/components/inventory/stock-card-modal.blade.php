<div id="stockCardModal" class="fixed inset-0 z-110 flex items-center justify-center p-4 opacity-0 pointer-events-none">

    <!-- Backdrop -->
    <div 
        data-action="close-modal"
        class="absolute z-100 inset-0 bg-brand-dark/10 backdrop-blur-xs"
    ></div>

    <!-- Modal Box Container -->
    <div class="relative z-110 bg-white w-full max-w-7xl rounded-2xl shadow-2xl overflow-hidden border border-gray-100 flex flex-col max-h-[90vh] animate-fade-in">
        
        <!-- Header Section -->
        <div class="px-6 py-4 bg-brand-green text-white flex items-center justify-between">
            <h3 class="text-lg font-bold text-white uppercase cursor-pointer tracking-wider">Explosives Stock Card View</h3>
            <button type="button" onclick="window.closeModal()" class="text-white/70 hover:text-white text-xl font-bold cursor-pointer p-1" aria-label="Close stock card modal">✕</button>
        </div>

        <!-- Context Metadata Row -->
        <div class="p-6 bg-gray-50 border-b border-gray-100 flex flex-wrap gap-6 items-center">
            <div class="flex items-center space-x-3">
                <span class="text-xs font-bold uppercase tracking-wider text-gray-500">Item Name:</span>
                <span id="modal_item_name" class="text-sm font-semibold text-brand-dark">Loading...</span>
            </div>
            <div class="flex items-center space-x-3">
                <span class="text-xs font-bold uppercase tracking-wider text-gray-500">Kind:</span>
                <span id="modal_item_kind" class="text-sm font-bold text-brand-navy">Loading...</span>
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
                    <!-- Loading skeleton is the default/reset state. -->
                    <tr class="animate-pulse"><td colspan="6" class="p-0"><div class="space-y-3 p-4"><div class="h-4 rounded bg-gray-200"></div><div class="h-4 rounded bg-gray-100"></div><div class="h-4 rounded bg-gray-200"></div><div class="h-4 rounded bg-gray-100"></div><div class="h-4 rounded bg-gray-200"></div></div></td></tr>
                </tbody>
            </table>
        </div>

        <!-- Modal Actions Control Footer -->
        <div class="pt-4 px-6 pb-6 bg-white border-t border-gray-100 flex justify-end items-center space-x-3">
            <button type="button" 
                data-action="close-modal"
                class="px-4 py-2 text-sm font-semibold text-gray-500 hover:text-gray-700 transition cursor-pointer">
                Close
            </button>
        </div>
    </div>
</div>
