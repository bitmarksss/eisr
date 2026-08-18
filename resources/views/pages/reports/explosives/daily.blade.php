@extends('layouts.app')

@section('page-title', 'Daily Explosives Consumption Log')

@section('sidebar')
    @include('components.sidebar')
@endsection

@section('content')
<div class="space-y-6">

    <!-- Flash Messages -->
    @if(session('success'))
    <div class="bg-green-100 border border-brand-green/30 text-brand-green p-4 rounded-xl text-sm font-semibold flex items-center shadow-xs">
        <span class="mr-2">✓</span> {{ session('success') }}
    </div>
    @endif
    
    <!-- Control Matrix Panel -->
    <div class="bg-white p-4 mb-10 rounded-xl border border-gray-200 shadow-sm flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div class="flex flex-wrap items-center justify-between w-full">
            
            <!-- Search and Filters -->
            <form method="GET" action="{{ route('reports.explosives.index', ['type' => $type]) }}" class="flex flex-wrap items-center gap-3 flex-1 w-full">

                <!-- Month Filter -->
                <div class="space-y-1">
                    <label class="block text-xs font-semibold">Month:</label>
                    <select name="month" onchange="this.form.submit()" 
                        class="bg-gray-50 border border-gray-300 text-brand-dark text-sm rounded-lg p-2 focus:outline-none focus:border-brand-gold">
                        <option value=""> Select a month </option>
                        @foreach($months as $key => $month)
                            <option value="{{ $key }}" {{ request('month') == $key ? 'selected' : '' }}> {{ $month }} </option>
                        @endforeach
                    </select>
                </div>
            </form>
            
            <button type="button" class="px-4 py-2 rounded-lg bg-brand-green hover:bg-brand-green-hover active:translate-y-0.5 text-white text-sm font-bold transition cursor-pointer flex items-center gap-1.5">
                <i class="fa-solid fa-file-excel text-white"></i>
                Create Report
            </button>
            
            <button type="button" class="px-4 py-2 rounded-lg bg-brand-green hover:bg-brand-green-hover active:translate-y-0.5 text-white text-sm font-bold transition cursor-pointer flex items-center gap-1.5">
                <i class="fa-solid fa-file-excel text-white"></i>
                Export
            </button>
        </div>
    </div>

    <!-- Main Report Card -->
    <div class="relative bg-white w-full rounded-xl shadow-2xl border border-gray-200 overflow-hidden flex flex-col">
        
        <!-- Header Strip -->
        <!-- <div class="grid grid-cols-1 md:grid-cols-3 gap-4 p-4">
            <div class="col-span-4 text-center">
                <h2 class="text-xs md:text-base font-black uppercase tracking-wide text-gray-800">
                    Explosive Daily Consumption
                </h2>
                <h3 class="text-xs md:text-base uppercase tracking-wide text-gray-800">
                    MONTH OF MAY 2026
                </h3>
            </div>
        </div> -->
        @include('pages.reports.explosives.header')

        <!-- Scrollable Matrix Viewport -->
        <div class="p-4 overflow-auto flex-1">
            <table class="w-full border-collapse border border-gray-400 text-xs text-center font-medium">
                
                <!-- Multi-Tiered Header -->
                <thead class="bg-gray-100 text-gray-900 uppercase tracking-tight sticky top-0 z-20 shadow-xs">
                    
                    <!-- Tier 1: Suppliers -->
                    <tr class="bg-gray-200 font-bold text-gray-900">
                        <th class="border border-gray-400 p-2 min-w-[90px] bg-gray-300">SUPPLIER</th>
                        <th class="border border-gray-400 p-1" colspan="4">EXPEDITION</th>
                        <th class="border border-gray-400 p-1">MT ROCK / EXPEDITION</th>
                        <th class="border border-gray-400 p-1" colspan="2">MT. ROCK</th>
                        <th class="border border-gray-400 p-1" colspan="4">EXPEDITION</th>
                        <th class="border border-gray-400 p-1">MT ROCK / EXPEDITION</th>
                        <th class="border border-gray-400 p-1">EXPEDITION</th>
                        <th class="border border-gray-400 p-1" colspan="3">MT. ROCK</th>
                        <th class="border border-gray-400 p-1">MT ROCK / EXPEDITION</th>
                        <th class="border border-gray-400 p-1">MT ROCK</th>
                        <th class="border border-gray-400 p-1">EXPEDITION</th>
                    </tr>

                    <!-- Tier 2: Category Groups -->
                    <tr class="bg-gray-100 font-bold">
                        <th class="border border-gray-400 p-2 min-w-[90px] bg-gray-300" rowspan="5">Date</th>
                        <th class="border border-gray-400 p-1" colspan="4"></th>
                        <!-- <th class="border border-gray-400 p-1" colspan="4">NEOGEL / SENATEL</th> -->
                        <th class="border border-gray-400 p-1" rowspan="3">Anfo</th>
                        <th class="border border-gray-400 p-1" colspan="7">DETONATORS</th>
                        <th class="border border-gray-400 p-1" colspan="4">DETONATING CORD</th>
                        @for($i = 0; $i < 3; $i++)
                        <th class="border border-gray-400 p-1"></th>
                        @endfor
                    </tr>

                    <!-- Tier 3: Sub-brand / Model -->
                    <tr class="bg-gray-50 font-bold">
                        <th class="border border-gray-400 p-1" colspan="2">200</th>
                        <th class="border border-gray-400 p-1" colspan="2">215</th>
                        <th class="border border-gray-400 p-1" colspan="2">SUPREME</th>
                        <th class="border border-gray-400 p-1" colspan="3">EXEL</th>
                        <th class="border border-gray-400 p-1">OBC</th>
                        <th class="border border-gray-400 p-1">EBC</th>
                        <th class="border border-gray-400 p-1">Cordtex</th>
                        <th class="border border-gray-400 p-1">Cordtex</th>
                        <th class="border border-gray-400 p-1">DCORD</th>
                        <th class="border border-gray-400 p-1">Cordtex</th>
                        <th class="border border-gray-400 p-1">S/Fuse</th>
                        <th class="border border-gray-400 p-1">Billwire</th>
                        <th class="border border-gray-400 p-1">FUSE</th>
                    </tr>

                    <!-- Tier 3.5  -->
                    <tr class="bg-gray-200 text-gray-900 font-bold text-[10px]">
                        <th class="border border-gray-400 p-1" colspan="2">NEOGEL</th>
                        <th class="border border-gray-400 p-1" colspan="2">Senatel/Pulsar</th>
                        <th class="border border-gray-400 p-1">2.4</th>
                        <th class="border border-gray-400 p-1">3.6</th>
                        <th class="border border-gray-400 p-1">3.6</th>
                        <th class="border border-gray-400 p-1">2.4</th>
                        <th class="border border-gray-400 p-1">4.9</th>
                        <th class="border border-gray-400 p-1"></th>
                        <th class="border border-gray-400 p-1"></th>
                        <th class="border border-gray-400 p-1">5</th>
                        <th class="border border-gray-400 p-1">10 </th>
                        <th class="border border-gray-400 p-1">15</th>
                        <th class="border border-gray-400 p-1">40</th>
                        <th class="border border-gray-400 p-1"></th>
                        <th class="border border-gray-400 p-1"></th>
                        <th class="border border-gray-400 p-1">LIGHTER</th>
                    </tr>

                    <!-- Tier 4: Item Specs / Code Numbers -->
                    <tr class="bg-gray-50 text-[11px] font-semibold">
                        <th class="border border-gray-400 p-1" colspan="2">35245</th>
                        <th class="border border-gray-400 p-1" colspan="2">11082</th>
                        <th class="border border-gray-400 p-1">10128</th>
                        <th class="border border-gray-400 p-1">16623</th>
                        <th class="border border-gray-400 p-1">16967</th>
                        <th class="border border-gray-400 p-1">10966</th>
                        <th class="border border-gray-400 p-1">10965</th>
                        <th class="border border-gray-400 p-1">21809</th>
                        <th class="border border-gray-400 p-1">11966</th>
                        <th class="border border-gray-400 p-1">11089</th>
                        <th class="border border-gray-400 p-1">10960</th>
                        <th class="border border-gray-400 p-1">10961</th>
                        <th class="border border-gray-400 p-1">33442</th>
                        <th class="border border-gray-400 p-1">10959</th>
                        <th class="border border-gray-400 p-1">12487</th>
                        <th class="border border-gray-400 p-1">16823</th>
                        <th class="border border-gray-400 p-1">11342</th>
                    </tr>

                    <!-- Tier 5: Specs details / Units -->
                    <tr class="bg-gray-200 text-gray-900 font-bold text-[10px]">
                        <th class="border border-gray-400 p-1">Pcs</th>
                        <th class="border border-gray-400 p-1">Kls</th>
                        <th class="border border-gray-400 p-1">Pcs</th>
                        <th class="border border-gray-400 p-1">Kls</th>
                        <th class="border border-gray-400 p-1">Kls</th>
                        <th class="border border-gray-400 p-1">2.4</th>
                        <th class="border border-gray-400 p-1">3.6</th>
                        <th class="border border-gray-400 p-1">3.6</th>
                        <th class="border border-gray-400 p-1">2.4</th>
                        <th class="border border-gray-400 p-1">4.9</th>
                        <th class="border border-gray-400 p-1">Pcs</th>
                        <th class="border border-gray-400 p-1">Pcs</th>
                        <th class="border border-gray-400 p-1">5 Mtrs</th>
                        <th class="border border-gray-400 p-1">10 Mtrs</th>
                        <th class="border border-gray-400 p-1">15 Mtrs</th>
                        <th class="border border-gray-400 p-1">40 Mtrs</th>
                        <th class="border border-gray-400 p-1">Mtrs</th>
                        <th class="border border-gray-400 p-1">Mtrs</th>
                        <th class="border border-gray-400 p-1">Pcs</th>
                    </tr>
                </thead>

                <!-- Table Body -->
                <tbody class="divide-y divide-gray-300 text-gray-900 bg-white">
                    
                    <!-- Daily Logs Rows -->
                    <tr>
                        <td class="border border-gray-400 p-1.5 font-bold bg-gray-50 sticky left-0 z-10">01-May-26</td>
                        <td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1 font-semibold">0.0</td>
                        <td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1 font-semibold">0.0</td>
                        <td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1 font-semibold">0.00</td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1"></td>
                    </tr>
                    <tr>
                        <td class="border border-gray-400 p-1.5 font-bold bg-gray-50 sticky left-0 z-10">02-May-26</td>
                        <td class="border border-gray-400 p-1">1,307</td><td class="border border-gray-400 p-1">157.1</td>
                        <td class="border border-gray-400 p-1">822</td><td class="border border-gray-400 p-1">95.6</td>
                        <td class="border border-gray-400 p-1">667.00</td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1">13</td><td class="border border-gray-400 p-1">1,057</td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1">99</td><td class="border border-gray-400 p-1">4</td><td class="border border-gray-400 p-1">187</td><td class="border border-gray-400 p-1">290</td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1">240.57</td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1"></td>
                    </tr>
                    <tr>
                        <td class="border border-gray-400 p-1.5 font-bold bg-gray-50 sticky left-0 z-10">03-May-26</td>
                        <td class="border border-gray-400 p-1">1,453</td><td class="border border-gray-400 p-1">174.6</td>
                        <td class="border border-gray-400 p-1">1,065</td><td class="border border-gray-400 p-1">123.8</td>
                        <td class="border border-gray-400 p-1">757.00</td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1">19</td><td class="border border-gray-400 p-1">1,226</td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1">133</td><td class="border border-gray-400 p-1">8</td><td class="border border-gray-400 p-1">313</td><td class="border border-gray-400 p-1">239</td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1">323.19</td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1"></td>
                    </tr>
                    <tr>
                        <td class="border border-gray-400 p-1.5 font-bold bg-gray-50 sticky left-0 z-10">04-May-26</td>
                        <td class="border border-gray-400 p-1">1,895</td><td class="border border-gray-400 p-1">236.9</td>
                        <td class="border border-gray-400 p-1">1,552</td><td class="border border-gray-400 p-1">180.5</td>
                        <td class="border border-gray-400 p-1">1,183.00</td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1">28</td><td class="border border-gray-400 p-1">1,840</td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1">184</td><td class="border border-gray-400 p-1">4</td><td class="border border-gray-400 p-1">418</td><td class="border border-gray-400 p-1">412</td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1">447.12</td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1"></td>
                    </tr>
                    <tr>
                        <td class="border border-gray-400 p-1.5 font-bold bg-gray-50 sticky left-0 z-10">05-May-26</td>
                        <td class="border border-gray-400 p-1">1,665</td><td class="border border-gray-400 p-1">208.1</td>
                        <td class="border border-gray-400 p-1">1,323</td><td class="border border-gray-400 p-1">153.8</td>
                        <td class="border border-gray-400 p-1">1,201.20</td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1">48</td><td class="border border-gray-400 p-1">1,733</td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1">179</td><td class="border border-gray-400 p-1">8</td><td class="border border-gray-400 p-1">396</td><td class="border border-gray-400 p-1">358</td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1">434.97</td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1"></td>
                    </tr>
                    <tr>
                        <td class="border border-gray-400 p-1.5 font-bold bg-gray-50 sticky left-0 z-10">06-May-26</td>
                        <td class="border border-gray-400 p-1">2,165</td><td class="border border-gray-400 p-1">270.6</td>
                        <td class="border border-gray-400 p-1">1,186</td><td class="border border-gray-400 p-1">137.9</td>
                        <td class="border border-gray-400 p-1">1,224.00</td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1">65</td><td class="border border-gray-400 p-1">1,820</td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1">175</td><td class="border border-gray-400 p-1">6</td><td class="border border-gray-400 p-1">318</td><td class="border border-gray-400 p-1">454</td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1">425.25</td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1"></td>
                    </tr>
                    <tr>
                        <td class="border border-gray-400 p-1.5 font-bold bg-gray-50 sticky left-0 z-10">07-May-26</td>
                        <td class="border border-gray-400 p-1">1,665</td><td class="border border-gray-400 p-1">208.1</td>
                        <td class="border border-gray-400 p-1">1,103</td><td class="border border-gray-400 p-1">128.3</td>
                        <td class="border border-gray-400 p-1">1,035.20</td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1">45</td><td class="border border-gray-400 p-1">1,531</td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1">160</td><td class="border border-gray-400 p-1">8</td><td class="border border-gray-400 p-1">257</td><td class="border border-gray-400 p-1">422</td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1">388.80</td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1"></td>
                    </tr>
                    <tr>
                        <td class="border border-gray-400 p-1.5 font-bold bg-gray-50 sticky left-0 z-10">08-May-26</td>
                        <td class="border border-gray-400 p-1">1,983</td><td class="border border-gray-400 p-1">247.9</td>
                        <td class="border border-gray-400 p-1">956</td><td class="border border-gray-400 p-1">111.2</td>
                        <td class="border border-gray-400 p-1">1,041.20</td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1">51</td><td class="border border-gray-400 p-1">1,548</td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1">161</td><td class="border border-gray-400 p-1">2</td><td class="border border-gray-400 p-1">271</td><td class="border border-gray-400 p-1">413</td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1">391.23</td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1"></td>
                    </tr>
                    <tr>
                        <td class="border border-gray-400 p-1.5 font-bold bg-gray-50 sticky left-0 z-10">09-May-26</td>
                        <td class="border border-gray-400 p-1">1,996</td><td class="border border-gray-400 p-1">239.9</td>
                        <td class="border border-gray-400 p-1">1,172</td><td class="border border-gray-400 p-1">136.3</td>
                        <td class="border border-gray-400 p-1">1,028.80</td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1">55</td><td class="border border-gray-400 p-1">1,597</td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1">170</td><td class="border border-gray-400 p-1">6</td><td class="border border-gray-400 p-1">373</td><td class="border border-gray-400 p-1">324</td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1">413.10</td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1"></td>
                    </tr>
                    <tr>
                        <td class="border border-gray-400 p-1.5 font-bold bg-gray-50 sticky left-0 z-10">10-May-26</td>
                        <td class="border border-gray-400 p-1">1,611</td><td class="border border-gray-400 p-1">193.6</td>
                        <td class="border border-gray-400 p-1">811</td><td class="border border-gray-400 p-1">94.3</td>
                        <td class="border border-gray-400 p-1">897.60</td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1">26</td><td class="border border-gray-400 p-1">1,328</td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1">136</td><td class="border border-gray-400 p-1">4</td><td class="border border-gray-400 p-1">509</td><td class="border border-gray-400 p-1">85</td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1">330.48</td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1"></td>
                    </tr>
                    <tr>
                        <td class="border border-gray-400 p-1.5 font-bold bg-gray-50 sticky left-0 z-10">11-May-26</td>
                        <td class="border border-gray-400 p-1">1,697</td><td class="border border-gray-400 p-1">212.1</td>
                        <td class="border border-gray-400 p-1">1,404</td><td class="border border-gray-400 p-1">163.3</td>
                        <td class="border border-gray-400 p-1">1,179.0</td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1">39</td><td class="border border-gray-400 p-1">1,731</td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1">191</td><td class="border border-gray-400 p-1">2</td><td class="border border-gray-400 p-1">692</td><td class="border border-gray-400 p-1">88</td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1">464.13</td><td class="border border-gray-400 p-1">30</td><td class="border border-gray-400 p-1"></td>
                    </tr>
                    <tr>
                        <td class="border border-gray-400 p-1.5 font-bold bg-gray-50 sticky left-0 z-10">12-May-26</td>
                        <td class="border border-gray-400 p-1">1,731</td><td class="border border-gray-400 p-1">216.4</td>
                        <td class="border border-gray-400 p-1">1,752</td><td class="border border-gray-400 p-1">203.7</td>
                        <td class="border border-gray-400 p-1">1,151.20</td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1">51</td><td class="border border-gray-400 p-1">1,779</td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1">174</td><td class="border border-gray-400 p-1">6</td><td class="border border-gray-400 p-1">646</td><td class="border border-gray-400 p-1">104</td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1">422.82</td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1"></td>
                    </tr>
                    <tr>
                        <td class="border border-gray-400 p-1.5 font-bold bg-gray-50 sticky left-0 z-10">13-May-26</td>
                        <td class="border border-gray-400 p-1">1,811</td><td class="border border-gray-400 p-1">226.4</td>
                        <td class="border border-gray-400 p-1">1,617</td><td class="border border-gray-400 p-1">188.0</td>
                        <td class="border border-gray-400 p-1">1,137.20</td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1">59</td><td class="border border-gray-400 p-1">1,743</td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1">188</td><td class="border border-gray-400 p-1">4</td><td class="border border-gray-400 p-1">680</td><td class="border border-gray-400 p-1">86</td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1">456.84</td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1"></td>
                    </tr>
                    <tr>
                        <td class="border border-gray-400 p-1.5 font-bold bg-gray-50 sticky left-0 z-10">14-May-26</td>
                        <td class="border border-gray-400 p-1">1,339</td><td class="border border-gray-400 p-1">167.4</td>
                        <td class="border border-gray-400 p-1">1,490</td><td class="border border-gray-400 p-1">173.3</td>
                        <td class="border border-gray-400 p-1">974.60</td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1">40</td><td class="border border-gray-400 p-1">1,490</td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1">144</td><td class="border border-gray-400 p-1">6</td><td class="border border-gray-400 p-1">591</td><td class="border border-gray-400 p-1">90</td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1">349.92</td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1"></td>
                    </tr>
                    <tr>
                        <td class="border border-gray-400 p-1.5 font-bold bg-gray-50 sticky left-0 z-10">15-May-26</td>
                        <td class="border border-gray-400 p-1">1,513</td><td class="border border-gray-400 p-1">189.1</td>
                        <td class="border border-gray-400 p-1">926</td><td class="border border-gray-400 p-1">107.7</td>
                        <td class="border border-gray-400 p-1">826.60</td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1">26</td><td class="border border-gray-400 p-1">1,298</td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1">137</td><td class="border border-gray-400 p-1">4</td><td class="border border-gray-400 p-1">481</td><td class="border border-gray-400 p-1">77</td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1">332.91</td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1"></td>
                    </tr>
                    <tr>
                        <td class="border border-gray-400 p-1.5 font-bold bg-gray-50 sticky left-0 z-10">16-May-26</td>
                        <td class="border border-gray-400 p-1">1,192</td><td class="border border-gray-400 p-1">143.3</td>
                        <td class="border border-gray-400 p-1">1,081</td><td class="border border-gray-400 p-1">125.7</td>
                        <td class="border border-gray-400 p-1">757.40</td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1">29</td><td class="border border-gray-400 p-1">1,201</td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1">129</td><td class="border border-gray-400 p-1">2</td><td class="border border-gray-400 p-1">430</td><td class="border border-gray-400 p-1">85</td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1">313.47</td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1"></td>
                    </tr>
                    <tr>
                        <td class="border border-gray-400 p-1.5 font-bold bg-gray-50 sticky left-0 z-10">17-May-26</td>
                        <td class="border border-gray-400 p-1">1,434</td><td class="border border-gray-400 p-1">172.4</td>
                        <td class="border border-gray-400 p-1">1,084</td><td class="border border-gray-400 p-1">126.0</td>
                        <td class="border border-gray-400 p-1">799.50</td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1">27</td><td class="border border-gray-400 p-1">1,266</td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1">142</td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1">343</td><td class="border border-gray-400 p-1">218</td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1">345.06</td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1"></td>
                    </tr>
                    <tr>
                        <td class="border border-gray-400 p-1.5 font-bold bg-gray-50 sticky left-0 z-10">18-May-26</td>
                        <td class="border border-gray-400 p-1">1,427</td><td class="border border-gray-400 p-1">178.4</td>
                        <td class="border border-gray-400 p-1">1,052</td><td class="border border-gray-400 p-1">122.3</td>
                        <td class="border border-gray-400 p-1">988.2</td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1">25</td><td class="border border-gray-400 p-1">1,450</td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1">167</td><td class="border border-gray-400 p-1">2</td><td class="border border-gray-400 p-1">339</td><td class="border border-gray-400 p-1">272</td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1">405.81</td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1"></td>
                    </tr>
                    <tr>
                        <td class="border border-gray-400 p-1.5 font-bold bg-gray-50 sticky left-0 z-10">19-May-26</td>
                        <td class="border border-gray-400 p-1">1,674</td><td class="border border-gray-400 p-1">209.3</td>
                        <td class="border border-gray-400 p-1">1,463</td><td class="border border-gray-400 p-1">170.1</td>
                        <td class="border border-gray-400 p-1">1,145.80</td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1">146</td><td class="border border-gray-400 p-1">1,554</td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1">172</td><td class="border border-gray-400 p-1">2</td><td class="border border-gray-400 p-1">495</td><td class="border border-gray-400 p-1">269</td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1">417.96</td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1"></td>
                    </tr>
                    <tr>
                        <td class="border border-gray-400 p-1.5 font-bold bg-gray-50 sticky left-0 z-10">20-May-26</td>
                        <td class="border border-gray-400 p-1">1,779</td><td class="border border-gray-400 p-1">222.4</td>
                        <td class="border border-gray-400 p-1">1,644</td><td class="border border-gray-400 p-1">191.2</td>
                        <td class="border border-gray-400 p-1">1,254.00</td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1">252</td><td class="border border-gray-400 p-1">1,627</td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1">206</td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1">399</td><td class="border border-gray-400 p-1">423</td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1">500.58</td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1"></td>
                    </tr>
                    <tr>
                        <td class="border border-gray-400 p-1.5 font-bold bg-gray-50 sticky left-0 z-10">21-May-26</td>
                        <td class="border border-gray-400 p-1">1,679</td><td class="border border-gray-400 p-1">209.9</td>
                        <td class="border border-gray-400 p-1">1,069</td><td class="border border-gray-400 p-1">124.3</td>
                        <td class="border border-gray-400 p-1">1,045.00</td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1">232</td><td class="border border-gray-400 p-1">1,311</td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1">169</td><td class="border border-gray-400 p-1">4</td><td class="border border-gray-400 p-1">329</td><td class="border border-gray-400 p-1">364</td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1">410.67</td><td class="border border-gray-400 p-1">300</td><td class="border border-gray-400 p-1"></td>
                    </tr>
                    <tr>
                        <td class="border border-gray-400 p-1.5 font-bold bg-gray-50 sticky left-0 z-10">22-May-26</td>
                        <td class="border border-gray-400 p-1">1,676</td><td class="border border-gray-400 p-1">209.5</td>
                        <td class="border border-gray-400 p-1">1,302</td><td class="border border-gray-400 p-1">151.4</td>
                        <td class="border border-gray-400 p-1">1,166.60</td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1">292</td><td class="border border-gray-400 p-1">1,432</td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1">184</td><td class="border border-gray-400 p-1">4</td><td class="border border-gray-400 p-1">357</td><td class="border border-gray-400 p-1">387</td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1">447.12</td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1"></td>
                    </tr>
                    <tr>
                        <td class="border border-gray-400 p-1.5 font-bold bg-gray-50 sticky left-0 z-10">23-May-26</td>
                        <td class="border border-gray-400 p-1">1,461</td><td class="border border-gray-400 p-1">175.6</td>
                        <td class="border border-gray-400 p-1">2,070</td><td class="border border-gray-400 p-1">240.7</td>
                        <td class="border border-gray-400 p-1">1,117.80</td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1">309</td><td class="border border-gray-400 p-1">1,486</td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1">183</td><td class="border border-gray-400 p-1">6</td><td class="border border-gray-400 p-1">365</td><td class="border border-gray-400 p-1">437</td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1">444.69</td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1"></td>
                    </tr>
                    <tr>
                        <td class="border border-gray-400 p-1.5 font-bold bg-gray-50 sticky left-0 z-10">24-May-26</td>
                        <td class="border border-gray-400 p-1">448</td><td class="border border-gray-400 p-1">53.8</td>
                        <td class="border border-gray-400 p-1">2,127</td><td class="border border-gray-400 p-1">247.3</td>
                        <td class="border border-gray-400 p-1">980.60</td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1">293</td><td class="border border-gray-400 p-1">1,144</td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1">153</td><td class="border border-gray-400 p-1">4</td><td class="border border-gray-400 p-1">252</td><td class="border border-gray-400 p-1">384</td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1">371.79</td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1"></td>
                    </tr>
                    <tr>
                        <td class="border border-gray-400 p-1.5 font-bold bg-gray-50 sticky left-0 z-10">25-May-26</td>
                        <td class="border border-gray-400 p-1">183</td><td class="border border-gray-400 p-1">22.9</td>
                        <td class="border border-gray-400 p-1">2,846</td><td class="border border-gray-400 p-1">330.9</td>
                        <td class="border border-gray-400 p-1">1,160.4</td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1">333</td><td class="border border-gray-400 p-1">1,398</td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1">178</td><td class="border border-gray-400 p-1">6</td><td class="border border-gray-400 p-1">453</td><td class="border border-gray-400 p-1">333</td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1">432.54</td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1"></td>
                    </tr>
                    <tr>
                        <td class="border border-gray-400 p-1.5 font-bold bg-gray-50 sticky left-0 z-10">26-May-26</td>
                        <td class="border border-gray-400 p-1">1,626</td><td class="border border-gray-400 p-1">203.3</td>
                        <td class="border border-gray-400 p-1">1,591</td><td class="border border-gray-400 p-1">185.0</td>
                        <td class="border border-gray-400 p-1">1,111.20</td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1">273</td><td class="border border-gray-400 p-1">1,398</td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1">174</td><td class="border border-gray-400 p-1">6</td><td class="border border-gray-400 p-1">459</td><td class="border border-gray-400 p-1">314</td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1">422.82</td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1"></td>
                    </tr>
                    <tr>
                        <td class="border border-gray-400 p-1.5 font-bold bg-gray-50 sticky left-0 z-10">27-May-26</td>
                        <td class="border border-gray-400 p-1">1,432</td><td class="border border-gray-400 p-1">179.0</td>
                        <td class="border border-gray-400 p-1">2,436</td><td class="border border-gray-400 p-1">283.3</td>
                        <td class="border border-gray-400 p-1">1,256.40</td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1">266</td><td class="border border-gray-400 p-1">1,687</td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1">196</td><td class="border border-gray-400 p-1">4</td><td class="border border-gray-400 p-1">389</td><td class="border border-gray-400 p-1">452</td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1">476.28</td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1"></td>
                    </tr>
                    <tr>
                        <td class="border border-gray-400 p-1.5 font-bold bg-gray-50 sticky left-0 z-10">28-May-26</td>
                        <td class="border border-gray-400 p-1">1,848</td><td class="border border-gray-400 p-1">231.0</td>
                        <td class="border border-gray-400 p-1">1,278</td><td class="border border-gray-400 p-1">148.6</td>
                        <td class="border border-gray-400 p-1">1,243.80</td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1">128</td><td class="border border-gray-400 p-1">1,665</td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1">202</td><td class="border border-gray-400 p-1">4</td><td class="border border-gray-400 p-1">416</td><td class="border border-gray-400 p-1">448</td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1">490.86</td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1"></td>
                    </tr>
                    <tr>
                        <td class="border border-gray-400 p-1.5 font-bold bg-gray-50 sticky left-0 z-10">29-May-26</td>
                        <td class="border border-gray-400 p-1">1,795</td><td class="border border-gray-400 p-1">224.4</td>
                        <td class="border border-gray-400 p-1">1,503</td><td class="border border-gray-400 p-1">174.8</td>
                        <td class="border border-gray-400 p-1">939.00</td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1">122</td><td class="border border-gray-400 p-1">1,406</td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1">210</td><td class="border border-gray-400 p-1">4</td><td class="border border-gray-400 p-1">405</td><td class="border border-gray-400 p-1">322</td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1">510.30</td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1"></td>
                    </tr>
                    <tr>
                        <td class="border border-gray-400 p-1.5 font-bold bg-gray-50 sticky left-0 z-10">30-May-26</td>
                        <td class="border border-gray-400 p-1">1,347</td><td class="border border-gray-400 p-1">161.9</td>
                        <td class="border border-gray-400 p-1">1,622</td><td class="border border-gray-400 p-1">188.6</td>
                        <td class="border border-gray-400 p-1">915.80</td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1">98</td><td class="border border-gray-400 p-1">1,366</td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1">175</td><td class="border border-gray-400 p-1">6</td><td class="border border-gray-400 p-1">413</td><td class="border border-gray-400 p-1">292</td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1">425.25</td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1"></td>
                    </tr>
                    <tr>
                        <td class="border border-gray-400 p-1.5 font-bold bg-gray-50 sticky left-0 z-10">31-May-26</td>
                        <td class="border border-gray-400 p-1">1,532</td><td class="border border-gray-400 p-1">184.1</td>
                        <td class="border border-gray-400 p-1">876</td><td class="border border-gray-400 p-1">101.9</td>
                        <td class="border border-gray-400 p-1">776.40</td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1">63</td><td class="border border-gray-400 p-1">1,110</td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1">131</td><td class="border border-gray-400 p-1">2</td><td class="border border-gray-400 p-1">284</td><td class="border border-gray-400 p-1">282</td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1">318.33</td><td class="border border-gray-400 p-1"></td><td class="border border-gray-400 p-1"></td>
                    </tr>

                    <!-- Total Consumption Row -->
                    <tr class="bg-emerald-100/80 font-bold border-t-2 border-emerald-600 sticky bottom-0 z-20 shadow-xs">
                        <td class="border border-gray-400 p-2 text-left bg-emerald-200 uppercase sticky left-0 z-30">Total Consumption</td>
                        <td class="border border-gray-400 p-1 text-emerald-900">46,364</td>
                        <td class="border border-gray-400 p-1 text-emerald-900">5,729</td>
                        <td class="border border-gray-400 p-1 text-emerald-900">42,223</td>
                        <td class="border border-gray-400 p-1 text-emerald-900">4,910</td>
                        <td class="border border-gray-400 p-1 text-emerald-900">30,961.500</td>
                        <td class="border border-gray-400 p-1 text-emerald-900">0</td>
                        <td class="border border-gray-400 p-1 text-emerald-900">0</td>
                        <td class="border border-gray-400 p-1 text-emerald-900">3,453</td>
                        <td class="border border-gray-400 p-1 text-emerald-900">44,222</td>
                        <td class="border border-gray-400 p-1 text-emerald-900">0</td>
                        <td class="border border-gray-400 p-1 text-emerald-900">5,002</td>
                        <td class="border border-gray-400 p-1 text-emerald-900">128</td>
                        <td class="border border-gray-400 p-1 text-emerald-900">12,260</td>
                        <td class="border border-gray-400 p-1 text-emerald-900">8,724</td>
                        <td class="border border-gray-400 p-1 text-emerald-900">0</td>
                        <td class="border border-gray-400 p-1 text-emerald-900">0</td>
                        <td class="border border-gray-400 p-1 text-emerald-900">12,154.86</td>
                        <td class="border border-gray-400 p-1 text-emerald-900">330</td>
                        <td class="border border-gray-400 p-1 text-emerald-900">0</td>
                    </tr>
                </tbody>
            </table>
        </div>

        @include('pages.reports.explosives.footer')
    </div>

</div>
@endsection

@push('scripts')
<script type="module">

</script>
@endpush