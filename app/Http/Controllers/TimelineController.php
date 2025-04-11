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
        // dd($request);
        // Валидация входящих данных
        $validatedData = $request->validate([
            'marriage.*.id' => 'nullable|integer|exists:family,id',
            'marriage.*.name' => 'nullable|string|max:255',
            'marriage.*.date' => 'nullable|date',
            'new_children.*.name' => 'nullable|string|max:255',
            'new_children.*.birth_date' => 'nullable|date',
            'event_type' => 'nullable|string', // Добавляем тип события
            'date' => 'nullable|date', // Дата события
        ]);

        // Создание записи в таймлайне для каждого существующего ребенка
        foreach ($validatedData['marriage'] as $marriageData) {
            // Обновим ребёнка по ID
            $marriage = Family::find($marriageData['id']);
        
            if ($marriage) {
                $marriage->update([
                    'birth_date' => $marriageData['date'],
                ]);
        
                Timeline::updateOrCreate(
                    [
                        'memorial_id' => $request->memorial_id,
                        'type' => 'marriage',
                        'related_person' => $marriage->name, // можно привязать по имени
                    ],
                    [
                        'title' => 'Eskuvo napja: ' . $marriage->name,
                        'description' => 'A feleseg neve: ' . $marriage->name,
                        'date' => $marriageData['date'],
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
}
