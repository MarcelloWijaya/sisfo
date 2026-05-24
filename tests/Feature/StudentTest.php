<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Student;

class StudentTest extends TestCase
{
    public function test_can_view_students()
    {
        $user = User::factory()->create();
        $user->assignRole('super_admin');

        $response = $this->actingAs($user)->get(route('students.index'));

        $response->assertStatus(200);
    }

    public function test_can_create_student()
    {
        $user = User::factory()->create();
        $user->assignRole('super_admin');

        $data = [
            'nis' => '2024001',
            'name' => 'Test Student',
            'class' => '10',
            'gender' => 'male',
        ];

        $response = $this->actingAs($user)->post(route('students.store'), $data);

        $response->assertRedirect();
        $this->assertDatabaseHas('students', ['nis' => '2024001']);
    }
}
