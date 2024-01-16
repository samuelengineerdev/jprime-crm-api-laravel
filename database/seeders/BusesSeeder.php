<?php

namespace Database\Seeders;

use App\Models\Bus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BusesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Bus::create([
            'kiv' => 'DA3642635467548',
            'bus_plate' => 'HR1-734DA',
            'vin' => 'KDB9243BNV93',
            'color' => 'Blue',
            'brand' => 'Ford',
            'mile' => '32025',
            'year' => '2015',
            'passenger' => '16',
            'oil_date' => '2023-08-05',
            'date' => '2023-09-27 04:33:02',
            'hour' => '16:00:00',
            'status_id' => 3,
        ]);

        Bus::create([
            'kiv' => 'DA3642635467548',
            'bus_plate' => 'HR2-734DA',
            'vin' => 'KDB9243BNV93',
            'color' => 'Blue',
            'brand' => 'Ford',
            'mile' => '25012',
            'year' => '2018',
            'passenger' => '16',
            'oil_date' => '2023-08-05',
            'date' => '2023-09-27 04:33:02',
            'hour' => '13:00:00',
            'status_id' => 3,
        ]);

        Bus::create([
            'kiv' => 'DA3642635467548',
            'bus_plate' => 'HR3-734DA',
            'vin' => 'KDB9243BNV93',
            'color' => 'Blue',
            'brand' => 'Ford',
            'mile' => '33050',
            'year' => '2010',
            'passenger' => '16',
            'oil_date' => '2023-08-05',
            'date' => '2023-09-27 04:33:02',
            'hour' => '07:00:00',
            'status_id' => 3,
        ]);

        Bus::create([
            'kiv' => 'DA3642635467548',
            'bus_plate' => 'HR4-734DA',
            'vin' => 'KDB9243BNV93',
            'color' => 'Blue',
            'brand' => 'Ford',
            'mile' => '22000',
            'year' => '2015',
            'passenger' => '26',
            'oil_date' => '2023-08-05',
            'date' => '2023-09-27 04:33:02',
            'hour' => '04:00:00',
            'status_id' => 3,
        ]);

        Bus::create([
            'kiv' => 'DA3642635467548',
            'bus_plate' => 'HR5-734DA',
            'vin' => 'KDB9243BNV93',
            'color' => 'Blue',
            'brand' => 'Ford',
            'mile' => '10500',
            'year' => '2012',
            'passenger' => '26',
            'oil_date' => '2023-08-05',
            'date' => '2023-09-27 04:33:02',
            'hour' => '09:00:00',
            'status_id' => 3,
        ]);

    }
}
