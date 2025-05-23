<?php

namespace App\Http\Controllers;

use App\Models\Memorial;
use App\Models\Image;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
// use Intervention\Image\Laravel\Facades\Image;
use Intervention\Image\Laravel\Facades\Image as ImageFacade;
use DateTime;

class ImageController extends Controller
{
    // public function uploadImages(Request $request, $id)
    // {
    //     // dd($request);
    //     // Проверяем общий размер всех файлов (10MB максимум)
    //     // $totalSize = array_sum(array_map(function ($file) {
    //     //     return $file->getSize();
    //     // }, $request->file('images')));

    //     // if ($totalSize > 10 * 1024 * 1024) {
    //     //     return back()->with('error', 'Общий размер файлов не должен превышать 10MB');
    //     // }

    //     $request->validate([
    //         'images' => 'required|array',
    //         'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:20048',
    //     ]);

    //     $memorial = Memorial::findOrFail($id);

    //     $maxImages = 30; // Максимальное количество фото

    //     // Проверяем текущее количество изображений
    //     if ($memorial->memorialimages()->count() >= $maxImages) {
    //         return redirect()->back()->withErrors(['image' => __('You cannot upload more than :max images.', ['max' => $maxImages])]);
    //     }

    //     if ($request->hasFile('images')) {
    //         foreach ($request->file('images') as $photo) {
    //             // Получаем оригинальное имя и расширение
    //             $originalName = pathinfo($photo->getClientOriginalName(), PATHINFO_FILENAME);
    //             $slugName = Str::slug($originalName); // Делаем имя безопасным
    //             $filename = $slugName . '_' . time() . '.webp'; // Устанавливаем WebP

    //             // Создаем путь с ID мемориала
    //             $path = 'images/memorials/' . $memorial->id;

    //             // Обрабатываем изображение
    //             $image = ImageFacade::read($photo)
    //                 ->scale(width: 1300)
    //                 ->toWebp(90);

    //             // Сохраняем обработанное изображение
    //             Storage::disk('public')->put($path . '/' . $filename, $image->toString());


    //             // Создаем запись в базе данных
    //             $memorial->memorialimages()->create([
    //                 'image_path' => $path . '/' . $filename
    //             ]);
    //         }
    //     }

    //     return redirect()->route('dashboard.photos', $id)
    //         ->with('success', 'A képek sikeresen feltöltve!');
    // }

    // public function uploadImages(Request $request, $id)
    // {
    //     $request->validate([
    //         'images' => 'required|array',
    //         'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:20048',
    //     ]);

    //     $memorial = Memorial::findOrFail($id);
    //     $maxImages = 30; // Максимальное количество фото
    //     $currentImageCount = $memorial->memorialimages()->count();

    //     // Проверяем, можем ли добавить хотя бы одно фото
    //     if ($currentImageCount >= $maxImages) {
    //         return redirect()->back()->withErrors([
    //             'image' => __('You cannot upload more than :max images. You already have :current images.', [
    //                 'max' => $maxImages,
    //                 'current' => $currentImageCount
    //             ])
    //         ]);
    //     }

    //     $uploadedCount = 0; // Счетчик добавленных фото

    //     foreach ($request->file('images') as $photo) {
    //         if ($currentImageCount + $uploadedCount >= $maxImages) {
    //             break; // Останавливаем загрузку, если достигли лимита
    //         }

    //         $originalName = pathinfo($photo->getClientOriginalName(), PATHINFO_FILENAME);
    //         $slugName = Str::slug($originalName); // Делаем имя безопасным
    //         $filename = $slugName . '_' . time() . '.webp'; // Устанавливаем WebP

    //         $path = 'images/memorials/' . $memorial->id; // Папка для сохранения

    //         // Обрабатываем изображение
    //         $image = ImageFacade::read($photo)
    //             ->scale(width: 1300)
    //             ->toWebp(90);

    //         // Сохраняем обработанное изображение
    //         Storage::disk('public')->put($path . '/' . $filename, $image->toString());

    //         // Создаем запись в базе данных
    //         $memorial->memorialimages()->create([
    //             'image_path' => $path . '/' . $filename
    //         ]);

    //         $uploadedCount++; // Увеличиваем счетчик загруженных фото
    //     }

