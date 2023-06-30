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
                'day' => 'Senin',
                'start_time' => '10:00:00',
                'end_time' => '11:00:00',
                'teacher_id' => 1,
                'name' => 'Mathematics',
                'status_id' => 1,
            ],
            [
                'center_id' => 1,
                'day' => 'Senin',
                'start_time' => '11:00:00',
                'end_time' => '12:00:00',
                'teacher_id' => 1,
                'name' => 'Mathematics',
                'status_id' => 1,
            ],
            [
                'center_id' => 1,
                'day' => 'Senin',
                'start_time' => '13:00:00',
                'end_time' => '14:00:00',
                'teacher_id' => 1,
                'name' => 'Mathematics',
                'status_id' => 1,
            ],
            [
                'center_id' => 1,
                'day' => 'Senin',
                'start_time' => '14:00:00',
                'end_time' => '15:00:00',
                'teacher_id' => 1,
                'name' => 'Mathematics',
                'status_id' => 1,
            ],
            [
                'center_id' => 1,
                'day' => 'Senin',
                'start_time' => '15:00:00',
                'end_time' => '16:00:00',
                'teacher_id' => 1,
                'name' => 'Mathematics',
                'status_id' => 1,
            ],
            [
                'center_id' => 1,
                'day' => 'Senin',
                'start_time' => '16:00:00',
                'end_time' => '17:00:00',
                'teacher_id' => 1,
                'name' => 'Mathematics',
                'status_id' => 1,
            ],
            [
                'center_id' => 1,
                'day' => 'Senin',
                'start_time' => '17:00:00',
                'end_time' => '18:00:00',
                'teacher_id' => 1,
                'name' => 'Mathematics',
                'status_id' => 1,
            ],
            [
                'center_id' => 2,
                'day' => 'Selasa',
                'start_time' => '13:30:00',
                'end_time' => '15:30:00',
                'teacher_id' => 2,
                'name' => 'Science',
                'status_id' => 1,
            ],
        ];

        foreach ($classrooms as $classroom) {
            $classroom['created_at'] = now();
            $classroom['updated_at'] = now();
            DB::table('classrooms')->insert($classroom);
        }
    }
}
