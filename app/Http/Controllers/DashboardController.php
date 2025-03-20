<?php

namespace App\Http\Controllers;

use App\Models\Memorial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $memorials = Memorial::where('admin_id', $user->id)->get();

        return view('dashboard.index', compact('memorials'));
    }

    public function edit(Memorial $memorial)
    {
        // dd($memorial);
        return view('dashboard.edit', compact('memorial'));
    }

    public function settings(Memorial $memorial)
    {
        return view('dashboard.settings', compact('memorial'));
    }


    public function comments(Memorial $memorial)
    {
        $memorial = Memorial::where('id', $memorial->id)->firstOrFail();
        $comments = $memorial->comments()
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('dashboard.comments', [
            'memorial' => $memorial,
            'comments' => $comments
        ]);
    }

    public function video(Memorial $memorial)
    {
        return view('dashboard.video', compact('memorial'));
    }

    public function photos(Memorial $memorial)
    {
        return view('dashboard.photos', compact('memorial'));
    }

    public function help()
    {
        return view('dashboard.help');
    }
}
