<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Branch;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $branch1 = Branch::first();

        /*
        |--------------------------------------------------------------------------
        | SUPER ADMIN
        |--------------------------------------------------------------------------
        */

        $superAdmin = User::updateOrCreate(
            [
                'email' => 'superadmin@anaku.com',
            ],
            [
                'branch_id' => null,
                'name' => 'Super Admin',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
                'is_active' => true,
            ],
        );

        $superAdmin->assignRole('super_admin');

        /*
        |--------------------------------------------------------------------------
        | DIRECTOR
        |--------------------------------------------------------------------------
        */

        $director = User::updateOrCreate(
            [
                'email' => 'director@anaku.com',
            ],
            [
                'branch_id' => null,
                'name' => 'Director',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
                'is_active' => true,
            ],
        );

        $director->assignRole('director');

        /*
        |--------------------------------------------------------------------------
        | BRANCH ADMIN
        |--------------------------------------------------------------------------
        */

        $branchAdmin = User::updateOrCreate(
            [
                'email' => 'admin@anakueducare.id',
            ],
            [
                'branch_id' => $branch1?->id,
                'name' => 'Branch Admin',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
                'is_active' => true,
            ],
        );

        $branchAdmin->assignRole('branch_admin');

        /*
        |--------------------------------------------------------------------------
        | TEACHER
        |--------------------------------------------------------------------------
        */

        $teacher = User::updateOrCreate(
            [
                'email' => 'teacher@anakueducare.id',
            ],
            [
                'branch_id' => $branch1?->id,
                'name' => 'Teacher Demo',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
                'is_active' => true,
            ],
        );

        $teacher->assignRole('teacher');

        /*
        |--------------------------------------------------------------------------
        | STUDENT
        |--------------------------------------------------------------------------
        */

        $student = User::updateOrCreate(
            [
                'email' => 'student@anakueducare.id',
            ],
            [
                'branch_id' => $branch1?->id,
                'name' => 'Student Demo',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
                'is_active' => true,
            ],
        );

        $student->assignRole('student');

        /*
        |--------------------------------------------------------------------------
        | PARENT
        |--------------------------------------------------------------------------
        */

        $parent = User::updateOrCreate(
            [
                'email' => 'parent@anakueducare.id',
            ],
            [
                'branch_id' => $branch1?->id,
                'name' => 'Parent Demo',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
                'is_active' => true,
            ],
        );

        $parent->assignRole('parent');

        $this->command->info('✅ Users seeded successfully!');
    }
}
