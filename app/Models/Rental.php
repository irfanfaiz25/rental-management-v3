<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rental extends Model
{
    use HasFactory;
    protected $fillable = [
        'console_id',
        'start_time',
        'end_time',
        'total_price',
        'status'
    ];

    public function console()
    {
        return $this->belongsTo(Console::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
