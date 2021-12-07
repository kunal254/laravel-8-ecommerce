<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getTitleAttribute($value)
    {
        return ucfirst($value);
    }
    
    public function getAboutAttribute($value)
    {
        return ucfirst($value);
    }

}
