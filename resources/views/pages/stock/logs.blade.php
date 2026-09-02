@extends('layouts.app')

@section('page-title', "Activity Logs")

@section('sidebar')
    @include('components.sidebar')
@endsection

@section('content')
<div class="space-y-6">

    <!-- Control Matrix Panel -->
    <div class="bg-white p-4 rounded-xl border border-gray-200 shadow-sm flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div class="flex flex-wrap items-center justify-between w-full">
            <!-- Search and Filters -->
            <form method="GET" action="{{ url()->current() }}" class="flex flex-wrap items-center gap-3 flex-1 w-full">
                <div class="flex w-90">
                    <div class="relative min-w-70 flex-1 max-w-md">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search logs by action, user, or record ID..." 
                            class="w-full bg-gray-50 border border-gray-300 text-brand-dark text-sm rounded-tl-lg rounded-bl-lg pl-3 pr-10 py-2 focus:border-brand-gold focus:outline-none focus:ring-2 focus:ring-brand-gold/20 transition">
                    </div>
                    <button type="submit" class="px-2.5 cursor-pointer active:translate-y-0.5 transition
                    bg-brand-gold hover:bg-brand-gold-hover border border-brand-gold border-l-0 rounded-tr-lg rounded-br-lg">
                        <i class="fa-solid fa-magnifying-glass text-white"></i>
                    </button>
                </div>

                <select name="action_filter" onchange="this.form.submit()" 
                    class="bg-gray-50 border border-gray-300 text-brand-dark text-sm rounded-lg p-2 focus:outline-none focus:border-brand-gold">
                    <option value="" {{ request('action_filter') == '' ? 'selected' : '' }}>All Actions</option>
                    <option value="created" {{ request('action_filter') == 'created' ? 'selected' : '' }}>Created</option>
                    <option value="updated" {{ request('action_filter') == 'updated' ? 'selected' : '' }}>Updated</option>
                    <option value="deleted" {{ request('action_filter') == 'deleted' ? 'selected' : '' }}>Deleted</option>
                </select>
            </form>
        </div>
    </div>

    <!-- Audit Logs Table Structure -->
    <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 text-xs font-bold text-brand-navy uppercase tracking-wider border-b border-gray-200">
                        <th class="px-6 py-4">Timestamp (UTC)</th>
                        <th class="px-6 py-4">Module</th>
                        <th class="px-6 py-4 text-center">ID</th>
                        <th class="px-6 py-4">User</th>
                        <th class="px-6 py-4">Action</th>
                        <th class="px-6 py-4">Location</th>
                        <th class="px-6 py-4">Activity Details</th>
                        <th class="px-6 py-4">Meta</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-sm text-gray-700">
                    @forelse($logs as $log)
                        <tr class="hover:bg-gray-50/50 transition valign-top">
                            <!-- When -->
                            <td class="px-6 py-4 whitespace-nowrap text-xs text-gray-500 font-mono">
                                {{ $log->created_at }}
                            </td>

                            <!-- Model Name -->
                            <td class="px-6 py-4 font-mono text-xs font-semibold text-brand-navy">
                                <span class="bg-brand-navy/5 text-brand-navy px-2 py-1 rounded">
                                    #{{ $log->auditable_type }}
                                </span>
                            </td>

                            <!-- Affected Model Identifier -->
                            <td class="px-6 py-4 font-mono text-xs font-semibold text-brand-navy">
                                <span class="bg-brand-navy/5 text-brand-navy px-2 py-1 rounded">
                                    #{{ $log->auditable_id }}
                                </span>
                            </td>

                            <!-- Who -->
                            <td class="px-6 py-4 text-gray-600 font-medium">
                                {{ $log->user->username ?? 'System/Guest' }}
                            </td>

                            <!-- What (Action Badge) -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($log->action === 'created')
                                    <span class="px-2.5 py-0.5 bg-green-50 text-brand-green border border-brand-green/20 font-bold text-xs rounded-md">CREATED</span>
                                @elseif($log->action === 'deleted')
                                    <span class="px-2.5 py-0.5 bg-red-50 text-red-700 border border-red-200 font-bold text-xs rounded-md">DELETED</span>
                                @else
                                    <span class="px-2.5 py-0.5 bg-blue-50 text-blue-700 border border-blue-200 font-bold text-xs rounded-md">UPDATED</span>
                                @endif
                            </td>
                            
                            <!-- Where -->
                            <td class="px-6 py-4 text-gray-600 font-medium">
                                {{ $log->location ?? 'N/A' }}
                            </td>

                            <!-- Change Snapshots -->
                            <td class="px-6 py-4 max-w-xs md:max-w-md">
                                <div class="space-y-1 text-xs">
                                    @if($log->action === 'created' && !empty($log->new_values))
                                        <div class="text-gray-600">
                                            <strong>Initial State:</strong>
                                            <ul class="list-disc list-inside mt-1 text-gray-500 space-y-0.5 font-mono">
                                                <li>Item ID: {{ $log->new_values['item_id'] ?? 'N/A' }}</li>
                                                <li>Location: {{ $log->new_values['location'] ?? 'N/A' }}</li>
                                                <li>Qty: {{ number_format($log->new_values['quantity'] ?? 0) }}</li>
                                            </ul>
                                        </div>
                                    @elseif($log->action === 'updated' && !empty($log->new_values))
                                        <div class="text-gray-600">
                                            <strong>Changes:</strong>
                                            <div class="mt-1 space-y-1 font-mono text-[11px] bg-gray-50 p-2 rounded border border-gray-100">
                                                @foreach($log->new_values as $key => $newValue)
                                                    <div>
                                                        <span class="text-gray-400 font-sans">{{ mb_strtoupper($key) }}:</span> 
                                                        <span class="text-red-600 line-through mr-1">{{ $log->old_values[$key] ?? 'empty' }}</span> 
                                                        <i class="fa-solid fa-arrow-right text-gray-400 text-[9px] mx-1"></i>
                                                        <span class="text-brand-green font-semibold">{{ $newValue }}</span>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @elseif($log->action === 'deleted' && !empty($log->old_values))
                                        <span class="text-gray-400 italic">
                                            Purged stock trace at location "{{ $log->old_values['location'] ?? 'Unknown' }}"
                                        </span>
                                    @else
                                        <span class="text-gray-400 italic">No record changes tracked.</span>
                                    @endif
                                </div>
                            </td>

                            <!-- Request Context Details -->
                            <td class="px-6 py-4 whitespace-nowrap text-xs text-gray-400">
                                <div class="flex flex-col space-y-0.5">
                                    <span class="font-mono text-[11px]"><i class="fa-solid fa-network-wired mr-1"></i> {{ $log->ip_address ?? '0.0.0.0' }}</span>
                                    <span class="truncate max-w-[120px]" title="{{ $log->user_agent }}"><i class="fa-solid fa-laptop mr-1"></i> {{ Str::limit($log->user_agent, 20) }}</span>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-gray-400 font-medium">
                                No inventory stock activity logs matched the criteria.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination Blocks -->
        @if(method_exists($logs, 'hasPages') && $logs->hasPages())
            <div class="p-4 bg-gray-50 border-t border-gray-100">
                {{ $logs->appends(request()->query())->links() }}
            </div>
        @endif
    </div>

</div>
@endsection