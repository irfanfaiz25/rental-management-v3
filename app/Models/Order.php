<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'rental_id',
        'menu_id',
        'quantity',
        'total_price'
    ];

    public function rental()
    {
        return $this->belongsTo('rentals');
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }
}
