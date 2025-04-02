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
        // if (request()->segment(2) != $memorial->slug && $memorial->slug) {
        //     return redirect()->route('memorial.show', $memorial->slug);
        // }
        if (request()->segment(2) != $memorial->slug && $memorial->slug) {
            // Вместо использования route() создаем URL вручную без слеша
            return redirect('/memorial/' . $memorial->slug, 301);
        }
        
        $images = $memorial->memorialimages;

        $comments = $memorial->comments()
            ->where('status', 'approved')
            ->orderBy('created_at', 'desc')
            ->get();

        $theme = $memorial->theme ?? 'light';

        if ($theme === 'dark') {
            return view('memorial.show', compact('memorial', 'images', 'comments'));
        } else {
            return view('memorial.create', compact('memorial'));
        }

        return view('memorial.show', compact('memorial', 'images', 'comments', 'theme'));
    }

    public function showAttachForm(string $token)
    {
        // Ищем QR-код по токену
        $qr = QrCodes::where('token', $token)->firstOrFail();
        
        // Если QR-код уже привязан к мемориалу
        if ($qr->memorial_id) {
            // Находим мемориал
            $memorial = Memorial::findOrFail($qr->memorial_id);
            
            // Если у мемориала есть slug, делаем редирект на страницу со slug
            if ($memorial->slug) {
                // return redirect()->route('memorial.show', $memorial->slug, 301);

                return redirect()->route('memorial.show', $memorial->slug)->setStatusCode(301);
            }
            
            // Если slug нет, редиректим по ID
            return redirect()->route('memorial.show', $qr->memorial_id);
        }
        
        // Если QR-код еще не привязан
        if (!Auth::check()) {
            // Сохраняем токен QR-кода в сессии
            session(['qr_token' => $token]);
            
            return redirect()
                ->route('login')
                ->with('message', 'Kérjük, jelentkezzen be a QR-kód összekapcsolásához');
        }
        
        // Показываем форму привязки
        return view('memorial.attach', compact('token'));
    }

    public function create()
    {
        return view('memorial.create');
    }

    public function store(Request $request)
    {
        //  dd($request);
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
            'qrtoken' => 'nullable|string|min:3|max:255'
        ]);

        $admin_id = Auth::user()->id;

        // Генерируем уникальный токен для QR-кода
        $token = $this->generateUniqueToken();

        // Создаем запись QR-кода в БД
        $qrCode = QrCodes::create([
            'token' => $token,
        ]); 

        // Создаем мемориал
        $memorial = new Memorial();
        $memorial->id = $token;
        $memorial->name = $request->name;

        // Генерируем начальный slug
        $slug = Str::slug($request->name);

        // Проверяем, существует ли slug
        $originalSlug = $slug; // Сохраняем оригинальный slug
        $count = 1;
        // $exists = Memorial::where('slug', $slug)->exists();
        while (Memorial::where('slug', $slug)->exists()) {
            \Log::info("Слаг {$slug} уже существует, пробуем {$originalSlug}-{$count}");
            $slug = "{$originalSlug}-{$count}";
            $count++;

            // Защита от бесконечного цикла
            if ($count > 100) {
                \Log::error("Достигнут лимит попыток создания уникального слага");
                break;
            }
        }

        $memorial->slug = $slug;
        $memorial->birth_date = $request->birth_date;
        $memorial->death_date = $request->death_date;
        // $memorial->coordinates = $request->coordinates ?? '';
        $memorial->biography = $request->biography;
        $memorial->qr_code = $token;
        $memorial->admin_id = $admin_id;
        $memorial->theme = 'dark';
        $memorial->save();



        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $filename = $slug . '-' . substr(time(), -6) . '-main' . '.webp';// Имя файла: memorial-slug_timestamp.webp

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
            Storage::disk('memorial')->put(
                $slug . '/' . $filename,
                $image->encode()->__toString()
            );

            // Сохраняем имя файла в модели
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

        // Находим QR-код по токену
        $qrtoken = $request->input('qrtoken');
        $qrToken = QrCodes::where('token', $qrtoken)->first();

        // Проверяем, найден ли QR-код
        if ($qrToken) {
            // Обновляем memorial_id
            $qrToken->update([
                'memorial_id' => $memorial->id,
            ]);
        } else {
            // Если QR-код не найден, возвращаем ошибку или выполняем другое действие
            //throw new Exception("QR Code with token {$qrtoken} not found");
            // Или, например, можно вернуть сообщение:
            // return redirect()->back()->with('error', "QR Code with token {$qrtoken} not found");
        }

        return redirect()->route('dashboard')
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
        $memorial->name = $request->name;
        $memorial->birth_date = $request->birth_date;
        $memorial->death_date = $request->death_date;
        $memorial->biography = $request->biography;

        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $filename = $memorial->slug . '-' . substr(time(), -6) . '-main' . '.webp';// Имя файла: memorial-slug_timestamp.webp

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
            Storage::disk('memorial')->put(
                $memorial->slug . '/' . $filename,
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
        $maxAttempts = 10; // Максимальное количество попыток
        $attempts = 0;
    
        // Получаем текущий год (последние 2 цифры) и неделю
        $year = date('y'); // Например, "25" для 2025
        $week = str_pad(date('W'), 2, '0', STR_PAD_LEFT); // Например, "13" для 13-й недели
        $myNumber = 7;
        // Формируем первые 4 цифры (год + неделя)
        $prefix = $year . $week . $myNumber;
    
        do {
            // Генерируем случайное число для оставшихся 8 цифр (от 0 до 99999999)
            $randomPart = str_pad(rand(1, 9999999), 7, '0', STR_PAD_LEFT);
            
            // Собираем полный токен: 2513 + 8 случайных цифр
            $token = $prefix . $randomPart;
            
            $exists = QrCodes::where('token', $token)->exists();
            $attempts++;
        } while ($exists && $attempts < $maxAttempts);
    
        // Если уникальный токен не найден, добавляем timestamp и случайное число
        if ($exists) {
            $randomPart = str_pad(rand(0, 99999999), 7, '0', STR_PAD_LEFT);
            $token = $prefix . $randomPart; // Всё равно используем префикс, но с другой логикой можно добавить time()
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
                Storage::disk('memorial')->delete($memorial->slug . '/' . $memorial->photo);

                // $filePath = 'memorial/' . $memorial->slag . '/' . $memorial->photo;
                // if (Storage::disk('public')->exists($filePath)) {
                //     Storage::disk('public')->delete($filePath);
                // }
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
