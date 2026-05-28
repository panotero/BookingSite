<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $table = 'rooms_table';

    protected $fillable = [
        'hotel_id',
        'room_name',
        'description',
        'photos',
        'guest_capacity',
        'bed_count',
        'room_area',
    ];

    protected $casts = [
        'photos' => 'array',
    ];

    public function hotel()
    {
        return $this->belongsTo(Hotel::class, 'hotel_id');
    }

    public function prices()
    {
        return $this->hasMany(Price::class, 'room_id');
    }
}
