<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderedRequest extends Model
{
    use HasFactory;

    protected $table = 'ordered_request';

    protected $fillable = [
        'order_id',
        'dish_id',
        'quantity',
        'price'
    ];

    // Relazione molti a uno con l'ordine
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // Relazione molti a uno con il piatto
    public function dish()
    {
        return $this->belongsTo(Dish::class);
    }
}
