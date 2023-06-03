<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $students = [
            [
                'center_id' => 1,
                'student_name' => 'John Smith',
                'gender' => 'Male',
                'address' => '123 Main Street',
                'place_of_birth' => 'New York',
                'date_of_birth' => '2005-01-01',
                'religion' => 'Christian',
                'phone_number' => '123456789',
                'school_name' => 'ABC School',
                'parent_name' => 'John Doe',
                'entry_date' => '2022-01-01',
                'registration_date' => '2022-01-01',
                'level' => 'Grade 6',
                'book_start' => 'Book 1',
                'parent_email' => 'john@example.com',
            ],
            [
                'center_id' => 2,
                'student_name' => 'Jane Doe',
                'gender' => 'Female',
                'address' => '456 Elm Street',
                'place_of_birth' => 'Los Angeles',
                'date_of_birth' => '2007-05-05',
                'religion' => 'Muslim',
                'phone_number' => '987654321',
                'school_name' => 'XYZ School',
                'parent_name' => 'Jane Smith',
                'entry_date' => '2022-02-01',
                'registration_date' => '2022-02-01',
                'level' => 'Grade 4',
                'book_start' => 'Book 2',
                'parent_email' => 'jane@example.com',
            ],
        ];

        $now = Carbon::now()->format('Y-m-d H:i:s');

        foreach ($students as $student) {
            $student['created_at'] = $now;
            $student['updated_at'] = $now;
            DB::table('students')->insert($student);
        }
    }
}
