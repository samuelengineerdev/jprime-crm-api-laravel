<?php

namespace Database\Seeders;

use App\Models\ProductCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProductCategory::create([
            'name' => 'Technology',
            'code' => 'CAT001',
            'description' => 'Product about technology',
            'user_id' => 9,
        ]);


        ProductCategory::create([
            'name' => 'Kitchen',
            'code' => 'CAT002',
            'description' => 'Product about Kitchen',
            'user_id' => 9,
        ]);


        ProductCategory::create([
            'name' => 'Office',
            'code' => 'CAT003',
            'description' => 'Product about Office',
            'user_id' => 9,
        ]);

        ProductCategory::create([
            'name' => 'Real Estate',
            'code' => 'CAT004',
            'description' => 'Product about Real Estate',
            'user_id' => 9,
        ]);

        ProductCategory::create([
            'name' => 'Home Appliances',
            'code' => 'CAT005',
            'description' => 'Product about Home Appliances',
            'user_id' => 9,
        ]);
    }
}
