<?php

namespace App\Http\Controllers;

use App\Models\Family;
use App\Models\Memorial;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;

class FamilyController extends Controller
{

    public function create(Memorial $memorial)
    {
        // $familyMembers = Family::where('memorial_id', $memorial->id)->get()->groupBy('role');

        // Определяем все необходимые роли для членов семьи
        $requiredRoles = [
            'mother',
            'father',
            'partner',
            'children',
            'siblings',
            'grandfather_father',
            'grandmother_father',
            'grandfather_mother',
            'grandmother_mother'
        ];

        // Создаем отсутствующих членов семьи с пустыми именами
        $this->ensureFamilyMembers($memorial, $requiredRoles);

        $familyMembers = Family::where('memorial_id', $memorial->id)->get()->groupBy('role');

        $mother = Family::where('memorial_id', $memorial->id)->where('role', 'mother')->first();
        $father = Family::where('memorial_id', $memorial->id)->where('role', 'father')->first();

        $grandfatherFather = Family::where('memorial_id', $memorial->id)->where('role', 'grandfather_father')->first();
        $grandmotherFather = Family::where('memorial_id', $memorial->id)->where('role', 'grandmother_father')->first();
        $grandfatherMother = Family::where('memorial_id', $memorial->id)->where('role', 'grandfather_mother')->first();
        $grandmotherMother = Family::where('memorial_id', $memorial->id)->where('role', 'grandmother_mother')->first();


        return view('memorial.family', compact(
            'memorial',
            'familyMembers',
            'mother',
            'father',
            'grandfatherFather',
            'grandmotherFather',
            'grandfatherMother',
            'grandmotherMother'
        ));
        // return view('memorial.family', compact('memorial', 'familyMembers'));
    }

