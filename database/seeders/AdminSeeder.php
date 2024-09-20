<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run()
    {
        $admins = [
            [
                'name' => 'admin',
                'email' => 'paktaintegritas.bpmsph@gmail.com',
                'password' => Hash::make('370012016'),
            ],
            [
                'name' => 'raply',
                'email' => 'raflyamtiar93@gmail.com',
                'password' => Hash::make('raply'),
            ],
        ];

        foreach ($admins as $admin) {
            Admin::updateOrCreate(['email' => $admin['email']], $admin);
        }
    }
}
