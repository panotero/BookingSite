<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    protected $table = 'price_table';

    protected $fillable = [
        'room_id',
        'price',
        'discounted_price',
    ];

    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id');
    }
}
