<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Status::create([
            'name' => 'Active',
            'code' => 'ACTIVE',
            'type' => 'ACTIVE-INACTIVE',
        ]);

        Status::create([
            'name' => 'Inactive',
            'code' => 'INACTIVE',
            'type' => 'ACTIVE-INACTIVE',
        ]);

        Status::create([
            'name' => 'Suspended',
            'code' => 'SUSPENDED',
            'type' => 'CLIENT',
        ]);

        Status::create([
            'name' => 'Available',
            'code' => 'AVAILABLE',
            'type' => 'PRODUCT',
        ]);

        Status::create([
            'name' => 'Not Available',
            'code' => 'NOT_AVAILABLE',
            'type' => 'PRODUCT',
        ]);

        Status::create([
            'name' => 'Pending',
            'code' => 'PENDING',
            'type' => 'SALE',
        ]);

        Status::create([
            'name' => 'Processing',
            'code' => 'PROCESSING',
            'type' => 'SALE',
        ]);

        Status::create([
            'name' => 'Processed',
            'code' => 'PROCESSED',
            'type' => 'SALE',
        ]);
    }
}
