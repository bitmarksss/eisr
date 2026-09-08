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

    <div class="min-h-screen overflow-x-visible outline-none">
        @include('components.topbar')

        @php
            if (request()->routeIs('dashboard')) {
                $breadcrumb = [
                    ['label' => 'Dashboard', 'url' => route('dashboard')],
                ];
            }

            if (request()->routeIs('surface.*')) {
                $breadcrumb[] = ['label' => 'Surface Magazine', 'url' => route('surface.stock.index')];
                if (request()->routeIs('surface.stock.receive.*')) {
                    $breadcrumb[] = ['label' => 'Receiving', 'url' => route('surface.stock.receive.index')];
                } elseif (request()->routeIs('surface.stock.issuance.*')) {
                    $breadcrumb[] = ['label' => 'Issuance', 'url' => route('surface.stock.issuance.index')];
                } elseif (request()->routeIs('surface.stock.logs')) {
                    $breadcrumb[] = ['label' => 'Stock Logs', 'url' => route('surface.stock.logs')];
                } elseif (request()->routeIs('surface.stock.*')) {
                    $breadcrumb[] = ['label' => 'Stocks', 'url' => route('surface.stock.index')];
                }
            } elseif (request()->routeIs('underground.*')) {
                $breadcrumb[] = ['label' => 'Underground Magazine', 'url' => route('underground.stock.index')];
                if (request()->routeIs('underground.stock.logs')) {
                    $breadcrumb[] = ['label' => 'Stock Logs', 'url' => route('underground.stock.logs')];
                } else {
                    $breadcrumb[] = ['label' => 'Stocks', 'url' => route('underground.stock.index')];
                }
            } elseif (request()->routeIs('reports.*')) {
                $breadcrumb[] = ['label' => 'Reports', 'url' => route('reports.index')];
                if (request()->routeIs('reports.movement-data')) {
                    $breadcrumb[] = ['label' => 'Movement Data', 'url' => route('reports.movement-data')];
                } elseif (request()->routeIs('reports.daily.*')) {
                    $breadcrumb[] = ['label' => 'Daily Report', 'url' => route('reports.daily.index', ['type' => 'total'])];
                }
            } elseif (request()->routeIs('maintenance.*')) {
                $breadcrumb[] = ['label' => 'Maintenance', 'url' => route('maintenance.inventory.index')];
            } elseif (request()->routeIs('admin.*')) {
                $breadcrumb[] = ['label' => 'Admin Controls', 'url' => route('admin.users.index')];
            }
        @endphp
        
        <div class="flex flex-col min-h-[calc(100vh-4rem)]">

            <main class="flex-1 overflow-y-auto px-8 py-4">

                <!-- Breadcrumb -->
                <nav aria-label="Breadcrumb" class="my-4 text-sm">
                    <ol class="flex items-center gap-2 text-gray-500">
                        @foreach ($breadcrumb as $index => $crumb)
                            @if ($index > 0)
                                <li aria-hidden="true">
                                    <i class="fa-solid fa-chevron-right text-[10px]"></i>
                                </li>
                            @endif

                            <li>
                                <a
                                    href="{{ $crumb['url'] }}"
                                    class="hover:text-brand-green {{ $index === count($breadcrumb) - 1 ? 'font-semibold text-brand-navy' : '' }}"
                                >
                                    {{ $crumb['label'] }}
                                </a>
                            </li>
                        @endforeach
                    </ol>
                </nav>

                @yield('content')

            </main>
        </div>

    </div>
    @stack('scripts')
</body>
</html>
