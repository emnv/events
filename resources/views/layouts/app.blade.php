<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 min-h-screen">
    <div id="app">
        <nav class="bg-white shadow-sm border-b border-gray-200">
            <div class="container mx-auto px-4">
                <div class="flex justify-between items-center h-16">
                    <!-- Logo/Brand -->
                    <a href="{{ url('/') }}" class="text-xl font-semibold text-gray-800 hover:text-gray-600 transition">
                        {{ config('app.name', 'Laravel') }}
                    </a>

                    <!-- Navigation Links -->
                    <div class="flex items-center gap-6">
                        @guest
                            @if (Route::has('login'))
                                <a href="{{ route('login') }}" class="text-gray-700 hover:text-gray-900 transition">
                                    {{ __('Login') }}
                                </a>
                            @endif

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="text-gray-700 hover:text-gray-900 transition">
                                    {{ __('Register') }}
                                </a>
                            @endif
                        @else
                            <a href="{{ route('events.index') }}" class="text-gray-700 hover:text-gray-900 transition">
                                {{ __('Events') }}
                            </a>

                            <!-- User Dropdown -->
                            <div class="relative group">
                                <button class="flex items-center gap-2 text-gray-700 hover:text-gray-900 transition">
                                    <span>{{ Auth::user()->name }}</span>
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </button>

                                <!-- Dropdown Menu -->
                                <div class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 hidden group-hover:block z-50">
                                    <a href="{{ route('logout') }}" 
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                       class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                                        @csrf
                                    </form>
                                </div>
                            </div>
                        @endguest
                    </div>
                </div>
            </div>
        </nav>

        <main class="py-8">
            @yield('content')
        </main>
    </div>
</body>
</html>
