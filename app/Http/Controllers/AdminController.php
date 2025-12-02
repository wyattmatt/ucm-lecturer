<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Lecturer;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display dashboard overview
     */
    public function index()
    {
        $stats = [
            'total_events' => Event::count(),
            'upcoming_events' => Event::where('start_date', '>=', now())->count(),
            'total_lecturers' => Lecturer::count(),
            'total_users' => User::count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }

    /**
     * Display events management page
     */
    public function events()
    {
        return view('admin.events');
    }

    /**
     * Display lecturers management page
     */
    public function lecturers()
    {
        return view('admin.lecturers');
    }

    /**
     * Display users management page
     */
    public function users()
    {
        return view('admin.users');
    }
}
