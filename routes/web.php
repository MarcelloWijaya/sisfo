<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\BranchController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\TeacherController;
use App\Http\Controllers\Admin\ClassroomController;
use App\Http\Controllers\Admin\ScheduleController;
use App\Http\Controllers\Admin\StudentAttendanceController;
use App\Http\Controllers\Admin\TeacherAttendanceController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/login');
});

// Language switch
Route::get('lang/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'id'])) {
        session()->put('locale', $locale);
    }
    return redirect()->back();
})->name('lang.switch');

// Dashboard redirect (role-based)
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth'])
    ->name('dashboard');

// Super Admin only
Route::middleware(['auth', 'role:super_admin'])->group(function () {
    Route::view('/admin/dashboard', 'admin.dashboard')->name('admin.dashboard');
    Route::resource('branches', BranchController::class);
});

// Super Admin + Director
Route::middleware(['auth', 'role:super_admin|director'])->group(function () {
    Route::view('/director/dashboard', 'director.dashboard')->name('director.dashboard');
});

// Branch Admin
Route::middleware(['auth', 'role:super_admin|branch_admin'])->group(function () {
    Route::view('/branch/dashboard', 'branch.dashboard')->name('branch.dashboard');
    Route::resource('students', StudentController::class);
    Route::resource('teachers', TeacherController::class);
    Route::resource('classrooms', ClassroomController::class);
    Route::resource('schedules', ScheduleController::class);
    Route::get('/schedules/branch-data', [ScheduleController::class, 'getByBranch'])->name('schedules.branch-data');

    Route::prefix('attendance')
        ->name('attendance.')
        ->group(function () {
            Route::resource('student', StudentAttendanceController::class);
            Route::get('student/bulk/create', [StudentAttendanceController::class, 'bulkCreate'])->name('student.bulk.create');
            Route::post('student/bulk/store', [StudentAttendanceController::class, 'bulkStore'])->name('student.bulk.store');
            Route::get('student/get-students', [StudentAttendanceController::class, 'getStudentsBySchedule'])->name('student.get-students');

            // Teacher Attendance
            Route::resource('teacher', TeacherAttendanceController::class);
            Route::get('teacher/bulk/create', [TeacherAttendanceController::class, 'bulkCreate'])->name('teacher.bulk.create');
            Route::post('teacher/bulk/store', [TeacherAttendanceController::class, 'bulkStore'])->name('teacher.bulk.store');
        });
});

// Teacher
Route::middleware(['auth', 'role:super_admin|branch_admin|teacher'])->group(function () {
    Route::view('/teacher/dashboard', 'teacher.dashboard')->name('teacher.dashboard');
});

// Student
Route::middleware(['auth', 'role:student'])->group(function () {
    Route::view('/student/dashboard', 'student.dashboard')->name('student.dashboard');
});

// Parent
Route::middleware(['auth', 'role:parent'])->group(function () {
    Route::view('/parent/dashboard', 'parent.dashboard')->name('parent.dashboard');
});

// Profile (semua role)
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
