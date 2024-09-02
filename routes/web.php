<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaktaIntegritasController;
use App\Http\Controllers\AdminAuthController;

Route::get('/', function () {
    return view('index');
});

Route::get('/lapor', function () {
    return view('lapor');
});
Route::get('/web', function () {
    return view('web');
});

Route::get('/admin', function () {
    return view('admin.admin_login');
})->name('admin.login');

Route::get('/down_surat', function () {
    return view('down_surat');
});
Route::get('/edit_surat', function () {
    return view('edit_surat');
});

route::get('/user/edit-surat/{id}', [PaktaIntegritasController::class, 'editUserSurat'])->name('user.edit-surat');
Route::put('/user/update-surat/{id}', [PaktaIntegritasController::class, 'updateUserSurat'])->name('user.update-surat');

// Rute untuk menyimpan data dari pengguna (dari halaman index)
Route::post('/integritas/store', [PaktaIntegritasController::class, 'store'])->name('integritas.store');

// Rute untuk menampilkan halaman down_surat setelah pengguna menyimpan data
Route::get('/user/down-surat', [PaktaIntegritasController::class, 'userSurat'])->name('user.down-surat');

// Rute untuk admin
Route::get('/admin/{role}', [PaktaIntegritasController::class, 'index'])->name('admin.role');
Route::post('/admin/add/{role}', [PaktaIntegritasController::class, 'store'])->name('integritas.store.admin');
Route::get('/admin/add/{role}', [PaktaIntegritasController::class, 'showForm'])->name('admin.add');
Route::delete('/admin/{role}/{id}', [PaktaIntegritasController::class, 'destroy'])->name('integritas.destroy');
Route::get('/admin/{role}/edit/{id}', [PaktaIntegritasController::class, 'edit'])->name('integritas.edit');
Route::put('/admin/{role}/{id}', [PaktaIntegritasController::class, 'update'])->name('integritas.update');


Route::get('/admin/{role}/export', [PaktaIntegritasController::class, 'export'])->name('integritas.export');
Route::get('/admin/{role}/download-pdf/{id}', [PaktaIntegritasController::class, 'downloadPdf'])->name('integritas.download-pdf');
Route::get('/admin/{role}/view-surat/{id}', [PaktaIntegritasController::class, 'viewSurat'])->name('integritas.view-surat');
Route::post('/admin/logout', function () {
    Auth::logout();
    return redirect('/admin');
})->name('admin.logout');
