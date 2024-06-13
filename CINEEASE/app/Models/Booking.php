<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'movie_id', 'movie_title', 'poster', 'date_booked', 'seats_booked', 'total_amount', 'payment_method'
    ];
}

