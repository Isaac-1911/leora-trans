<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'brand',
        'year',
        'plate_number',
        'price_per_day',
        'status',
        'description',
        'thumbnail'
    ];

    public function images(){
        return $this->hasMany(CarImage::class);
    }

    public function bookings(){
        return $this->hasMany(Booking::class);
    }

    public function expenses(){
        return $this->hasMany(Expense::class);
    }
}
