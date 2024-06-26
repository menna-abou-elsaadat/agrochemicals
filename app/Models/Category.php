<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public function file()
    {
        return $this->belongsTo(File::class);
    }

    public function products()
    {
        return $this->hasMany(CategoryProduct::class);
    }
}
