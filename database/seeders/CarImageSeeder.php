<?php

namespace Database\Seeders;

use App\Models\CarImage;
use Illuminate\Database\Seeder;

class CarImageSeeder extends Seeder
{
    public function run(): void
    {
        CarImage::create([
            'car_id' => 1,
            'image' => 'cars/avanza-1.jpg',
        ]);

        CarImage::create([
            'car_id' => 1,
            'image' => 'cars/avanza-2.jpg',
        ]);

        CarImage::create([
            'car_id' => 2,
            'image' => 'cars/brio-1.jpg',
        ]);
    }
}
