<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryProduct extends Model
{
    use HasFactory;

    public function file()
    {
        return $this->belongsTo(File::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function dieses()
    {
        return $this->hasMany(Dieses::class);
    }

    public function scopeSearch($query, $column ,$value){
        if ($value && $column) {
            if ($column == 'category_id') {

                $query->where("category_id", $value);
            }

            if ($column == 'product_name') {
                $query->where('name','like','%'.$value.'%');
            }

            if ($column == 'active_ingredient') {
                $query->where('active_material','like','%'.$value.'%');
            }

            if ($column == 'disease') {
                $query->where(function($q) use ($value){
                    $q->where('properties','like','%'.$value.'%')
                    ->orWhere('other_data','like','%'.$value.'%');
                })
                
                ;
            }

        }
    }
}
