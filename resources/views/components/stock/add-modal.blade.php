<div id="addStockRequestModal" class="fixed inset-0 z-110 flex items-center justify-center p-4 opacity-0 pointer-events-none">

    <!-- Backdrop -->
    <div class="absolute z-100 inset-0 bg-brand-dark/10 backdrop-blur-xs" onclick="window.closeModal()"></div>

    <!-- Central Window Frame Area -->
    <div class="relative bg-white w-full max-w-lg rounded-2xl shadow-2xl border border-gray-100 overflow-hidden transform transition-all z-110 animate-fade-in">
        
        <!-- Header Strip -->
        <div class="px-6 py-4 bg-brand-green text-white flex justify-between items-center">
            <h3 class="font-bold tracking-wide text-lg">Create Stock Request</h3>
            <button onclick="window.closeModal()" class="text-white/70 hover:text-white font-bold text-xl cursor-pointer p-1">✕</button>
        </div>

        <!-- Submission Form Layout -->
        <form action="{{ route($location . '.stock.store') }}" method="POST" class="p-6 space-y-4">
            @csrf
            
            <!-- 1. Inventory Item Name (Type) -->
            <div>
                <label for="type" class="block text-xs font-bold text-brand-dark uppercase tracking-wider mb-1">Inventory Item Name / Type</label>
                <input type="text" id="type" name="type" value="{{ old('type') }}" required placeholder="e.g., Emulsion 25mm x 200mm"
                    class="w-full bg-gray-50 border @error('type') border-red-500 @else border-gray-300 @enderror rounded-lg px-3 py-2 text-sm focus:border-brand-gold focus:outline-none transition focus:ring-2 focus:ring-brand-gold/20">
                @error('type') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- 2. Kind Selection -->
            <div>
                <label for="kind" class="block text-xs font-bold text-brand-dark uppercase tracking-wider mb-1">Inventory Kind Group</label>
                <select id="kind" name="kind" required
                    class="w-full bg-gray-50 border @error('kind') border-red-500 @else border-gray-300 @enderror rounded-lg p-2 text-sm focus:border-brand-gold focus:outline-none transition">
                    <option value="" disabled selected>Select Kind Classification</option>
                    @foreach($kinds as $kindOption)
                        <option value="{{ $kindOption }}" {{ old('kind') == $kindOption ? 'selected' : '' }}>{{ $kindOption }}</option>
                    @endforeach
                </select>
                @error('kind') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- 3. Supplier (Mapped inside our payload JSON field) -->
            <div>
                <label for="supplier_id" class="block text-xs font-bold text-brand-dark uppercase tracking-wider mb-1">Target Supplier Brand</label>
                <select id="supplier_id" name="quantity[supplier_id]" required
                    class="w-full bg-gray-50 border rounded-lg p-2 text-sm focus:border-brand-gold focus:outline-none transition">
                    <option value="" disabled selected>Select Supplier</option>
                    @foreach($suppliers as $supplier)
                        <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <!-- 4. Quantity Field (Mapped inside JSON array value) -->
                <div>
                    <label for="quantity_val" class="block text-xs font-bold text-brand-dark uppercase tracking-wider mb-1">Requested Quantity</label>
                    <div class="flex">
                        <input type="number" id="quantity_val" name="quantity[quantity]" required min="1" placeholder="0"
                            class="w-full bg-gray-50 border border-gray-300 rounded-tl-lg rounded-bl-lg px-3 py-2 text-sm focus:border-brand-gold focus:outline-none transition">
                        
                        <select name="uom_id" required class="bg-gray-50 border border-l-transparent border-gray-300 rounded-tr-lg rounded-br-lg px-3 py-2 text-sm focus:border-brand-gold focus:outline-none transition">
                            @foreach($uoms as $unit)
                                <option value="{{ $unit->id }}">{{ $unit->unit }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <!-- 5. Remarks Field -->
            <div>
                <label for="remarks" class="block text-xs font-bold text-brand-dark uppercase tracking-wider mb-1">Additional Remarks (Optional)</label>
                <textarea id="remarks" name="remarks" rows="2" placeholder="Provide reason or storage destinations..."
                    class="w-full bg-gray-50 border border-gray-300 rounded-lg px-3 py-2 text-sm focus:border-brand-gold focus:outline-none transition"></textarea>
            </div>

            <!-- Footer Bottom Section -->
            <div class="pt-4 flex justify-end space-x-3 border-t border-gray-100">
                <button type="button" onclick="window.closeModal()" class="px-4 py-2 text-sm font-semibold text-gray-500 hover:text-gray-700 transition cursor-pointer">
                    Cancel
                </button>
                <button type="submit" class="px-5 py-2 rounded-lg bg-brand-gold hover:bg-brand-gold-hover text-white text-sm font-bold shadow-xs transition cursor-pointer">
                    Submit Request
                </button>
            </div>
        </form>

    </div>
</div>