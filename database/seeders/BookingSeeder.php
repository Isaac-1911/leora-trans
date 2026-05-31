<?php

namespace Database\Seeders;

use App\Models\Booking;
use Illuminate\Database\Seeder;

class BookingSeeder extends Seeder
{
    public function run(): void
    {
        Booking::create([
            'booking_code' => 'BK-0001',
            'car_id' => 1,

            'customer_name' => 'Isaac',
            'customer_phone' => '081234567890',
            'customer_address' => 'Jember',

            'start_date' => now()->addDay(),
            'end_date' => now()->addDays(3),

            'total_days' => 2,

            'price_per_day' => 350000,
            'total_price' => 700000,

            'payment_type' => 'dp',
            'payment_status' => 'pending',
            'booking_status' => 'waiting_payment',
        ]);
    }
}
