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
                'email' => 'Administrator@anaku.com',
                'email_verified_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'password' => Hash::make('Administrator123'),
                'is_active' => 1,
                'remember_token' => null,
            ],
            [
                'role_id' => 2,
                'username' => 'Taman Semanan Indah',
                'email' => 'taman_semanan_indah@anaku.com',
                'email_verified_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'password' => Hash::make('Admin'),
                'is_active' => 1,
                'remember_token' => null,
            ],
            [
                'role_id' => 2,
                'username' => 'Taman Permata Buana',
                'email' => 'taman_permata_buana@anaku.com',
                'email_verified_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'password' => Hash::make('Admin'),
                'is_active' => 1,
                'remember_token' => null,
            ],
            [
                'role_id' => 2,
                'username' => 'Perumahan Kosambi Baru',
                'email' => 'perumaha_kosambi_baru@anaku.com',
                'email_verified_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'password' => Hash::make('Admin'),
                'is_active' => 1,
                'remember_token' => null,
            ],
            [
                'role_id' => 2,
                'username' => 'Green Lake City',
                'email' => 'green_lake_city@anaku.com',
                'email_verified_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'password' => Hash::make('Admin'),
                'is_active' => 1,
                'remember_token' => null,
            ],
            [
                'role_id' => 2,
                'username' => 'Lippo Mall Puri',
                'email' => 'lippo_mall_puri@anaku.com',
                'email_verified_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'password' => Hash::make('Admin'),
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
