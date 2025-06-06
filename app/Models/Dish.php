<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// SoftDelete
use Illuminate\Database\Eloquent\SoftDeletes;

class Dish extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'price',
        'image',
        'visibility',
        'category_id',
        'restaurant_id',
    ];

    // Campo per la cancellazione soft
    protected $dates = ['deleted_at'];

    // Relazione molti a uno con il ristorante
    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

    // Relazione molti a molti con gli ordini
    public function orders()
    {
        return $this->belongsToMany(Order::class, 'ordered_request')->withPivot('quantity', 'price');
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

}
