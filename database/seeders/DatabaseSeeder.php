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
            CartSeeder::class,
            CenterSeeder::class,
            CouponSeeder::class,
            CouponStatusSeeder::class,
            ClassroomSeeder::class,
            ClassroomStatusSeeder::class,
            CenterPaymentSeeder::class,
            DaySeeder::class,
            ItemSeeder::class,
            ManageClassroomSeeder::class,
            PaymentSeeder::class,
            PaymentStatusSeeder::class,
            PaymentTypeSeeder::class,
            StudentSeeder::class,
            StudentStatusSeeder::class,
            TeacherSeeder::class,
            TeacherStatusSeeder::class,
            UserRoleSeeder::class,
            UserSeeder::class,
        ]);
    }
}
