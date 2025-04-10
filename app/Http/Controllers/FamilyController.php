<?php

namespace App\Http\Controllers;

use App\Models\Family;
use App\Models\Memorial;
use Illuminate\Http\Request;

class FamilyController extends Controller
{
    public function create(Memorial $memorial)
    {
        // dd($memorial);
        // $memorial = Memorial::findOrFail($memorial); // Находим мемориал
        return view('memorial.family', compact('memorial')); // Передаём мемориал в представление
    }

    public function store(Request $request, Memorial $memorial)
    {
        $families = $request->input('family');
    
        if (!$families || !is_array($families)) {
            return redirect()->back()->with('error', 'Нет данных для добавления.');
        }
    
        foreach ($families as $group) {
            if (!$group) continue; // Пропустить если null или пусто
    
            // Если это одиночная запись (отец, мать)
            if (isset($group['name'])) {
                $this->saveFamilyMember($group, $memorial, $request);
            }
            // Если это массив записей (партнёры, дети)
            elseif (is_array($group)) {
                foreach ($group as $member) {
                    if (isset($member['name']) && $member['name']) {
                        $this->saveFamilyMember($member, $memorial, $request);
                    }
                }
            }
        }
    
        return redirect()->back()->with('success', 'Члены семьи добавлены.');
    }
    

    protected function saveFamilyMember(array $data, Memorial $memorial, Request $request)
{
    $family = new Family();
    $family->memorial_id = $memorial->id;
    $family->name = $data['name'] ?? null;
    $family->role = $data['role'] ?? null;
    $family->birth_date = $data['birth_date'] ?? null;

    // Обработка фото
    if (isset($data['photo']) && $data['photo'] instanceof \Illuminate\Http\UploadedFile) {
        $family->photo = $data['photo']->store('family_photos', 'public');
    } elseif ($request->hasFile('photo')) {
        // В случае, если передаётся плоский массив файлов (не вложенные)
        foreach ($request->file('photo') as $file) {
            if ($file->isValid()) {
                $family->photo = $file->store('family_photos', 'public');
                break;
            }
        }
    }

    // QR код пока пропускаем — можно добавить генерацию позже
    $family->save();
}

}
