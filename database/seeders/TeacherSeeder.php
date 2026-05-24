<?php

namespace Database\Seeders;

use App\Models\Branch;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class TeacherSeeder extends Seeder
{
    public function run(): void
    {
        $branches = Branch::pluck('id', 'code');

        $teachers = [
            // ABT001 - Taman Semanan
            [
                'teacher_code' => 'TCH-ABT001-001',
                'name' => 'Budi Santoso, S.Pd',
                'nickname' => 'Budi',
                'gender' => 'male',
                'phone' => '081234567801',
                'email' => 'budi.santoso@anaku.com',
                'address' => 'Jl. Taman Semanan Indah No. 1, Jakarta Barat',
                'place_of_birth' => 'Jakarta',
                'date_of_birth' => '1985-05-15',
                'last_education' => 'S1 Pendidikan Matematika',
                'qualification' => 'Sertifikasi Guru Profesional',
                'status' => 'active',
                'branch_code' => 'ABT001',
            ],
            [
                'teacher_code' => 'TCH-ABT001-002',
                'name' => 'Siti Aminah, M.Pd',
                'nickname' => 'Siti',
                'gender' => 'female',
                'phone' => '081234567802',
                'email' => 'siti.aminah@anaku.com',
                'address' => 'Jl. Daan Mogot No. 123, Jakarta Barat',
                'place_of_birth' => 'Bandung',
                'date_of_birth' => '1988-08-20',
                'last_education' => 'S2 Pendidikan Bahasa Inggris',
                'qualification' => 'TOEFL Certified',
                'status' => 'active',
                'branch_code' => 'ABT001',
            ],
            [
                'teacher_code' => 'TCH-ABT001-003',
                'name' => 'Drs. Ahmad Fauzi',
                'nickname' => 'Ahmad',
                'gender' => 'male',
                'phone' => '081234567803',
                'email' => 'ahmad.fauzi@anaku.com',
                'address' => 'Jl. Kapuk Raya No. 45, Jakarta Barat',
                'place_of_birth' => 'Jakarta',
                'date_of_birth' => '1982-03-10',
                'last_education' => 'S1 Pendidikan Fisika',
                'qualification' => 'Sertifikasi Fisika',
                'status' => 'active',
                'branch_code' => 'ABT001',
            ],

            // ABT002 - Kosambi Baru
            [
                'teacher_code' => 'TCH-ABT002-001',
                'name' => 'Dewi Kartika, S.Si',
                'nickname' => 'Dewi',
                'gender' => 'female',
                'phone' => '081234567804',
                'email' => 'dewi.kartika@anaku.com',
                'address' => 'Jl. Kosambi Baru No. 10, Jakarta Barat',
                'place_of_birth' => 'Surabaya',
                'date_of_birth' => '1990-11-25',
                'last_education' => 'S1 Kimia',
                'qualification' => 'Lab Assistant Certified',
                'status' => 'active',
                'branch_code' => 'ABT002',
            ],
            [
                'teacher_code' => 'TCH-ABT002-002',
                'name' => 'Rizki Pratama, S.Pd',
                'nickname' => 'Rizki',
                'gender' => 'male',
                'phone' => '081234567805',
                'email' => 'rizki.pratama@anaku.com',
                'address' => 'Jl. Kosambi Baru No. 20, Jakarta Barat',
                'place_of_birth' => 'Bekasi',
                'date_of_birth' => '1992-07-18',
                'last_education' => 'S1 Olahraga',
                'qualification' => 'Pelatih Bersertifikat',
                'status' => 'active',
                'branch_code' => 'ABT002',
            ],

            // ABT003 - Green Lake City
            [
                'teacher_code' => 'TCH-ABT003-001',
                'name' => 'Lestari Handayani, S.Pd',
                'nickname' => 'Lestari',
                'gender' => 'female',
                'phone' => '081234567806',
                'email' => 'lestari.handayani@anaku.com',
                'address' => 'Jl. Green Lake City No. 5, Tangerang',
                'place_of_birth' => 'Tangerang',
                'date_of_birth' => '1989-04-12',
                'last_education' => 'S1 Biologi',
                'qualification' => 'Sertifikasi Biologi',
                'status' => 'active',
                'branch_code' => 'ABT003',
            ],
        ];

        foreach ($teachers as $teacher) {
            $branchId = $branches[$teacher['branch_code']] ?? null;

            if ($branchId) {
                // Create user account for teacher
                $user = User::create([
                    'name' => $teacher['name'],
                    'email' => $teacher['email'],
                    'password' => Hash::make('password123'),
                    'branch_id' => $branchId,
                    'email_verified_at' => now(),
                ]);
                $user->assignRole('teacher');

                // Create teacher record
                Teacher::create([
                    'branch_id' => $branchId,
                    'user_id' => $user->id,
                    'teacher_code' => $teacher['teacher_code'],
                    'name' => $teacher['name'],
                    'nickname' => $teacher['nickname'],
                    'gender' => $teacher['gender'],
                    'phone' => $teacher['phone'],
                    'email' => $teacher['email'],
                    'address' => $teacher['address'],
                    'place_of_birth' => $teacher['place_of_birth'],
                    'date_of_birth' => $teacher['date_of_birth'],
                    'last_education' => $teacher['last_education'],
                    'qualification' => $teacher['qualification'],
                    'status' => $teacher['status'],
                    'created_by' => 1, // Super Admin ID
                ]);
            }
        }

        $this->command->info('✅ Teachers seeded successfully!');
        $this->command->info('📌 Teacher accounts:');
        $this->command->info('   TCH-ABT001-001: budi.santoso@anaku.com / password123');
        $this->command->info('   TCH-ABT001-002: siti.aminah@anaku.com / password123');
        $this->command->info('   TCH-ABT001-003: ahmad.fauzi@anaku.com / password123');
        $this->command->info('   TCH-ABT002-001: dewi.kartika@anaku.com / password123');
        $this->command->info('   TCH-ABT002-002: rizki.pratama@anaku.com / password123');
        $this->command->info('   TCH-ABT003-001: lestari.handayani@anaku.com / password123');
    }
}
