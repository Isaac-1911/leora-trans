<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $primaryKey = 'id';

    protected $fillable = [
        'booking_id',
        'amount',
        'payment_date',
        'proof_image',
        'status',
        'verified_by',
        'payment_code'
    ];

    public function booking(){
        return $this->belongsTo(Booking::class);
    }

    public function verifier(){
        return $this->belongsTo(User::class, 'verified_by');
    }
}
