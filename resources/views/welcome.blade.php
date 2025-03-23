<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>BMS Tailor - Tailored to Perfection</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
            <style>
                /* Tailwind styles */
                /* ... (original styles) ... */
            </style>
        @endif
        <!-- Additional custom styles -->
        <style>
            .bg-tailor-primary {
                background-color: #595b5e;
            }
            .bg-tailor-secondary {
                background-color: #E2E8F0;
            }
            .text-tailor-primary {
                color: #425e88;
            }
            .text-tailor-accent {
                color: #3B82F6;
            }
            .btn-tailor {
                transition: all 0.3s ease;
                @apply px-6 py-2 rounded font-medium;
            }
            .btn-tailor-primary {
                @apply bg-tailor-primary text-white hover:bg-blue-700;
            }
            .hero-pattern {
                background-color: #5b80bc;
                background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%233B82F6' fill-opacity='0.1'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
            }
        </style>
    </head>
    <body class="bg-gray-50 dark:bg-gray-900 text-gray-800 dark:text-gray-200 antialiased">
        <div class="min-h-screen flex flex-col">
            <!-- Header/Navigation -->
            <header class="bg-white dark:bg-gray-800 shadow">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex justify-between items-center">
                    <div class="flex items-center">
                        <!-- Logo -->
                        <div class="flex-shrink-0">
                            <h1 class="text-2xl font-bold text-tailor-primary dark:text-white">BMS <span class="text-tailor-accent">Tailor</span></h1>
                        </div>
                    </div>
                    
                    <!-- Navigation -->
                    <nav class="flex space-x-4">
                        @if (Route::has('login'))
                            <div class="flex items-center space-x-4">
                                @auth
                                    <a href="{{ url('/dashboard') }}" class="btn-tailor btn-tailor-primary">Dashboard</a>
                                @else
                                    <a href="{{ route('login') }}" class="btn-tailor btn-tailor-primary">Log in</a>
                                @endauth
                            </div>
                        @endif
                    </nav>
                </div>
            </header>

            <!-- Hero Section -->
            <div class="bg-white text-gray-800 border-b py-16">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="text-center mb-8">
                        <h2 class="text-4xl sm:text-5xl font-bold text-gray-800">BMS Tailor Inventory Management</h2>
                        <p class="text-xl text-gray-600 mt-4">Streamline your tailoring operations with our inventory management system</p>
                    </div>
                    
                    <div class="flex justify-center mt-8">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="btn-tailor bg-blue-600 text-white hover:bg-blue-700 text-lg px-8 py-3">Go to Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="btn-tailor bg-blue-600 text-white hover:bg-blue-700 text-lg px-8 py-3">Access System</a>
                        @endauth
                    </div>
                </div>
            </div>

            <!-- Features Section -->
            <section class="py-16 bg-gray-50">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="text-center mb-12">
                        <h2 class="text-3xl font-bold text-gray-800">System Features</h2>
                        <p class="mt-4 text-lg text-gray-600">Designed specifically for tailoring businesses</p>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        <!-- Feature 1 -->
                        <div class="bg-white p-6 rounded-lg shadow-md">
                            <div class="text-blue-600 mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-semibold text-gray-800">Customer Management</h3>
                            <p class="mt-2 text-gray-600">Track customer measurements and order history in one place.</p>
                        </div>
                        
                        <!-- Feature 2 -->
                        <div class="bg-white p-6 rounded-lg shadow-md">
                            <div class="text-blue-600 mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-semibold text-gray-800">Inventory Tracking</h3>
                            <p class="mt-2 text-gray-600">Manage fabrics, threads, buttons, and other supplies with ease.</p>
                        </div>
                        
                        <!-- Feature 3 -->
                        <div class="bg-white p-6 rounded-lg shadow-md">
                            <div class="text-blue-600 mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-semibold text-gray-800">Order Management</h3>
                            <p class="mt-2 text-gray-600">Create and track orders, appointments, and delivery schedules.</p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Quick Stats Section -->
            <section class="bg-white py-12 border-t">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        <div class="bg-gray-50 p-6 rounded-lg shadow-sm text-center">
                            <div class="text-blue-600 text-3xl font-bold mb-2">Fabrics</div>
                            <p class="text-gray-600">Track fabric inventory</p>
                        </div>
                        
                        <div class="bg-gray-50 p-6 rounded-lg shadow-sm text-center">
                            <div class="text-blue-600 text-3xl font-bold mb-2">Measurements</div>
                            <p class="text-gray-600">Store customer sizes</p>
                        </div>
                        
                        <div class="bg-gray-50 p-6 rounded-lg shadow-sm text-center">
                            <div class="text-blue-600 text-3xl font-bold mb-2">Orders</div>
                            <p class="text-gray-600">Manage client orders</p>
                        </div>
                        
                        <div class="bg-gray-50 p-6 rounded-lg shadow-sm text-center">
                            <div class="text-blue-600 text-3xl font-bold mb-2">Reports</div>
                            <p class="text-gray-600">Generate inventory reports</p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Call To Action -->
            <section class="py-12 bg-blue-50">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                    <h2 class="text-3xl font-bold text-gray-800 mb-6">Ready to streamline your tailoring business?</h2>
                    <div class="flex justify-center">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="btn-tailor bg-blue-600 text-white hover:bg-blue-700 text-lg px-8 py-3">Go to Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="btn-tailor bg-blue-600 text-white hover:bg-blue-700 text-lg px-8 py-3">Get Started Now</a>
                        @endauth
                    </div>
                </div>
            </section>

            <!-- Footer -->
            <footer class="bg-white text-gray-800 py-6 border-t">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                    <p>BMS Tailor Inventory Management System</p>
                    <p class="text-sm text-gray-500 mt-2">© {{ date('Y') }} All rights reserved</p>
                </div>
            </footer>
        </div>
    </body>
</body>
