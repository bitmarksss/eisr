<div id="receiving-stock-request-modal" class="hidden fixed inset-0 z-110 flex items-center justify-center p-4" role="dialog" aria-modal="true" aria-labelledby="receivingStockRequestModalTitle">
    <div class="absolute inset-0 bg-brand-dark/20 backdrop-blur-xs" data-close-receiving-stock-request-modal></div>
    <div class="relative z-110 flex max-h-[90vh] w-full max-w-3xl flex-col overflow-hidden rounded-2xl border border-gray-100 bg-white shadow-2xl">
        <div class="flex items-center justify-between bg-brand-green px-6 py-4 text-white">
            <div>
                <h3 id="receivingStockRequestModalTitle" class="text-lg font-bold">Load Stock Request</h3>
                <p class="mt-0.5 text-xs text-white/70">Select a request to load its items into the receiving form.</p>
            </div>
            <button type="button" data-close-receiving-stock-request-modal class="cursor-pointer p-1 text-xl font-bold text-white/70 hover:text-white" aria-label="Close">&times;</button>
        </div>
        <div id="receiving-stock-request-scroll" class="max-h-[calc(90vh-132px)] overflow-y-auto p-6">
            <div class="overflow-x-auto rounded-xl border border-gray-100">
                <table class="w-full text-left text-sm">
                    <thead class="bg-gray-50 text-xs font-bold uppercase tracking-wider text-brand-navy">
                        <tr><th class="px-4 py-3">Reference No.</th><th class="px-4 py-3 text-right">Actions</th></tr>
                    </thead>
                    <tbody id="receiving-stock-request-rows" class="divide-y divide-gray-100"></tbody>
                </table>
            </div>
            <p id="receiving-stock-request-loading" class="hidden py-4 text-center text-sm text-gray-500">Loading stock requests...</p>
            <p id="receiving-stock-request-empty" class="hidden py-4 text-center text-sm text-gray-500">No stock requests found.</p>
        </div>
        <div class="flex justify-end border-t border-gray-100 px-6 py-4">
            <button type="button" data-close-receiving-stock-request-modal class="cursor-pointer px-4 py-2 text-sm font-semibold text-gray-500 transition hover:text-gray-700">Close</button>
        </div>
    </div>
</div>

<div id="receiving-stock-request-view-modal" class="hidden fixed inset-0 z-[120] flex items-center justify-center p-4" role="dialog" aria-modal="true" aria-labelledby="receivingStockRequestViewTitle">
    <div class="absolute inset-0 bg-brand-dark/20 backdrop-blur-xs" data-close-receiving-stock-request-view></div>
    <div class="relative z-[120] flex max-h-[90vh] w-full max-w-4xl flex-col overflow-hidden rounded-2xl border border-gray-100 bg-white shadow-2xl">
        <div class="flex items-center justify-between bg-brand-green px-6 py-4 text-white">
            <div>
                <h3 id="receivingStockRequestViewTitle" class="text-lg font-bold">Stock Request Details</h3>
                <p id="receiving-stock-request-view-subtitle" class="mt-0.5 text-xs text-white/70"></p>
            </div>
            <button type="button" data-close-receiving-stock-request-view class="cursor-pointer p-1 text-xl font-bold text-white/70 hover:text-white" aria-label="Close">&times;</button>
        </div>
        <div id="receiving-stock-request-view-body" class="max-h-[calc(90vh-132px)] space-y-5 overflow-y-auto p-6"></div>
        <div class="flex justify-end border-t border-gray-100 px-6 py-4">
            <button type="button" data-close-receiving-stock-request-view class="cursor-pointer px-4 py-2 text-sm font-semibold text-gray-500 transition hover:text-gray-700">Close</button>
        </div>
    </div>
</div>

