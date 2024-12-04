<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'store_id', 
        'category_id',
        'name',
        'description',
        'price',
        'stock',
        'image'
    ];

    public function store() {
        return $this->belongsTo(Store::class);
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function favorites() {
        return $this->hasMany(Favorite::class);
    }

    public function cart() {
        return $this->hasMany(Cart::class);
    }

    public function reviews() {
        return $this->hasMany(Review::class);
    }
}
