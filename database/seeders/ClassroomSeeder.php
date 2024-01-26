<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClassroomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $classrooms = [
            [
                // 'start_time' => '13:00:00',
                // 'end_time' => '14:00:00',
                'grade_id' => '1',
                'name' => 'X Mipa 1',
            ],
            [
                'grade_id' => '1',
                'name' => 'X Mipa 2',
            ],
            [
                'grade_id' => '1',
                'name' => 'X Mipa 3',
            ],
            [
                'grade_id' => '1',
                'name' => 'X Mipa 4',
            ],
            [
                'grade_id' => '1',
                'name' => 'X Mipa 5',
            ],
            [
                'grade_id' => '2',
                'name' => 'XI Mipa 1',
            ],
            [
                'grade_id' => '2',
                'name' => 'XI Mipa 2',
            ],
            [
                'grade_id' => '2',
                'name' => 'XI Mipa 3',
            ],
            [
                'grade_id' => '2',
                'name' => 'XI Mipa 4',
            ],
            [
                'grade_id' => '2',
                'name' => 'XI Mipa 5',
            ],
            [
                'grade_id' => '3',
                'name' => 'XII Mipa 1',
            ],
            [
                'grade_id' => '3',
                'name' => 'XII Mipa 2',
            ],
            [
                'grade_id' => '3',
                'name' => 'XII Mipa 3',
            ],
            [
                'grade_id' => '3',
                'name' => 'XII Mipa 4',
            ],
            [
                'grade_id' => '3',
                'name' => 'XII Mipa 5',
            ],
        ];

        foreach ($classrooms as $classroom) {
            $classroom['created_at'] = now();
            $classroom['updated_at'] = now();
            DB::table('classrooms')->insert($classroom);
        }
    }
}
