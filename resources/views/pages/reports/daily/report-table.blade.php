<!-- Header Section -->
<div class="p-4 border-b border-gray-200">
    <div class="text-center py-3 space-y-1">
        <h2 class="font-black text-xl text-center">PMC - MINE EXPLOSIVES REPORT</h2>
        <h2 id="modal-report-date" class="font-bold text-center text-lg">as</h2>
        <h2 id="modal-report-level" class="font-bold text-center text-xl">fdf</h2>
    </div>
</div>

<!-- Main Table Container -->
<div class="p-4 overflow-x-auto flex-1">
    <table class="min-w-[2100px] w-full border-collapse border-x-0 text-sm">
        <thead class="bg-slate-200 uppercase text-slate-600">
            <tr>
                <!-- <th class="sticky left-0 border px-3 py-2">Shift</th> -->
                <th class="border px-3 py-2" rowspan="3">Cont.</th>
                <th class="border px-3 py-2" rowspan="3">Sup.</th>
                <th class="border px-3 py-2" rowspan="3">Drill Steel</th>
                <th class="border px-3 py-2" rowspan="3">Working Place</th>
                @foreach($materials as $items)
                    <th class="border px-3 py-2"
                        >
                        {{ str_replace('_',' ',strtoupper($items->name)) }}
                    </th>
                @endforeach 
                @foreach($directions as $direction)
                    <th class="border px-3 py-2 {{ $loop->first ? 'border-l-4 border-l-brand-navy' : '' }}" rowspan="2" colspan="2">{{ str_replace('_','/',strtoupper($direction)) }}</th>
                @endforeach
            </tr>
            <tr>
                @foreach($materials as $item)
                    <th class="border px-3 py-2 text-xs">{{ str_replace('_',' ',strtoupper($item->variant)) }}</th>
                @endforeach 
            </tr>
            
            <tr>
                @foreach($materials as $item)
                    <th class="border px-3 py-2 text-xs">{{ str_replace('_',' ',strtoupper($item->unit->unit)) }}</th>
                @endforeach 
                
                @foreach($directions as $direction)
                    @foreach($sub_direction as $sub)
                        <th class="border px-3 py-2 text-xs {{ $loop->parent->first && $loop->first ? 'border-l-4 border-l-brand-navy' : '' }}">{{ str_replace('_','/',strtoupper($sub)) }}</th>
                    @endforeach
                @endforeach
            </tr>
        </thead>

        <!-- Table Body -->
        <tbody id="report-table-body"></tbody>
    </table>
</div>

<!-- Summary Block Below Table -->
<div class="p-4 bg-gray-50 border-t border-gray-200 grid grid-cols-1 md:grid-cols-2 gap-6 text-xs">
    <!-- Blast Details -->
    <div class="space-y-2 border border-gray-300 p-3 bg-white rounded-lg">
        <h4 class="font-bold border-b pb-1 text-gray-800">BLASTING SUMMARY</h4>
        <div class="grid grid-cols-2 gap-2">
            <div>
                <span class="font-semibold text-gray-600">PRIMARY BLAST:</span>
                <p class="font-bold">0</p>
            </div>
            <div>
                <span class="font-semibold text-gray-600">NO. OF HOLES:</span>
                <p class="font-bold">0</p>
            </div>
            <div>
                <span class="font-semibold text-gray-600">SECONDARY BLAST:</span>
                <p class="font-bold">0</p>
            </div>
            <div>
                <span class="font-semibold text-gray-600">NO. OF HOLES:</span>
                <p class="font-bold">0</p>
            </div>
            <div class="col-span-2">
                <span class="font-semibold text-gray-600">BOULDERING:</span>
                <p class="font-bold">0</p>
            </div>
        </div>
    </div>

    <!-- Cost Breakdown Summary -->
    <div class="space-y-2 border border-gray-300 p-3 bg-white rounded-lg">
        <h4 class="font-bold border-b pb-1 text-gray-800">COST BREAKDOWN</h4>
        <div class="space-y-1.5">
            <div class="flex justify-between">
                <span>NONEL 2.4/3.6:</span>
                <span class="font-bold">0.00</span>
            </div>
            <div class="flex justify-between">
                <span>EXEL 3.6/2.4/4.9:</span>
                <span class="font-bold">1,770.00</span>
            </div>
            <div class="flex justify-between">
                <span>CORDTEX 5/6/40/10:</span>
                <span class="font-bold">780.00</span>
            </div>
            <div class="flex justify-between pt-2 border-t font-bold text-sm text-brand-dark">
                <span>DAILY COST:</span>
                <span class="text-emerald-700">₱ 641,417.77</span>
            </div>
            <div class="flex justify-between font-bold text-sm text-brand-dark">
                <span>TODATE COST:</span>
                <span class="text-emerald-700">₱ 408,278.51</span>
            </div>
        </div>
    </div>
</div>