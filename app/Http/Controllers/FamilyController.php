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

    // public function update(Request $request, Memorial $memorial)
    // {
    //     dd($request);

    //     $request->validate([
    //         'names' => 'array',
    //         'names.*' => 'nullable|string|max:255',
    //         'images' => 'array',
    //         'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
    //     ]);



    //     foreach ($request->input('names', []) as $key => $name) {
    //         if (trim($name) === '') {
    //             continue; // не сохраняем пустые имена
    //         }

    //         if (is_numeric($key)) {
    //             $member = Family::find($key);
    //             if ($member && $member->memorial_id === $memorial->id) {
    //                 $member->name = $name;
    //                 $member->save();
    //             }
    //         } else {
    //             Family::updateOrCreate(
    //                 [
    //                     'memorial_id' => $memorial->id,
    //                     'role' => $key,
    //                 ],
    //                 [
    //                     'name' => $name,
    //                 ]
    //             );
    //         }
    //     }


    //     if ($request->hasFile('images')) {
    //         foreach ($request->file('images') as $key => $imageFile) {
    //             if (!$imageFile) continue;

    //             $filename = $memorial->slug . '/' . $key . '-' . time() . '.webp';
    //             $image = Image::read($imageFile)->scale(width: 800)->toWebp(90);
    //             Storage::disk('memorial')->put($filename, $image);

    //             $member = null;

    //             // Пример: partner_0, child_1, etc.
    //             if (preg_match('/^([a-z_]+)_(\d+)$/', $key, $matches)) {
    //                 $group = $matches[1]; // partner
    //                 $index = $matches[2]; // 0

    //                 $groupData = $request->input($group . 's', []); // partners, children, etc.
    //                 $memberId = $groupData[$index]['id'] ?? null;

    //                 if ($memberId) {
    //                     $member = Family::find($memberId);
    //                 }
    //             } elseif (is_numeric($key)) {
    //                 $member = Family::find($key);
    //             } else {
    //                 $member = Family::where('memorial_id', $memorial->id)->where('role', $key)->first();
    //             }

    //             if ($member) {
    //                 $member->photo = $filename;
    //                 $member->save();
    //             }
    //         }
    //     }



    //     return redirect()->back()->with('success', 'Семья сохранена');
    // }

    // public function update(Request $request, Memorial $memorial)
    // {
    //     dd($request);

    //     $request->validate([
    //         'names' => 'array',
    //         'names.*' => 'nullable|string|max:255',
    //         'childrens' => 'array',
    //         'childrens.*.name' => 'nullable|string|max:255',
    //         'childrens.*.id' => 'required|exists:family,id',
    //         'partners' => 'array',
    //         'partners.*.name' => 'nullable|string|max:255',
    //         'partners.*.id' => 'required|exists:family,id',
    //         'siblings' => 'array',
    //         'siblings.*.name' => 'nullable|string|max:255',
    //         'siblings.*.id' => 'required|exists:family,id',
    //         'images' => 'array',
    //         'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
    //     ]);

    //     // Обработка массива names (для основных ролей)
    //     foreach ($request->input('names', []) as $key => $name) {
    //         if (trim($name) === '') {
    //             continue; // не сохраняем пустые имена
    //         }

    //         if (is_numeric($key)) {
    //             $member = Family::find($key);
    //             if ($member && $member->memorial_id === $memorial->id) {
    //                 $member->name = $name;
    //                 $member->save();
    //             }
    //         } else {
    //             Family::updateOrCreate(
    //                 [
    //                     'memorial_id' => $memorial->id,
    //                     'role' => $key,
    //                 ],
    //                 [
    //                     'name' => $name,
    //                 ]
    //             );
    //         }
    //     }

    //     // Обработка детей
    //     foreach ($request->input('childrens', []) as $childData) {
    //         if (!isset($childData['id']) || trim($childData['name'] ?? '') === '') {
    //             continue;
    //         }

    //         $member = Family::find($childData['id']);
    //         if ($member && $member->memorial_id === $memorial->id) {
    //             $member->name = $childData['name'];
    //             $member->save();
    //         }
    //     }

    //     // Обработка партнеров
    //     foreach ($request->input('partners', []) as $partnerData) {
    //         if (!isset($partnerData['id']) || trim($partnerData['name'] ?? '') === '') {
    //             continue;
    //         }

    //         $member = Family::find($partnerData['id']);
    //         if ($member && $member->memorial_id === $memorial->id) {
    //             $member->name = $partnerData['name'];
    //             $member->save();
    //         }
    //     }

    //     // Обработка братьев/сестер
    //     foreach ($request->input('siblings', []) as $siblingData) {
    //         if (!isset($siblingData['id']) || trim($siblingData['name'] ?? '') === '') {
    //             continue;
    //         }

    //         $member = Family::find($siblingData['id']);
    //         if ($member && $member->memorial_id === $memorial->id) {
    //             $member->name = $siblingData['name'];
    //             $member->save();
    //         }
    //     }

    //     // Обработка изображений
    //     if ($request->hasFile('images')) {
    //         foreach ($request->file('images') as $key => $imageFile) {
    //             if (!$imageFile) continue;

    //             $filename = $memorial->slug . '/' . $key . '-' . time() . '.webp';
    //             $image = Image::read($imageFile)->scale(width: 800)->toWebp(90);
    //             Storage::disk('memorial')->put($filename, $image);

    //             $member = null;

    //             // Пример: children_0, partner_1, etc.
    //             if (preg_match('/^([a-z_]+)_(\d+)$/', $key, $matches)) {
    //                 $group = $matches[1]; // children
    //                 $index = $matches[2]; // 0

    //                 $groupData = $request->input($group . 's', []); // childrens, partners, etc.
    //                 $memberId = $groupData[$index]['id'] ?? null;

    //                 if ($memberId) {
    //                     $member = Family::find($memberId);
    //                 }
    //             } elseif (is_numeric($key)) {
    //                 $member = Family::find($key);
    //             } else {
    //                 $member = Family::where('memorial_id', $memorial->id)->where('role', $key)->first();
    //             }

    //             if ($member) {
    //                 $member->photo = $filename;
    //                 $member->save();
    //             }
    //         }
    //     }

    //     return redirect()->back()->with('success', 'Семья сохранена');
    // }