    //     return redirect()->back()->with('success', __('Uploaded :count images. Total images: :total', [
    //         'count' => $uploadedCount,
    //         'total' => $currentImageCount + $uploadedCount
    //     ]));
    // }

public function uploadImages(Request $request, $id)
{
    $request->validate([
        'images' => 'required|array',
        'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:20048',
    ]);

    $memorial = Memorial::findOrFail($id);
    $maxImages = 30; // Максимальное количество фото
    $currentImageCount = $memorial->memorialimages()->count();

    // Проверяем, можем ли добавить хотя бы одно фото
    if ($currentImageCount >= $maxImages) {
        return redirect()->back()->withErrors([
            'image' => __('You cannot upload more than :max images. You already have :current images.', [
                'max' => $maxImages,
                'current' => $currentImageCount
            ])
        ]);
    }

    $uploadedCount = 0; // Счетчик добавленных фото

    foreach ($request->file('images') as $photo) {
        if ($currentImageCount + $uploadedCount >= $maxImages) {
            break; // Останавливаем загрузку, если достигли лимита
        }
    
        // Получаем slug мемориала
        $memorialSlug = Str::slug($memorial->slug);
        $path = $memorialSlug; // Папка для сохранения
    
        // Начинаем с номера 1
        $number = 1;
    
        // Генерируем имя файла
        do {
            $filename = "{$memorialSlug}-{$number}.webp";
    
            // Проверяем, есть ли уже такое имя в базе
            $exists = $memorial->memorialimages()->where('image_path', $path . '/' . $filename)->exists();
    
            // Если файл уже есть, увеличиваем номер
            $number++;
        } while ($exists);
    
        // Извлекаем дату из EXIF
        $imageDate = null;
        $exif = @exif_read_data($photo->getRealPath(), 'EXIF', true);
        if ($exif && isset($exif['EXIF']['DateTimeOriginal'])) {
            $imageDate = DateTime::createFromFormat('Y:m:d H:i:s', $exif['EXIF']['DateTimeOriginal']);
        } elseif ($exif && isset($exif['IFD0']['DateTime'])) {
            $imageDate = DateTime::createFromFormat('Y:m:d H:i:s', $exif['IFD0']['DateTime']);
        }
        $imageDate = $imageDate ? $imageDate->format('Y-m-d') : now()->format('Y-m-d');
    
        // Обрабатываем изображение
        $image = ImageFacade::read($photo)
            ->scale(width: 1300)
            ->toWebp(90);
    
        // Сохраняем обработанное изображение
        Storage::disk('memorial')->put($path . '/' . $filename, $image->toString());
    
        // Создаем запись в базе данных с датой
        $memorial->memorialimages()->create([
            'image_path' => $path . '/' . $filename,
            'image_date' => $imageDate,
        ]);
    
        $uploadedCount++; // Увеличиваем счетчик загруженных фото
    }
    

    return redirect()->back()->with('success', __('Uploaded :count images. Total images: :total', [
        'count' => $uploadedCount,
        'total' => $currentImageCount + $uploadedCount
    ]));
}


    public function updateImages(Request $request, Memorial $memorial)
    {
        // dd($request);
        $request->validate([
            'images' => 'array',
            'images.*.id' => 'required|exists:images,id',
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

    public function destroy(Memorial $memorial, Image $image)
    {

        // Проверяем, принадлежит ли изображение этому мемориалу
        if ($image->memorial_id !== $memorial->id) {
            return redirect()->back()->withErrors(['image' => __('This image does not belong to the memorial.')]);
        }

        Storage::disk('memorial')->delete($image->image_path);

        $image->delete();

        return redirect()->back()->with('success', __('Image deleted successfully.'));
    }

    public function destroyAllImages(Memorial $memorial)
    {
        // Получаем все изображения, связанные с мемориалом
        $images = $memorial->images; // Предполагается, что у модели Memorial есть отношение "images"
    
        if ($images->isEmpty()) {
            return redirect()->back()->with('info', __('No images to delete.'));
        }
    
        // Удаляем все файлы из хранилища
        foreach ($images as $image) {
            Storage::disk('memorial')->delete($image->image_path);
        }
    
        // Удаляем все записи из базы данных
        $memorial->images()->delete();
    
        return redirect()->back()->with('success', __('All images deleted successfully.'));
    }
}
