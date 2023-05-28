<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $roles = [
            ['role_name' => 'Admin'],
            ['role_name' => 'User'],
            ['role_name' => 'Director'],
        ];

        $now = Carbon::now()->format('Y-m-d H:i:s');

        foreach ($roles as $role) {
            $role['created_at'] = $now;
            $role['updated_at'] = $now;
            DB::table('user_roles')->insert($role);
        }
    }
}
