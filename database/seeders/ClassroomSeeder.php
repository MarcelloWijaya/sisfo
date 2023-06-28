<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClassroomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $classrooms = [
            [
                'center_id' => 1,
                'status_id' => 1,
                'day' => 'Senin',
                'start_time' => '09:00:00',
                'end_time' => '11:00:00',
                'teacher_id' => 1,
                'class_name' => 'Mathematics',
            ],
            [
                'center_id' => 2,
                'status_id' => 1,
                'day' => 'Selasa',
                'start_time' => '13:30:00',
                'end_time' => '15:30:00',
                'teacher_id' => 2,
                'class_name' => 'Science',
            ],
        ];

        foreach ($classrooms as $classroom) {
            $classroom['created_at'] = now();
            $classroom['updated_at'] = now();
            DB::table('classrooms')->insert($classroom);
        }
    }
}
