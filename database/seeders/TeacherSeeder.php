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
                'name' => 'John Doe',
                'phone_number' => '123456789',
                'email' => 'john@example.com',
            ],
            [
                'name' => 'Jane Smith  ',
                'phone_number' => '987654321',
                'email' => 'jane@example.com',
            ],

        ];

        foreach ($teachers as $teacher) {
            DB::table('teachers')->insert($teacher);
        }
    }
}
