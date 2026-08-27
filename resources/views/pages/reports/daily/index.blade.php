@extends('layouts.app')

@section('page-title', 'Explosive Delivery Report')

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
    
    <!-- Control Matrix Panel -->
    <div class="bg-white p-4 mb-10 rounded-xl border border-gray-200 shadow-sm flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div class="flex flex-wrap items-center justify-between w-full">
            
            <!-- Search and Filters -->
            <form method="GET" action="{{ route('reports.daily.index') }}" class="flex flex-wrap items-center gap-3 flex-1 w-full">

                <!-- Date Filter -->
                <div class="space-y-1">
                    <label class="block text-xs font-semibold">Month:</label>
                    <select name="month" onchange="this.form.submit()" 
                        class="bg-gray-50 border border-gray-300 text-brand-dark text-sm rounded-lg p-2 focus:outline-none focus:border-brand-gold">
                        <option value=""> Select a month </option>
                        @foreach($months as $key => $month)
                            <option value="{{ $key }}" {{ request('month') == $key ? 'selected' : '' }}> {{ $month }} </option>
                        @endforeach
                    </select>
                </div>
                
                <!-- Levels Filter -->
                <div class="space-y-1">
                    <label class="block text-xs font-semibold">Level:</label>
                    <select name="type" onchange="this.form.submit()" 
                        class="bg-gray-50 border border-gray-300 text-brand-dark text-sm rounded-lg p-2 focus:outline-none focus:border-brand-gold">
                        @foreach($types as $key => $type)
                            <option value="{{ $type }}" {{ request('type') == $type ? 'selected' : '' }}> {{ strtoupper($type) }} </option>
                        @endforeach
                    </select>
                </div>
            </form>
            
            <div class="flex items-end space-x-2">
                <a href="{{ route('reports.daily.create') }}" class="px-4 py-2 rounded-lg bg-brand-navy hover:bg-brand-navy-hover active:translate-y-0.5 text-white text-sm font-bold transition cursor-pointer flex items-center gap-1.5">
                    <i class="fa-solid fa-file-excel text-white"></i>
                    Create Daily Report
                </a>
                
                <button type="button" class="px-4 py-2 rounded-lg bg-brand-green hover:bg-brand-green-hover active:translate-y-0.5 text-white text-sm font-bold transition cursor-pointer flex items-center gap-1.5">
                    <i class="fa-solid fa-file-excel text-white"></i>
                    Export
                </button>
            </div>
        </div>
    </div>

    <div class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">
        <div class="flex flex-col gap-2 border-b border-slate-200 bg-slate-50 px-5 py-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="text-lg font-black text-brand-navy">Created Daily Reports</h2>
                <p class="text-xs text-slate-500">Review saved reports by date and level.</p>
            </div>
            <span class="text-xs font-semibold text-slate-500">{{ $reports->total() }} report(s)</span>
        </div>

        @if($reports->count())
            <div class="overflow-x-auto">
                <table class="w-full min-w-[760px] text-left text-sm">
                    <thead class="bg-slate-100 text-xs uppercase text-slate-600">
                        <tr>
                            <th class="px-5 py-3">Report date</th>
                            <th class="px-5 py-3">Level</th>
                            <th class="px-5 py-3">Work rows</th>
                            <th class="px-5 py-3">Materials</th>
                            <th class="px-5 py-3">Directions</th>
                                    <th class="px-5 py-3 text-right">Table</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach($reports as $report)
                            @php
                                $detailCount = $report->details->count();
                                $itemCount = $report->details->sum(fn ($detail) => $detail->items->count());
                                $directionCount = $report->details->sum(fn ($detail) => $detail->directions->count());
                            @endphp
                            <tr class="align-top hover:bg-slate-50">
                                <td class="px-5 py-3 font-semibold text-slate-800">{{ $report->report_date->format('M d, Y') }}</td>
                                <td class="px-5 py-3 text-slate-600">{{ $report->level?->name ?? '—' }}</td>
                                <td class="px-5 py-3">{{ $detailCount }}</td>
                                <td class="px-5 py-3">{{ $itemCount }}</td>
                                <td class="px-5 py-3">{{ $directionCount }}</td>
                                <td class="px-5 py-3 text-right">
                                    <details class="text-left">
                                        <summary class="cursor-pointer text-xs font-bold text-brand-navy">View rows</summary>
                                        <div class="mt-3 min-w-[420px] rounded-lg border border-slate-200 bg-slate-50 p-3 text-xs">
                                            @forelse($report->details as $detail)
                                                <div class="border-b border-slate-200 py-2 last:border-0">
                                                    <div class="font-bold text-slate-800">{{ $detail->working_place }}</div>
                                                    <div class="text-slate-500">
                                                        {{ $detail->contractor_name }} · {{ $detail->support ?: 'No support' }}
                                                        · Drill steel: {{ $detail->drill_steel }}
                                                    </div>
                                                    @if($detail->items->count())
                                                        <div class="mt-1 text-slate-600">
                                                            Materials:
                                                            {{ $detail->items->map(fn ($item) => ($item->item?->name ?? 'Item') . ' (' . $item->quantity . ')')->join(', ') }}
                                                        </div>
                                                    @endif
                                                </div>
                                            @empty
                                                <span class="text-slate-500">No work rows were recorded.</span>
                                            @endforelse
                                        </div>
                                    </details>
                                    <a href="{{ request()->fullUrlWithQuery(['report_id' => $report->id]) }}" class="mt-2 inline-block text-xs font-bold text-brand-green hover:underline">Show in table</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="border-t border-slate-200 px-5 py-3">{{ $reports->links() }}</div>
        @else
            <div class="px-5 py-10 text-center text-sm text-slate-500">
                No saved daily reports match the selected month.
            </div>
        @endif
    </div>

    @if($selectedReport)
        <div class="overflow-hidden rounded-xl border border-brand-green/30 bg-white shadow-sm">
            <div class="flex flex-col gap-1 border-b border-brand-green/20 bg-brand-green/5 px-5 py-4 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h2 class="text-lg font-black text-brand-navy">Selected Daily Report</h2>
                    <p class="text-xs text-slate-500">
                        {{ $selectedReport->report_date->format('M d, Y') }}
                        · {{ $selectedReport->level?->name ?? 'Unknown level' }}
                    </p>
                </div>
                <a href="{{ request()->fullUrlWithQuery(['report_id' => null]) }}" class="text-xs font-bold text-slate-500 hover:text-brand-navy">Clear selection</a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full min-w-[900px] text-left text-sm">
                    <thead class="bg-slate-100 text-xs uppercase text-slate-600">
                        <tr>
                            <th class="px-5 py-3">#</th>
                            <th class="px-5 py-3">Contractor</th>
                            <th class="px-5 py-3">Support</th>
                            <th class="px-5 py-3">Drill steel</th>
                            <th class="px-5 py-3">Working place</th>
                            <th class="px-5 py-3">Materials used</th>
                            <th class="px-5 py-3">Directions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($selectedReport->details as $index => $detail)
                            <tr class="align-top hover:bg-slate-50">
                                <td class="px-5 py-3 font-semibold">{{ $index + 1 }}</td>
                                <td class="px-5 py-3">{{ $detail->contractor_name }}</td>
                                <td class="px-5 py-3">{{ $detail->support ?: '—' }}</td>
                                <td class="px-5 py-3">{{ $detail->drill_steel }}</td>
                                <td class="px-5 py-3">{{ $detail->working_place }}</td>
                                <td class="px-5 py-3">
                                    @forelse($detail->items as $item)
                                        <div>{{ $item->item?->name ?? 'Item' }}: <span class="font-semibold">{{ $item->quantity }}</span></div>
                                    @empty
                                        —
                                    @endforelse
                                </td>
                                <td class="px-5 py-3">
                                    @forelse($detail->directions as $direction)
                                        <div>{{ strtoupper($direction->direction) }} {{ strtoupper($direction->type) }}: <span class="font-semibold">{{ $direction->distance }}</span></div>
                                    @empty
                                        —
                                    @endforelse
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="7" class="px-5 py-8 text-center text-slate-500">This report contains no work rows.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    @endif

    <div class="relative bg-white w-full max-w-[98vw] rounded-xl shadow-2xl border border-gray-200 overflow-hidden">
        
        <!-- Content -->
        <div class="flex flex-col h-full bg-white">
            @php($type = request()->input('type') ?? 'total')
            @if($type)
                @include('pages.reports.daily.' . $type)
            @else
                <h1 class="p-4 border-b border-gray-200" >404 NOT FOUND</h1>
            @endif
            
        </div>
    </div>

</div>

@endsection


@push('scripts')
<script type="module">

</script>
@endpush
