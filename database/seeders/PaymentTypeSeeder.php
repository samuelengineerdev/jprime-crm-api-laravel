<?php

namespace Database\Seeders;

use App\Models\PaymentType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PaymentType::create([
            'name' => 'One-Time Payment',
            'code' => 'ONE_TIME',
            'type' => 'SALE',
        ]);

        PaymentType::create([
            'name' => 'Monthly Recurring',
            'code' => 'MONTHLY_RECURRING',
            'type' => 'SALE',
        ]);

        PaymentType::create([
            'name' => 'Bi-Weekly Recurring',
            'code' => 'BIWEEKLY_RECURRING',
            'type' => 'SALE',
        ]);

        PaymentType::create([
            'name' => 'Weekly Recurring',
            'code' => 'WEEKLY_RECURRING',
            'type' => 'SALE',
        ]);

    }
}
