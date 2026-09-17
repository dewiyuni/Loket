<?php

namespace App\Http\Controllers;

use App\Models\Antrean;
use App\Models\Pasien;
use Illuminate\Http\Request;

class AntreanController extends Controller
{
    // 1. Menampilkan Halaman Dashboard Utama Petugas
    public function index(Request $request)
    {
        // ==============================
        // STATISTIK HARI INI
        // ==============================
        $totalHariIni = Antrean::whereDate('created_at', today())
            ->count();

        $sisaMenunggu = Antrean::whereDate('created_at', today())
            ->where('status', 'menunggu')
            ->count();

        $totalSelesai = Antrean::whereDate('created_at', today())
            ->where('status', 'selesai')
            ->count();


        // ==============================
        // JUMLAH ANTREAN MENUNGGU PER POLI
        // ==============================
        $antreanHariIni = Antrean::whereDate('created_at', today())
            ->where('status', 'menunggu')
            ->get();

        $sisaPoli = [
            'umum' => $antreanHariIni->where('poli_tujuan', 'Poli Umum')->count(),
            'gigi' => $antreanHariIni->where('poli_tujuan', 'Poli Gigi')->count(),
            'kia' => $antreanHariIni->where('poli_tujuan', 'KIA / KB')->count(),
            'imun' => $antreanHariIni->where('poli_tujuan', 'Imunisasi')->count(),
            'lansia' => $antreanHariIni->where('poli_tujuan', 'Lansia')->count(),
        ];


        // ==============================
        // SEMUA ANTREAN YANG MENUNGGU
        // ==============================
        // JANGAN FILTER BERDASARKAN POLI.
        // Supaya semua pasien dari semua poli muncul.
        $waitingList = Antrean::with('pasien')
            ->whereDate('created_at', today())
            ->where('status', 'menunggu')
            ->orderBy('id', 'asc')
            ->get();


        // ==============================
        // SEMUA ANTREAN YANG DILEWATI
        // ==============================
        $skippedList = Antrean::with('pasien')
            ->whereDate('created_at', today())
            ->where('status', 'dilewati')
            ->orderBy('updated_at', 'desc')
            ->get();


        // ==============================
        // SEMUA PANGGILAN AKTIF
        // ==============================
        // Dibutuhkan oleh 5 kartu poli
        $activeCallsList = Antrean::with('pasien')
            ->whereDate('created_at', today())
            ->where('status', 'dipanggil')
            ->orderBy('updated_at', 'desc')
            ->get();


        // ==============================
        // KIRIM KE VIEW
        // ==============================
        return view('petugas.dashboard', compact(
            'totalHariIni',
            'sisaMenunggu',
            'totalSelesai',
            'waitingList',
            'skippedList',
            'activeCallsList',
            'sisaPoli'
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

    // 3. Menyimpan Pendaftaran yang Diinput oleh Petugas di Ruang Pendaftaran
    public function storePendaftaran(Request $request)
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
        $pasien = Pasien::updateOrCreate(
            ['nik' => $request->nik], // Jika NIK sudah ada, update datanya. Jika belum, buat baru.
            [
                'nama_pasien' => $request->nama_pasien,
                'tanggal_lahir' => $request->tanggal_lahir,
                'jenis_kelamin' => $request->jenis_kelamin,
                'alamat' => $request->alamat ?? '-',
                'no_hp' => $request->no_hp ?? '-',
            ]
        );

        // 3. Tentukan Kode Huruf berdasarkan Poli yang dipilih
        $poli = $request->poli_tujuan;
        $kodePoli = 'U';
        if ($poli === 'Poli Gigi')
            $kodePoli = 'G';
        if ($poli === 'KIA / KB')
            $kodePoli = 'K';
        if ($poli === 'Imunisasi')
            $kodePoli = 'I';
        if ($poli === 'Lansia')
            $kodePoli = 'L';

        // 4. Generate Otomatis Nomor Antrean Baru Hari Ini
        $totalPoliHariIni = Antrean::whereDate('created_at', today())->where('poli_tujuan', $poli)->count();
        $nextNumber = str_pad($totalPoliHariIni + 1, 3, '0', STR_PAD_LEFT);
        $nomorAntrean = $kodePoli . '-' . $nextNumber;

        // 5. Masukkan ke Tabel Antrean
        Antrean::create([
            'pasien_id' => $pasien->id,
            'nomor_antrean' => $nomorAntrean,
            'poli_tujuan' => $poli,
            'status' => 'menunggu'
        ]);

        // 6. Kembalikan ke halaman dashboard dengan pesan sukses
        return redirect()->route('petugas.dashboard')->with('success', 'Pasien berhasil didaftarkan dengan nomor ' . $nomorAntrean);
    }

    // 4. Menyediakan Data Dinamis untuk Section Poli di Halaman Beranda Pasien
    public function ambilAntrianIndex()
    {
        // 1. Ambil seluruh data antrean khusus hari ini
        $antreanHariIni = Antrean::whereDate('created_at', today())->get();

        // 2. Hitung total antrean per poli untuk membuat perkiraan nomor terakhir
        $totalUmum = $antreanHariIni->where('poli_tujuan', 'Poli Umum')->count();
        $totalGigi = $antreanHariIni->where('poli_tujuan', 'Poli Gigi')->count();
        $totalKia = $antreanHariIni->where('poli_tujuan', 'KIA / KB')->count();
        $totalImun = $antreanHariIni->where('poli_tujuan', 'Imunisasi')->count();
        $totalLansia = $antreanHariIni->where('poli_tujuan', 'Lansia')->count();

        $nomorTerakhir = [
            'umum' => 'U-' . str_pad($totalUmum, 3, '0', STR_PAD_LEFT),
            'gigi' => 'G-' . str_pad($totalGigi, 3, '0', STR_PAD_LEFT),
            'kia' => 'K-' . str_pad($totalKia, 3, '0', STR_PAD_LEFT),
            'imun' => 'I-' . str_pad($totalImun, 3, '0', STR_PAD_LEFT),
            'lansia' => 'L-' . str_pad($totalLansia, 3, '0', STR_PAD_LEFT),
        ];

        // 3. Ambil nomor antrean yang STATUSNYA saat ini sedang 'dipanggil' oleh petugas
        $sekarangUmum = $antreanHariIni->where('poli_tujuan', 'Poli Umum')->where('status', 'dipanggil')->sortByDesc('updated_at')->first();
        $sekarangGigi = $antreanHariIni->where('poli_tujuan', 'Poli Gigi')->where('status', 'dipanggil')->sortByDesc('updated_at')->first();
        $sekarangKia = $antreanHariIni->where('poli_tujuan', 'KIA / KB')->where('status', 'dipanggil')->sortByDesc('updated_at')->first();
        $sekarangImun = $antreanHariIni->where('poli_tujuan', 'Imunisasi')->where('status', 'dipanggil')->sortByDesc('updated_at')->first();
        $sekarangLansia = $antreanHariIni->where('poli_tujuan', 'Lansia')->where('status', 'dipanggil')->sortByDesc('updated_at')->first();

        $antreanSekarang = [
            'umum' => $sekarangUmum ? $sekarangUmum->nomor_antrean : 'U-000',
            'gigi' => $sekarangGigi ? $sekarangGigi->nomor_antrean : 'G-000',
            'kia' => $sekarangKia ? $sekarangKia->nomor_antrean : 'K-000',
            'imun' => $sekarangImun ? $sekarangImun->nomor_antrean : 'I-000',
            'lansia' => $sekarangLansia ? $sekarangLansia->nomor_antrean : 'L-000',
        ];

        /* 🌟 DIUBAH DI SINI: Dialihkan ke view beranda pasien, bukan ambil-antrian lagi */
        return view('pasien.beranda', compact('nomorTerakhir', 'antreanSekarang'));
    }

    // 5. Menyimpan Data dari Pop-up Modal Beranda Pasien Secara Resmi ke Database
    public function storePendaftaranPasien(Request $request)
    {
        // Validasi Input dari Pop-up Modal
        $request->validate([
            'temp_poli' => 'required|string',
            'status_pasien' => 'required|in:lama,baru',
            'identitas' => 'required|string|max:30', // Berisi Nomor Rekam Medis atau NIK
            'nama_pasien' => 'required|string|max:100',
        ]);

        $poli = $request->temp_poli;

        // Tentukan Huruf Kode berdasarkan Poli
        $kodePoli = 'U';
        if ($poli === 'Poli Gigi')
            $kodePoli = 'G';
        if ($poli === 'KIA / KB')
            $kodePoli = 'K';
        if ($poli === 'Imunisasi')
            $kodePoli = 'I';
        if ($poli === 'Lansia')
            $kodePoli = 'L';

        // Simpan data master identitas pasien
        $pasien = Pasien::updateOrCreate(
            ['nik' => $request->identitas],
            [
                'nama_pasien' => $request->nama_pasien,
                'tanggal_lahir' => now()->format('Y-m-d'), // Diisi default karena di modal tidak ada form tanggal lahir
                'jenis_kelamin' => 'L',
                'alamat' => '-',
                'no_hp' => '-',
            ]
        );

        // Hitung nomor urut antrean harian berdasarkan poli tujuan
        $totalPoliHariIni = Antrean::whereDate('created_at', today())
            ->where('poli_tujuan', $poli)
            ->count();

        $nextNumber = str_pad($totalPoliHariIni + 1, 3, '0', STR_PAD_LEFT);
        $nomorAntreanBaru = $kodePoli . '-' . $nextNumber;

        // Masukkan data ke tabel antrean
        Antrean::create([
            'pasien_id' => $pasien->id,
            'nomor_antrean' => $nomorAntreanBaru,
            'poli_tujuan' => $poli,
            'status' => 'menunggu'
        ]);

        // Kembalikan ke beranda dengan status notifikasi sukses
        return response()->json([
            'success' => true,
            'nomor_baru' => $nomorAntreanBaru,
            'poli_baru' => $poli
        ]);
    }
    // 6. Menampilkan Halaman Cek Antrean Semua Poli (Aktif & Dilewati)
    public function cekAntrian()
    {
        // Ambil data antrean khusus hari ini
        $antreanHariIni = Antrean::whereDate('created_at', today())->get();

        // Daftar Poliklinik yang ada
        $daftarPoli = [
            'umum' => ['nama' => 'Poli Umum', 'kode' => 'U', 'icon' => ' 🏥'],
            'gigi' => ['nama' => 'Poli Gigi', 'kode' => 'G', 'icon' => '✨'],
            'kia' => ['nama' => 'KIA / KB', 'kode' => 'K', 'icon' => '👶'],
            'imun' => ['nama' => 'Imunisasi', 'kode' => 'I', 'icon' => '💉'],
            'lansia' => ['nama' => 'Lansia', 'kode' => 'L', 'icon' => '👴'],
        ];

        $rekapAntrean = [];

        foreach ($daftarPoli as $key => $poli) {
            // 1. Cari nomor yang SAAT INI sedang dipanggil
            $sedangDipanggil = $antreanHariIni
                ->where('poli_tujuan', $poli['nama'])
                ->where('status', 'dipanggil')
                ->sortByDesc('updated_at')
                ->first();

            // 2. Ambil daftar nomor antrean yang DILEWATI hari ini
            $dilewati = $antreanHariIni
                ->where('poli_tujuan', $poli['nama'])
                ->where('status', 'dilewati')
                ->pluck('nomor_antrean') // Hanya ambil nomornya saja
                ->toArray();

            // Masukkan data ke array rekap
            $rekapAntrean[$key] = [
                'nama' => $poli['nama'],
                'icon' => $poli['icon'],
                'sekarang' => $sedangDipanggil ? $sedangDipanggil->nomor_antrean : $poli['kode'] . '-000',
                'dilewati' => !empty($dilewati) ? implode(', ', $dilewati) : 'Tidak ada'
            ];
        }

        // Kirim data ke view pasien.cek-antrian
        return view('pasien.cek-antrian', compact('rekapAntrean'));
    }

}
