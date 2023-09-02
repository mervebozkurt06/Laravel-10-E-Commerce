<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Ali',
                'email' => 'ali@gmail.com',
                'password' => 'ali12345678@@@',
                'phone' => 13125489,
                'role_id'=> 1
            ],
            [
                'name' => 'Veli',
                'email' => 'veli@gmail.com',
                'password' => 'veli12345678@@@',
                'phone' => 1314257856,
                'role_id'=> 1
            ],
            [
                'name' => 'Can',
                'email' => 'can@gmail.com',
                'password' => 'can12345678@@@',
                'phone' => 13142465,
                'role_id'=> 1
            ],
        ];

        foreach ($users as $key => $value) {
            $random_role = Role::inRandomOrder()->first();
            $value['role_id'] = $random_role->id;
            User::create($value);
        }
    }
}
