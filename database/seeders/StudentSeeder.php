<?php

namespace Database\Seeders;

use App\Models\Branch;
use App\Models\Student;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    public function run(): void
    {
        $branches = Branch::pluck('id', 'code');

        $students = [
            [
                'student_number' => 'STD-ABT001-001',
                'name' => 'Andi Wijaya',
                'grade_level' => '10',
                'gender' => 'male',
                'phone' => '081234567901',
                'address' => 'Jl. Kemang Raya No. 10, Jakarta Selatan',
                'parent_name' => 'Bapak Wijaya',
                'parent_phone' => '081234567991',
                'status' => 'active',
                'branch_id' => $branches['ABT001'],
            ],
            [
                'student_number' => 'STD-ABT001-002',
                'name' => 'Bella Putri',
                'grade_level' => '10',
                'gender' => 'female',
                'phone' => '081234567902',
                'address' => 'Jl. Kuningan No. 20, Jakarta Selatan',
                'parent_name' => 'Ibu Putri',
                'parent_phone' => '081234567992',
                'status' => 'active',
                'branch_id' => $branches['ABT001'],
            ],
            [
                'student_number' => 'STD-ABT001-003',
                'name' => 'Charlie Saputra',
                'grade_level' => '11',
                'gender' => 'male',
                'phone' => '081234567903',
                'address' => 'Jl. Pondok Indah No. 30, Jakarta Selatan',
                'parent_name' => 'Bapak Saputra',
                'parent_phone' => '081234567993',
                'status' => 'active',
                'branch_id' => $branches['ABT001'],
            ],
            [
                'student_number' => 'STD-ABT002-001',
                'name' => 'Dinda Aulia',
                'grade_level' => '11',
                'gender' => 'female',
                'phone' => '081234567904',
                'address' => 'Jl. Fatmawati No. 40, Jakarta Selatan',
                'parent_name' => 'Ibu Aulia',
                'parent_phone' => '081234567994',
                'status' => 'active',
                'branch_id' => $branches['ABT002'],
            ],
            [
                'student_number' => 'STD-ABT002-002',
                'name' => 'Eka Prasetyo',
                'grade_level' => '12',
                'gender' => 'male',
                'phone' => '081234567905',
                'address' => 'Jl. Lebak Bulus No. 50, Jakarta Selatan',
                'parent_name' => 'Bapak Prasetyo',
                'parent_phone' => '081234567995',
                'status' => 'active',
                'branch_id' => $branches['ABT002'],
            ],
            [
                'student_number' => 'STD-ABT003-001',
                'name' => 'Fani Ramadhani',
                'grade_level' => '10',
                'gender' => 'female',
                'phone' => '081234567906',
                'address' => 'Jl. Dago No. 15, Bandung',
                'parent_name' => 'Bapak Ramadhani',
                'parent_phone' => '081234567996',
                'status' => 'active',
                'branch_id' => $branches['ABT003'],
            ],
            [
                'student_number' => 'STD-ABT003-002',
                'name' => 'Gilang Permana',
                'grade_level' => '11',
                'gender' => 'male',
                'phone' => '081234567907',
                'address' => 'Jl. Setiabudi No. 25, Bandung',
                'parent_name' => 'Ibu Permana',
                'parent_phone' => '081234567997',
                'status' => 'active',
                'branch_id' => $branches['ABT003'],
            ],
            [
                'student_number' => 'STD-ABT004-001',
                'name' => 'Hana Safitri',
                'grade_level' => '10',
                'gender' => 'female',
                'phone' => '081234567908',
                'address' => 'Jl. Darmo No. 35, Surabaya',
                'parent_name' => 'Bapak Safitri',
                'parent_phone' => '081234567998',
                'status' => 'active',
                'branch_id' => $branches['ABT004'],
            ],
        ];

        foreach ($students as $student) {
            Student::updateOrCreate(['student_number' => $student['student_number']], $student);
        }

        $this->command->info('✅ Students seeded successfully!');
    }
}
