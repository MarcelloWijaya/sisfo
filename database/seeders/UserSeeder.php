<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Branch;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // ============================================
        // SUPER ADMIN (PUSAT)
        // ============================================
        $superAdmin = User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@anaku.com',
            'password' => Hash::make('password123'),
            'email_verified_at' => now(),
        ]);
        $superAdmin->assignRole('super_admin');

        // ============================================
        // DIRECTOR (DIREKTUR UTAMA)
        // ============================================
        $director = User::create([
            'name' => 'Director Anaku',
            'email' => 'director@anaku.com',
            'password' => Hash::make('password123'),
            'email_verified_at' => now(),
        ]);
        $director->assignRole('director');

        // ============================================
        // AMBIL SEMUA CABANG DARI DATABASE
        // ============================================
        $branches = Branch::all();

        // Data user untuk setiap cabang
        $usersByBranch = [
            'ABT001' => [
                // ABT Taman Semanan
                'director_email' => 'drc_taman_semanan_indah@sip.com',
                'admin_email' => 'admin_taman_semanan_indah@sip.com',
                'director_name' => 'Director Taman Semanan Indah',
                'admin_name' => 'Admin Taman Semanan Indah',
            ],
            'ABT002' => [
                // ABT Kosambi Baru
                'director_email' => 'drc_kosambi_baru@sip.com',
                'admin_email' => 'admin_kosambi_baru@sip.com',
                'director_name' => 'Director Kosambi Baru',
                'admin_name' => 'Admin Kosambi Baru',
            ],
            'ABT003' => [
                // ABT Green Lake City
                'director_email' => 'drc_green_lake_city@sip.com',
                'admin_email' => 'admin_green_lake_city@sip.com',
                'director_name' => 'Director Green Lake City',
                'admin_name' => 'Admin Green Lake City',
            ],
            'ABT004' => [
                // ABT Lippo Mall Puri
                'director_email' => 'drc_lippo_mall_puri@sip.com',
                'admin_email' => 'admin_lippo_mall_puri@sip.com',
                'director_name' => 'Director Lippo Mall Puri',
                'admin_name' => 'Admin Lippo Mall Puri',
            ],
            'ABT005' => [
                // ABT Permata Buana
                'director_email' => 'drc_permata_buana@sip.com',
                'admin_email' => 'admin_permata_buana@sip.com',
                'director_name' => 'Director Permata Buana',
                'admin_name' => 'Admin Permata Buana',
            ],
            'ABT006' => [
                // ABT Citra 2 Extension
                'director_email' => 'drc_citra_2_extension@sip.com',
                'admin_email' => 'admin_citra_2_extension@sip.com',
                'director_name' => 'Director Citra 2 Extension',
                'admin_name' => 'Admin Citra 2 Extension',
            ],
            'ABT007' => [
                // ABT Tokyo Hub PIK 2
                'director_email' => 'drc_tokyo_hub_pik2@sip.com',
                'admin_email' => 'admin_tokyo_hub_pik2@sip.com',
                'director_name' => 'Director Tokyo Hub PIK 2',
                'admin_name' => 'Admin Tokyo Hub PIK 2',
            ],
            'ABT008' => [
                // ABT Lippo Plaza Bogor
                'director_email' => 'drc_lippo_plaza_bogor@sip.com',
                'admin_email' => 'admin_lippo_plaza_bogor@sip.com',
                'director_name' => 'Director Lippo Plaza Bogor',
                'admin_name' => 'Admin Lippo Plaza Bogor',
            ],
            'ABT009' => [
                // ABT ITC Depok
                'director_email' => 'drc_itc_depok@sip.com',
                'admin_email' => 'admin_itc_depok@sip.com',
                'director_name' => 'Director ITC Depok',
                'admin_name' => 'Admin ITC Depok',
            ],
        ];

        // Buat Director dan Admin untuk setiap cabang
        foreach ($branches as $branch) {
            $branchData = $usersByBranch[$branch->code] ?? null;

            if ($branchData) {
                // Buat DIRECTOR untuk cabang ini
                $branchDirector = User::create([
                    'name' => $branchData['director_name'],
                    'email' => $branchData['director_email'],
                    'password' => Hash::make('password123'),
                    'email_verified_at' => now(),
                    'branch_id' => $branch->id,
                ]);
                $branchDirector->assignRole('director');

                // Buat ADMIN untuk cabang ini
                $branchAdmin = User::create([
                    'name' => $branchData['admin_name'],
                    'email' => $branchData['admin_email'],
                    'password' => Hash::make('password123'),
                    'email_verified_at' => now(),
                    'branch_id' => $branch->id,
                ]);
                $branchAdmin->assignRole('branch_admin');
            }
        }

        // ============================================
        // SAMPLE TEACHERS
        // ============================================
        $teachers = [['name' => 'Budi Santoso', 'email' => 'budi.santoso@teacher.com', 'branch_code' => 'ABT001'], ['name' => 'Siti Aminah', 'email' => 'siti.aminah@teacher.com', 'branch_code' => 'ABT002'], ['name' => 'Ahmad Fauzi', 'email' => 'ahmad.fauzi@teacher.com', 'branch_code' => 'ABT003'], ['name' => 'Dewi Kartika', 'email' => 'dewi.kartika@teacher.com', 'branch_code' => 'ABT004'], ['name' => 'Rizki Pratama', 'email' => 'rizki.pratama@teacher.com', 'branch_code' => 'ABT005'], ['name' => 'Lestari Handayani', 'email' => 'lestari.handayani@teacher.com', 'branch_code' => 'ABT006']];

        foreach ($teachers as $teacher) {
            $branch = Branch::where('code', $teacher['branch_code'])->first();
            if ($branch) {
                $user = User::create([
                    'name' => $teacher['name'],
                    'email' => $teacher['email'],
                    'password' => Hash::make('password123'),
                    'email_verified_at' => now(),
                    'branch_id' => $branch->id,
                ]);
                $user->assignRole('teacher');
            }
        }

        // ============================================
        // SAMPLE STUDENTS
        // ============================================
        $students = [['name' => 'Andi Wijaya', 'email' => 'andi.wijaya@student.com', 'nis' => '20240001', 'branch_code' => 'ABT001'], ['name' => 'Bella Putri', 'email' => 'bella.putri@student.com', 'nis' => '20240002', 'branch_code' => 'ABT001'], ['name' => 'Charlie Saputra', 'email' => 'charlie.saputra@student.com', 'nis' => '20240003', 'branch_code' => 'ABT002'], ['name' => 'Dina Febriani', 'email' => 'dina.febriani@student.com', 'nis' => '20240004', 'branch_code' => 'ABT003'], ['name' => 'Eko Prasetyo', 'email' => 'eko.prasetyo@student.com', 'nis' => '20240005', 'branch_code' => 'ABT004']];

        foreach ($students as $student) {
            $branch = Branch::where('code', $student['branch_code'])->first();
            if ($branch) {
                $user = User::create([
                    'name' => $student['name'],
                    'email' => $student['email'],
                    'password' => Hash::make('password123'),
                    'email_verified_at' => now(),
                    'branch_id' => $branch->id,
                ]);
                $user->assignRole('student');
            }
        }

        // ============================================
        // SAMPLE PARENTS
        // ============================================
        $parents = [['name' => 'Bapak Wijaya', 'email' => 'bapak.wijaya@parent.com', 'student_id' => 1], ['name' => 'Ibu Putri', 'email' => 'ibu.putri@parent.com', 'student_id' => 2]];

        foreach ($parents as $parent) {
            $user = User::create([
                'name' => $parent['name'],
                'email' => $parent['email'],
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
            ]);
            $user->assignRole('parent');
        }

        $this->command->info('✅ Users seeded successfully!');
        $this->command->info('📌 Super Admin: superadmin@anaku.com / password123');
        $this->command->info('📌 Director Utama: director@anaku.com / password123');
        $this->command->info('📌 Director Taman Semanan: drc_taman_semanan_indah@sip.com / password123');
        $this->command->info('📌 Admin Taman Semanan: admin_taman_semanan_indah@sip.com / password123');
        $this->command->info('📌 Teacher: budi.santoso@teacher.com / password123');
        $this->command->info('📌 Student: andi.wijaya@student.com / password123');
    }
}
