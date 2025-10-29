<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LecturerController;

Route::get('/', [LecturerController::class, 'index'])->name('lecturers.index');
