<?php

use App\Events\HelloEvent;
use App\Events\PlaygroundEvent;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CenterController;
use App\Http\Controllers\CenterPaymentController;

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

Route::get('/centerPayment/edit/{center_id}', [CenterPaymentController::class, 'edit'])->name('centerPayment.edit');

Route::put('/centerPayment/update/{center_id}', [CenterPaymentController::class, 'update'])->name('centerPayment.update');

Route::delete('/centerPayment/delete/{center_id}', [CenterController::class, 'destroy'])->name('centerPayment.delete');
