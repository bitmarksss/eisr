<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EDIS | @yield('page-title', 'PMC Inventory Management')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-brand-light text-brand-dark font-sans antialiased">
    @include('components.backdrop')
    @include('components.add-inventory-modal')
    @include('components.edit-inventory-modal')

    <div class="flex flex-row h-screen overflow-hidden">
        <!-- Sidebar Navigation (Deep Forest Green Accent) -->
        @yield('sidebar')

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col overflow-y-auto">
            <!-- Top Navbar -->
            <header class="bg-white border-b border-gray-200 h-16 flex items-center justify-between px-8 py-6 z-10">
                <h1 class="text-xl font-bold text-brand-navy">@yield('page-title', 'Dashboard')</h1>
                <div class="flex items-center space-x-4">
                    <!-- Dynamic Quick Action Accent Button Based on Role -->
                    @if(auth()->user()?->role_id == 1)
                        <button class="bg-brand-gold hover:bg-brand-goldHover text-white font-semibold px-4 py-2 rounded-lg shadow transition text-sm cursor-pointer active:translate-y-0.5"
                        onclick="window.openModal('addInventoryModal')">
                            + Add New Stock Item
                        </button>
                    @else
                        <button class="bg-brand-navy hover:bg-brand-dark text-white font-semibold px-4 py-2 rounded-lg shadow transition text-sm">
                            Request Stock Pull
                        </button>
                    @endif
                </div>
            </header>

            <!-- Dashboard Content Slot -->
            <main class="p-8">
                @yield('content')
            </main>
        </div>
    </div>
    @stack('scripts')
</body>
</html>