<div class="flex justify-center">
    <img src="{{ asset('assets/images/pmc-header.png') }}"/>
</div> 

<div class="grid grid-cols-1 md:grid-cols-3 gap-4 p-4 bg-gray-50 ">
    <div class="col-span-4 text-center">
        <h2 class="text-xs md:text-base font-black uppercase tracking-wide text-gray-800">
            @if($type == 'daily')
                EXPLOSIVE DAILY CONSUMPTION
            @elseif($type == 'costing')
                MONTHLY CONSUMPTION AND MONTHLY COSTING
            @elseif($type == 'monthly')
                EXPLOSIVE MONTHLY REPORT
            @elseif($type == 'comparative')
                MONTHLY COMPARATIVE REPORT
            @elseif($type == 'deliveries')
                SUMMARY OF EXPLOSIVE PURCHASED
            @elseif($type == 'usage')
                RE: MOUNT ROCK POWDER EXPLOSIVES STOCK INVENTORY AS OF TODAY
                </h2>
                <h2 class="text-xs md:text-base font-black uppercase tracking-wide text-gray-800">
                NAMELY: DYNA,OBC,SAFETY FUSE, NON-ELEC LP 2.4, ANFO & DETCORD
            @endif
        </h2>

        <h3 class="text-xs md:text-base uppercase tracking-wide text-gray-800">
            MONTH OF MAY 2026
        </h3>
    </div>
</div>