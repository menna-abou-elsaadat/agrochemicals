<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserFavourite extends Model
{
    use HasFactory;

    public function categoryProduct()
    {
        return $this->belongsTo(CategoryProduct::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
