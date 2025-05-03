<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $users = [
            [
                'role_id' => 1,
                'username' => 'Administrator',
                'email' => 'Admin@gmail.com',
                'email_verified_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'password' => Hash::make('Admin123'),
                'is_active' => 1,
                'remember_token' => null,
            ],
            [
                'role_id' => 2,
                'username' => 'User',
                'email' => 'User@gmail.com',
                'email_verified_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'password' => Hash::make('User123'),
                'is_active' => 1,
                'remember_token' => null,
            ],
        ];

        $now = Carbon::now()->format('Y-m-d H:i:s');

        foreach ($users as $user) {
            $user['created_at'] = $now;
            $user['updated_at'] = $now;
            DB::table('users')->insert($user);
        }
    }
}
