@extends('layouts.app')

@section('page-title', 'Explosives Weekly Consumption Report')

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
            <form method="GET" action="{{ route('reports.mill-mcd.index', ['type' => $type]) }}" class="flex flex-wrap items-center gap-3 flex-1 w-full">

                <!-- Date Filter -->
                <div class="space-y-1">
                    <label class="block text-xs font-semibold">Date Start:</label>
                    <input type="date" name="date" value="{{ request('date') }}"
                                class="w-70 bg-gray-50 border border-gray-300 text-brand-dark text-sm rounded-lg pl-3 pr-3 py-2 focus:border-brand-gold focus:outline-none focus:ring-2 focus:ring-brand-gold/20 transition">
                </div>

                @if($type == 'weekly')
                <div class="space-y-1">
                    <label class="block text-xs font-semibold">Date End:</label>
                    <input type="date" name="end_date" value="{{ request('end_date') }}"
                                class="w-70 bg-gray-50 border border-gray-300 text-brand-dark text-sm rounded-lg pl-3 pr-3 py-2 focus:border-brand-gold focus:outline-none focus:ring-2 focus:ring-brand-gold/20 transition">
                </div>
                @endif

                <!-- Type Filter -->
                <div class="space-y-1">
                    <label class="block text-xs font-semibold">Type:</label>
                    <select name="type" onchange="this.form.submit()" 
                        class="bg-gray-50 border border-gray-300 text-brand-dark text-sm rounded-lg p-2 focus:outline-none focus:border-brand-gold">
                        <option {{ request('type') == 'daily' ? 'selected' : '' }}
                            value="daily"> Daily </option>
                        <option {{ request('type') == 'weekly' ? 'selected' : '' }}
                            value="weekly"> Weekly </option>
                    </select>
                </div>
            </form>
            
            <button type="button" class="px-4 py-2 rounded-lg bg-brand-green hover:bg-brand-green-hover active:translate-y-0.5 text-white text-sm font-bold transition cursor-pointer flex items-center gap-1.5">
                <i class="fa-solid fa-file-excel text-white"></i>
                Export
            </button>
        </div>
    </div>
    
    
    <div class="relative bg-white w-full max-w-[98vw] rounded-2xl shadow-2xl border border-gray-200 overflow-hidden transform transition-all z-110 flex flex-col">
        
        <!-- HEADER -->
        @include('pages.reports.mill-mcd.header')

        <!-- CONTENT -->
        @if($type == 'daily')
            @include('pages.reports.mill-mcd.partial-daily')
        @elseif($type == 'weekly')
            @include('pages.reports.mill-mcd.partial-weekly')
        @else
            <h1>404 NOT FOUND</h1>
        @endif

        <!-- FOOTER -->
        @include('pages.reports.mill-mcd.footer')
    </div>


</div>

@endsection


@push('scripts')
<script type="module">

</script>
@endpush