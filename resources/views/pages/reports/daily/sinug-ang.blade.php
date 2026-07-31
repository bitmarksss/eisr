<!-- Header Section -->
<div class="p-4 border-b border-gray-200">
    <div class="text-center text-xs space-y-1">
        <h2 class="text-sm md:text-base font-black uppercase tracking-wide text-gray-800">
            SINUG-ANG
        </h2>
        <div class="flex justify-between items-center text-sm text-gray-600 font-semibold px-2 pt-2">
            <!-- <div>
                <span>LOCATION: </span>
                <span class="font-bold text-gray-900 uppercase">{{ request('location', 'SURFACE') }}</span>
            </div> -->
            <div>
                <span>DATE: </span>
                <span class="font-bold text-gray-900">{{ request('date', \Carbon\Carbon::now()->format('M d, Y')) }}</span>
            </div>
        </div>
    </div>
</div>

<!-- Main Table Container -->
<div class="p-4 overflow-x-auto flex-1">
    <table class="w-full border-collapse border border-gray-300 text-[11px] text-center font-medium">
        
        <!-- Table Header -->
        <thead class="bg-gray-100 text-gray-800 uppercase tracking-tight sticky top-0 z-20 shadow-xs">
            <!-- Tier 1: Primary Titles / Item Names -->
            <tr class="font-bold border-b border-gray-300 bg-gray-200">
                <th class="border border-gray-300 px-2 py-1 min-w-[50px]" rowspan="4">SHIFT</th>
                <th class="border border-gray-300 px-2 py-1 min-w-[60px]" rowspan="4">CONT.</th>
                <th class="border border-gray-300 px-2 py-1 min-w-[80px]" rowspan="4">DRILL STEEL</th>
                <th class="border border-gray-300 px-2 py-1 min-w-[140px]" rowspan="4">WORKING PLACE</th>
                
                <!-- Explosives & Accessories Columns -->
                <th class="border border-gray-300 p-1">SUPER POWER</th>
                <th class="border border-gray-300 p-1">PULSAR</th>
                <th class="border border-gray-300 p-1">EM AUSTIN</th>
                <th class="border border-gray-300 p-1">NEOGEL</th>
                <th class="border border-gray-300 p-1">PULSAR</th>
                <th class="border border-gray-300 p-1">PULSAR</th>
                <th class="border border-gray-300 p-1">ANFO</th>
                <th class="border border-gray-300 p-1">SAFETY FUSE</th>
                <th class="border border-gray-300 p-1">OBC</th>
                <th class="border border-gray-300 p-1" colspan="2">NONEL</th>
                <th class="border border-gray-300 p-1" colspan="2">EXEL</th>
                <th class="border border-gray-300 p-1" colspan="2">SUPREME</th>
                <th class="border border-gray-300 p-1" colspan="2">EXEL</th>
                <th class="border border-gray-300 p-1">SHOCK STAR</th>
                <th class="border border-gray-300 p-1">MS 18</th>
                <th class="border border-gray-300 p-1" colspan="4">CORDTEX</th>
                <th class="border border-gray-300 p-1">FUSE LIGHTER</th>
                <th class="border border-gray-300 p-1">EBC</th>
                <th class="border border-gray-300 p-1">BILL WIRE</th>
            </tr>

            <!-- Tier 2: Specifications / Dimensions -->
            <tr class="bg-gray-100 text-[10px]">
                <th class="border border-gray-300 p-1">208</th>
                <th class="border border-gray-300 p-1">38</th>
                <th class="border border-gray-300 p-1">200</th>
                <th class="border border-gray-300 p-1">200</th>
                <th class="border border-gray-300 p-1">135</th>
                <th class="border border-gray-300 p-1">215</th>
                <th class="border border-gray-300 p-1">-</th>
                <th class="border border-gray-300 p-1">-</th>
                <th class="border border-gray-300 p-1">-</th>
                <th class="border border-gray-300 p-1">2.4</th>
                <th class="border border-gray-300 p-1">3.6</th>
                <th class="border border-gray-300 p-1">3.6</th>
                <th class="border border-gray-300 p-1">2.4</th>
                <th class="border border-gray-300 p-1">3.6</th>
                <th class="border border-gray-300 p-1">4.9</th>
                <th class="border border-gray-300 p-1">2.4</th>
                <th class="border border-gray-300 p-1">2.4</th>
                <th class="border border-gray-300 p-1">2.4</th>
                <th class="border border-gray-300 p-1">-</th>
                <th class="border border-gray-300 p-1">5</th>
                <th class="border border-gray-300 p-1">10</th>
                <th class="border border-gray-300 p-1">DCORD I5</th>
                <th class="border border-gray-300 p-1">40</th>
                <th class="border border-gray-300 p-1">-</th>
                <th class="border border-gray-300 p-1">-</th>
                <th class="border border-gray-300 p-1">-</th>
            </tr>

            <!-- Tier 3: Units of Measure (UOM) -->
            <tr class="bg-gray-200 text-[10px] font-bold">
                <th class="border border-gray-300 p-1">PCS</th>
                <th class="border border-gray-300 p-1">PCS</th>
                <th class="border border-gray-300 p-1">PCS</th>
                <th class="border border-gray-300 p-1">PCS</th>
                <th class="border border-gray-300 p-1">PCS</th>
                <th class="border border-gray-300 p-1">PCS</th>
                <th class="border border-gray-300 p-1">KLS</th>
                <th class="border border-gray-300 p-1">MTRS</th>
                <th class="border border-gray-300 p-1">PCS</th>
                <th class="border border-gray-300 p-1">PCS</th>
                <th class="border border-gray-300 p-1">PCS</th>
                <th class="border border-gray-300 p-1">PCS</th>
                <th class="border border-gray-300 p-1">PCS</th>
                <th class="border border-gray-300 p-1">PCS</th>
                <th class="border border-gray-300 p-1">PCS</th>
                <th class="border border-gray-300 p-1">PCS</th>
                <th class="border border-gray-300 p-1">PCS</th>
                <th class="border border-gray-300 p-1">PCS</th>
                <th class="border border-gray-300 p-1">PCS</th>
                <th class="border border-gray-300 p-1">MTR</th>
                <th class="border border-gray-300 p-1">MTR</th>
                <th class="border border-gray-300 p-1">MTR</th>
                <th class="border border-gray-300 p-1">MTR</th>
                <th class="border border-gray-300 p-1">PCS</th>
                <th class="border border-gray-300 p-1">PCS</th>
                <th class="border border-gray-300 p-1">PCS</th>
            </tr>

            <!-- Tier 4: Stock Codes -->
            <tr class="bg-gray-100 text-[10px] text-gray-600 font-mono">
                <th class="border border-gray-300 p-1">17457</th>
                <th class="border border-gray-300 p-1">21811</th>
                <th class="border border-gray-300 p-1">31496</th>
                <th class="border border-gray-300 p-1">35245</th>
                <th class="border border-gray-300 p-1">21810</th>
                <th class="border border-gray-300 p-1">11082</th>
                <th class="border border-gray-300 p-1">10128</th>
                <th class="border border-gray-300 p-1">12487</th>
                <th class="border border-gray-300 p-1">11966</th>
                <th class="border border-gray-300 p-1">10962</th>
                <th class="border border-gray-300 p-1">15427</th>
                <th class="border border-gray-300 p-1">10966</th>
                <th class="border border-gray-300 p-1">16623</th>
                <th class="border border-gray-300 p-1">16967</th>
                <th class="border border-gray-300 p-1">21809</th>
                <th class="border border-gray-300 p-1">10965</th>
                <th class="border border-gray-300 p-1">28230</th>
                <th class="border border-gray-300 p-1">10964</th>
                <th class="border border-gray-300 p-1">10960</th>
                <th class="border border-gray-300 p-1">10961</th>
                <th class="border border-gray-300 p-1">33442</th>
                <th class="border border-gray-300 p-1">10959</th>
                <th class="border border-gray-300 p-1">11342</th>
                <th class="border border-gray-300 p-1">11089</th>
                <th class="border border-gray-300 p-1">16823</th>
            </tr>
        </thead>

        <!-- Table Body -->
        <tbody class="divide-y divide-gray-300 text-gray-900">

            <!-- Shift 1 Rows -->
            @for($s1 = 1; $s1 <= 3; $s1++)
            <tr class="hover:bg-gray-50">
                <td class="border border-gray-300 p-1">1</td>
                <td class="border border-gray-300 p-1"></td>
                <td class="border border-gray-300 p-1"></td>
                <td class="border border-gray-300 p-1 text-left"></td>
                @for($c = 0; $c < 25; $c++)
                    <td class="border border-gray-300 p-1">0</td>
                @endfor
            </tr>
            @endfor
            <tr class="bg-gray-100 font-bold">
                <td class="border border-gray-300 p-1 uppercase" colspan="4">TOTAL SHIFT 1</td>
                @for($c = 0; $c < 25; $c++)
                    <td class="border border-gray-300 p-1">0</td>
                @endfor
            </tr>

            <!-- Shift 2 Rows -->
            @for($s2 = 1; $s2 <= 3; $s2++)
            <tr class="hover:bg-gray-50">
                <td class="border border-gray-300 p-1">2</td>
                <td class="border border-gray-300 p-1"></td>
                <td class="border border-gray-300 p-1"></td>
                <td class="border border-gray-300 p-1 text-left"></td>
                @for($c = 0; $c < 25; $c++)
                    <td class="border border-gray-300 p-1">0</td>
                @endfor
            </tr>
            @endfor
            <tr class="bg-gray-100 font-bold">
                <td class="border border-gray-300 p-1 uppercase" colspan="4">TOTAL SHIFT 2</td>
                @for($c = 0; $c < 25; $c++)
                    <td class="border border-gray-300 p-1">0</td>
                @endfor
            </tr>

            <!-- Shift 3 Rows -->
            @for($s3 = 1; $s3 <= 4; $s3++)
            <tr class="hover:bg-gray-50">
                <td class="border border-gray-300 p-1">3</td>
                <td class="border border-gray-300 p-1"></td>
                <td class="border border-gray-300 p-1"></td>
                <td class="border border-gray-300 p-1 text-left"></td>
                @for($c = 0; $c < 25; $c++)
                    <td class="border border-gray-300 p-1">0</td>
                @endfor
            </tr>
            @endfor
            <tr class="bg-gray-100 font-bold">
                <td class="border border-gray-300 p-1 uppercase" colspan="4">TOTAL SHIFT 3</td>
                @for($c = 0; $c < 25; $c++)
                    <td class="border border-gray-300 p-1">0</td>
                @endfor
            </tr>

            <!-- Grand Total Row -->
            <tr class="bg-amber-100/80 font-bold text-gray-900">
                <td class="border border-gray-400 p-2 uppercase" colspan="4">GRAND TOTAL</td>
                @for($c = 0; $c < 25; $c++)
                    <td class="border border-gray-400 p-1">0</td>
                @endfor
            </tr>

            <!-- Overall Totals & Costs Header Block -->
            <tr class="bg-gray-200 font-bold">
                <td class="border border-gray-400 p-1.5 text-left uppercase" colspan="4">OVER ALL TOTAL</td>
                <td class="border border-gray-400 p-1">0</td>
                <td class="border border-gray-400 p-1">0</td>
                <td class="border border-gray-400 p-1">0</td>
                <td class="border border-gray-400 p-1">1,697</td>
                <td class="border border-gray-400 p-1">0</td>
                <td class="border border-gray-400 p-1">1,404</td>
                <td class="border border-gray-400 p-1">1,179</td>
                <td class="border border-gray-400 p-1">464.13</td>
                <td class="border border-gray-400 p-1">191</td>
                <td class="border border-gray-400 p-1">0</td>
                <td class="border border-gray-400 p-1">0</td>
                <td class="border border-gray-400 p-1">39</td>
                <td class="border border-gray-400 p-1">0</td>
                <td class="border border-gray-400 p-1">0</td>
                <td class="border border-gray-400 p-1">0</td>
                <td class="border border-gray-400 p-1">1,731</td>
                <td class="border border-gray-400 p-1">0</td>
                <td class="border border-gray-400 p-1">0</td>
                <td class="border border-gray-400 p-1">692</td>
                <td class="border border-gray-400 p-1">88</td>
                <td class="border border-gray-400 p-1">0</td>
                <td class="border border-gray-400 p-1">0</td>
                <td class="border border-gray-400 p-1">0</td>
                <td class="border border-gray-400 p-1">2</td>
                <td class="border border-gray-400 p-1">30</td>
            </tr>

            <tr class="bg-white font-semibold">
                <td class="border border-gray-300 p-1 text-left uppercase" colspan="4">UNIT PRICE</td>
                <td class="border border-gray-300 p-1">26.29</td>
                <td class="border border-gray-300 p-1">115.80</td>
                <td class="border border-gray-300 p-1">35.47</td>
                <td class="border border-gray-300 p-1">27.34</td>
                <td class="border border-gray-300 p-1">40.00</td>
                <td class="border border-gray-300 p-1">29.56</td>
                <td class="border border-gray-300 p-1">145.88</td>
                <td class="border border-gray-300 p-1">27.66</td>
                <td class="border border-gray-300 p-1">26.25</td>
                <td class="border border-gray-300 p-1">171.74</td>
                <td class="border border-gray-300 p-1">176.79</td>
                <td class="border border-gray-300 p-1">195.00</td>
                <td class="border border-gray-300 p-1">180.36</td>
                <td class="border border-gray-300 p-1">198.00</td>
                <td class="border border-gray-300 p-1">195.00</td>
                <td class="border border-gray-300 p-1">189.38</td>
                <td class="border border-gray-300 p-1">207.00</td>
                <td class="border border-gray-300 p-1">379.46</td>
                <td class="border border-gray-300 p-1">35.15</td>
                <td class="border border-gray-300 p-1">35.89</td>
                <td class="border border-gray-300 p-1">37.50</td>
                <td class="border border-gray-300 p-1">81.90</td>
                <td class="border border-gray-300 p-1">20.62</td>
                <td class="border border-gray-300 p-1">267.18</td>
                <td class="border border-gray-300 p-1">7.50</td>
            </tr>

            <tr class="bg-emerald-50 font-bold text-emerald-900">
                <td class="border border-gray-400 p-1 text-left uppercase" colspan="4">TOTAL COST</td>
                <td class="border border-gray-400 p-1">0.00</td>
                <td class="border border-gray-400 p-1">0.00</td>
                <td class="border border-gray-400 p-1">0.00</td>
                <td class="border border-gray-400 p-1">46,402.43</td>
                <td class="border border-gray-400 p-1">0.00</td>
                <td class="border border-gray-400 p-1">41,507.72</td>
                <td class="border border-gray-400 p-1">171,992.52</td>
                <td class="border border-gray-400 p-1">12,837.84</td>
                <td class="border border-gray-400 p-1">5,013.75</td>
                <td class="border border-gray-400 p-1">0.00</td>
                <td class="border border-gray-400 p-1">0.00</td>
                <td class="border border-gray-400 p-1">7,605.00</td>
                <td class="border border-gray-400 p-1">0.00</td>
                <td class="border border-gray-400 p-1">0.00</td>
                <td class="border border-gray-400 p-1">0.00</td>
                <td class="border border-gray-400 p-1">327,816.78</td>
                <td class="border border-gray-400 p-1">0.00</td>
                <td class="border border-gray-400 p-1">0.00</td>
                <td class="border border-gray-400 p-1">24,323.80</td>
                <td class="border border-gray-400 p-1">3,158.58</td>
                <td class="border border-gray-400 p-1">0.00</td>
                <td class="border border-gray-400 p-1">0.00</td>
                <td class="border border-gray-400 p-1">0.00</td>
                <td class="border border-gray-400 p-1">534.36</td>
                <td class="border border-gray-400 p-1">225.00</td>
            </tr>

        </tbody>
    </table>
</div>