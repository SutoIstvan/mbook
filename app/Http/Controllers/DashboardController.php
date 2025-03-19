<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.index');
    }

    public function edit()
    {
        return view('dashboard.index');
    }

    public function settings()
    {
        return view('dashboard.settings');
    }

    public function comments()
    {
        return view('dashboard.comments');
    }

    public function video()
    {
        return view('dashboard.video');
    }

    public function photos()
    {
        return view('dashboard.photos');
    }

    public function help()
    {
        return view('dashboard.help');
    }
}
