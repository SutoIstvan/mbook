<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Family extends Model
{
    use HasFactory;
    
    protected $table = 'family';

    protected $fillable = [
        'memorial_id',
        'name',
        'role',
        'birth_date',
        'photo',
        'qr_code',
    ];

    public function memorial()
    {
        return $this->belongsTo(Memorial::class);
    }
}
