<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Dashboard') - UCM</title>
    <link rel="icon" type="image/png" href="{{ asset('images/fav.ico') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .modal { display: none; }
        .modal.active { display: flex; }
        .bottom-nav-item.active { color: #1c3a6b; }
    </style>
    @stack('styles')
</head>
<body class="bg-gray-50">
    <div class="flex flex-col lg:flex-row h-screen">
        <!-- Sidebar (Desktop Only) -->
        <aside class="hidden lg:flex w-64 bg-white shadow-lg">
            <div class="h-full flex flex-col w-full">
                <!-- Logo/Brand -->
                <div class="p-6 bg-[#1c3a6b]">
                    <h1 class="text-white text-xl font-bold">UCM Admin</h1>
                    <p class="text-blue-200 text-sm mt-1">Management System</p>
                </div>

                <!-- Navigation -->
                <nav class="flex-1 p-4 space-y-2 overflow-y-auto">
                    <a href="{{ route('admin.dashboard') }}" class="sidebar-link flex items-center px-4 py-3 text-gray-700 rounded-lg transition {{ request()->routeIs('admin.dashboard') ? 'bg-[#1c3a6b] text-white hover:bg-[#16325c]' : 'hover:bg-gray-100' }}">
                        <i class="bi bi-speedometer2 mr-3"></i>
                        <span>Dashboard</span>
                    </a>
                    <a href="{{ route('admin.events') }}" class="sidebar-link flex items-center px-4 py-3 text-gray-700 rounded-lg transition {{ request()->routeIs('admin.events') ? 'bg-[#1c3a6b] text-white hover:bg-[#16325c]' : 'hover:bg-gray-100' }}">
                        <i class="bi bi-calendar-event mr-3"></i>
                        <span>Events</span>
                    </a>
                    <a href="{{ route('admin.lecturers') }}" class="sidebar-link flex items-center px-4 py-3 text-gray-700 rounded-lg transition {{ request()->routeIs('admin.lecturers') ? 'bg-[#1c3a6b] text-white hover:bg-[#16325c]' : 'hover:bg-gray-100' }}">
                        <i class="bi bi-person-video3 mr-3"></i>
                        <span>Lecturers</span>
                    </a>
                    <a href="{{ route('admin.users') }}" class="sidebar-link flex items-center px-4 py-3 text-gray-700 rounded-lg transition {{ request()->routeIs('admin.users') ? 'bg-[#1c3a6b] text-white hover:bg-[#16325c]' : 'hover:bg-gray-100' }}">
                        <i class="bi bi-people mr-3"></i>
                        <span>Users</span>
                    </a>
                </nav>

                <!-- User Info & Logout -->
                <div class="p-4 border-t">
                    <div class="flex items-center justify-between mb-3">
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-semibold text-gray-900 truncate">{{ auth()->user()->name }}</p>
                            <p class="text-xs text-gray-500">{{ ucfirst(auth()->user()->role) }}</p>
                        </div>
                    </div>
                    <form action="{{ route('logout') }}" method="POST" id="desktopLogoutForm">
                        @csrf
                        <button type="submit" class="w-full flex items-center justify-center px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition text-sm font-semibold">
                            <i class="bi bi-box-arrow-right mr-2"></i>
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 overflow-y-auto pb-20 lg:pb-0">
            <!-- Top Bar -->
            <header class="bg-white shadow-sm">
                <div class="px-4 sm:px-8 py-4">
                    <h2 class="text-xl sm:text-2xl font-bold text-gray-900">@yield('page-title', 'Dashboard')</h2>
                    <p class="text-gray-600 text-sm mt-1">@yield('page-description', 'Welcome to UCM Admin Dashboard')</p>
                </div>
            </header>

            <!-- Page Content -->
            <div class="p-4 sm:p-8">
                @yield('content')
            </div>
        </main>
    </div>

    <!-- Bottom Navigation (Mobile Only) -->
    <nav class="lg:hidden fixed bottom-0 left-0 right-0 bg-white border-t border-gray-200 shadow-lg z-50">
        <div class="flex justify-around items-center h-16">
            <a href="{{ route('admin.dashboard') }}" class="bottom-nav-item flex flex-col items-center justify-center flex-1 text-gray-600 {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2 text-xl"></i>
                <span class="text-xs mt-1">Dashboard</span>
            </a>
            <a href="{{ route('admin.events') }}" class="bottom-nav-item flex flex-col items-center justify-center flex-1 text-gray-600 {{ request()->routeIs('admin.events') ? 'active' : '' }}">
                <i class="bi bi-calendar-event text-xl"></i>
                <span class="text-xs mt-1">Events</span>
            </a>
            <a href="{{ route('admin.lecturers') }}" class="bottom-nav-item flex flex-col items-center justify-center flex-1 text-gray-600 {{ request()->routeIs('admin.lecturers') ? 'active' : '' }}">
                <i class="bi bi-person-video3 text-xl"></i>
                <span class="text-xs mt-1">Lecturers</span>
            </a>
            <a href="{{ route('admin.users') }}" class="bottom-nav-item flex flex-col items-center justify-center flex-1 text-gray-600 {{ request()->routeIs('admin.users') ? 'active' : '' }}">
                <i class="bi bi-people text-xl"></i>
                <span class="text-xs mt-1">Users</span>
            </a>
            <button onclick="confirmLogout()" class="bottom-nav-item flex flex-col items-center justify-center flex-1 text-gray-600">
                <i class="bi bi-box-arrow-right text-xl"></i>
                <span class="text-xs mt-1">Logout</span>
            </button>
        </div>
    </nav>

    <form action="{{ route('logout') }}" method="POST" id="mobileLogoutForm" class="hidden">
        @csrf
    </form>

    <script>
        // Mobile logout confirmation
        function confirmLogout() {
            Swal.fire({
                title: 'Logout',
                text: 'Are you sure you want to logout?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#1c3a6b',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Yes, logout',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('mobileLogoutForm').submit();
                }
            });
        }
    </script>

    @stack('scripts')
</body>
</html>
