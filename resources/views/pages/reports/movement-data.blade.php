@extends('layouts.app')

@section('page-title', 'Transfer/Movement Data')

@section('sidebar')
    @include('components.sidebar')
@endsection

@section('modals')
    @include('components.backdrop')

    <!-- View Movement Details Modal -->
    <div id="viewMovementModal" class="fixed inset-0 z-110 flex items-center justify-center p-4 opacity-0 pointer-events-none transition-opacity duration-200">
        <!-- Backdrop -->
        <div class="absolute z-100 inset-0 bg-brand-dark/20 backdrop-blur-xs" onclick="closeMovementModal()"></div>

        <!-- Wide Frame Area -->
        <div class="relative bg-white w-full max-w-6xl rounded-2xl shadow-2xl border-0 overflow-hidden transform transition-all z-110 flex flex-col max-h-[90vh]">
            
            <!-- Header Strip -->
            <div class="px-6 py-4 bg-brand-green text-white flex justify-between items-center shrink-0">
                <div>
                    <h3 class="font-bold tracking-wide text-lg" id="modalRefNo">Issuance Document</h3>
                    <p class="text-xs text-white/70" id="modalMeta">Logged by System</p>
                </div>
                <button onclick="closeMovementModal()" class="text-white/70 hover:text-white font-bold text-xl cursor-pointer p-1">✕</button>
            </div>

            <!-- Scrollable Document Layout Grid -->
            <div class="p-6 overflow-y-auto grid grid-cols-1 md:grid-cols-2 gap-6 bg-gray-50/50">
                
                <!-- LEFT PANEL: Grand Totals Summary -->
                <div class="bg-white p-4 rounded-xl border border-gray-300 shadow-xs space-y-3 overflow-y-auto">
                    <div class="border-b border-gray-300 pb-2 text-center">
                        <h4 class="font-extrabold uppercase tracking-wider text-sm text-brand-navy">Total Explosives To Be Lowered</h4>
                    </div>

                    <div class="space-y-3">
                        <div class="overflow-x-auto">
                            <table class="w-full text-xs text-left border border-gray-300">
                                <thead class="bg-gray-100 uppercase font-bold text-gray-700 text-center">
                                    <tr>
                                        <th class="border border-gray-300 p-2 w-10">#</th>
                                        <th class="border border-gray-300 p-2 text-left">Particular</th>
                                        <th class="border border-gray-300 p-2 w-20">Quantity</th>
                                        <th class="border border-gray-300 p-2 w-20">UoM</th>
                                    </tr>
                                </thead>
                                <tbody id="modalSummaryBody" class="divide-y divide-gray-200 font-medium">
                                    <!-- Injected by JS -->
                                </tbody>
                            </table>
                        </div>
                        

                        <div class="overflow-x-auto">
                            <table class="w-full text-xs text-left border border-gray-300">
                                <thead class="bg-gray-100 uppercase font-bold text-gray-700 text-center">
                                    <tr>
                                        <th class="border border-gray-300 p-2">Delay#</th>
                                        <th class="border border-gray-300 p-2">UoM</th>
                                        <th class="border border-gray-300 p-2">EXEL LP 2.4</th>
                                        <th class="border border-gray-300 p-2">EXEL LP 3.6</th>
                                    </tr>
                                </thead>
                                <tbody id="detonators" class="divide-y divide-gray-200 font-medium">
                                    @foreach([1,2,3,4,5,6,7,8,9,10,11,12,13,14,15] as $num)
                                    <tr class="hover:bg-gray-50/50 text-gray-800">
                                        <td class="border border-gray-300 p-2 text-center font-bold">{{ $num }}</td>
                                        <td class="border border-gray-300 p-2 text-center font-semibold">PCS</td>
                                        <td class="border border-gray-300 p-2 text-center font-bold text-brand-navy">750</td>
                                        <td class="border border-gray-300 p-2 text-center text-gray-600">220</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- RIGHT PANEL: Level Breakdowns -->
                <div class="bg-white p-4 rounded-xl border border-gray-300 shadow-xs space-y-3 overflow-y-auto">
                    <div class="text-center pb-1 border-b border-gray-300">
                        <h4 class="font-extrabold uppercase tracking-wider text-sm text-brand-navy">Explosives Per Level</h4>
                    </div>

                    <!-- Container where level cards are dynamically added -->
                    <div id="modalLevelsContainer" class="space-y-4 overflow-y-auto pr-1">
                        <!-- Injected by JS -->
                    </div>
                </div>

            </div>

            <!-- Footer -->
            <div class="px-6 py-3 bg-white border-t border-gray-200 flex justify-between items-center shrink-0">
                <div id="modalNotesText" class="text-xs text-gray-500 italic"></div>
                <button type="button" onclick="closeMovementModal()" class="px-5 py-2 rounded-lg bg-brand-green text-white text-xs font-bold transition cursor-pointer hover:bg-brand-green-hover">
                    Close
                </button>
            </div>
        </div>
    </div>
