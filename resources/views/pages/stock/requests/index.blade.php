@extends('layouts.app')

@section('page-title', 'Stock Requests')
@section('sidebar') @include('components.sidebar') @endsection
@section('modals') @include('components.stock.request-view-modal') @endsection

@section('content')
<div class="space-y-6">
    @if(session('success')) <div class="rounded-xl border border-brand-green/30 bg-green-100 p-4 text-sm font-semibold text-brand-green">{{ session('success') }}</div> @endif
    <div class="flex flex-col gap-4 rounded-xl border border-gray-200 bg-white p-4 shadow-sm md:flex-row md:items-center md:justify-between">
        <div><p class="text-xs font-bold uppercase tracking-wider text-gray-500">Surface Magazine</p><h2 class="mt-1 text-xl font-bold text-brand-navy">Stock Requests</h2></div>
        <a href="{{ route('surface.stock.requests.form') }}" class="rounded-lg bg-brand-gold px-4 py-2 text-sm font-semibold text-white shadow transition hover:bg-brand-gold-hover"><i class="fa-solid fa-plus mr-1"></i> Request Stock</a>
    </div>
    <div class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm"><div class="overflow-x-auto">
        <table class="w-full border-collapse text-left"><thead><tr>
            @foreach(['Date', 'Reference', 'Requested By', 'Items'] as $heading)<th class="border-b border-gray-200 bg-gray-50 px-6 py-4 text-xs font-bold uppercase tracking-wider text-brand-navy">{{ $heading }}</th>@endforeach
            <th class="border-b border-gray-200 bg-gray-50 px-6 py-4 text-right text-xs font-bold uppercase tracking-wider text-brand-navy">Actions</th>
        </tr></thead><tbody class="divide-y divide-gray-100 text-sm text-gray-700">
            @forelse($stockRequests as $stockRequest)
                <tr class="transition hover:bg-gray-50/50">
                    <td class="px-6 py-4 font-medium">{{ $stockRequest->date->format('M d, Y') }}</td>
                    <td class="px-6 py-4 font-semibold text-brand-dark">{{ $stockRequest->reference_no }}</td>
                    <td class="px-6 py-4">{{ $stockRequest->requester?->name ?? trim(($stockRequest->requester?->first_name ?? '') . ' ' . ($stockRequest->requester?->last_name ?? '')) ?: 'Unknown' }}</td>
                    <td class="px-6 py-4">{{ $stockRequest->items->count() }} item(s)</td>
                    <td class="px-6 py-4 text-right"><x-tooltip text="View Request" bg_color="bg brand navy" text_color="text-white"><button type="button" class="view-request cursor-pointer rounded-lg bg-brand-navy px-2.5 py-2 text-xs font-bold text-white hover:underline" data-request='@json($stockRequest)'><i class="fa-solid fa-eye"></i></button></x-tooltip></td>
                </tr>
            @empty
                <tr><td colspan="5" class="px-6 py-12 text-center font-medium text-gray-400">No stock requests found.</td></tr>
            @endforelse
        </tbody></table>
    </div>@if($stockRequests->hasPages())<div class="border-t border-gray-100 bg-gray-50 p-4">{{ $stockRequests->links() }}</div>@endif</div>
</div>
@endsection

@push('scripts')
<script>
(() => {
    const modal = document.getElementById('stockRequestModal'), body = document.getElementById('stockRequestModalBody'), subtitle = document.getElementById('stockRequestModalSubtitle');
    const esc = value => String(value ?? '').replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;').replace(/'/g, '&#039;');
    const name = user => user?.name || [user?.first_name, user?.last_name].filter(Boolean).join(' ') || 'Unknown';
    const formatDate = value => {
        if (!value) return '—';
        const date = new Date(`${String(value).slice(0, 10)}T00:00:00`);
        return Number.isNaN(date.getTime()) ? value : new Intl.DateTimeFormat('en-GB', {
            day: '2-digit', month: 'long', year: 'numeric'
        }).format(date);
    };
    const render = request => {
        const rows = (request.items || []).map(line => { const item = line.item || {}; return `<tr class="border-t border-gray-100"><td class="px-4 py-3 text-center font-bold text-brand-navy">${esc(line.quantity)}</td><td class="px-4 py-3 font-semibold text-brand-dark">${esc([item.name, item.variant].filter(Boolean).join(' ') || '—')}</td><td class="px-4 py-3 text-gray-600">${esc(item.supplier?.name || '—')}</td><td class="px-4 py-3 text-gray-600">${esc(item.kind?.kind || '—')}</td><td class="px-4 py-3 text-gray-600">${esc(item.unit?.unit || '—')}</td><td class="px-4 py-3 text-gray-600">${esc(line.remarks || '—')}</td></tr>`; }).join('');
        return `<div class="grid grid-cols-1 gap-4 sm:grid-cols-3">${[['Reference number', request.reference_no], ['Request date', formatDate(request.date)], ['Requested by', name(request.requester)]].map(([label, value]) => `<div class="rounded-xl border border-gray-100 bg-gray-50 px-4 py-3"><p class="text-xs font-bold uppercase tracking-wider text-gray-500">${esc(label)}</p><p class="mt-1 font-semibold text-brand-dark">${esc(value)}</p></div>`).join('')}</div><section><div class="mb-2 flex items-center justify-between"><h4 class="text-sm font-bold uppercase tracking-wider text-brand-navy">Requested items</h4><span class="text-xs text-gray-500">${(request.items || []).length} item(s)</span></div><div class="overflow-x-auto rounded-xl border border-gray-100"><table class="w-full min-w-[760px] text-left text-sm"><thead class="bg-gray-50 text-xs font-bold uppercase tracking-wider text-gray-500"><tr><th class="px-4 py-3 text-center">Qty.</th><th class="px-4 py-3">Item</th><th class="px-4 py-3">Supplier</th><th class="px-4 py-3">Category</th><th class="px-4 py-3">UOM</th><th class="px-4 py-3">Remarks</th></tr></thead><tbody>${rows || '<tr><td colspan="6" class="px-4 py-5 text-center text-gray-500">No requested items found.</td></tr>'}</tbody></table></div></section>`;
    };
    const close = () => modal.classList.add('hidden');
    document.querySelectorAll('.view-request').forEach(button => button.addEventListener('click', () => { const request = JSON.parse(button.dataset.request); subtitle.textContent = `Request ${request.reference_no || ''}`; body.innerHTML = render(request); modal.classList.remove('hidden'); }));
    document.querySelectorAll('[data-close-stock-request-modal]').forEach(button => button.addEventListener('click', close));
    document.addEventListener('keydown', event => { if (event.key === 'Escape' && !modal.classList.contains('hidden')) close(); });
})();
</script>
@endpush
