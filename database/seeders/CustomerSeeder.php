<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 1; $i <= 20; $i++) {
            Customer::create([
                'code' => 'CUS' . str_pad($i, 3, '0', STR_PAD_LEFT),
                'full_name' => $faker->name,
                'email' => $faker->email,
                'phone' => $faker->phoneNumber,
                'address' => $faker->address,
                'country' => $faker->country,
                'city' => $faker->city,
                'state' => $faker->state,
                'postal_code' => $faker->postcode,
                'registration_date' => $faker->date,
                'last_purchase_date' => $faker->date,
                'total_purchases' => $faker->randomFloat(2, 0, 1000),
                'loyalty_points' => $faker->numberBetween(0, 100),
                'notes' => $faker->text,
                'user_id' => 9,
            ]);
        }
    }
}
