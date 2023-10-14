<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $courses = [
            [
                'name' => 'Matematika',
                'start_time' => '08:00:00',
                'end_time' => '09:30:00',
            ],
            [
                'name' => 'Bahasa Inggris',
                'start_time' => '10:00:00',
                'end_time' => '11:30:00',
            ],
        ];

        foreach ($courses as $course) {
            $course['created_at'] = now();
            $course['updated_at'] = now();
            DB::table('courses')->insert($course);
        }
    }
}
