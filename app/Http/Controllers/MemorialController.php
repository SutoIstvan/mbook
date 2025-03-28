<?php

namespace App\Http\Controllers;

use App\Models\Memorial;
use App\Models\QrCodes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Laravel\Facades\Image;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

use Imagick;
use ImagickDraw;
use ImagickPixel;


class MemorialController extends Controller
{
    public function show(Memorial $memorial)
    {
        // Если запись найдена по id, но есть slug, редиректим на slug (опционально)
        if (request()->segment(2) != $memorial->slug && $memorial->slug) {
            return redirect()->route('memorial.show', $memorial->slug);
        }

        $images = $memorial->memorialimages;

        $comments = $memorial->comments()
            ->where('status', 'approved')
            ->orderBy('created_at', 'desc')
            ->get();

        $theme = $memorial->testimonials ?? 'light';

        if ($theme === 'dark') {
            return view('memorial.show', compact('memorial', 'images', 'comments'));
        } else {
            return view('memorial.create', compact('memorial'));
        }

        return view('memorial.show', compact('memorial', 'images', 'comments', 'theme'));
    }

    public function create()
    {
        return view('memorial.create');
    }

    public function store(Request $request)
    {
        // Валидация запроса
        $request->validate([
            'name' => 'required|string|min:3|max:255',
            'birth_date' => 'required|string|min:3|max:255',
            'death_date' => 'required|string|min:3|max:255',
            'biography' => 'required|string|min:3|max:2255',
            'photo' => 'required|image|mimes:jpeg,jpg,png',
            'crop_x' => 'nullable|numeric',
            'crop_y' => 'nullable|numeric',
            'crop_width' => 'nullable|numeric',
            'crop_height' => 'nullable|numeric',
        ]);

        $admin_id = Auth::user()->id;

        // Генерируем уникальный токен для QR-кода
        $token = $this->generateUniqueToken();

        // Создаем запись QR-кода в БД
        $qrCode = QrCodes::create([
            'token' => $token
        ]);

        // Создаем мемориал
        $memorial = new Memorial();
        $memorial->id = $token;
        $memorial->name = $request->name;
        $slug = Str::slug($request->name);
        $count = Memorial::where('slug', 'LIKE', "{$slug}%")->count();
        $memorial->slug = $count ? "{$slug}-{$count}" : $slug;
        $memorial->birth_date = $request->birth_date;
        $memorial->death_date = $request->death_date;
        $memorial->story = $request->story ?? '';
        $memorial->biography = $request->biography;
        $memorial->qr_code = $token;
        $memorial->admin_id = $admin_id;
        $memorial->testimonials = 'dark';
        $memorial->save();

        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $originalName = pathinfo($photo->getClientOriginalName(), PATHINFO_FILENAME);
            $slugName = Str::slug($originalName);
            $filename = $slugName . '_' . time() . '.webp';

            // Создаем путь с ID мемориала
            $path = 'images/memorials/' . $memorial->id;

            // Загружаем изображение
            $image = Image::read($photo);

            // Применяем обрезку, если указаны координаты
            if ($request->filled('crop_width') && $request->filled('crop_height')) {
                $image->crop(
                    $request->input('crop_width'),
                    $request->input('crop_height'),
                    $request->input('crop_x', 0),
                    $request->input('crop_y', 0)
                );
            }

            // Масштабируем и конвертируем в WebP
            $image->scale(width: 1300)->toWebp(90);

            // Сохраняем новое фото
            Storage::disk('public')->put(
                $path . '/' . $filename, 
                $image->encode()->__toString()
            );

            // Сохраняем имя файла в модели
            $memorial->photo = $filename;
            $memorial->save();
        }

                // Обрабатываем фотографию
                // if ($request->hasFile('photo')) {
                //     $photo = $request->file('photo');
                //     $originalName = pathinfo($photo->getClientOriginalName(), PATHINFO_FILENAME);
                //     $slugName = Str::slug($originalName);
                //     $filename = $slugName . '_' . time() . '.webp';
                    
                //     // Создаем путь с ID мемориала
                //     $path = 'images/memorials/' . $memorial->id;
                    
                //     $image = Image::read($photo)
                //         ->scale(width: 1300)
                //         ->toWebp(90);
                    
                //     // Сохраняем новое фото
                //     Storage::disk('public')->put($path . '/' . $filename, $image->toString());
                    
                //     $memorial->photo = $filename;
                //     $memorial->save();
                // }

        // Генерируем и сохраняем QR-код
        $this->generateQRCode($token, $memorial);

        // Обновляем связь QR-кода с мемориалом
        $qrCode->update([
            'memorial_id' => $memorial->id,
            'status' => 'free',
            'qr_code' => "qrcodes/{$memorial->id}.png",
        ]);

