<?php

namespace Database\Seeders;

use App\Models\Payment;
use Illuminate\Database\Seeder;

class PaymentSeeder extends Seeder
{
    public function run(): void
    {
        Payment::create([
            'booking_id' => 1,

            'amount' => 350000,

            'payment_date' => now(),

            'proof_image' => 'payments/bukti-transfer.jpg',

            'status' => 'approved',

            'verified_by' => 1,
        ]);
    }
}
