<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $roles = [['name' => 'Admin'], ['name' => 'Director'], ['name' => 'User']];

        $now = Carbon::now()->format('Y-m-d H:i:s');

        foreach ($roles as $role) {
            $role['created_at'] = $now;
            $role['updated_at'] = $now;
            DB::table('roles')->insert($role);
        }
    }
}
