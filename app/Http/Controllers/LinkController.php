<?php

namespace App\Http\Controllers;

use App\Models\Link;
use App\Models\Memorial;
use Illuminate\Http\Request;

class LinkController extends Controller
{
    public function storevideo(Request $request)
    {
        $validated = $request->validate([
            'memorial_id' => 'required|exists:memorials,id',
            'youtube_link' => 'required|url',
            'description' => 'nullable|string|max:1000',
        ]);

        Link::create([
            'memorial_id' => $validated['memorial_id'],
            'title' => 'YouTube video',
            'description' => $validated['description'] ?? null,
            'type' => 'video',
            'url' => $validated['youtube_link'],
        ]);

        return redirect()->back()->with('success', 'A videó sikeresen hozzá lett adva.')->with('tab', 'videos');
    }

    public function storemusic(Request $request)
    {
        $validated = $request->validate([
            'memorial_id' => 'required|exists:memorials,id',
            'youtube_link' => 'required|url',
            'description' => 'nullable|string|max:1000',
        ]);

        Link::create([
            'memorial_id' => $validated['memorial_id'],
            'title' => 'YouTube music',
            'description' => $validated['description'] ?? null,
            'type' => 'music',
            'url' => $validated['youtube_link'],
        ]);

        return redirect()->back()->with('success', 'A videó sikeresen hozzá lett adva.')->with('tab', 'music');
    }

    public function storelink(Request $request)
    {
        $validated = $request->validate([
            'memorial_id' => 'required|exists:memorials,id',
            'youtube_link' => 'required|url',
            'description' => 'nullable|string|max:1000',
        ]);

        Link::create([
            'memorial_id' => $validated['memorial_id'],
            'title' => 'website link',
            'description' => $validated['description'] ?? null,
            'type' => 'link',
            'url' => $validated['youtube_link'],
        ]);

        return redirect()->back()->with('success', 'A videó sikeresen hozzá lett adva.')->with('tab', 'link');
    }

    public function storeplace(Request $request)
    {
        $validated = $request->validate([
            'memorial_id' => 'required|exists:memorials,id',
            'youtube_link' => 'required|url',
            'description' => 'nullable|string|max:1000',
        ]);

        Link::create([
            'memorial_id' => $validated['memorial_id'],
            'title' => 'website link',
            'description' => $validated['description'] ?? null,
            'type' => 'link',
            'url' => $validated['youtube_link'],
        ]);

        return redirect()->back()->with('success', 'A videó sikeresen hozzá lett adva.')->with('tab', 'link');
    }

    public function place(Memorial $memorial)
    {
        // $familyMembers = Family::where('memorial_id', $memorial->id)->get()->groupBy('role');



        return view('memorial.restingplace', compact('memorial'));
    } 
}
