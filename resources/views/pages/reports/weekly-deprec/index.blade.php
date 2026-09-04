@extends('layouts.app')

@section('page-title', 'Weekly Reports')

@section('sidebar')
    @include('components.sidebar')
@endsection

@section('modals')
    @include('components.backdrop')
    
    @include('components.reports.weekly.consumption-modal')
    @include('components.reports.weekly.rcsu-modal')
@endsection

@section('content')
<div class="space-y-6">

    <!-- Flash Messages -->
    @if(session('success'))
    <div class="bg-green-100 border border-brand-green/30 text-brand-green p-4 rounded-xl text-sm font-semibold flex items-center shadow-xs">
        <span class="mr-2">✓</span> {{ session('success') }}
    </div>
    @endif

    <!-- Header -->
    <div class="p-4 rounded-xl bg-white border border-gray-200 shadow-sm flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <form method="GET" action="{{ route('reports.weekly.index') }}" class="flex flex-wrap justify-between items-center gap-3 flex-1 w-full">
            <h2 class="font-bold text-xl">{{ $report_type }}</h2>

            <!-- Reports Type -->
            <div class="flex items-center gap-3">
                <label for="type">Filter: </label>
                <select id="type" name="type" onchange="this.form.submit()" 
                    class="bg-gray-50 border border-gray-300 text-brand-dark text-sm rounded-lg p-2 focus:outline-none focus:border-brand-gold">
                    <option value="" {{ request('type') == '' ? 'selected' : '' }}>
                        All Reports
                    </option>
                    @foreach($types as $type)
                        <option value="{{$type->id}}" {{ request('type') == $type->id ? 'selected' : '' }}>{{ $type->name }}</option>
                    @endforeach
                </select>
            </div>
        </form>
    </div>

    <!-- Body -->
    <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 text-xs font-bold text-brand-navy uppercase tracking-wider border-b border-gray-200">
                        <th class="px-6 py-4">Item Name</th>
                        <th class="px-6 py-4">Supplier</th>
                        <th class="px-6 py-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-sm text-gray-700">
                    @forelse($items as $item)
                    <tr class="hover:bg-gray-50/50 transition">

                        <!-- Name Column -->
                        <td class="px-6 py-4 font-semibold text-brand-dark">
                            {{ $item->name }}
                        </td>

                        <!-- Supplier Column -->
                        <td class="px-6 py-4 font-semibold text-brand-dark">
                            <span class="px-3 py-1 bg-slate-100 text-brand-navy/80 text-xs font-bold rounded-full border border-brand-navy/20">
                                {{ $item->supplier->name ?? 'N/A' }}
                            </span>
                        </td>

                        <!-- Protected Actions Triggering adjustments -->
                        @if(auth()->user()?->role->role == 'admin')
                        <td class="px-6 py-4 text-right whitespace-nowrap space-x-3">
                            <button type="button" 
                                onclick="consumptionModal('{{ $report_type }}', {{ json_encode($item) }})"
                                class="text-brand-navy hover:underline text-xs font-bold cursor-pointer">
                                View Consumption Report
                            </button>

                            <button type="button" 
                                onclick="openRcsuModal('{{ $report_type }}', {{ json_encode($item) }})"
                                class="text-brand-navy hover:underline text-xs font-bold cursor-pointer">
                                View RCSU Report
                            </button>
                        </td>

                        @endif
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-gray-400 font-medium">
                            No warehouse products matched the search query parameters.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script type="module">
