<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Restaurant;
use App\Models\Dish;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'telephone',
        'email',
        'total_price',
        'restaurant_id'
    ];

    // Relazione molti a uno con il ristorante
    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

    // Relazione molti a molti con i piatti (attraverso la tabella pivot 'ordered_request')
    public function dishes()
    {
        return $this->belongsToMany(Dish::class, 'ordered_request')->withPivot('quantity', 'price');
    }

    // Relazione uno a molti con ordered_request
    public function orderedRequests()
    {
        return $this->hasMany(OrderedRequest::class);
    }
}
