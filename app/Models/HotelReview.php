<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HotelReview extends Model
{
    protected $table = 'hotel_review';

    protected $fillable = [
        'hotel_id',
        'rating',
        'review',
        'reviewer_name',
        'reviewer_email',
        'reviewer_contact',
    ];

    public function hotel()
    {
        return $this->belongsTo(Hotel::class, 'hotel_id');
    }
}
