<aside class="w-64 bg-slate-900 text-white flex flex-col">
    <div class="p-5 text-xl font-bold tracking-wider bg-slate-950">🏢 PGECC</div>
    <nav class="mt-6 px-4 flex-1 space-y-2">
        
        <a href="{{ route('dashboard') }}" 
           class="block px-4 py-2.5 rounded transition-all 
           {{ request()->routeIs('dashboard') ? 'bg-amber-600 text-white font-medium' : 'text-slate-300 hover:bg-slate-800' }}">
            <i class="fa-solid fa-chart-column {{ request()->routeIs('dashboard') ? 'text-white' : 'text-slate-300' }}"></i>
            Dashboard
        </a>

        <a href="{{ route('carenderia.index') }}" 
           class="block px-4 py-2.5 rounded transition-all 
           {{ request()->routeIs('carenderia.*') ? 'bg-amber-600 text-white font-medium' : 'text-slate-300 hover:bg-slate-800' }}">
            <i class="fa-solid fa-utensils {{ request()->routeIs('carenderia.*') ? 'text-amber-300' : 'text-slate-300' }}"></i>
            Carenderia
        </a>

        <a href="{{ route('loan.index') }}" 
           class="block px-4 py-2.5 rounded transition-all 
           {{ request()->routeIs('loan.*') ? 'bg-amber-600 text-white font-medium' : 'text-slate-300 hover:bg-slate-800' }}">
            <i class="fa-solid fa-sack-dollar {{ request()->routeIs('loan.*') ? 'text-green-300' : 'text-slate-300' }}"></i>
            Loans
        </a>

        <a href="{{ route('grocery.index') }}" 
           class="block px-4 py-2.5 rounded transition-all 
           {{ request()->routeIs('grocery.*') ? 'bg-amber-600 text-white font-medium' : 'text-slate-300 hover:bg-slate-800' }}">
            <i class="fa-solid fa-cart-shopping {{ request()->routeIs('grocery.*') ? 'text-olive-300' : 'text-slate-300' }}"></i>
            Grocery
        </a>

        <a href="{{ route('payments.index') }}" 
           class="block px-4 py-2.5 rounded transition-all 
           {{ request()->routeIs('payments.*') ? 'bg-amber-600 text-white font-medium' : 'text-slate-300 hover:bg-slate-800' }}">
            <i class="fa-solid fa-hand-holding-dollar {{ request()->routeIs('payments.*') ? 'text-red-300' : 'text-slate-300' }}"></i>
            Payments
        </a>

        <hr class="border-slate-800 my-4">
                
        <a href="{{ route('users.index') }}" 
           class="block px-4 py-2.5 rounded transition-all 
           {{ request()->routeIs('users.*') ? 'bg-amber-600 text-white font-medium' : 'text-slate-300 hover:bg-slate-800' }}">
            <i class="fa-solid fa-user-group text-white"></i>
            User Management
        </a>
           
    </nav>
</aside>