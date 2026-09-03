@extends('layouts.app')
@section('page-title', 'Explosive Delivery Report')
@section('sidebar') 
    @include('components.sidebar') 
@endsection

@section('content')

<div class="mb-4">
    <a href="{{ route('reports.daily.index', ['type' => 'total']) }}" onclick="window.history.back()" 
       class="inline-flex items-center text-sm font-bold cursor-pointer space-x-2 hover:underline">
        <i class="fa-solid fa-arrow-left-long"></i>
        &nbsp; BACK
    </a>
</div>


<!-- Flash Messages -->
@if(session('error'))
<div class="bg-red-100 border border-red-700 text-red-700 p-4 mt-4 mb-8 rounded-xl text-sm font-semibold flex items-center shadow-xs">
    <span class="mr-2">✗</span> {{ session('error') }}
</div>
@endif

<div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-xl">

    <div class="flex items-center justify-between bg-slate-50 px-6 py-4">
        <h1 class="text-2xl font-bold text-brand-navy">Daily Report Form</h1>
        <!-- <span class="text-xs font-semibold uppercase text-slate-500">Rows can be added per shift</span> -->
    </div>
    <form method="POST" action="{{ route('reports.daily.store') }}" id="daily-report-form">@csrf
        <div class="space-y-6 p-6">
            <div class="grid gap-4 rounded-xl border border-slate-200 p-5 md:grid-cols-2">
                <div>
                    <label class="mb-1 block text-xs font-bold uppercase text-slate-600">Select Date *</label>
                    <input type="date" name="report_date" required value="{{ old('report_date', date('Y-m-d')) }}" class="w-full rounded-lg border border-slate-300 p-2.5 text-sm">
                </div>
                <div>
                    <label class="mb-1 block text-xs font-bold uppercase text-slate-600">Location *</label>
                    <select name="location_id" required class="w-full rounded-lg border border-slate-300 p-2.5 text-sm">
                        <option value="">Select location</option>
                        @foreach(($locations ?? []) as $location)
                            <option value="{{ $location->id }}">{{ $location->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            @for($shift = 1; $shift <= 3; $shift++)
            <section class="rounded-xl border overflow-hidden">
                <div class="flex items-center justify-between bg-slate-50 px-4 py-3">
                    <h2 class="text-sm font-black uppercase">Shift {{ $shift }}</h2>
                    <div class="flex items-center gap-3">
                        <label class="text-xs font-bold uppercase flex items-center">
                            <input type="checkbox" class="mr-1"
                                name="shifts[{{ $shift }}][no_blast]" value="1"> 
                            No blast
                        </label>
                        <button type="button" data-add-row="{{ $shift }}" class="rounded-lg bg-brand-green px-3 py-2 text-xs font-bold text-white cursor-pointer disabled:cursor-not-allowed disabled:opacity-50">
                            + Add row
                        </button>
                    </div>
                </div>
                <div class="overflow-x-auto"> 
                    <table class="min-w-[2100px] w-full border-collapse border-x-0 text-sm" data-shift-table="{{ $shift }}">
                        <thead class="bg-slate-200 uppercase text-slate-600">
                            <tr>
                                <!-- <th class="sticky left-0 border px-3 py-2">Shift</th> -->
                                <th class="border px-3 py-2" rowspan="3">Cont.</th>
                                <th class="border px-3 py-2" rowspan="3">Sup.</th>
                                <th class="border px-3 py-2" rowspan="3">Drill Steel</th>
                                <th class="border px-3 py-2" rowspan="3">Working Place</th>
                                @foreach($materials as $name => $items)
                                    <th class="border px-3 py-2"
                                        colspan="{{ $items->count() }}">
                                        {{ str_replace('_',' ',strtoupper($name)) }}
                                    </th>
                                @endforeach 
                                @foreach($directions as $direction)
                                    <th class="border px-3 py-2 {{ $loop->first ? 'border-l-4 border-l-brand-navy' : '' }}" rowspan="2" colspan="2">{{ str_replace('_','/',strtoupper($direction)) }}</th>
                                @endforeach
                                <th class="border px-3 py-2 border-l-4 border-l-brand-navy" rowspan="3"></th>
                            </tr>
                            <tr>
                                @foreach($materials as $items)
                                    @foreach($items as $item)
                                        <th class="border px-3 py-2 text-xs">{{ str_replace('_',' ',strtoupper($item->variant)) }}</th>
                                    @endforeach 
                                @endforeach 
                            </tr>
                            <tr>
                                @foreach($materials as $items)
                                    @foreach($items as $item)
                                        <th class="border px-3 py-2 text-xs">{{ str_replace('_',' ',strtoupper($item->unit->unit)) }}</th>
                                    @endforeach 
                                @endforeach 
                                
                                @foreach($directions as $direction)
                                    @foreach($sub_direction as $sub)
                                        <th class="border px-3 py-2 text-xs {{ $loop->parent->first && $loop->first ? 'border-l-4 border-l-brand-navy' : '' }}">{{ str_replace('_','/',strtoupper($sub)) }}</th>
                                    @endforeach
                                @endforeach
                            </tr>
                        </thead>
                        <tbody data-shift-body="{{ $shift }}"></tbody>
                        {{--  
                        <tfoot class="bg-indigo-50 font-bold"><tr><td colspan="5" class="border px-3 py-2">TOTAL</td>@foreach($materials as $material)<td class="border px-3 py-2" data-total="{{ $material }}">0</td>@endforeach @foreach($directions as $direction)<td class="border px-3 py-2" data-total="{{ $direction }}">0</td>@endforeach<td class="border"></td></tr></tfoot>
                        --}}
                    </table>
                </div>
            </section>
            @endfor
        </div>
        <div class="flex justify-end gap-3 border-t px-6 py-4"><button type="reset" class="rounded-lg bg-slate-100 px-4 py-2 text-xs font-bold cursor-pointer uppercase">Clear form</button><button type="submit" class="rounded-lg bg-brand-navy px-6 py-2 text-xs font-bold uppercase text-white cursor-pointer">Save daily report</button></div>
    </form>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const materialGroups = @json($materials),
        materials = Object.values(materialGroups).flat(),
        directions = @json($directions);

    const text = 'w-32 rounded border border-slate-300 p-2 text-xs', 
    number = 'w-20 rounded border border-slate-300 p-2 text-xs';
    function totals(shift) { 
        const table = document.querySelector(`[data-shift-table="${shift}"]`); 
        table.querySelectorAll('[data-total]').forEach(t => { let n = 0; 
        table.querySelectorAll(`[data-total-key="${t.dataset.total}"]`).forEach(i => n += Number(i.value) || 0); 
        t.textContent = n.toFixed(2).replace(/\.00$/, ''); }); 
    }

    function addRow(shift) {
        const body = document.querySelector(`[data-shift-body="${shift}"]`), i = body.children.length, row = document.createElement('tr');
        const materialCells = materials.map(item => `
            <td class="border p-2">
                <input type="number" min="0" step="0.01" data-total-key="${item.id}" name="shifts[${shift}][rows][${i}][materials][${item.id}]" class="${number}">
            </td>`).join('');

        const directionCells = directions.map((k, directionIndex) => `
            <td class="border p-2 ${directionIndex === 0 ? 'border-l-4 border-l-brand-navy' : ''}">
                <input type="number" min="0" data-total-key="${k}" name="shifts[${shift}][rows][${i}][directions][${k}][pb]" class="w-14 rounded border border-slate-300 p-2 text-xs" placeholder="PB">
            </td>
            <td class="border p-2">
                <input type="number" min="0" data-total-key="${k}" name="shifts[${shift}][rows][${i}][directions][${k}][sb]" class="w-14 rounded border border-slate-300 p-2 text-xs" placeholder="SB">
            </td>`).join('');

        row.classList.add('text-center')
        row.setHTML = `
            <td class="border p-2">
                <input required name="shifts[${shift}][rows][${i}][contractor_name]" class="${text}" placeholder="Contractor">
            </td>
            <td class="border p-2">
                <input name="shifts[${shift}][rows][${i}][support]" class="${text}" placeholder="Support">
            </td>
            <td class="border p-2">
                <input type="number" min="0" name="shifts[${shift}][rows][${i}][drill_steel]" class="${number}">
            </td>
            <td class="border p-2">
                <input required name="shifts[${shift}][rows][${i}][working_place]" class="${text}" placeholder="Working place">
            </td>
            ${materialCells}${directionCells}
            <td class="border p-2 border-l-4 border-l-brand-navy">
                <button type="button" class="remove-row rounded bg-rose-100 px-2 py-1 font-bold text-rose-700">Remove</button>
            </td>`;
        body.appendChild(row); 
        row.querySelectorAll('input').forEach(input => input.addEventListener('input', () => totals(shift))); 
        row.querySelector('.remove-row').addEventListener('click', () => { row.remove(); totals(shift); });
    }
    [1, 2, 3].forEach(shift => {
        const table = document.querySelector(`[data-shift-table="${shift}"]`);
        const section = table.closest('section');
        const body = document.querySelector(`[data-shift-body="${shift}"]`);
        const addButton = document.querySelector(`[data-add-row="${shift}"]`);
        const noBlast = section.querySelector('input[type="checkbox"]');

        addRow(shift);

        addButton.addEventListener('click', () => {
            if (!noBlast.checked) addRow(shift);
        });

        noBlast.addEventListener('change', () => {
            addButton.disabled = noBlast.checked;

            if (noBlast.checked) {
                body.replaceChildren();
                totals(shift);
            } else {
                addRow(shift);
            }
        });

        addButton.disabled = noBlast.checked;
    });
});
</script>
@endpush
