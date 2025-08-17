<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class Comment extends Model
{
    protected $fillable = [
        'name',
        'content',
        'status',
        'memorial_id',
        'photo'
    ];

    public function memorial(): BelongsTo
    {
        return $this->belongsTo(Memorial::class);
    }

    /**
     * Получить URL фотографии комментария
     */
    public function getPhotoUrlAttribute()
    {
        if (!$this->photo) {
            return null;
        }

        $path = $this->memorial->slug . '/comments/' . $this->photo;

        if (Storage::disk('memorial')->exists($path)) {
            // Возвращаем относительный путь или используйте asset() если нужно
            return '/storage/memorial/' . $path;
            // Альтернативно: return asset('storage/memorial/' . $path);
        }

        return null;
    }

    /**
     * Проверить, есть ли фото у комментария
     */
    public function hasPhoto()
    {
        return !empty($this->photo) && $this->photo_url !== null;
    }
}
