<?php

namespace App\Http\Controllers;

use App\Models\Family;
use App\Models\Memorial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;

class FamilyController extends Controller
{

    public function create(Memorial $memorial)
    {
        $familyMembers = Family::where('memorial_id', $memorial->id)->get()->groupBy('role');

        return view('memorial.family', compact('memorial', 'familyMembers'));
    }

    public function delete($id)
    {
        $familyMember = Family::findOrFail($id);
        $familyMember->delete();

        return redirect()->back()->with('success', 'Family member removed successfully.');
    }

    public function store(Request $request)
    {
        //  dd($request);
        $validated = $request->validate([
            'memorial_id' => 'required|exists:memorials,id',
            'name' => 'required|string',
            'role' => 'required|string',
        ]);

        Family::create($validated);

        return redirect()->route('family.create', $request->memorial_id)->with('success', 'Family member added successfully.');
    }
    
    public function dashboardstore(Request $request)
    {
        // dd($request);
        $validated = $request->validate([
            'memorial_id' => 'required|exists:memorials,id',
            'role' => 'required|string',
            'name' => 'nullable|string|max:255',
        ]);

        Family::create([
            'memorial_id' => $validated['memorial_id'],
            'role' => $validated['role'],
            'name' => $validated['name'] ?? '',
        ]);

        // Family::create($validated);

        return redirect()->route('dashboard.family', $request->memorial_id)->with('success', 'Family member added successfully.');
    }

    public function update(Request $request, Memorial $memorial)
    {
        // dd($request);

        $request->validate([
            'names' => 'array',
            'names.*' => 'nullable|string|max:255',
            'images' => 'array',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
        ]);

        

        foreach ($request->input('names', []) as $key => $name) {
            if (trim($name) === '') {
                continue; // не сохраняем пустые имена
            }

            if (is_numeric($key)) {
                $member = Family::find($key);
                if ($member && $member->memorial_id === $memorial->id) {
                    $member->name = $name;
                    $member->save();
                }
            } else {
                Family::updateOrCreate(
                    [
                        'memorial_id' => $memorial->id,
                        'role' => $key,
                    ],
                    [
                        'name' => $name,
                    ]
                );
            }
        }


        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $key => $imageFile) {
                if (!$imageFile) continue;

                $filename = $memorial->slug . '/' . $key . '-' . time() . '.webp';
                $image = Image::read($imageFile)->scale(width: 800)->toWebp(90);
                Storage::disk('memorial')->put($filename, $image);

                $member = null;

                // Пример: partner_0, child_1, etc.
                if (preg_match('/^([a-z_]+)_(\d+)$/', $key, $matches)) {
                    $group = $matches[1]; // partner
                    $index = $matches[2]; // 0

                    $groupData = $request->input($group . 's', []); // partners, children, etc.
                    $memberId = $groupData[$index]['id'] ?? null;

                    if ($memberId) {
                        $member = Family::find($memberId);
                    }
                } elseif (is_numeric($key)) {
                    $member = Family::find($key);
                } else {
                    $member = Family::where('memorial_id', $memorial->id)->where('role', $key)->first();
                }

                if ($member) {
                    $member->photo = $filename;
                    $member->save();
                }
            }
        }



        return redirect()->back()->with('success', 'Семья сохранена');
    }


    public function list(Memorial $memorial)
    {
        $members = Family::where('memorial_id', $memorial->id)->get()->groupBy('role');
        return response()->json($members);
    }
}
