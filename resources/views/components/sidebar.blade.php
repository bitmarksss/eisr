<div class="w-64 bg-brand-green text-white flex flex-col justify-between shadow-xl">
    <div>
        <!-- Brand Header / Logo Area -->
        <div class="p-6 bg-brand-dark/20 flex items-center space-x-3 border-b border-white/10">
            <!-- Placeholder for your logow.png -->
            <span class="font-bold text-lg tracking-wider text-brand-gold">PMC SYSTEM</span>
        </div>

        <!-- Navigation Links -->
        <nav class="mt-6 px-4 space-y-2">
            <p class="sidebar-label">Menu</p>
            <a href="{{ route('dashboard') }}" 
                class="sidebar-link {{ request()->routeIs('dashboard') ? 'selected' : '' }}">
                <i class="fa-solid fa-chart-bar"></i>
                Dashboard
            </a>
            <a href="{{ route('inventory.index') }}" class="sidebar-link {{ request()->routeIs('inventory.*') ? 'selected' : '' }}">
                <i class="fa-solid fa-box-open"></i>
                Inventory Stock
            </a>
            
            <!-- ADMIN ONLY SECTION -->
            @if(auth()->user() && auth()->user()->role->role == 'admin')
            <div class="pt-4 mt-4 space-y-2 border-t border-white/10">
                <p class="sidebar-label">Admin Controls</p>
                <a href="{{ route('users.index') }}" class="sidebar-link {{ request()->routeIs('users.*') ? 'selected' : '' }}">
                    <i class="fa-solid fa-user-gear"></i>
                    User Management
                </a>
                <a href="#" class="sidebar-link {{ request()->routeIs('logs.*') ? 'selected' : '' }}">
                    <i class="fa-solid fa-clock-rotate-left"></i>
                    System Logs
                </a>
            </div>
            @endif
        </nav>
    </div>

    <!-- User Status & Logout -->
    <div class="p-4 bg-brand-dark/30 border-t border-white/10 flex items-center justify-between">
        <div>
            <p class="text-sm font-semibold truncate">{{ auth()->user() ? auth()->user()->first_name . ' ' . auth()->user()->last_name : 'Guest User' }}</p>
            <span class="text-xs {{ auth()->user()?->role ? 'text-brand-gold' : 'text-gray-300' }} font-medium">
                {{ auth()->user()?->role->role == 'admin' ? 'Administrator' : 'Staff / Viewer' }}
            </span>
        </div>
        <form method="GET" action="/logout">
            @csrf
            <button class="text-gray-400 hover:text-brand-gold active:translate-y-0.5 transition p-1 cursor-pointer">
                <i class="fa-regular fa-circle-xmark fa-lg"></i>
            </button>
        </form>
    </div>
</div>