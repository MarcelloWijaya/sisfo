<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Teacher;
use App\Models\Branch;

class TeacherSeeder extends Seeder
{
    public function run(): void
    {
        $branches = Branch::all();

        $teachers = [
            // Jakarta Teachers
            [
                'teacher_id' => 'TCH-JKT-001',
                'full_name' => 'Budi Santoso, S.Pd',
                'phone' => '081234567801',
                'email' => 'budi.santoso@teacher.com',
                'qualification' => 'S.Pd Matematika',
                'status' => 'active',
                'branch_id' => $branches->where('code', 'JKT001')->first()->id,
            ],
            [
                'teacher_id' => 'TCH-JKT-002',
                'full_name' => 'Siti Aminah, M.Pd',
                'phone' => '081234567802',
                'email' => 'siti.aminah@teacher.com',
                'qualification' => 'M.Pd Bahasa Inggris',
                'status' => 'active',
                'branch_id' => $branches->where('code', 'JKT001')->first()->id,
            ],
            [
                'teacher_id' => 'TCH-JKT-003',
                'full_name' => 'Drs. Ahmad Fauzi',
                'phone' => '081234567803',
                'email' => 'ahmad.fauzi@teacher.com',
                'qualification' => 'S.Pd Fisika',
                'status' => 'active',
                'branch_id' => $branches->where('code', 'JKT001')->first()->id,
            ],
            // Bandung Teachers
            [
                'teacher_id' => 'TCH-BDG-001',
                'full_name' => 'Dewi Kartika, S.Si',
                'phone' => '081234567804',
                'email' => 'dewi.kartika@teacher.com',
                'qualification' => 'S.Si Kimia',
                'status' => 'active',
                'branch_id' => $branches->where('code', 'BDG001')->first()->id,
            ],
            [
                'teacher_id' => 'TCH-BDG-002',
                'full_name' => 'Rizki Pratama, S.Pd',
                'phone' => '081234567805',
                'email' => 'rizki.pratama@teacher.com',
                'qualification' => 'S.Pd Olahraga',
                'status' => 'active',
                'branch_id' => $branches->where('code', 'BDG001')->first()->id,
            ],
            // Surabaya Teachers
            [
                'teacher_id' => 'TCH-SBY-001',
                'full_name' => 'Lestari Handayani, S.Pd',
                'phone' => '081234567806',
                'email' => 'lestari.handayani@teacher.com',
                'qualification' => 'S.Pd Biologi',
                'status' => 'active',
                'branch_id' => $branches->where('code', 'SBY001')->first()->id,
            ],
        ];

        foreach ($teachers as $teacher) {
            Teacher::create($teacher);
        }

        $this->command->info('✅ Teachers seeded successfully!');
    }
}
