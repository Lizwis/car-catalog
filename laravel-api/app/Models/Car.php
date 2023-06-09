<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $table = 'cars';

    protected $fillable = ['make', 'model', 'image', 'year', 'price', 'category_id', 'mileage', 'transmission', 'fuel_type'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
