<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ],
            [
                'name' => 'User One',
                'email' => 'user1@example.com',
                'password' => Hash::make('password'),
                'role' => 'user1',
            ],
            [
                'name' => 'User Two',
                'email' => 'user2@example.com',
                'password' => Hash::make('password'),
                'role' => 'user2',
            ],
        ];

        foreach ($users as $userData) {
            // Get the next employee code dynamically for each user
            $lastUser = User::latest('id')->first();
            $nextId = $lastUser ? $lastUser->id + 1 : 1;
            $employeeCode = 'EMP' . str_pad($nextId, 4, '0', STR_PAD_LEFT);

            // Create user with unique employee_id
            User::create(array_merge($userData, [
                'employee_id' => $employeeCode,
            ]));
        }
    }
}
