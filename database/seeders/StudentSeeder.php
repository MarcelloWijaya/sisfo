<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Student;
use App\Models\Branch;
use App\Models\ClassModel;

class StudentSeeder extends Seeder
{
    public function run(): void
    {
        $branches = Branch::all();

        $students = [
            // Jakarta Students
            [
                'nis' => '20240001',
                'name' => 'Andi Wijaya',
                'class' => '10',
                'gender' => 'male',
                'phone' => '081234567901',
                'address' => 'Jl. Kemang Raya No. 10, Jakarta Selatan',
                'parent_name' => 'Bapak Wijaya',
                'parent_phone' => '081234567991',
                'status' => 'active',
                'branch_id' => $branches->where('code', 'JKT001')->first()->id,
            ],
            [
                'nis' => '20240002',
                'name' => 'Bella Putri',
                'class' => '10',
                'gender' => 'female',
                'phone' => '081234567902',
                'address' => 'Jl. Kuningan No. 20, Jakarta Selatan',
                'parent_name' => 'Ibu Putri',
                'parent_phone' => '081234567992',
                'status' => 'active',
                'branch_id' => $branches->where('code', 'JKT001')->first()->id,
            ],
            [
                'nis' => '20240003',
                'name' => 'Charlie Saputra',
                'class' => '11',
                'gender' => 'male',
                'phone' => '081234567903',
                'address' => 'Jl. Pondok Indah No. 30, Jakarta Selatan',
                'parent_name' => 'Bapak Saputra',
                'parent_phone' => '081234567993',
                'status' => 'active',
                'branch_id' => $branches->where('code', 'JKT001')->first()->id,
            ],
            [
                'nis' => '20240004',
                'name' => 'Dinda Aulia',
                'class' => '11',
                'gender' => 'female',
                'phone' => '081234567904',
                'address' => 'Jl. Fatmawati No. 40, Jakarta Selatan',
                'parent_name' => 'Ibu Aulia',
                'parent_phone' => '081234567994',
                'status' => 'active',
                'branch_id' => $branches->where('code', 'JKT001')->first()->id,
            ],
            [
                'nis' => '20240005',
                'name' => 'Eka Prasetyo',
                'class' => '12',
                'gender' => 'male',
                'phone' => '081234567905',
                'address' => 'Jl. Lebak Bulus No. 50, Jakarta Selatan',
                'parent_name' => 'Bapak Prasetyo',
                'parent_phone' => '081234567995',
                'status' => 'active',
                'branch_id' => $branches->where('code', 'JKT001')->first()->id,
            ],
            // Bandung Students
            [
                'nis' => '20241001',
                'name' => 'Fani Ramadhani',
                'class' => '10',
                'gender' => 'female',
                'phone' => '081234567906',
                'address' => 'Jl. Dago No. 15, Bandung',
                'parent_name' => 'Bapak Ramadhani',
                'parent_phone' => '081234567996',
                'status' => 'active',
                'branch_id' => $branches->where('code', 'BDG001')->first()->id,
            ],
            [
                'nis' => '20241002',
                'name' => 'Gilang Permana',
                'class' => '11',
                'gender' => 'male',
                'phone' => '081234567907',
                'address' => 'Jl. Setiabudi No. 25, Bandung',
                'parent_name' => 'Ibu Permana',
                'parent_phone' => '081234567997',
                'status' => 'active',
                'branch_id' => $branches->where('code', 'BDG001')->first()->id,
            ],
            // Surabaya Students
            [
                'nis' => '20242001',
                'name' => 'Hana Safitri',
                'class' => '10',
                'gender' => 'female',
                'phone' => '081234567908',
                'address' => 'Jl. Darmo No. 35, Surabaya',
                'parent_name' => 'Bapak Safitri',
                'parent_phone' => '081234567998',
                'status' => 'active',
                'branch_id' => $branches->where('code', 'SBY001')->first()->id,
            ],
        ];

        foreach ($students as $student) {
            Student::create($student);
        }

        $this->command->info('✅ Students seeded successfully!');
    }
}
