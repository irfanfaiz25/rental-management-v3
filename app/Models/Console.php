<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Console extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'model',
        'price',
        'is_active'
    ];

    public function currentRental()
    {
        return $this->hasOne(Rental::class)->where('status', 'active');
    }
}
