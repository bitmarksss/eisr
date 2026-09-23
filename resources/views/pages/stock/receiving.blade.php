@extends('layouts.app')

@section('page-title', 'Surface Stock')
@section('sidebar') @include('components.sidebar') @endsection
@section('modals') @include('components.stock.receiving-stock-request-modal') @endsection

@section('content')
<div class="space-y-6">
    @if(session('success'))
        <div class="flex rounded-xl border border-brand-green/30 bg-green-100 p-4 text-sm font-semibold text-brand-green">{{ session('success') }}</div>
    @endif
    @if($errors->any())
        <div class="rounded-xl border border-red-300 bg-red-100 p-4 text-sm font-semibold text-red-600"><p>Invalid data submitted. Please check the errors and try again.</p><ul class="mt-2 list-disc pl-5">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>
    @endif

    <div class="w-full overflow-hidden rounded-2xl bg-white">
        <div class="flex items-center justify-between px-6 py-4 text-brand-navy">
            <h3 class="w-full border-b border-brand-green px-4 text-2xl font-bold tracking-wide">Item Receiving Form</h3>
            <button type="button" id="open-stock-request-modal" class="whitespace-nowrap rounded-lg bg-brand-navy px-4 py-2 text-sm font-bold text-white shadow transition hover:bg-brand-dark"><i class="fa-solid fa-file-import mr-1"></i> Load Stock Request</button>
        </div>
        <form action="{{ route('surface.stock.receive.store') }}" method="POST" id="receiving-form" class="w-full space-y-4 p-6">
            @csrf
            <div class="grid grid-cols-1 gap-2 md:grid-cols-2">
                <div><label for="receiving-no" class="mb-1 block text-xs font-bold uppercase tracking-wider text-brand-dark">Receipt No.</label><input type="text" id="receiving-no" name="receiving_no" required value="{{ old('receiving_no') }}" placeholder="e.g., 1234" class="w-full rounded-lg border @error('receiving_no') border-red-500 @else border-gray-300 @enderror bg-gray-50 px-3 py-2 text-sm focus:border-brand-gold focus:outline-none focus:ring-2 focus:ring-brand-gold/20"></div>
                <div><label for="receiving-date" class="mb-1 block text-xs font-bold uppercase tracking-wider text-brand-dark">Receiving Date</label><input type="date" id="receiving-date" name="receiving_date" required value="{{ old('receiving_date', now()->toDateString()) }}" class="w-full rounded-lg border @error('receiving_date') border-red-500 @else border-gray-300 @enderror bg-gray-50 px-3 py-2 text-sm focus:border-brand-gold focus:outline-none focus:ring-2 focus:ring-brand-gold/20"></div>
            </div>
            <div class="overflow-x-auto"><table class="w-full min-w-[1050px] rounded-xl border border-gray-200 text-left text-xs font-medium uppercase text-gray-600"><thead class="sticky top-0 z-10 bg-gray-50 text-center"><tr>
                <th class="border border-gray-200 p-2 text-brand-navy">Supplier</th><th class="border border-gray-200 p-2 text-brand-navy">Item Name</th><th class="border border-gray-200 p-2 text-brand-navy">Category</th><th class="w-[10%] border border-gray-200 p-2 text-brand-navy">Quantity</th><th class="border border-gray-200 p-2 text-brand-navy">UOM</th><th class="border border-gray-200 p-2 text-brand-navy">Remarks</th><th class="w-[1%] border border-gray-200 p-2 text-brand-navy"><button type="button" id="add-receiving-row" class="whitespace-nowrap rounded-lg bg-brand-green px-5 py-2 text-sm font-bold text-white shadow-xs transition hover:bg-brand-green-hover"><i class="fa-solid fa-circle-plus"></i> Add Row</button></th>
            </tr></thead><tbody id="receivingFormInputs" class="divide-y divide-gray-200 bg-white"></tbody></table></div>
            <div class="flex justify-end space-x-3 border-t border-gray-100 pt-4"><button type="button" onclick="window.history.back()" class="cursor-pointer px-4 py-2 text-sm font-semibold text-gray-500 hover:text-gray-700">Cancel</button><button type="submit" class="cursor-pointer rounded-lg bg-brand-gold px-5 py-2 text-sm font-bold text-white shadow-xs transition hover:bg-brand-gold-hover">Confirm</button></div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const suppliers = @json($suppliers->map(fn ($supplier) => ['id' => $supplier->id, 'name' => $supplier->name])->values());
    const tbody = document.getElementById('receivingFormInputs');
    const oldItems = {{ Illuminate\Support\Js::from(old('items', [[], [], []])) }};
    const itemCache = new Map();
    const esc = value => String(value ?? '').replace(/&/g, '&amp;').replace(/"/g, '&quot;').replace(/</g, '&lt;').replace(/>/g, '&gt;');

    function addRow(values = {}) {
        const index = tbody.children.length;
        const row = document.createElement('tr');
        row.className = 'text-center';
        row.innerHTML = `<td class="border border-gray-200 p-1"><select name="items[${index}][supplier_id]" required class="supplier-select w-full rounded-lg border border-gray-300 bg-gray-50 p-2 text-sm focus:border-brand-gold focus:outline-none"><option value="" disabled selected>Select Supplier</option>${suppliers.map(s => `<option value="${s.id}" ${String(values.supplier_id) === String(s.id) ? 'selected' : ''}>${esc(s.name)}</option>`).join('')}</select></td><td class="border border-gray-200 p-1"><select name="items[${index}][item_name]" required class="item-select w-full rounded-lg border border-gray-300 bg-gray-50 p-2 text-sm focus:border-brand-gold focus:outline-none"><option value="" disabled selected>Select Item</option></select></td><td class="border border-gray-200 p-1"><input type="text" readonly name="items[${index}][category]" class="category-input w-full rounded-lg border border-gray-300 bg-gray-50 px-3 py-2 text-sm" placeholder="Item category"></td><td class="border border-gray-200 p-1"><input type="number" min="1" name="items[${index}][quantity]" required value="${esc(values.quantity || '')}" class="w-full rounded-lg border border-gray-300 bg-gray-50 px-3 py-2 text-sm focus:border-brand-gold focus:outline-none" placeholder="0"></td><td class="border border-gray-200 p-1"><input type="text" readonly name="items[${index}][uom]" class="uom-input w-full rounded-lg border border-gray-300 bg-gray-50 px-3 py-2 text-sm" placeholder="Item unit"></td><td class="border border-gray-200 p-1"><input type="text" name="items[${index}][remarks]" value="${esc(values.remarks || '')}" class="w-full rounded-lg border border-gray-300 bg-gray-50 px-3 py-2 text-sm focus:border-brand-gold focus:outline-none" placeholder="Any additional details..."></td><td class="border border-gray-200 p-1">${index ? '<button type="button" class="remove-row w-full cursor-pointer rounded-lg bg-red-500 p-2 transition hover:bg-red-600"><i class="fa-solid fa-circle-minus fa-lg text-white"></i></button>' : ''}</td>`;
        tbody.appendChild(row);
        if (values.supplier_id) loadSupplierItems(row, values.item_name);
    }

    window.loadReceivingStockRequest = async function (request) {
        tbody.replaceChildren();
        (request.items || []).forEach(line => addRow({
            supplier_id: line.item?.supplier_id || line.item?.supplier?.id,
            item_name: line.item_id,
            quantity: line.quantity,
            remarks: line.remarks || '',
        }));
        if (!request.items?.length) addRow();
        document.getElementById('receiving-stock-request-modal').classList.add('hidden');
    };

    async function loadSupplierItems(row, selectedItemId = '') {
        const supplierId = row.querySelector('.supplier-select').value;
        const select = row.querySelector('.item-select');
        row.querySelector('.category-input').value = '';
        row.querySelector('.uom-input').value = '';
        select.replaceChildren(new Option(supplierId ? 'Loading items...' : 'Select Item', '', true, true));
        select.options[0].disabled = true;
        if (!supplierId) return;
        try {
            if (!itemCache.has(supplierId)) {
                const response = await fetch(`/maintenance/supplier/${supplierId}/items`, {headers: {'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest'}});
                if (!response.ok) throw new Error('Unable to load supplier items.');
                itemCache.set(supplierId, await response.json());
            }
            const items = itemCache.get(supplierId);
            select.replaceChildren(new Option('Select Item', '', true, true));
            select.options[0].disabled = true;
            items.forEach(item => select.add(new Option(`${item.name} ${item.variant || ''}`.trim(), item.id, false, String(item.id) === String(selectedItemId))));
            updateItemDetails(row);
            refreshSelectedItemOptions();
        } catch (error) {
            select.replaceChildren(new Option('Unable to load items', '', true, true));
            select.options[0].disabled = true;
            console.error(error);
        }
    }

    function updateItemDetails(row) {
        const items = itemCache.get(row.querySelector('.supplier-select').value) || [];
        const item = items.find(item => String(item.id) === row.querySelector('.item-select').value);
        row.querySelector('.category-input').value = item?.kind || '';
        row.querySelector('.uom-input').value = item?.unit || '';
    }

    function refreshSelectedItemOptions() {
        const selects = [...tbody.querySelectorAll('.item-select')];
        selects.forEach(select => {
            const supplierId = select.closest('tr').querySelector('.supplier-select').value;
            const selected = selects.filter(other => other !== select && other.closest('tr').querySelector('.supplier-select').value === supplierId).map(other => other.value).filter(Boolean);
            [...select.options].forEach(option => option.disabled = option.value && option.value !== select.value && selected.includes(option.value));
        });
    }

    tbody.addEventListener('change', event => {
        const row = event.target.closest('tr');
        if (event.target.matches('.supplier-select')) loadSupplierItems(row);
        if (event.target.matches('.item-select')) { updateItemDetails(row); refreshSelectedItemOptions(); }
    });
    tbody.addEventListener('click', event => { if (event.target.closest('.remove-row') && tbody.children.length > 1) event.target.closest('tr').remove(); });
    document.getElementById('add-receiving-row').addEventListener('click', () => addRow());
    oldItems.forEach(item => addRow(item));
    document.getElementById('receiving-form').addEventListener('submit', function () {
        let index = 0;
        [...tbody.querySelectorAll('tr')].forEach(row => {
            const hasInput = row.querySelector('.item-select').value || row.querySelector('input[name$="[quantity]"]').value || row.querySelector('input[name$="[remarks]"]').value;
            if (!hasInput) { row.remove(); return; }
            row.querySelectorAll('[name]').forEach(field => field.name = field.name.replace(/items\[\d+\]/, `items[${index}]`));
            index++;
        });
    });
});
</script>
@endpush
