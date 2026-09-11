<?php

use App\Http\Controllers\AntreanController;
use Illuminate\Support\Facades\Route;

// =========================
// HALAMAN PASIEN
// =========================

Route::get('/', function () {
    return view('loket');
});

Route::get('/beranda', function () {
    return view('pasien.beranda');
});

Route::get('/ambil-antrian', function () {
    return view('pasien.ambil-antrian');
});

Route::get('/nomor-antrian', function () {
    return view('pasien.nomor-antrian');
});

Route::get('/cek-antrian', function () {
    return view('pasien.cek-antrian');
});


// =========================
// INFORMASI
// =========================

Route::get('/informasi', function () {
    return view('informasi.informasi');
});

Route::get('/tentang-kami', function () {
    return view('informasi.tentang-kami');
});


// =========================
// PETUGAS
// =========================

Route::get('/petugas/login', function () {
    return view('petugas.login');
});

Route::get('/petugas/dashboard', [AntreanController::class, 'index'])->name('petugas.dashboard');
// Route API untuk update status antrean lewat JavaScript Fetch
Route::post('/petugas/antrean/{id}/update-status', [AntreanController::class, 'updateStatus'])->name('antrean.update-status');
Route::get('/petugas/antrian', function () {
    return view('petugas.antrian');
});

Route::get('/petugas/pasien', function () {
    return view('petugas.pasien');
});

// Menampilkan halaman form pendaftaran
Route::get('/petugas/pendaftaran', function () {
    return view('petugas.pendaftaran');
})->name('petugas.pendaftaran');

// Memproses data pendaftaran ke database (kita titipkan ke AntreanController)
Route::post('/petugas/pendaftaran/simpan', [App\Http\Controllers\AntreanController::class, 'storePendaftaran'])->name('pendaftaran.simpan');

Route::get('/petugas/laporan', function () {
    return view('petugas.laporan');
});

Route::get('/petugas/pengaturan', function () {
    return view('petugas.pengaturan');
});


// =========================
// DISPLAY TV
// =========================

Route::get('/display/antrian', function () {
    return view('display.antrian');
});