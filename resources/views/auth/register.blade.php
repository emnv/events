@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4">
        <div class="max-w-md mx-auto">
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                    <h2 class="text-xl font-semibold text-gray-800">{{ __('Register') }}</h2>
                </div>

                <div class="p-6">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="space-y-6">
                            <div>
                                <label for="name"
                                    class="block text-sm font-medium text-gray-700">{{ __('Name') }}</label>
                                <input id="name" type="text" name="name" value="{{ old('name') }}" required
                                    autocomplete="name" autofocus
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm @error('name') border-red-300 text-red-900 placeholder-red-300 focus:border-red-500 focus:ring-red-500 @enderror">
                                @error('name')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="email"
                                    class="block text-sm font-medium text-gray-700">{{ __('Email Address') }}</label>
                                <input id="email" type="email" name="email" value="{{ old('email') }}" required
                                    autocomplete="email"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm @error('email') border-red-300 text-red-900 placeholder-red-300 focus:border-red-500 focus:ring-red-500 @enderror">
                                @error('email')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="password"
                                    class="block text-sm font-medium text-gray-700">{{ __('Password') }}</label>
                                <input id="password" type="password" name="password" required autocomplete="new-password"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm @error('password') border-red-300 text-red-900 placeholder-red-300 focus:border-red-500 focus:ring-red-500 @enderror">
                                @error('password')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="password-confirm"
                                    class="block text-sm font-medium text-gray-700">{{ __('Confirm Password') }}</label>
                                <input id="password-confirm" type="password" name="password_confirmation" required
                                    autocomplete="new-password"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                            </div>

                            <div>
                                <button type="submit"
                                    class="w-full bg-blue-600 px-4 py-2 text-sm font-semibold text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
