<div class="flex justify-center">
    <img src="{{ asset('assets/images/pmc-header.png') }}"/>
</div> 

<!-- Report Header Info Grid -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-4 p-4">
        
    <div class="col-span-4 text-center">
        <h2 class="text-xs md:text-sm font-black uppercase tracking-wide text-gray-800">
            MT. ROCK POWDER CORPORATION
        </h2>
        <h3 class="text-xs md:text-sm uppercase tracking-wide text-gray-800">
            PHILSAGA MINING CORPORATION (OPERATION)
        </h3>
        <h3 class="text-xs md:text-sm uppercase tracking-wide text-gray-800">
            Bayugan 3, Rosario Agusan del Sur
        </h3>

        <h2 class="mt-6 text-xs md:text-sm font-black uppercase tracking-wide text-gray-800">
            DAILY BLASTER REPORT
        </h2>
    </div>

    <div class="space-y-1.5 col-span-1 md:col-span-2">
        <div class="flex">
            <span class="font-bold w-32 shrink-0">Location:</span>
            @if($location == 'pmc')
                <span class="font-semibold underline text-red-600">MINE SITE, CO-O, CONSUELO, BUNAWAN , AGUSAN DEL SUR</span>
            @elseif($location == 'tigerway')
                <span class="font-semibold underline text-red-600">TIGERWAY DECLINE PROJECT-MINE SITE, CO-O, CONSUELO, BUNAWAN , AGUSAN DEL SUR</span>
            @endif
        </div>
        <div class="flex">
            <span class="font-bold w-32 shrink-0">Time of Blasting:</span>
            <span class="font-semibold underline text-red-600">6:45 AM / 2:45 PM / 10:45 PM</span>
        </div>
    </div>
    <div class="space-y-1.5 col-span-1">
        <div class="flex">
            <span class="font-bold w-10">Date:</span>
            <span class="font-semibold underline">07-Jun-26</span>
        </div>
        <div class="flex">
            <span class="font-bold w-10">Shift:</span>
            <span class="font-semibold underline">1ST SHIFT/2ND SHIFT/3RD SHIFT</span>
        </div>
    </div>
</div>