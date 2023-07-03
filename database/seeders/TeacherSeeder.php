<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $teachers = [
            [
                'center_id' => 1,
                'entry_date' => '2022-01-01',
                'name' => 'John Doe',
                'nickname' => 'John',
                'gender' => 'Male',
                'address' => '123 Main Street',
                'place_of_birth' => 'New York',
                'date_of_birth' => '1980-01-01',
                'religion' => 'Christian',
                'phone_number' => '123456789',
                'last_education' => 'Bachelor Degree',
                'email' => 'john@example.com',
                'training_date' => '2022-01-01',
                'status_id' => 1,
            ],
            [
                'center_id' => 2,
                'entry_date' => '2022-01-01',
                'name' => 'Jane Smith',
                'nickname' => 'Jane',
                'gender' => 'Female',
                'address' => '456 Elm Street',
                'place_of_birth' => 'Los Angeles',
                'date_of_birth' => '1985-05-05',
                'religion' => 'Muslim',
                'phone_number' => '987654321',
                'last_education' => 'Master Degree',
                'email' => 'jane@example.com',
                'training_date' => '2022-02-01',
                'status_id' => 1,
            ],
        ];

        $now = Carbon::now()->format('Y-m-d H:i:s');

        foreach ($teachers as $teacher) {
            $teacher['created_at'] = $now;
            $teacher['updated_at'] = $now;
            DB::table('teachers')->insert($teacher);
        }
    }
}
