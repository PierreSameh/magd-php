<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Work extends Model
{
    protected $fillable = [
        "title",
        "image",
        "description",
        "data"
    ];

    protected $casts = [
        'data' => 'array',
    ];
}
