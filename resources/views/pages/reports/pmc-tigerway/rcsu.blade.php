@extends('layouts.app')

@section('page-title', 'PMC RCSU Report')

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
    <div class="bg-white p-4 mb-6 rounded-xl border border-gray-200 shadow-sm flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div class="flex flex-wrap items-center justify-between w-full">
            
            <!-- Search and Filters -->
            <form method="GET" action="{{ route('reports.pmc-tigerway.rcsu') }}" class="flex flex-wrap items-center gap-3 flex-1 w-full">

                <!-- Date Filter -->
                <div class="space-y-1">
                    <label class="block text-xs font-semibold">Date Start:</label>
                    <input type="date" name="start_date" value="{{ request('start_date') }}"
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
                        <option {{ request('location') == 'pmc' ? 'selected' : '' }}
                            value="pmc"> PMC </option>
                        <option {{ request('location') == 'tigerway' ? 'selected' : '' }}
                            value="tigerway"> TIGERWAY </option>
                    </select>
                </div>

            </form>
            
            <button type="button" class="px-4 py-2 rounded-lg bg-brand-green hover:bg-brand-green-hover active:translate-y-0.5 text-white text-sm font-bold transition cursor-pointer flex items-center gap-1.5">
                <i class="fa-solid fa-file-excel text-white"></i>
                Export
            </button>
        </div>
    </div>


    @if($location == 'pmc')
        @include('pages.reports.pmc-tigerway.rcsu-partial-pmc')
    @elseif($location == 'tigerway')
        @include('pages.reports.pmc-tigerway.rcsu-partial-tigerway')
    @else
    <div class="relative bg-white w-full max-w-[98vw] rounded-xl shadow-2xl border border-gray-200 overflow-hidden transform transition-all z-110 flex flex-col max-h-[92vh]">
        <h1>404 NOT FOUND</h1>
    </div>
    @endif


</div>

@endsection


@push('scripts')
<script type="module">

</script>
@endpush