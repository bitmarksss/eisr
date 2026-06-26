<div id="addInventoryModal" class="fixed inset-0 z-110 flex items-center justify-center p-4 opacity-0 pointer-events-none">

    <div class="relative bg-white w-full max-w-lg rounded-2xl shadow-2xl border border-gray-100 overflow-hidden transform transition-all z-10 animate-fade-in">
        
        <div class="px-6 py-4 bg-brand-green text-white flex justify-between items-center">
            <h3 class="font-bold tracking-wide text-lg">Add New Inventory Registry</h3>
            <button onclick="window.closeModal()" class="text-white/70 hover:text-white font-bold text-xl cursor-pointer p-1">✕</button>
        </div>

        <form action="#" method="POST" class="p-6 space-y-4">
            @csrf
            
            <div>
                <label for="modal_item_name" class="block text-xs font-bold text-brand-dark uppercase tracking-wider mb-1">Item Title / Descriptor</label>
                <input type="text" id="modal_item_name" name="item_name" required placeholder="e.g., Heavy Duty Machine Bolts"
                    class="w-full bg-gray-50 border border-gray-300 rounded-lg px-3 py-2 text-sm focus:border-brand-gold focus:outline-none transition focus:ring-2 focus:ring-brand-gold/20">
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="modal_sku" class="block text-xs font-bold text-brand-dark uppercase tracking-wider mb-1">SKU Barcode Reference</label>
                    <input type="text" id="modal_sku" name="sku" required placeholder="PMC-XXX-00"
                        class="w-full bg-gray-50 border border-gray-300 rounded-lg px-3 py-2 text-sm focus:border-brand-gold focus:outline-none transition">
                </div>
                <div>
                    <label for="modal_quantity" class="block text-xs font-bold text-brand-dark uppercase tracking-wider mb-1">Initial Unit Count</label>
                    <input type="number" id="modal_quantity" name="quantity" min="0" required placeholder="0"
                        class="w-full bg-gray-50 border border-gray-300 rounded-lg px-3 py-2 text-sm focus:border-brand-gold focus:outline-none transition">
                </div>
            </div>

            <div class="pt-4 flex justify-end space-x-3 border-t border-gray-100">
                <button type="button" onclick="window.closeModal()" class="px-4 py-2 text-sm font-semibold text-gray-500 hover:text-gray-700 transition cursor-pointer">
                    Cancel Process
                </button>
                <button type="submit" class="px-5 py-2 rounded-lg bg-brand-gold hover:bg-brand-gold-hover text-white text-sm font-bold shadow-xs transition cursor-pointer">
                    Save Asset Record
                </button>
            </div>
        </form>

    </div>
</div>