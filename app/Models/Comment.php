<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    protected $fillable = [
        'name',
        'content',
        'status',
        'memorial_id'
    ];

    public function memorial(): BelongsTo
    {
        return $this->belongsTo(Memorial::class);
    }
}
