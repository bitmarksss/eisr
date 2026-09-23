@extends('layouts.app')

@section('page-title', 'Surface Stock')

@section('sidebar')
    @include('components.sidebar')
@endsection

@section('content')
<div class="space-y-6">

    <!-- Flash Messages -->
    @if(session('success'))
        <div class="bg-green-100 border border-brand-green/30 text-brand-green p-4 rounded-xl text-sm font-semibold flex items-center shadow-xs">
            <span class="mr-2">✓</span> {{ session('success') }}
        </div>
    @endif
    @if(session('errors'))
        <div class="bg-red-100 border border-red-300 text-red-600 p-4 rounded-xl text-sm font-semibold shadow-xs">
            <div class="flex justify-start mb-4">
                <!-- <span class="mr-2">✗</span> -->
                <span class="ml-4 underline underline-offset-2">Invalid data submitted, please check the errors and try again.</span>
            </div>
            <ul class="list-disc">
                @foreach(session('errors')->all() as $error)
                    <li class="ml-4">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Receiving Form -->
    <div class="bg-white w-full rounded-2xl border-0 overflow-hidden">
        
        <!-- Header Strip -->
        <div class="px-6 py-4 bg-white text-brand-navy flex justify-between items-center">
            <h3 class="px-4 w-full font-bold tracking-wide text-2xl border-0 border-b border-brand-green">Item Issuance Form</h3>
        </div>


        <!-- Master Update Submission Form Layout -->
        <form action="{{ route('surface.stock.issuance.record') }}" method="POST" 
            id="issuance-form" class="p-6 space-y-4 w-full">
            @csrf
            @method('POST')
            
            <div class="grid grid-cols-4 gap-2">

                <!-- Receipt No. -->
                <div>
                    <label for="issuance-no" class="block text-xs font-bold text-brand-dark uppercase tracking-wider mb-1">Issuance No.</label>
                    <input type="text" id="issuance-no" name="issuance_no" value="{{ old('issuance_no') }}" required placeholder="e.g., ISS-0001"
                        class="w-full bg-gray-50 border @error('issuance_no') border-red-500 @else border-gray-300 @enderror rounded-lg px-3 py-2 text-sm focus:border-brand-gold focus:outline-none transition focus:ring-2 focus:ring-brand-gold/20">
                    @error('issuance_no') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>    

                <!-- Level -->
                <div class="col-span-2">
                    <label for="edit-level-id" class="block text-xs font-bold text-brand-dark uppercase tracking-wider mb-1">Destination Level</label>
                    <select id="edit-level-id" name="level_id" required
                        class="w-full bg-gray-50 border @error('level_id') border-red-500 @else border-gray-300 @enderror rounded-lg p-2 text-sm focus:border-brand-gold focus:outline-none transition">
                        <option value="" disabled selected>Select Level</option>
                        @foreach($levels as $level)
                            <option value="{{ $level->id }}" {{ old('level_id') == $level->id ? 'selected' : '' }}>{{ $level->name }}</option>
                        @endforeach
                    </select>
                    @error('level_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                
                <!-- Date Received -->
                <div>
                    <label for="issuance-date" class="block text-xs font-bold text-brand-dark uppercase tracking-wider mb-1">Issuance Date</label>
                    <input type="date" id="issuance-date" name="issuance_date" value="{{ old('issuance_date', now()->toDateString()) }}" required
                        class="w-full bg-gray-50 border @error('issuance_date') border-red-500 @else border-gray-300 @enderror rounded-lg px-3 py-2 text-sm focus:border-brand-gold focus:outline-none transition focus:ring-2 focus:ring-brand-gold/20">
                    @error('issuance_date') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>   
            </div>

            <div class="overflow-auto flex-1">
                <table class="w-full text-left border border-gray-200 rounded-xl text-xs uppercase font-medium text-gray-600">
                    <thead class="bg-gray-50 text-center select-none sticky top-0 z-10">
                        <tr>
                            <th class="w-[10%] border border-gray-200 p-2 text-brand-navy">Current Quantity</th>
                            <th class="w-[10%] border border-gray-200 p-2 text-brand-navy">Quantity</th>
                            <th class="border border-gray-200 p-2 text-brand-navy">Item Name</th>
                            <th class="border border-gray-200 p-2 text-brand-navy">Category</th>
                            <th class="border border-gray-200 p-2 text-brand-navy">UoM</th>
                            <th class="border border-gray-200 p-2 text-brand-navy">Remarks</th>
                            <th class="w-[1%] border border-gray-200 p-2 text-brand-navy">
                                <button type="button" 
                                    onclick="addRow('issuance');"
                                    class="px-5 py-2 rounded-lg bg-brand-green hover:bg-brand-green-hover text-white text-sm font-bold shadow-xs transition cursor-pointer text-nowrap"> 
                                    <i class="fa-solid fa-circle-plus"></i>
                                    Add Row
                                </button>
                            </th>
                        </tr>
                    </thead>
                    <tbody id="issuanceFormInputs" class="bg-white divide-y divide-gray-200">
                        @foreach([0,1,2] as $index)
                        <tr class="text-center max-h-9" data-index="{{ $index }}">
                            <!-- Current Quantity -->
                            <td class="w-[10%] border-box border h-full border-gray-200 p-1">
                                <input type="text" readonly value="—"
                                    name="items[{{ $index }}][current_quantity]"
                                    class="current-quantity w-full bg-gray-100 border-gray-300 border rounded-lg px-3 py-2 text-sm text-gray-600">
                            </td>

                            <!-- Quantity -->
                            <td class="w-[10%] border-box border h-full border-gray-200 p-1">
                                <input type="number" required
                                    name="items[{{ $index }}][quantity]" placeholder="0"
                                    class="w-full bg-gray-50 border-gray-300 border rounded-lg px-3 py-2 text-sm focus:border-brand-gold focus:outline-none transition">
                            </td>

                            <!-- Item Name -->
                            <td class="border border-gray-200 p-1">
                                <select name="items[{{ $index }}][item_name]" required
                                    class="w-full bg-gray-50 border-gray-300 border rounded-lg p-2 text-sm focus:border-brand-gold focus:outline-none transition">
                                    <option value="" disabled selected>Select Item</option>
                                    @foreach($items as $item)
                                        <option value="{{ $item->id }}" {{ old('item_name') == $item->id ? 'selected' : '' }}>{{ $item->name }} {{ $item->variant }}</option>
                                    @endforeach
                                </select>
                            </td>

                            <!-- Category -->
                            <td class="border border-gray-200 p-1">
                                <input type="text" readonly
                                    name="items[{{ $index }}][category]" placeholder="Item category..."
                                    class="w-full bg-gray-50 border-gray-300 border rounded-lg px-3 py-2 text-sm focus:border-brand-gold focus:outline-none transition">
                          
                                {{--
                                <select name="items[{{ $index }}][category]" required
                                    class="w-full bg-gray-50 border-gray-300 border rounded-lg p-2 text-sm focus:border-brand-gold focus:outline-none transition">
                                    <option value="" disabled selected>Select Category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category') == $category->id ? 'selected' : '' }}>{{ $category->kind }}</option>
                                    @endforeach
                                </select>
                                --}}
                            </td>

                            <!-- UoM -->
                            <td class="border border-gray-200 p-1">
                                <input type="text" readonly
                                    name="items[{{ $index }}][uom]" placeholder="Item unit..."
                                    class="w-full bg-gray-50 border-gray-300 border rounded-lg px-3 py-2 text-sm focus:border-brand-gold focus:outline-none transition">
                          
                                {{--
                                <select name="items[{{ $index }}][uom]" required
                                    class="w-full bg-gray-50 border-gray-300 border rounded-lg p-2 text-sm focus:border-brand-gold focus:outline-none transition">
                                    <option value="" disabled selected>Select UoM</option>
                                    @foreach($uoms as $uom)
                                        <option value="{{ $uom->id }}" {{ old('uom') == $uom->id ? 'selected' : '' }}>{{ $uom->unit }}</option>
                                    @endforeach
                                </select>
                                --}}
                            </td>

                            <!-- Remarks -->
                            <td class="border border-gray-200 p-1">
                                <input type="text" 
                                    name="items[{{ $index }}][remarks]" placeholder="Any additional details..."
                                    class="w-full bg-gray-50 border border-gray-300 rounded-lg px-3 py-2 text-sm focus:border-brand-gold focus:outline-none transition">
                            </td>

                            <!-- Remove Button -->
                            @if($index != 0)
                            <td class="w-[1%] border border-gray-200 p-1">
                                <button type="button" onclick="removeRow(`issuance`, {{ $index }});" 
                                    class="w-full bg-red-500 hover:bg-red-600 active:translate-y-0.5 rounded-lg p-2 cursor-pointer transition">
                                    <i class="fa-solid fa-circle-minus fa-lg text-white"></i>
                                </button>
                            </td>
                            @else
                            <td></td>
                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Footer Bottom Section -->
            <div class="pt-4 flex justify-end space-x-3 border-t border-gray-100">
                <div>
                    <button type="button" onclick="window.history.back()" class="px-4 py-2 text-sm font-semibold text-gray-500 hover:text-gray-700 transition cursor-pointer">
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
    inventoryItems: [],
    categories: @json($categories),
    uoms: @json($uoms)
};

