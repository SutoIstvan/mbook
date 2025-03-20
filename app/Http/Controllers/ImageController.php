<?php

namespace App\Http\Controllers;

use App\Models\Memorial;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;

class ImageController extends Controller
{
    public function uploadImages(Request $request, $id)
    {
        // dd($request);
        // Проверяем общий размер всех файлов (10MB максимум)
        $totalSize = array_sum(array_map(function ($file) {
            return $file->getSize();
        }, $request->file('images')));

        if ($totalSize > 10 * 1024 * 1024) {
            return back()->with('error', 'Общий размер файлов не должен превышать 10MB');
        }

        $request->validate([
            'images' => 'required|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:20048',
        ]);

        $memorial = Memorial::findOrFail($id);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $photo) {
                // Получаем оригинальное имя и расширение
                $originalName = pathinfo($photo->getClientOriginalName(), PATHINFO_FILENAME);
                $slugName = Str::slug($originalName); // Делаем имя безопасным
                $filename = $slugName . '_' . time() . '.webp'; // Устанавливаем WebP

                // Создаем путь с ID мемориала
                $path = 'images/memorials/' . $memorial->id;

                // Обрабатываем изображение
                $image = Image::read($photo)
                    ->scale(width: 1300)
                    ->toWebp(90);

                // Сохраняем обработанное изображение
                Storage::disk('public')->put($path . '/' . $filename, $image->toString());


                // Создаем запись в базе данных
                $memorial->memorialimages()->create([
                    'image_path' => $path . '/' . $filename
                ]);
            }
        }

        return redirect()->route('dashboard.photos', $id)
            ->with('success', 'A képek sikeresen feltöltve!');
    }

    public function updateImages(Request $request, Memorial $memorial)
    {
        // dd($request);
        $request->validate([
            'images' => 'array',
            'images.*.id' => 'required|exists:images,id',
            // 'images.*.image_date' => 'nullable|date',
            'images.*.image_date' => 'nullable|string|max:255',
            'images.*.image_description' => 'nullable|string|max:255',
        ]);

        foreach ($request->images as $imageData) {
            $image = \App\Models\Image::find($imageData['id']);
            if ($image) {
                $image->update([
                    'image_date' => $imageData['image_date'],
                    'image_description' => $imageData['image_description'],
                ]);
            }
        }

        return redirect()->back()->with('success', 'A képek leírása frissítve!');
    }
}
