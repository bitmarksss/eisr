<div id="addInventoryModal" class="fixed inset-0 z-110 flex items-center justify-center p-4 opacity-0 pointer-events-none">

    <!-- Backdrop Layout Grid -->
    <div id="backdrop" class="absolute z-100 inset-0 bg-brand-dark/10 backdrop-blur-xs"
    onclick="window.closeModal()"></div>

    <!-- Central Window Frame Area -->
    <div class="relative bg-white w-full max-w-lg rounded-2xl shadow-2xl border border-gray-100 overflow-hidden transform transition-all z-110 animate-fade-in">
        
        <!-- Header Strip -->
        <div class="px-6 py-4 bg-brand-green text-white flex justify-between items-center">
            <h3 class="font-bold tracking-wide text-lg">Add New Inventory Registry</h3>
            <button onclick="window.closeModal()" class="text-white/70 hover:text-white font-bold text-xl cursor-pointer p-1">✕</button>
        </div>

        <!-- Master Store Submission Form Layout -->
        <form action="{{ route('surface.inventory.store') }}" method="POST" class="p-6 space-y-4">
            @csrf
            
            <!-- 1. Name Field (Updated to name="name") -->
            <div>
                <label for="item_name" class="block text-xs font-bold text-brand-dark uppercase tracking-wider mb-1">Item Title / Descriptor</label>
                <input type="text" id="item_name" name="name" value="{{ old('item_name') }}" required placeholder="e.g., Heavy Duty Machine Bolts"
                    class="w-full bg-gray-50 border @error('item_name') border-red-500 @else border-gray-300 @enderror rounded-lg px-3 py-2 text-sm focus:border-brand-gold focus:outline-none transition focus:ring-2 focus:ring-brand-gold/20">
                @error('item_name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- 2. Supplier field -->
            <div>
                <label for="supplier-id" class="block text-xs font-bold text-brand-dark uppercase tracking-wider mb-1">Supplier</label>
                <select id="supplier-id" name="supplier_id" required
                    class="w-full bg-gray-50 border @error('supplier_id') border-red-500 @else border-gray-300 @enderror rounded-lg p-2 text-sm focus:border-brand-gold focus:outline-none transition">
                    <option value="" disabled selected>Select Supplier</option>
                    @foreach($suppliers as $supplier)
                        <option value="{{ $supplier->id }}" {{ old('supplier_id') == $supplier->id ? 'selected' : '' }}>{{ $supplier->name }}</option>
                    @endforeach
                </select>
                @error('supplier_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- 3. item_code Field (Mapped to name="item_code") -->
            <div>
                <label for="modal_item_code" class="block text-xs font-bold text-brand-dark uppercase tracking-wider mb-1">Item Code Barcode Reference</label>
                <input type="text" id="modal_item_code" name="item_code" value="{{ old('item_code') }}" required placeholder="e.g., PMC-MCH-552"
                    class="w-full bg-gray-50 border @error('item_code') border-red-500 @else border-gray-300 @enderror rounded-lg px-3 py-2 text-sm focus:border-brand-gold focus:outline-none transition">
                @error('item_code') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <!-- 3. Category Field (New Field Mapped to name="category") -->
                <div>
                    <label for="modal_category" class="block text-xs font-bold text-brand-dark uppercase tracking-wider mb-1">Category</label>
                    <select id="modal_category" name="category" required
                        class="w-full bg-gray-50 border @error('category') border-red-500 @else border-gray-300 @enderror rounded-lg p-2 text-sm focus:border-brand-gold focus:outline-none transition">
                        <option value="" disabled selected>Select Category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category') == $category->id ? 'selected' : '' }}>{{ $category->kind }}</option>
                        @endforeach
                    </select>
                    @error('category') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- 4. Quantity Field (Mapped to name="quantity") -->
                <div>
                    <label for="modal_quantity" class="block text-xs font-bold text-brand-dark uppercase tracking-wider mb-1">Initial Unit Count</label>
                    <div class="flex">
                        <input type="number" id="modal_quantity" name="quantity" value="{{ old('quantity', '') }}" min="0" placeholder="0"
                            class="w-full bg-gray-50 border @error('quantity') border-red-500 @else border-gray-300 @enderror rounded-tl-lg rounded-bl-lg px-3 py-2 text-sm focus:border-brand-gold focus:outline-none transition">
                        @error('quantity') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    <select class="bg-gray-50 border border-l-transparent border-gray-300 rounded-tr-lg rounded-br-lg px-3 py-2 text-sm focus:border-brand-gold focus:outline-none transition">
                        @foreach($uoms as $key => $unit)
                            <option value="{{ $unit->id }}" {{ old('uom') == $unit->id ? 'selected' : '' }}>{{ $unit->unit }}</option>
                        @endforeach
                    </select>
                    </div>
                </div>
            </div>

            <!-- Footer Bottom Section -->
            <div class="pt-4 flex justify-end space-x-3 border-t border-gray-100">
                <button type="button" onclick="window.closeModal()" class="px-4 py-2 text-sm font-semibold text-gray-500 hover:text-gray-700 transition cursor-pointer">
                    Cancel Process
                </button>
                <button type="submit" class="px-5 py-2 rounded-lg bg-brand-gold hover:bg-brand-gold-hover text-white text-sm font-bold shadow-xs transition cursor-pointer">
                    Save Inventory Item
                </button>
            </div>
        </form>

    </div>
</div>