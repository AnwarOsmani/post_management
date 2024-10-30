<?php
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BarcodeScanController;
use App\Http\Controllers\DeliveryRequestController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\PostalCodeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WorkerController;
use Illuminate\Support\Facades\Route;

// Public Routes
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Public route for tracking package status by tracking number
Route::get('/track-package', [PackageController::class, 'track'])->name('package.track');

// Postal Code Search Route
Route::get('/postal-codes/search', [PostalCodeController::class, 'search'])->name('postal.codes.search');

// map

Route::get('/map', function () {
    return view('layouts.map');
})->name('map');

//public user dashboard
Route::get('/dashboard', function () {
    return view('users.public.dashboard');
})->middleware(['auth', 'verified', 'public_user'])->name('dashboard');


// Authenticated User Routes
Route::middleware('auth')->group(function () {

    // Profile Management Routes
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('destroy');
    });
});

// Delivery Request Routes
Route::middleware(['auth', 'public_user'])->prefix('delivery-requests')->name('delivery.request.')->group(function () {
    Route::get('/', [DeliveryRequestController::class, 'index'])->name('index');
    Route::get('/create', [DeliveryRequestController::class, 'create'])->name('create');
    Route::post('/', [DeliveryRequestController::class, 'store'])->name('store');
    Route::get('/{id}/edit', [DeliveryRequestController::class, 'edit'])->name('edit');
    Route::put('/{id}', [DeliveryRequestController::class, 'update'])->name('update');
    Route::delete('/{id}', [DeliveryRequestController::class, 'destroy'])->name('destroy');
});

Route::middleware(['auth', 'worker'])->prefix('package')->group(function () {
    Route::get('/create/{requestId}', [PackageController::class, 'create'])->name('package.create');
    Route::post('/store/{requestId}', [PackageController::class, 'store'])->name('package.store');
    Route::get('/{package}', [PackageController::class, 'show'])->name('package.show');

});


// Admin Routes (Authenticated Users)
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/requests', [AdminController::class, 'requests'])->name('requests');
});

Route::middleware(['auth', 'admin'])->prefix('admin/worker')->name('admin.worker.')->group(function () {
    Route::get('/show/all', [AdminController::class, 'showWorkers'])->name('all');
    Route::get('/create', [AdminController::class, 'createWorker'])->name('create');
    Route::post('/store', [AdminController::class, 'storeWorker'])->name('store');
    Route::get('/{id}/edit', [AdminController::class, 'editWorker'])->name('edit');
    Route::put('/{id}', [AdminController::class, 'updateWorker'])->name('update');
    Route::delete('/{id}', [AdminController::class, 'destroyWorker'])->name('destroy');
});


// Worker Routes (Authenticated Users)
Route::middleware(['auth', 'worker'])->prefix('worker')->name('worker.')->group(function () {
    Route::get('/dashboard', [WorkerController::class, 'dashboard'])->name('dashboard');
    Route::get('/requests', [WorkerController::class, 'assignedRequests'])->name('requests');
});
// super admin Routes (Authenticated Users)
Route::middleware(['auth', 'super_admin'])->prefix('superadmin')->name('superadmin.')->group(function () {
    Route::get('/dashboard', [WorkerController::class, 'dashboard'])->name('dashboard');
});


// routes/web.php

Route::get('/barcode/scan', [BarcodeScanController::class, 'showScanForm']);
Route::post('/barcode/scan', [BarcodeScanController::class, 'processScan'])->name('barcode.process');


require __DIR__ . '/auth.php';
