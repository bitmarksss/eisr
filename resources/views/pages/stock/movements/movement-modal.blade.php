

<div id="movementModal" class="hidden fixed inset-0 z-110 flex items-center justify-center p-4" role="dialog" aria-modal="true" aria-labelledby="modalTitle">
    <div class="absolute z-100 inset-0 bg-brand-dark/10 backdrop-blur-xs" onclick="closeMovementModal()"></div>
    <div class="relative bg-white w-full max-w-3xl rounded-2xl shadow-2xl border border-gray-100 overflow-hidden z-110 animate-fade-in">
        <div class="px-6 py-4 bg-brand-green text-white flex justify-between items-center [&>button]:text-white/70 [&>button]:hover:text-white [&>button]:font-bold [&>button]:text-xl [&>button]:cursor-pointer [&>button]:p-1">
            <h3 id="modalTitle" class="font-bold text-lg"></h3>
            <button type="button" onclick="closeMovementModal()">✕</button>
        </div>
        <div id="modalBody" class="p-6 space-y-4">

        </div>
        <div class="pt-4 px-6 pb-6 border-t border-gray-100 flex justify-end space-x-3">
            <button type="button" onclick="closeMovementModal()" class="px-4 py-2 text-sm font-semibold text-gray-500 hover:text-gray-700 transition cursor-pointer">Close</button>
        </div>
    </div>
</div>