<?php

namespace App\Http\Controllers;

use App\Models\Family;
use App\Models\Link;
use App\Models\Memorial;
use App\Models\Timeline;
use App\Models\Image;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Ramsey\Uuid\Type\Time;

class TimelineController extends Controller
{
    public function create(Memorial $memorial)
    {

        Timeline::firstOrCreate(
            [
                'memorial_id' => $memorial->id,
                'date' => $memorial->birth_date,
                'description' => 'birth',
                'type' => __('Birth'),
            ],
            [
                'title' => $memorial->name,
                'order' => 1,
            ]
        );

        $familyMembers = Family::where('memorial_id', $memorial->id)->get()->groupBy('role');

        // --- Рождение детей ---
        if (!empty($familyMembers['children'])) {
            foreach ($familyMembers['children'] as $child) {
                $title = trim((string) $child->name);

                if ($title === '') {
                    continue; // не создаём события без имени
                }

                $exists = Timeline::where('memorial_id', $memorial->id)
                    ->where('title', $title)
                    ->where('type', 'child_birth')
                    ->exists();

                if (!$exists) {
                    Timeline::create([
                        'memorial_id' => $memorial->id,
                        'title' => $title,
                        'description' => '',
                        'date' => null,
                        'type' => 'child_birth',
                        'order' => 1,
                    ]);
                }
            }
        }

        // dd($familyMembers['partner']);
        // --- Брак ---
        // --- Брак ---
        if (!empty($familyMembers['partner'])) {
            foreach ($familyMembers['partner'] as $partner) {
                // Проверяем, что у партнера есть непустое имя
                if (!isset($partner->name) || trim($partner->name) === '') {
                    continue; // пропускаем партнеров без имени
                }
                
                $title = $memorial->name . ' ' . __('and') . ' ' . $partner->name;

                $exists = Timeline::where('memorial_id', $memorial->id)
                    ->where('title', $title)
                    ->where('type', 'marriage')
                    ->exists();

                if (!$exists) {
                    Timeline::create([
                        'memorial_id' => $memorial->id,
                        'title' => $title,
                        'description' => '',
                        'date' => null,
                        'type' => 'marriage',
                        'order' => 1,
                    ]);
                }
            }
        }
        // if (!empty($familyMembers['partner'])) {
        //     foreach ($familyMembers['partner'] as $partner) {
        //         $title = $memorial->name . ' ' . __('and') . ' ' . $partner->name; // Имя + партнёр + marriage

        //         $exists = Timeline::where('memorial_id', $memorial->id)
        //             ->where('title', $title)
        //             ->where('type', 'marriage')
        //             ->exists();

        //         if (!$exists) {
        //             Timeline::create([
        //                 'memorial_id' => $memorial->id,
        //                 'title' => $title,
        //                 'description' => '',
        //                 'date' => null,
        //                 'type' => 'marriage',
        //                 'order' => 1,
        //             ]);
        //         }
        //     }
        // }

        $timelines = Timeline::where('memorial_id', $memorial->id)
            ->orderBy('date', 'desc')
            ->get();

        return view('memorial.timeline', compact('memorial', 'familyMembers', 'timelines'));
    }


    public function gallery(Memorial $memorial)
    {
        $familyMembers = Family::where('memorial_id', $memorial->id)->get()->groupBy('role');

        $link = Link::where('memorial_id', $memorial->id)
            ->where('type', 'link')
            ->get();

        $videos = Link::where('memorial_id', $memorial->id)
            ->where('type', 'video')
            ->get()
            ->map(function ($video) {
                preg_match('/(?:youtu\.be\/|v=)([\w\-]+)/', $video->url, $matches);
                $youtubeId = $matches[1] ?? null;

                return [
                    'title' => $video->title,
                    'description' => $video->description,
                    'url' => $youtubeId ? "https://www.youtube.com/embed/{$youtubeId}" : null,
                ];
            })->filter(fn($video) => $video['url']);

        $music = Link::where('memorial_id', $memorial->id)
            ->where('type', 'music')
            ->get()
            ->map(function ($music) {
                preg_match('/(?:youtu\.be\/|v=)([\w\-]+)/', $music->url, $matches);
                $youtubeId = $matches[1] ?? null;

                return [
                    'title' => $music->title,
                    'description' => $music->description,
                    'url' => $youtubeId ? "https://www.youtube.com/embed/{$youtubeId}" : null,
                ];
            })->filter(fn($video) => $video['url']);


        return view('memorial.gallery', compact('memorial', 'familyMembers', 'videos', 'music', 'link'));
    }