@endsection

@section('content')
<div class="space-y-6">

    <!-- Flash Messages -->
    @if(session('success'))
        <div class="bg-green-100 border border-brand-green/30 text-brand-green p-4 rounded-xl text-sm font-semibold flex items-center shadow-xs">
            <span class="mr-2">✓</span> {{ session('success') }}
        </div>
    @endif

    <!-- Control Matrix Panel -->
    <div class="bg-white p-4 rounded-xl border border-gray-200 shadow-sm flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div class="flex flex-wrap items-center justify-between w-full">
            
            <!-- Search & Filters -->
            <form method="GET" action="{{ route('reports.movement-data') }}" class="flex flex-wrap items-center gap-3 flex-1 w-full">
                <div class="flex w-90">
                    <div class="relative min-w-70 flex-1 max-w-md">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search Reference No or Notes..." 
                            class="w-full bg-gray-50 border border-gray-300 text-brand-dark text-sm rounded-tl-lg rounded-bl-lg pl-3 pr-10 py-2 focus:border-brand-gold focus:outline-none focus:ring-2 focus:ring-brand-gold/20 transition">
                    </div>
                    <button type="submit" class="px-2.5 cursor-pointer active:translate-y-0.5 transition bg-brand-gold hover:bg-brand-gold-hover border border-brand-gold border-l-0 rounded-tr-lg rounded-br-lg">
                        <i class="fa-solid fa-magnifying-glass text-white"></i>
                    </button>
                </div>

                <select name="type_filter" onchange="this.form.submit()" 
                    class="bg-gray-50 border border-gray-300 text-brand-dark text-sm rounded-lg p-2 focus:outline-none focus:border-brand-gold">
                    <option value="" {{ request('type_filter') == '' ? 'selected' : '' }}>All Movement Types</option>
                    <option value="issuance" {{ request('type_filter') == 'issuance' ? 'selected' : '' }}>Issuance</option>
                    <option value="return" {{ request('type_filter') == 'return' ? 'selected' : '' }}>Return</option>
                    <option value="transfer" {{ request('type_filter') == 'transfer' ? 'selected' : '' }}>Transfer</option>
                    <option value="adjustment" {{ request('type_filter') == 'adjustment' ? 'selected' : '' }}>Adjustment</option>
                </select>
            </form>
            
        </div>
    </div>

    <!-- Movement Header Table -->
    <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 text-xs font-bold text-brand-navy uppercase tracking-wider border-b border-gray-200">
                        <th class="px-6 py-4">Reference No.</th>
                        <th class="px-6 py-4">Movement Type</th>
                        <th class="px-6 py-4 text-center">Items Count</th>
                        <th class="px-6 py-4">Logged By</th>
                        <th class="px-6 py-4">Date & Time</th>
                        <th class="px-6 py-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-sm text-gray-700">
                    
                    @forelse($movements as $row)
                        <tr class="hover:bg-gray-50/50 transition">
                            
                            <!-- Reference No -->
                            <td class="px-6 py-4 font-mono text-xs font-bold text-brand-navy">
                                <span class="bg-brand-green/5 text-brand-navy px-2.5 py-1 rounded-md border border-brand-navy/10">
                                    {{ $row->reference_no }}
                                </span>
                            </td>

                            <!-- Movement Type Badge -->
                            <td class="px-6 py-4">
                                @php
                                    $badgeClasses = match($row->type) {
                                        'issuance' => 'bg-blue-50 text-blue-700 border-blue-200',
                                        'return'   => 'bg-amber-50 text-amber-700 border-amber-200',
                                        'transfer' => 'bg-purple-50 text-purple-700 border-purple-200',
                                        default    => 'bg-gray-50 text-gray-700 border-gray-200',
                                    };
                                @endphp
                                <span class="px-2.5 py-0.5 text-xs font-semibold uppercase rounded-md border {{ $badgeClasses }}">
                                    {{ $row->type }}
                                </span>
                            </td>

                            <!-- Total Items Transferred -->
                            <td class="px-6 py-4 text-center font-bold text-brand-dark">
                                {{ $row->items_count ?? $row->items->count() }} line items
                            </td>

                            <!-- Logged By -->
                            <td class="px-6 py-4 font-medium text-gray-600">
                                {{ $row->user->name ?? 'System' }}
                            </td>

                            <!-- Date & Time -->
                            <td class="px-6 py-4 text-xs text-gray-500 whitespace-nowrap">
                                {{ $row->created_at->format('M d, Y • h:i A') }}
                            </td>

                            <!-- Action Buttons -->
                            <td class="px-6 py-4 text-right whitespace-nowrap">
                                <button type="button" 
                                    onclick="viewMovementDetails({{ json_encode($row->load(['items.item.unit', 'items.destinationLevel', 'user'])) }})"
                                    class="text-brand-navy hover:text-brand-gold hover:underline text-xs font-bold cursor-pointer transition">
                                    View Details
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-gray-400 font-medium">
                                No stock movement records found matching your filters.
                            </td>
                        </tr>
                    @endforelse

                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if(method_exists($movements, 'hasPages') && $movements->hasPages())
            <div class="p-4 bg-gray-50 border-t border-gray-100">
                {{ $movements->appends(request()->query())->links() }}
            </div>
        @endif
    </div>

