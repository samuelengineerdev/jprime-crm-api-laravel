<?php

namespace Database\Seeders;

use App\Models\Supplier;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Supplier::create([
            'code' => 'SUP001',
            'name' => 'John Doe',
            'email' => 'johndoe@example.com',
            'phone' => '1234567890',
            'country' => 'United States',
            'city' => 'London',
            'address' => '123 Main Street',
            'company_name' => 'ABC Technologies',
            'company_address' => '456 Elm Street',
            'type_of_service' => 'Technology',
            'category_of_products' => 'Technology',
            'notes' => 'This is a note about John Doe.',
            'user_id' => 9,
        ]);

        Supplier::create([
            'code' => 'SUP002',
            'name' => 'Jane Smith',
            'email' => 'janesmith@example.com',
            'phone' => '9876543210',
            'country' => 'Canada',
            'city' => 'London',
            'address' => '789 Oak Street',
            'company_name' => 'XYZ Appliances',
            'company_address' => '987 Maple Street',
            'type_of_service' => 'Kitchen',
            'category_of_products' => 'Kitchen',
            'notes' => 'This is a note about Jane Smith.',
            'user_id' => 9,
        ]);

        Supplier::create([
            'code' => 'SUP003',
            'name' => 'Robert Johnson',
            'email' => 'robertjohnson@example.com',
            'phone' => '5551234567',
            'country' => 'Australia',
            'city' => 'London',
            'address' => '456 Pine Street',
            'company_name' => '123 Office Supplies',
            'company_address' => '789 Cedar Street',
            'type_of_service' => 'Office',
            'category_of_products' => 'Office',
            'notes' => 'This is a note about Robert Johnson.',
            'user_id' => 9,
        ]);

        Supplier::create([
            'code' => 'SUP004',
            'name' => 'Sarah Williams',
            'email' => 'sarahwilliams@example.com',
            'phone' => '5559876543',
            'country' => 'Germany',
            'city' => 'London',
            'address' => '789 Walnut Street',
            'company_name' => '456 Real Estate',
            'company_address' => '123 Birch Street',
            'type_of_service' => 'Real Estate',
            'category_of_products' => 'Real Estate',
            'notes' => 'This is a note about Sarah Williams.',
            'user_id' => 9,
        ]);

        Supplier::create([
            'code' => 'SUP005',
            'name' => 'Michael Brown',
            'email' => 'michaelbrown@example.com',
            'phone' => '5557894561',
            'country' => 'France',
            'city' => 'London',
            'address' => '123 Cedar Street',
            'company_name' => '789 Furniture',
            'company_address' => '456 Oak Street',
            'type_of_service' => 'Furniture',
            'category_of_products' => 'Furniture',
            'notes' => 'This is a note about Michael Brown.',
            'user_id' => 9,
        ]);

        Supplier::create([
            'code' => 'SUP007',
            'name' => 'David Wilson',
            'email' => 'davidwilson@example.com',
            'phone' => '5557891234',
            'country' => 'Italy',
            'city' => 'London',
            'address' => '789 Maple Street',
            'company_name' => '456 Home Appliances',
            'company_address' => '123 Elm Street',
            'type_of_service' => 'Home Appliances',
            'category_of_products' => 'Home Appliances',
            'notes' => 'This is a note about David Wilson.',
            'user_id' => 9,
        ]);

        Supplier::create([
            'code' => 'SUP008',
            'name' => 'Jessica Thompson',
            'email' => 'jessicathompson@example.com',
            'phone' => '5559871234',
            'country' => 'Mexico',
            'city' => 'London',
            'address' => '123 Walnut Street',
            'company_name' => '789 Technology Solutions',
            'company_address' => '456 Cedar Street',
            'type_of_service' => 'Technology',
            'category_of_products' => 'Technology',
            'notes' => 'This is a note about Jessica Thompson.',
            'user_id' => 9,
        ]);

        Supplier::create([
            'code' => 'SUP009',
            'name' => 'Daniel Martinez',
            'email' => 'danielmartinez@example.com',
            'phone' => '5551237890',
            'country' => 'Brazil',
            'city' => 'London',
            'address' => '456 Oak Street',
            'company_name' => '123 Kitchen Supplies',
            'company_address' => '789 Pine Street',
            'type_of_service' => 'Kitchen',
            'category_of_products' => 'Kitchen',
            'notes' => 'This is a note about Daniel Martinez.',
            'user_id' => 9,
        ]);

        Supplier::create([
            'code' => 'SUP010',
            'name' => 'Olivia Garcia',
            'email' => 'oliviagarcia@example.com',
            'phone' => '5557891230',
            'country' => 'India',
            'city' => 'London',
            'address' => '789 Elm Street',
            'company_name' => '456 Office Supplies',
            'company_address' => '123 Walnut Street',
            'type_of_service' => 'Office',
            'category_of_products' => 'Office',
            'notes' => 'This is a note about Olivia Garcia.',
            'user_id' => 9,
        ]);
    }
}
