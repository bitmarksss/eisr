<!-- Header Section (Placed Before Foreach) -->
<div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm text-center space-y-2">
    <h2 class="text-base md:text-lg font-black uppercase tracking-wide text-gray-800">
        DAILY BLASTER REPORT
    </h2>
    <p class="text-sm font-bold text-gray-700">
        Period Covered : {{ request('start_date') ? \Carbon\Carbon::parse(request('start_date'))->format('F j, Y') : 'JUNE 1-7, 2026' }}
        @if(request('end_date')) - {{ \Carbon\Carbon::parse(request('end_date'))->format('F j, Y') }} @endif
    </p>
    <div class="grid grid-cols-3 gap-6">
        <div class="col-span-2 pt-2 text-left text-xs font-bold text-gray-700 space-y-1 border-t border-gray-100">
            <div><span class="inline-block w-36">Location :</span> MINE SITE, CO-O, CONSUELO, BUNAWAN , AGUSAN DEL SUR</div>
            <div><span class="inline-block w-36">Time of Blasting :</span> 6:45 AM / 2:45 PM / 10:45 PM</div>
        </div>
        
        <div class="col-span-1 pt-2 text-left text-xs font-bold text-gray-700 space-y-1 border-t border-gray-100">
            <div><span class="inline-block w-36">Date :</span> 07/06/2026</div>
            <div><span class="inline-block w-36">Shift :</span> 1ST SHIFT/2ND SHIFT/3RD SHIFT</div>
        </div>
    </div>
</div>