<!-- Header Section (Placed Before Foreach) -->
<div class="bg-white p-6 text-center space-y-2">
    <h2 class="text-base md:text-lg font-black uppercase tracking-wide text-gray-800">
        {{$type == 'daily' ? 'DETAIL' : ''}} EXPLOSIVE WEEKLY CONSUMPTION
    </h2>
    <p class="text-sm font-bold text-gray-700">
        Period Covered : {{ request('start_date') ? \Carbon\Carbon::parse(request('start_date'))->format('F j, Y') : 'JUNE 1-7, 2026' }}
        @if(request('end_date')) - {{ \Carbon\Carbon::parse(request('end_date'))->format('F j, Y') }} @endif
    </p>
</div>
