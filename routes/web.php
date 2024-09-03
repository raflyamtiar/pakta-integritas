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

Route::get('/down_surat', function () {
    return view('down_surat');
});

Route::get('/edit_surat', function () {
    return view('edit_surat');
});

// User Routes
Route::get('/user/edit-surat/{id}', [PaktaIntegritasController::class, 'editUserSurat'])->name('user.edit-surat');
Route::put('/user/update-surat/{id}', [PaktaIntegritasController::class, 'updateUserSurat'])->name('user.update-surat');

// Rute untuk menyimpan data dari pengguna (dari halaman index)
Route::post('/integritas/store', [PaktaIntegritasController::class, 'store'])->name('integritas.store');

// Rute untuk menampilkan halaman down_surat setelah pengguna menyimpan data
Route::get('/user/down-surat', [PaktaIntegritasController::class, 'userSurat'])->name('user.down-surat');

// Admin Authentication Routes
Route::get('/admin', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin', [AdminAuthController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

// Admin Protected Routes
Route::middleware(\App\Http\Middleware\AdminMiddleware::class)->group(function () {
    Route::get('/admin/home', function () {
        return view('admin.admin_home');
    })->name('admin.home');

    Route::get('/admin/{role}', [PaktaIntegritasController::class, 'index'])->name('admin.role');
    // Tambahan rute untuk integritas
    Route::post('/admin/add/{role}', [PaktaIntegritasController::class, 'store'])->name('integritas.store.admin');
    Route::get('/admin/add/{role}', [PaktaIntegritasController::class, 'showForm'])->name('admin.add');
    Route::delete('/admin/{role}/{id}', [PaktaIntegritasController::class, 'destroy'])->name('integritas.destroy');
    Route::get('/admin/{role}/edit/{id}', [PaktaIntegritasController::class, 'edit'])->name('integritas.edit');
    Route::put('/admin/{role}/{id}', [PaktaIntegritasController::class, 'update'])->name('integritas.update');
    Route::get('/admin/{role}/export', [PaktaIntegritasController::class, 'export'])->name('integritas.export');
    Route::get('/admin/{role}/download-pdf/{id}', [PaktaIntegritasController::class, 'downloadPdf'])->name('integritas.download-pdf');
    Route::get('/admin/{role}/view-surat/{id}', [PaktaIntegritasController::class, 'viewSurat'])->name('integritas.view-surat');
});
