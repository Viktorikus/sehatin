<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\DiseaseReportController;
use App\Http\Controllers\EnvironmentalHealthReportController;
use App\Http\Controllers\HealthCenterController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

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

// Home routes
Route::get('/', [HomeController::class, 'index'])->name('home');

// Auth routes (scaffolding by Breeze or Jetstream should be here)
require __DIR__ . '/auth.php';

// Authenticated user routes
Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');

    // Booking routes
    Route::prefix('bookings')->name('bookings.')->group(function () {
        Route::get('/', [BookingController::class, 'index'])->name('index');
        Route::get('create/{service}', [BookingController::class, 'create'])->name('create');
        Route::post('/', [BookingController::class, 'store'])->name('store');
        Route::get('{booking}', [BookingController::class, 'show'])->name('show');
        Route::get('my/list', [BookingController::class, 'myBookings'])->name('my-bookings');
        Route::post('{booking}/cancel', [BookingController::class, 'cancel'])->name('cancel');
    });

    // Disease report routes
    Route::prefix('disease-monitoring')->name('disease.')->group(function () {
        Route::get('/', [DiseaseReportController::class, 'index'])->name('index');
        Route::get('create', [DiseaseReportController::class, 'create'])->name('create');
        Route::post('/', [DiseaseReportController::class, 'store'])->name('store');
        Route::get('{diseaseReport}', [DiseaseReportController::class, 'show'])->name('show');
        Route::get('my/reports', [DiseaseReportController::class, 'myReports'])->name('my-reports');
        Route::get('statistics', [DiseaseReportController::class, 'statistics'])->name('statistics');
    });

    // Environmental health report routes
    Route::prefix('environmental-reports')->name('environmental.')->group(function () {
        Route::get('/', [EnvironmentalHealthReportController::class, 'index'])->name('index');
        Route::get('create', [EnvironmentalHealthReportController::class, 'create'])->name('create');
        Route::post('/', [EnvironmentalHealthReportController::class, 'store'])->name('store');
        Route::get('{environmentalReport}', [EnvironmentalHealthReportController::class, 'show'])->name('show');
        Route::get('my/reports', [EnvironmentalHealthReportController::class, 'myReports'])->name('my-reports');
        Route::get('{environmentalReport}/edit', [EnvironmentalHealthReportController::class, 'edit'])->name('edit');
        Route::put('{environmentalReport}', [EnvironmentalHealthReportController::class, 'update'])->name('update');
        Route::get('dashboard', [EnvironmentalHealthReportController::class, 'dashboard'])->name('dashboard');
    });
});

// Health center routes (public)
Route::prefix('health-centers')->name('health-centers.')->group(function () {
    Route::get('/', [HealthCenterController::class, 'index'])->name('index');
    Route::get('{healthCenter}', [HealthCenterController::class, 'show'])->name('show');
    Route::get('search', [HealthCenterController::class, 'search'])->name('search');
    Route::get('map', [HealthCenterController::class, 'map'])->name('map');
});
