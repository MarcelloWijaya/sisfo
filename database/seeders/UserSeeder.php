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
        // Buat branch/cabang dulu
        $branch1 = Branch::create([
            'code' => 'JKT001',
            'name' => 'Anaku Educare Jakarta',
            'address' => 'Jl. Sudirman No. 123, Jakarta Pusat',
            'phone' => '021-1234567',
            'email' => 'jakarta@anaku.com',
            'status' => 'active',
        ]);

        $branch2 = Branch::create([
            'code' => 'BDG001',
            'name' => 'Anaku Educare Bandung',
            'address' => 'Jl. Setiabudi No. 45, Bandung',
            'phone' => '022-1234567',
            'email' => 'bandung@anaku.com',
            'status' => 'active',
        ]);

        $branch3 = Branch::create([
            'code' => 'SBY001',
            'name' => 'Anaku Educare Surabaya',
            'address' => 'Jl. Raya Darmo No. 78, Surabaya',
            'phone' => '031-1234567',
            'email' => 'surabaya@anaku.com',
            'status' => 'active',
        ]);

        // ========== SUPER ADMIN ==========
        $superAdmin = User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@anaku.com',
            'password' => Hash::make('password123'),
            'email_verified_at' => now(),
        ]);
        $superAdmin->assignRole('super_admin');

        // ========== DIRECTOR ==========
        $director = User::create([
            'name' => 'Director Anaku',
            'email' => 'director@anaku.com',
            'password' => Hash::make('password123'),
            'email_verified_at' => now(),
        ]);
        $director->assignRole('director');

        // ========== BRANCH ADMINS ==========
        // Jakarta Branch Admin
        $adminJkt = User::create([
            'name' => 'Admin Jakarta',
            'email' => 'admin.jakarta@anaku.com',
            'password' => Hash::make('password123'),
            'email_verified_at' => now(),
        ]);
        $adminJkt->assignRole('branch_admin');
        $adminJkt->branches()->attach($branch1->id, ['assigned_by' => $superAdmin->id]);

        // Bandung Branch Admin
        $adminBdg = User::create([
            'name' => 'Admin Bandung',
            'email' => 'admin.bandung@anaku.com',
            'password' => Hash::make('password123'),
            'email_verified_at' => now(),
        ]);
        $adminBdg->assignRole('branch_admin');
        $adminBdg->branches()->attach($branch2->id, ['assigned_by' => $superAdmin->id]);

        // Surabaya Branch Admin
        $adminSby = User::create([
            'name' => 'Admin Surabaya',
            'email' => 'admin.surabaya@anaku.com',
            'password' => Hash::make('password123'),
            'email_verified_at' => now(),
        ]);
        $adminSby->assignRole('branch_admin');
        $adminSby->branches()->attach($branch3->id, ['assigned_by' => $superAdmin->id]);

        // ========== TEACHERS ==========
        // Guru Jakarta
        $teacherJkt1 = User::create([
            'name' => 'Budi Santoso',
            'email' => 'budi.santoso@anaku.com',
            'password' => Hash::make('password123'),
            'email_verified_at' => now(),
        ]);
        $teacherJkt1->assignRole('teacher');
        $teacherJkt1->branches()->attach($branch1->id, ['assigned_by' => $adminJkt->id]);

        $teacherJkt2 = User::create([
            'name' => 'Siti Aminah',
            'email' => 'siti.aminah@anaku.com',
            'password' => Hash::make('password123'),
            'email_verified_at' => now(),
        ]);
        $teacherJkt2->assignRole('teacher');
        $teacherJkt2->branches()->attach($branch1->id, ['assigned_by' => $adminJkt->id]);

        // Guru Bandung
        $teacherBdg1 = User::create([
            'name' => 'Ahmad Fauzi',
            'email' => 'ahmad.fauzi@anaku.com',
            'password' => Hash::make('password123'),
            'email_verified_at' => now(),
        ]);
        $teacherBdg1->assignRole('teacher');
        $teacherBdg1->branches()->attach($branch2->id, ['assigned_by' => $adminBdg->id]);

        // Guru Surabaya
        $teacherSby1 = User::create([
            'name' => 'Dewi Kartika',
            'email' => 'dewi.kartika@anaku.com',
            'password' => Hash::make('password123'),
            'email_verified_at' => now(),
        ]);
        $teacherSby1->assignRole('teacher');
        $teacherSby1->branches()->attach($branch3->id, ['assigned_by' => $adminSby->id]);

        // ========== STUDENTS ==========
        // Students Jakarta
        $studentJkt1 = User::create([
            'name' => 'Andi Wijaya',
            'email' => 'andi.wijaya@student.com',
            'password' => Hash::make('password123'),
            'email_verified_at' => now(),
        ]);
        $studentJkt1->assignRole('student');
        $studentJkt1->branches()->attach($branch1->id, ['assigned_by' => $adminJkt->id]);

        $studentJkt2 = User::create([
            'name' => 'Bella Putri',
            'email' => 'bella.putri@student.com',
            'password' => Hash::make('password123'),
            'email_verified_at' => now(),
        ]);
        $studentJkt2->assignRole('student');
        $studentJkt2->branches()->attach($branch1->id, ['assigned_by' => $adminJkt->id]);

        $studentJkt3 = User::create([
            'name' => 'Charlie Saputra',
            'email' => 'charlie.saputra@student.com',
            'password' => Hash::make('password123'),
            'email_verified_at' => now(),
        ]);
        $studentJkt3->assignRole('student');
        $studentJkt3->branches()->attach($branch1->id, ['assigned_by' => $adminJkt->id]);

        // Students Bandung
        $studentBdg1 = User::create([
            'name' => 'Dina Febriani',
            'email' => 'dina.febriani@student.com',
            'password' => Hash::make('password123'),
            'email_verified_at' => now(),
        ]);
        $studentBdg1->assignRole('student');
        $studentBdg1->branches()->attach($branch2->id, ['assigned_by' => $adminBdg->id]);

        // Students Surabaya
        $studentSby1 = User::create([
            'name' => 'Eko Prasetyo',
            'email' => 'eko.prasetyo@student.com',
            'password' => Hash::make('password123'),
            'email_verified_at' => now(),
        ]);
        $studentSby1->assignRole('student');
        $studentSby1->branches()->attach($branch3->id, ['assigned_by' => $adminSby->id]);

        // ========== PARENTS ==========
        $parentJkt1 = User::create([
            'name' => 'Bapak Wijaya',
            'email' => 'bapak.wijaya@parent.com',
            'password' => Hash::make('password123'),
            'email_verified_at' => now(),
        ]);
        $parentJkt1->assignRole('parent');
        $parentJkt1->branches()->attach($branch1->id, ['assigned_by' => $adminJkt->id]);
        // Relasi parent ke student
        $parentJkt1->children()->attach($studentJkt1->id);

        $parentJkt2 = User::create([
            'name' => 'Ibu Putri',
            'email' => 'ibu.putri@parent.com',
            'password' => Hash::make('password123'),
            'email_verified_at' => now(),
        ]);
        $parentJkt2->assignRole('parent');
        $parentJkt2->branches()->attach($branch1->id, ['assigned_by' => $adminJkt->id]);
        $parentJkt2->children()->attach($studentJkt2->id);

        $this->command->info('✅ Users seeded successfully!');
        $this->command->info('📌 Super Admin: superadmin@anaku.com / password123');
        $this->command->info('📌 Director: director@anaku.com / password123');
        $this->command->info('📌 Admin Jakarta: admin.jakarta@anaku.com / password123');
        $this->command->info('📌 Teacher: budi.santoso@anaku.com / password123');
        $this->command->info('📌 Student: andi.wijaya@student.com / password123');
        $this->command->info('📌 Parent: bapak.wijaya@parent.com / password123');
    }
}