window.consumptionModal = function(reportType, itemData) {
    const modal = document.getElementById('consumptionModal');
    const tbody = document.getElementById('stockCardTableBody');
    const titleSpan = document.getElementById('consumptionModalTitle');
    
    titleSpan.textContent = reportType || 'Report';
    tbody.innerHTML = '';

    modal.querySelector('#itemName').textContent = itemData.name;

    // Header Initial Row (Remaining Stock)
    let rowsHtml = `
        <tr class="text-center bg-gray-50/50">
            <td class="border border-gray-300 p-2 font-semibold text-left">${itemData.name || ''}</td>
            <td class="border border-gray-300 p-2">${itemData.unit?.unit || itemData.unit || 'Pcs'}</td>
            <td class="border border-gray-300 p-2">${itemData.entry_date || ''}</td>
            <td class="border border-gray-300 p-2">${itemData.initial_qty ?? ''}</td>
            <td class="border border-gray-300 p-2"></td>
            <td class="border border-gray-300 p-2"></td>
            <td class="border border-gray-300 p-2 font-bold">59,985</td>
            <td class="border border-gray-300 p-2 text-left">Remaining Stock</td>
            <td class="border border-gray-300 p-2 text-left">No Notes</td>
        </tr>
    `;

    // Dynamic Daily Logs (or fallback empty rows)
    const logs = [
        { 
            entry_date: null,
            quantity: null,
            date_withdrawn: null,
            quantity_withdrawn: null,
            balance: '59,985',
            remarks: 'Deposit Supply',
            notes: null
        },
        { 
            entry_date: '01-June-2026',
            quantity: null,
            date_withdrawn: null,
            quantity_withdrawn: '10,750',
            balance: '49,235',
            remarks: 'Transfer to Underground',
            notes: null
        },
    ];
    let currentBalance = itemData.balance ?? 0;

    if (logs.length > 0) {
        logs.forEach(log => {
            rowsHtml += `
                <tr class="text-center hover:bg-gray-50">
                    <td class="border border-gray-300 p-2"></td>
                    <td class="border border-gray-300 p-2"></td>
                    <td class="border border-gray-300 p-2">${log.entry_date || ''}</td>
                    <td class="border border-gray-300 p-2">${log.quantity_added || ''}</td>
                    <td class="border border-gray-300 p-2 font-semibold">${log.date_withdrawn || ''}</td>
                    <td class="border border-gray-300 p-2">${log.quantity_withdrawn || ''}</td>
                    <td class="border border-gray-300 p-2 font-bold">${log.balance ?? 0}</td>
                    <td class="border border-gray-300 p-2 text-left">${log.remarks || 'No Usage'}</td>
                    <td class="border border-gray-300 p-2 text-left">${log.notes || 'No Notes'}</td>
                </tr>
            `;
        });
    }

    // Stock Balance Summary Row (Highlighted yellow like in screenshot)
    rowsHtml += `
        <tr class="text-center font-bold">
            <td class="border border-gray-300 p-2" colspan="6"></td>
            <td class="border border-gray-300 p-2 bg-yellow-300 text-brand-dark">${currentBalance}</td>
            <td class="border border-gray-300 p-2 bg-yellow-300 text-brand-dark text-center uppercase tracking-wider">Stock Balance</td>
        </tr>
    `;

    tbody.innerHTML = rowsHtml;

    // Show Modal
    modal.classList.remove('opacity-0', 'pointer-events-none');
    modal.classList.add('opacity-100', 'pointer-events-auto');
};

window.closeConsumptionModal = function() {
    const modal = document.getElementById('consumptionModal');
    modal.classList.add('opacity-0', 'pointer-events-none');
    modal.classList.remove('opacity-100', 'pointer-events-auto');
};


// RCSU
window.openRcsuModal = function(reportData) {
    const modal = document.getElementById('rcsuModal');
    
    // Optional dynamic title/date binding if supplied
    if (reportData?.title) {
        document.getElementById('reportModalTitle').textContent = reportData.title;
    }
    if (reportData?.dateRange) {
        document.getElementById('reportModalDateRange').textContent = reportData.dateRange;
    }

    // Show modal
    modal.classList.remove('opacity-0', 'pointer-events-none');
    modal.classList.add('opacity-100', 'pointer-events-auto');
};

window.closeRcsuModal = function() {
    const modal = document.getElementById('rcsuModal');
    modal.classList.add('opacity-0', 'pointer-events-none');
    modal.classList.remove('opacity-100', 'pointer-events-auto');
};
</script>
@endpush