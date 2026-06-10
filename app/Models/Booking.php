<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $primaryKey = 'id';

    protected $table = 'bookings';

    protected $fillable = [
        'booking_code',
        'car_id',
        'customer_name',
        'customer_phone',
        'customer_address',
        'start_date',
        'end_date',
        'total_days',
        'price_per_day',
        'total_price',
        'payment_type',
        'payment_status',
        'booking_status',
        'notes'
    ];

    public function car(){
        return $this->belongsTo(Car::class);
    }

    public function payments(){
        return $this->hasMany(Payment::class);
    }

}
