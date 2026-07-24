<div id="consumptionModal" class="fixed inset-0 z-110 flex items-center justify-center p-4 opacity-0 pointer-events-none transition-opacity duration-200">

    <!-- Backdrop -->
    <div id="consumptionModalBackdrop" class="absolute z-100 inset-0 bg-brand-dark/20 backdrop-blur-xs" onclick="closeConsumptionModal()"></div>

    <!-- Central Window Area -->
    <div class="relative bg-white w-full max-w-6xl rounded-2xl shadow-2xl border border-gray-200 overflow-hidden transform transition-all z-110 animate-fade-in flex flex-col max-h-[90vh]">
        
        <!-- Header Strip -->
        <div class="px-6 py-4 bg-brand-green text-white flex justify-between items-center shrink-0">
            <div class="flex items-center space-x-3">
                <h3 id="consumptionModalTitle" class="font-bold tracking-wide text-lg">Surface Consumption Report</h3>
                <!-- <span id="stockCardItemTitle" class="text-xs bg-brand-gold text-brand-dark px-2.5 py-0.5 rounded-full font-bold uppercase"></span> -->
            </div>
            <button type="button" onclick="closeConsumptionModal()" class="text-white/70 hover:text-white font-bold text-xl cursor-pointer p-1">✕</button>
        </div>

        <!-- Modal Body / Table Container -->
        <div class="p-6 overflow-auto flex-1">
            <div class="pb-4 flex items-center space-x-3">
                <span class="text-xs font-bold uppercase tracking-wider text-gray-500">Item Name:</span>
                <span id="itemName" class="text-sm font-semibold text-brand-dark">PLACEHOLDER</span>
            </div>

            <table class="w-full text-left border-collapse border border-gray-300 text-xs">
                <thead>
                    <tr class="bg-gray-100 text-brand-navy font-bold uppercase text-center tracking-wider border-b border-gray-300">
                        <th class="border border-gray-300 p-2 min-w-[140px]">Kind</th>
                        <th class="border border-gray-300 p-2 w-16">UoM</th>
                        <th class="border border-gray-300 p-2 min-w-[100px]">Entry Date</th>
                        <th class="border border-gray-300 p-2 w-20">Quantity</th>
                        <th class="border border-gray-300 p-2 min-w-[110px]">Date Withdrawn</th>
                        <th class="border border-gray-300 p-2 w-28">Quantity Withdrawn</th>
                        <th class="border border-gray-300 p-2 w-20">Balance</th>
                        <th class="border border-gray-300 p-2 min-w-[130px]">Remarks</th>
                        <th class="border border-gray-300 p-2 min-w-[130px]">Notes</th>
                    </tr>
                </thead>
                <tbody id="stockCardTableBody" class="divide-y divide-gray-200 bg-white font-medium text-gray-700">
                    <!-- Dynamic rows populated via JavaScript -->
                </tbody>
            </table>
        </div>

        <!-- Modal Footer -->
        <div class="px-6 py-3 bg-gray-50 border-t border-gray-200 flex justify-end shrink-0">
            <button type="button" onclick="closeConsumptionModal()" class="px-5 py-2 rounded-lg bg-gray-200 hover:bg-gray-300 text-gray-700 text-xs font-bold transition cursor-pointer">
                Close
            </button>
        </div>
    </div>
</div>