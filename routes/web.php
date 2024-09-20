<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaktaIntegritasController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Middleware\AdminMiddleware;

// Public Routes
Route::get('/', function () {
    return view('index');
});

Route::get('/lapor', function () {
    return view('lapor');
});

Route::get('/web', function () {
    return view('web');
});

Route::get('/faq', function () {
    return view('faq');
});

route::get('/preview-email', [PaktaIntegritasController::class, 'previewEmail']);

// User Routes
Route::prefix('user')->group(function () {
    // Rute untuk menyimpan data dari pengguna (dari halaman index)
    Route::post('/integritas/store', [PaktaIntegritasController::class, 'store'])->name('integritas.store');
});

// Admin Authentication Routes
Route::get('/admin', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin', [AdminAuthController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

// Prefix untuk Admin Routes
Route::middleware(\App\Http\Middleware\AdminMiddleware::class)->prefix('admin')->group(function () {
    Route::get('/api/getDataSurat', [PaktaIntegritasController::class, 'getDataSurat']);

    // Rute yang benar untuk menambah admin baru
    Route::post('/store', [AdminAuthController::class, 'storeAdmin'])->name('admin.store');
    Route::get('/account', [AdminAuthController::class, 'showAdminAccount'])->name('admin.account');
    Route::put('/update/{id}', [AdminAuthController::class, 'updateAdmin'])->name('admin.update');
    Route::delete('/{id}', [AdminAuthController::class, 'destroy'])->name('admin.destroy');

    Route::get('/home', [PaktaIntegritasController::class, 'index'])->name('admin.home');

    Route::get('/{role?}', [PaktaIntegritasController::class, 'index'])->name('admin.role');
    Route::post('/add/{role}', [PaktaIntegritasController::class, 'store'])->name('integritas.store.admin');
    Route::get('/add/{role}', [PaktaIntegritasController::class, 'showForm'])->name('admin.add');
    Route::delete('/{role}/{id}', [PaktaIntegritasController::class, 'destroy'])->name('integritas.destroy');
    Route::get('/{role}/edit/{id}', [PaktaIntegritasController::class, 'edit'])->name('integritas.edit');
    Route::put('/{role}/{id}', [PaktaIntegritasController::class, 'update'])->name('integritas.update');
    Route::get('/{role}/export', [PaktaIntegritasController::class, 'export'])->name('integritas.export');
    Route::get('/{role}/download-pdf/{id}', [PaktaIntegritasController::class, 'downloadPdf'])->name('integritas.download-pdf');
    Route::get('/{role}/view-surat/{id}', [PaktaIntegritasController::class, 'viewSurat'])->name('integritas.view-surat');
});

