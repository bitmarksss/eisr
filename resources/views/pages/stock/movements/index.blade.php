@extends('layouts.app')

@section('page-title', $movementType === 'receive' ? 'Receiving Records' : 'Issuance Records')

@section('sidebar') 
    @include('components.sidebar') 
@endsection

@section('modals')
@include('pages.stock.movements.movement-modal')
@endsection

@section('content')
<div class="space-y-6">
    @if(session('success'))
        <div class="bg-green-100 border border-brand-green/30 text-brand-green p-4 rounded-xl text-sm font-semibold flex items-center shadow-xs">
            <span class="mr-2">✓</span>{{ session('success') }}
        </div>
    @endif

    <div class="bg-white p-4 rounded-xl border border-gray-200 shadow-sm flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <p class="text-xs font-bold text-gray-500 uppercase tracking-wider">Surface Magazine</p>
            <h2 class="text-xl font-bold text-brand-navy mt-1">
            {{ $movementType === 'receive' ? 'Receiving' : 'Issuance' }} Records
            </h2>
        </div>
        <a href="{{ route($movementType === 'receive' ? 'surface.stock.receive.form' : 'surface.stock.issuance.form') }}"
            class="bg-brand-gold hover:bg-brand-gold-hover text-white font-semibold px-4 py-2 rounded-lg shadow transition text-sm cursor-pointer">
            <i class="fa-solid fa-plus mr-1"></i> Create New
        </a>
    </div>

    <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr>
                    <th class="px-6 py-4 bg-gray-50 text-xs font-bold text-brand-navy uppercase tracking-wider border-b border-gray-200">Date</th>
                    <th class="px-6 py-4 bg-gray-50 text-xs font-bold text-brand-navy uppercase tracking-wider border-b border-gray-200">Reference</th>
                    <th class="px-6 py-4 bg-gray-50 text-xs font-bold text-brand-navy uppercase tracking-wider border-b border-gray-200">Items</th>
                    <th class="px-6 py-4 bg-gray-50 text-xs font-bold text-brand-navy uppercase tracking-wider border-b border-gray-200">Status</th>
                    <th class="px-6 py-4 bg-gray-50 text-xs font-bold text-brand-navy uppercase tracking-wider border-b border-gray-200 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 text-sm text-gray-700">
                @forelse($movements as $movement)
                    <tr class="hover:bg-gray-50/50 transition">
                        <td class="px-6 py-4 font-medium">{{ $movement->movement_date }}</td>
                        <td class="px-6 py-4 font-semibold text-brand-dark">{{ $movement->reference_no }}</td>
                        <td class="px-6 py-4">{{ $movement->items->count() }} item(s)</td>
                        <td class="px-6 py-4">
                            <span class="px-2.5 py-1 rounded-full text-xs font-bold border {{ $movement->status === 'approved' ? 'bg-green-50 text-brand-green border-brand-green/20' : (($movement->status === 'rejected' || $movement->status === 'cancelled') ? 'bg-red-50 text-red-700 border-red-200' : 'bg-amber-50 text-brand-gold border-brand-gold/20') }}">
                                {{ ucwords(str_replace('_', ' ', $movement->status)) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right whitespace-nowrap space-x-2">
                            <!-- View -->
                            <x-tooltip text="View Record"
                                bg_color="bg brand navy"
                                text_color="text-white"
                            >
                                <button type="button" class="view-movement py-2 px-2.5 bg-brand-navy text-white rounded-lg hover:underline text-xs font-bold cursor-pointer" data-movement='@json($movement)'><i class="fa-solid fa-eye"></i></button>
                            </x-tooltip>
                            
                            <!-- Edit -->
                            @if($movement->status === 'pending_approval')
                            <x-tooltip text="Edit Record"
                                bg_color="bg brand navy"
                                text_color="text-white"
                            >
                                <button type="button" class="edit-movement py-2 px-2.5 bg-amber-400 text-white rounded-lg hover:underline text-xs font-bold cursor-pointer" data-movement='@json($movement)'><i class="fa-solid fa-pen-to-square"></i></button>
                            </x-tooltip>
                            <form method="POST" action="{{ route('surface.stock.movements.cancel', $movement) }}" class="inline" onsubmit="return openCancelModal(this);">
                                @csrf
                                <x-tooltip text="Cancel Record"
                                    bg_color="bg brand navy"
                                    text_color="text-white"
                                >
                                    <button type="submit" class="py-2 px-2.5 bg-red-500 text-white rounded-lg hover:bg-red-600 text-xs font-bold cursor-pointer"><i class="fa-solid fa-ban"></i></button>
                                </x-tooltip>
                            </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center text-gray-400 font-medium">No records found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
        </div>
        @if($movements->hasPages())
            <div class="p-4 bg-gray-50 border-t border-gray-100">{{ $movements->links() }}</div>
        @endif
    </div>
</div>
@endsection
@push('scripts')
<script>
    const modal=document.getElementById('movementModal'); 
    const body=document.getElementById('modalBody');
    const movementType = @json($movementType);
    let cancelForm = null;

    function openCancelModal(form) {
        cancelForm = form;
        document.getElementById('cancelConfirmModal').classList.remove('hidden');
        return false;
    }

    function closeCancelModal() {
        cancelForm = null;
        document.getElementById('cancelConfirmModal').classList.add('hidden');
    }

    function submitCancelForm() {
        if (cancelForm) cancelForm.submit();
    }

    function closeMovementModal() {
        modal.classList.add('hidden')
    }

    const escapeHtml = value => String(value ?? '')
        .replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;')
        .replace(/"/g, '&quot;').replace(/'/g, '&#039;');

    const movementStatus = status => {
        const label = String(status ?? 'pending').replaceAll('_', ' ')
            .replace(/\b\w/g, character => character.toUpperCase());
        const styles = {
            approved: 'bg-green-50 text-brand-green border-brand-green/20',
            rejected: 'bg-red-50 text-red-700 border-red-200',
            pending: 'bg-amber-50 text-brand-gold border-brand-gold/20',
            pending_approval: 'bg-amber-50 text-brand-gold border-brand-gold/20'
        };
        return `<span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-bold border ${styles[status] ?? styles.pending}"><span class="h-1.5 w-1.5 rounded-full bg-current"></span>${escapeHtml(label)}</span>`;
    };

    function renderMovementDetails(m) {
        let notes = {};
        try { notes = typeof m.notes === 'string' ? JSON.parse(m.notes || '{}') : (m.notes || {}); } catch (_) {}
        const supplier = notes.supplier_name || m.supplier?.name || m.items?.find(i => i.item?.supplier)?.item?.supplier?.name || '—';
        const isIssuance = movementType === 'issuance';
        const contextLabel = isIssuance ? 'Level' : 'Supplier';
        const contextValue = isIssuance ? (m.level?.name || '—') : supplier;
        const approvals = m.approvals || [];
        const pendingApprover = m.pending_approver;
        const currentUserId = @json(auth()->id());
        const canApprove = pendingApprover?.user_id === currentUserId && m.status === 'pending_approval';
        const userName = user => user?.name || [user?.first_name, user?.last_name].filter(Boolean).join(' ') || 'Assigned approver';
        const approvalStatus = status => movementStatus(status || 'pending');
        const items = (m.items || []).map(i => {
            const item = i.item || {};
            const category = item.kind?.kind || item.kind?.name || '—';
            const uom = item.unit?.unit || i.unit || '—';
            return `
            <tr class="border-t border-gray-100">
                <td class="px-4 py-3 text-center font-bold text-brand-navy">${escapeHtml(i.quantity)}</td>
                <td class="px-4 py-3 font-semibold text-brand-dark">${escapeHtml(item.name || i.item_name || '—')}</td>
                <td class="px-4 py-3 text-gray-600">${escapeHtml(category)}</td>
                <td class="px-4 py-3 text-gray-600">${escapeHtml(uom)}</td>
            </tr>`;
        }).join('');
        const approverRows = approvals.length ? approvals.map(a => `
        <div class="flex items-center justify-between gap-3 py-2.5 border-b border-gray-100 last:border-0">
            <div class="flex items-center gap-3 min-w-0">
                <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-brand-navy/10 text-xs font-bold text-brand-navy">${escapeHtml(userName(a.user).charAt(0).toUpperCase())}</span>
                <div class="min-w-0"><p class="font-semibold text-brand-dark truncate">${escapeHtml(userName(a.user))}</p>
                <p class="text-xs text-gray-500">Approver ${escapeHtml(a.approver_slot || '')}</p>
            </div>
        </div>${approvalStatus(a.status)}</div>`).join('') 
        : 
        '<p class="text-sm text-gray-500">No approvers assigned yet.</p>';
        const pendingRow = pendingApprover ? `<div class="mb-2 rounded-lg bg-amber-50 border border-amber-200 px-3 py-2 text-sm"><span class="font-bold text-amber-800">Awaiting approval:</span> ${escapeHtml(userName(pendingApprover.user))}</div>` : '';
        const approveButton = canApprove ? `<form method="POST" action="{{ url('/surface/stock/movements') }}/${m.id}/approve" class="mt-4 flex justify-end"><input type="hidden" name="_token" value="{{ csrf_token() }}"><button class="inline-flex items-center gap-2 rounded-lg bg-brand-green px-4 py-2 text-sm font-bold text-white hover:opacity-90"><i class="fa-solid fa-check"></i> Approve movement</button></form>` : '';

        return `
        <div class="flex flex-wrap items-center justify-between gap-3 rounded-xl bg-gray-50 border border-gray-100 px-4 py-3">
            <div>
                <p class="text-xs font-bold uppercase tracking-wider text-gray-500">Reference code</p>
                <p class="mt-1 font-bold text-brand-navy">${escapeHtml(m.reference_no)}</p>
            </div>
            ${movementStatus(m.status)}
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div class="rounded-xl border border-gray-100 bg-white px-4 py-3">
                <p class="text-xs font-bold uppercase tracking-wider text-gray-500">${contextLabel}</p>
                <p class="mt-1 font-bold text-brand-dark">${escapeHtml(contextValue)}</p>
            </div>
            <div class="rounded-xl border border-gray-100 bg-white px-4 py-3">
                <p class="text-xs font-bold uppercase tracking-wider text-gray-500">Movement date</p>
                <p class="mt-1 font-semibold text-brand-dark">${escapeHtml(m.movement_date || '—')}</p>
            </div>
        </div>
        <section>
            <div class="flex items-center justify-between mb-2">
                <h4 class="text-sm font-bold uppercase tracking-wider text-brand-navy">Inventory items</h4>
                <span class="text-xs text-gray-500">${(m.items || []).length} item(s)</span>
            </div>
            <div class="overflow-hidden rounded-xl border border-gray-100">
                <table class="w-full text-left text-sm">
                    <thead class="bg-gray-50 text-xs uppercase tracking-wider text-gray-500">
                        <tr>
                            <th class="px-4 py-3 text-center">Quantity</th>
                            <th class="px-4 py-3">Item</th>
                            <th class="px-4 py-3">Category</th>
                            <th class="px-4 py-3">UOM</th>
                        </tr>
                    </thead>
                    <tbody>${items || '<tr><td colspan="4" class="px-4 py-4 text-center text-gray-500">No inventory items.</td></tr>'}</tbody>
                </table>
            </div>
        </section>
        <section class="rounded-xl border border-gray-100 px-4 py-3">
            <h4 class="mb-1 text-sm font-bold uppercase tracking-wider text-brand-navy">Approval status</h4>
            ${pendingRow}
            ${approverRows}
        </section>
        ${approveButton}
        ${m.notes && !Object.keys(notes).length ? `<p class="text-sm text-gray-600">${escapeHtml(m.notes)}</p>` : ''}`;
    }
    document.querySelectorAll('.view-movement')
        .forEach(b => b.onclick=() => {
            const m = JSON.parse(b.dataset.movement);
            
            document.getElementById('modalTitle')
                .textContent = m.reference_no;
            
            body.innerHTML = renderMovementDetails(m); modal.classList.remove('hidden')});
    
    function renderEditForm(m) {
        let notes = {};
        try { notes = typeof m.notes === 'string' ? JSON.parse(m.notes || '{}') : (m.notes || {}); } catch (_) {}
        const context = movementType === 'issuance' ? (m.level?.name || '—') : (notes.supplier_name || m.items?.find(i => i.item?.supplier)?.item?.supplier?.name || '—');
        const contextLabel = movementType === 'issuance' ? 'Level' : 'Supplier';
        const rows = (m.items || []).map((i, n) => {
            const item = i.item || {};
            return `<tr class="border-t border-gray-100"><td class="px-2 py-2"><input type="number" min="1" required name="items[${n}][quantity]" value="${escapeHtml(i.quantity)}" class="w-full rounded-lg border border-gray-300 bg-gray-50 px-3 py-2 text-sm focus:border-brand-gold focus:outline-none"></td><td class="px-2 py-2 font-semibold text-brand-dark">${escapeHtml(item.name || i.item_name || '—')}<input type="hidden" name="items[${n}][item_id]" value="${escapeHtml(i.item_id)}"></td><td class="px-2 py-2 text-gray-600">${escapeHtml(item.kind?.kind || '—')}</td><td class="px-2 py-2 text-gray-600">${escapeHtml(item.unit?.unit || i.unit || '—')}</td><td class="px-2 py-2"><input type="text" name="items[${n}][remarks]" value="${escapeHtml(i.remarks)}" class="w-full rounded-lg border border-gray-300 bg-gray-50 px-3 py-2 text-sm focus:border-brand-gold focus:outline-none"></td></tr>`;
        }).join('');
        return `<form method="POST" action="{{ url('/surface/stock/movements') }}/${m.id}" class="space-y-5">@csrf @method('PUT')
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2"><div><label class="mb-1 block text-xs font-bold uppercase tracking-wider text-brand-dark">${contextLabel}</label><div class="rounded-lg border border-gray-200 bg-gray-100 px-3 py-2 text-sm font-semibold text-gray-700">${escapeHtml(context)}</div></div><div><label class="mb-1 block text-xs font-bold uppercase tracking-wider text-brand-dark">Movement date</label><input class="w-full rounded-lg border border-gray-300 bg-gray-50 px-3 py-2 text-sm focus:border-brand-gold focus:outline-none" type="date" name="movement_date" value="${escapeHtml(m.movement_date)}" required></div></div>
            <div><label class="mb-1 block text-xs font-bold uppercase tracking-wider text-brand-dark">Inventory items</label><div class="overflow-x-auto rounded-xl border border-gray-100"><table class="w-full min-w-[680px] text-left text-sm"><thead class="bg-gray-50 text-xs uppercase tracking-wider text-gray-500"><tr><th class="px-2 py-3">Quantity</th><th class="px-2 py-3">Item</th><th class="px-2 py-3">Category</th><th class="px-2 py-3">UOM</th><th class="px-2 py-3">Remarks</th></tr></thead><tbody>${rows}</tbody></table></div></div>
            <div><label class="mb-1 block text-xs font-bold uppercase tracking-wider text-brand-dark">Notes</label><textarea class="w-full rounded-lg border border-gray-300 bg-gray-50 px-3 py-2 text-sm focus:border-brand-gold focus:outline-none" name="notes" rows="3">${escapeHtml(typeof m.notes === 'string' && !Object.keys(notes).length ? m.notes : '')}</textarea></div>
            <div class="flex justify-end border-t border-gray-100 pt-4"><button type="submit" class="rounded-lg bg-brand-gold px-5 py-2 text-sm font-bold text-white hover:bg-brand-gold-hover">Save changes</button></div></form>`;
    }

    document.querySelectorAll('.edit-movement')
        .forEach(b=>b.onclick=()=>{
            const m=JSON.parse(b.dataset.movement);
            
            document.getElementById('modalTitle').textContent='Edit '+m.reference_no;
            body.innerHTML=renderEditForm(m); modal.classList.remove('hidden')});
</script>@endpush
