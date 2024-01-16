<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RolesSeeder::class,
            UserSeeder::class,
            ClientAccountSeeder::class,
            StatusesSeeder::class,
            AdminAccountSeeder::class,
            BusesSeeder::class,
            SupplierSeeder::class,
            ProductCategorySeeder::class,
            ProductSeeder::class,
            CustomerSeeder::class,
            PaymentMethodSeeder::class,
            PaymentTypeSeeder::class,
        ]);
    }
}
