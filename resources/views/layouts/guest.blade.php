<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Welcome to BMS Tailor Inventory Managenement') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col items-center pt-6 sm:pt-0 bg-gradient-to-br from-gray-50 to-gray-200">
            <div class="mt-6">
                <a href="/">
                    <x-application-logo class="w-20 h-20 fill-current text-blue-600" />
                </a>
            </div>

            <div class="w-full sm:max-w-4xl mt-6 flex flex-col md:flex-row overflow-hidden shadow-xl rounded-lg border border-gray-200">
                <div class="w-full md:w-1/2 bg-white px-8 py-10 border-r border-gray-200">
                    <div class="mb-4 pb-4 border-b border-gray-100">
                        <h2 class="text-2xl font-semibold text-gray-800">Welcome to</h2>
                        <p class="text-gray-600 mt-1">BMS Tailor Inventory Management</p>
                    </div>
                    {{ $slot }}
                </div>
                <div class="w-full md:w-1/2 bg-blue-50 flex items-center justify-center p-6">
                    <img src="{{ asset('images/login.png') }}" alt="Login Image" 
                        class="max-w-full h-auto object-cover rounded-lg shadow-md border border-gray-200 transition-transform hover:scale-105 duration-300">
                </div>
            </div>
            <div class="mt-4 text-sm text-gray-500">
                &copy; {{ date('Y') }} BMS Tailor. All rights reserved.
            </div>
        </div>
    </body>
</html>
