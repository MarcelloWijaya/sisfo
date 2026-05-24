<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SuperAdmin\BranchController;
use App\Http\Controllers\SuperAdmin\StudentController;
use App\Http\Controllers\SuperAdmin\TeacherController;
use App\Http\Controllers\SuperAdmin\ClassroomController;
use App\Http\Controllers\SuperAdmin\ScheduleController;
use App\Http\Controllers\SuperAdmin\StudentAttendanceController;
use App\Http\Controllers\SuperAdmin\TeacherAttendanceController;
use App\Http\Controllers\SuperAdmin\InvoiceController;
use App\Http\Controllers\SuperAdmin\EnrollmentController;
use App\Http\Controllers\SuperAdmin\BranchPricingController;
use App\Http\Controllers\SuperAdmin\CouponController;
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

// ============================================
// SUPER ADMIN (SEMUA AKSES)
// ============================================
Route::middleware(['auth', 'role:super_admin'])->group(function () {
    // Dashboard
    Route::view('/admin/dashboard', 'admin.dashboard')->name('admin.dashboard');

    // Branches (full CRUD)
    Route::resource('branches', BranchController::class);

    // Students (full CRUD)
    Route::resource('students', StudentController::class);

    // Teachers (full CRUD)
    Route::resource('teachers', TeacherController::class);

    // Classrooms (full CRUD)
    Route::resource('classrooms', ClassroomController::class);

    // Schedules (full CRUD)
    Route::resource('schedules', ScheduleController::class);
    Route::get('/schedules/branch-data', [ScheduleController::class, 'getByBranch'])->name('schedules.branch-data');

    // Attendance (full CRUD)
    Route::prefix('attendance')
        ->name('attendance.')
        ->group(function () {
            Route::resource('student', StudentAttendanceController::class);
            Route::get('student/bulk/create', [StudentAttendanceController::class, 'bulkCreate'])->name('student.bulk.create');
            Route::post('student/bulk/store', [StudentAttendanceController::class, 'bulkStore'])->name('student.bulk.store');
            Route::get('student/get-students', [StudentAttendanceController::class, 'getStudentsBySchedule'])->name('student.get-students');

            Route::resource('teacher', TeacherAttendanceController::class);
            Route::get('teacher/bulk/create', [TeacherAttendanceController::class, 'bulkCreate'])->name('teacher.bulk.create');
            Route::post('teacher/bulk/store', [TeacherAttendanceController::class, 'bulkStore'])->name('teacher.bulk.store');
        });

    // Enrollments
    Route::resource('enrollments', EnrollmentController::class)->except(['show', 'edit', 'update']);

    // Invoices
    Route::resource('invoices', InvoiceController::class)->except(['edit', 'update', 'destroy']);
    Route::post('invoices/{invoice}/confirm-payment', [InvoiceController::class, 'confirmPayment'])->name('invoices.confirm-payment');
    Route::post('invoices/generate-for-enrollment', [InvoiceController::class, 'generateForEnrollment'])->name('invoices.generate-enrollment');
    Route::get('invoices/enrollments-by-student', [InvoiceController::class, 'getEnrollmentsByStudent'])->name('invoices.enrollments-by-student');

    // Coupons
    Route::get('coupons/{coupon}', [CouponController::class, 'show'])->name('coupons.show');
    Route::get('coupons/{coupon}/print', [CouponController::class, 'print'])->name('coupons.print');

    // Branch Pricings (full CRUD)
    Route::resource('branch-pricings', BranchPricingController::class);
});

// ============================================
// DIRECTOR (HANYA BISA LIHAT - READ ONLY)
// ============================================
Route::middleware(['auth', 'role:director'])->group(function () {
    // Dashboard
    Route::view('/director/dashboard', 'director.dashboard')->name('director.dashboard');

    // Students (hanya lihat)
    Route::get('students', [StudentController::class, 'index'])->name('students.index');
    Route::get('students/{student}', [StudentController::class, 'show'])->name('students.show');

    // Teachers (hanya lihat)
    Route::get('teachers', [TeacherController::class, 'index'])->name('teachers.index');
    Route::get('teachers/{teacher}', [TeacherController::class, 'show'])->name('teachers.show');

    // Classrooms (hanya lihat)
    Route::get('classrooms', [ClassroomController::class, 'index'])->name('classrooms.index');
    Route::get('classrooms/{classroom}', [ClassroomController::class, 'show'])->name('classrooms.show');

    // Schedules (hanya lihat)
    Route::get('schedules', [ScheduleController::class, 'index'])->name('schedules.index');
    Route::get('schedules/{schedule}', [ScheduleController::class, 'show'])->name('schedules.show');

    // Attendance Reports (hanya lihat laporan)
    Route::get('attendance/student', [StudentAttendanceController::class, 'index'])->name('attendance.student.index');
    Route::get('attendance/teacher', [TeacherAttendanceController::class, 'index'])->name('attendance.teacher.index');

    // Invoices (hanya lihat)
    Route::get('invoices', [InvoiceController::class, 'index'])->name('invoices.index');
    Route::get('invoices/{invoice}', [InvoiceController::class, 'show'])->name('invoices.show');

    // Branch Pricings (hanya lihat detail via dropdown)
    Route::get('director/pricing', [BranchPricingController::class, 'directorIndex'])->name('director.pricing');
    Route::get('director/pricing/{branchPricing}', [BranchPricingController::class, 'show'])->name('director.pricing.show');
});