        return redirect()->route('dashboard', ['id' => $memorial->id])
                         ->with('success', 'Мемориал успешно создан и QR-код сгенерирован');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|min:3|max:255',
            'birth_date' => 'required|string|min:3|max:255',
            'death_date' => 'required|string|min:3|max:255',
            'biography' => 'required|string|min:3|max:22255',
            'photo' => 'image|mimes:jpeg,jpg,png',
            'crop_x' => 'nullable|numeric',
            'crop_y' => 'nullable|numeric',
            'crop_width' => 'nullable|numeric',
            'crop_height' => 'nullable|numeric',
        ]);

        $memorial = Memorial::findOrFail($id);
        // $memorial->slug = $request->slug;
        // if ($request->filled('slug') && $request->slug !== $memorial->slug) {
        //     $memorial->slug = $request->slug;
        // }
        $memorial->name = $request->name;
        $memorial->birth_date = $request->birth_date;
        $memorial->death_date = $request->death_date;
        $memorial->biography = $request->biography;

        // Обновление фото, если загружен новый файл
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $originalName = pathinfo($photo->getClientOriginalName(), PATHINFO_FILENAME);
            $slugName = Str::slug($originalName);
            $filename = $slugName . '_' . time() . '.webp';

            // Создаем путь с ID мемориала
            $path = 'images/memorials/' . $memorial->id;

            // Загружаем изображение
            $image = Image::read($photo);

            // Применяем обрезку, если указаны координаты
            if ($request->filled('crop_width') && $request->filled('crop_height')) {
                $image->crop(
                    $request->input('crop_width'),
                    $request->input('crop_height'),
                    $request->input('crop_x', 0),
                    $request->input('crop_y', 0)
                );
            }

            // Масштабируем и конвертируем в WebP
            $image->scale(width: 1300)->toWebp(90);

            // Сохраняем новое фото
            Storage::disk('public')->put(
                $path . '/' . $filename, 
                $image->encode()->__toString()
            );

            // Сохраняем имя файла в модели
            $memorial->photo = $filename;
        }

        $memorial->save();

        return redirect()->route('dashboard.edit', $memorial)->with('success', __('Update success'));
    }

    protected function generateUniqueToken()
    {
        $maxAttempts = 10; // Максимальное количество попыток для избежания вечного цикла
        $attempts = 0;
        
        do {
            $token = str_pad(rand(0, 999999999999), 12, '0', STR_PAD_LEFT);
            $exists = QrCodes::where('token', $token)->exists();
            $attempts++;
        } while ($exists && $attempts < $maxAttempts);
        
        // Если после всех попыток не найден уникальный токен, используем timestamp и random
        if ($exists) {
            $token = str_pad(time() . rand(0, 999999), 12, '0', STR_PAD_LEFT);
        }
        
        return $token;
    }
    
    protected function generateQRCode($token, $memorial)
    {
        // Убедимся, что директория существует
        Storage::disk('public')->makeDirectory('qrcodes');

        // Генерируем QR-код с URL на страницу мемориала
        $qrImage = QrCode::format('png')
            ->size(340)
            ->margin(1)
            ->generate(url("/memorial/{$memorial->id}"));

        // Создаем объект Imagick для QR-кода
        $image = new Imagick();
        $image->readImageBlob($qrImage);

        // Загружаем фоновое изображение
        $background = new Imagick(public_path('png.png'));

        // Центрируем QR-код на фоне
        $background->compositeImage(
            $image, 
            Imagick::COMPOSITE_DEFAULT,
            ($background->getImageWidth() - $image->getImageWidth()) / 2,
            ($background->getImageHeight() - $image->getImageHeight()) / 2
        );

        // Настраиваем параметры текста
        $draw = new ImagickDraw();
        $draw->setFontSize(21);
        $draw->setFontWeight(700);
        $draw->setGravity(Imagick::GRAVITY_SOUTH);
        $draw->setFillColor(new ImagickPixel('#000000'));

        // Добавляем токен как текст внизу изображения
        $background->annotateImage(
            $draw,
            0,    // x
            5,    // y - отступ от нижнего края
            0,    // угол
            $token // текст (токен)
        );

        // Сохраняем готовое изображение
        $filePath = "qrcodes/{$token}.png";
        Storage::disk('public')->put(
            $filePath, 
            $background->getImageBlob()
        );

        // Обновляем мемориал с путем к QR-коду
        $memorial->update(['qr_code' => $token]);

        // Очищаем память
        $image->clear();
        $background->clear();

        return $filePath;
    }


    public function biography(Memorial $memorial)
    {
        // Если запись найдена по id, но есть slug, редиректим на slug (опционально)
        if (request()->segment(2) != $memorial->slug && $memorial->slug) {
            return redirect()->route('memorial.biography', $memorial->slug);
        }

        $images = $memorial->memorialimages;

        return view('memorial.biography', compact('memorial', 'images'));
    }

    public function photos(Memorial $memorial)
    {
        // Если запись найдена по id, но есть slug, редиректим на slug (опционально)
        if (request()->segment(2) != $memorial->slug && $memorial->slug) {
            return redirect()->route('memorial.photos', $memorial->slug);
        }

        $images = $memorial->memorialimages;

        return view('memorial.photos', compact('memorial', 'images'));
    }

    public function videos(Memorial $memorial)
    {
        // Если запись найдена по id, но есть slug, редиректим на slug (опционально)
        if (request()->segment(2) != $memorial->slug && $memorial->slug) {
            return redirect()->route('memorial.videos', $memorial->slug);
        }

        $images = $memorial->memorialimages;

        return view('memorial.videos', compact('memorial', 'images'));
    }

    public function comments(Memorial $memorial)
    {
        // Если запись найдена по id, но есть slug, редиректим на slug (опционально)
        if (request()->segment(2) != $memorial->slug && $memorial->slug) {
            return redirect()->route('memorial.comments', $memorial->slug);
        }

        $comments = $memorial->comments()
        ->where('status', 'approved')
        ->orderBy('created_at', 'desc')
        ->get();

        return view('memorial.comments', compact('memorial', 'comments'));
    }


    public function deletePhoto(Request $request, $id)
    {
        try {
            $memorial = Memorial::findOrFail($id);

            if ($memorial->photo) {
                $filePath = 'images/memorials/' . $memorial->id . '/' . $memorial->photo;
                if (Storage::disk('public')->exists($filePath)) {
                    Storage::disk('public')->delete($filePath);
                }
                $memorial->photo = null;
                $memorial->save();
            }

            return response()->json(['success' => true, 'message' => 'Photo deleted successfully']);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete photo: ' . $e->getMessage()
            ], 500);
        }
    }

}
