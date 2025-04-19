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
        // dd($request);
        $validated = $request->validate([
            'memorial_id' => 'required|exists:memorials,id',
            'grave_location' => 'nullable|string|max:1000',
            'coordinates' => 'nullable|string|max:1000',
            'grave_parcel' => 'nullable|string|max:1000',
            'grave_line' => 'nullable|string|max:1000',
            'grave_number' => 'nullable|string|max:1000',
        ]);


        // Находим запись по memorial_id
        $memorial = Memorial::findOrFail($validated['memorial_id']);

        // Обновляем запись
        $memorial->update([
            'grave_location' => $validated['grave_location'],
            'grave_parcel' => $validated['grave_parcel'],
            'grave_line' => $validated['grave_line'],
            'grave_number' => $validated['grave_number'],
            'coordinates' => $validated['coordinates'],
        ]);

        return redirect()->back()->with('success', 'A nyughely adata sikeresen hozzá lett adva.');
    }

    public function place(Memorial $memorial)
    {
        // $familyMembers = Family::where('memorial_id', $memorial->id)->get()->groupBy('role');



        return view('memorial.restingplace', compact('memorial'));
    } 

    public function preview(Memorial $memorial)
    {

        return view('memorial.createpreview', compact('memorial'));
    } 
}