@push('scripts')
<script>
(() => {
    const modal = document.getElementById('receiving-stock-request-modal');
    const scroll = document.getElementById('receiving-stock-request-scroll');
    const rows = document.getElementById('receiving-stock-request-rows');
    const loading = document.getElementById('receiving-stock-request-loading');
    const empty = document.getElementById('receiving-stock-request-empty');
    const viewModal = document.getElementById('receiving-stock-request-view-modal');
    const viewBody = document.getElementById('receiving-stock-request-view-body');
    const viewSubtitle = document.getElementById('receiving-stock-request-view-subtitle');
    const endpoint = @json(route('surface.stock.receive.stock-requests'));
    let nextPage = 1, loadingPage = false, hasMore = true;
    const esc = value => String(value ?? '').replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;').replace(/'/g, '&#039;');

    function reset() {
        rows.replaceChildren(); nextPage = 1; hasMore = true; empty.classList.add('hidden');
    }
    async function loadPage() {
        if (loadingPage || !hasMore) return;
        loadingPage = true; loading.classList.remove('hidden');
        try {
            const response = await fetch(`${endpoint}?page=${nextPage}`, {headers: {'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest'}});
            if (!response.ok) throw new Error('Unable to load stock requests.');
            const page = await response.json();
            page.data.forEach(request => {
                const row = document.createElement('tr');
                row.innerHTML = `<td class="px-4 py-3 font-semibold text-brand-dark">${esc(request.reference_no)}</td><td class="space-x-2 px-4 py-3 text-right"><button type="button" class="view-receiving-request rounded-lg bg-brand-green px-2.5 py-2 text-xs font-bold text-white hover:bg-brand-green-hover" data-request="${esc(JSON.stringify(request))}">View</button><button type="button" class="load-receiving-request rounded-lg bg-brand-gold px-2.5 py-2 text-xs font-bold text-white hover:bg-brand-gold-hover" data-request="${esc(JSON.stringify(request))}">Load</button></td>`;
                rows.appendChild(row);
            });
            hasMore = Boolean(page.next_page_url); nextPage++;
            if (!rows.children.length) empty.classList.remove('hidden');
        } catch (error) { console.error(error); }
        finally {
            loadingPage = false; loading.classList.add('hidden');
            if (hasMore && scroll.scrollHeight <= scroll.clientHeight) loadPage();
        }
    }
    function renderRequest(request) {
        const itemRows = (request.items || []).map(line => {
            const item = line.item || {};
            return `<tr class="border-t border-gray-100"><td class="px-4 py-3 text-center font-bold text-brand-navy">${esc(line.quantity)}</td><td class="px-4 py-3 text-gray-600">${esc(item.kind?.kind || '—')}</td><td class="px-4 py-3 font-semibold text-brand-dark">${esc([item.name, item.variant].filter(Boolean).join(' ') || '—')}</td><td class="px-4 py-3 text-gray-600">${esc(item.supplier?.name || '—')}</td><td class="px-4 py-3 text-gray-600">${esc(item.unit?.unit || '—')}</td><td class="px-4 py-3 text-gray-600">${esc(line.remarks || '—')}</td></tr>`;
        }).join('');
        const date = request.date ? new Date(`${String(request.date).slice(0, 10)}T00:00:00`).toLocaleDateString('en-GB', {day: '2-digit', month: 'long', year: 'numeric'}) : '—';
        const requester = request.requester?.name || [request.requester?.first_name, request.requester?.last_name].filter(Boolean).join(' ') || 'Unknown';
        return `<div class="grid grid-cols-1 gap-4 sm:grid-cols-3">${[['Reference number', request.reference_no], ['Request date', date], ['Requested by', requester]].map(([label, value]) => `<div class="rounded-xl border border-gray-100 bg-gray-50 px-4 py-3"><p class="text-xs font-bold uppercase tracking-wider text-gray-500">${esc(label)}</p><p class="mt-1 font-semibold text-brand-dark">${esc(value)}</p></div>`).join('')}</div><section><div class="mb-2 flex items-center justify-between"><h4 class="text-sm font-bold uppercase tracking-wider text-brand-navy">Requested items</h4><span class="text-xs text-gray-500">${(request.items || []).length} item(s)</span></div><div class="overflow-x-auto rounded-xl border border-gray-100"><table class="w-full min-w-[760px] text-left text-sm"><thead class="bg-gray-50 text-xs font-bold uppercase tracking-wider text-gray-500"><tr><th class="px-4 py-3 text-center">Qty.</th><th class="px-4 py-3">Category</th><th class="px-4 py-3">Item</th><th class="px-4 py-3">Supplier</th><th class="px-4 py-3">UOM</th><th class="px-4 py-3">Remarks</th></tr></thead><tbody>${itemRows || '<tr><td colspan="6" class="px-4 py-5 text-center text-gray-500">No requested items found.</td></tr>'}</tbody></table></div></section>`;
    }
    document.getElementById('open-stock-request-modal').addEventListener('click', () => { reset(); modal.classList.remove('hidden'); loadPage(); });
    rows.addEventListener('click', event => {
        const viewButton = event.target.closest('.view-receiving-request');
        const loadButton = event.target.closest('.load-receiving-request');
        if (viewButton) {
            const request = JSON.parse(viewButton.dataset.request);
            viewSubtitle.textContent = `Request ${request.reference_no || ''}`;
            viewBody.innerHTML = renderRequest(request);
            viewModal.classList.remove('hidden');
        } else if (loadButton) {
            window.loadReceivingStockRequest(JSON.parse(loadButton.dataset.request));
        }
    });
    scroll.addEventListener('scroll', () => { if (scroll.scrollTop + scroll.clientHeight >= scroll.scrollHeight - 80) loadPage(); });
    document.querySelectorAll('[data-close-receiving-stock-request-modal]').forEach(button => button.addEventListener('click', () => modal.classList.add('hidden')));
    document.querySelectorAll('[data-close-receiving-stock-request-view]').forEach(button => button.addEventListener('click', () => viewModal.classList.add('hidden')));
    document.addEventListener('keydown', event => {
        if (event.key !== 'Escape') return;
        if (!viewModal.classList.contains('hidden')) viewModal.classList.add('hidden');
        else if (!modal.classList.contains('hidden')) modal.classList.add('hidden');
    });
})();
</script>
@endpush
