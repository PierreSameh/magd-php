<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
        "inquiry",
        "region",
        "phone",
        "first_name",
        "last_name",
        "email",
        "description"
    ];
}
