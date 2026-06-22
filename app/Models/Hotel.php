<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    protected $table = 'hotels_table';

    protected $fillable = [
        'name',
        'description',
        'full_address',
        'province',
        'city',
        'photos',
        'logo',
    ];

    protected $casts = [
        'photos' => 'array',
    ];

    public function rooms()
    {
        return $this->hasMany(Room::class, 'hotel_id');
    }

    public function reviews()
    {
        return $this->hasMany(HotelReview::class, 'hotel_id');
    }
    public function forms()
    {
        return $this->hasOne(HotelForm::class, 'hotel_id');
    }
}
