@extends('layouts.app')

@section('page-title', 'Stock Requests')

@section('sidebar')
    @include('components.sidebar')
@endsection

@section('content')
<div class="space-y-6">
    @if(session('success'))
        <div class="bg-green-100 border border-brand-green/30 text-brand-green p-4 rounded-xl text-sm font-semibold">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white p-4 rounded-xl border border-gray-200 shadow-sm flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <p class="text-xs font-bold text-gray-500 uppercase tracking-wider">Surface Magazine</p>
            <h2 class="text-xl font-bold text-brand-navy mt-1">Stock Requests</h2>
        </div>
        <a href="{{ route('surface.stock.issuance.form') }}"
            class="bg-brand-gold hover:bg-brand-gold-hover text-white font-semibold px-4 py-2 rounded-lg shadow transition text-sm">
            <i class="fa-solid fa-plus mr-1"></i> Request Stock
        </a>
    </div>

    <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr>
                        <th class="px-6 py-4 bg-gray-50 text-xs font-bold text-brand-navy uppercase tracking-wider border-b border-gray-200">Date</th>
                        <th class="px-6 py-4 bg-gray-50 text-xs font-bold text-brand-navy uppercase tracking-wider border-b border-gray-200">Reference</th>
                        <th class="px-6 py-4 bg-gray-50 text-xs font-bold text-brand-navy uppercase tracking-wider border-b border-gray-200">Items</th>
                        <th class="px-6 py-4 bg-gray-50 text-xs font-bold text-brand-navy uppercase tracking-wider border-b border-gray-200">Status</th>
                        <th class="px-6 py-4 bg-gray-50 text-xs font-bold text-brand-navy uppercase tracking-wider border-b border-gray-200 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-sm text-gray-700">
                    @forelse($stockRequests as $request)
                        <tr class="hover:bg-gray-50/50 transition">
                            <td class="px-6 py-4 font-medium">{{ $request->movement_date }}</td>
                            <td class="px-6 py-4 font-semibold text-brand-dark">{{ $request->reference_no }}</td>
                            <td class="px-6 py-4">{{ $request->items->count() }} item(s)</td>
                            <td class="px-6 py-4">
                                <span class="px-2.5 py-1 rounded-full text-xs font-bold border {{ $request->status === 'approved' ? 'bg-green-50 text-brand-green border-brand-green/20' : 'bg-amber-50 text-brand-gold border-brand-gold/20' }}">
                                    {{ ucwords(str_replace('_', ' ', $request->status)) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right whitespace-nowrap space-x-2">
                                <!-- View -->
                                <x-tooltip text="View Record"
                                    bg_color="bg brand navy"
                                    text_color="text-white"
                                >
                                    <button type="button" class="view-request py-2 px-2.5 bg-brand-navy text-white rounded-lg hover:underline text-xs font-bold cursor-pointer" data-request='@json($request)'><i class="fa-solid fa-eye"></i></button>
                                </x-tooltip>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="px-6 py-12 text-center text-gray-400 font-medium">No stock requests found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($stockRequests->hasPages())
            <div class="p-4 bg-gray-50 border-t border-gray-100">{{ $stockRequests->links() }}</div>
        @endif
    </div>
</div>
@endsection