public function update(Request $request, Memorial $memorial)
{
    // dd($request);

    $request->validate([
        'names' => 'array',
        'names.*' => 'nullable|string|max:255',
        'childrens' => 'array',
        'childrens.*.name' => 'nullable|string|max:255',
        'childrens.*.id' => 'required|exists:family,id',
        'partners' => 'array',
        'partners.*.name' => 'nullable|string|max:255',
        'partners.*.id' => 'required|exists:family,id',
        'siblings' => 'array',
        'siblings.*.name' => 'nullable|string|max:255',
        'siblings.*.id' => 'required|exists:family,id',
        'images' => 'array',
        'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
    ]);

    // Обработка массива names (для основных ролей)
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

    // Обработка детей
    foreach ($request->input('childrens', []) as $childData) {
        if (!isset($childData['id']) || trim($childData['name'] ?? '') === '') {
            continue;
        }

        $member = Family::find($childData['id']);
        if ($member && $member->memorial_id === $memorial->id) {
            $member->name = $childData['name'];
            $member->save();
        }
    }

    // Обработка партнеров
    foreach ($request->input('partners', []) as $partnerData) {
        if (!isset($partnerData['id']) || trim($partnerData['name'] ?? '') === '') {
            continue;
        }

        $member = Family::find($partnerData['id']);
        if ($member && $member->memorial_id === $memorial->id) {
            $member->name = $partnerData['name'];
            $member->save();
        }
    }

    // Обработка братьев/сестер
    foreach ($request->input('siblings', []) as $siblingData) {
        if (!isset($siblingData['id']) || trim($siblingData['name'] ?? '') === '') {
            continue;
        }

        $member = Family::find($siblingData['id']);
        if ($member && $member->memorial_id === $memorial->id) {
            $member->name = $siblingData['name'];
            $member->save();
        }
    }

    // Обработка отдельных членов семьи (отец, мать и т.д.)
    foreach ($request->input('family_members', []) as $memberId => $memberData) {
        if (!isset($memberData['name']) || trim($memberData['name']) === '') {
            continue;
        }

        $member = Family::find($memberId);
        if ($member && $member->memorial_id === $memorial->id) {
            $member->name = $memberData['name'];
            $member->save();
        }
    }

    // Обработка изображений
    if ($request->hasFile('images')) {
        foreach ($request->file('images') as $memberId => $imageFile) {
            if (!$imageFile) continue;

            $member = Family::find($memberId);
            
            // Проверяем, что запись существует и принадлежит этому мемориалу
            if (!$member || $member->memorial_id !== $memorial->id) {
                continue;
            }

            $filename = $memorial->slug . '/' . $memberId . '-' . time() . '.webp';
            $image = Image::read($imageFile)->scale(width: 800)->toWebp(90);
            Storage::disk('memorial')->put($filename, $image);

            // Удаляем старое фото если оно есть
            if ($member->photo && Storage::disk('memorial')->exists($member->photo)) {
                Storage::disk('memorial')->delete($member->photo);
            }
            
            $member->photo = $filename;
            $member->save();
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
