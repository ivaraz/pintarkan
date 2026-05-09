<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])
        ->name('admin.dashboard');
    Route::get('/admin/users/create', [UserController::class, 'create'])
        ->name('admin.users.create');
    Route::post('/admin/users', [UserController::class, 'store'])
        ->name('admin.users.store');
});
Route::middleware(['auth', 'role:lecturer'])->group(function () {
    Route::get('/dosen/dashboard', [DashboardController::class, 'index'])
        ->name('dosen.dashboard');
});
Route::middleware(['auth', 'role:student'])->group(function () {
    Route::get('/mahasiswa/dashboard', [DashboardController::class, 'index'])
        ->name('mahasiswa.dashboard');
});


require __DIR__.'/auth.php';