document.addEventListener('DOMContentLoaded',() => {
    document.getElementById('issuance-date').value = new Date().toISOString().split('T')[0];
});

const issuanceForm = document.getElementById('issuance-form');
window.modalData.inventoryItems = @json($items);
issuanceForm.querySelectorAll('select[name^="items"][name$="[item_name]"]')
    .forEach(select => 
        populateItemSelect(select, window.modalData.inventoryItems)
    );

issuanceForm.addEventListener('change', function(event) {
    if (event.target.matches('select[name^="items"][name$="[item_name]"]')) {
        const selectedItemId = event.target.value;
        const selectedItem = window.modalData.inventoryItems.find(item => item.id == selectedItemId);
        
        if (selectedItem) {
            const row = event.target.closest('tr');
            const currentQuantityInput = row.querySelector('input[name$="[current_quantity]"]');
            if (currentQuantityInput) {
                currentQuantityInput.value = selectedItem.stock?.[0]?.quantity ?? 0;
            }

            // const categorySelect = row.querySelector('select[name^="items"][name$="[category]"]');
            // const uomSelect = row.querySelector('select[name^="items"][name$="[uom]"]');
            // if (categorySelect) {
            //     categorySelect.value = selectedItem.kind_id;
            // }
            // if (uomSelect) {
            //     uomSelect.value = selectedItem.uom ?? selectedItem.unit_id;
            // }
            
            const categoryInput = row.querySelector('input[name^="items"][name$="[category]"]');
            const uomInput = row.querySelector('input[name^="items"][name$="[uom]"]');
            if (categoryInput) {
                categoryInput.value = selectedItem.kind.kind;
            }
            if (uomInput) {
                uomInput.value = selectedItem.unit.unit ?? selectedItem.unit.unit;
            }

            refreshSelectedItemOptions();
        } else {
            event.target.closest('tr').querySelector('input[name$="[current_quantity]"]').value = '—';
        }
    }

});

