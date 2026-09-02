<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EDIS | @yield('page-title', 'Explosives Inventory Management')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-brand-light text-brand-dark font-sans antialiased">

    <!-- Modals -->
    @yield('modals')

    <div class="flex flex-row h-screen overflow-hidden outline-none">
        <!-- Sidebar Navigation (Deep Forest Green Accent) -->
        @yield('sidebar')

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col h-full overflow-hidden">
            <!-- Top Navbar -->
            <header class="bg-brand-green border-b border-gray-200 h-16 flex items-center justify-start py-6 px-4 z-10 space-x-3 shrink-0">
                <button id="sidebar-toggle" class="active:-translate-x-0.5 border border-white/20 hover:bg-brand-light/10 active:bg-brand-light/10 text-white p-2 rounded-lg cursor-pointer transition">
                    <i class="fa-solid fa-bars fa-lg"></i>
                </button>
                <h1 class="text-xl font-bold text-white">@yield('page-title', 'Dashboard')</h1>
            </header>

            <!-- Dashboard Content Slot (Scrollable Area) -->
            <main class="flex-1 overflow-y-auto p-8">
                @yield('content')
            </main>
        </div>
    </div>
    @stack('scripts')
</body>
</html>