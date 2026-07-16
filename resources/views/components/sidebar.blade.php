<div id="sidebar" class="h-full max-h-full w-64 overflow-y-hidden bg-brand-light text-brand-navy flex flex-col justify-start shadow-xl transition-all duration-300">
    <!-- Brand Header / Logo Area -->
    <div class="p-6 flex items-center space-x-3 ">
        <!-- Placeholder for your logow.png -->
        <span class="font-bold text-base tracking-wider text-brand-green">EXPLOSIVES DEPARTMENT INVENTORY SYSTEM</span>
    </div>

    <!-- Navigation Links -->
    <nav class="flex-1 px-4 space-y-1 overflow-y-scroll
         
    ">

        <!-- MENU -->
        <p class="sidebar-label
            {{ request()->routeIs('dashboard') ? 'border-0 border-b border-brand-navy/50' : '' }}">
            Menu
        </p>
        <a href="{{ route('dashboard') }}" 
            class="sidebar-link {{ request()->routeIs('dashboard') ? 'selected' : '' }}">
            <i class="fa-solid fa-chart-bar"></i>
            Dashboard
        </a>
        <br>


        <!-- INVENTORY -->
        <p class="sidebar-label
            {{ request()->routeIs('inventory.*') ? 'border-0 border-b border-brand-navy/50' : '' }}">
            Inventory
        </p>
        <!-- Items-->
        <a href="{{ route('inventory.index')}}" 
            class="sidebar-link {{ request()->routeIs('inventory.*') ? 'selected' : '' }}">
            <i class="fa-solid fa-box-open"></i>
            Items List
        </a>
        <br>


        <!-- MINE SURFACE -->
        <p class="sidebar-label
            {{ request()->routeIs('surface.*') ? 'border-0 border-b border-brand-navy/50' : '' }}">
             Surface Magazine
        </p>
        <!-- Inventory -->
        <a href="{{ route('surface.inventory.index', ['location' => 'surface']) }}" 
            class="sidebar-link {{ request()->routeIs('surface.inventory.*') ? 'selected' : '' }}">
            <i class="fa-solid fa-box-open"></i>
            Inventory Stock
        </a>
        <!-- Stock Management -->
        <a href="{{ route('surface.stock.index', ['location' => 'surface']) }}" 
            class="sidebar-link {{ request()->routeIs('surface.stock.index') ? 'selected' : '' }}">
            <i class="fa-solid fa-file-lines"></i>
            Stock Management
        </a>
        <!-- Issuance -->
        <!-- <a href="{{ route('surface.stock.issuance', ['location' => 'surface']) }}" 
            class="sidebar-link {{ request()->routeIs('surface.stock.issuance') ? 'selected' : '' }}">
            <i class="fa-solid fa-people-carry-box"></i>
            Stock Issuance
        </a> -->
        <br>
        

        <!-- MINE UNDERGROUND -->
        <p class="sidebar-label
            {{ request()->routeIs('underground.*') ? 'border-0 border-b border-brand-navy/50' : '' }}">
            Underground Magazine
        </p>
        <!-- Inventory -->
        <a href="{{ route('underground.inventory.index', ['location' => 'underground']) }}" 
            class="sidebar-link {{ request()->routeIs('underground.inventory.*') ? 'selected' : '' }}">
            <i class="fa-solid fa-box-open"></i>
            Inventory Stock
        </a>
        <!-- Wthdrawal -->
        <a href="{{ route('underground.stock.withdrawal') }}" 
            class="sidebar-link {{ request()->routeIs('underground.stock.withdrawal') ? 'selected' : '' }}">
            <i class="fa-solid fa-hand-holding"></i>
            Stock Withdrawal
        </a>
        <!-- Issuance -->
        <a href="{{ route('underground.stock.issuance') }}" 
            class="sidebar-link {{ request()->routeIs('underground.stock.issuance') ? 'selected' : '' }}">
            <i class="fa-solid fa-people-carry-box"></i>
            Stock Issuance
        </a>
        <br>
        

        <!-- REPORTS -->
        <p class="sidebar-label
            {{ request()->routeIs('reports.*') ? 'border-0 border-b border-brand-navy/50' : '' }}">
            REPORTS
        </p>
        <!-- Inventory -->
        <a href="" class="sidebar-link">
            <i class="fa-solid fa-scroll"></i>
            Daily Reports
        </a>
        <!-- Stock Request -->
        <a href="" class="sidebar-link">
            <i class="fa-solid fa-scroll"></i>
            Weekly Reports
        </a>
        <br>

        <!-- ADMIN ONLY SECTION -->
        @if(auth()->user() && auth()->user()->role->role == 'admin')
        <div class="pt-4 mt-4 space-y-2">
            <p class="sidebar-label
                {{ request()->is('admin/*') ? 'border-0 border-b border-brand-navy/50' : '' }}">
                Admin Controls
            </p>
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

    <!-- User Status & Logout -->
    <div class="p-4 bg-brand-green border-t border-white/10 flex items-center justify-between justify-self-end">
        <div>
            <p class="text-sm text-brand-light font-semibold truncate">{{ auth()->user() ? auth()->user()->first_name . ' ' . auth()->user()->last_name : 'Guest User' }}</p>
            <span class="text-xs {{ auth()->user()?->role ? 'text-brand-gold' : 'text-brand-light' }} font-medium">
                {{ auth()->user()?->role->role == 'admin' ? 'Administrator' : 'Staff / Viewer' }}
            </span>
        </div>
        <form method="GET" action="/logout">
            @csrf
            <button class="text-gray-400 hover:text-brand-light active:translate-y-0.5 transition p-1 cursor-pointer">
                <i class="fa-solid fa-arrow-right-from-bracket fa-flip-horizontal"></i>
            </button>
        </form>
    </div>
</div>