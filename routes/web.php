<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\DoctorController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['permission:create_appointment|view_appointment|edit_appointment|delete_appointment|delete_user|settings'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::get('/appointments', [AppointmentController::class, 'index'])->name('appointments.index');
    
});

Route::middleware(['auth','role:patient'])->group(function () {
    Route::get('/appointments/create', [AppointmentController::class, 'create'])->name('appointments.create');
    Route::post('/appointments', [AppointmentController::class, 'store'])->name('appointments.store');
});
Route::middleware(['auth','role:doctor'])->group(function () {
    Route::post('/appointments/{appointment}/status', [AppointmentController::class, 'status'])->name('appointments.status');
    Route::post('/appointments/{appointment}/approve', [AppointmentController::class, 'updateStatus'])
     ->name('appointments.approve');
    Route::post('/appointments/{appointment}/rejected', [AppointmentController::class, 'updateStatus'])
     ->name('appointments.rejected');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/auth.php';




