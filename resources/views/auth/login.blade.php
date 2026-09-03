<!DOCTYPE html>
<html lang="en" class="h-full bg-brand-light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | PMC Inventory System</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full flex items-center justify-center px-4 sm:px-6 lg:px-8">

    <div class="w-full max-w-md space-y-8 bg-white p-8 rounded-2xl shadow-xl border border-gray-100">
        
        <!-- Logo & Header Section -->
        <div class="text-center">
            <!-- 
              Replace the placeholder below with your actual image asset:
              <img class="mx-auto h-16 w-auto" src="{{ asset('images/logow.png') }}" alt="PMC Logo">
            -->
            <div class="mx-auto h-32 w-32 flex items-center justify-center">
                <img src="{{ asset('assets/images/pmc-logo.png') }}"/>
            </div>
            
            <h2 class="mt-6 text-2xl font-bold tracking-tight text-brand-navy">
                Sign in to your account
            </h2>
            <p class="mt-2 text-sm text-gray-500">
                PMC Inventory & User Management System
            </p>
        </div>

        <!-- Session Status / Validation Errors (Standard Laravel Session handling) -->
        @if (session('status'))
            <div class="bg-green-50 border border-brand-green/30 text-brand-green text-sm p-4 rounded-lg">
                {{ session('status') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-amber-50 border border-brand-gold/30 text-amber-900 text-sm p-4 rounded-lg space-y-1">
                @foreach ($errors->all() as $error)
                    <p>• {{ $error }}</p>
                @endforeach
            </div>
        @endif

        <!-- Login Form -->
        <form class="mt-8 space-y-6" action="{{ route('authenticate') }}" method="POST">
            @csrf
            <!-- <input type="hidden" name="remember" value="true"> -->
            
            <div class="space-y-4 rounded-md shadow-xs">
                <!-- Email/Username Input -->
                <div>
                    <label for="username" class="block text-sm font-semibold text-brand-dark mb-1">Username</label>
                    <input id="username" name="username" type="username" autocomplete="username" required 
                        value="{{ old('username') }}"
                        class="block w-full rounded-lg border border-gray-300 px-3 py-2.5 text-brand-dark placeholder-gray-400 focus:border-brand-gold focus:outline-none focus:ring-2 focus:ring-brand-gold/20 sm:text-sm transition" 
                        placeholder="name@company.com">
                </div>
                
                <!-- Password Input -->
                <div>
                    <div class="flex items-center justify-between mb-1">
                        <label for="password" class="block text-sm font-semibold text-brand-dark">Password</label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-xs font-semibold text-brand-gold hover:text-brand-gold-hover transition">
                                Forgot password?
                            </a>
                        @endif
                    </div>
                    <input id="password" name="password" type="password" autocomplete="current-password" required 
                        class="block w-full rounded-lg border border-gray-300 px-3 py-2.5 text-brand-dark placeholder-gray-400 focus:border-brand-gold focus:outline-none focus:ring-2 focus:ring-brand-gold/20 sm:text-sm transition" 
                        placeholder="••••••••">
                </div>
            </div>

            <!-- Remember Me Toggle -->
            <!-- <div class="flex items-center">
                <input id="remember_me" name="remember" type="checkbox" 
                    class="h-4 w-4 rounded border-gray-300 text-brand-green focus:ring-brand-green transition">
                <label for="remember_me" class="ml-2 block text-sm text-gray-600 select-none">
                    Remember my session on this device
                </label>
            </div> -->

            <!-- Submit Action Button (Using Brand Gold & Hover States) -->
            <div>
                <button type="submit" 
                    class="group relative flex w-full justify-center rounded-lg bg-brand-gold px-4 py-3 text-sm font-bold text-white shadow-md hover:bg-brand-gold-hover focus:outline-none focus:ring-2 focus:ring-brand-gold focus:ring-offset-2 transition cursor-pointer">
                    Sign In
                </button>
            </div>
        </form>

    </div>

</body>
</html>