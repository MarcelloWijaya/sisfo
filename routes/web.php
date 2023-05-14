<?php

use App\Events\HelloEvent;
use App\Events\PlaygroundEvent;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;

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
