<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ManageClassroomSeeder extends Seeder
{
    /**
     * Run the seeder.
     */
    public function run()
    {
        $manage_classrooms = [
            [
                'classroom_id' => 5,
                'student_id' => 1,
            ],
            [
                'classroom_id' => 5,
                'student_id' => 2,
            ],
            [
                'classroom_id' => 5,
                'student_id' => 3,
            ],
            [
                'classroom_id' => 5,
                'student_id' => 4,
            ],
        ];

        $now = Carbon::now()->format('Y-m-d H:i:s');

        foreach ($manage_classrooms as $manage_classroom) {
            $manage_classroom['created_at'] = $now;
            $manage_classroom['updated_at'] = $now;
            DB::table('manage_classrooms')->insert($manage_classroom);
        }
    }
}
