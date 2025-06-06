<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    // Relazione molti a molti con i ristoranti
    public function restaurants()
    {
        return $this->belongsToMany(Restaurant::class, 'categories_restaurants', 'category_id', 'restaurant_id');
    }
    public function dishes()
    {
        return $this->hasMany(Dish::class);
    }



}