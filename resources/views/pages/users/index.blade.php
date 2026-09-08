@extends('layouts.app')

@section('page-title', 'User Management')

@section('sidebar')
    @include('components.sidebar')
@endsection

@section('modals')
    @include('components.add-user-modal')
    @include('components.edit-user-modal')
@endsection

@section('content')
<div class="space-y-6">

    @if(session('success'))
        <div class="bg-green-100 border border-brand-green/30 text-brand-green p-4 rounded-xl text-sm font-semibold flex items-center shadow-xs">
            <span class="mr-2">✓</span> {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-amber-100 border border-brand-gold/30 text-amber-900 p-4 rounded-xl text-sm font-semibold flex items-center shadow-xs">
            <span class="mr-2">⚠</span> {{ session('error') }}
        </div>
    @endif

    <div class="bg-white p-4 rounded-xl border border-gray-200 shadow-sm flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        
        <form method="GET" action="{{ route('admin.users.index') }}" class="flex flex-1 items-center space-x-3 w-full sm:w-auto">
            <div class="flex items-center space-x-2">
                <label for="perPage" class="text-xs font-semibold text-gray-500 whitespace-nowrap">Show</label>
                <select name="perPage" id="perPage" onchange="this.form.submit()" 
                    class="bg-gray-50 border border-gray-300 text-brand-dark text-sm rounded-lg p-1.5 focus:border-brand-gold focus:outline-none">
                    <option value="10" {{ $perPage == 10 ? 'selected' : '' }}>10</option>
                    <option value="25" {{ $perPage == 25 ? 'selected' : '' }}>25</option>
                    <option value="50" {{ $perPage == 50 ? 'selected' : '' }}>50</option>
                    <option value="100" {{ $perPage == 100 ? 'selected' : '' }}>100</option>
                </select>
            </div>
            <div class="flex ">
                <div class="relative w-full max-w-md">
                    <input type="text" name="search" value="{{ $search }}" placeholder="Search by name, email..." 
                        class="w-full bg-gray-50 border border-gray-300 text-brand-dark text-sm rounded-tl-lg rounded-bl-lg pl-3 pr-10 py-2 focus:border-brand-gold focus:outline-none focus:ring-2 focus:ring-brand-gold/20 transition">
                    @if($search)
                        <a href="{{ route('users.index') }}" class="absolute right-3 top-2.5 text-gray-400 hover:text-gray-600 text-sm">✕</a>
                    @endif
                </div>
                <button type="submit" class="px-2.5 cursor-pointer active:translate-y-0.5 transition
                bg-brand-gold hover:bg-brand-gold-hover border border-brand-gold border-l-0 rounded-tr-lg rounded-br-lg">
                    <i class="fa-solid fa-magnifying-glass text-white"></i>
                </button>
            </div>
        </form>

        <button onclick="window.openModal('addUserModal')" 
            class="bg-brand-gold hover:bg-brand-gold-hover text-white font-bold px-5 py-2.5 rounded-lg shadow-sm text-sm transition text-center flex items-center justify-center space-x-2 cursor-pointer active:translate-y-0.5">
            <span>+</span> <span>Add User</span>
        </button>
    </div>

    @if(request('action') === 'create' || $errors->any() || session('error'))
    <div class="bg-white rounded-xl border border-brand-gold/30 shadow-md overflow-hidden max-w-2xl">
        <div class="px-6 py-4 bg-brand-green text-white flex justify-between items-center">
            <h3 class="font-bold tracking-wide">Register New System User</h3>
            <a href="{{ route('users.index') }}" class="text-white/70 hover:text-white font-bold text-lg">✕</a>
        </div>

        <form action="{{ route('users.store') }}" method="POST" class="p-6 space-y-4">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label for="last-name" class="block text-xs font-bold text-brand-dark uppercase tracking-wider mb-1">
                        Last Name
                        <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="last-name" name="last_name" value="{{ old('last_name') }}" required
                        class="w-full bg-gray-50 border @error('last_name') border-red-500 @else border-gray-300 @enderror rounded-lg px-3 py-2 text-sm focus:border-brand-gold focus:outline-none transition">
                    @error('last_name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                
                <div>
                    <label for="first-name" class="block text-xs font-bold text-brand-dark uppercase tracking-wider mb-1">
                        First Name
                        <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="first-name" name="first_name" value="{{ old('first_name') }}" required
                        class="w-full bg-gray-50 border @error('first_name') border-red-500 @else border-gray-300 @enderror rounded-lg px-3 py-2 text-sm focus:border-brand-gold focus:outline-none transition">
                    @error('first_name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                
                <div>
                    <label for="middle-name" class="block text-xs font-bold text-brand-dark uppercase tracking-wider mb-1">Middle Name</label>
                    <input type="text" id="middle-name" name="middle_name" value="{{ old('middle_name') }}"
                        class="w-full bg-gray-50 border @error('middle_name') border-red-500 @else border-gray-300 @enderror rounded-lg px-3 py-2 text-sm focus:border-brand-gold focus:outline-none transition">
                    @error('middle_name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="username" class="block text-xs font-bold text-brand-dark uppercase tracking-wider mb-1">
                        Username
                        <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="username" name="username" value="{{ old('username') }}"
                        class="w-full bg-gray-50 border @error('username') border-red-500 @else border-gray-300 @enderror rounded-lg px-3 py-2 text-sm focus:border-brand-gold focus:outline-none transition">
                    @error('username') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="email" class="block text-xs font-bold text-brand-dark uppercase tracking-wider mb-1">
                        Email Address
                        <span class="text-red-500">*</span>
                    </label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required placeholder="e.g. example@email.com"
                        class="w-full bg-gray-50 border @error('email') border-red-500 @else border-gray-300 @enderror rounded-lg px-3 py-2 text-sm focus:border-brand-gold focus:outline-none transition">
                    @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="password" class="block text-xs font-bold text-brand-dark uppercase tracking-wider mb-1">
                        Password
                        <span class="text-red-500">*</span>
                    </label>
                    <input type="password" id="password" name="password" required placeholder="Min 8 characters"
                        class="w-full bg-gray-50 border @error('password') border-red-500 @else border-gray-300 @enderror rounded-lg px-3 py-2 text-sm focus:border-brand-gold focus:outline-none transition">
                    @error('password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="password_confirmation" class="block text-xs font-bold text-brand-dark uppercase tracking-wider mb-1">
                        Confirm Password
                        <span class="text-red-500">*</span>
                    </label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required
                        class="w-full bg-gray-50 border border-gray-300 rounded-lg px-3 py-2 text-sm focus:border-brand-gold focus:outline-none transition">
                </div>
            </div>

            <div class="pt-4 flex justify-end space-x-3 border-t border-gray-100">
                <a href="{{ route('users.index') }}" class="px-4 py-2 text-sm font-semibold text-gray-500 hover:text-gray-700 transition">
                    Cancel
                </a>
                <button type="submit"
                    class="px-5 py-2 rounded-lg bg-brand-gold hover:bg-brand-gold-hover text-white text-sm font-bold shadow-xs transition cursor-pointer">
                    Save User
                </button>
            </div>
        </form>
    </div>
    @endif

    <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 text-xs font-bold text-brand-navy uppercase tracking-wider border-b border-gray-200">
                    <th class="px-6 py-4">User Details</th>
                    <th class="px-6 py-4">Email Address</th>
                    <th class="px-6 py-4">Role System Designation</th>
                    <th class="px-6 py-4 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 text-sm text-gray-700">
                @forelse($users as $user)
                    <tr class="hover:bg-gray-50/50 transition">
                        <td class="px-6 py-4">
                            <div class="font-semibold text-brand-dark">
                                {{ $user->name ?? ($user->first_name . ' ' . $user->last_name) }}
                            </div>
                            @if($user->middle_name)
                                <span class="text-xs text-gray-400">Middle: {{ $user->middle_name }}</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 font-mono text-gray-600 text-xs">{{ $user->email }}</td>
                        <td class="px-6 py-4">
                            <span class="px-2.5 py-1 bg-green-50 text-brand-green border border-brand-green/20 font-bold text-xs rounded-full">
                                System Administrator
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right space-x-3">
                            <button onclick="window.openEditUserModal('{{ $user->id }}', '{{ $user->first_name }}', '{{ $user->middle_name }}', '{{ $user->last_name }}', '{{ $user->username }}', '{{ $user->email }}', '{{ $user->role_id }}', )"
                            class="text-brand-navy hover:underline text-xs font-semibold cursor-pointer">Edit</button>
                            <button class="text-gray-400 hover:text-red-600 text-xs transition cursor-pointer">Remove</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-12 text-center text-gray-400 font-medium">
                            No matching user registries identified in system records.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        @if($users->hasPages())
            <div class="p-4 bg-gray-50 border-t border-gray-100">
                {{ $users->appends(request()->query())->links() }}
            </div>
        @endif
    </div>

</div>
@endsection

@push('scripts')
@endpush