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


        foreach ($classrooms as $classroom) {
            $classroom['created_at'] = now();
            $classroom['updated_at'] = now();
            DB::table('classrooms')->insert($classroom);
        }
    }
}