// ============================================
// BRANCH ADMIN (MANAGE OWN BRANCH ONLY)
// ============================================
Route::middleware(['auth', 'role:branch_admin'])->group(function () {
    // Dashboard
    Route::view('/branch/dashboard', 'branch.dashboard')->name('branch.dashboard');

    // Students (full CRUD untuk cabang sendiri)
    Route::resource('students', StudentController::class);

    // Teachers (full CRUD untuk cabang sendiri)
    Route::resource('teachers', TeacherController::class);

    // Classrooms (full CRUD untuk cabang sendiri)
    Route::resource('classrooms', ClassroomController::class);

    // Schedules (full CRUD untuk cabang sendiri)
    Route::resource('schedules', ScheduleController::class);
    Route::get('/schedules/branch-data', [ScheduleController::class, 'getByBranch'])->name('schedules.branch-data');

    // Attendance (full CRUD untuk cabang sendiri)
    Route::prefix('attendance')
        ->name('attendance.')
        ->group(function () {
            Route::resource('student', StudentAttendanceController::class);
            Route::get('student/bulk/create', [StudentAttendanceController::class, 'bulkCreate'])->name('student.bulk.create');
            Route::post('student/bulk/store', [StudentAttendanceController::class, 'bulkStore'])->name('student.bulk.store');
            Route::get('student/get-students', [StudentAttendanceController::class, 'getStudentsBySchedule'])->name('student.get-students');

            Route::resource('teacher', TeacherAttendanceController::class);
            Route::get('teacher/bulk/create', [TeacherAttendanceController::class, 'bulkCreate'])->name('teacher.bulk.create');
            Route::post('teacher/bulk/store', [TeacherAttendanceController::class, 'bulkStore'])->name('teacher.bulk.store');
        });

    // Enrollments
    Route::resource('enrollments', EnrollmentController::class)->except(['show', 'edit', 'update']);

    // Invoices (create & index, tidak bisa edit/hapus)
    Route::resource('invoices', InvoiceController::class)->except(['edit', 'update', 'destroy']);
    Route::post('invoices/{invoice}/confirm-payment', [InvoiceController::class, 'confirmPayment'])->name('invoices.confirm-payment');
    Route::post('invoices/generate-for-enrollment', [InvoiceController::class, 'generateForEnrollment'])->name('invoices.generate-enrollment');
    Route::get('invoices/enrollments-by-student', [InvoiceController::class, 'getEnrollmentsByStudent'])->name('invoices.enrollments-by-student');

    // Coupons (hanya lihat)
    Route::get('coupons/{coupon}', [CouponController::class, 'show'])->name('coupons.show');
    Route::get('coupons/{coupon}/print', [CouponController::class, 'print'])->name('coupons.print');

    // Branch Pricings (hanya lihat untuk cabang sendiri)
    Route::get('branch-pricings', [BranchPricingController::class, 'index'])->name('branch-pricings.index');
    Route::get('branch-pricings/{branchPricing}', [BranchPricingController::class, 'show'])->name('branch-pricings.show');
});

// ============================================
// TEACHER (Akses terbatas)
// ============================================
Route::middleware(['auth', 'role:teacher'])->group(function () {
    Route::view('/teacher/dashboard', 'teacher.dashboard')->name('teacher.dashboard');

    // Attendance (hanya untuk mengisi absensi murid)
    Route::get('attendance/student', [StudentAttendanceController::class, 'index'])->name('attendance.student.index');
    Route::get('attendance/student/create', [StudentAttendanceController::class, 'create'])->name('attendance.student.create');
    Route::post('attendance/student', [StudentAttendanceController::class, 'store'])->name('attendance.student.store');
    Route::get('attendance/student/bulk/create', [StudentAttendanceController::class, 'bulkCreate'])->name('attendance.student.bulk.create');
    Route::post('attendance/student/bulk/store', [StudentAttendanceController::class, 'bulkStore'])->name('attendance.student.bulk.store');

    // Schedules (hanya lihat jadwal mengajar)
    Route::get('schedules', [ScheduleController::class, 'index'])->name('schedules.index');
    Route::get('schedules/{schedule}', [ScheduleController::class, 'show'])->name('schedules.show');
});

// ============================================
// STUDENT
// ============================================
Route::middleware(['auth', 'role:student'])->group(function () {
    Route::view('/student/dashboard', 'student.dashboard')->name('student.dashboard');

    // Lihat jadwal
    Route::get('schedules', [ScheduleController::class, 'studentIndex'])->name('student.schedules.index');

    // Lihat absensi sendiri
    Route::get('attendance/student', [StudentAttendanceController::class, 'myAttendance'])->name('student.attendance.index');

    // Lihat invoice sendiri
    Route::get('invoices', [InvoiceController::class, 'studentInvoices'])->name('student.invoices.index');
});

// ============================================
// PARENT
// ============================================
Route::middleware(['auth', 'role:parent'])->group(function () {
    Route::view('/parent/dashboard', 'parent.dashboard')->name('parent.dashboard');

    // Lihat jadwal anak
    Route::get('schedules', [ScheduleController::class, 'parentIndex'])->name('parent.schedules.index');

    // Lihat absensi anak
    Route::get('attendance/student', [StudentAttendanceController::class, 'parentIndex'])->name('parent.attendance.index');

    // Lihat invoice anak
    Route::get('invoices', [InvoiceController::class, 'parentInvoices'])->name('parent.invoices.index');
});

// ============================================
// PROFILE (SEMUA ROLE)
// ============================================
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
