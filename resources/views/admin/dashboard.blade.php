@extends('admin.layout')

@section('title', 'Dashboard Overview')
@section('page-title', 'Dashboard')
@section('page-description', 'Overview of your system statistics')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Total Events -->
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm font-medium">Total Events</p>
                <p class="text-3xl font-bold text-gray-900 mt-2">{{ $stats['total_events'] }}</p>
            </div>
            <div class="bg-blue-100 rounded-full p-3">
                <i class="bi bi-calendar-event text-blue-600 text-2xl"></i>
            </div>
        </div>
        <div class="mt-4">
            <span class="text-sm text-gray-600">{{ $stats['upcoming_events'] }} upcoming</span>
        </div>
    </div>

    <!-- Total Lecturers -->
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm font-medium">Total Lecturers</p>
                <p class="text-3xl font-bold text-gray-900 mt-2">{{ $stats['total_lecturers'] }}</p>
            </div>
            <div class="bg-green-100 rounded-full p-3">
                <i class="bi bi-person-video3 text-green-600 text-2xl"></i>
            </div>
        </div>
        <div class="mt-4">
            <a href="{{ route('admin.lecturers') }}" class="text-sm text-green-600 hover:text-green-700">View all →</a>
        </div>
    </div>

    <!-- Total Users -->
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm font-medium">Total Users</p>
                <p class="text-3xl font-bold text-gray-900 mt-2">{{ $stats['total_users'] }}</p>
            </div>
            <div class="bg-purple-100 rounded-full p-3">
                <i class="bi bi-people text-purple-600 text-2xl"></i>
            </div>
        </div>
        <div class="mt-4">
            <a href="{{ route('admin.users') }}" class="text-sm text-purple-600 hover:text-purple-700">Manage →</a>
        </div>
    </div>

    <!-- Quick Action -->
    <div class="bg-gradient-to-br from-[#1c3a6b] to-[#2d5a8f] rounded-lg shadow p-6 text-white">
        <div>
            <p class="text-white text-sm font-medium opacity-90">Quick Actions</p>
            <p class="text-2xl font-bold mt-2">Manage</p>
        </div>
        <div class="mt-4 space-y-2">
            <a href="{{ route('admin.events') }}" class="block text-sm text-white hover:text-blue-200">+ Add Event</a>
            <a href="{{ route('admin.lecturers') }}" class="block text-sm text-white hover:text-blue-200">+ Add Lecturer</a>
        </div>
    </div>
</div>

<!-- Recent Activity or Additional Info -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-bold text-gray-900 mb-4">
            <i class="bi bi-info-circle mr-2"></i>System Information
        </h3>
        <div class="space-y-3">
            <div class="flex justify-between">
                <span class="text-gray-600">Laravel Version</span>
                <span class="font-semibold">{{ app()->version() }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-gray-600">PHP Version</span>
                <span class="font-semibold">{{ PHP_VERSION }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-gray-600">Environment</span>
                <span class="font-semibold">{{ config('app.env') }}</span>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-bold text-gray-900 mb-4">
            <i class="bi bi-link-45deg mr-2"></i>Quick Links
        </h3>
        <div class="space-y-2">
            <a href="{{ route('lecturers.index') }}" target="_blank" class="block text-[#1c3a6b] hover:text-[#16325c] font-medium">
                <i class="bi bi-box-arrow-up-right mr-2"></i>View Public Site
            </a>
            <a href="{{ route('admin.events') }}" class="block text-[#1c3a6b] hover:text-[#16325c] font-medium">
                <i class="bi bi-calendar-event mr-2"></i>Manage Events
            </a>
            <a href="{{ route('admin.lecturers') }}" class="block text-[#1c3a6b] hover:text-[#16325c] font-medium">
                <i class="bi bi-person-video3 mr-2"></i>Manage Lecturers
            </a>
            <a href="{{ route('admin.users') }}" class="block text-[#1c3a6b] hover:text-[#16325c] font-medium">
                <i class="bi bi-people mr-2"></i>Manage Users
            </a>
        </div>
    </div>
</div>
@endsection

