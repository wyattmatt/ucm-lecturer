<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LecturerController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\UserController;

// Public routes
Route::get('/', [LecturerController::class, 'index'])->name('lecturers.index');

// Auth routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin routes (protected)
Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/events', [AdminController::class, 'events'])->name('admin.events');
    Route::get('/lecturers', [AdminController::class, 'lecturers'])->name('admin.lecturers');
    Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
});

// API routes
Route::prefix('api')->group(function () {
    // Public API
    Route::get('/public/events', [EventController::class, 'index'])->name('api.events.public');
    Route::get('/public/lecturers', [LecturerController::class, 'apiIndex'])->name('api.lecturers.public');
    Route::get('/public/data', [LecturerController::class, 'apiData'])->name('api.data.public');

    // Protected API (requires authentication)
    Route::middleware(['auth'])->group(function () {
        Route::apiResource('events', EventController::class);
        Route::apiResource('lecturers', LecturerController::class)->except(['index']);
        Route::apiResource('users', UserController::class);
    });
});
