<?php

use App\Events\HelloEvent;
use App\Events\PlaygroundEvent;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CenterController;
use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\FeeController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ManageClassroomController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PresenceController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TeacherController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| WEB ROUTES
|--------------------------------------------------------------------------
*/

Route::get('/', fn() => redirect()->route('login.page'));

Route::get('/homepage', [AdminController::class, 'indexHome'])->name('homepage');

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/
Route::get('/loginpage', [AuthController::class, 'loginPage'])->name('login.page');
Route::post('/login/action', [AuthController::class, 'loginAction'])->name('login.action');

Route::get('/register', [AuthController::class, 'registerPage'])->name('register.page');
Route::post('/register/action', [AuthController::class, 'registerAction'])->name('register.action');

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| PROTECTED ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    /*
    |--------------------------------------------------------------------------
    | DASHBOARD
    |--------------------------------------------------------------------------
    */
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/dashboard/admin', [AdminController::class, 'adminDashboard'])->name('dashboard.admin');
    Route::get('/dashboard/teacher', [TeacherController::class, 'dashboard'])->name('dashboard.teacher');
    Route::get('/dashboard/director', [AdminController::class, 'directorDashboard'])->name('dashboard.director');

    /*
    |--------------------------------------------------------------------------
    | USER
    |--------------------------------------------------------------------------
    */
    Route::prefix('user')
        ->name('user.')
        ->group(function () {
            Route::get('/', [UserController::class, 'index'])->name('index');
            Route::get('/create', [UserController::class, 'create'])->name('create');
            Route::post('/store', [UserController::class, 'store'])->name('store');
            Route::get('/{id}', [UserController::class, 'show'])->name('show');
            Route::get('/edit/{id}', [UserController::class, 'edit'])->name('edit');
            Route::put('/update/{id}', [UserController::class, 'update'])->name('update');
            Route::delete('/delete/{id}', [UserController::class, 'destroy'])->name('delete');
            Route::post('/toggle-status/{id}', [UserController::class, 'toggleStatus'])->name('toggle-status');
        });

    /*
    |--------------------------------------------------------------------------
    | ROLE
    |--------------------------------------------------------------------------
    */
    Route::prefix('role')
        ->name('role.')
        ->group(function () {
            Route::get('/', [RoleController::class, 'index'])->name('index');
            Route::get('/create', [RoleController::class, 'create'])->name('create');
            Route::post('/store', [RoleController::class, 'store'])->name('store');
            Route::put('/update/{role_id}', [RoleController::class, 'update'])->name('update');
            Route::delete('/delete/{role_id}', [RoleController::class, 'destroy'])->name('delete');
            Route::post('/add-module/{role_id}', [RoleController::class, 'addModule'])->name('add-module');
            Route::delete('/remove-module/{role_id}', [RoleController::class, 'removeModule'])->name('remove-module');
        });

    /*
    |--------------------------------------------------------------------------
    | MODULE
    |--------------------------------------------------------------------------
    */
    Route::prefix('module')
        ->name('module.')
        ->group(function () {
            Route::get('/', [ModuleController::class, 'index'])->name('index');
            Route::get('/create', [ModuleController::class, 'create'])->name('create');
            Route::post('/store', [ModuleController::class, 'store'])->name('store');
            Route::delete('/delete/{id}', [ModuleController::class, 'destroy'])->name('delete');

            // Role module assignment
            Route::get('/role-module/{role_id}', [ModuleController::class, 'roleModule'])->name('role-module');
            Route::post('/sync-role-module/{role_id}', [ModuleController::class, 'syncRoleModule'])->name('sync-role-module');
        });
    /*
    |--------------------------------------------------------------------------
    | MASTER DATA
    |--------------------------------------------------------------------------
    */
    Route::resource('center', CenterController::class);
    Route::resource('fee', FeeController::class);
    Route::resource('student', StudentController::class);
    Route::resource('teacher', TeacherController::class);
    Route::resource('classroom', ClassroomController::class);
    Route::resource('payment', PaymentController::class);
    Route::resource('presence', PresenceController::class);

    /*
    |--------------------------------------------------------------------------
    | EXTRA STUDENT
    |--------------------------------------------------------------------------
    */
    Route::get('/student/export', [StudentController::class, 'export'])->name('student.export');
    Route::post('/student/import', [StudentController::class, 'import'])->name('student.import');

    /*
    |--------------------------------------------------------------------------
    | EXTRA TEACHER
    |--------------------------------------------------------------------------
    */
    Route::get('/teacher/schedule/{teacher_id}', [TeacherController::class, 'schedule'])->name('teacher.schedule');

    /*
    |--------------------------------------------------------------------------
    | EXTRA CLASSROOM
    |--------------------------------------------------------------------------
    */
    Route::get('/classroom/schedule/{classroom_id}', [ClassroomController::class, 'schedule'])->name('classroom.schedule');

    /*
    |--------------------------------------------------------------------------
    | MANAGE CLASSROOM
    |--------------------------------------------------------------------------
    */
    Route::prefix('classroom/manage')
        ->name('classroom.')
        ->group(function () {
            Route::get('/', [ManageClassroomController::class, 'index'])->name('manage');
            Route::get('/teaching', [ManageClassroomController::class, 'teaching'])->name('teaching');
            Route::get('/students/{classroom_id}', [ManageClassroomController::class, 'getStudents'])->name('getStudents');
            Route::post('/addMurid', [ManageClassroomController::class, 'addMurid'])->name('addMurid');
            Route::post('/assignTeacher', [ManageClassroomController::class, 'assignTeacher'])->name('assignTeacher');
            Route::delete('/removeMurid/{manageClassroom_id}', [ManageClassroomController::class, 'removeMurid'])->name('removeMurid');
        });

    /*
    |--------------------------------------------------------------------------
    | PAYMENT EXTRA
    |--------------------------------------------------------------------------
    */
    Route::get('/payment/invoice/{payment_id}', [PaymentController::class, 'invoice'])->name('payment.invoice');
    Route::post('/payment/verify/{payment_id}', [PaymentController::class, 'verify'])->name('payment.verify');

    /*
    |--------------------------------------------------------------------------
    | PRESENCE EXTRA
    |--------------------------------------------------------------------------
    */
    Route::get('/presence/report', [PresenceController::class, 'report'])->name('presence.report');
    Route::post('/presence/loadTable', [PresenceController::class, 'loadPresenceTable'])->name('presence.loadTable');
    Route::get('/presence/export/{date}', [PresenceController::class, 'export'])->name('presence.export');
    Route::get('/presence/report/pdf', [PresenceController::class, 'exportPdf'])->name('presence.exportPdf');

    /*
    |--------------------------------------------------------------------------
    | REPORT
    |--------------------------------------------------------------------------
    */
    Route::prefix('report')
        ->name('report.')
        ->group(function () {
            Route::get('/financial', [PaymentController::class, 'financialReport'])->name('financial');
            Route::get('/student', [StudentController::class, 'studentReport'])->name('student');
            Route::get('/attendance', [PresenceController::class, 'attendanceReport'])->name('attendance');
            Route::get('/export/excel', [AdminController::class, 'exportExcel'])->name('export');
        });

    /*
    |--------------------------------------------------------------------------
    | PROFILE
    |--------------------------------------------------------------------------
    */
    Route::prefix('profile')
        ->name('profile.')
        ->group(function () {
            Route::get('/', [AuthController::class, 'profile'])->name('index');
            Route::put('/update', [AuthController::class, 'updateProfile'])->name('update');
            Route::get('/settings', [AuthController::class, 'settings'])->name('settings');
            Route::put('/change-password', [AuthController::class, 'changePassword'])->name('changePassword');
            Route::get('/activity', [AuthController::class, 'activityLog'])->name('activity');
        });

    /*
    |--------------------------------------------------------------------------
    | SETTINGS
    |--------------------------------------------------------------------------
    */
    Route::prefix('settings')
        ->name('settings.')
        ->group(function () {
            Route::get('/', [AdminController::class, 'settings'])->name('index');
            Route::put('/update', [AdminController::class, 'updateSettings'])->name('update');
            Route::get('/backup', [AdminController::class, 'backup'])->name('backup');
            Route::get('/logs', [AdminController::class, 'logs'])->name('logs');
        });
});

/*
|--------------------------------------------------------------------------
| EVENTS
|--------------------------------------------------------------------------
*/
Route::get('/event', function () {
    event(new HelloEvent('Hello World'));
    return 'Event sent';
});

Route::get('/playground', function () {
    event(new PlaygroundEvent('Playground Event'));
    return 'Playground event sent';
});
