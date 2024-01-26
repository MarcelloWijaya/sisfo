<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GradeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $grades = [
            [
                'name' => 'X',
            ],
            [
                'name' => 'XI',
            ],
            [
                'name' => 'XII',
            ],
        ];

        foreach ($grades as $grade) {
            $grade['created_at'] = now();
            $grade['updated_at'] = now();
            DB::table('grades')->insert($grade);
        }
    }
}
