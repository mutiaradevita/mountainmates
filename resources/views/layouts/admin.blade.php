<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title') - {{ config('app.name', 'Mountain Mates') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=Anton&family=Nunito:wght@300;400;500;600;700&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            .sidebar-transition {
                transition: all 0.3s ease-in-out;
            }
        </style>
    </head>
    <body class="font-nunito antialiased bg-snow">
        <div class="min-h-screen flex">
            <!-- Sidebar -->
            <aside id="sidebar" class="sidebar-transition fixed inset-y-0 left-0 z-50 w-64 bg-white shadow-lg transform -translate-x-full lg:translate-x-0 lg:static lg:inset-0">
                <!-- Logo Section -->
                <div class="flex items-center justify-between h-16 px-6 bg-forest">
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 bg-white rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-forest" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3l14 9-14 9V3z"></path>
                            </svg>
                        </div>
                        <span class="text-white font-bold text-lg">Mountain Mates</span>
                    </div>
                    <button id="closeSidebar" class="lg:hidden text-white hover:text-gray-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <!-- Navigation Menu -->
                <nav class="mt-6 px-4">
                    <div class="space-y-2">
                        <!-- Dashboard -->
                        <a href="{{ route('admin.dashboard') ?? '#' }}" class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h4a2 2 0 012 2v1H8V5z"></path>
                            </svg>
                            Dashboard
                        </a>

                        <!-- Trip Management -->
                        <div class="nav-group">
                            <button class="nav-dropdown-btn" onclick="toggleDropdown('tripDropdown')">
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    Kelola Trip
                                </div>
                                <svg class="w-4 h-4 transition-transform dropdown-arrow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div id="tripDropdown" class="nav-dropdown">
                                <a href="#" class="nav-dropdown-item">Semua Trip</a>
                                <a href="#" class="nav-dropdown-item">Tambah Trip</a>
                                <a href="#" class="nav-dropdown-item">Kategori Trip</a>
                                <a href="#" class="nav-dropdown-item">Trip Aktif</a>
                            </div>
                        </div>

                        <!-- Booking Management -->
                        <div class="nav-group">
                            <button class="nav-dropdown-btn" onclick="toggleDropdown('bookingDropdown')">
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    Kelola Booking
                                </div>
                                <svg class="w-4 h-4 transition-transform dropdown-arrow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div id="bookingDropdown" class="nav-dropdown">
                                <a href="#" class="nav-dropdown-item">Semua Booking</a>
                                <a href="#" class="nav-dropdown-item">Menunggu Konfirmasi</a>
                                <a href="#" class="nav-dropdown-item">Booking Hari Ini</a>
                                <a href="#" class="nav-dropdown-item">Riwayat Booking</a>
                            </div>
                        </div>

                        <!-- User Management -->
                        <a href="#" class="nav-item">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                            </svg>
                            Kelola Pengguna
                        </a>

                        <!-- Financial -->
                        <div class="nav-group">
                            <button class="nav-dropdown-btn" onclick="toggleDropdown('financeDropdown')">
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                    </svg>
                                    Keuangan
                                </div>
                                <svg class="w-4 h-4 transition-transform dropdown-arrow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div id="financeDropdown" class="nav-dropdown">
                                <a href="#" class="nav-dropdown-item">Laporan Pendapatan</a>
                                <a href="#" class="nav-dropdown-item">Pembayaran</a>
                                <a href="#" class="nav-dropdown-item">Refund</a>
                            </div>
                        </div>

                        <!-- Reports -->
                        <a href="#" class="nav-item">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                            Laporan
                        </a>

                        <!-- Settings -->
                        <div class="nav-group">
                            <button class="nav-dropdown-btn" onclick="toggleDropdown('settingsDropdown')">
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    Pengaturan
                                </div>
                                <svg class="w-4 h-4 transition-transform dropdown-arrow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div id="settingsDropdown" class="nav-dropdown">
                                <a href="#" class="nav-dropdown-item">Pengaturan Umum</a>
                                <a href="#" class="nav-dropdown-item">Pengaturan Email</a>
                                <a href="#" class="nav-dropdown-item">Backup Data</a>
                            </div>
                        </div>
                    </div>

                    <!-- Bottom Section -->
                    <div class="mt-auto pt-6 border-t border-gray-200">
                        <a href="{{ route('home') ?? '#' }}" class="nav-item">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                            Lihat Website
                        </a>
                    </div>
                </nav>
            </aside>

            <!-- Sidebar Overlay for Mobile -->
            <div id="sidebarOverlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 lg:hidden hidden"></div>

            <!-- Main Content -->
            <div class="flex-1 flex flex-col lg:ml-0">
                <!-- Top Navigation -->
                <header class="bg-white shadow-sm border-b border-gray-200 sticky top-0 z-30">
                    <div class="flex items-center justify-between h-16 px-6">
                        <!-- Mobile Menu Button -->
                        <button id="openSidebar" class="lg:hidden text-gray-600 hover:text-gray-900">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                            </svg>
                        </button>

                        <!-- Page Title -->
                        <div class="hidden lg:block">
                            <h1 class="text-xl font-semibold text-pine">@yield('page-title', 'Dashboard')</h1>
                        </div>

                        <!-- Right Section -->
                        <div class="flex items-center space-x-4">
                            <!-- Notifications -->
                            <button class="relative text-gray-600 hover:text-gray-900">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-5-5M5 12l10 10L5 12z"></path>
                                </svg>
                                <span class="absolute -top-1 -right-1 bg-sunset text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">3</span>
                            </button>

                            <!-- User Menu -->
                            <div class="relative">
                                <button id="userMenuBtn" class="flex items-center space-x-3 text-gray-700 hover:text-gray-900">
                                    <div class="w-8 h-8 bg-forest text-white rounded-full flex items-center justify-center">
                                        {{ substr(Auth::user()->name ?? 'A', 0, 1) }}
                                    </div>
                                    <span class="hidden md:block">{{ Auth::user()->name ?? 'Admin' }}</span>
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </button>

                                <!-- Dropdown -->
                                <div id="userMenu" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-2 z-50">
                                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profile</a>
                                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Pengaturan</a>
                                    <div class="border-t border-gray-100"></div>
                                    <form method="POST" action="{{ route('logout') ?? '#' }}">
                                        @csrf
                                        <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100">
                                            Logout
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </header>

                <!-- Page Content -->
                <main class="flex-1 overflow-x-hidden overflow-y-auto bg-snow">
                    @yield('content')
                </main>
            </div>
        </div>
    </body>
</html>