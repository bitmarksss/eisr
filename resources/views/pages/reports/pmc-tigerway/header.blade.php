<div class="bg-white p-6 text-base text-center space-y-2">
    <div class="flex justify-center">
        <img src="{{ asset('assets/images/pmc-header.png') }}"/>
    </div>  

@if($type == 'consumption')
    <h2 class="text-base md:text-lg font-black uppercase tracking-wide text-gray-800">
        WEEKLY REPORT ON UPDATES ON EXPLOSIVES AND EXPLOSIVE INGREDIENTS TRANSACTIONS
    </h2>
    <p class="font-bold text-gray-700">
        Period Covered : {{ request('start_date') ? \Carbon\Carbon::parse(request('start_date'))->format('F j, Y') : 'JUNE 1-7, 2026' }}
        @if(request('end_date')) - {{ \Carbon\Carbon::parse(request('end_date'))->format('F j, Y') }} @endif
    </p>
    <div class="pt-2 text-left text-sm font-bold text-gray-700 space-y-1 border-t border-gray-100">
        <div><span class="inline-block w-50">Name of Company :</span> PHILSAGA MINING CORPORATION</div>
        <div><span class="inline-block w-50">Magazine :</span> {{strtoupper($location) ?? 'N/A'}} MAGAZINE</div>
    </div>

@elseif($type == 'rcsu')
    <h2 class="text-base md:text-lg font-black uppercase tracking-wide text-gray-800">
        EXPLOSIVES WEEKLY CONSUMPTION
    </h2>
    <p class="text-sm font-bold text-gray-700">
        Period Covered : {{ request('start_date') ? \Carbon\Carbon::parse(request('start_date'))->format('F j, Y') : 'JUNE 1-7, 2026' }}
        @if(request('end_date')) - {{ \Carbon\Carbon::parse(request('end_date'))->format('F j, Y') }} @endif
    </p>

@endif
</div>