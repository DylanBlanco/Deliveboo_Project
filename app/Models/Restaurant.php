<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'partita_iva',
        'image',
        'user_id'
    ];

    // Relazione uno a molti con i piatti
    public function dishes()
    {
        return $this->hasMany(Dish::class);
    }

    // Relazione molti a molti con le categorie
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'categories_restaurants', 'restaurant_id', 'category_id');
    }

    // Relazione uno a molti con gli ordini
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    // Relazione One to One con user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

