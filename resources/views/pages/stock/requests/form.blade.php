@extends('layouts.app')

@section('page-title', 'Create Stock Request')
@section('sidebar') @include('components.sidebar') @endsection

@section('content')
<div class="space-y-6">
    @if($errors->any())
        <div class="rounded-xl border border-red-300 bg-red-100 p-4 text-sm font-semibold text-red-600"><p>Please correct the highlighted fields.</p><ul class="mt-2 list-disc pl-5">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>
    @endif
    <div class="w-full overflow-hidden rounded-2xl bg-white">
        <div class="flex items-center px-6 py-4 text-brand-navy"><h3 class="w-full border-b border-brand-green px-4 text-2xl font-bold tracking-wide">Stock Request Form</h3></div>
        <form action="{{ route('surface.stock.requests.store') }}" method="POST" id="stock-request-form" class="w-full space-y-4 p-6">
            @csrf
            <div class="grid grid-cols-1 gap-2 md:grid-cols-2">
                <div><label for="reference-no" class="mb-1 block text-xs font-bold uppercase tracking-wider text-brand-dark">Reference No.</label><input id="reference-no" type="text" name="reference_no" required value="{{ old('reference_no') }}" placeholder="e.g., REQ-2026-0001" class="w-full rounded-lg border @error('reference_no') border-red-500 @else border-gray-300 @enderror bg-gray-50 px-3 py-2 text-sm focus:border-brand-gold focus:outline-none focus:ring-2 focus:ring-brand-gold/20"></div>
                <div><label for="request-date" class="mb-1 block text-xs font-bold uppercase tracking-wider text-brand-dark">Request Date</label><input id="request-date" type="date" name="date" required value="{{ old('date', now()->toDateString()) }}" class="w-full rounded-lg border @error('date') border-red-500 @else border-gray-300 @enderror bg-gray-50 px-3 py-2 text-sm focus:border-brand-gold focus:outline-none focus:ring-2 focus:ring-brand-gold/20"></div>
            </div>
            <div class="overflow-x-auto"><table class="w-full min-w-[950px] rounded-xl border border-gray-200 text-left text-xs font-medium uppercase text-gray-600"><thead class="sticky top-0 z-10 bg-gray-50 text-center"><tr>
                <th class="border border-gray-200 p-2 text-brand-navy">Supplier</th><th class="border border-gray-200 p-2 text-brand-navy">Item Name</th><th class="border border-gray-200 p-2 text-brand-navy">Category</th><th class="w-[10%] border border-gray-200 p-2 text-brand-navy">Quantity</th><th class="border border-gray-200 p-2 text-brand-navy">UOM</th><th class="border border-gray-200 p-2 text-brand-navy">Remarks</th><th class="w-[1%] border border-gray-200 p-2 text-brand-navy"><button type="button" id="add-request-row" class="whitespace-nowrap rounded-lg bg-brand-green px-5 py-2 text-sm font-bold text-white shadow-xs transition hover:bg-brand-green-hover"><i class="fa-solid fa-circle-plus"></i> Add Row</button></th>
            </tr></thead><tbody id="stockRequestInputs" class="divide-y divide-gray-200 bg-white"></tbody></table></div>
            <div class="flex justify-end space-x-3 border-t border-gray-100 pt-4"><button type="button" onclick="window.history.back()" class="cursor-pointer px-4 py-2 text-sm font-semibold text-gray-500 hover:text-gray-700">Cancel</button><button type="submit" class="cursor-pointer rounded-lg bg-brand-gold px-5 py-2 text-sm font-bold text-white shadow-xs transition hover:bg-brand-gold-hover">Confirm</button></div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const suppliers = @json($requestFormSuppliers);
    const inventoryItems = @json($requestFormItems);
    const tbody = document.getElementById('stockRequestInputs');
    const oldItems = {{ Illuminate\Support\Js::from(old('items') ?: array_fill(0, 3, [])) }};
    const esc = value => String(value ?? '').replace(/&/g, '&amp;').replace(/"/g, '&quot;').replace(/</g, '&lt;').replace(/>/g, '&gt;');

    function addRow(values = {}) {
        console.log(values.supplier_id);
        const index = tbody.children.length;
        const row = document.createElement('tr');
        row.className = 'text-center';
        row.innerHTML = `
            <td class="border border-gray-200 p-1">
                <select name="items[${index}][supplier_id]" required class="supplier-select w-full rounded-lg border border-gray-300 bg-gray-50 p-2 text-sm focus:border-brand-gold focus:outline-none">
                    <option value="" disabled selected>Select Supplier</option>
                    ${suppliers.map(s => 
                        `<option value="${s.id}" ${String(values.supplier_id) === String(s.id) ? 'selected' : ''}>
                            ${esc(s.name)}
                        </option>`).join('')
                    }
                </select>
            </td>
            <td class="border border-gray-200 p-1">
                <select name="items[${index}][item_id]" required class="item-select w-full rounded-lg border border-gray-300 bg-gray-50 p-2 text-sm focus:border-brand-gold focus:outline-none"></select>
            </td>
            <td class="border border-gray-200 p-1">
                <input type="text" readonly 
                    class="category-input w-full rounded-lg border border-gray-300 bg-gray-50 px-3 py-2 text-sm 
                    cursor-default focus:outline-1 focus:outline-gray-200" 
                    placeholder="Item category">
            </td>
            <td class="border border-gray-200 p-1"><input type="number" min="1" name="items[${index}][quantity]" required value="${esc(values.quantity || '')}" placeholder="0" class="w-full rounded-lg border border-gray-300 bg-gray-50 px-3 py-2 text-sm focus:border-brand-gold focus:outline-none"></td><td class="border border-gray-200 p-1">
                <input type="text" readonly class="uom-input w-full rounded-lg border border-gray-300 bg-gray-50 px-3 py-2 text-sm
                    cursor-default focus:outline-1 focus:outline-gray-200" 
                    placeholder="Item unit">
            </td>
            <td class="border border-gray-200 p-1"><input type="text" name="items[${index}][remarks]" value="${esc(values.remarks || '')}" placeholder="Any additional details..." class="w-full rounded-lg border border-gray-300 bg-gray-50 px-3 py-2 text-sm focus:border-brand-gold focus:outline-none"></td>
            <td class="border border-gray-200 p-1">
                ${index != 0 ? `
                <button type="button" class="remove-row w-full cursor-pointer rounded-lg bg-red-500 p-2 transition hover:bg-red-600">
                    <i class="fa-solid fa-circle-minus fa-lg text-white"></i>
                </button>` : ''}
            </td>`;
        tbody.appendChild(row);
        updateItems(row, values.item_id);
    }
    function updateItems(row, selected = '') {
        const supplierId = row.querySelector('.supplier-select').value;
        const select = row.querySelector('.item-select');
        select.innerHTML = '<option value="" disabled selected>Select Item</option>' + inventoryItems.filter(item => String(item.supplier_id) === String(supplierId)).map(item => `<option value="${item.id}" ${String(selected) === String(item.id) ? 'selected' : ''}>${esc([item.name, item.variant].filter(Boolean).join(' '))}</option>`).join('');
        updateItemDetails(row);
    }
    function updateItemDetails(row) {
        const item = inventoryItems.find(entry => String(entry.id) === row.querySelector('.item-select').value);
        row.querySelector('.category-input').value = item?.kind || '';
        row.querySelector('.uom-input').value = item?.unit || '';
    }
    tbody.addEventListener('change', event => {
        const row = event.target.closest('tr');
        if (event.target.matches('.supplier-select')) updateItems(row);
        if (event.target.matches('.item-select')) updateItemDetails(row);
    });
    tbody.addEventListener('click', event => { if (event.target.closest('.remove-row') && tbody.children.length > 1) event.target.closest('tr').remove(); });
    document.getElementById('add-request-row').addEventListener('click', () => addRow());
    oldItems.forEach(item => addRow(item));

    document.getElementById('stock-request-form').addEventListener('submit', function () {
        let index = 0;
        [...tbody.querySelectorAll('tr')].forEach(row => {
            const hasInput = row.querySelector('.supplier-select').value || row.querySelector('.item-select').value || row.querySelector('input[name$="[quantity]"]').value || row.querySelector('input[name$="[remarks]"]').value;
            if (!hasInput) { row.remove(); return; }
            row.querySelectorAll('[name]').forEach(field => field.name = field.name.replace(/items\[\d+\]/, `items[${index}]`));
            index++;
        });
    });
});
</script>
@endpush