function populateItemSelect(select, items) {
    select.replaceChildren(new Option('Select Item', '', true, true));
    select.options[0].disabled = true;
    items.forEach(item => {
        const option = new Option(
            (item.name + ' ' + (item.variant || '')).trim(),
            item.id
        );
        option.dataset.category = item.kind;
        option.dataset.uom = item.uom ?? item.unit;
        select.add(option);
    });
}

function refreshSelectedItemOptions() {
    const selects = [...issuanceForm.querySelectorAll(
        'select[name^="items"][name$="[item_name]"]'
    )];
    const selectedValues = selects
        .map(select => select.value)
        .filter(value => value !== '');

    selects.forEach(select => {
        [...select.options].forEach(option => {
            option.disabled =
                option.value !== '' &&
                option.value !== select.value &&
                selectedValues.includes(option.value);
        });
    });
}

function resetReceivingRows() {
    const rows = issuanceForm.querySelectorAll('#issuanceFormInputs tr');

    rows.forEach((row, index) => {
        if (index >= 3) {
            row.remove();
            return;
        }

        row.querySelector('input[name$="[quantity]"]').value = '';
        // row.querySelector('select[name$="[category]"]').value = '';
        // row.querySelector('select[name$="[uom]"]').value = '';
        row.querySelector('input[name$="[category]"]').value = '';
        row.querySelector('input[name$="[uom]"]').value = '';
        row.querySelector('select[name$="[item_name]"]').value = '';
    });
}

function setReceivingRowsLoading(isLoading) {
    issuanceForm.querySelectorAll('#issuanceFormInputs tr').forEach(row => {
        row.classList.toggle('animate-pulse', isLoading);
        row.classList.toggle('opacity-60', isLoading);

        row.querySelectorAll('input, select').forEach(field => {
            field.disabled = isLoading;
        });

        row.querySelectorAll('select[name$="[item_name]"]').forEach(select => {
            if (isLoading) {
                select.replaceChildren(new Option('Loading items...', '', true, true));
                select.options[0].disabled = true;
            }
        });
    });
}

issuanceForm.querySelectorAll('#issuanceFormInputs tr:not(:first-child) [name^="items["]').forEach(field => field.removeAttribute('required'));
issuanceForm.addEventListener('submit', function (event) {
    const invalidRow = [...this.querySelectorAll('#issuanceFormInputs tr')].find(row => {
        const itemSelect = row.querySelector('select[name$="[item_name]"]');
        const quantityInput = row.querySelector('input[name$="[quantity]"]');
        const currentQuantityInput = row.querySelector('input[name$="[current_quantity]"]');

        if (!itemSelect?.value || !quantityInput?.value) return false;

        const requested = Number(quantityInput.value);
        const available = Number(currentQuantityInput?.value ?? 0);
        return Number.isFinite(requested) && Number.isFinite(available) && requested > available;
    });

    if (invalidRow) {
        event.preventDefault();
        const itemName = invalidRow.querySelector('select[name$="[item_name]"] option:checked')?.textContent?.trim() || 'selected item';
        const available = invalidRow.querySelector('input[name$="[current_quantity]"]')?.value || 0;
        alert(`The requested quantity for ${itemName} exceeds the available quantity (${available}).`);
    }
});

issuanceForm.addEventListener('submit', function () {
    const rows = [...this.querySelectorAll('#issuanceFormInputs tr')];
    let itemIndex = 0;

    rows.forEach(row => {
        const item = row.querySelector('select[name$="[item_name]"]');
        const quantity = row.querySelector('input[name$="[quantity]"]');
        const hasInput = item?.value || quantity?.value || row.querySelector('input[name$="[remarks]"]')?.value;

        if (!hasInput) {
            row.remove();
            return;
        }

        row.querySelectorAll('[name]').forEach(field => {
            field.name = field.name.replace(/items\[\d+\]/, `items[${itemIndex}]`);
        });
        itemIndex++;
    });
});
</script>
@endpush

@endsection
