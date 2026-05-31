<?php

namespace Database\Seeders;

use App\Models\Car;
use Illuminate\Database\Seeder;

class CarSeeder extends Seeder
{
    public function run(): void
    {
        Car::create([
            'name' => 'Avanza G',
            'brand' => 'Toyota',
            'year' => 2023,
            'plate_number' => 'P1234AB',
            'price_per_day' => 350000,
            'status' => 'available',
            'description' => 'Toyota Avanza 2023',
            'thumbnail' => 'cars/avanza.jpg',
        ]);

        Car::create([
            'name' => 'Brio RS',
            'brand' => 'Honda',
            'year' => 2024,
            'plate_number' => 'P5678CD',
            'price_per_day' => 300000,
            'status' => 'available',
            'description' => 'Honda Brio RS',
            'thumbnail' => 'cars/brio.jpg',
        ]);
    }
}
