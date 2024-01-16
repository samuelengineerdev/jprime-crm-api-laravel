<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\AdminAccount;
use App\Models\ClientAccount;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'email' => 'jhon@mail.com',
            'password' => '123456',
            'userable_id' => 1,
            'role_id' => 1,
            'status_id' => 1,
            'userable_type' => AdminAccount::class,
        ]);

        User::create([
            'email' => 'erick@mail.com',
            'password' => '123456',
            'userable_id' => 2,
            'role_id' => 1,
            'status_id' => 1,
            'userable_type' => AdminAccount::class,
        ]);

        User::create([
            'email' => 'alex@mail.com',
            'password' => '123456',
            'userable_id' => 1,
            'role_id' => 2,
            'status_id' => 1,
            'userable_type' => ClientAccount::class,
        ]);

        User::create([
            'email' => 'willi@mail.com',
            'password' => '123456',
            'userable_id' => 2,
            'role_id' => 2,
            'status_id' => 1,
            'userable_type' => ClientAccount::class,
        ]);

        User::create([
            'email' => 'johondoe@mail.com',
            'password' => '123456',
            'userable_id' => 3,
            'role_id' => 2,
            'status_id' => 1,
            'userable_type' => ClientAccount::class,
        ]);

        User::create([
            'email' => 'emmasmith@mail.com',
            'password' => '123456',
            'userable_id' => 4,
            'role_id' => 2,
            'status_id' => 1,
            'userable_type' => ClientAccount::class,
        ]);

        User::create([
            'email' => 'michaeljohnson@mail.com',
            'password' => '123456',
            'userable_id' => 5,
            'role_id' => 2,
            'status_id' => 1,
            'userable_type' => ClientAccount::class,
        ]);

        User::create([
            'email' => 'sophiamartinez@mail.com',
            'password' => '123456',
            'userable_id' => 6,
            'role_id' => 2,
            'status_id' => 1,
            'userable_type' => ClientAccount::class,
        ]);

        User::create([
            'email' => 'danielrodriguez@mail.com',
            'password' => '123456',
            'userable_id' => 7,
            'role_id' => 2,
            'status_id' => 1,
            'userable_type' => ClientAccount::class,
        ]);

        User::create([
            'email' => 'oliviataylor@mail.com',
            'password' => '123456',
            'userable_id' => 8,
            'role_id' => 2,
            'status_id' => 1,
            'userable_type' => ClientAccount::class,
        ]);

        User::create([
            'email' => 'liamwilson@mail.com',
            'password' => '123456',
            'userable_id' => 9,
            'role_id' => 2,
            'status_id' => 1,
            'userable_type' => ClientAccount::class,
        ]);

        User::create([
            'email' => 'avawhite@mail.com',
            'password' => '123456',
            'userable_id' => 10,
            'role_id' => 2,
            'status_id' => 1,
            'userable_type' => ClientAccount::class,
        ]);

        User::create([
            'email' => 'noahlewis@mail.com',
            'password' => '123456',
            'userable_id' => 11,
            'role_id' => 2,
            'status_id' => 1,
            'userable_type' => ClientAccount::class,
        ]);

        User::create([
            'email' => 'isabellaturner@mail.com',
            'password' => '123456',
            'userable_id' => 12,
            'role_id' => 2,
            'status_id' => 1,
            'userable_type' => ClientAccount::class,
        ]);
    }
}
