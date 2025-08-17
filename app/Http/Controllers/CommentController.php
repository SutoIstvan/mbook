<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Memorial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;

class CommentController extends Controller
{
    public function comments($id)
    {
        $memorial = Memorial::where('id', $id)->firstOrFail();
        $comments = $memorial->comments()
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('dashboard.comments', [
            'memorial' => $memorial,
            'comments' => $comments
        ]);
    }

    public function create(Memorial $memorial)
    {
        $memorial = Memorial::where('id', $memorial->id)->firstOrFail();
        return view('memorial.addcomments', [
            'memorial' => $memorial
        ]);
    }

    public function store(Memorial $memorial, Request $request)
    {
        $memorial = Memorial::where('id', $memorial->id)->firstOrFail();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'content' => 'required|string|max:1000',
        ]);

        $comment = Comment::create([
            'name' => $validated['name'],
            'content' => $validated['content'],
            'memorial_id' => $memorial->id,
            'status' => 'pending'
        ]);

        return redirect()->back()->with('success', 'Megemlékezésed sikeresen hozzáadtuk, és moderálásra vár.');
    }

    // public function storejs(Memorial $memorial, Request $request)
    // {
    //     $memorial = Memorial::where('id', $memorial->id)->firstOrFail();

    //     $validated = $request->validate([
    //         'userName' => 'required|string|max:255',
    //         'message' => 'required|string',
    //     ]);

    //     Comment::create([
    //         'name' => $validated['userName'],
    //         'content' => $validated['message'],
    //         'memorial_id' => $memorial->id,
    //         'status' => 'pending'
    //     ]);

    //     return response()->json(['success' => true, 'message' => 'Megemlékezésed sikeresen hozzáadtuk, és moderálásra vár.']);
    // } 

    public function storejs(Memorial $memorial, Request $request)
    {
        $memorial = Memorial::where('id', $memorial->id)->firstOrFail();

        $validated = $request->validate([
            'userName' => 'required|string|max:255',
            'message' => 'required|string',
            'comment_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048', // 2MB max
        ]);

        $commentData = [
            'name' => $validated['userName'],
            'content' => $validated['message'],
            'memorial_id' => $memorial->id,
            'status' => 'pending',
            'photo' => null
        ];

        // Обработка фотографии
        if ($request->hasFile('comment_photo')) {
            $photo = $request->file('comment_photo');
            $filename = $memorial->slug . '-comment-' . time() . '-' . uniqid() . '.webp';

            try {
                // Загружаем изображение
                $image = Image::read($photo);

                // Масштабируем и конвертируем в WebP
                $image->scale(width: 800)->toWebp(85); // Меньший размер для комментариев

                // Создаем директорию если не существует
                $directory = $memorial->slug . '/comments';
                if (!Storage::disk('memorial')->exists($directory)) {
                    Storage::disk('memorial')->makeDirectory($directory);
                }

                // Сохраняем фото
                Storage::disk('memorial')->put(
                    $directory . '/' . $filename,
                    $image->encode()->__toString()
                );

                // Сохраняем имя файла в данных комментария
                $commentData['photo'] = $filename;
            } catch (\Exception $e) {
                return response()->json([
                    'success' => false,
                    'message' => 'Hiba történt a kép feltöltésekor.'
                ], 422);
            }
        }

        Comment::create($commentData);

        return response()->json([
            'success' => true,
            'message' => 'Megemlékezésed sikeresen hozzáadtuk, és moderálásra vár.'
        ]);
    }


    public function approve(Comment $comment)
    {
        // $this->authorize('moderate', Comment::class);

        $comment->update(['status' => 'approved']);

        return redirect()->back()->with('success', 'Megemlékezés elfogadásra került');
    }

    public function reject(Comment $comment)
    {
        // $this->authorize('moderate', Comment::class);

        $comment->update(['status' => 'rejected']);

        return response()->json(['message' => 'Megemlékezés elutasítva']);
    }

    public function destroy(Comment $comment)
    {
        // $this->authorize('delete', $comment);

        $comment->delete();

        return redirect()->back()->with('success', 'Megemlékezés törölve');
    }
}
