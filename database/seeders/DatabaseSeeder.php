<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            RolePermissionSeeder::class,
            BranchSeeder::class,
            SuperAdminSeeder::class,
            UserSeeder::class, // Ini sudah include branch admin, teacher, student, parent
            TeacherSeeder::class,
            StudentSeeder::class,
            ClassroomSeeder::class,
        ]);
    }
}
