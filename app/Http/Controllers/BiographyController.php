<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Memorial;

class BiographyController extends Controller
{
    public function create(Memorial $memorial)
    {
        return view('memorial.aibiography', compact('memorial'));
    }

    public function store(Request $request, Memorial $memorial)
    {
        // dd($request);
        // Валидация запроса
        $request->validate([
            'biography_text' => 'nullable|string|max:10000', // Изменили название поля и увеличили лимит
        ]);

        // Сохраняем биографию
        // $memorial уже передается из роута, не нужно искать заново
        $memorial->biography = $request->biography_text;
        $memorial->save();

        return redirect()->route('timeline.gallery', $memorial);
    }
}
