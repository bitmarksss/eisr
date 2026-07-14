<div id="receivingModal" class="fixed inset-0 z-110 flex items-center justify-center p-4 opacity-0 pointer-events-none transition-opacity duration-200">

    <!-- Backdrop Layout Grid -->
    <div id="editBackdrop" class="absolute z-100 inset-0 bg-brand-dark/10 backdrop-blur-xs"
    onclick="window.closeModal()"></div>

    <!-- Central Window Frame Area -->
    <div class="relative bg-white w-full max-w-6xl rounded-2xl shadow-2xl border border-gray-100 overflow-hidden transform transition-all z-110 animate-fade-in">
        
        <!-- Header Strip -->
        <div class="px-6 py-4 bg-brand-green text-white flex justify-between items-center">
            <h3 class="font-bold tracking-wide text-lg">Item Receiving Form</h3>
            <button onclick="window.closeModal()" class="text-white/70 hover:text-white font-bold text-xl cursor-pointer p-1">✕</button>
        </div>

        <!-- Master Update Submission Form Layout -->
        <form action="" method="POST" class="p-6 space-y-4">
            @csrf
            @method('POST')
            
            <div class="grid grid-cols-4 gap-2">

                <!-- Receipt No. -->
                <div>
                    <label for="receiving-no" class="block text-xs font-bold text-brand-dark uppercase tracking-wider mb-1">Receipt No.</label>
                    <input type="text" id="receiving-no" name="receiving_no" required placeholder="e.g., 1234"
                        class="w-full bg-gray-50 border @error('receiving_no') border-red-500 @else border-gray-300 @enderror rounded-lg px-3 py-2 text-sm focus:border-brand-gold focus:outline-none transition focus:ring-2 focus:ring-brand-gold/20">
                    @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>    

                <!-- Supplier -->
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

                <!-- Date Received -->
                <div>
                    <label for="receiving-date" class="block text-xs font-bold text-brand-dark uppercase tracking-wider mb-1">Receiving Date</label>
                    <input type="date" id="receiving-date" name="receiving_date" required 
                        class="w-full bg-gray-50 border @error('receiving_date') border-red-500 @else border-gray-300 @enderror rounded-lg px-3 py-2 text-sm focus:border-brand-gold focus:outline-none transition focus:ring-2 focus:ring-brand-gold/20">
                    @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>   
            </div>

            <div class="overflow-auto flex-1">
                <table class="w-full text-left border border-gray-200 rounded-xl text-xs uppercase font-medium text-gray-600">
                    <thead class="bg-gray-50 text-center select-none sticky top-0 z-10">
                        <tr>
                            <th rowspan="1" class="border border-gray-200 p-2 text-brand-navy">Quantity</th>
                            <th rowspan="2" class="border border-gray-200 p-2 text-brand-navy">Item Name</th>
                            <th rowspan="2" class="border border-gray-200 p-2 text-brand-navy">Category</th>
                            <th rowspan="2" class="border border-gray-200 p-2 text-brand-navy">UoM</th>
                            <th rowspan="3" class="border border-gray-200 p-2 text-brand-navy">Remarks</th>
                        </tr>
                    </thead>
                    <tbody id="receivingFormInputs" class="bg-white divide-y divide-gray-200">
                        <tr class="text-center max-h-9" data-index="0">
                            <!-- Quantity -->
                            <td class="border-box border h-full border-gray-200 p-1">
                                <input type="number" 
                                    name="items[0][quantity]" placeholder="0"
                                    class="w-full bg-gray-50 border-gray-300 border rounded-lg px-3 py-2 text-sm focus:border-brand-gold focus:outline-none transition">
                            </td>

                            <!-- Item Name -->
                            <td class="border border-gray-200 p-1">
                                <select id="receiving-item-name"
                                    name="items[0][item_name]" required
                                    class="w-full bg-gray-50 border-gray-300 border rounded-lg p-2 text-sm focus:border-brand-gold focus:outline-none transition">
                                    <option value="" disabled selected>Select Item</option>
                                    @foreach($inventory_items as $item)
                                        <option value="{{ $item->id }}" {{ old('item_name') == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </td>

                            <!-- Category -->
                            <td class="border border-gray-200 p-1">
                                <select id="receiving-item-name" 
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
                                <select id="receiving-item-name" 
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
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Footer Bottom Section -->
            <div class="pt-4 flex justify-between space-x-3 border-t border-gray-100">
                <div>
                    <button type="button" 
                        onclick="addRow();"
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
document.addEventListener('DOMContentLoaded', () => {
    // 1. Fetch backend collections
    const inventoryItems = @json($inventory_items);
    const categories = @json($categories);
    const uoms = @json($uoms);

    // 2. Setup the TrustedHTML Policy
    let rowPolicy;
    if (window.trustedTypes && window.trustedTypes.createPolicy) {
        rowPolicy = window.trustedTypes.createPolicy("myRowTemplatePolicy", {
            // Since we write this HTML structure yourself, we trust it to be safe
            createHTML: (htmlString) => htmlString
        });
    } else {
        // Fallback for older browsers that do not support Trusted Types
        rowPolicy = { createHTML: (htmlString) => htmlString };
    }

    // 3. Define the Global Add Row Function
    window.addRow = function() {
        const inputs = document.getElementById('receivingFormInputs');
        const index = inputs.childElementCount;

        // Securely pre-build our select option markup
        const itemOptions = buildOptions(inventoryItems, 'id', 'name');
        const categoryOptions = buildOptions(categories, 'id', 'kind');
        const uomOptions = buildOptions(uoms, 'id', 'unit');

        // Design the row structure
        const rowHtml = `
            <tr class="text-center max-h-9" data-index="${index}">
                <!-- Quantity -->
                <td class="border-box border h-full border-gray-200 p-1">
                    <input type="number" placeholder="0" 
                        name="items[${index}][quantity]"
                        class="w-full h-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-brand-navy text-xs rounded-lg"/>
                </td>

                <!-- Item Name -->
                <td class="border border-gray-200 p-1">
                    <select name="items[${index}][item_name]" required
                        class="w-full bg-gray-50 border border-gray-300 rounded-lg p-2 text-sm focus:border-brand-gold focus:outline-none transition">
                        <option value="" disabled selected>Select Item</option>
                        ${itemOptions}
                    </select>
                </td>

                <!-- Category -->
                <td class="border border-gray-200 p-1">
                    <select name="items[${index}][category]" required
                        class="w-full bg-gray-50 border border-gray-300 rounded-lg p-2 text-sm focus:border-brand-gold focus:outline-none transition">
                        <option value="" disabled selected>Select Category</option>
                        ${categoryOptions}
                    </select>
                </td>

                <!-- UoM -->
                <td class="border border-gray-200 p-1">
                    <select name="items[${index}][uom]" required
                        class="w-full bg-gray-50 border border-gray-300 rounded-lg p-2 text-sm focus:border-brand-gold focus:outline-none transition">
                        <option value="" disabled selected>Select UoM</option>
                        ${uomOptions}
                    </select>
                </td>

                <!-- Remarks -->
                <td class="border border-gray-200 p-1">
                    <input type="text" 
                        name="items[${index}][remarks]" placeholder="Any additional details..."
                        class="w-full bg-gray-50 border border-gray-300 rounded-lg px-3 py-2 text-sm focus:border-brand-gold focus:outline-none transition">
                </td>
            </tr>`;

        // 4. Generate the TrustedHTML object and apply it
        const trustedRow = rowPolicy.createHTML(rowHtml);

        // We use a temporary element container because insertAdjacentHTML 
        // will throw a Trusted Type violation directly in strict environments.
        const tempTable = document.createElement('table');
        const tempTbody = document.createElement('tbody');
        
        // Safely set innerHTML using our TrustedHTML instance
        tempTbody.innerHTML = trustedRow;
        
        // Append the newly created tr child node directly to our real list
        const newRow = tempTbody.firstElementChild;
        inputs.appendChild(newRow);
    };

    // Helper: Safely escapes dynamic user data to avoid XSS injections in select options
    function escapeHtml(string) {
        return String(string).replace(/[&<>"']/g, function(match) {
            const map = {
                '&': '&amp;',
                '<': '&lt;',
                '>': '&gt;',
                '"': '&quot;',
                "'": '&#039;'
            };
            return map[match];
        });
    }

    // Helper: Build option markup by converting collections safely
    function buildOptions(items, valueField, textField) {
        return items.map(item => {
            const val = escapeHtml(item[valueField]);
            const text = escapeHtml(item[textField]);
            return `<option value="${val}">${text}</option>`;
        }).join('');
    }
});
</script>
@endpush