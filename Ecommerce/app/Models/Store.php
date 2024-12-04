<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Store extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 
        'name', 
        'description', 
        'image'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function products() {
        return $this->hasMany(Product::class);
    }
}
