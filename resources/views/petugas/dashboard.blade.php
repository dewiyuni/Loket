<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Petugas Klinik</title>
    <!-- CSRF Token untuk mengamankan request hit database lewat JavaScript -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #f1f5f9;
            display: flex;
            height: 100vh;
            overflow: hidden;
        }

        /* Sidebar Styling */
        .sidebar {
            width: 260px;
            background-color: #0f172a;
            color: #ffffff;
            display: flex;
            flex-direction: column;
            padding: 24px 16px;
        }

        .sidebar-brand {
            font-size: 1.25rem;
            font-weight: 700;
            margin-bottom: 32px;
            padding-left: 12px;
            color: #38bdf8;
        }

        .sidebar-menu {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .menu-item a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px;
            color: #94a3b8;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.2s;
        }

        .menu-item.active a, .menu-item a:hover {
            background-color: #1e293b;
            color: #ffffff;
        }

        .menu-item.active a {
            border-left: 4px solid #38bdf8;
        }

        /* Main Content Area */
        .main-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            overflow-y: auto;
        }

        .top-bar {
            background-color: #ffffff;
            height: 70px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 32px;
            border-bottom: 1px solid #e2e8f0;
        }

        .page-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: #1e293b;
        }

        .user-profile {
            font-weight: 500;
            color: #64748b;
        }

        .content-body {
            padding: 32px;
        }

        /* Statistik Ringkas (Cards) */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
            margin-bottom: 32px;
        }

        .stat-card {
            background-color: #ffffff;
            padding: 24px;
            border-radius: 12px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        }

        .stat-card h4 {
            font-size: 0.85rem;
            color: #64748b;
            text-transform: uppercase;
            margin-bottom: 8px;
        }

        .stat-card .value {
            font-size: 2rem;
            font-weight: 700;
            color: #0f172a;
        }

        /* Area Manajemen Antrean */
        .queue-control-section {
            display: grid;
            grid-template-columns: 1fr 2fr;
            gap: 24px;
        }

        /* Kotak Antrean Aktif (Dipanggil) */
        .active-call-box {
            background-color: #ffffff;
            padding: 24px;
            border-radius: 12px;
            border: 2px solid #38bdf8;
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .active-call-box h3 {
            font-size: 1rem;
            color: #0284c7;
            margin-bottom: 12px;
        }

        .active-number {
            font-size: 3.5rem;
            font-weight: 800;
            color: #0369a1;
            margin-bottom: 16px;
            text-transform: uppercase;
        }

        .control-buttons {
            display: flex;
            flex-direction: column;
            gap: 10px;
            width: 100%;
        }

        .btn-ctrl {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            font-size: 0.95rem;
            transition: background 0.2s;
        }

        .btn-call { background-color: #22c55e; color: white; }
        .btn-call:hover { background-color: #16a34a; }
        .btn-skip { background-color: #e2e8f0; color: #475569; }
        .btn-skip:hover { background-color: #cbd5e1; }
        .btn-complete { background-color: #3b82f6; color: white; }
        .btn-complete:hover { background-color: #2563eb; }

        /* Tabel Antrean Masuk (Waiting List) */
        .queue-table-container {
            background-color: #ffffff;
            padding: 24px;
            border-radius: 12px;
            border: 1px solid #e2e8f0;
        }

        .queue-table-container h3 {
            margin-bottom: 16px;
            color: #1e293b;
            font-size: 1.1rem;
        }

        .queue-table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }

        .queue-table th, .queue-table td {
            padding: 14px;
            border-bottom: 1px solid #f1f5f9;
            font-size: 0.9rem;
        }

        .queue-table th {
            background-color: #f8fafc;
            color: #64748b;
            font-weight: 600;
        }

        .status-badge {
            padding: 4px 8px;
            border-radius: 6px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .status-waiting { background-color: #fef3c7; color: #d97706; }
        .status-serving { background-color: #dcfce7; color: #15803d; }
    </style>
</head>
<body>

    <!-- SIDEBAR NAVIGASI -->
    <aside class="sidebar">
        <div class="sidebar-brand">🏥 KLINIK HUB</div>
        <ul class="sidebar-menu">
            <li class="menu-item active"><a href="#">📊 Dashboard</a></li>
            <li class="menu-item"><a href="#">⏳ Antrean</a></li>
            <li class="menu-item"><a href="#">👥 Data Pasien</a></li>
            <li class="menu-item"><a href="/petugas/pendaftaran">📝 Pendaftaran</a></li>
            <li class="menu-item"><a href="#">📈 Laporan</a></li>
            <li class="menu-item"><a href="#">⚙️ Pengaturan</a></li>
        </ul>
    </aside>

    <!-- KONTEN UTAMA -->
    <main class="main-content">
        <div class="top-bar">
            <h1 class="page-title">Dashboard & Manajemen Antrean</h1>
            <div class="user-profile">Hello, Petugas Andi 🧑‍⚕️</div>
        </div>

        <div class="content-body">
            <!-- 1. STATS CARDS (DATA DINAMIS) -->
            <div class="stats-grid">
                <div class="stat-card">
                    <h4>Total Antrean Hari Ini</h4>
                    <div class="value">{{ $totalHariIni }}</div>
                </div>
                <div class="stat-card">
                    <h4>Sedang Menunggu</h4>
                    <div class="value" style="color: #d97706;">{{ $sisaMenunggu }}</div>
                </div>
                <div class="stat-card">
                    <h4>Selesai Dilayani</h4>
                    <div class="value" style="color: #16a34a;">{{ $totalSelesai }}</div>
                </div>
            </div>

            <!-- 2. MANAJEMEN ANTREAN MASUK -->
            <div class="queue-control-section">
                
                <!-- Sisi Kiri: Konsol Panggil Antrean -->
                <div class="active-call-box">
                    <h3>📢 PANGGILAN AKTIF</h3>
                    <div class="active-number" id="current-call-number" data-id="{{ $activeCall ? $activeCall->id : '' }}">
                        {{ $activeCall ? $activeCall->nomor_antrean : '-' }}
                    </div>
                    <p id="current-call-patient" style="color: #64748b; font-size: 0.85rem; margin-bottom: 20px;">
                        {{ $activeCall ? $activeCall->poli_tujuan . ' - ' . $activeCall->pasien->nama_pasien : 'Tidak ada panggilan aktif' }}
                    </p>
                    
                    <div class="control-buttons">
                        <button class="btn-ctrl btn-call" onclick="panggilUlang()">🔊 Panggil Ulang</button>
                        <button class="btn-ctrl btn-complete" style="margin-top: 8px;" onclick="ubahStatusAktif('selesai')">✅ Selesai & Lanjut</button>
                        <button class="btn-ctrl btn-skip" style="margin-top: 8px;" onclick="ubahStatusAktif('dilewati')">⏭️ Lewati / Absen</button>
                    </div>
                </div>

                <!-- Sisi Kanan: Daftar Antrean Tunggu -->
                <div class="queue-table-container">
                    <h3>⏳ Daftar Antrean Masuk (Waiting List)</h3>
                    <table class="queue-table">
                        <thead>
                            <tr>
                                <th>No. Antrean</th>
                                <th>Nama Pasien</th>
                                <th>Poli Tujuan</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($waitingList as $item)
                                <tr id="row-{{ $item->id }}">
                                    <td><b>{{ $item->nomor_antrean }}</b></td>
                                    <td>{{ $item->pasien->nama_pasien }}</td>
                                    <td>{{ $item->poli_tujuan }}</td>
                                    <td><span class="status-badge status-waiting">Menunggu</span></td>
                                    <td>
                                        <button onclick="panggilAntreanBaru({{ $item->id }}, '{{ $item->nomor_antrean }}', '{{ $item->poli_tujuan }} - {{ $item->pasien->nama_pasien }}')" style="padding: 6px 12px; background: #0ea5e9; color: white; border: none; border-radius: 4px; cursor: pointer; font-weight: 600;">
                                            Panggil
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" style="text-align: center; color: #64748b; padding: 20px;">
                                        Tidak ada antrean dalam daftar tunggu hari ini.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
