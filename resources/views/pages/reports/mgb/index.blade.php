@extends('layouts.app')

@section('page-title', 'Monthly Explosives Consumption Report')

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
            <form method="GET" action="{{ route('reports.mgb.index', ['type' => $type]) }}" class="flex flex-wrap items-center gap-3 flex-1 w-full">

                <!-- Date Filter -->
                <div class="space-y-1">
                    <label class="block text-xs font-semibold">Date Start:</label>
                    <input type="date" name="date" value="{{ request('date') }}"
                                class="w-70 bg-gray-50 border border-gray-300 text-brand-dark text-sm rounded-lg pl-3 pr-3 py-2 focus:border-brand-gold focus:outline-none focus:ring-2 focus:ring-brand-gold/20 transition">
                </div>

                <div class="space-y-1">
                    <label class="block text-xs font-semibold">Date End:</label>
                    <input type="date" name="end_date" value="{{ request('end_date') }}"
                                class="w-70 bg-gray-50 border border-gray-300 text-brand-dark text-sm rounded-lg pl-3 pr-3 py-2 focus:border-brand-gold focus:outline-none focus:ring-2 focus:ring-brand-gold/20 transition">
                </div>

                <!-- Location Filter -->
                <div class="space-y-1">
                    <label class="block text-xs font-semibold">Location:</label>
                    <select name="location" onchange="this.form.submit()" 
                        class="bg-gray-50 border border-gray-300 text-brand-dark text-sm rounded-lg p-2 focus:outline-none focus:border-brand-gold">
                        <option {{ request('location') == 'Surface' ? 'selected' : '' }}
                            value="Surface"> Surface </option>
                        <option {{ request('location') == 'Underground' ? 'selected' : '' }}
                            value="Underground"> Underground </option>
                        <option {{ request('location') == 'TIGERWAY' ? 'selected' : '' }}
                            value="TIGERWAY"> TIGERWAY </option>
                    </select>
                </div>

                <!-- Type Filter -->
                <div class="space-y-1">
                    <label class="block text-xs font-semibold">Type:</label>
                    <select name="type" onchange="this.form.submit()" 
                        class="bg-gray-50 border border-gray-300 text-brand-dark text-sm rounded-lg p-2 focus:outline-none focus:border-brand-gold">
                        <option {{ request('type') == 'daily' ? 'selected' : '' }}
                            value="daily"> Daily Report</option>
                        <option {{ request('type') == 'br' ? 'selected' : '' }}
                            value="br"> BR Report </option>
                        <option {{ request('type') == 'fy' ? 'selected' : '' }}
                            value="fy"> FY {{\Carbon\Carbon::now()->format('Y') }} </option>
                        <option {{ request('type') == 'explosive' ? 'selected' : '' }}
                            value="explosive"> Explosive and Accessories </option>
                    </select>
                </div>
            </form>
            
            <button type="button" class="px-4 py-2 rounded-lg bg-brand-green hover:bg-brand-green-hover active:translate-y-0.5 text-white text-sm font-bold transition cursor-pointer flex items-center gap-1.5">
                <i class="fa-solid fa-file-excel text-white"></i>
                Export
            </button>
        </div>
    </div>
    
    <div class="relative bg-white w-full rounded-2xl shadow-sm border border-gray-200 overflow-hidden transform transition-all z-110 flex flex-col">
        
        <!-- HEADER -->
        <!-- Moved as part of content -->

        <!-- CONTENT -->
        @if($type == 'daily')
            @include('pages.reports.mgb.partial-daily')
        @elseif($type == 'br')
            @include('pages.reports.mgb.partial-br')
        @elseif($type == 'fy')
            @include('pages.reports.mgb.partial-fy')
        @elseif($type == 'explosive')
            @include('pages.reports.mgb.partial-explosive')
        @else
            <h1 class="p-6 font-bold text-center">404 NOT FOUND</h1>
        @endif

        <!-- FOOTER -->
        <!-- Delegated to partials -->
    </div>


</div>

@endsection


@push('scripts')
<script type="module">

</script>
@endpush