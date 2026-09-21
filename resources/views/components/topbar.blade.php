<nav class="bg-brand-light text-brand-navy shadow-xl sticky top-0 z-30">
    <!-- <div class="min-h-16 px-6 flex items-center gap-6"> -->
    <div class="min-h-16 flex items-center gap-6">
        <a href="{{ route('dashboard') }}" class="self-stretch px-6 flex items-center bg-brand-green px-5 font-bold text-sm tracking-wider text-white whitespace-nowrap">
            EXPLOSIVES INVENTORY SYSTEM
        </a>

        <div class="flex items-center gap-1 text-sm flex-1">
            <a href="{{ route('dashboard') }}" class="topbar-link {{ request()->routeIs('dashboard') ? 'selected' : '' }}" title="Dashboard">
                <i class="fa-solid fa-chart-bar lg:mr-2"></i><span class="hidden 2xl:inline">Dashboard</span>
            </a>

            <div class="topbar-menu group">
                <button type="button" class="topbar-link {{ request()->routeIs('surface.*') ? 'selected' : '' }}" title="Surface Magazine">
                    <i class="fa-solid fa-mountain-city lg:mr-2"></i><span class="hidden 2xl:inline">Surface Magazine</span><i class="fa-solid fa-chevron-down hidden 2xl:inline ml-2 text-xs"></i>
                </button>
                <div class="topbar-dropdown">
                    <a href="{{ route('surface.stock.index') }}">Inventory Stock</a>
                    <a href="{{ route('surface.stock.requests.index') }}">Stock Requests</a>
                    <a href="{{ route('surface.stock.receive.index') }}">Receiving Records</a>
                    <a href="{{ route('surface.stock.issuance.index') }}">Issuance Records</a>
                    <a href="{{ route('surface.stock.logs') }}">Stock Logs</a>
                </div>
            </div>

            <div class="topbar-menu group">
                <button type="button" class="topbar-link {{ request()->routeIs('underground.*') ? 'selected' : '' }}" title="Underground Magazine">
                    <!-- <i class="fa-solid fa-person-walking-arrow-right lg:mr-2"></i><span class="hidden 2xl:inline">Underground Magazine</span><i class="fa-solid fa-chevron-down hidden 2xl:inline ml-2 text-xs"></i> -->
                    <i class="fa-solid fa-bore-hole lg:mr-2"></i><span class="hidden 2xl:inline">Underground Magazine</span><i class="fa-solid fa-chevron-down hidden 2xl:inline ml-2 text-xs"></i>
                </button>
                <div class="topbar-dropdown">
                    <a href="{{ route('underground.stock.index') }}">Inventory Stock</a>
                    <a href="{{ route('underground.stock.logs') }}">Stock Logs</a>
                </div>
            </div>

            <div class="topbar-menu group">
                <button type="button" class="topbar-link {{ request()->routeIs('reports.*') ? 'selected' : '' }}" title="Reports">
                    <i class="fa-solid fa-chart-line lg:mr-2"></i><span class="hidden 2xl:inline">Reports</span><i class="fa-solid fa-chevron-down hidden 2xl:inline ml-2 text-xs"></i>
                </button>
                <div class="topbar-dropdown min-w-64">
                    <a href="{{ route('reports.daily.index', ['type' => 'total']) }}">Daily Report</a>
                    <a href="{{ route('reports.pmc-tigerway.consumption', ['location' => 'surface']) }}">PMC and Tigerway</a>
                    <a href="{{ route('reports.mill-mcd.index', ['type' => 'daily']) }}">Mill MCD</a>
                    <a href="{{ route('reports.pnp.index') }}">Blaster Reports</a>
                    <a href="{{ route('reports.mgb.index', ['type' => 'daily']) }}">MGB Reports</a>
                    <a href="{{ route('reports.explosives.index', ['type' => 'monthly']) }}">Explosives Monthly Report</a>
                    <a href="{{ route('reports.explosives.index', ['type' => 'usage']) }}">Explosives Usage Analysis</a>
                    <a href="{{ route('reports.movement-data') }}">Movement Data</a>
                </div>
            </div>

            <div class="topbar-menu group">
                <button type="button" class="topbar-link {{ request()->routeIs('maintenance.*') ? 'selected' : '' }}" title="Maintenance">
                    <i class="fa-solid fa-screwdriver-wrench lg:mr-2"></i><span class="hidden 2xl:inline">Maintenance</span><i class="fa-solid fa-chevron-down hidden 2xl:inline ml-2 text-xs"></i>
                </button>
                <div class="topbar-dropdown">
                    <a href="{{ route('maintenance.inventory.index') }}">Inventory Items</a>
                    <a href="{{ route('maintenance.levels.index') }}">Levels</a>
                    <a href="{{ route('maintenance.stock-approvers.index') }}">Stock Approvers</a>
                </div>
            </div>

            @if(auth()->user() && auth()->user()->role->role == 'admin')
            <div class="topbar-menu group">
                <button type="button" class="topbar-link {{ request()->routeIs('admin.*') ? 'selected' : '' }}" title="Admin Controls">
                    <i class="fa-solid fa-user-shield lg:mr-2"></i><span class="hidden 2xl:inline">Admin Controls</span><i class="fa-solid fa-chevron-down hidden 2xl:inline ml-2 text-xs"></i>
                </button>
                <div class="topbar-dropdown">
                    <a href="{{ route('admin.users.index') }}">User Management</a>
                    <a href="{{ route('admin.logs') }}">System Logs</a>
                </div>
            </div>
            @endif
        </div>

        <div class="flex items-center gap-3 text-right pr-6">
            <div class="hidden md:block">
                <p class="text-sm font-semibold">{{ auth()->user() ? auth()->user()->first_name . ' ' . auth()->user()->last_name : 'Guest User' }}</p>
                <span class="text-xs text-brand-green">{{ auth()->user()?->role?->role == 'admin' ? 'Administrator' : 'Staff / Viewer' }}</span>
            </div>
            <form method="GET" action="/logout">
                @csrf
                <button class="text-brand-navy border border-transparent rounded-xl p-2 cursor-pointer
                    hover:border-gray-100 hover:bg-gray-200 transition"
                    title="Log out">
                    <i class="fa-solid fa-arrow-right-from-bracket fa-flip-horizontal"></i>
                </button>
            </form>
        </div>
    </div>
</nav>
