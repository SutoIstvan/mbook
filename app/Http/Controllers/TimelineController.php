<?php

namespace App\Http\Controllers;

use App\Models\Family;
use App\Models\Memorial;
use App\Models\Timeline;
use Illuminate\Http\Request;

class TimelineController extends Controller
{
    public function create(Memorial $memorial)
    {
        $familyMembers = Family::where('memorial_id', $memorial->id)->get()->groupBy('role');

        $timelines = Timeline::where('memorial_id', $memorial->id)->get();

        $children = Family::where('memorial_id', $memorial->id)
            ->where('role', 'children')
            ->get();

        $partners = Family::where('memorial_id', $memorial->id)
            ->where('role', 'partner')
            ->get();

        return view('memorial.timeline', compact('memorial', 'familyMembers', 'children', 'timelines', 'partners'));
    }


    public function gallery(Memorial $memorial)
    {
        $familyMembers = Family::where('memorial_id', $memorial->id)->get()->groupBy('role');

        return view('memorial.gallery', compact('memorial', 'familyMembers'));
    }

    public function store(Request $request)
    {
        // dd($request);
        // Валидация входящих данных
        $validatedData = $request->validate([
            'children.*.id' => 'nullable|integer|exists:family,id',
            'children.*.name' => 'nullable|string|max:255',
            'children.*.birth_date' => 'nullable|date',
            'new_children.*.name' => 'nullable|string|max:255',
            'new_children.*.birth_date' => 'nullable|date',
            'event_type' => 'nullable|string', // Добавляем тип события
            'date' => 'nullable|date', // Дата события
        ]);

        // Создание записи в таймлайне для каждого существующего ребенка
        foreach ($validatedData['children'] as $childData) {
            // Обновим ребёнка по ID
            $child = Family::find($childData['id']);

            if ($child) {
                $child->update([
                    'birth_date' => $childData['birth_date'],
                ]);

                Timeline::updateOrCreate(
                    [
                        'memorial_id' => $request->memorial_id,
                        'type' => 'child_birth',
                        'related_person' => $child->name, // можно привязать по имени
                    ],
                    [
                        'title' => 'Gyermek születése: ' . $child->name,
                        'description' => 'A gyermek neve: ' . $child->name,
                        'date' => $childData['birth_date'],
                        'order' => 1,
                    ]
                );
            }
        }

        // Создание записи в таймлайне для каждого нового ребенка
        if (!empty($validatedData['new_children'])) {
            foreach ($validatedData['new_children'] as $newChildData) {
                // Создаём запись в Timeline
                Timeline::create([
                    'memorial_id' => $request->memorial_id,
                    'title' => 'Új gyermek: ' . $newChildData['name'],
                    'description' => 'A gyermek neve: ' . $newChildData['name'],
                    'type' => 'child_birth',
                    'date' => $newChildData['birth_date'],
                    'order' => 1,
                ]);

                // Создаём или обновляем запись в Family
                Family::updateOrCreate(
                    [
                        'memorial_id' => $request->memorial_id,
                        'name' => $newChildData['name']
                    ],
                    [
                        'birth_date' => $newChildData['birth_date'],
                        'role' => 'children'
                    ]
                );
            }
        }


        return back()->with('success', 'Dátumok sikeresen mentve!');
    }

    public function storeMarriage(Request $request)
    {
        //  dd($request);
        // Валидация входящих данных
        $validatedData = $request->validate([
            'marriages.*.id' => 'nullable|integer|exists:family,id',
            'marriages.*.name' => 'nullable|string|max:255',
            'marriages.*.marriage_date' => 'nullable|date',
            'new_marriages.*.partner_name' => 'nullable|string|max:255',
            'new_marriages.*.marriage_date' => 'nullable|date',
            'event_type' => 'nullable|string', // Добавляем тип события
            'date' => 'nullable|date', // Дата события
        ]);

        // dd($validatedData);
        // Создание записи в таймлайне для каждого существующего ребенка
        foreach ($validatedData['marriages'] as $marriage) {
            // Обновим ребёнка по ID
            $partner = Family::find($marriage['id']);
            // dd($partner);
            if ($partner) {
                $partner->update([
                    'birth_date' => $marriage['marriage_date'],
                ]);

                Timeline::updateOrCreate(
                    [
                        'memorial_id' => $request->memorial_id,
                        'type' => 'child_birth',
                        'related_person' => $partner->name, // можно привязать по имени
                    ],
                    [
                        'title' => 'Esküvő. Feleseg neve: ' . $partner->name,
                        'description' => 'A gyermek neve: ' . $partner->name,
                        'date' => $marriage['marriage_date'],
                        'order' => 1,
                    ]
                );
            }
        }

        // Создание записи в таймлайне для каждого нового ребенка
        if (!empty($validatedData['new_marriages'])) {
            foreach ($validatedData['new_marriages'] as $newMarriagesData) {
                // Создаём запись в Timeline
                // dd($newMarriagesData);
                Timeline::create([
                    'memorial_id' => $request->memorial_id,
                    'title' => 'Esküvő. Feleseg neve: ' . $newMarriagesData['partner_name'],
                    'description' => 'Feleseg neve: ' . $newMarriagesData['partner_name'],
                    'type' => 'marriage',
                    'date' => $newMarriagesData['marriage_date'],
                    'order' => 1,
                ]);

                // Создаём или обновляем запись в Family
                Family::updateOrCreate(
                    [
                        'memorial_id' => $request->memorial_id,
                        'name' => $newMarriagesData['partner_name']
                    ],
                    [
                        'birth_date' => $newMarriagesData['marriage_date'],
                        'role' => 'partner'
                    ]
                );
            }
        }

        return back()->with('success', 'Dátumok sikeresen mentve!');
    }

    public function addSchool(Request $request)
    {
        $validated = $request->validate([
            'memorial_id' => 'required|exists:memorials,id',
            'school_name' => 'required|string|max:255',
            'school_date' => 'required|date',
        ]);

        Timeline::create([
            'memorial_id' => $validated['memorial_id'],
            'title' => 'Iskola: ' . $validated['school_name'],
            'description' => 'Iskolai tanulmányok: ' . $validated['school_name'],
            'type' => 'school',
            'date' => $validated['school_date'],
            'order' => 1,
        ]);

        return back()->with('success', 'Iskola sikeresen hozzáadva a timeline-hoz.');
    }


    public function destroy($id)
    {
        $timeline = Timeline::findOrFail($id);
        $timeline->delete();

        return back()->with('success', 'Az esemény sikeresen törölve lett.');
    }
}
