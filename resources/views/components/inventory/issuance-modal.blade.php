<div id="issuanceModal" class="fixed inset-0 z-110 flex items-center justify-center p-4 opacity-0 pointer-events-none transition-opacity duration-200">

    <!-- Backdrop Layout Grid -->
    <div id="editBackdrop" class="absolute z-100 inset-0 bg-brand-dark/10 backdrop-blur-xs"
    onclick="window.closeModal()"></div>

    <!-- Central Window Frame Area -->
    <div class="relative bg-white w-full max-w-6xl rounded-2xl shadow-2xl border-0 overflow-hidden transform transition-all z-110 animate-fade-in">
        
        <!-- Header Strip -->
        <div class="px-6 py-4 bg-brand-navy text-white flex justify-between items-center">
            <h3 class="font-bold tracking-wide text-lg">Underground Issuance Form</h3>
            <button onclick="window.closeModal()" class="text-white/70 hover:text-white font-bold text-xl cursor-pointer p-1">✕</button>
        </div>

        <!-- Master Update Submission Form Layout -->
        <form action="" method="POST" class="p-6 space-y-4">
            @csrf
            @method('POST')
            
            <!-- <div class="grid grid-cols-4 gap-2">

                <div>
                    <label for="receiving-no" class="block text-xs font-bold text-brand-dark uppercase tracking-wider mb-1">Receipt No.</label>
                    <input type="text" id="receiving-no" name="receiving_no" required placeholder="e.g., 1234"
                        class="w-full bg-gray-50 border @error('receiving_no') border-red-500 @else border-gray-300 @enderror rounded-lg px-3 py-2 text-sm focus:border-brand-gold focus:outline-none transition focus:ring-2 focus:ring-brand-gold/20">
                    @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>    

                <div class="col-span-2">
                    <label for="edit-supplier-id" class="block text-xs font-bold text-brand-dark uppercase tracking-wider mb-1">Supplier</label>
                    <select id="edit-supplier-id" name="supplier_id" required
                        class="w-full bg-gray-50 border @error('supplier_id') border-red-500 @else border-gray-300 @enderror rounded-lg p-2 text-sm focus:border-brand-gold focus:outline-none transition">
                        <option value="" disabled selected>Select Supplier</option>
                        @foreach($suppliers as $supplier)
                            <option value="{{ $supplier->id }}" {{ old('supplier_id') == $supplier->id ? 'selected' : '' }}>{{ $supplier->name }}</option>
                        @endforeach
                    </select>
                    @error('supplier_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="receiving-date" class="block text-xs font-bold text-brand-dark uppercase tracking-wider mb-1">Receiving Date</label>
                    <input type="date" id="receiving-date" name="receiving_date" required 
                        class="w-full bg-gray-50 border @error('receiving_date') border-red-500 @else border-gray-300 @enderror rounded-lg px-3 py-2 text-sm focus:border-brand-gold focus:outline-none transition focus:ring-2 focus:ring-brand-gold/20">
                    @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>   
            </div> -->

            <div class="flex items-center justify-center space-x-2">
                <label for="item-level" class="block text-lg font-bold text-brand-dark uppercase tracking-wider mb-1">Level No.</label>
                <select id="edit-supplier-id" name="supplier_id" required
                    class="w-[25%] bg-gray-50 border @error('supplier_id') border-red-500 @else border-gray-300 @enderror rounded-lg p-2 text-sm focus:border-brand-gold focus:outline-none transition">
                    <option value="" disabled selected>Select Level</option>
                    @foreach($levels as $level)
                        <option value="{{ $level->id }}" {{ old('supplier_id') == $level->id ? 'selected' : '' }}>{{ $level->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="overflow-auto flex-1 pt-4 border-t border-gray-200">
                <table class="w-full text-left border border-gray-200 rounded-xl text-xs uppercase font-medium text-gray-600">
                    <thead class="bg-gray-50 text-center select-none sticky top-0 z-10">
                        <tr>
                            <th rowspan="1" class="border border-gray-200 p-2 text-brand-navy">Quantity</th>
                            <th rowspan="2" class="border border-gray-200 p-2 text-brand-navy">Item Name</th>
                            <th rowspan="2" class="border border-gray-200 p-2 text-brand-navy">Category</th>
                            <th rowspan="2" class="border border-gray-200 p-2 text-brand-navy">UoM</th>
                            <th rowspan="3" class="border border-gray-200 p-2 text-brand-navy">Remarks</th>
                            <th rowspan="1" class="border border-gray-200 p-2 text-brand-navy"></th>
                        </tr>
                    </thead>
                    <tbody id="issuanceFormInputs" class="bg-white divide-y divide-gray-200">
                        <tr class="text-center max-h-9" data-index="0">
                            <!-- Quantity -->
                            <td class="border-box border h-full border-gray-200 p-1">
                                <input type="number" 
                                    name="items[0][quantity]" placeholder="0"
                                    class="w-full bg-gray-50 border-gray-300 border rounded-lg px-3 py-2 text-sm focus:border-brand-gold focus:outline-none transition">
                            </td>

                            <!-- Item Name -->
                            <td class="border border-gray-200 p-1">
                                <select id="issuance-item-name"
                                    name="items[0][item_name]" required
                                    class="w-full bg-gray-50 border-gray-300 border rounded-lg p-2 text-sm focus:border-brand-gold focus:outline-none transition">
                                    <option value="" disabled selected>Select Item</option>
                                    @foreach($stocks as $item)
                                        <option value="{{ $item->id }}" {{ old('item_name') == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </td>

                            <!-- Category -->
                            <td class="border border-gray-200 p-1">
                                <select id="issuance-item-name" 
                                    name="items[0][category]" required
                                    class="w-full bg-gray-50 border-gray-300 border rounded-lg p-2 text-sm focus:border-brand-gold focus:outline-none transition">
                                    <option value="" disabled selected>Select Category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category') == $category->id ? 'selected' : '' }}>{{ $category->kind }}</option>
                                    @endforeach
                                </select>
                            </td>

                            <!-- UoM -->
                            <td class="border border-gray-200 p-1">
                                <select id="issuance-item-name" 
                                    name="items[0][uom]" required
                                    class="w-full bg-gray-50 border-gray-300 border rounded-lg p-2 text-sm focus:border-brand-gold focus:outline-none transition">
                                    <option value="" disabled selected>Select UoM</option>
                                    @foreach($uoms as $uom)
                                        <option value="{{ $uom->id }}" {{ old('category') == $uom->id ? 'selected' : '' }}>{{ $uom->unit }}</option>
                                    @endforeach
                                </select>
                            </td>

                            <!-- Remarks -->
                            <td class="border border-gray-200 p-1">
                                <input type="text" 
                                    name="items[0][remarks]" placeholder="Any additional details..."
                                    class="w-full bg-gray-50 border border-gray-300 rounded-lg px-3 py-2 text-sm focus:border-brand-gold focus:outline-none transition">
                            </td>

                            <!-- Blank for remove button -->
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Footer Bottom Section -->
            <div class="pt-4 flex justify-between space-x-3 border-t border-gray-100">
                <div>
                    <button type="button" 
                        onclick="addRow('issuance');"
                        class="px-5 py-2 rounded-lg bg-brand-navy hover:bg-brand-navy-hover text-white text-sm font-bold shadow-xs transition cursor-pointer">
                        + Add Row
                    </button>
                </div>

                <div>
                    <button type="button" onclick="window.closeModal()" class="px-4 py-2 text-sm font-semibold text-gray-500 hover:text-gray-700 transition cursor-pointer">
                        Cancel
                    </button>
                    <button type="submit" class="px-5 py-2 rounded-lg bg-brand-gold hover:bg-brand-gold-hover text-white text-sm font-bold shadow-xs transition cursor-pointer">
                        Confirm
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script type="module">
window.modalData = {
    inventoryItems: @json($stocks),
    categories: @json($categories),
    uoms: @json($uoms)
};
</script>
@endpush