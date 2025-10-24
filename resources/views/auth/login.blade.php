@extends('layouts.app')

@section('content')
<div class="min-h-screen from-indigo-100 via-white to-indigo-50 flex items-center justify-center px-4">
    <div class="bg-white/80 backdrop-blur-lg shadow-2xl rounded-2xl p-10 w-full max-w-md border border-gray-200">
        <!-- Logo or App Title -->
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Welcome Back</h1>
            <p class="text-gray-500 mt-2 text-sm">Sign in to continue to your dashboard</p>
        </div>

        <!-- Login Form -->
        <form method="POST" action="{{ route('login') }}" class="space-y-6" autocomplete="off">
            @csrf

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                    Email Address
                </label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg text-gray-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 placeholder-gray-400 shadow-sm transition">
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                    Password
                </label>
                <input id="password" type="password" name="password" required autocomplete="current-password"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg text-gray-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 placeholder-gray-400 shadow-sm transition">
                @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Remember & Forgot -->
            <div class="flex items-center justify-between text-sm">
                <label class="inline-flex items-center text-gray-600">
                    <input type="checkbox" name="remember"
                        class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"
                        {{ old('remember') ? 'checked' : '' }}>
                    <span class="ml-2">Remember me</span>
                </label>

                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-indigo-600 hover:text-indigo-700 font-medium">
                        Forgot Password?
                    </a>
                @endif
            </div>

            <!-- Submit Button -->
            <button type="submit"
                class="w-full bg-indigo-600 hover:bg-indigo-500 text-white font-semibold py-2.5 rounded-lg shadow-md transition duration-150">
                {{ __('Login') }}
            </button>
        </form>

        <!-- Register Redirect -->
        @if (Route::has('register'))
            <p class="text-center text-gray-600 text-sm mt-6">
                Don’t have an account?
                <a href="{{ route('register') }}" class="text-indigo-600 hover:text-indigo-700 font-semibold">
                    Create one
                </a>
            </p>
        @endif
    </div>
</div>
@endsection
