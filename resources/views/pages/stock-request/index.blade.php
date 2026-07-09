@extends('layouts.app')

@section('page-title', ucfirst($location) . " Stock Request")

@section('sidebar')
    @include('components.sidebar')
@endsection

@section('modals')
    @include('components.backdrop')
    @include('components.stock-request.add-modal')
    @include('components.stock-request.edit-modal')
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
    <div class="bg-white p-4 rounded-xl border border-gray-200 shadow-sm flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        
        <div class="flex flex-wrap items-center justify-between w-full">
            <!-- Search and Filters -->
            <form method="GET" action="{{ route($location . '.stock-request.index') }}" class="flex flex-wrap items-center gap-3 flex-1 w-full">
                <div class="flex w-90">
                    <div class="relative min-w-70 flex-1 max-w-md">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by type, kind, or user..." 
                            class="w-full bg-gray-50 border border-gray-300 text-brand-dark text-sm rounded-tl-lg rounded-bl-lg pl-3 pr-10 py-2 focus:border-brand-gold focus:outline-none focus:ring-2 focus:ring-brand-gold/20 transition">
                    </div>
                    <button type="submit" class="px-2.5 cursor-pointer active:translate-y-0.5 transition
                    bg-brand-gold hover:bg-brand-gold-hover border border-brand-gold border-l-0 rounded-tr-lg rounded-br-lg">
                        <i class="fa-solid fa-magnifying-glass text-white"></i>
                    </button>
                </div>

                <select name="kind_filter" onchange="this.form.submit()" 
                    class="bg-gray-50 border border-gray-300 text-brand-dark text-sm rounded-lg p-2 focus:outline-none focus:border-brand-gold">
                    <option value="" {{ request('kind_filter') == '' ? 'selected' : '' }}>All Kinds</option>
                    @foreach($kinds as $kindOption)
                        <option value="{{ $kindOption }}" {{ request('kind_filter') == $kindOption ? 'selected' : '' }}>{{ $kindOption }}</option>
                    @endforeach
                </select>
            </form>
            
            <div class="flex items-center space-x-4">
                @if(auth()->user()?->role_id == 1 || auth()->user()?->is_admin)
                    <button class="bg-brand-gold border-0 hover:bg-brand-goldHover text-white font-semibold px-4 py-2 rounded-lg shadow transition text-sm cursor-pointer active:translate-y-0.5"
                    onclick="window.openModal('addStockRequestModal')">
                        + New Stock Request
                    </button>
                @else
                    <button class="bg-brand-navy hover:bg-brand-dark text-white font-semibold px-4 py-2 rounded-lg shadow transition text-sm"
                    onclick="window.openModal('addStockRequestModal')">
                        Request Stock Pull
                    </button>
                @endif
            </div>
        </div>
    </div>

    <!-- Stock Request Table Structure -->
    <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 text-xs font-bold text-brand-navy uppercase tracking-wider border-b border-gray-200">
                        <th class="px-6 py-4">ID</th>
                        <th class="px-6 py-4">Item (Type)</th>
                        <th class="px-6 py-4">Kind</th>
                        <th class="px-6 py-4">Requested Qty</th>
                        <th class="px-6 py-4">Requested By</th>
                        <th class="px-6 py-4">Status</th>
                        @if(auth()->user()?->role_id == 1 || auth()->user()?->is_admin)
                            <th class="px-6 py-4 text-right">Actions</th>
                        @endif
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-sm text-gray-700">
                    
                    @forelse($stock_requests as $requestItem)
                        <tr class="hover:bg-gray-50/50 transition">
                            <!-- ID Column -->
                            <td class="px-6 py-4 font-mono text-xs font-semibold text-brand-navy">
                                <span class="bg-brand-navy/5 text-brand-navy px-2 py-1 rounded">
                                    #{{ $requestItem->id }}
                                </span>
                            </td>

                            <!-- Type Column -->
                            <td class="px-6 py-4 font-semibold text-brand-dark">
                                {{ $requestItem->type }}
                            </td>

                            <!-- Kind Column -->
                            <td class="px-6 py-4">
                                <span class="px-2.5 py-0.5 bg-slate-100 text-slate-700 text-xs font-medium rounded-md border border-slate-200">
                                    {{ $requestItem->kind }}
                                </span>
                            </td>

                            <!-- Quantity & UOM Column -->
                            <td class="px-6 py-4 font-bold">
                                <span class="text-brand-dark">
                                    {{ number_format($requestItem->quantity['quantity'] ?? 0) }} {{ $requestItem->uom->name ?? 'Units' }}
                                </span>
                            </td>

                            <!-- User Column -->
                            <td class="px-6 py-4 text-gray-500">
                                {{ $requestItem->user->name ?? 'Unknown' }}
                            </td>

                            <!-- Status Badge Logic -->
                            <td class="px-6 py-4">
                                @if($requestItem->status === 'approved')
                                    <span class="px-2.5 py-1 bg-green-50 text-brand-green border border-brand-green/20 font-bold text-xs rounded-full">Approved</span>
                                @elseif($requestItem->status === 'rejected')
                                    <span class="px-2.5 py-1 bg-red-100 text-red-700 border border-red-200 font-bold text-xs rounded-full">Rejected</span>
                                @else
                                    <span class="px-2.5 py-1 bg-amber-50 text-brand-gold border border-brand-gold/20 font-bold text-xs rounded-full">Pending</span>
                                @endif
                            </td>

                            <!-- Actions -->
                            @if(auth()->user()?->role_id == 1 || auth()->user()?->is_admin)
                                <td class="px-6 py-4 text-right whitespace-nowrap">
                                    <button onclick="openEditStockRequestModal('{{ $requestItem->id }}', '{{ addslashes($requestItem->type) }}', '{{ $requestItem->kind }}', '{{ $requestItem->quantity['quantity'] ?? 0 }}', '{{ $requestItem->status }}')" 
                                       class="text-brand-gold hover:underline text-xs font-bold cursor-pointer">
                                        Edit / Sign
                                    </button>
                                </td>
                            @endif
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-12 text-center text-gray-400 font-medium">
                                No stock requests matched the filter criteria.
                            </td>
                        </tr>
                    @endforelse

                </tbody>
            </table>
        </div>

        <!-- Pagination Blocks -->
        @if(method_exists($stock_requests, 'hasPages') && $stock_requests->hasPages())
            <div class="p-4 bg-gray-50 border-t border-gray-100">
                {{ $stock_requests->appends(request()->query())->links() }}
            </div>
        @endif
    </div>

</div>
@endsection