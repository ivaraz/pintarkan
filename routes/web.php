<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CourseController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:admin'])
->prefix('admin')
->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('admin.dashboard');
    Route::get('/users/create', [UserController::class, 'create'])
        ->name('admin.users.create');
    Route::post('/users', [UserController::class, 'store'])
        ->name('admin.users.store');

    // Course Management Routes
    Route::get('/courses', [CourseController::class, 'index'])
        ->name('admin.courses.index');
    Route::get('/courses/create', [CourseController::class, 'create'])
        ->name('admin.courses.create');
    Route::post('/courses', [CourseController::class, 'store'])
        ->name('admin.courses.store');
    Route::get('/courses/{course}', [CourseController::class, 'show'])
        ->name('admin.courses.show');
    Route::get('/courses/{course}/edit', [CourseController::class, 'edit'])
        ->name('admin.courses.edit');
    Route::put('/courses/{course}', [CourseController::class, 'update'])
        ->name('admin.courses.update');
    Route::delete('/courses/{course}', [CourseController::class, 'destroy'])
        ->name('admin.courses.destroy');
    Route::get('/courses/{course}/add-students', [CourseController::class, 'addStudents'])
        ->name('admin.courses.add-students');
    Route::post('/courses/{course}/enrollment', [CourseController::class, 'storeEnrollment'])
        ->name('admin.courses.store-enrollment');
    Route::delete('/courses/{course}/enrollment/{enrollment}', [CourseController::class, 'removeStudent'])
        ->name('admin.courses.remove-student');
});


Route::middleware(['auth', 'role:lecturer'])->group(function () {
    Route::get('/dosen/dashboard', [DashboardController::class, 'index'])
        ->name('dosen.dashboard');
    Route::get('/dosen/courses', [CourseController::class, 'index'])
        ->name('dosen.courses.index');
    Route::get('/dosen/courses/{course}', [CourseController::class, 'show'])
        ->name('dosen.courses.show');
    Route::get('/dosen/courses/{course}/edit', [CourseController::class, 'edit'])
        ->name('dosen.courses.edit');
});
Route::middleware(['auth', 'role:student'])->group(function () {
    Route::get('/mahasiswa/dashboard', [DashboardController::class, 'index'])
        ->name('mahasiswa.dashboard');
});


require __DIR__.'/auth.php';
