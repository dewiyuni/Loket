<?php

namespace App\Http\Controllers;

use App\Models\Antrean;
use App\Models\Pasien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AntreanController extends Controller
{
    // 1. Menampilkan Halaman Dashboard Utama Petugas
    public function index(Request $request)
    {
        $today = today();

        $totalHariIni = Antrean::whereDate('created_at', $today)->count();
        $sisaMenunggu = Antrean::whereDate('created_at', $today)->where('status', 'menunggu')->count();
        $totalSelesai = Antrean::whereDate('created_at', $today)->where('status', 'selesai')->count();

        // 1. Antrean fisik (sudah diverifikasi petugas)
        $waitingList = Antrean::with('pasien')->whereDate('created_at', $today)
            ->where('status', 'menunggu')->orderBy('id')->get();

        // 2. BOOKING ONLINE (Belum hadir / belum verifikasi)
        $bookingList = Antrean::with('pasien')->whereDate('created_at', $today)
            ->where('status', 'booking')->orderBy('id')->get();

        $skippedList = Antrean::with('pasien')->whereDate('created_at', $today)
            ->where('status', 'dilewati')->orderByDesc('updated_at')->get();

        $activeCallsList = Antrean::with('pasien')->whereDate('created_at', $today)
            ->where('status', 'dipanggil')->orderByDesc('updated_at')->get();

        $selesaiList = Antrean::with('pasien')->whereDate('created_at', $today)
            ->where('status', 'selesai')->orderByDesc('updated_at')->get();


        return view('petugas.dashboard', compact(
            'totalHariIni',
            'sisaMenunggu',
            'totalSelesai',
            'waitingList',
            'bookingList',
            'skippedList',
            'activeCallsList',
            'selesaiList'
        ));
    }

    // 2. API / Fungsi untuk Mengubah Status Antrean
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:booking,menunggu,dipanggil,selesai,dilewati'
        ]);

        $antrean = Antrean::findOrFail($id);
        $antrean->status = $request->status;
        $antrean->save();

        return response()->json([
            'success' => true,
            'message' => 'Status antrean berhasil diperbarui ke ' . $request->status,
            'data' => $antrean
        ]);
    }

    // 3. Menyimpan Pendaftaran oleh Petugas (Di Loket)
    public function storePendaftaran(Request $request)
    {
        $request->validate([
            'nik' => 'required|digits:16',
            'nama_pasien' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'poli_tujuan' => 'required|string',
        ]);

        $pasien = Pasien::updateOrCreate(
            ['nik' => $request->nik],
            [
                'nama_pasien' => $request->nama_pasien,
                'tanggal_lahir' => $request->tanggal_lahir,
                'jenis_kelamin' => $request->jenis_kelamin,
                'alamat' => $request->alamat ?? '-',
                'no_hp' => $request->no_hp ?? '-',
            ]
        );

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

        $totalPoliHariIni = Antrean::whereDate('created_at', today())->where('poli_tujuan', $poli)->count();
        $nextNumber = str_pad($totalPoliHariIni + 1, 3, '0', STR_PAD_LEFT);
        $nomorAntrean = $kodePoli . '-' . $nextNumber;

        $kodeBooking = 'BK-' . strtoupper(Str::random(4));

        Antrean::create([
            'pasien_id' => $pasien->id,
            'nomor_antrean' => $nomorAntrean,
            'kode_booking' => $kodeBooking,
            'poli_tujuan' => $poli,
            'metode_pembayaran' => $request->metode_pembayaran ?? 'Umum/Mandiri',
            'status' => 'menunggu', // ✅ FIX: Langsung masuk antrean fisik karena didaftarkan di loket
        ]);

        return redirect()->route('petugas.dashboard')->with('success', 'Pasien berhasil didaftarkan dengan nomor ' . $nomorAntrean);
    }

    // 4. Menyediakan Data Dinamis untuk Beranda Pasien
    public function ambilAntrianIndex()
    {
        $antreanHariIni = Antrean::whereDate('created_at', today())->get();

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

        return view('pasien.beranda', compact('nomorTerakhir', 'antreanSekarang'));
    }

    // 5. Menyimpan Pendaftaran dari Pop-up Modal Beranda Pasien
    public function storePendaftaranPasien(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'temp_poli' => 'required|string|in:Poli Umum,Poli Gigi,KIA / KB,Imunisasi,Lansia',
            'status_pasien' => 'required|in:lama,baru',
            'identitas' => 'required|string|max:30',
            'nama_pasien' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date|before_or_equal:today',
            'jenis_kelamin' => 'required|in:L,P',
            'no_hp' => 'nullable|string|max:15',
            'metode_pembayaran' => 'required|string|max:50',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi formulir gagal.',
                'errors' => $validator->errors(),
            ], 422);
        }

        try {
            $antrean = DB::transaction(function () use ($request) {
                $pasien = Pasien::updateOrCreate(
                    ['nik' => $request->identitas],
                    [
                        'nama_pasien' => $request->nama_pasien,
                        'tanggal_lahir' => $request->tanggal_lahir,
                        'jenis_kelamin' => $request->jenis_kelamin,
                        'alamat' => $request->alamat ?? '-',
                        'no_hp' => $request->no_hp ?? '-',
                    ]
                );

                $poli = $request->temp_poli;

                $kodePoli = match ($poli) {
                    'Poli Gigi' => 'G',
                    'KIA / KB' => 'K',
                    'Imunisasi' => 'I',
                    'Lansia' => 'L',
                    default => 'U',
                };

                $totalPoliHariIni = Antrean::whereDate('created_at', today())
                    ->where('poli_tujuan', $poli)
                    ->lockForUpdate()
                    ->count();

                $nomorAntrean = $kodePoli . '-' . str_pad($totalPoliHariIni + 1, 3, '0', STR_PAD_LEFT);

                do {
                    $kodeBooking = 'BK-' . strtoupper(Str::random(4));
                } while (Antrean::where('kode_booking', $kodeBooking)->exists());

                return Antrean::create([
                    'pasien_id' => $pasien->id,
                    'nomor_antrean' => $nomorAntrean,
                    'kode_booking' => $kodeBooking,
                    'poli_tujuan' => $poli,
                    'metode_pembayaran' => $request->metode_pembayaran,
                    'status' => 'booking', // ✅ FIX: Pasien booking online masuk ke daftar booking dulu
                ]);
            });

            return response()->json([
                'success' => true,
                'nomor_baru' => $antrean->nomor_antrean,
                'poli_baru' => $antrean->poli_tujuan,
                'kode_booking' => $antrean->kode_booking,
            ]);

        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menyimpan: ' . $e->getMessage(),
            ], 500);
        }
    }

    // 6. Cek Antrean Semua Poli
    public function cekAntrian()
    {
        $antreanHariIni = Antrean::whereDate('created_at', today())->get();

        $daftarPoli = [
            'umum' => ['nama' => 'Poli Umum', 'kode' => 'U', 'icon' => ' 🏥'],
            'gigi' => ['nama' => 'Poli Gigi', 'kode' => 'G', 'icon' => '✨'],
            'kia' => ['nama' => 'KIA / KB', 'kode' => 'K', 'icon' => '👶'],
            'imun' => ['nama' => 'Imunisasi', 'kode' => 'I', 'icon' => '💉'],
            'lansia' => ['nama' => 'Lansia', 'kode' => 'L', 'icon' => '👴'],
        ];

        $rekapAntrean = [];

        foreach ($daftarPoli as $key => $poli) {
            $sedangDipanggil = $antreanHariIni->where('poli_tujuan', $poli['nama'])->where('status', 'dipanggil')->sortByDesc('updated_at')->first();
            $dilewati = $antreanHariIni->where('poli_tujuan', $poli['nama'])->where('status', 'dilewati')->pluck('nomor_antrean')->toArray();

            $rekapAntrean[$key] = [
                'nama' => $poli['nama'],
                'icon' => $poli['icon'],
                'sekarang' => $sedangDipanggil ? $sedangDipanggil->nomor_antrean : $poli['kode'] . '-000',
                'dilewati' => !empty($dilewati) ? implode(', ', $dilewati) : 'Tidak ada'
            ];
        }

        return view('pasien.cek-antrian', compact('rekapAntrean'));
    }

    public function informasi()
    {
        return $this->ambilAntrianIndex();
    }

    // 7. Fungsi Check-In Petugas berdasarkan Kode Booking QR
    public function checkIn(Request $request)
    {
        $antrean = Antrean::where('kode_booking', $request->kode_booking)->first();

        if ($antrean) {
            $antrean->update(['status' => 'dipanggil']);
            return response()->json([
                'success' => true,
                'message' => 'Pasien dengan kode ' . $request->kode_booking . ' berhasil check-in dan tercatat hadir!'
            ]);
        }
        return response()->json([
            'success' => false,
            'message' => 'Kode booking tidak ditemukan di database!'
        ]);
    }
}