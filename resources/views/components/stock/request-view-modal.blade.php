<div id="stockRequestModal" class="hidden fixed inset-0 z-110 flex items-center justify-center p-4" role="dialog" aria-modal="true" aria-labelledby="stockRequestModalTitle">
    <div class="absolute inset-0 bg-brand-dark/20 backdrop-blur-xs" data-close-stock-request-modal></div>
    <div class="relative z-110 flex max-h-[90vh] w-full max-w-4xl flex-col overflow-hidden rounded-2xl border border-gray-100 bg-white shadow-2xl animate-fade-in">
        <div class="flex items-center justify-between bg-brand-green px-6 py-4 text-white">
            <div>
                <h3 id="stockRequestModalTitle" class="text-lg font-bold">Stock Request Details</h3>
                <p id="stockRequestModalSubtitle" class="mt-0.5 text-xs text-white/70"></p>
            </div>
            <button type="button" data-close-stock-request-modal class="cursor-pointer p-1 text-xl font-bold text-white/70 hover:text-white" aria-label="Close stock request details">&times;</button>
        </div>
        <div id="stockRequestModalBody" class="max-h-[calc(90vh-132px)] space-y-5 overflow-y-auto p-6"></div>
        <div class="flex justify-end border-t border-gray-100 px-6 py-4">
            <button type="button" data-close-stock-request-modal class="cursor-pointer px-4 py-2 text-sm font-semibold text-gray-500 transition hover:text-gray-700">Close</button>
        </div>
    </div>
</div>
