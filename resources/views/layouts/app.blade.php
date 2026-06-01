<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>PGECC</title>

    @vite('resources/css/app.css')
    @livewireStyles
    @stack('page-css')
</head>

<!-- <body class="background-color relative"> -->
<body class="bg-gray-100 font-sans text-gray-800 antialiased">

    <!-- Notifications -->
    <div class="toast-container">   
        {{-- @include('components.alert') --}}
    </div>

    <!-- Future Sidebar -->
    @yield('sidebar')

    <!-- Main Content Section -->
    <div class="content">
        @yield('content')
    </div>

    <script>
        window.__CSRF_TOKEN__ = document.querySelector('meta[name="csrf-token"]').content;
    </script>

    @vite('resources/js/app.js')
    
    @livewireScripts

    <!-- Notification Script -->
    <script type="module">
        document.addEventListener("DOMContentLoaded", (event) => {
            let notifications = @json(session('notification'));
            if (notifications) {
                for (const [key, value] of Object.entries(notifications.message)) {
                    console.log(`${key}: ${value}`);
                }
            }
        });
    </script>

    @stack('scripts')
    @yield('modal-scripts')
</body>
</html>
