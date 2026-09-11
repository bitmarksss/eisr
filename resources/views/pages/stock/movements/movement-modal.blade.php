

<div id="movementModal" class="hidden fixed inset-0 z-110 flex items-center justify-center p-4" role="dialog" aria-modal="true" aria-labelledby="modalTitle">
    <div class="absolute z-100 inset-0 bg-brand-dark/10 backdrop-blur-xs" onclick="closeMovementModal()"></div>
    <div class="relative bg-white w-full max-w-4xl max-h-[90vh] rounded-2xl shadow-2xl border border-gray-100 overflow-hidden z-110 animate-fade-in">
        <div class="px-6 py-4 bg-brand-green text-white flex justify-between items-center [&>button]:text-white/70 [&>button]:hover:text-white [&>button]:font-bold [&>button]:text-xl [&>button]:cursor-pointer [&>button]:p-1">
            <h3 id="modalTitle" class="font-bold text-lg"></h3>
            <button type="button" onclick="closeMovementModal()">✕</button>
        </div>
        <div id="modalBody" class="p-6 space-y-5 overflow-y-auto max-h-[calc(90vh-132px)]">

        </div>
        <div class="pt-4 px-6 pb-6 border-t border-gray-100 flex justify-end space-x-3">
            <button type="button" onclick="closeMovementModal()" class="px-4 py-2 text-sm font-semibold text-gray-500 hover:text-gray-700 transition cursor-pointer">Close</button>
        </div>
    </div>
</div>

<div id="editMovementModal" class="hidden fixed inset-0 z-110 flex items-center justify-center p-4" role="dialog" aria-modal="true" aria-labelledby="editModalTitle">
    <div class="absolute z-100 inset-0 bg-brand-dark/10 backdrop-blur-xs" onclick="closeEditMovementModal()"></div>
    <div class="relative z-110 flex max-h-[90vh] w-full max-w-4xl flex-col overflow-hidden rounded-2xl border border-gray-100 bg-white shadow-2xl animate-fade-in">
        <div class="flex items-center justify-between bg-brand-gold px-6 py-4 text-white [&>button]:text-white/70 [&>button]:hover:text-white [&>button]:font-bold [&>button]:text-xl [&>button]:cursor-pointer [&>button]:p-1">
            <h3 id="editModalTitle" class="text-lg font-bold"></h3>
            <button type="button" onclick="closeEditMovementModal()">✕</button>
        </div>
        <div id="editModalBody" class="max-h-[calc(90vh-72px)] overflow-y-auto p-6"></div>
    </div>
</div>

<div id="cancelConfirmModal" class="hidden fixed inset-0 z-[120] flex items-center justify-center p-4" role="dialog" aria-modal="true" aria-labelledby="cancelConfirmTitle">
    <div class="absolute inset-0 bg-brand-dark/20 backdrop-blur-xs" onclick="closeCancelModal()"></div>
    <div class="relative z-[121] w-full max-w-md rounded-2xl bg-white p-6 shadow-2xl">
        <div class="flex items-start gap-3"><span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-red-100 text-red-600"><i class="fa-solid fa-ban"></i></span><div><h3 id="cancelConfirmTitle" class="text-lg font-bold text-brand-navy">Cancel movement record?</h3><p class="mt-1 text-sm text-gray-600">This record will be marked as cancelled and can no longer be approved or edited.</p></div></div>
        <div class="mt-6 flex justify-end gap-3"><button type="button" onclick="closeCancelModal()" class="rounded-lg px-4 py-2 text-sm font-semibold text-gray-500 hover:bg-gray-100">Keep record</button><button type="button" onclick="submitCancelForm()" class="rounded-lg bg-red-500 px-4 py-2 text-sm font-bold text-white hover:bg-red-600">Cancel record</button></div>
    </div>
</div>
