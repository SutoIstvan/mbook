<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    protected $fillable = [
        'memorial_id',
        'title',
        'description',
        'type',
        'url',
    ];

    public function memorial()
    {
        return $this->belongsTo(Memorial::class);
    }
}