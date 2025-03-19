<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QrCodes extends Model
{
    protected $table = 'qr_codes';

    protected $fillable = [
        'token',
        'qr_code',
        'status',
        'memorial_id',
    ];

    public function memorial()
    {
        return $this->belongsTo(Memorial::class, 'memorial_id');
    }
}
