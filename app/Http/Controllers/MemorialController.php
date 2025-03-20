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
            return redirect()->route('memorials.show', $memorial->slug);
        }

        return view('memorial.show', compact('memorial'));
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
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:22048',
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
        $memorial->save();

        // Обрабатываем фотографию
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $originalName = pathinfo($photo->getClientOriginalName(), PATHINFO_FILENAME);
            $slugName = Str::slug($originalName);
            $filename = $slugName . '_' . time() . '.webp';
            
            // Создаем путь с ID мемориала
            $path = 'images/memorials/' . $memorial->id;
            
            $image = Image::read($photo)
                ->scale(width: 1300)
                ->toWebp(90);
            
            // Сохраняем новое фото
            Storage::disk('public')->put($path . '/' . $filename, $image->toString());
            
            $memorial->photo = $filename;
            $memorial->save();
        }

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
            'biography' => 'required|string|min:3|max:2255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
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
        $memorial->video = $request->video;

        // Обновление фото, если загружен новый файл
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $originalName = pathinfo($photo->getClientOriginalName(), PATHINFO_FILENAME);
            $slugName = Str::slug($originalName); // Делаем имя безопасным
            $filename = $slugName . '_' . time() . '.webp'; // Устанавливаем WebP

            // Создаем путь с ID мемориала
            $path = 'images/memorials/' . $memorial->id;

            $image = Image::read($photo)
            ->scale(width: 1300)
            ->toWebp(90);

            // Удаляем старое фото, если оно есть
            if ($memorial->photo) {
                Storage::disk('public')->delete($path . '/' . $memorial->photo);
            }

            // Сохраняем новое фото
            Storage::disk('public')->put($path . '/' . $filename, $image->toString());


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
            ->generate(url("/memorial/{$memorial->slug}"));

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
}
