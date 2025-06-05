<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Tạo admin user
        User::create([
            'name' => 'Admin',
            'email' => 'admin@sellcloth.com',
            'password' => Hash::make('password123'),
            'email_verified_at' => now(),
        ]);

        // Tạo một số user thông thường
        $users = [
            [
                'name' => 'Nguyễn Văn A',
                'email' => 'nguyenvana@example.com',
                'password' => Hash::make('password123'),
            ],
            [
                'name' => 'Trần Thị B',
                'email' => 'tranthib@example.com',
                'password' => Hash::make('password123'),
            ],
            [
                'name' => 'Lê Văn C',
                'email' => 'levanc@example.com',
                'password' => Hash::make('password123'),
            ],
            [
                'name' => 'Phạm Thị D',
                'email' => 'phamthid@example.com',
                'password' => Hash::make('password123'),
            ],
            [
                'name' => 'Hoàng Văn E',
                'email' => 'hoangvane@example.com',
                'password' => Hash::make('password123'),
            ]
        ];

        foreach ($users as $userData) {
            User::create([
                'name' => $userData['name'],
                'email' => $userData['email'],
                'password' => $userData['password'],
                'email_verified_at' => now(),
            ]);
        }
    }
}
