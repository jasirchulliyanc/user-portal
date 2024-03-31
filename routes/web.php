<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HrController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\Frontend;
use Illuminate\Support\Facades\Route;

Route::get('/', [Frontend\HomeController::class, 'index']);

Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('user', UserController::class);
    Route::resource('hr', HrController::class);
    Route::resource('employee', EmployeeController::class);
});

require __DIR__ . '/auth.php';
