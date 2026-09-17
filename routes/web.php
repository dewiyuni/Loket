<?php

use App\Http\Controllers\AntreanController;
use Illuminate\Support\Facades\Route;

// =========================
// HALAMAN PASIEN
// =========================

Route::get('/', function () {
    return view('loket');
});

Route::get('/beranda', [AntreanController::class, 'ambilAntrianIndex'])->name('pasien.beranda');

Route::post('/pasien/pendaftaran/simpan', [AntreanController::class, 'storePendaftaranPasien'])->name('pasien.pendaftaran.simpan');
Route::get('/nomor-antrian', function () {
    return view('pasien.nomor-antrian');
});

Route::get('/cek-antrian', [AntreanController::class, 'cekAntrian'])->name('pasien.cekAntrian');


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
