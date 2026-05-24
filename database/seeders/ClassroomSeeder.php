<?php

namespace Database\Seeders;

use App\Models\Branch;
use App\Models\Teacher;
use App\Models\Classroom;
use Illuminate\Database\Seeder;

class ClassroomSeeder extends Seeder
{
    public function run(): void
    {
        $branches = Branch::pluck('id', 'code');
        $teachers = Teacher::pluck('id', 'teacher_code'); // Ganti teacher_number -> teacher_code

        $classrooms = [
            // ABT001 - Taman Semanan
            [
                'day' => 'Monday',
                'start_time' => '10:00:00',
                'end_time' => '11:00:00',
                'room' => 'A-101',
                'level' => 'Beginner',
                'activity' => 'English Conversation',
                'quota' => 20,
                'status' => 'active',
                'branch_id' => $branches['ABT001'],
                'teacher_id' => $teachers['TCH-ABT001-001'] ?? 1,
            ],
            [
                'day' => 'Monday',
                'start_time' => '11:00:00',
                'end_time' => '12:00:00',
                'room' => 'A-101',
                'level' => 'Intermediate',
                'activity' => 'English Grammar',
                'quota' => 20,
                'status' => 'active',
                'branch_id' => $branches['ABT001'],
                'teacher_id' => $teachers['TCH-ABT001-002'] ?? 1,
            ],
            [
                'day' => 'Tuesday',
                'start_time' => '10:00:00',
                'end_time' => '11:00:00',
                'room' => 'A-101',
                'level' => 'Beginner',
                'activity' => 'Mathematics Basic',
                'quota' => 20,
                'status' => 'active',
                'branch_id' => $branches['ABT001'],
                'teacher_id' => $teachers['TCH-ABT001-003'] ?? 1,
            ],
            [
                'day' => 'Wednesday',
                'start_time' => '13:30:00',
                'end_time' => '14:30:00',
                'room' => 'B-202',
                'level' => 'Advanced',
                'activity' => 'Science Class',
                'quota' => 15,
                'status' => 'active',
                'branch_id' => $branches['ABT001'],
                'teacher_id' => $teachers['TCH-ABT001-001'] ?? 1,
            ],

            // ABT002 - Kosambi Baru
            [
                'day' => 'Thursday',
                'start_time' => '10:00:00',
                'end_time' => '11:00:00',
                'room' => 'D-404',
                'level' => 'Beginner',
                'activity' => 'English Class',
                'quota' => 20,
                'status' => 'active',
                'branch_id' => $branches['ABT002'],
                'teacher_id' => $teachers['TCH-ABT002-001'] ?? 1,
            ],
            [
                'day' => 'Friday',
                'start_time' => '13:30:00',
                'end_time' => '14:30:00',
                'room' => 'E-505',
                'level' => 'Intermediate',
                'activity' => 'Chemistry Lab',
                'quota' => 15,
                'status' => 'active',
                'branch_id' => $branches['ABT002'],
                'teacher_id' => $teachers['TCH-ABT002-001'] ?? 1,
            ],

            // ABT003 - Green Lake City
            [
                'day' => 'Monday',
                'start_time' => '15:00:00',
                'end_time' => '16:00:00',
                'room' => 'F-606',
                'level' => 'Advanced',
                'activity' => 'Biology Class',
                'quota' => 15,
                'status' => 'active',
                'branch_id' => $branches['ABT003'],
                'teacher_id' => $teachers['TCH-ABT003-001'] ?? 1,
            ],
            [
                'day' => 'Saturday',
                'start_time' => '09:00:00',
                'end_time' => '10:00:00',
                'room' => 'F-606',
                'level' => 'Beginner',
                'activity' => 'English for Kids',
                'quota' => 25,
                'status' => 'active',
                'branch_id' => $branches['ABT003'],
                'teacher_id' => $teachers['TCH-ABT003-001'] ?? 1,
            ],
        ];

        foreach ($classrooms as $classroom) {
            Classroom::updateOrCreate(
                [
                    'branch_id' => $classroom['branch_id'],
                    'day' => $classroom['day'],
                    'start_time' => $classroom['start_time'],
                    'room' => $classroom['room'],
                ],
                $classroom,
            );
        }

        $this->command->info('✅ Classrooms seeded successfully!');
    }
}
