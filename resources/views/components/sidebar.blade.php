<aside id="sidebar" class="w-64 bg-slate-900 text-white flex flex-col">
    <div class="p-5 text-2xl font-bold text-center tracking-wider bg-slate-950">
        EDIS
    </div>
    <nav class="mt-6 px-4 flex-1 space-y-2">
        
        <a href="{{ route('dashboard') }}" 
           class="block px-4 py-2.5 rounded transition-all 
           {{ request()->routeIs('dashboard') ? 'bg-amber-600 text-white font-medium' : 'text-slate-300 hover:bg-slate-800' }}">
            <i class="fa-solid fa-chart-column {{ request()->routeIs('dashboard') ? 'text-white' : 'text-slate-300' }}"></i>
            Dashboard
        </a>

        <a href="{{ route('inventory.index') }}" 
           class="block px-4 py-2.5 rounded transition-all 
           {{ request()->routeIs('payments.*') ? 'bg-amber-600 text-white font-medium' : 'text-slate-300 hover:bg-slate-800' }}">
            <i class="fa-solid fa-hand-holding-dollar {{ request()->routeIs('inventory.*') ? 'text-red-300' : 'text-slate-300' }}"></i>
            Inventory
        </a>

        <hr class="border-slate-300 my-4">
                
        <a href="{{ route('users.index') }}" 
           class="block px-4 py-2.5 rounded transition-all 
           {{ request()->routeIs('users.*') ? 'bg-amber-600 text-white font-medium' : 'text-slate-300 hover:bg-slate-800' }}">
            <i class="fa-solid fa-user-group {{ request()->routeIs('users.*') ? 'text-violet-300' : 'text-slate-300' }}"></i>
            User Management
        </a>
           
    </nav>

    <h6 class="text-center p-4 text-sm italic text-gray-400">
        {{ now()->format('F d, Y') }}
    </h6>
</aside>