<?php

use App\Events\HelloEvent;
use App\Events\PlaygroundEvent;
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
    return view('homepage');
});

Route::get('/login/page', [AuthController::class, 'loginPage'])->name('login.page');

Route::get('/login/action', [AuthController::class, 'loginAction'])->name('login.action');

Route::get('/register/page', [AuthController::class, 'registerPage'])->name('register.page');

Route::post('/register/action', [AuthController::class, 'registerAction'])->name('register.action');

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
