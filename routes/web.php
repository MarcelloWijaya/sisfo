<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\BranchController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\TeacherController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/login');
});

$locale = Session::get('locale', 'en');
if (in_array($locale, ['en', 'id'])) {
    App::setLocale($locale);
}

// Route untuk switch language
Route::get('lang/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'id'])) {
        Session::put('locale', $locale);
        App::setLocale($locale);

        // Flash ke session untuk memastikan tersimpan
        session()->save();
    }
    return redirect()->back();
})->name('lang.switch');

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::view('/admin/dashboard', 'admin.dashboard')->name('admin.dashboard');
    Route::view('/director/dashboard', 'director.dashboard')->name('director.dashboard');
    Route::view('/branch/dashboard', 'branch.dashboard')->name('branch.dashboard');
    Route::view('/teacher/dashboard', 'teacher.dashboard')->name('teacher.dashboard');
    Route::view('/student/dashboard', 'student.dashboard')->name('student.dashboard');
    Route::view('/parent/dashboard', 'parent.dashboard')->name('parent.dashboard');

    Route::resource('branches', BranchController::class);
    Route::resource('students', StudentController::class);
    Route::resource('teachers', TeacherController::class);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
