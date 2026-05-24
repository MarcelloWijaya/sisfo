<?php

namespace Database\Seeders;

use App\Models\Branch;
use App\Models\Teacher;
use Illuminate\Database\Seeder;

class TeacherSeeder extends Seeder
{
    public function run(): void
    {
        $branches = Branch::pluck('id', 'code');

        $teachers = [
            [
                'teacher_number' => 'TCH-ABT001-001',
                'name' => 'Budi Santoso, S.Pd',
                'phone' => '081234567801',
                'email' => 'budi.santoso@teacher.com',
                'last_education' => 'S.Pd Matematika',
                'status' => 'active',
                'branch_id' => $branches['ABT001'],
            ],
            [
                'teacher_number' => 'TCH-ABT001-002',
                'name' => 'Siti Aminah, M.Pd',
                'phone' => '081234567802',
                'email' => 'siti.aminah@teacher.com',
                'last_education' => 'M.Pd Bahasa Inggris',
                'status' => 'active',
                'branch_id' => $branches['ABT001'],
            ],
            [
                'teacher_number' => 'TCH-ABT002-001',
                'name' => 'Ahmad Fauzi',
                'phone' => '081234567803',
                'email' => 'ahmad.fauzi@teacher.com',
                'last_education' => 'S.Pd Fisika',
                'status' => 'active',
                'branch_id' => $branches['ABT002'],
            ],
            [
                'teacher_number' => 'TCH-ABT003-001',
                'name' => 'Dewi Kartika',
                'phone' => '081234567804',
                'email' => 'dewi.kartika@teacher.com',
                'last_education' => 'S.Si Kimia',
                'status' => 'active',
                'branch_id' => $branches['ABT003'],
            ],
        ];

        foreach ($teachers as $teacher) {
            Teacher::updateOrCreate(['teacher_number' => $teacher['teacher_number']], $teacher);
        }

        $this->command->info('✅ Teachers seeded successfully!');
    }
}
