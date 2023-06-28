<?php

use App\Events\HelloEvent;
use App\Events\PlaygroundEvent;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CenterController;
use App\Http\Controllers\CenterPaymentController;
use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\ManageClassroomController;
use App\Http\Controllers\PaymentController;
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

Route::get('/loginpage', [AuthController::class, 'loginPage'])->name('login.page');

Route::get('/login/action', [AuthController::class, 'loginAction'])->name('login.action');

Route::get('/register/page', [AuthController::class, 'registerPage'])->name('register.page');

Route::post('/register/action', [AuthController::class, 'registerAction'])->name('register.action');

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');


Route::get('/admin/role', [AdminController::class, 'indexRole'])->name('admin.role');

Route::post('/admin/createRole', [AdminController::class, 'createRole'])->name('admin.createrole');

Route::put('/admin/updateUser/{user_id}', [AdminController::class, 'updateUser'])->name('admin.updateuser');

Route::delete('/admin/deleteUser/{user_id}', [AdminController::class, 'deleteUser'])->name('admin.deleteuser');

Route::get('/admin/giveAccess/{user_id}', [AdminController::class, 'giveAccess'])->name('admin.giveaccess');

Route::get('/admin/removeccess/{user_id}', [AdminController::class, 'removeAccess'])->name('admin.removeaccess');


Route::get('/center', [CenterController::class, 'indexCenter'])->name('center.index');

Route::get('/center/detail', [CenterController::class, 'detailCenter'])->name('center.detail');

Route::get('/center/create', [CenterController::class, 'createCenter'])->name('center.create');

Route::post('/center/store', [CenterController::class, 'storeCenter'])->name('center.store');

Route::get('/center/edit/{center_id}', [CenterController::class, 'editCenter'])->name('center.edit');

Route::put('/center/update/{center_id}', [CenterController::class, 'updateCenter'])->name('center.update');

Route::delete('/center/delete/{center_id}', [CenterController::class, 'destroy'])->name('center.delete');


Route::get('/centerPayment', [CenterPaymentController::class, 'index'])->name('centerPayment.index');

Route::get('/centerPayment/detail', [CenterPaymentController::class, 'detail'])->name('centerPayment.detail');

Route::get('/centerPayment/create', [CenterPaymentController::class, 'create'])->name('centerPayment.create');

Route::post('/centerPayment/store', [CenterPaymentController::class, 'store'])->name('centerPayment.store');

Route::get('/centerPayment/edit/{payment_id}', [CenterPaymentController::class, 'edit'])->name('centerPayment.edit');

Route::put('/centerPayment/update/{payment_id}', [CenterPaymentController::class, 'update'])->name('centerPayment.update');

Route::delete('/centerPayment/delete/{payment_id}', [CenterPaymentController::class, 'destroy'])->name('centerPayment.delete');



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

Route::get('/teacher/detail', [TeacherController::class, 'detail'])->name('teacher.detail');

Route::get('/teacher/edit/{teacher_id}', [TeacherController::class, 'edit'])->name('teacher.edit');

Route::put('/teacher/update/{teacher_id}', [TeacherController::class, 'update'])->name('teacher.update');

Route::delete('/teacher/delete/{teacher_id}', [TeacherController::class, 'destroy'])->name('teacher.delete');


Route::get('/classroom', [ClassroomController::class, 'index'])->name('classroom.index');

Route::get('/classroom/manage', [ManageClassroomController::class, 'index'])->name('classroom.manage');

Route::get('/classroom/detail', [ClassroomController::class, 'detail'])->name('classroom.detail');

Route::get('/classroom/create', [ClassroomController::class, 'create'])->name('classroom.create');

Route::post('/classroom/store', [ClassroomController::class, 'store'])->name('classroom.store');

Route::get('/classroom/edit/{classroom_id}', [ClassroomController::class, 'edit'])->name('classroom.edit');

Route::put('/classroom/update/{classroom_id}', [ClassroomController::class, 'update'])->name('classroom.update');

Route::delete('/classroom/delete/{classroom_id}', [ClassroomController::class, 'destroy'])->name('classroom.delete');


Route::get('/payment', [PaymentController::class, 'index'])->name('payment.index');

Route::get('/payment/create', [PaymentController::class, 'create'])->name('payment.create');

Route::post('/payment/store', [PaymentController::class, 'store'])->name('payment.store');

Route::get('/payment/detail/{payment_id}', [PaymentController::class, 'detail'])->name('payment.detail');

Route::get('/payment/edit/{payment_id}', [PaymentController::class, 'edit'])->name('payment.edit');

Route::put('/payment/update/{payment_id}', [PaymentController::class, 'update'])->name('payment.update');

Route::delete('/payment/delete/{payment_id}', [PaymentController::class, 'destroy'])->name('payment.delete');
