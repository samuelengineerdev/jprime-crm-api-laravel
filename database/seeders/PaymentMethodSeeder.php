<?php

namespace Database\Seeders;

use App\Models\PaymentMethod;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PaymentMethod::create([
            'name' => 'Cash',
            'code' => 'CASH',
            'type' => 'SALE',
        ]);

        PaymentMethod::create([
            'name' => 'Credit Card',
            'code' => 'CREDIT_CARD',
            'type' => 'SALE',
        ]);

        PaymentMethod::create([
            'name' => 'Bank Transfer',
            'code' => 'BANK_TRANSFER',
            'type' => 'SALE',
        ]);
    }
}