    public function store(Request $request)
    {
        // Валидация входящих данных
        $validatedData = $request->validate([
            'children.*.id' => 'nullable|integer|exists:family,id',
            'children.*.name' => 'nullable|string|max:255',
            'children.*.birth_date' => 'nullable|date',
            'new_children.*.name' => 'nullable|string|max:255',
            'new_children.*.birth_date' => 'nullable|date',
            'event_type' => 'nullable|string',
            'date' => 'nullable|date',
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
                        'title' => $child->name,
                        'description' => $child->name,
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
                    'title' => $newChildData['name'],
                    'description' => $newChildData['name'],
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

    // public function storeMarriage(Request $request)
    // {
    //     //  dd($request);
    //     // Валидация входящих данных
    //     $validatedData = $request->validate([
    //         'marriages.*.id' => 'nullable|integer|exists:family,id',
    //         'marriages.*.name' => 'nullable|string|max:255',
    //         'marriages.*.marriage_date' => 'nullable|date',
    //         'new_marriages.*.partner_name' => 'nullable|string|max:255',
    //         'new_marriages.*.marriage_date' => 'nullable|date',
    //         'event_type' => 'nullable|string', // Добавляем тип события
    //         'date' => 'nullable|date', // Дата события
    //     ]);

    //     // dd($validatedData);
    //     // Создание записи в таймлайне для каждого существующего ребенка
    //     foreach ($validatedData['marriages'] as $marriage) {
    //         // Обновим ребёнка по ID
    //         $partner = Family::find($marriage['id']);
    //         // dd($partner);
    //         if ($partner) {
    //             $partner->update([
    //                 'birth_date' => $marriage['marriage_date'],
    //             ]);

    //             Timeline::updateOrCreate(
    //                 [
    //                     'memorial_id' => $request->memorial_id,
    //                     'type' => 'marriage',
    //                     'related_person' => $partner->name, // можно привязать по имени
    //                 ],
    //                 [
    //                     'title' => $partner->name,
    //                     'date' => $marriage['marriage_date'],
    //                     'order' => 1,
    //                 ]
    //             );
    //         }
    //     }

    //     // Создание записи в таймлайне для каждого нового ребенка
    //     if (!empty($validatedData['new_marriages'])) {
    //         foreach ($validatedData['new_marriages'] as $newMarriagesData) {
    //             // Создаём запись в Timeline
    //             // dd($newMarriagesData);
    //             Timeline::create([
    //                 'memorial_id' => $request->memorial_id,
    //                 'title' => $newMarriagesData['partner_name'],
    //                 'description' => $newMarriagesData['partner_name'],
    //                 'type' => 'marriage',
    //                 'date' => $newMarriagesData['marriage_date'],
    //                 'order' => 1,
    //             ]);

    //             // Создаём или обновляем запись в Family
    //             Family::updateOrCreate(
    //                 [
    //                     'memorial_id' => $request->memorial_id,
    //                     'name' => $newMarriagesData['partner_name']
    //                 ],
    //                 [
    //                     'birth_date' => $newMarriagesData['marriage_date'],
    //                     'role' => 'partner'
    //                 ]
    //             );
    //         }
    //     }

    //     return back()->with('success', 'Dátumok sikeresen mentve!');
    // }

    // public function addSchool(Request $request)
    // {
    //     $validated = $request->validate([
    //         'memorial_id' => 'required|exists:memorials,id',
    //         'school_name' => 'required|string|max:255',
    //         'school_date' => 'required|date',
    //         'school_date_to' => 'required|date',
    //     ]);

    //     Timeline::create([
    //         'memorial_id' => $validated['memorial_id'],
    //         'title' => $validated['school_name'],
    //         'description' => $validated['school_name'],
    //         'type' => 'school',
    //         'date' => $validated['school_date'],
    //         'date_to' => $validated['school_date_to'],
    //         'order' => 1,
    //     ]);

    //     return back()->with('success', 'Iskola sikeresen hozzáadva a timeline-hoz.');
    // }

    // public function addWork(Request $request)
    // {
    //     // dd($request);
    //     $validated = $request->validate([
    //         'memorial_id' => 'required|exists:memorials,id',
    //         'work_name' => 'required|string|max:255',
    //         'work_date' => 'required|date',
    //         'work_date_to' => 'required|date',
    //     ]);

    //     Timeline::create([
    //         'memorial_id' => $validated['memorial_id'],
    //         'title' => $validated['work_name'],
    //         'description' => $validated['work_name'],
    //         'type' => 'work',
    //         'date' => $validated['work_date'],
    //         'date_to' => $validated['work_date_to'],
    //         'order' => 1,
    //     ]);

    //     return back()->with('success', 'Iskola sikeresen hozzáadva a timeline-hoz.');
    // }

    // public function addHobby(Request $request)
    // {
    //     // dd($request);
    //     $validated = $request->validate([
    //         'memorial_id' => 'required|exists:memorials,id',
    //         'hobby_name' => 'required|string|max:255',
    //         // 'hobby_date' => 'required|date',
    //         // 'hobby_date_to' => 'required|date',
    //     ]);

    //     Timeline::create([
    //         'memorial_id' => $validated['memorial_id'],
    //         'title' => $validated['hobby_name'],
    //         'description' => $validated['hobby_name'],
    //         'type' => 'hobby',
    //         // 'date' => $validated['hobby_date'],
    //         // 'date_to' => $validated['hobby_date_to'],
    //         'order' => 1,
    //     ]);

    //     return back()->with('success', 'Iskola sikeresen hozzáadva a timeline-hoz.');
    // }

    public function destroy($id)
    {
        // dd($id);
        $timeline = Timeline::findOrFail($id);
        $timeline->delete();

        return back()->with('success', 'Az esemény sikeresen törölve lett.');
    }

    public function showTimeline(Memorial $memorial)
    {

        // dd($memorial->name);
        // Загружаем все события и фото по мемориалу
        $events = Timeline::where('memorial_id', $memorial->id)
            ->orderBy('date', 'asc')
            ->get();

        // $events = Timeline::where('memorial_id', $memorial->id)->get();
        $images = Image::where('memorial_id', $memorial->id)->get();

        // Соберем всё в одну коллекцию
        $items = collect();

        $items->push([
            'date' => $memorial->birth_date,
            'title' => $memorial->name . ' ' . Carbon::parse($memorial->birth_date)->format('Y.d.m') . ' született' .
                ($memorial->birth_place ? ' ' . $memorial->birth_place . 'ban' : ''),

            'description' => '',
            'type' => 'event',
        ]);

        foreach ($events as $event) {
            $items->push([
                'date' => $event->date ?? null, // для события
                'date_to' => $event->date_to ?? null, // для события
                'type' => 'event',
                'title' => $this->getEventTitle($event->type),
                'description' => $event->description,
                'media' => $event->media,
                'related_person' => $event->related_person,
            ]);
        }

        foreach ($images as $image) {
            $items->push([
                'date' => $image->image_date,
                'type' => 'image',
                'title' => $image->image_description,
                'image_path' => $image->image_path,
            ]);
        }

        // Сортируем по дате
        $items = $items->sortBy('date');

        // dd($items);
        return view('memorial.timelineshow', compact('items', 'memorial'));
    }

    // Функция для перевода типа события в красивое название
    private function getEventTitle($type)
    {
        return match ($type) {
            'birth' => 'Gyermek születése',
            'marriage' => 'Házasság',
            'school' => 'Iskola',
            'work' => 'Munkahely',
            'death' => 'Elhunyt',
            'сhild_birth' => 'Gyermek születése',
            default => ucfirst($type),
        };
    }

public function newstore(Request $request)
{
    // dd($request);
    $validatedData = $request->validate([
        'title'       => 'required|string|max:255',
        'year'        => 'nullable|integer|min:1900|max:' . date('Y'),
        'type'        => 'required|string',
        'custom_type' => 'nullable|string|max:255',
        'memorial_id' => 'required|exists:memorials,id',
    ]);

    // Если выбрали "custom" → заменяем на значение из custom_type
    $type = $validatedData['type'];
    if ($type === 'other_properties' && !empty($validatedData['custom_type'])) {
        $type = $validatedData['custom_type'];
    }

    Timeline::create([
        'title'       => $validatedData['title'],
        'date'        => $validatedData['year'] 
                           ? $validatedData['year'] . '-01-01' 
                           : null,
        'type'        => $type,
        'memorial_id' => $validatedData['memorial_id'],
    ]);

    return back()->with('success', __('Event successfully added to the timeline.'));
}


    public function updateAll(Request $request)
    {
        // dd($request);
        // Валидация существующих таймлайнов
        $validatedData = $request->validate([
            'timelines' => 'nullable|array',
            'timelines.*.id' => 'required|exists:timelines,id',
            'timelines.*.title' => 'required|string|max:255',
            'timelines.*.year' => 'required|integer|min:1900|max:' . date('Y'),
            'timelines.*.type' => 'required|string',
            'timelines.*.delete' => 'nullable|boolean',

            // Валидация новой записи
            'title' => 'nullable|string|max:255',
            'year' => 'nullable|integer|min:1900|max:' . date('Y'),
            'type' => 'nullable|string',
            'custom_type' => 'nullable|string|max:255',
            'memorial_id' => 'required|integer|exists:memorials,id',
        ]);

        // Обновляем существующие
        if (!empty($validatedData['timelines'])) {
            foreach ($validatedData['timelines'] as $timelineData) {
                $timeline = Timeline::find($timelineData['id']);

                if (!$timeline) continue;

                if (!empty($timelineData['delete'])) {
                    $timeline->delete();
                    continue;
                }

                $timeline->title = $timelineData['title'];
                $timeline->date = $timelineData['year'] . '-01-01';
                $timeline->type = $timelineData['type'];
                $timeline->save();
            }
        }


        // Создаём новую запись, если передан title
        if (!empty($validatedData['title'])) {
            $type = $validatedData['type'];
            if ($type === 'other_properties' && !empty($validatedData['custom_type'])) {
                $type = $validatedData['custom_type'];
            }

            Timeline::create([
                'title' => $validatedData['title'],
                'date' => $validatedData['year'] . '-01-01',
                'type' => $type,
                'memorial_id' => $validatedData['memorial_id'],
            ]);
        }

        return back()->with('success', 'Таймлайны успешно обновлены');
    }


    public function updateNext(Request $request)
    {
        //  dd($request);
        $validatedData = $request->validate([
            'timelines' => 'required|array',
            'timelines.*.id' => 'required|exists:timelines,id',
            'timelines.*.title' => 'required|string|max:255',
            'timelines.*.date' => 'required|integer|min:1900|max:' . date('Y'),
            'timelines.*.type' => 'required|string',
            'timelines.*.delete' => 'nullable|boolean',
        ]);

        foreach ($validatedData['timelines'] as $timelineData) {
            $timeline = Timeline::find($timelineData['id']);
            if (!$timeline) continue;

            // Пропускаем, если это запись о рождении
            if ($timeline->description === 'birth') {
                continue;
            }

            $newDate = $timelineData['date'] . '-01-01';
            $newType = $timelineData['type'];

            $duplicateExists = Timeline::where('memorial_id', $timeline->memorial_id)
                ->where('date', $newDate)
                ->where('type', $newType)
                ->where('id', '!=', $timeline->id)
                ->exists();

            if ($duplicateExists) {
                continue;
            }

            $timeline->title = $timelineData['title'];
            $timeline->date = $newDate;
            $timeline->type = $newType;
            $timeline->save();
        }


        $memorial = Memorial::findOrFail($request->memorial_id);

        return redirect()->route('biography.create', $memorial);

        // return view('memorial.aibiography', compact('memorial'));
        
        // return redirect()->route('timeline.gallery', $memorial);
    }
}
