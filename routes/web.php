<?php

use App\Events\HelloEvent;
use App\Events\PlaygroundEvent;
use App\Http\Controllers\FeeController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CenterController;
use App\Http\Controllers\CenterPaymentController;
use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ManageClassroomController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PresenceController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect(route('login.page'));
});

Route::get('/homepage', [AdminController::class, 'indexHome'])->name('homepage');

Route::get('/register', [AuthController::class, 'registerPage'])->name('register.page');
Route::post('/register/action', [AuthController::class, 'registerAction'])->name('register.action');
Route::get('/loginpage', [AuthController::class, 'loginPage'])->name('login.page');
Route::post('/login/action', [AuthController::class, 'loginAction'])->name('login.action');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/admin/role', [AdminController::class, 'indexRole'])->name('admin.role');
Route::post('/admin/createRole', [AdminController::class, 'createRole'])->name('admin.createrole');
Route::put('/admin/updateUser/{user_id}', [AdminController::class, 'updateUser'])->name('admin.updateuser');
Route::delete('/admin/deleteUser/{user_id}', [AdminController::class, 'deleteUser'])->name('admin.deleteuser');
Route::get('/admin/giveAccess/{user_id}', [AdminController::class, 'giveAccess'])->name('admin.giveaccess');
Route::get('/admin/removeccess/{user_id}', [AdminController::class, 'removeAccess'])->name('admin.removeaccess');

Route::get('/role', [RoleController::class, 'index'])->name('role.index');
Route::get('/role/manage/{role_id}', [RoleController::class, 'manage'])->name('role.manage');

Route::get('/center', [CenterController::class, 'index'])->name('center.index');
Route::get('/center/create', [CenterController::class, 'create'])->name('center.create');
Route::post('/center/store', [CenterController::class, 'store'])->name('center.store');
Route::get('/center/detail/{center_id}', [CenterController::class, 'detail'])->name('center.detail');
Route::get('/center/edit/{center_id}', [CenterController::class, 'edit'])->name('center.edit');
Route::put('/center/update/{center_id}', [CenterController::class, 'update'])->name('center.update');
Route::delete('/center/delete/{center_id}', [CenterController::class, 'destroy'])->name('center.delete');

Route::get('/fee', [FeeController::class, 'index'])->name('fee.index');
Route::get('/fee/create', [FeeController::class, 'create'])->name('fee.create');
Route::post('/fee/store', [FeeController::class, 'store'])->name('fee.store');
Route::get('/fee/edit/{fee_id}', [FeeController::class, 'edit'])->name('fee.edit');
Route::put('/fee/update/{fee_id}', [FeeController::class, 'update'])->name('fee.update');
Route::delete('/fee/delete/{fee_id}', [FeeController::class, 'destroy'])->name('fee.delete');

Route::get('/student', [StudentController::class, 'index'])->name('student.index');
Route::get('/student/create', [StudentController::class, 'create'])->name('student.create');
Route::post('/student/store', [StudentController::class, 'store'])->name('student.store');
Route::get('/student/detail/{student_id}', [StudentController::class, 'detail'])->name('student.detail');
Route::get('/student/edit/{student_id}', [StudentController::class, 'edit'])->name('student.edit');
Route::put('/student/update/{student_id}', [StudentController::class, 'update'])->name('student.update');
Route::delete('/student/delete/{student_id}', [StudentController::class, 'destroy'])->name('student.delete');

Route::get('/teacher', [TeacherController::class, 'index'])->name('teacher.index');
Route::get('/teacher/create', [TeacherController::class, 'create'])->name('teacher.create');
Route::post('/teacher/store', [TeacherController::class, 'store'])->name('teacher.store');
Route::get('/teacher/detail/{student_id}', [TeacherController::class, 'detail'])->name('teacher.detail');
Route::get('/teacher/edit/{teacher_id}', [TeacherController::class, 'edit'])->name('teacher.edit');
Route::put('/teacher/update/{teacher_id}', [TeacherController::class, 'update'])->name('teacher.update');
Route::delete('/teacher/delete/{teacher_id}', [TeacherController::class, 'destroy'])->name('teacher.delete');

Route::get('/payment', [PaymentController::class, 'index'])->name('payment.index');
Route::get('/payment/create', [PaymentController::class, 'create'])->name('payment.create');
Route::post('/payment/store', [PaymentController::class, 'store'])->name('payment.store');
Route::get('/payment/detail/{student_id}', [PaymentController::class, 'detail'])->name('payment.detail');
Route::get('/payment/edit/{teacher_id}', [PaymentController::class, 'edit'])->name('payment.edit');
Route::put('/payment/update/{teacher_id}', [PaymentController::class, 'update'])->name('payment.update');
Route::delete('/payment/delete/{teacher_id}', [PaymentController::class, 'destroy'])->name('payment.delete');

Route::get('/classroom', [ClassroomController::class, 'index'])->name('classroom.index');
Route::get('/classroom/teachingSchedule', [ManageClassroomController::class, 'teaching'])->name('classroom.teaching');
Route::get('/classroom/manage', [ManageClassroomController::class, 'index'])->name('classroom.manage');
Route::delete('/classroom/manage/removeMurid/{manageClassroom_id}', [ManageClassroomController::class, 'removeMurid'])->name('classroom.removeMurid');
Route::post('/classroom/manage/addMurid', [ManageClassroomController::class, 'addMurid'])->name('classroom.addMurid');
Route::get('/classroom/detail', [ClassroomController::class, 'detail'])->name('classroom.detail');
Route::get('/classroom/create', [ClassroomController::class, 'create'])->name('classroom.create');
Route::post('/classroom/store', [ClassroomController::class, 'store'])->name('classroom.store');
Route::get('/classroom/edit/{classroom_id}', [ClassroomController::class, 'edit'])->name('classroom.edit');
Route::put('/classroom/update/{classroom_id}', [ClassroomController::class, 'update'])->name('classroom.update');
Route::delete('/classroom/delete/{classroom_id}', [ClassroomController::class, 'destroy'])->name('classroom.delete');

Route::get('/presence', [PresenceController::class, 'index'])->name('presence.index');
Route::get('/presence/report', [PresenceController::class, 'report'])->name('presence.report');
Route::get('/presence/create', [PresenceController::class, 'create'])->name('presence.create');
Route::post('/presence/store', [PresenceController::class, 'store'])->name('presence.store');
Route::get('/presence/edit', [PresenceController::class, 'edit'])->name('presence.edit');
Route::put('/presence/update', [PresenceController::class, 'update'])->name('presence.update');
Route::delete('/presence/delete', [PresenceController::class, 'destroy'])->name('presence.delete');
Route::post('/presence/loadTable', [PresenceController::class, 'loadPresenceTable'])->name('presence.loadTable');
