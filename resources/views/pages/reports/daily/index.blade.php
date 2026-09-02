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
                    <label class="block text-xs font-semibold">Date:</label>
                    <input type="date" name="date" value="{{ request('date') }}"
                        onchange="this.form.submit()"
                        class="bg-gray-50 border border-gray-300 text-brand-dark text-sm rounded-lg p-2 focus:outline-none focus:border-brand-gold">
                </div>

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
                
                <!-- Level Filter -->
                {{--
                <div class="space-y-1">
                    <label class="block text-xs font-semibold">Level:</label>
                    <select name="level_id" onchange="this.form.submit()" 
                        class="bg-gray-50 border border-gray-300 text-brand-dark text-sm rounded-lg p-2 focus:outline-none focus:border-brand-gold">
                        <option value="">All levels</option>
                        @foreach($levels as $level)
                            <option value="{{ $level->id }}" {{ request('level_id') == $level->id ? 'selected' : '' }}>
                                {{ $level->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                --}}

                <div class="space-y-1">
                    <label class="block text-xs font-semibold">Report view:</label>
                    <select name="type" onchange="this.form.submit()"
                        class="bg-gray-50 border border-gray-300 text-brand-dark text-sm rounded-lg p-2 focus:outline-none focus:border-brand-gold">
                        @foreach($types as $type)
                            <option value="{{ $type }}" {{ request('type', 'total') == $type ? 'selected' : '' }}>
                                {{ strtoupper($type) }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </form>
            
            <div class="flex items-end space-x-2">
                <a href="{{ route('reports.daily.create') }}" class="px-4 py-2 rounded-lg bg-brand-navy hover:bg-brand-navy-hover active:translate-y-0.5 text-white text-sm font-bold transition cursor-pointer flex items-center gap-1.5">
                    <i class="fa-solid fa-file-excel text-white"></i>
                    Create Daily Report
                </a>
            </div>
        </div>
    </div>

    <div class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">
        <div class="flex flex-col gap-2 border-b border-slate-200 bg-slate-50 px-5 py-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="text-lg font-black text-brand-navy">Created Daily Reports</h2>
                <p class="text-xs text-slate-500">Review saved reports by date.</p>
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
                            <th class="px-5 py-3">Prepared By</th>
                            <th class="px-5 py-3 text-right">Actions</th>
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
                                <td class="px-5 py-3">{{ $detailCount }}</td>
                                <td class="px-5 py-3">{{ $report->level->name }}</td>
                                <td class="px-5 py-3">{{ $itemCount }}</td>
                                <td class="px-5 py-3">{{ $directionCount }}</td>
                                <td class="px-5 py-3">{{ $report->owner->username }}</td>
                                <td class="px-5 py-3 text-right">
                                    <button type="button" data-show-report
                                        data-report-url="{{ route('reports.daily.load', ['header_id' => $report->id]) }}"
                                        class="mt-2 inline-block text-xs font-bold text-brand-green cursor-pointer hover:underline">
                                        Show report
                                    </button>
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

    <!-- Daily report view modal -->
    <div id="daily-report-modal" class="fixed inset-0 z-50 hidden bg-slate-900/60 p-4" role="dialog" aria-modal="true" aria-labelledby="daily-report-modal-title">
        <div class="mx-auto flex h-full max-w-[98vw] flex-col overflow-hidden rounded-xl border border-gray-200 bg-white shadow-2xl">
            <div class="flex items-center justify-end border-b border-slate-200 bg-slate-50 px-5 py-3">
                <!-- <h2 id="daily-report-modal-title" class="font-black text-brand-navy">Daily report</h2> -->
                <button type="button" data-close-report-modal class="rounded-lg px-1.5 py-1 text-xl font-bold text-slate-500 cursor-pointer hover:bg-slate-200" aria-label="Close report">
                    <i class="fa-solid fa-xmark text-brand-navy"></i>
                </button>
            </div>
            <div class="min-h-0 flex-1 overflow-auto">
                <div class="flex flex-col h-full bg-white">
                    @php($type = request()->input('type') ?? 'total')
                    @if($type && in_array($type, $types, true))
                        @include('pages.reports.daily.report-table')
                    @else
                        <h1 class="p-4 border-b border-gray-200">404 NOT FOUND</h1>
                    @endif
                </div>
            </div>
                
            <div class="shrink flex justify-end p-4">
                <button type="button" class="px-4 py-2 rounded-lg bg-brand-green hover:bg-brand-green-hover active:translate-y-0.5 text-white text-sm font-bold transition cursor-pointer flex items-center gap-1.5">
                    <i class="fa-solid fa-file-excel text-white"></i>
                    Export
                </button>
            </div>
        </div>
    </div>


</div>

@endsection


@push('scripts')
<script type="module">
document.addEventListener('DOMContentLoaded', () => {
    const modal = document.getElementById('daily-report-modal');
    const closeModal = () => {
        modal.classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    };

    document.querySelectorAll('[data-show-report]').forEach(button => {
        button.addEventListener('click', async () => {
            modal.classList.remove('hidden');
            document.body.classList.add('overflow-hidden');

            try {
                const response = await fetch(button.dataset.reportUrl, {
                    headers: {
                        'Accept': 'application/json',
                    },
                });

                if (!response.ok) {
                    throw new Error(`Failed to load report (${response.status})`);
                }

                // The response is intentionally not rendered yet.
                let result = await response.json();
                let data = result.data;

                console.log('REPORT DATA');
                console.log(data);

                // =============
                // REPORT DATE
                // =============
                let rawDate = new Date(data.report_date);
                let reportDate = rawDate.toLocaleDateString("en-US", {
                    month: "long",
                    day: "2-digit",
                    year: "numeric",
                });
                modal.querySelector('#modal-report-date').textContent = reportDate;
                
                // ==============
                // Report Level
                // ==============
                let levelName = data.level.name;
                modal.querySelector('#modal-report-level').textContent = levelName;

                
            } catch (error) {
                console.error('Failed to load daily report:', error);
            }
        });
    });

    document.querySelector('[data-close-report-modal]').addEventListener('click', closeModal);
    modal.addEventListener('click', event => {
        if (event.target === modal) closeModal();
    });
    document.addEventListener('keydown', event => {
        if (event.key === 'Escape' && !modal.classList.contains('hidden')) closeModal();
    });
});
</script>
@endpush
