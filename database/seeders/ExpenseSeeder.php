<?php

namespace Database\Seeders;

use App\Models\Expense;
use Illuminate\Database\Seeder;

class ExpenseSeeder extends Seeder
{
    public function run(): void
    {
        Expense::create([
            'car_id' => 1,
            'expense_name' => 'Ganti Oli',
            'amount' => 300000,
            'expense_date' => now(),
            'notes' => 'Servis rutin',
        ]);

        Expense::create([
            'car_id' => 1,
            'expense_name' => 'Cuci Mobil',
            'amount' => 50000,
            'expense_date' => now(),
            'notes' => 'Persiapan rental',
        ]);
    }
}