    // Создаем отсутствующих членов семьи с пустыми именами
    private function ensureFamilyMembers(Memorial $memorial, array $requiredRoles)
    {
        // Получаем роли уже существующих членов семьи
        $existingRoles = Family::where('memorial_id', $memorial->id)
            ->pluck('role')
            ->toArray();

        // Находим отсутствующие роли
        $missingRoles = array_diff($requiredRoles, $existingRoles);

        // Создаем записи для отсутствующих членов семьи
        if (!empty($missingRoles)) {
            $familyMembersData = array_map(function ($role) use ($memorial) {
                return [
                    'memorial_id' => $memorial->id,
                    'role' => $role,
                    'name' => "", // или пустая строка '' если поле не nullable
                    'created_at' => now(),
                    'updated_at' => now()
                ];
            }, $missingRoles);

            Family::insert($familyMembersData);
        }
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
        //  dd($request);
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
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:35120',
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
                $member->qr_code = $childData['qr_code'] ?? '';
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
                $member->qr_code = $partnerData['qr_code'] ?? '';
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
                $member->qr_code = $siblingData['qr_code'] ?? '';
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
                $member->qr_code = $memberData['qr_code'] ?? '';
                $member->save();
            }
        }

        // Обработка изображений
        // if ($request->hasFile('images')) {
        //     foreach ($request->file('images') as $memberId => $imageFile) {
        //         if (!$imageFile) continue;

        //         $member = Family::find($memberId);

        //         // Проверяем, что запись существует и принадлежит этому мемориалу
        //         if (!$member || $member->memorial_id !== $memorial->id) {
        //             continue;
        //         }

        //         $filename = $memorial->slug . '/' . $memberId . '-' . time() . '.webp';
        //         $image = Image::read($imageFile)->scale(width: 800)->toWebp(90);
        //         Storage::disk('memorial')->put($filename, $image);

        //         // Удаляем старое фото если оно есть
        //         if ($member->photo && Storage::disk('memorial')->exists($member->photo)) {
        //             Storage::disk('memorial')->delete($member->photo);
        //         }

        //         $member->photo = $filename;
        //         $member->save();
        //     }
        // }

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $key => $imageFile) {
                if (!$imageFile) continue;

                // Определяем, что такое ключ: ID или строка
                if (is_numeric($key)) {
                    $member = Family::find($key);
                } else {
                    $member = Family::where('relation_key', $key)
                        ->where('memorial_id', $memorial->id)
                        ->first();
                }

                // Пропускаем, если не найдено или не принадлежит мемориалу
                if (!$member || $member->memorial_id !== $memorial->id) {
                    continue;
                }

                // Сохраняем изображение
                $filename = $memorial->slug . '/' . $member->id . '-' . time() . '.webp';
                $image = Image::read($imageFile)->scale(width: 800)->toWebp(90);
                Storage::disk('memorial')->put($filename, $image);

                // Удаляем старое фото, если есть
                if ($member->photo && Storage::disk('memorial')->exists($member->photo)) {
                    Storage::disk('memorial')->delete($member->photo);
                }

                $member->photo = $filename;
                $member->save();
            }
        }


        // ПРОВЕРЯЕМ ДЕЙСТВИЕ И ДОБАВЛЯЕМ НОВОГО ЧЛЕНА СЕМЬИ ЕСЛИ НУЖНО
        $action = $request->input('action');
        $message = __('Family saved successfully');

        switch ($action) {
            case 'add_partner':
                Family::create([
                    'memorial_id' => $memorial->id,
                    'role' => 'partner',
                    'name' => '',
                ]);
                $message = __('Family saved and new partner added');
                break;

            case 'add_children':
                Family::create([
                    'memorial_id' => $memorial->id,
                    'role' => 'children',
                    'name' => '',
                ]);
                $message = __('Family saved and new child added');
                break;

            case 'add_siblings':
                Family::create([
                    'memorial_id' => $memorial->id,
                    'role' => 'siblings',
                    'name' => '',
                ]);
                $message = __('Family saved and new sibling added');
                break;

            case 'save':
            default:
                // Просто сохраняем без добавления
                break;
        }

        return redirect()->back()->with('success', $message);
    }

    public function list(Memorial $memorial)
    {
        $members = Family::where('memorial_id', $memorial->id)->get()->groupBy('role');
        return response()->json($members);
    }

    public function treeupdate(Request $request, Memorial $memorial)
    {
        dd($request);

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
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:35120',
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
                $member->qr_code = $childData['qr_code'] ?? '';
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
                $member->qr_code = $partnerData['qr_code'] ?? '';
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
                $member->qr_code = $siblingData['qr_code'] ?? '';
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
                $member->qr_code = $memberData['qr_code'] ?? '';
                $member->save();
            }
        }
        // Обработка изображений
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $key => $imageFile) {
                if (!$imageFile) continue;

                // Определяем, что такое ключ: ID или строка
                if (is_numeric($key)) {
                    $member = Family::find($key);
                } else {
                    $member = Family::where('relation_key', $key)
                        ->where('memorial_id', $memorial->id)
                        ->first();
                }

                // Пропускаем, если не найдено или не принадлежит мемориалу
                if (!$member || $member->memorial_id !== $memorial->id) {
                    continue;
                }

                // Сохраняем изображение
                $filename = $memorial->slug . '/' . $member->id . '-' . time() . '.webp';
                $image = Image::read($imageFile)->scale(width: 800)->toWebp(90);
                Storage::disk('memorial')->put($filename, $image);

                // Удаляем старое фото, если есть
                if ($member->photo && Storage::disk('memorial')->exists($member->photo)) {
                    Storage::disk('memorial')->delete($member->photo);
                }

                $member->photo = $filename;
                $member->save();
            }
        }


        // ПРОВЕРЯЕМ ДЕЙСТВИЕ И ДОБАВЛЯЕМ НОВОГО ЧЛЕНА СЕМЬИ ЕСЛИ НУЖНО
        $action = $request->input('action');
        $message = __('Family saved successfully');

        switch ($action) {
            case 'add_partner':
                Family::create([
                    'memorial_id' => $memorial->id,
                    'role' => 'partner',
                    'name' => '',
                ]);
                $message = __('Family saved and new partner added');
                break;

            case 'add_children':
                Family::create([
                    'memorial_id' => $memorial->id,
                    'role' => 'children',
                    'name' => '',
                ]);
                $message = __('Family saved and new child added');
                break;

            case 'add_siblings':
                Family::create([
                    'memorial_id' => $memorial->id,
                    'role' => 'siblings',
                    'name' => '',
                ]);
                $message = __('Family saved and new sibling added');
                break;

            case 'save':
            default:
                // Просто сохраняем без добавления
                break;
        }

        return redirect()->route('timeline.create', $memorial);
    }
}
