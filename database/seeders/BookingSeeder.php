<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\Car;
use Illuminate\Database\Seeder;

class BookingSeeder extends Seeder
{
    public function run(): void
    {
        $cars = Car::all();

        if ($cars->isEmpty()) {
            $this->command->error('Cars table is empty!');
            return;
        }

        Booking::query()->delete();

        $data = [

            [
                'booking_code'     => 'BK-001',
                'customer_name'    => 'Ahmad Wijaya',
                'customer_phone'   => '081234567890',
                'customer_address' => 'Jember',
                'start_date'       => now(),
                'end_date'         => now()->addDays(3),
                'total_days'       => 3,
                'price_per_day'    => 350000,
                'total_price'      => 1050000,
                'payment_type'     => 'full',
                'payment_status'   => 'paid',
                'booking_status'   => 'ongoing',
                'notes'            => 'Customer VIP'
            ],

            [
                'booking_code'     => 'BK-002',
                'customer_name'    => 'Sarah Johnson',
                'customer_phone'   => '089876543210',
                'customer_address' => 'Bondowoso',
                'start_date'       => now()->addDays(1),
                'end_date'         => now()->addDays(4),
                'total_days'       => 3,
                'price_per_day'    => 450000,
                'total_price'      => 1350000,
                'payment_type'     => 'dp',
                'payment_status'   => 'pending',
                'booking_status'   => 'confirmed',
                'notes'            => null
            ],

            [
                'booking_code'     => 'BK-003',
                'customer_name'    => 'Michael Chen',
                'customer_phone'   => '082155556666',
                'customer_address' => 'Surabaya',
                'start_date'       => now()->addDays(2),
                'end_date'         => now()->addDays(6),
                'total_days'       => 4,
                'price_per_day'    => 400000,
                'total_price'      => 1600000,
                'payment_type'     => 'full',
                'payment_status'   => 'paid',
                'booking_status'   => 'confirmed',
                'notes'            => null
            ],

            [
                'booking_code'     => 'BK-004',
                'customer_name'    => 'Lisa Anderson',
                'customer_phone'   => '081277778888',
                'customer_address' => 'Malang',
                'start_date'       => now()->subDays(7),
                'end_date'         => now()->subDays(3),
                'total_days'       => 4,
                'price_per_day'    => 500000,
                'total_price'      => 2000000,
                'payment_type'     => 'full',
                'payment_status'   => 'paid',
                'booking_status'   => 'completed',
                'notes'            => null
            ],

            [
                'booking_code'     => 'BK-005',
                'customer_name'    => 'Budi Santoso',
                'customer_phone'   => '081355551111',
                'customer_address' => 'Banyuwangi',
                'start_date'       => now()->addDays(5),
                'end_date'         => now()->addDays(7),
                'total_days'       => 2,
                'price_per_day'    => 300000,
                'total_price'      => 600000,
                'payment_type'     => 'dp',
                'payment_status'   => 'rejected',
                'booking_status'   => 'cancelled',
                'notes'            => 'Transfer tidak valid'
            ],
        ];

        foreach ($data as $booking) {

            Booking::create([
                ...$booking,
                'car_id' => $cars->random()->id,
            ]);
        }
    }
}
