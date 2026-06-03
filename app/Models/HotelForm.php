<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HotelForm extends Model
{
    use HasFactory;


    protected $table = 'hotel_forms_table';

    protected $fillable = [
        'hotel_id',
        'form_url',
    ];

    public function hotel()
    {
        return $this->belongsTo(Hotel::class, 'hotel_id');
    }
}
