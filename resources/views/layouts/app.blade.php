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
    <div class="notification-container" id="notification-container">   
        @if(session('notification'))
            @foreach(session('notification.messages') as $message)
                <x-notification>
                    <x-slot name="header">{{ session('notification.title') }}</x-slot>
                    <x-slot name="body">{{ $message[0] }}</x-slot>
                    <x-slot name="footer">Just Now</x-slot>
                </x-notification>
            @endforeach
        @endif
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
        document.addEventListener("DOMContentLoaded", () => {
            const container = document.getElementById('notification-container');
            if (!container) return;

            // Function to initialize native lifecycle on a toast node
            function initToastLifecycle(toast) {
                if (toast.hasAttribute('data-initialized')) return;
                toast.setAttribute('data-initialized', 'true');

                const duration = parseInt(toast.getAttribute('data-duration')) || 5000;
                let dismissTimer;
                let timeRemaining = duration;
                let startTime = Date.now();

                // 1. Float-in on introduction
                requestAnimationFrame(() => {
                    toast.classList.add('show');
                });

                // 2. Setup Lifecycle timers
                function startTimeout() {
                    startTime = Date.now();
                    dismissTimer = setTimeout(() => {
                        removeToast(toast);
                    }, timeRemaining);
                }

                function pauseTimeout() {
                    clearTimeout(dismissTimer);
                    timeRemaining -= (Date.now() - startTime);
                    if (timeRemaining < 1000) timeRemaining = 1000; // Keep 1s minimum buffer
                }

                // 3. Register Native Event Listeners
                toast.addEventListener('mouseenter', pauseTimeout);
                toast.addEventListener('mouseleave', startTimeout);

                const closeBtn = toast.querySelector('.close-notification');
                if (closeBtn) {
                    closeBtn.addEventListener('click', () => removeToast(toast));
                }

                // Fire timer
                startTimeout();
            }

            function removeToast(toast) {
                toast.classList.remove('show');
                toast.classList.add('hide');

                // Wait for transition to complete before cleaning up DOM node
                toast.addEventListener('transitionend', (e) => {
                    if (e.propertyName === 'max-height') {
                        toast.remove();
                    }
                });
            }

            // Initialize any notifications loaded on server render
            container.querySelectorAll('[x-init-toast]').forEach(initToastLifecycle);

            // Native MutationObserver: automatically tracks and initializes notifications 
            // dynamically appended later (via Custom JS updates, Livewire triggers, or Fetch API responses)
            const observer = new MutationObserver((mutations) => {
                mutations.forEach((mutation) => {
                    mutation.addedNodes.forEach((node) => {
                        if (node.nodeType === Node.ELEMENT_NODE) {
                            const target = node.hasAttribute('x-init-toast') ? node : node.querySelector('[x-init-toast]');
                            if (target) initToastLifecycle(target);
                        }
                    });
                });
            });

            observer.observe(container, { childList: true, subtree: true });
        });
    </script>

    @stack('scripts')
    @yield('modal-scripts')
</body>
</html>
