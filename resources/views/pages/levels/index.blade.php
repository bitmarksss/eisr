@extends('layouts.app')

@section('page-title', "Floor Levels Management")

@section('sidebar')
    @include('components.sidebar')
@endsection

@section('modals')
    @include('components.backdrop')

    @include('pages.levels.create')
    @include('pages.levels.edit')
@endsection

@section('content')
<div class="space-y-6">

    <!-- Validation / Flash Error Messages -->
    @if($errors->any())
        <div class="bg-red-50 border border-red-200 text-red-700 p-4 rounded-xl text-sm font-medium shadow-xs space-y-1">
            <div class="font-bold flex items-center text-red-800"><span class="mr-2">✕</span> Action Failed:</div>
            <ul class="list-disc list-inside pl-2 text-xs text-red-600 space-y-0.5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(session('success'))
        <div class="bg-green-100 border border-brand-green/30 text-brand-green p-4 rounded-xl text-sm font-semibold flex items-center shadow-xs">
            <span class="mr-2">✓</span> {{ session('success') }}
        </div>
    @endif

    <!-- Control Matrix Panel -->
    <div class="bg-white p-4 rounded-xl border border-gray-200 shadow-sm flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div class="flex flex-wrap items-center justify-between w-full">
            <!-- Search Component -->
            <form method="GET" action="{{ route('underground.levels.index') }}" class="flex flex-wrap items-center gap-3 flex-1 w-full">
                <div class="flex w-90">
                    <div class="relative min-w-70 flex-1 max-w-md">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search floors by name or code..." 
                            class="w-full bg-gray-50 border border-gray-300 text-brand-dark text-sm rounded-tl-lg rounded-bl-lg pl-3 pr-10 py-2 focus:border-brand-gold focus:outline-none focus:ring-2 focus:ring-brand-gold/20 transition">
                    </div>
                    <button type="submit" class="px-2.5 cursor-pointer active:translate-y-0.5 transition bg-brand-gold hover:bg-brand-gold-hover border border-brand-gold border-l-0 rounded-tr-lg rounded-br-lg">
                        <i class="fa-solid fa-magnifying-glass text-white"></i>
                    </button>
                </div>
            </form>
            
            <div class="flex items-center space-x-4">
                <button class="bg-brand-gold border-0 hover:bg-brand-gold-hover text-white font-semibold px-4 py-2 rounded-lg shadow transition text-sm cursor-pointer active:translate-y-0.5 flex items-center"
                onclick="window.openModal('createLevelModal')">
                    <i class="fa-solid fa-plus mr-2 text-xs"></i> Create New Level
                </button>
            </div>
        </div>
    </div>

    <!-- Levels Table Panel -->
    <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 text-xs font-bold text-brand-navy uppercase tracking-wider border-b border-gray-200">
                        <th class="px-6 py-4 w-20">Sort</th>
                        <th class="px-6 py-4">Level Code</th>
                        <th class="px-6 py-4">Floor Name</th>
                        <th class="px-6 py-4">Description</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-sm text-gray-700">
                    @forelse($levels as $level)
                        <tr class="hover:bg-gray-50/50 transition">
                            <!-- Sort Position -->
                            <td class="px-6 py-4 text-xs font-mono font-bold text-gray-400">
                                {{ $level->sort_order }}
                            </td>

                            <!-- Code Target Badge -->
                            <td class="px-6 py-4 font-mono text-xs font-semibold text-brand-navy">
                                <span class="bg-brand-navy/5 text-brand-navy px-2.5 py-1 rounded border border-brand-navy/10">
                                    {{ $level->code }}
                                </span>
                            </td>

                            <!-- Structural Floor Name -->
                            <td class="px-6 py-4 font-semibold text-brand-dark">
                                {{ $level->name }}
                            </td>

                            <!-- Description Snippet -->
                            <td class="px-6 py-4 text-xs text-gray-500 max-w-xs truncate" title="{{ $level->description }}">
                                {{ $level->description ?? '—' }}
                            </td>

                            <!-- Availability State -->
                            <td class="px-6 py-4">
                                @if($level->is_active)
                                    <span class="px-2 py-0.5 bg-green-50 text-brand-green border border-brand-green/20 font-bold text-xs rounded-md">ACTIVE</span>
                                @else
                                    <span class="px-2 py-0.5 bg-gray-100 text-gray-500 border border-gray-200 font-bold text-xs rounded-md">INACTIVE</span>
                                @endif
                            </td>

                            <!-- Action Trigger Elements -->
                            <td class="px-6 py-4 text-right whitespace-nowrap">
                                <button onclick="editLevelModal('{{ $level->id }}', '{{ addslashes($level->name) }}', '{{ addslashes($level->code) }}', '{{ $level->sort_order }}', '{{ addslashes($level->description) }}', {{ $level->is_active ? 'true' : 'false' }})" 
                                    class="text-brand-gold hover:underline text-xs font-bold cursor-pointer">
                                    Edit
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-gray-400 font-medium">
                                No physical layout storage levels defined yet.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination Blocks -->
        @if(method_exists($levels, 'hasPages') && $levels->hasPages())
            <div class="p-4 bg-gray-50 border-t border-gray-100">
                {{ $levels->appends(request()->query())->links() }}
            </div>
        @endif
    </div>
</div>

<!-- Modal Control Bindings -->
<script>
    let activeDeleteId = null;

    function openEditLevelModal(id, name, code, sortOrder, description, isActive) {
        activeDeleteId = id;
        
        // Populate standard inputs
        document.getElementById('edit_name').value = name;
        document.getElementById('edit_code').value = code;
        document.getElementById('edit_sort_order').value = sortOrder;
        document.getElementById('edit_description').value = description;
        document.getElementById('edit_is_active').checked = isActive;
        
        // Dynamically shift target action routes
        document.getElementById('editLevelForm').action = `/levels/${id}`;
        document.getElementById('deleteLevelForm').action = `/levels/${id}`;
        
        window.openModal('editLevelModal');
    }

    function confirmDeleteLevel() {
        if (confirm('Are you absolutely sure you want to completely delete this layout level? This might affect attached inventory item tracking snapshots.')) {
            document.getElementById('deleteLevelForm').submit();
        }
    }
</script>
@endsection