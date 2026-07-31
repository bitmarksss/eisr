@extends('layouts.app')

@section('page-title', 'Explosive Monthly Report')

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

                <!-- Date Filter -->
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

                <!-- Type Filter -->
                <div class="space-y-1">
                    <label class="block text-xs font-semibold">Type:</label>
                    <select name="type" onchange="this.form.submit()" 
                        class="bg-gray-50 border border-gray-300 text-brand-dark text-sm rounded-lg p-2 focus:outline-none focus:border-brand-gold">
                        <option {{ request('type') == 'pmc' ? 'selected' : '' }}
                            value="pmc"> PMC </option>
                        <option {{ request('type') == 'tigerway' ? 'selected' : '' }}
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



    <div class="relative bg-white w-full max-w-[98vw] rounded-xl shadow-2xl border border-gray-200 overflow-hidden transform transition-all z-110 flex flex-col max-h-[92vh]">
       
        <!-- HEADER -->
        <!-- Moved as part of content -->

        <!-- CONTENT -->
        @if($location == 'pmc')
            @include('pages.reports.pnp.partial-pmc')
        @elseif($location == 'tigerway')
            @include('pages.reports.pnp.partial-tigerway')
        @else
            <h1>404 NOT FOUND</h1>
        @endif

        <!-- FOOTER -->
        <!-- N/A -->

    </div>

</div>

@endsection


@push('scripts')
<script type="module">

</script>
@endpush