<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ManageClassroom;
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
                'center_id' => 1,
                'classroom_id' => 1,
                'student_id' => 1,
            ],
            [
                'center_id' => 1,
                'classroom_id' => 1,
                'student_id' => 2,
            ],
            [
                'center_id' => 2,
                'classroom_id' => 2,
                'student_id' => 1,
            ],
            [
                'center_id' => 2,
                'classroom_id' => 2,
                'student_id' => 2,
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
