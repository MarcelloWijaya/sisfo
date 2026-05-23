<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::firstOrCreate(
            ['email' => 'admin@anakueducare.id'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('password123'),
            ],
        );

        $user->assignRole('super_admin');
    }
}
