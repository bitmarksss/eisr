<div class="flex justify-center">
    <img src="{{ asset('assets/images/pmc-header.png') }}"/>
</div> 

<div class="grid grid-cols-1 md:grid-cols-3 gap-4 p-4">
    <div class="col-span-4 text-center">
        @if($type == 'daily')
            <h2 class="text-xs md:text-base font-black uppercase tracking-wide text-gray-800">
                Explosive Daily Consumption - Exploration Project <span class="font-normal">(MPSA No. 262-2008-XIII PARCEL-2)</span>
            </h2>
            <h3 class="text-xs md:text-base uppercase tracking-wide text-gray-800">
                MONTH OF MAY 2026
            </h3>
        @elseif($type == 'br')
            <h2 class="text-xs md:text-base font-black uppercase tracking-wide text-gray-800">
                Blasting Report for the Month of May 2026
            </h2>
            <h3 class="text-xs md:text-base uppercase tracking-wide text-gray-800">
                MONTHLY SUMMARY DETAILS
            </h3>
        @elseif($type == 'fy')
        <div class="col-span-4 text-center text-xs">
            <h2 class="text-xs md:text-base font-black uppercase tracking-wide text-gray-800">
                MONTHLY REPORT
            </h2>
            <h3 class="uppercase tracking-wide text-gray-800">
                RECORD SHOWING EXPLOSIVES ON HAND, AMOUNT IMPORTED, PURCHASED FOUND, TAKEN UP, OR RECEIVED FROM AN
            </h3>
            <h3 class="uppercase tracking-wide text-gray-800">
                OTHER SOURCE AND RECORD OF EXPLOSIVE ISSUED, TRANSFERRED AND/OR OTHERWISE GIVEN DISPOSITION
            </h3>
        </div>

        <div class="col-span-4 text-left  text-xs">
            <h2 class="font-black uppercase tracking-wide text-gray-800">
                The Chieft
            </h2>
            <h3 class="uppercase tracking-wide text-gray-800">
                Philippine National Police
            </h3>
            <h3 class="uppercase tracking-wide text-gray-800">
                Thru The Provincial Director of  PATIN-AY, PROSPERIDAD, AGUSAN DEL SUR
            </h3>
            <h3 class="uppercase tracking-wide text-gray-800">
                SIR : I have the honor to submit the following report of explosives transactions and usage of the PMC Tigerway Decline Project  for the month of MAY 2026
            </h3>
        </div>
        @elseif($type == 'explosive')
            <h2 class="text-xs md:text-base font-black uppercase tracking-wide text-gray-800">
                EXPLOSIVES AND ACCESSORIES CONSUMPTION
            </h2>
            <h3 class="uppercase tracking-wide text-gray-800">
                REPORT FOR THE MONTH OF MAY 2026
            </h3>
        @endif
    </div>
</div>