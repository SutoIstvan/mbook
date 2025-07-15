<?php

namespace App\Http\Controllers;

use App\Models\Family;
use App\Models\Memorial;
use Illuminate\Http\Request;

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
            'name' => 'required|string',
            'role' => 'required|string',
        ]);

        Family::create($validated);

        return redirect()->route('dashboard.family', $request->memorial_id)->with('success', 'Family member added successfully.');
    }

    public function update(Request $request, Memorial $memorial)
    {
        // dd($request);
        $request->validate([
            'names' => 'array',
            'names.*' => 'nullable|string|max:255',
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

        return redirect()->back()->with('success', 'Семья сохранена');
    }


    public function list(Memorial $memorial)
    {
        $members = Family::where('memorial_id', $memorial->id)->get()->groupBy('role');
        return response()->json($members);
    }
}
