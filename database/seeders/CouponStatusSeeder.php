<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CouponStatus;
use Illuminate\Support\Carbon;

class CouponStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $statuses = [
            [
                'name' => 'Accepted',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Pending',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Rejected',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],    [
                'name' => 'Used',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Unused',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        CouponStatus::insert($statuses);
    }
}
