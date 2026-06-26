<div id="editInventoryModal" class="fixed inset-0 z-110 flex items-center justify-center p-4 opacity-0 pointer-events-none transition-opacity duration-200">

    <!-- Backdrop Layout Grid -->
    <div id="editBackdrop" class="absolute z-100 inset-0 bg-brand-dark/10 backdrop-blur-xs"
    onclick="window.closeModal()"></div>

    <!-- Central Window Frame Area -->
    <div class="relative bg-white w-full max-w-lg rounded-2xl shadow-2xl border border-gray-100 overflow-hidden transform transition-all z-110 animate-fade-in">
        
        <!-- Header Strip -->
        <div class="px-6 py-4 bg-brand-green text-white flex justify-between items-center">
            <h3 class="font-bold tracking-wide text-lg">Modify Asset Registry</h3>
            <button onclick="window.closeModal()" class="text-white/70 hover:text-white font-bold text-xl cursor-pointer p-1">✕</button>
        </div>

        <!-- Master Update Submission Form Layout -->
        <form id="editInventoryForm" action="" method="POST" class="p-6 space-y-4">
            @csrf
            @method('PUT') <!-- Spoofs a PUT method required by Laravel resource updates -->
            
            <!-- 1. Name Field (Mapped to name="name") -->
            <div>
                <label for="edit_modal_item_name" class="block text-xs font-bold text-brand-dark uppercase tracking-wider mb-1">Item Title / Descriptor</label>
                <input type="text" id="edit_modal_item_name" name="name" required placeholder="e.g., Heavy Duty Machine Bolts"
                    class="w-full bg-gray-50 border @error('name') border-red-500 @else border-gray-300 @enderror rounded-lg px-3 py-2 text-sm focus:border-brand-gold focus:outline-none transition focus:ring-2 focus:ring-brand-gold/20">
                @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- 2. SKU Field (Mapped to name="sku") -->
            <div>
                <label for="edit_modal_sku" class="block text-xs font-bold text-brand-dark uppercase tracking-wider mb-1">SKU Barcode Reference</label>
                <input type="text" id="edit_modal_sku" name="sku" required placeholder="e.g., PMC-MCH-552"
                    class="w-full bg-gray-50 border @error('sku') border-red-500 @else border-gray-300 @enderror rounded-lg px-3 py-2 text-sm focus:border-brand-gold focus:outline-none transition">
                @error('sku') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <!-- 3. Category Field (Mapped to name="category") -->
                <div>
                    <label for="edit_modal_category" class="block text-xs font-bold text-brand-dark uppercase tracking-wider mb-1">Category Group</label>
                    <select id="edit_modal_category" name="category" required
                        class="w-full bg-gray-50 border @error('category') border-red-500 @else border-gray-300 @enderror rounded-lg p-2 text-sm focus:border-brand-gold focus:outline-none transition">
                        <option value="" disabled>Select Category</option>
                        <option value="Mechanical">Mechanical</option>
                        <option value="Hydraulics">Hydraulics</option>
                        <option value="Electrical">Electrical</option>
                    </select>
                    @error('category') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- 4. Quantity Field (Mapped to name="quantity") -->
                <div>
                    <label for="edit_modal_quantity" class="block text-xs font-bold text-brand-dark uppercase tracking-wider mb-1">Available Quantity Count</label>
                    <input type="number" id="edit_modal_quantity" name="quantity" min="0" required placeholder="0"
                        class="w-full bg-gray-50 border @error('quantity') border-red-500 @else border-gray-300 @enderror rounded-lg px-3 py-2 text-sm focus:border-brand-gold focus:outline-none transition">
                    @error('quantity') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <!-- Footer Bottom Section -->
            <div class="pt-4 flex justify-end space-x-3 border-t border-gray-100">
                <button type="button" onclick="window.closeModal()" class="px-4 py-2 text-sm font-semibold text-gray-500 hover:text-gray-700 transition cursor-pointer">
                    Cancel Process
                </button>
                <button type="submit" class="px-5 py-2 rounded-lg bg-brand-gold hover:bg-brand-gold-hover text-white text-sm font-bold shadow-xs transition cursor-pointer">
                    Apply Modifications
                </button>
            </div>
        </form>

    </div>
</div>