<?php

use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Admin\CarController;
use App\Http\Controllers\Admin\CarImageController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {

    Route::get(
        '/dashboard',
        [DashboardController::class, 'index']
    )->name('dashboard');

    Route::prefix('cars')->name('cars.')->group(function () {
        Route::get('/', [CarController::class, 'index'])->name('index');
        Route::post('/', [CarController::class, 'store'])->name('store');
        Route::get('/{car}', [CarController::class, 'show'])->name('show');
        Route::put('/{car}', [CarController::class, 'update'])->name('update');
        Route::delete('/{car}', [CarController::class, 'destroy'])->name('delete');
    });

    Route::prefix('car-images')->name('car-images.')->group(function () {
        Route::post('/', [CarImageController::class, 'store'])->name('store');
        Route::delete('/{carImage}', [CarImageController::class, 'destroy'])->name('delete');
    });

    Route::prefix('bookings')->name('bookings.')->group(function () {

        Route::get('/', [BookingController::class, 'index'])
            ->name('index');

        Route::post('/', [BookingController::class, 'store'])
            ->name('store');

        Route::put('/{booking}', [BookingController::class, 'update'])
            ->name('update');

        Route::delete('/{booking}', [BookingController::class, 'destroy'])
            ->name('destroy');
    });

    Route::prefix('payments')->name('payments.')->group(function () {

        Route::get('/', [PaymentController::class, 'index'])
            ->name('index');

        Route::post('/', [PaymentController::class, 'store'])
            ->name('store');

        Route::put('/{payment}', [PaymentController::class, 'update'])
            ->name('update');

        Route::delete('/{payment}', [PaymentController::class, 'destroy'])
            ->name('destroy');
    });
});

require __DIR__ . '/auth.php';
