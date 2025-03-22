<?php

namespace App\Http\Controllers;

use App\Models\Memorial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Laravel\Facades\Image;

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

    public function updateSettings(Request $request, Memorial $memorial)
    {
        // dd($request);
        $request->validate([
            'private' => 'nullable|string|max:255',
            'theme' => 'required|in:light,dark',
            'map_address' => 'nullable|string|max:255',
            'slug' => 'required|string|alpha_dash|unique:memorials,slug,' . $memorial->id,
        ]);

        $memorial->update([
            'history' => $request->has('private'),
            'testimonials' => $request->input('theme'),
            'story' => $request->input('map_address'),
            // 'slug' => $request->input('slug'),
            'slug' => Str::slug($request->input('slug')),
        ]);

        // return redirect()->back()->with('success', __('Settings saved successfully!'));
        return redirect()->route('dashboard.settings', $memorial->slug)->with('success', __('Settings saved successfully!'));

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

    public function VideoBackground(Request $request, Memorial $memorial)
    {
        // dd($request);
        $request->validate([
            'video_photos' => 'image|mimes:jpeg,png,jpg,gif|max:22048',
            'video' => 'nullable|string|max:255',
        ]);

        $memorial = Memorial::findOrFail($memorial->id);
        $memorial->video = $request->video;

            if ($request->hasFile('video_photos')) {
                $photo = $request->file('video_photos');
                $originalName = pathinfo($photo->getClientOriginalName(), PATHINFO_FILENAME);
                $slugName = Str::slug($originalName);
                $filename = $slugName . '_' . time() . '.png';
                
                // Создаем путь с ID мемориала
                $path = 'images/memorials/' . $memorial->id;
                
                $image = Image::read($photo)
                    ->scale(width: 1300)
                    ->toWebp(90);
                
                // Сохраняем новое фото
                Storage::disk('public')->put($path . '/' . $filename, $image->toString());
                
                $memorial->photos = $filename;
                $memorial->save();
            }
        $memorial->save();

        return redirect()->back()->with('success', 'A videó módosítások sikeresen frissítve!');
    }

    public function photos(Memorial $memorial)
    {
        return view('dashboard.photos', compact('memorial'));
    }

    public function help(Memorial $memorial)
    {
        return view('dashboard.help', compact('memorial'));
    }
}
