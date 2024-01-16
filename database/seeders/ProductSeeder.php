<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'code' => 'PROD001',
            'name' => 'Office Table',
            'description' => 'Big Office Table',
            'unit_price' => 1200.00,
            'stock_quantity' => 10,
            'status_id' => 4,
            'category_id' => 2,
            'user_id' => 9,
        ]);

        Product::create([
            'code' => 'PROD002',
            'name' => 'Gaming Laptop',
            'description' => 'High-performance laptop for gaming enthusiasts',
            'unit_price' => 2500.00,
            'stock_quantity' => 5,
            'status_id' => 4,
            'category_id' => 4,
            'user_id' => 9,
        ]);

        Product::create([
            'code' => 'PROD003',
            'name' => 'Smart Home Thermostat',
            'description' => 'Smart thermostat for efficient home heating and cooling',
            'unit_price' => 150.00,
            'stock_quantity' => 8,
            'status_id' => 4,
            'category_id' => 2,
            'user_id' => 9,
        ]);

        Product::create([
            'code' => 'PROD004',
            'name' => 'Executive Desk Chair',
            'description' => 'Luxurious and comfortable chair for office executives',
            'unit_price' => 500.00,
            'stock_quantity' => 12,
            'status_id' => 4,
            'category_id' => 4,
            'user_id' => 9,
        ]);

        Product::create([
            'code' => 'PROD005',
            'name' => '4K Smart TV',
            'description' => 'Ultra-high-definition smart TV for immersive entertainment',
            'unit_price' => 800.00,
            'stock_quantity' => 15,
            'status_id' => 4,
            'category_id' => 4,
            'user_id' => 9,
        ]);

        Product::create([
            'code' => 'PROD006',
            'name' => 'Home Security Camera System',
            'description' => 'Advanced security camera system for home surveillance',
            'unit_price' => 350.00,
            'stock_quantity' => 7,
            'status_id' => 4,
            'category_id' => 2,
            'user_id' => 9,
        ]);

        Product::create([
            'code' => 'PROD007',
            'name' => 'Wireless Ergonomic Keyboard and Mouse',
            'description' => 'Comfortable and efficient wireless keyboard and mouse set',
            'unit_price' => 80.00,
            'stock_quantity' => 20,
            'status_id' => 4,
            'category_id' => 4,
            'user_id' => 9,
        ]);
    }
}
