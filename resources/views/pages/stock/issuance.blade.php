@extends('layouts.app')

@section('page-title', 'Surface Stock')
@section('sidebar') @include('components.sidebar') @endsection

@section('content')
<div class="space-y-6">
    @if(session('success'))
        <div class="bg-green-100 border border-brand-green/30 text-brand-green p-4 rounded-xl text-sm font-semibold flex items-center shadow-xs"><span class="mr-2">✓</span> {{ session('success') }}</div>
    @endif
    <div class="bg-white w-full rounded-2xl border-0 overflow-hidden">
        <div class="px-6 py-4 bg-white text-brand-navy flex justify-between items-center"><h3 class="px-4 w-full font-bold tracking-wide text-2xl border-0 border-b border-brand-green">Item Issuance Form</h3></div>
        <form action="" method="POST" class="p-6 space-y-4 w-full">
            @csrf
            <div class="overflow-auto flex-1">
                <table class="w-full text-left border border-gray-200 rounded-xl text-xs uppercase font-medium text-gray-600">
                    <thead class="bg-gray-50 text-center select-none sticky top-0 z-10"><tr>
                        <th class="w-[10%] border border-gray-200 p-2 text-brand-navy">Quantity</th><th class="border border-gray-200 p-2 text-brand-navy">Item Name</th><th class="border border-gray-200 p-2 text-brand-navy">Level No.</th><th class="border border-gray-200 p-2 text-brand-navy">Remarks</th>
                        <th class="w-[1%] border border-gray-200 p-2 text-brand-navy"><button type="button" onclick="addRow('issuance');" class="px-5 py-2 rounded-lg bg-brand-green hover:bg-brand-green-hover text-white text-sm font-bold shadow-xs transition cursor-pointer text-nowrap"><i class="fa-solid fa-circle-plus"></i> Add Row</button></th>
                    </tr></thead>
                    <tbody id="issuanceFormInputs" class="bg-white divide-y divide-gray-200">
                    @foreach([0,1,2] as $index)
                        <tr class="text-center max-h-9" data-index="{{ $index }}">
                            <td class="w-[10%] border border-gray-200 p-1"><input type="number" name="items[{{ $index }}][quantity]" value="{{ old("items.$index.quantity") }}" placeholder="0" min="1" required class="w-full bg-gray-50 border-gray-300 border rounded-lg px-3 py-2 text-sm focus:border-brand-gold focus:outline-none transition"></td>
                            <td class="border border-gray-200 p-1"><select name="items[{{ $index }}][item_name]" required class="w-full bg-gray-50 border-gray-300 border rounded-lg p-2 text-sm focus:border-brand-gold focus:outline-none transition"><option value="" disabled {{ old("items.$index.item_name") ? '' : 'selected' }}>Select Item</option>@foreach($stocks as $stock)<option value="{{ $stock->item_id }}" {{ old("items.$index.item_name") == $stock->item_id ? 'selected' : '' }}>{{ $stock->item->name }} / {{ $stock->item->variant }}</option>@endforeach</select></td>
                            <td class="border border-gray-200 p-1"><select name="items[{{ $index }}][level_id]" required class="w-full bg-gray-50 border-gray-300 border rounded-lg p-2 text-sm focus:border-brand-gold focus:outline-none transition"><option value="" disabled {{ old("items.$index.level_id") ? '' : 'selected' }}>Select Level</option>@foreach($levels as $level)<option value="{{ $level->id }}" {{ old("items.$index.level_id") == $level->id ? 'selected' : '' }}>{{ $level->name }}</option>@endforeach</select></td>
                            <td class="border border-gray-200 p-1"><input type="text" name="items[{{ $index }}][remarks]" value="{{ old("items.$index.remarks") }}" placeholder="Any additional details..." class="w-full bg-gray-50 border border-gray-300 rounded-lg px-3 py-2 text-sm focus:border-brand-gold focus:outline-none transition"></td>
                            @if($index !== 0)<td class="w-[1%] border border-gray-200 p-1"><button type="button" onclick="removeRow('issuance', {{ $index }});" class="w-full bg-red-500 hover:bg-red-600 active:translate-y-0.5 rounded-lg p-2 cursor-pointer transition"><i class="fa-solid fa-circle-minus fa-lg text-white"></i></button></td>@else<td></td>@endif
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="pt-4 flex justify-end space-x-3 border-t border-gray-100"><button type="button" onclick="window.history.back()" class="px-4 py-2 text-sm font-semibold text-gray-500 hover:text-gray-700 transition cursor-pointer">Cancel</button><button type="submit" class="px-5 py-2 rounded-lg bg-brand-gold hover:bg-brand-gold-hover text-white text-sm font-bold shadow-xs transition cursor-pointer">Confirm</button></div>
        </form>
    </div>
</div>
@push('scripts')<script type="module">window.modalData = { inventoryItems: @json($stocks), levels: @json($levels) };</script>@endpush
@endsection