</div>

@push('scripts')
<script>
function viewMovementDetails(movement) {
    document.getElementById('modalRefNo').innerText = 'MINE EXPLOSIVES TRANSFER/MOVEMENT ID: ' + movement.reference_no;
    document.getElementById('modalMeta').innerText = 'Logged by ' + (movement.user ? movement.user.name : 'System') + ' • ' + new Date(movement.created_at).toLocaleString();
    document.getElementById('modalNotesText').innerText = movement.notes ? 'Notes: ' + movement.notes : '';

    const summaryMap = {};
    const levelsMap = {};

    // Group items for Left and Right panels
    movement.items.forEach(item => {
        const itemName = item.item ? item.item.name : 'Unknown';
        const uom = item.item && item.item.unit ? item.item.unit.unit : 'Pcs';
        const levelName = item.destination_level ? item.destination_level.name : 'Surface Warehouse';

        // 1. Accumulate Left Panel Grand Totals
        if (!summaryMap[itemName]) {
            summaryMap[itemName] = { quantity: 0, uom: uom };
        }
        summaryMap[itemName].quantity += item.quantity;

        // 2. Accumulate Right Panel Levels
        if (!levelsMap[levelName]) {
            levelsMap[levelName] = [];
        }
        levelsMap[levelName].push({
            particular: itemName,
            quantity: item.quantity,
            uom: uom
        });
    });

    // Populate Left Panel (Summary Table)
    const summaryBody = document.getElementById('modalSummaryBody');
    summaryBody.innerHTML = '';
    let summaryIndex = 1;

    for (const [particular, data] of Object.entries(summaryMap)) {
        summaryBody.innerHTML += `
            <tr class="hover:bg-gray-50/50 text-gray-800">
                <td class="border border-gray-300 p-2 text-center font-bold">${summaryIndex++}</td>
                <td class="border border-gray-300 p-2 font-semibold">${particular}</td>
                <td class="border border-gray-300 p-2 text-center font-bold text-brand-navy">${data.quantity.toLocaleString()}</td>
                <td class="border border-gray-300 p-2 text-center text-gray-600">${data.uom}</td>
            </tr>
        `;
    }

    // Populate Right Panel (Per Level Tables)
    const levelsContainer = document.getElementById('modalLevelsContainer');
    levelsContainer.innerHTML = '';

    const sortedLevelsMap = Object.fromEntries(
        Object.entries(levelsMap).sort(([a], [b]) => {
            const levelA = parseInt(a.replace("Level ", ""), 10);
            const levelB = parseInt(b.replace("Level ", ""), 10);
            return levelA - levelB;
        })
    ); 
    for (const [levelName, levelItems] of Object.entries(sortedLevelsMap)) {
        let levelRowsHtml = '';
        levelItems.forEach((lvlItem, idx) => {
            levelRowsHtml += `
                <tr class="text-gray-800">
                    <td class="border border-gray-300 p-1.5 text-center font-bold">${idx + 1}</td>
                    <td class="border border-gray-300 p-1.5 font-semibold">${lvlItem.particular}</td>
                    <td class="border border-gray-300 p-1.5 text-center font-bold text-brand-navy">${lvlItem.quantity}</td>
                    <td class="border border-gray-300 p-1.5 text-center text-gray-600">${lvlItem.uom}</td>
                </tr>
            `;
        });

        levelsContainer.innerHTML += `
            <div class="bg-white border border-gray-300 rounded-lg overflow-hidden shadow-2xs">
                <div class="bg-gray-200 px-3 py-1.5 border-b border-gray-300 text-center font-extrabold text-xs text-brand-navy uppercase tracking-wider">
                    ${levelName}
                </div>
                <table class="w-full text-xs text-left border-collapse">
                    <thead class="bg-gray-50 uppercase font-bold text-gray-600 text-center">
                        <tr>
                            <th class="border border-gray-300 p-1.5 w-8">#</th>
                            <th class="border border-gray-300 p-1.5 text-left">Particular</th>
                            <th class="border border-gray-300 p-1.5 w-16">Quantity</th>
                            <th class="border border-gray-300 p-1.5 w-16">UoM</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        ${levelRowsHtml}
                    </tbody>
                </table>
            </div>
        `;
    }

    // Display Modal
    const modal = document.getElementById('viewMovementModal');
    modal.classList.remove('opacity-0', 'pointer-events-none');
    modal.classList.add('opacity-100');
}

function closeMovementModal() {
    const modal = document.getElementById('viewMovementModal');
    modal.classList.add('opacity-0', 'pointer-events-none');
    modal.classList.remove('opacity-100');
}
</script>
@endpush
@endsection