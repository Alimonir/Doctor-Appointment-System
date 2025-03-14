<?php
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\SlotController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['permission:create_appointment|view_appointment|edit_appointment|delete_appointment|delete_user|settings'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::get('/appointments', [AppointmentController::class, 'index'])->name('appointments.index');
    
});

Route::middleware(['auth','role:patient'])->group(function () {
    Route::get('/appointments/create', [AppointmentController::class, 'create'])->name('appointments.create');
    Route::post('/appointments', [AppointmentController::class, 'store'])->name('appointments.store');
    Route::delete('/appointments/{appointment}', [AppointmentController::class, 'destroy'])->name('appointments.destroy');
});
Route::middleware(['auth','role:doctor'])->group(function () {
    Route::post('/appointments/{appointment}/status', [AppointmentController::class, 'status'])->name('appointments.status');
    Route::post('/appointments/{appointment}/approve', [AppointmentController::class, 'updateStatus'])
     ->name('appointments.approve');
    Route::post('/appointments/{appointment}/rejected', [AppointmentController::class, 'updateStatus'])
     ->name('appointments.rejected');
});

//slots
Route::middleware(['auth','role:doctor'])->group(function () {
    Route::get('/slots', [SlotController::class, 'index'])->name('slots.index');
    Route::get('/slots/create', [SlotController::class, 'create'])->name('slots.create');
    Route::post('/slots', [SlotController::class, 'store'])->name('slots.store');
    Route::get('/slots/{slot}/edit', [SlotController::class, 'edit'])->name('slots.edit');
    Route::put('/slots/{slot}', [SlotController::class, 'update'])->name('slots.update');
    Route::delete('/slots/{slot}', [SlotController::class, 'destroy'])->name('slots.destroy');
});

Route::get('/doctor/{doctor}/slots', [AppointmentController::class, 'getDoctorSlots']);


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::post('/notifications/read', function (\Illuminate\Http\Request $request) {
    $notification = Auth::user()->unreadNotifications->find($request->id);
    if ($notification) {
        $notification->markAsRead();
    }
    return response()->json(['success' => true]);
})->name('notifications.read');

Route::get('/lang/{locale}', function (string $locale) {
    if (! in_array($locale, ['en', 'ar'])) {
        abort(400);
    }
    Session::put('locale', $locale);
    App::setLocale($locale);
    return response()->json([
        'session_locale' => Session::get('locale'),
        'app_locale' => App::getLocale()
    ]);})->name('locale.switch');


require __DIR__.'/auth.php';




