<?php

namespace Database\Seeders;

use App\Models\AdminAccount;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AdminAccount::create([
            'name' => 'Jhon',
            'phone' => '8294651244',
        ]);

        AdminAccount::create([
            'name' => 'Erick',
            'phone' => '8297561255',
        ]);
    }
}
