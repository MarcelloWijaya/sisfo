<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Classroom;
use App\Models\Branch;
use App\Models\Teacher;

class ClassroomSeeder extends Seeder
{
    public function run(): void
    {
        $branches = Branch::all();

        $classrooms = [
            // Jakarta Schedules
            [
                'day' => 'Monday',
                'start_time' => '10:00:00',
                'end_time' => '11:00:00',
                'room' => 'A-101',
                'level' => 'Beginner',
                'activity' => 'English Conversation',
                'quota' => 20,
                'status' => 'active',
                'branch_id' => $branches->where('code', 'JKT001')->first()->id,
                'teacher_id' => Teacher::where('teacher_id', 'TCH-JKT-001')->first()->id ?? 1,
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
                'branch_id' => $branches->where('code', 'JKT001')->first()->id,
                'teacher_id' => Teacher::where('teacher_id', 'TCH-JKT-002')->first()->id ?? 1,
            ],
            [
                'day' => 'Monday',
                'start_time' => '13:30:00',
                'end_time' => '14:30:00',
                'room' => 'B-202',
                'level' => 'Advanced',
                'activity' => 'IELTS Preparation',
                'quota' => 15,
                'status' => 'active',
                'branch_id' => $branches->where('code', 'JKT001')->first()->id,
                'teacher_id' => Teacher::where('teacher_id', 'TCH-JKT-002')->first()->id ?? 1,
            ],
            [
                'day' => 'Tuesday',
                'start_time' => '10:00:00',
                'end_time' => '11:00:00',
                'room' => 'C-303',
                'level' => 'Beginner',
                'activity' => 'Mathematics Basic',
                'quota' => 20,
                'status' => 'active',
                'branch_id' => $branches->where('code', 'JKT001')->first()->id,
                'teacher_id' => Teacher::where('teacher_id', 'TCH-JKT-001')->first()->id ?? 1,
            ],
            [
                'day' => 'Wednesday',
                'start_time' => '16:00:00',
                'end_time' => '17:00:00',
                'room' => 'A-101',
                'level' => 'Intermediate',
                'activity' => 'Science Class',
                'quota' => 25,
                'status' => 'active',
                'branch_id' => $branches->where('code', 'JKT001')->first()->id,
                'teacher_id' => Teacher::where('teacher_id', 'TCH-JKT-003')->first()->id ?? 1,
            ],
            // Bandung Schedules
            [
                'day' => 'Monday',
                'start_time' => '10:00:00',
                'end_time' => '11:00:00',
                'room' => 'D-404',
                'level' => 'Beginner',
                'activity' => 'English Class',
                'quota' => 20,
                'status' => 'active',
                'branch_id' => $branches->where('code', 'BDG001')->first()->id,
                'teacher_id' => Teacher::where('teacher_id', 'TCH-BDG-001')->first()->id ?? 2,
            ],
            [
                'day' => 'Wednesday',
                'start_time' => '15:00:00',
                'end_time' => '16:00:00',
                'room' => 'E-505',
                'level' => 'Intermediate',
                'activity' => 'Sports Class',
                'quota' => 30,
                'status' => 'active',
                'branch_id' => $branches->where('code', 'BDG001')->first()->id,
                'teacher_id' => Teacher::where('teacher_id', 'TCH-BDG-002')->first()->id ?? 2,
            ],
        ];

        foreach ($classrooms as $classroom) {
            Classroom::create($classroom);
        }

        $this->command->info('✅ Classrooms (schedules) seeded successfully!');
    }
}
