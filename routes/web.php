<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\BookingController;

// --- ฝั่งลูกค้า (Frontend) ---
Route::get('/', [BookingController::class, 'home'])->name('home');
Route::get('/booking', [BookingController::class, 'index'])->name('booking.page');
Route::post('/booking/store', [BookingController::class, 'store'])->name('book.store');

// ย้ายออกมาไว้ตรงนี้! (อยู่นอกกลุ่ม Admin)
Route::get('/booking/success', [BookingController::class, 'success'])->name('booking.success');


// --- ฝั่งจัดการ (Admin) ---
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::get('/services', [AdminController::class, 'manageServices'])->name('services');
    Route::post('/services/store', [AdminController::class, 'storeService'])->name('services.store');
    Route::delete('/services/{id}', [AdminController::class, 'deleteService'])->name('services.delete');
    Route::post('/booking/{id}/status', [AdminController::class, 'updateBookingStatus'])->name('bookings.update');
});