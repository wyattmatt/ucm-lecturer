<?php

namespace App\Http\Controllers;

use App\Models\Lecturer;
use Illuminate\Http\Request;

class LecturerController extends Controller
{
    /**
     * Display the lecturers page
     */
    public function index()
    {
        $lecturers = Lecturer::orderBy('name')->get();

        return view('lecturers.index', compact('lecturers'));
    }
}
