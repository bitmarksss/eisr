@extends('layouts.app')

@section('page-title', 'All Reports')

@section('sidebar')
    @include('components.sidebar')
@endsection

@section('modals')
    @include('components.backdrop')
    
    @include('components.reports.weekly.consumption-modal')
    @include('components.reports.weekly.rcsu-modal')
    @include('components.reports.weekly.mcd-detail-explosives-consumption-modal')
    @include('components.reports.weekly.mcd-weekly-explosives-consumption-modal')
@endsection

@section('content')
<div class="space-y-6">

    <!-- Flash Messages -->
    @if(session('success'))
    <div class="bg-green-100 border border-brand-green/30 text-brand-green p-4 rounded-xl text-sm font-semibold flex items-center shadow-xs">
        <span class="mr-2">✓</span> {{ session('success') }}
    </div>
    @endif

    <!-- Body -->
    <div class="grid grid-cols-3 gap-4">
        
        <!-- GRID 1 -->
        <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
            <p class="p-4 bg-brand-green text-white font-bold">WEEKLY REPORT SUBMITTED TO RCSU - PMC AND TIGERWAY</p>
            <table class="w-full text-left border-collapse">
                 
                <tbody class="divide-y divide-gray-100 text-sm text-gray-700">
                    <tr class="hover:bg-gray-50/50 transition">

                        <!-- Name Column -->
                        <td class="px-6 py-4 font-semibold text-brand-dark">
                            Surface Consumption
                        </td>

                        <!-- Protected Actions Triggering adjustments -->
                        <td class="px-6 py-4 text-right whitespace-nowrap space-x-3">
                            <button type="button" 
                                onclick="consumptionModal('Surface Consumption', {{ json_encode($type) }})"
                                class="p-2 text-brand-navy hover:text-white text-xs font-bold border border-brand-navy hover:bg-brand-green transition cursor-pointer rounded-xl">
                                View Report
                            </button>
                        </td>
                    </tr>
                    
                    <tr class="hover:bg-gray-50/50 transition">

                        <!-- Name Column -->
                        <td class="px-6 py-4 font-semibold text-brand-dark">
                            Underground Consumption
                        </td>

                        <!-- Protected Actions Triggering adjustments -->
                        <td class="px-6 py-4 text-right whitespace-nowrap space-x-3">
                            <button type="button" 
                                onclick="consumptionModal('Underground Consumption', {{ json_encode($type) }})"
                                class="p-2 text-brand-navy hover:text-white text-xs font-bold border border-brand-navy hover:bg-brand-green transition cursor-pointer rounded-xl">
                                View Report
                            </button>
                        </td>
                    </tr>
                    
                    <tr class="hover:bg-gray-50/50 transition">

                        <!-- Name Column -->
                        <td class="px-6 py-4 font-semibold text-brand-dark">
                            RCSU Report - PMC-RSU
                        </td>

                        <!-- Protected Actions Triggering adjustments -->
                        <td class="px-6 py-4 text-right whitespace-nowrap space-x-3">
                            <button type="button" 
                                onclick="openRcsuModal('RCSU Report - PMC-RSU', {{ json_encode($type) }})"
                                class="p-2 text-brand-navy hover:text-white text-xs font-bold border border-brand-navy hover:bg-brand-green transition cursor-pointer rounded-xl">
                                View Report
                            </button>
                        </td>
                    </tr>
                    
                    <tr class="hover:bg-gray-50/50 transition">

                        <!-- Name Column -->
                        <td class="px-6 py-4 font-semibold text-brand-dark">
                            Tigerway Weekly Consumption
                        </td>

                        <!-- Protected Actions Triggering adjustments -->
                        <td class="px-6 py-4 text-right whitespace-nowrap space-x-3">
                            <button type="button" 
                                onclick="consumptionModal('Tigerway Weekly Consumption', {{ json_encode($type) }})"
                                class="p-2 text-brand-navy hover:text-white text-xs font-bold border border-brand-navy hover:bg-brand-green transition cursor-pointer rounded-xl">
                                View Report
                            </button>
                        </td>
                    </tr>
                    
                    <tr class="hover:bg-gray-50/50 transition">

                        <!-- Name Column -->
                        <td class="px-6 py-4 font-semibold text-brand-dark">
                            RCSU Report - Tigerway
                        </td>

                        <!-- Protected Actions Triggering adjustments -->
                        <td class="px-6 py-4 text-right whitespace-nowrap space-x-3">
                            <button type="button" 
                                onclick="openRcsuModal('RCSU Report - Tigerway', {{ json_encode($type) }})"
                                class="p-2 text-brand-navy hover:text-white text-xs font-bold border border-brand-navy hover:bg-brand-green transition cursor-pointer rounded-xl">
                                View Report
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        
        <!-- GRID 2 -->
        <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
            <p class="p-4 bg-brand-green text-white font-bold">WEEKLY REPORT SUBMITTED TO MILL MCD</p>
            <table class="w-full text-left border-collapse">
                 
                <tbody class="divide-y divide-gray-100 text-sm text-gray-700">
                    <tr class="hover:bg-gray-50/50 transition">

                        <!-- Name Column -->
                        <td class="px-6 py-4 font-semibold text-brand-dark">
                            Explosives Weekly Consumption - Daily MCD
                        </td>

                        <!-- Protected Actions Triggering adjustments -->
                        <td class="px-6 py-4 text-right whitespace-nowrap space-x-3">
                            <button type="button" 
                                onclick="openDetailConsumptionModal()"
                                class="p-2 text-brand-navy hover:text-white text-xs font-bold border border-brand-navy hover:bg-brand-green transition cursor-pointer rounded-xl">
                                View Report
                            </button>
                        </td>
                    </tr>
                    
                    <tr class="hover:bg-gray-50/50 transition">

                        <!-- Name Column -->
                        <td class="px-6 py-4 font-semibold text-brand-dark">
                            Explosives Weekly Consumption - MCD
                        </td>

                        <!-- Protected Actions Triggering adjustments -->
                        <td class="px-6 py-4 text-right whitespace-nowrap space-x-3">
                            <button type="button" 
                                onclick="openWeeklySummaryModal()"
                                class="p-2 text-brand-navy hover:text-white text-xs font-bold border border-brand-navy hover:bg-brand-green transition cursor-pointer rounded-xl">
                                View Report
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        
        <!-- GRID 3 -->
        <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
            <p class="p-4 bg-brand-green text-white font-bold">DAILY CONSOLIDATION BLASTER REPORT PER WEEK PMC AND TIGERWAY SUBMITTED TO PNP</p>
            <table class="w-full text-left border-collapse">
                 
                <tbody class="divide-y divide-gray-100 text-sm text-gray-700">
                    <tr class="hover:bg-gray-50/50 transition">

                        <!-- Name Column -->
                        <td class="px-6 py-4 font-semibold text-brand-dark">
                            DAILY BLASTER REPORT - PMC
                        </td>

                        <!-- Protected Actions Triggering adjustments -->
                        <td class="px-6 py-4 text-right whitespace-nowrap space-x-3">
                            <button type="button" 
                                onclick="openDetailConsumptionModal()"
                                class="p-2 text-brand-navy hover:text-white text-xs font-bold border hover:bg-brand-green transition cursor-pointer rounded-xl disabled">
                                View Report
                            </button>
                        </td>
                    </tr>
                    
                    <tr class="hover:bg-gray-50/50 transition">

                        <!-- Name Column -->
                        <td class="px-6 py-4 font-semibold text-brand-dark">
                            DAILY BLASTER REPORT - TIGERWAY
                        </td>

                        <!-- Protected Actions Triggering adjustments -->
                        <td class="px-6 py-4 text-right whitespace-nowrap space-x-3">
                            <button type="button" 
                                onclick="openWeeklySummaryModal()"
                                class="p-2 text-brand-navy hover:text-white text-xs font-bold border hover:bg-brand-green transition cursor-pointer rounded-xl disabled">
                                View Report
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        
        <!-- GRID 4 -->
        <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
            <p class="p-4 bg-brand-green text-white font-bold">MONTHLY REPORT SUBMITTED TO MGB</p>
            <table class="w-full text-left border-collapse">
                 
                <tbody class="divide-y divide-gray-100 text-sm text-gray-700">
                    <tr class="hover:bg-gray-50/50 transition">
                        <!-- Name Column -->
                        <td class="px-6 py-4 font-semibold text-brand-dark">
                            DAILY REPORT - MGB
                        </td>
                        <!-- Protected Actions Triggering adjustments -->
                        <td class="px-6 py-4 text-right whitespace-nowrap space-x-3">
                            <button type="button" 
                                onclick="openDetailConsumptionModal()"
                                class="p-2 text-brand-navy hover:text-white text-xs font-bold border hover:bg-brand-green transition cursor-pointer rounded-xl disabled">
                                View Report
                            </button>
                        </td>
                    </tr>
                    
                    <tr class="hover:bg-gray-50/50 transition">
                        <!-- Name Column -->
                        <td class="px-6 py-4 font-semibold text-brand-dark">
                            BR REPORT - MGB
                        </td>
                        <!-- Protected Actions Triggering adjustments -->
                        <td class="px-6 py-4 text-right whitespace-nowrap space-x-3">
                            <button type="button" 
                                onclick="openWeeklySummaryModal()"
                                class="p-2 text-brand-navy hover:text-white text-xs font-bold border hover:bg-brand-green transition cursor-pointer rounded-xl disabled">
                                View Report
                            </button>
                        </td>
                    </tr>
                    
                    <tr class="hover:bg-gray-50/50 transition">
                        <!-- Name Column -->
                        <td class="px-6 py-4 font-semibold text-brand-dark">
                            FY 2026 - MGB
                        </td>
                        <!-- Protected Actions Triggering adjustments -->
                        <td class="px-6 py-4 text-right whitespace-nowrap space-x-3">
                            <button type="button" 
                                onclick="openWeeklySummaryModal()"
                                class="p-2 text-brand-navy hover:text-white text-xs font-bold border hover:bg-brand-green transition cursor-pointer rounded-xl disabled">
                                View Report
                            </button>
                        </td>
                    </tr>
                    
                    <tr class="hover:bg-gray-50/50 transition">
                        <!-- Name Column -->
                        <td class="px-6 py-4 font-semibold text-brand-dark">
                            EXPLOSIVE AND ACCESSORIES CON.REPORT - MGB
                        </td>
                        <!-- Protected Actions Triggering adjustments -->
                        <td class="px-6 py-4 text-right whitespace-nowrap space-x-3">
                            <button type="button" 
                                onclick="openWeeklySummaryModal()"
                                class="p-2 text-brand-navy hover:text-white text-xs font-bold border hover:bg-brand-green transition cursor-pointer rounded-xl disabled">
                                View Report
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        
        <!-- GRID 5 -->
        <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
            <p class="p-4 bg-brand-green text-white font-bold">EXPLOSIVES MONTHLY REPORT DATA</p>
            <table class="w-full text-left border-collapse">
                 
                <tbody class="divide-y divide-gray-100 text-sm text-gray-700">
                    <tr class="hover:bg-gray-50/50 transition">
                        <!-- Name Column -->
                        <td class="px-6 py-4 font-semibold text-brand-dark">
                            DAILY CONSUMPTION - MONTHLY
                        </td>
                        <!-- Protected Actions Triggering adjustments -->
                        <td class="px-6 py-4 text-right whitespace-nowrap space-x-3">
                            <button type="button" 
                                onclick="openDetailConsumptionModal()"
                                class="p-2 text-brand-navy hover:text-white text-xs font-bold border hover:bg-brand-green transition cursor-pointer rounded-xl disabled">
                                View Report
                            </button>
                        </td>
                    </tr>
                    
                    <tr class="hover:bg-gray-50/50 transition">
                        <!-- Name Column -->
                        <td class="px-6 py-4 font-semibold text-brand-dark">
                            COSTING 2026 - MONTHLY
                        </td>
                        <!-- Protected Actions Triggering adjustments -->
                        <td class="px-6 py-4 text-right whitespace-nowrap space-x-3">
                            <button type="button" 
                                onclick="openWeeklySummaryModal()"
                                class="p-2 text-brand-navy hover:text-white text-xs font-bold border hover:bg-brand-green transition cursor-pointer rounded-xl disabled">
                                View Report
                            </button>
                        </td>
                    </tr>
                    
                    <tr class="hover:bg-gray-50/50 transition">
                        <!-- Name Column -->
                        <td class="px-6 py-4 font-semibold text-brand-dark">
                            MONTHLY REPORT 2026
                        </td>
                        <!-- Protected Actions Triggering adjustments -->
                        <td class="px-6 py-4 text-right whitespace-nowrap space-x-3">
                            <button type="button" 
                                onclick="openWeeklySummaryModal()"
                                class="p-2 text-brand-navy hover:text-white text-xs font-bold border hover:bg-brand-green transition cursor-pointer rounded-xl disabled">
                                View Report
                            </button>
                        </td>
                    </tr>
                    
                    <tr class="hover:bg-gray-50/50 transition">
                        <!-- Name Column -->
                        <td class="px-6 py-4 font-semibold text-brand-dark">
                            MONTHLY COMPARATIVE 2026
                        </td>
                        <!-- Protected Actions Triggering adjustments -->
                        <td class="px-6 py-4 text-right whitespace-nowrap space-x-3">
                            <button type="button" 
                                onclick="openWeeklySummaryModal()"
                                class="p-2 text-brand-navy hover:text-white text-xs font-bold border hover:bg-brand-green transition cursor-pointer rounded-xl disabled">
                                View Report
                            </button>
                        </td>
                    </tr>
                    
                    <tr class="hover:bg-gray-50/50 transition">
                        <!-- Name Column -->
                        <td class="px-6 py-4 font-semibold text-brand-dark">
                            EXPLOSIVES DELIVERIES - MONTHLY
                        </td>
                        <!-- Protected Actions Triggering adjustments -->
                        <td class="px-6 py-4 text-right whitespace-nowrap space-x-3">
                            <button type="button" 
                                onclick="openWeeklySummaryModal()"
                                class="p-2 text-brand-navy hover:text-white text-xs font-bold border hover:bg-brand-green transition cursor-pointer rounded-xl disabled">
                                View Report
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        
        <!-- GRID 6 -->
        <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
            <p class="p-4 bg-brand-green text-white font-bold">EXPLOSIVES USAGE ANALYSIS</p>
            <table class="w-full text-left border-collapse">
                 
                <tbody class="divide-y divide-gray-100 text-sm text-gray-700">
                    <tr class="hover:bg-gray-50/50 transition">
                        <!-- Name Column -->
                        <td class="px-6 py-4 font-semibold text-brand-dark">
                            DAILY EXPLOSIVES USAGE ANALYSIS 2026
                        </td>
                        <!-- Protected Actions Triggering adjustments -->
                        <td class="px-6 py-4 text-right whitespace-nowrap space-x-3">
                            <button type="button" 
                                onclick="openDetailConsumptionModal()"
                                class="p-2 text-brand-navy hover:text-white text-xs font-bold border hover:bg-brand-green transition cursor-pointer rounded-xl disabled">
                                View Report
                            </button>
                        </td>
                    </tr>
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
    tbody.setHTML('');

    modal.querySelector('#itemName').textContent = itemData.name ?? 'Atque Repellendus';

    // Header Initial Row (Remaining Stock)
    let rowsHtml = `
        <tr class="text-center bg-gray-50/50">
            <td class="border border-gray-300 p-2 font-semibold text-left">${itemData.name || 'Atque Repellendus'}</td>
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

    tbody.setHTML(rowsHtml);

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

// WEEKLY/DAILY MCD
window.openDetailConsumptionModal = function(data) {
    const modal = document.getElementById('detailConsumptionModal');
    
    if (data?.title) {
        document.getElementById('detailModalTitle').textContent = data.title;
    }
    if (data?.dateRange) {
        document.getElementById('detailModalDateRange').textContent = data.dateRange;
    }

    modal.classList.remove('opacity-0', 'pointer-events-none');
    modal.classList.add('opacity-100', 'pointer-events-auto');
};

window.closeDetailConsumptionModal = function() {
    const modal = document.getElementById('detailConsumptionModal');
    modal.classList.add('opacity-0', 'pointer-events-none');
    modal.classList.remove('opacity-100', 'pointer-events-auto');
};

// WEEKLY MCD
window.openWeeklySummaryModal = function(data) {
    const modal = document.getElementById('weeklySummaryModal');
    
    if (data?.title) {
        document.getElementById('summaryModalTitle').textContent = data.title;
    }
    if (data?.dateRange) {
        document.getElementById('summaryModalDateRange').textContent = data.dateRange;
    }

    modal.classList.remove('opacity-0', 'pointer-events-none');
    modal.classList.add('opacity-100', 'pointer-events-auto');
};

window.closeWeeklySummaryModal = function() {
    const modal = document.getElementById('weeklySummaryModal');
    modal.classList.add('opacity-0', 'pointer-events-none');
    modal.classList.remove('opacity-100', 'pointer-events-auto');
};
</script>
@endpush