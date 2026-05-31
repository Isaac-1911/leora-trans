<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();

            $table->string('booking_code')->unique();

            $table->foreignId('car_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('customer_name');

            $table->string('customer_phone');

            $table->text('customer_address')->nullable();

            $table->date('start_date');

            $table->date('end_date');

            $table->integer('total_days');

            $table->decimal('price_per_day', 15, 2);

            $table->decimal('total_price', 15, 2);

            $table->enum('payment_type', [
                'dp',
                'full'
            ]);

            $table->enum('payment_status', [
                'pending',
                'paid',
                'rejected'
            ])->default('pending');

            $table->enum('booking_status', [
                'waiting_payment',
                'confirmed',
                'ongoing',
                'completed',
                'cancelled'
            ])->default('waiting_payment');

            $table->text('notes')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
