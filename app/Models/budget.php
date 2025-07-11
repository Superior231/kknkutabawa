<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class budget extends Model
{
    protected $fillable = [
        'user_id',
        'type',
        'name',
        'image',
        'description',
        'price_in',
        'price_out',
        'quantity',
        'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
