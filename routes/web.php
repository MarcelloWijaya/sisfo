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
use App\Http\Controllers\Director\DirectorController;
use App\Http\Controllers\Director\BranchController as DirectorBranchController;
use App\Http\Controllers\Director\BranchPricingController as DirectorBranchPricingController;
use App\Http\Controllers\Director\TeacherController as DirectorTeacherController;
use App\Http\Controllers\Director\StudentController as DirectorStudentController;
use App\Http\Controllers\Director\ClassroomController as DirectorClassroomController;
use App\Http\Controllers\Director\PaymentController as DirectorPaymentController;
use App\Http\Controllers\Director\SearchController as DirectorSearchController;
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
// ============================================
// DIRECTOR (HANYA BISA LIHAT - READ ONLY)
// ============================================
Route::middleware(['auth', 'role:director'])
    ->prefix('director')
    ->name('director.')
    ->group(function () {
        // Dashboard
        Route::get('/dashboard', [DirectorController::class, 'dashboard'])->name('dashboard');
        Route::get('/', [DirectorController::class, 'dashboard'])->name('index');

        // Branches
        Route::get('branches', [App\Http\Controllers\Director\BranchController::class, 'index'])->name('branches.index');
        Route::get('branches/{branch}', [App\Http\Controllers\Director\BranchController::class, 'show'])->name('branches.show');

        // BRANCH PRICINGS - PAKAI FULL NAMESPACE
        Route::get('pricing', [App\Http\Controllers\Director\BranchPricingController::class, 'index'])->name('pricing.index');
        Route::get('pricing/{branchPricing}/edit', [App\Http\Controllers\Director\BranchPricingController::class, 'edit'])->name('pricing.edit');
        Route::put('pricing/{branchPricing}', [App\Http\Controllers\Director\BranchPricingController::class, 'update'])->name('pricing.update');
        Route::get('pricing/{branchPricing}', [App\Http\Controllers\Director\BranchPricingController::class, 'show'])->name('pricing.show');
        // Teachers
        Route::get('teachers', [DirectorTeacherController::class, 'index'])->name('teachers.index');
        Route::get('teachers/create', [DirectorTeacherController::class, 'create'])->name('teachers.create');
        Route::post('teachers', [DirectorTeacherController::class, 'store'])->name('teachers.store');
        Route::get('teachers/{teacher}', [DirectorTeacherController::class, 'show'])->name('teachers.show');
        Route::get('teachers/{teacher}/edit', [DirectorTeacherController::class, 'edit'])->name('teachers.edit'); // TAMBAHKAN
        Route::put('teachers/{teacher}', [DirectorTeacherController::class, 'update'])->name('teachers.update'); // TAMBAHKAN
        Route::delete('teachers/{teacher}', [DirectorTeacherController::class, 'destroy'])->name('teachers.destroy'); // TAMBAHKAN (opsional)
        Route::get('teachers/{teacher}/schedule', [DirectorTeacherController::class, 'schedule'])->name('teachers.schedule');
        Route::get('teachers/{teacher}/attendance', [DirectorTeacherController::class, 'attendance'])->name('teachers.attendance');

        // Students
        Route::get('students', [DirectorStudentController::class, 'index'])->name('students.index');
        Route::get('students/create', [DirectorStudentController::class, 'create'])->name('students.create');
        Route::post('students', [DirectorStudentController::class, 'store'])->name('students.store');
        Route::get('students/{student}', [DirectorStudentController::class, 'show'])->name('students.show');
        Route::get('students/{student}/edit', [DirectorStudentController::class, 'edit'])->name('students.edit'); // TAMBAHKAN
        Route::put('students/{student}', [DirectorStudentController::class, 'update'])->name('students.update'); // TAMBAHKAN
        Route::delete('students/{student}', [DirectorStudentController::class, 'destroy'])->name('students.destroy'); // TAMBAHKAN (opsional)
        Route::get('students/{student}/grades', [DirectorStudentController::class, 'grades'])->name('students.grades');
        Route::get('students-attendance', [DirectorStudentController::class, 'attendanceIndex'])->name('students.attendance');
        Route::get('students/{student}/attendance-detail', [DirectorStudentController::class, 'attendanceDetail'])->name('students.attendance-detail');
        // Classes
        Route::get('classes', [DirectorClassroomController::class, 'index'])->name('classes.index');
        Route::get('classes/manage', [DirectorClassroomController::class, 'manage'])->name('classes.manage');
        Route::get('classes/today-attendance', [DirectorClassroomController::class, 'todayAttendance'])->name('classes.today-attendance');
        Route::post('classes/today-attendance', [DirectorClassroomController::class, 'storeTodayAttendance'])->name('classes.today-attendance.store');

        // Payments
        Route::get('payments/monthly', [DirectorPaymentController::class, 'monthly'])->name('payments.monthly');
        Route::get('payments/book', [DirectorPaymentController::class, 'book'])->name('payments.book');

        // Search
        Route::get('search', [DirectorSearchController::class, 'index'])->name('search');
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

    // Invoices
    Route::resource('invoices', InvoiceController::class)->except(['edit', 'update', 'destroy']);
    Route::post('invoices/{invoice}/confirm-payment', [InvoiceController::class, 'confirmPayment'])->name('invoices.confirm-payment');
    Route::post('invoices/generate-for-enrollment', [InvoiceController::class, 'generateEnrollment'])->name('invoices.generate-enrollment');
    Route::get('invoices/enrollments-by-student', [InvoiceController::class, 'getEnrollmentsByStudent'])->name('invoices.enrollments-by-student');

    // Coupons
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
    Route::get('my-attendance', [StudentAttendanceController::class, 'myAttendance'])->name('student.attendance.index');

    // Lihat invoice sendiri
    Route::get('my-invoices', [InvoiceController::class, 'studentInvoices'])->name('student.invoices.index');
});

// ============================================
// PARENT
// ============================================
Route::middleware(['auth', 'role:parent'])->group(function () {
    Route::view('/parent/dashboard', 'parent.dashboard')->name('parent.dashboard');

    // Lihat jadwal anak
    Route::get('child-schedules', [ScheduleController::class, 'parentIndex'])->name('parent.schedules.index');

    // Lihat absensi anak
    Route::get('child-attendance', [StudentAttendanceController::class, 'parentIndex'])->name('parent.attendance.index');

    // Lihat invoice anak
    Route::get('child-invoices', [InvoiceController::class, 'parentInvoices'])->name('parent.invoices.index');
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
