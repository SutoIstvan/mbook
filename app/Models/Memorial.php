<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Memorial extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'slug',
        'name',
        'birth_date',
        'death_date',
        'photo',
        'video_thumbnail',
        'video',
        'biography',
        'private',
        'coordinates',
        'theme',
        'comments',
        'gift',
        'qr_code',
        'birth_place',
        'grave_location',
        'grave_coordinates',
        'grave_parcel',
        'grave_line',
        'grave_number',
        'virtual_code',
        'admin_id'
    ];

    // Указываем, что для маршрутов используется slug
    public function getRouteKeyName()
    {
        return 'slug';
    }

    // Разрешение маршрута: поиск по slug или id
    public function resolveRouteBinding($value, $field = null)
    {
        return $this->where('slug', $value)
            ->orWhere('id', $value)
            ->firstOrFail();
    }

    // Автоматическая генерация slug при установке name (опционально)
    // public function setNameAttribute($value)
    // {
    //     $this->attributes['name'] = $value;
    //     $this->attributes['slug'] = $this->generateUniqueSlug($value);
    // }

    // Генерация уникального slug
    protected function generateUniqueSlug($name)
    {
        $slug = Str::slug($name);
        $originalSlug = $slug;
        $count = 1;

        while (static::where('slug', $slug)->where('id', '!=', $this->id)->exists()) {
            $slug = $originalSlug . '-' . $count++;
        }

        return $slug;
    }

    public function memorialimages()
    {
        return $this->hasMany(Image::class);
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function timelines()
    {
        return $this->hasMany(Timeline::class);
    }

    public function family()
    {
        return $this->hasMany(Family::class);
    }

    public function timeline()
    {
        return $this->hasMany(Timeline::class);
    }
}
