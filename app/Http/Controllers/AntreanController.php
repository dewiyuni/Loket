<?php

namespace App\Http\Controllers;

use App\Models\Antrean;
use Illuminate\Http\Request;

class AntreanController extends Controller
{
    // 1. Menampilkan Halaman Dashboard Utama Petugas
    public function index()
    {
        // Ambil data statistik hari ini
        $totalHariIni = Antrean::whereDate('created_at', today())->count();
        $sisaMenunggu = Antrean::whereDate('created_at', today())->where('status', 'menunggu')->count();
        $totalSelesai = Antrean::whereDate('created_at', today())->where('status', 'selesai')->count();

        // Ambil daftar antrean yang masih mengantre (Waiting List)
        $waitingList = Antrean::with('pasien')
            ->whereDate('created_at', today())
            ->where('status', 'menunggu')
            ->orderBy('id', 'asc')
            ->get();

        // Ambil antrean yang saat ini sedang dipanggil aktif
        $activeCall = Antrean::with('pasien')
            ->whereDate('created_at', today())
            ->where('status', 'dipanggil')
            ->orderBy('updated_at', 'desc')
            ->first();

        // Kirim semua data ke file view dashboard
        return view('petugas.dashboard', compact(
            'totalHariIni',
            'sisaMenunggu',
            'totalSelesai',
            'waitingList',
            'activeCall'
        ));
    }

    // 2. API / Fungsi untuk Mengubah Status Antrean (Panggil, Selesai, Lewati)
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:menunggu,dipanggil,selesai,dilewati'
        ]);

        $antrean = Antrean::findOrFail($id);
        $antrean->status = $request->status;
        $antrean->save();

        // Kembalikan respon JSON agar frontend bisa update tanpa reload halaman
        return response()->json([
            'success' => true,
            'message' => 'Status antrean berhasil diperbarui ke ' . $request->status,
            'data' => $antrean
        ]);
    }
    public function storePendaftaran(\Illuminate\Http\Request $request)
    {
        // 1. Validasi Input Form
        $request->validate([
            'nik' => 'required|digits:16',
            'nama_pasien' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'poli_tujuan' => 'required|string',
        ]);

        // 2. Simpan atau Update Data Master Pasien
        $pasien = \App\Models\Pasien::updateOrCreate(
            ['nik' => $request->nik], // Jika NIK sudah ada, update datanya. Jika belum, buat baru.
            [
                'nama_pasien' => $request->nama_pasien,
                'tanggal_lahir' => $request->tanggal_lahir,
                'jenis_kelamin' => $request->jenis_kelamin,
                'alamat' => $request->alamat,
                'no_hp' => $request->no_hp,
            ]
        );

        // 3. Generate Otomatis Nomor Antrean Baru Hari Ini (Contoh: A-001, A-002, dst)
        $totalAntreanHariIni = \App\Models\Antrean::whereDate('created_at', today())->count();
        $nextNumber = str_pad($totalAntreanHariIni + 1, 3, '0', STR_PAD_LEFT);
        $nomorAntrean = 'A-' . $nextNumber;

        // 4. Masukkan ke Tabel Antrean
        \App\Models\Antrean::create([
            'pasien_id' => $pasien->id,
            'nomor_antrean' => $nomorAntrean,
            'poli_tujuan' => $request->poli_tujuan,
            'status' => 'menunggu'
        ]);

        // 5. Kembalikan ke halaman dashboard dengan pesan sukses
        return redirect()->route('petugas.dashboard')->with('success', 'Pasien berhasil didaftarkan dengan nomor ' . $nomorAntrean);
    }

}
