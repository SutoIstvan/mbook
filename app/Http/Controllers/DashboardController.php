<?php

namespace App\Http\Controllers;

use App\Models\Family;
use App\Models\Memorial;
use App\Models\Timeline;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Laravel\Facades\Image;

class DashboardController extends Controller
{


    public function index()
    {
        if (Auth::check()) {
            if (Auth::user()->role === 'admin') {
                return redirect()->route('admin.users');
            } 
            
            $user = Auth::user();
            $memorials = Memorial::where('admin_id', $user->id)->get();
            return view('dashboard.index', ['memorials' => $memorials]);
        }
        
        return redirect()->route('login');
    }
    
    

    public function edit(Memorial $memorial)
    {
        // dd([
        //     'user_id' => Auth::user()->id,
        //     'memorial_admin_id' => $memorial->admin_id,
        //     'user_role' => Auth::user()->role,
        //     'is_admin' => Auth::user()->role === 'admin',
        //     'is_owner' => Auth::user()->id === $memorial->admin_id
        // ]);

        if (Auth::user()->id !== $memorial->admin_id && Auth::user()->role !== 'admin') {
            abort(403);
        }


        // $user = Auth::user();
        // $isOwner = ($user->id === $memorial->admin_id);
        // $isAdmin = ($user->role === 'admin');
        
        // // Если пользователь НЕ владелец И НЕ админ
        // if (!$isOwner && !$isAdmin) {
        //     abort(403, 'Access Denied');
        // }
        // dd($memorial);
        return view('dashboard.edit', compact('memorial'));
    }

    public function settings(Memorial $memorial)
    {
        if (Auth::user()->id !== $memorial->admin_id && Auth::user()->role !== 'admin') {
            abort(403);
        }
        return view('dashboard.settings', compact('memorial'));
    }

    public function updateSettings(Request $request, Memorial $memorial)
    {
        // dd($request);
        $request->validate([
            'private' => 'nullable|string|max:255',
            'theme' => 'required|in:light,dark',
            'coordinates' => 'nullable|string|max:255',
            // 'slug' => 'required|string|alpha_dash|unique:memorials,slug,' . $memorial->id,
        ]);

        $memorial->update([
            'private' => $request->has('private'),
            'theme' => $request->input('theme'),
            'coordinates' => $request->input('coordinates'),
            // 'slug' => $request->input('slug'),
            // 'slug' => Str::slug($request->input('slug')),
        ]);

        // return redirect()->back()->with('success', __('Settings saved successfully!'));
        return redirect()->route('dashboard.settings', $memorial->slug)->with('success', __('Settings saved successfully!'));

    }

    public function family(Memorial $memorial)
    {
        $familyMembers = Family::where('memorial_id', $memorial->id)->get()->groupBy('role');

        return view('dashboard.family', compact('memorial', 'familyMembers'));
    }

    public function timeline(Memorial $memorial)
    {
        $familyMembers = Family::where('memorial_id', $memorial->id)->get()->groupBy('role');

        // $timelines = Timeline::where('memorial_id', $memorial->id)->get();
        $timelines = Timeline::where('memorial_id', $memorial->id)
            ->orderBy('date', 'asc')
            ->get();

        $children = Family::where('memorial_id', $memorial->id)
            ->where('role', 'children')
            ->get();

        $partners = Family::where('memorial_id', $memorial->id)
            ->where('role', 'partner')
            ->get();

        return view('dashboard.timeline', compact('memorial', 'familyMembers', 'children', 'timelines', 'partners'));
    }

    public function comments(Memorial $memorial)
    {
        if (Auth::user()->id !== $memorial->admin_id && Auth::user()->role !== 'admin') {
            abort(403);
        }
        
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
        if (Auth::user()->id !== $memorial->admin_id && Auth::user()->role !== 'admin') {
            abort(403);
        }

        return view('dashboard.video', compact('memorial'));
    }

    public function VideoBackground(Request $request, Memorial $memorial)
    {
        // dd($request);
        $request->validate([
            'video_thumbnail' => 'image|mimes:jpeg,png,jpg,gif|max:22048',
            'video' => 'nullable|string|max:255',
        ]);

        $memorial = Memorial::findOrFail($memorial->id);
        $memorial->video = $request->video;

            if ($request->hasFile('video_thumbnail')) {
                Storage::disk('memorial')->delete($memorial->slug . '/' . $memorial->video_thumbnail);

                $videoThumbnail = $request->file('video_thumbnail');
                $filename = $memorial->slug . '-' . substr(time(), -6) . '-video' . '.webp';// Имя файла: memorial-slug_timestamp.webp

                // Загружаем изображение
                $image = Image::read($videoThumbnail);

                // Масштабируем и конвертируем в WebP
                $image->scale(width: 1300)->toWebp(90);

                Storage::disk('memorial')->put(
                    $memorial->slug . '/' . $filename,
                    $image->encode()->__toString()
                );                
                // Сохраняем новое фото                
                $memorial->video_thumbnail = $filename;
            }
        $memorial->save();

        return redirect()->back()->with('success', 'A videó módosítások sikeresen frissítve!');
    }

    public function photos(Memorial $memorial)
    {
        if (Auth::user()->id !== $memorial->admin_id && Auth::user()->role !== 'admin') {
            abort(403);
        }

        return view('dashboard.photos', compact('memorial'));
    }

    public function help(Memorial $memorial)
    {
        return view('dashboard.help', compact('memorial'));
    }

    public function destroy(Memorial $memorial)
    {
        // Проверяем, принадлежит ли мемориал пользователю
        // if ($memorial->admin_id !== Auth::id()) {
        //     abort(403, 'У вас нет прав для удаления этого мемориала.');
        // }

        // Удаляем мемориал
        $memorial->delete();

        return redirect()->back()->with('success', __('Memorial deleted successfully'));

        return redirect()->route('dashboard')->with('success', 'Мемориал успешно удален.');
    }
}
