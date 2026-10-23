@extends('layouts.app')

@section('title', 'Beranda - Puskesmas Sidorejo')

@section('content')
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informasi Pelayanan - Puskesmas Sidorejo</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #f8fafc;
            color: #334155;
            line-height: 1.6;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 24px;
        }

        /* HEADER PAGE */
        .page-header {
            background-color: #ffffff;
            padding: 40px 0 20px;
            border-bottom: 1px solid #e2e8f0;
            margin-bottom: 30px;
        }

        .page-header h1 {
            color: #0f172a;
            font-size: 28px;
            margin-bottom: 8px;
        }

        .page-header p {
            color: #64748b;
            font-size: 16px;
        }

        .btn-kembali {
            display: inline-block;
            margin-bottom: 16px;
            color: #0284c7;
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
        }

        .btn-kembali:hover {
            text-decoration: underline;
        }

        /* GRID CONTENT */
        .info-detail-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 24px;
            margin-bottom: 40px;
        }

        .card-info {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 24px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        }

        .card-info h3 {
            color: #0f172a;
            font-size: 18px;
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 10px;
            border-bottom: 2px solid #f1f5f9;
            padding-bottom: 10px;
        }

        /* LIST & TABLE STYLES */
        .list-persyaratan {
            list-style: none;
        }

        .list-persyaratan li {
            padding: 8px 0;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 14px;
            border-bottom: 1px dashed #f1f5f9;
        }

        .list-persyaratan li:last-child {
            border-bottom: none;
        }

        .jadwal-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
        }

        .jadwal-table th, .jadwal-table td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #f1f5f9;
        }

        .jadwal-table th {
            background-color: #f8fafc;
            color: #475569;
        }

        /* ALUR ANTREAN */
        .alur-step {
            display: flex;
            gap: 16px;
            margin-bottom: 16px;
        }

        .alur-step:last-child {
            margin-bottom: 0;
        }

        .step-number {
            background: #e0f2fe;
            color: #0369a1;
            font-weight: bold;
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .step-text h5 {
            font-size: 15px;
            color: #0f172a;
            margin-bottom: 2px;
        }

        .step-text p {
            font-size: 13px;
            color: #64748b;
        }

        /* FOOTER / SUMMARY SECTION */
        .info-section {
            padding: 40px 0;
            background-color: #ffffff;
            border-top: 1px solid #f1f5f9;
            margin-top: 40px;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 24px;
        }

        .info-item {
            display: flex;
            align-items: flex-start;
            gap: 16px;
            padding: 20px;
            background-color: #f8fafc;
            border-radius: 12px;
        }

        .info-badge {
            font-size: 24px;
        }

        .info-content h4 {
            margin: 0 0 6px 0;
            color: #0f172a;
            font-size: 16px;
        }

        .info-content p {
            margin: 0;
            color: #64748b;
            font-size: 14px;
            white-space: pre-line;
        }
    </style>
</head>
<body>

    <!-- HEADER HALAMAN -->
    <div class="page-header">
        <div class="container">
            <a href="{{ url('beranda') }}" class="btn-kembali">← Kembali ke Beranda</a>
            <h1>Informasi Pelayanan Puskesmas</h1>
            <p>Panduan lengkap persyaratan, alur pendaftaran, serta jadwal pelayanan kesehatan.</p>
        </div>
    </div>

    <div class="container">
        <div class="info-detail-grid">

            <!-- CARD 1: PERSYARATAN BEROBAT -->
            <div class="card-info">
                <h3>📋 Persyaratan Berobat</h3>
                <ul class="list-persyaratan">
                    <li>✅ KTP / Kartu Keluarga (KK) Asli</li>
                    <li>✅ Kartu BPJS Kesehatan (Bagi Peserta BPJS)</li>
                    <li>✅ Kartu Berobat Puskesmas (Bagi Pasien Lama)</li>
                    <li>✅ Surat Rujukan (Jika Ada)</li>
                </ul>
            </div>

            <!-- CARD 2: ALUR PENDAFTARAN ONLINE -->
            <div class="card-info">
                <h3>🔄 Alur Antrean Online</h3>
                <div class="alur-step">
                    <div class="step-number">1</div>
                    <div class="step-text">
                        <h5>Ambil Nomor Antrean</h5>
                        <p>Pilih poli tujuan dan ambil nomor melalui website beranda.</p>
                    </div>
                </div>
                <div class="alur-step">
                    <div class="step-number">2</div>
                    <div class="step-text">
                        <h5>Datang Ke Puskesmas</h5>
                        <p>Tiba di puskesmas 15 menit sebelum perkiraan waktu panggil.</p>
                    </div>
                </div>
                <div class="alur-step">
                    <div class="step-number">3</div>
                    <div class="step-text">
                        <h5>Verifikasi & Pemeriksaan</h5>
                        <p>Tunjukkan tiket antrean ke petugas pendaftaran dan tunggu dipanggil di Poli.</p>
                    </div>
                </div>
            </div>

            <!-- CARD 3: JADWAL PELAYANAN POLI -->
            <div class="card-info" style="grid-column: 1 / -1;">
                <h3>🩺 Jadwal Pelayanan Poli</h3>
                <table class="jadwal-table">
                    <thead>
                        <tr>
                            <th>Poliklinik</th>
                            <th>Hari Operasional</th>
                            <th>Jam Layanan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><strong>Poli Umum</strong></td>
                            <td>Senin - Sabtu</td>
                            <td>07.30 - 13.00 WIB</td>
                        </tr>
                        <tr>
                            <td><strong>Poli Gigi</strong></td>
                            <td>Senin - Jumat</td>
                            <td>08.00 - 12.00 WIB</td>
                        </tr>
                        <tr>
                            <td><strong>KIA / KB</strong></td>
                            <td>Senin - Kamis</td>
                            <td>08.00 - 12.00 WIB</td>
                        </tr>
                        <tr>
                            <td><strong>Imunisasi & Lansia</strong></td>
                            <td>Rabu & Jumat</td>
                            <td>08.00 - 11.00 WIB</td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>

</body>
</html>

@endsection