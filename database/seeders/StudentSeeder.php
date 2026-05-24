<?php

namespace Database\Seeders;

use App\Models\Branch;
use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class StudentSeeder extends Seeder
{
    public function run(): void
    {
        $branches = Branch::pluck('id', 'code');

        $students = [
            // ABT001 - Taman Semanan
            [
                'student_code' => 'STD-ABT001-001',
                'name' => 'Andi Wijaya',
                'class' => '10',
                'gender' => 'male',
                'phone' => '081234567901',
                'address' => 'Jl. Kemang Raya No. 10, Jakarta Selatan',
                'place_of_birth' => 'Jakarta',
                'date_of_birth' => '2008-05-15',
                'religion' => 'Islam',
                'school_name' => 'SMP Negeri 1 Jakarta',
                'parent_name' => 'Bapak Wijaya',
                'parent_phone' => '081234567991',
                'parent_email' => 'bapak.wijaya@parent.com',
                'registration_date' => '2024-01-15',
                'join_date' => '2024-01-15',
                'book_level' => 'Beginner',
                'status' => 'active',
                'branch_code' => 'ABT001',
            ],
            [
                'student_code' => 'STD-ABT001-002',
                'name' => 'Bella Putri',
                'class' => '10',
                'gender' => 'female',
                'phone' => '081234567902',
                'address' => 'Jl. Kuningan No. 20, Jakarta Selatan',
                'place_of_birth' => 'Jakarta',
                'date_of_birth' => '2008-08-20',
                'religion' => 'Islam',
                'school_name' => 'SMP Negeri 2 Jakarta',
                'parent_name' => 'Ibu Putri',
                'parent_phone' => '081234567992',
                'parent_email' => 'ibu.putri@parent.com',
                'registration_date' => '2024-01-15',
                'join_date' => '2024-01-15',
                'book_level' => 'Beginner',
                'status' => 'active',
                'branch_code' => 'ABT001',
            ],
            [
                'student_code' => 'STD-ABT001-003',
                'name' => 'Charlie Saputra',
                'class' => '11',
                'gender' => 'male',
                'phone' => '081234567903',
                'address' => 'Jl. Pondok Indah No. 30, Jakarta Selatan',
                'place_of_birth' => 'Jakarta',
                'date_of_birth' => '2007-03-10',
                'religion' => 'Kristen',
                'school_name' => 'SMP Negeri 3 Jakarta',
                'parent_name' => 'Bapak Saputra',
                'parent_phone' => '081234567993',
                'parent_email' => 'bapak.saputra@parent.com',
                'registration_date' => '2023-01-10',
                'join_date' => '2023-01-10',
                'book_level' => 'Intermediate',
                'status' => 'active',
                'branch_code' => 'ABT001',
            ],

            // ABT002 - Kosambi Baru
            [
                'student_code' => 'STD-ABT002-001',
                'name' => 'Dinda Aulia',
                'class' => '11',
                'gender' => 'female',
                'phone' => '081234567904',
                'address' => 'Jl. Kosambi Baru No. 10, Jakarta Barat',
                'place_of_birth' => 'Jakarta',
                'date_of_birth' => '2007-11-25',
                'religion' => 'Islam',
                'school_name' => 'SMP Negeri 4 Jakarta',
                'parent_name' => 'Ibu Aulia',
                'parent_phone' => '081234567994',
                'parent_email' => 'ibu.aulia@parent.com',
                'registration_date' => '2023-01-10',
                'join_date' => '2023-01-10',
                'book_level' => 'Intermediate',
                'status' => 'active',
                'branch_code' => 'ABT002',
            ],
            [
                'student_code' => 'STD-ABT002-002',
                'name' => 'Eka Prasetyo',
                'class' => '12',
                'gender' => 'male',
                'phone' => '081234567905',
                'address' => 'Jl. Kosambi Baru No. 20, Jakarta Barat',
                'place_of_birth' => 'Jakarta',
                'date_of_birth' => '2006-07-18',
                'religion' => 'Islam',
                'school_name' => 'SMP Negeri 5 Jakarta',
                'parent_name' => 'Bapak Prasetyo',
                'parent_phone' => '081234567995',
                'parent_email' => 'bapak.prasetyo@parent.com',
                'registration_date' => '2022-01-05',
                'join_date' => '2022-01-05',
                'book_level' => 'Advanced',
                'status' => 'active',
                'branch_code' => 'ABT002',
            ],

            // ABT003 - Green Lake City
            [
                'student_code' => 'STD-ABT003-001',
                'name' => 'Fani Ramadhani',
                'class' => '10',
                'gender' => 'female',
                'phone' => '081234567906',
                'address' => 'Jl. Green Lake City No. 5, Tangerang',
                'place_of_birth' => 'Tangerang',
                'date_of_birth' => '2008-04-12',
                'religion' => 'Islam',
                'school_name' => 'SMP Negeri 1 Tangerang',
                'parent_name' => 'Bapak Ramadhani',
                'parent_phone' => '081234567996',
                'parent_email' => 'bapak.ramadhani@parent.com',
                'registration_date' => '2024-01-20',
                'join_date' => '2024-01-20',
                'book_level' => 'Beginner',
                'status' => 'active',
                'branch_code' => 'ABT003',
            ],
            [
                'student_code' => 'STD-ABT003-002',
                'name' => 'Gilang Permana',
                'class' => '11',
                'gender' => 'male',
                'phone' => '081234567907',
                'address' => 'Jl. Green Lake City No. 10, Tangerang',
                'place_of_birth' => 'Tangerang',
                'date_of_birth' => '2007-09-30',
                'religion' => 'Islam',
                'school_name' => 'SMP Negeri 2 Tangerang',
                'parent_name' => 'Ibu Permana',
                'parent_phone' => '081234567997',
                'parent_email' => 'ibu.permana@parent.com',
                'registration_date' => '2023-01-15',
                'join_date' => '2023-01-15',
                'book_level' => 'Intermediate',
                'status' => 'active',
                'branch_code' => 'ABT003',
            ],

            // ABT004 - Lippo Mall Puri
            [
                'student_code' => 'STD-ABT004-001',
                'name' => 'Hana Safitri',
                'class' => '10',
                'gender' => 'female',
                'phone' => '081234567908',
                'address' => 'Jl. Puri Indah No. 15, Jakarta Barat',
                'place_of_birth' => 'Jakarta',
                'date_of_birth' => '2008-06-22',
                'religion' => 'Islam',
                'school_name' => 'SMP Negeri 6 Jakarta',
                'parent_name' => 'Bapak Safitri',
                'parent_phone' => '081234567998',
                'parent_email' => 'bapak.safitri@parent.com',
                'registration_date' => '2024-01-25',
                'join_date' => '2024-01-25',
                'book_level' => 'Beginner',
                'status' => 'active',
                'branch_code' => 'ABT004',
            ],
        ];

        foreach ($students as $student) {
            $branchId = $branches[$student['branch_code']] ?? null;

            if ($branchId) {
                // Create user account for student
                $user = User::create([
                    'name' => $student['name'],
                    'email' => $student['student_code'] . '@student.com',
                    'password' => Hash::make('password123'),
                    'branch_id' => $branchId,
                    'email_verified_at' => now(),
                ]);
                $user->assignRole('student');

                // Create student record
                Student::create([
                    'branch_id' => $branchId,
                    'user_id' => $user->id,
                    'student_code' => $student['student_code'],
                    'name' => $student['name'],
                    'gender' => $student['gender'],
                    'address' => $student['address'],
                    'place_of_birth' => $student['place_of_birth'],
                    'date_of_birth' => $student['date_of_birth'],
                    'religion' => $student['religion'],
                    'phone' => $student['phone'],
                    'school_name' => $student['school_name'],
                    'class' => $student['class'],
                    'parent_name' => $student['parent_name'],
                    'parent_phone' => $student['parent_phone'],
                    'parent_email' => $student['parent_email'],
                    'registration_date' => $student['registration_date'],
                    'join_date' => $student['join_date'],
                    'book_level' => $student['book_level'],
                    'status' => $student['status'],
                    'created_by' => 1, // Super Admin ID
                ]);
            }
        }

        $this->command->info('✅ Students seeded successfully!');
        $this->command->info('📌 Student accounts:');
        $this->command->info('   STD-ABT001-001@student.com / password123 (Andi Wijaya)');
        $this->command->info('   STD-ABT001-002@student.com / password123 (Bella Putri)');
        $this->command->info('   STD-ABT001-003@student.com / password123 (Charlie Saputra)');
        $this->command->info('   STD-ABT002-001@student.com / password123 (Dinda Aulia)');
        $this->command->info('   STD-ABT002-002@student.com / password123 (Eka Prasetyo)');
        $this->command->info('   STD-ABT003-001@student.com / password123 (Fani Ramadhani)');
        $this->command->info('   STD-ABT003-002@student.com / password123 (Gilang Permana)');
        $this->command->info('   STD-ABT004-001@student.com / password123 (Hana Safitri)');
    }
}
