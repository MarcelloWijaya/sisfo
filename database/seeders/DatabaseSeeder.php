<?php

namespace Database\Seeders;

use App\Models\Coupon;
use App\Models\CouponStatus;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            ClassroomSeeder::class,
            CourseSeeder::class,
            GradeSeeder::class,
            ManageClassroomSeeder::class,
            PresenceSeeder::class,
            StudentSeeder::class,
            TeacherSeeder::class,
            UserRoleSeeder::class,
            UserSeeder::class,
        ]);
    }
}
