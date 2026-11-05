<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard Petugas Klinik</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        :root {
            --primary: #0ea5e9;
            --primary-dark: #0284c7;
            --success: #16a34a;
            --warning: #d97706;
            --danger: #dc2626;
            --dark: #0f172a;
            --text: #1e293b;
            --muted: #64748b;
            --border: #e2e8f0;
            --bg: #f8fafc;
            --white: #fff;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            background: var(--bg);
            color: var(--text);
            min-height: 100vh;
        }

        button { font: inherit; }
        .app { display: flex; min-height: 100vh; }

        /* SIDEBAR */
        .sidebar {
            width: 250px;
            flex: 0 0 250px;
            background: var(--dark);
            color: white;
            padding: 22px 14px;
            display: flex;
            flex-direction: column;
            position: sticky;
            top: 0;
            height: 100vh;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 12px 28px;
            font-size: 18px;
            font-weight: 800;
            letter-spacing: .2px;
        }

        .brand-icon {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            display: grid;
            place-items: center;
            background: rgba(14,165,233,.15);
            font-size: 20px;
        }

        .menu-title {
            color: #64748b;
            font-size: 11px;
            text-transform: uppercase;
            font-weight: 700;
            padding: 0 12px 8px;
            letter-spacing: .8px;
        }

        .sidebar-menu { list-style: none; display: grid; gap: 5px; }

        .sidebar-menu a {
            display: flex;
            align-items: center;
            gap: 11px;
            padding: 11px 12px;
            color: #94a3b8;
            text-decoration: none;
            border-radius: 9px;
            font-size: 14px;
            font-weight: 600;
            transition: .2s ease;
        }

        .sidebar-menu a:hover,
        .sidebar-menu .active a {
            color: white;
            background: #1e293b;
        }

        .sidebar-menu .active a {
            box-shadow: inset 3px 0 0 var(--primary);
        }

        .sidebar-footer {
            margin-top: auto;
            padding: 14px 12px 4px;
            color: #64748b;
            font-size: 11px;
        }

        /* MAIN */
        .main {
            flex: 1;
            min-width: 0;
        }

        .topbar {
            min-height: 70px;
            background: white;
            border-bottom: 1px solid var(--border);
            padding: 0 30px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            position: sticky;
            top: 0;
            z-index: 10;
        }

        .page-title { font-size: 20px; font-weight: 750; }
        .page-subtitle { margin-top: 3px; color: var(--muted); font-size: 12px; }

        .profile {
            display: flex;
            align-items: center;
            gap: 10px;
            white-space: nowrap;
        }

        .avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            display: grid;
            place-items: center;
            background: #e0f2fe;
            font-size: 18px;
        }

        .profile-name { font-size: 13px; font-weight: 700; }
        .profile-role { font-size: 11px; color: var(--muted); margin-top: 2px; }

        .content { padding: 28px 30px 40px; max-width: 1600px; }

        /* STATS */
        .stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
            margin-bottom: 26px;
        }

        .stat-card {
            background: white;
            border: 1px solid var(--border);
            border-radius: 14px;
            padding: 19px 20px;
            display: flex;
            align-items: center;
            gap: 15px;
            box-shadow: 0 2px 8px rgba(15,23,42,.04);
        }

        .stat-icon {
            width: 46px;
            height: 46px;
            border-radius: 12px;
            display: grid;
            place-items: center;
            font-size: 21px;
            background: #f1f5f9;
        }

        .stat-label {
            color: var(--muted);
            font-size: 12px;
            font-weight: 650;
            margin-bottom: 3px;
        }

        .stat-value { font-size: 26px; font-weight: 800; }

        /* SECTION */
        .section-head {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 4px 0 13px;
        }

        .section-title { font-size: 16px; font-weight: 750; }
        .section-note { color: var(--muted); font-size: 12px; }

        /* POLI CARDS */
        .poli-grid {
            display: grid;
            grid-template-columns: repeat(5, minmax(0, 1fr));
            gap: 14px;
            margin-bottom: 25px;
        }

        .poli-card {
            background: white;
            border: 1px solid var(--border);
            border-top: 4px solid var(--poli-color);
            border-radius: 13px;
            padding: 16px;
            min-height: 245px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            box-shadow: 0 2px 8px rgba(15,23,42,.04);
        }

        .poli-name {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 13px;
            font-weight: 750;
        }

        .poli-icon {
            width: 30px;
            height: 30px;
            border-radius: 8px;
            display: grid;
            place-items: center;
            background: color-mix(in srgb, var(--poli-color) 12%, white);
            font-size: 15px;
        }

        .active-label {
            color: var(--muted);
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: .5px;
            margin-top: 16px;
        }

        .active-number {
            color: var(--poli-color);
            font-size: 34px;
            font-weight: 850;
            line-height: 1.1;
            margin: 5px 0 6px;
        }

        .patient-name {
            color: var(--muted);
            font-size: 11px;
            line-height: 1.4;
            min-height: 31px;
        }

        .actions { display: grid; gap: 6px; margin-top: 13px; }

        .btn {
            width: 100%;
            border: 0;
            border-radius: 7px;
            padding: 8px 10px;
            cursor: pointer;
            font-size: 12px;
            font-weight: 700;
            transition: transform .12s, opacity .12s;
        }

        .btn:hover { opacity: .9; }
        .btn:active { transform: scale(.98); }
        .btn-call { background: #e0f2fe; color: #0369a1; }
        .btn-done { background: var(--poli-color); color: white; }
        .btn-skip { background: #fee2e2; color: #b91c1c; }
        .btn:disabled { opacity: .45; cursor: not-allowed; }

        /* TABLES */
        .tables {
            display: grid;
            grid-template-columns: minmax(0, 2fr) minmax(300px, 1fr);
            gap: 18px;
            margin-bottom: 20px;
        }

        .tables-full {
            display: grid;
            grid-template-columns: 1fr;
            margin-bottom: 20px;
        }

        .panel {
            background: white;
            border: 1px solid var(--border);
            border-radius: 13px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(15,23,42,.04);
        }

        .panel-primary { border-top: 4px solid var(--primary); }
        .panel-danger { border-top: 4px solid var(--danger); }
        .panel-success { border-top: 4px solid var(--success); }

        .panel-header {
            padding: 17px 18px;
            border-bottom: 1px solid var(--border);
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 10px;
        }

        .panel-title { font-size: 14px; font-weight: 750; }
        .count-badge {
            min-width: 25px;
            padding: 3px 7px;
            border-radius: 99px;
            background: #f1f5f9;
            color: var(--muted);
            font-size: 11px;
            text-align: center;
        }

        /* ✨ Gaya Input Pencarian */
        .search-input {
            border: 1px solid var(--border);
            border-radius: 6px;
            padding: 6px 10px;
            font-size: 12px;
            outline: none;
            width: 200px;
            transition: border 0.2s;
        }
        .search-input:focus {
            border-color: var(--primary);
        }

        .table-wrap { overflow-x: auto; }

        table { width: 100%; border-collapse: collapse; }
        th {
            background: #f8fafc;
            color: var(--muted);
            font-size: 11px;
            font-weight: 750;
            text-align: left;
            padding: 11px 14px;
            white-space: nowrap;
        }

        td {
            padding: 11px 14px;
            border-top: 1px solid #f1f5f9;
            font-size: 12px;
            color: #334155;
        }

        tbody tr:hover { background: #f8fafc; }

        .queue-number {
            font-weight: 850;
            color: var(--primary-dark);
            font-size: 13px;
        }

        .mini-btn {
            border: 0;
            border-radius: 6px;
            padding: 6px 9px;
            cursor: pointer;
            font-size: 11px;
            font-weight: 700;
        }

        .mini-call { background: var(--primary); color: white; }
        .mini-return { background: #e2e8f0; color: #475569; }
        .empty { text-align: center; color: var(--muted); padding: 25px; }

        /* TOAST */
        .toast {
            position: fixed;
            right: 25px;
            bottom: 25px;
            z-index: 100;
            background: #0f172a;
            color: white;
            padding: 12px 16px;
            border-radius: 9px;
            font-size: 12px;
            box-shadow: 0 8px 25px rgba(0,0,0,.18);
            opacity: 0;
            transform: translateY(10px);
            pointer-events: none;
            transition: .25s ease;
        }

        .toast.show { opacity: 1; transform: translateY(0); }

        /* MOBILE */
        @media (max-width: 1200px) {
            .poli-grid { grid-template-columns: repeat(3, minmax(0, 1fr)); }
        }

        @media (max-width: 900px) {
            .sidebar {
                width: 68px;
                flex-basis: 68px;
                padding: 15px 8px;
            }

            .brand { justify-content: center; padding: 8px 0 22px; }
            .brand-text, .menu-title, .sidebar-menu a span, .sidebar-footer { display: none; }
            .sidebar-menu a { justify-content: center; padding: 12px 8px; }
            .topbar { padding: 0 20px; }
            .content { padding: 22px 20px 35px; }
            .stats { grid-template-columns: 1fr; }
            .tables { grid-template-columns: 1fr; }
        }

        @media (max-width: 650px) {
            .topbar { min-height: 65px; }
            .page-title { font-size: 17px; }
            .page-subtitle { display: none; }
            .profile-info { display: none; }
            .content { padding: 18px 14px 30px; }
            .poli-grid { grid-template-columns: 1fr 1fr; gap: 10px; }
            .poli-card { min-height: 225px; padding: 13px; }
            .active-number { font-size: 28px; }
            .section-head { align-items: flex-start; flex-direction: column; gap: 4px; }
            .search-input { width: 120px; }
            .panel-header { flex-direction: column; align-items: flex-start; }
        }

        @media (max-width: 430px) {
            .poli-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>

<body>
<div class="app">

    <aside class="sidebar">
        <div class="brand">
            <div class="brand-icon">🏥</div>
            <span class="brand-text">KLINIK HUB</span>
        </div>

        <div class="menu-title">Menu Utama</div>
        <ul class="sidebar-menu">
            <li class="active">
                <a href="#"><span>📊</span><span>Dashboard</span></a>
            </li>
            <li>
                <a href="#"><span>⏳</span><span>Antrean</span></a>
            </li>
            <li>
                <a href="#"><span>👥</span><span>Data Pasien</span></a>
            </li>
            <li>
                <a href="/petugas/pendaftaran"><span>📝</span><span>Pendaftaran</span></a>
            </li>
            <li>
                <a href="#"><span>📈</span><span>Laporan</span></a>
            </li>
            <li>
                <a href="#"><span>⚙️</span><span>Pengaturan</span></a>
            </li>
        </ul>

        <div class="sidebar-footer">Sistem Manajemen Antrean<br>© {{ date('Y') }} Klinik Hub</div>
    </aside>

    <main class="main">
        <header class="topbar">
            <div>
                <h1 class="page-title">Dashboard & Manajemen Antrean</h1>
                <div class="page-subtitle">Kelola panggilan pasien dari setiap poli</div>
            </div>

            <div class="profile">
                <div class="avatar">🧑‍⚕️</div>
                <div class="profile-info">
                    <div class="profile-name">Petugas Andi</div>
                    <div class="profile-role">Petugas Klinik</div>
                </div>
            </div>
        </header>

        <section class="content">

            <!-- STATISTIK -->
            <div class="stats">
                <div class="stat-card">
                    <div class="stat-icon">🎫</div>
                    <div>
                        <div class="stat-label">Total Antrean Hari Ini</div>
                        <div class="stat-value">{{ $totalHariIni }}</div>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon">⏳</div>
                    <div>
                        <div class="stat-label">Sedang Menunggu</div>
                        <div class="stat-value" style="color:var(--warning)">{{ $sisaMenunggu }}</div>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon">✅</div>
                    <div>
                        <div class="stat-label">Selesai Dilayani</div>
                        <div class="stat-value" style="color:var(--success)">{{ $totalSelesai }}</div>
                    </div>
                </div>
            </div>

            <!-- PANGGILAN AKTIF -->
            @php
                $polis = [
                    ['key' => 'umum',  'nama' => 'Poli Umum', 'color' => '#3b82f6', 'icon' => '🩺'],
                    ['key' => 'gigi',  'nama' => 'Poli Gigi', 'color' => '#10b981', 'icon' => '🦷'],
                    ['key' => 'kia',   'nama' => 'KIA / KB', 'color' => '#ec4899', 'icon' => '👶'],
                    ['key' => 'imun',  'nama' => 'Imunisasi', 'color' => '#f59e0b', 'icon' => '💉'],
                    ['key' => 'lansia','nama' => 'Lansia', 'color' => '#8b5cf6', 'icon' => '👴']
                ];
            @endphp

            <div class="section-head">
                <div>
                    <div class="section-title">📢 Panggilan Aktif Per Poli</div>
                    <div class="section-note">Nomor yang sedang dipanggil oleh petugas</div>
                </div>
            </div>

            <div class="poli-grid">
                @foreach($polis as $poli)
                    @php
                        $currentActive = isset($activeCallsList)
                            ? $activeCallsList->where('poli_tujuan', $poli['nama'])->first()
                            : null;
                    @endphp

                    <div class="poli-card" style="--poli-color: {{ $poli['color'] }}">
                        <div>
                            <div class="poli-name">
                                <div class="poli-icon">{{ $poli['icon'] }}</div>
                                {{ $poli['nama'] }}
                            </div>

                            <div class="active-label">Nomor aktif</div>
                            <div
                                class="active-number"
                                id="num-{{ $poli['key'] }}"
                                data-id="{{ $currentActive?->id ?? '' }}"
                            >
                                {{ $currentActive?->nomor_antrean ?? '-' }}
                            </div>

                            <div class="patient-name" id="patient-{{ $poli['key'] }}">
                                {{ $currentActive?->pasien?->nama_pasien ?? 'Tidak ada panggilan aktif' }}
                            </div>
                        </div>

                        <div class="actions">
                            <button
                                type="button"
                                class="btn btn-call"
                                onclick="panggilUlang('{{ $poli['key'] }}')"
                                {{ !$currentActive ? 'disabled' : '' }}
                            >🔊 Panggil Ulang</button>

                            <button
                                type="button"
                                class="btn btn-done"
                                onclick="ubahStatusAktif('{{ $poli['key'] }}', 'selesai')"
                                {{ !$currentActive ? 'disabled' : '' }}
                            >✅ Selesai</button>

                            <button
                                type="button"
                                class="btn btn-skip"
                                onclick="ubahStatusAktif('{{ $poli['key'] }}', 'dilewati')"
                                {{ !$currentActive ? 'disabled' : '' }}
                            >⏭️ Lewati</button>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- TABEL BOOKING ONLINE (BELUM HADIR) -->
            <div class="tables-full">
                <section class="panel panel-primary">
                    <div class="panel-header">
                        <div class="panel-title">📱 Daftar Booking Online (Belum Hadir)</div>
                        <div class="d-flex align-items-center gap-3">
                            <!-- ✨ KOLOM PENCARIAN BOOKING -->
                            <input type="text" class="search-input" placeholder="Cari nama / no..." onkeyup="filterTable(this, 'table-booking')">
                            <div class="count-badge">{{ $bookingList->count() }}</div>
                        </div>
                    </div>

                    <div class="table-wrap">
                        <table id="table-booking">
                            <thead>
                                <tr>
                                    <th>No. Antrean</th>
                                    <th>Kode Booking</th>
                                    <th>Nama Pasien</th>
                                    <th>Poli Tujuan</th>
                                    <th>Aksi Petugas</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($bookingList as $item)
                                    <tr id="row-booking-{{ $item->id }}">
                                        <td><span class="queue-number" style="color: var(--warning);">{{ $item->nomor_antrean }}</span></td>
                                        <td><code>{{ $item->kode_booking }}</code></td>
                                        <td>{{ $item->pasien?->nama_pasien ?? '-' }}</td>
                                        <td>{{ $item->poli_tujuan }}</td>
                                        <td>
                                            <button type="button" class="mini-btn mini-call" style="background: var(--success);" onclick="verifikasiKedatangan({{ $item->id }})">✅ Verifikasi Kedatangan</button>
                                            <button type="button" class="mini-btn mini-skip" style="background: #fee2e2; color: #b91c1c;" onclick="lewatiBooking({{ $item->id }})">⏭️ Lewati</button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="empty">Belum ada pasien booking online hari ini.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </section>
            </div>

            <!-- TABEL ANTREAN FISIK & TERLEWAT -->
            <div class="tables">
                <!-- DAFTAR ANTREAN MASUK -->
                <section class="panel">
                    <div class="panel-header">
                        <div class="panel-title">⏳ Daftar Antrean Masuk (Fisik)</div>
                        <div class="d-flex align-items-center gap-3">
                            <!-- ✨ KOLOM PENCARIAN ANTREAN MASUK -->
                            <input type="text" class="search-input" placeholder="Cari nama / no..." onkeyup="filterTable(this, 'table-masuk')" style="width: 140px;">
                            <div class="count-badge">{{ $waitingList->count() }}</div>
                        </div>
                    </div>

                    <div class="table-wrap">
                        <table id="table-masuk">
                            <thead>
                                <tr>
                                    <th>No. Antrean</th>
                                    <th>Nama Pasien</th>
                                    <th>Poli Tujuan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($waitingList as $item)
                                    <tr id="row-{{ $item->id }}">
                                        <td>
                                            <span class="queue-number">{{ $item->nomor_antrean }}</span>
                                        </td>
                                        <td>{{ $item->pasien?->nama_pasien ?? '-' }}</td>
                                        <td>{{ $item->poli_tujuan }}</td>
                                        <td>
                                            <button
                                                type="button"
                                                class="mini-btn mini-call"
                                                data-id="{{ $item->id }}"
                                                data-nomor="{{ $item->nomor_antrean }}"
                                                data-poli="{{ $item->poli_tujuan }}"
                                                onclick="panggilAntreanBaru(this)"
                                            >🔊 Panggil</button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="empty">Tidak ada antrean dalam daftar tunggu hari ini.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </section>

                <!-- ANTREAN TERLEWAT -->
                <section class="panel panel-danger">
                    <div class="panel-header">
                        <div class="panel-title">⚠️ Antrean Terlewat</div>
                        <div class="d-flex align-items-center gap-3">
                            <!-- ✨ KOLOM PENCARIAN TERLEWAT -->
                            <input type="text" class="search-input" placeholder="Cari no..." onkeyup="filterTable(this, 'table-terlewat')" style="width: 100px;">
                            <div class="count-badge">{{ $skippedList->count() }}</div>
                        </div>
                    </div>

                    <div class="table-wrap">
                        <table id="table-terlewat">
                            <thead>
                                <tr>
                                    <th>No. Antrean</th>
                                    <th>Poli</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($skippedList as $skipped)
                                    <tr>
                                        <td>
                                            <span class="queue-number" style="color:var(--danger)">
                                                {{ $skipped->nomor_antrean }}
                                            </span>
                                        </td>
                                        <td>{{ $skipped->poli_tujuan }}</td>
                                        <td>
                                            <button
                                                type="button"
                                                class="mini-btn mini-return"
                                                onclick="kembalikanKeAntrean({{ $skipped->id }})"
                                            >🔄 Putar</button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="empty">Belum ada antrean terlewat.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </section>
            </div>

            <!-- TABEL ANTREAN SELESAI (ACCORDION) -->
            <div class="tables-full" style="margin-top: 10px;">
                <div class="accordion" id="accordionSelesai">
                    <div class="accordion-item" style="border: 1px solid var(--border); border-radius: 13px; overflow: hidden; box-shadow: 0 2px 8px rgba(15,23,42,.04);">
                        <h2 class="accordion-header" id="headingSelesai">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSelesai" aria-expanded="false" aria-controls="collapseSelesai" style="background-color: #fff; border-top: 4px solid var(--success); color: var(--text); font-weight: 750; padding: 17px 18px; font-size: 14px;">
                                ✅ Daftar Antrean Selesai 
                                <span class="badge bg-success ms-2 rounded-pill">{{ $selesaiList->count() }}</span>
                            </button>
                        </h2>
                        <div id="collapseSelesai" class="accordion-collapse collapse" aria-labelledby="headingSelesai" data-bs-parent="#accordionSelesai">
                            <div class="accordion-body p-0">
                                
                                <!-- Header Khusus untuk Pencarian di Accordion -->
                                <div class="p-3 border-bottom d-flex justify-content-between align-items-center bg-light">
                                    <span class="text-muted" style="font-size: 12px;">Riwayat antrean hari ini</span>
                                    <!-- ✨ KOLOM PENCARIAN SELESAI -->
                                    <input type="text" class="search-input" placeholder="Cari nama / no..." onkeyup="filterTable(this, 'table-selesai')">
                                </div>

                                <div class="table-wrap">
                                    <table id="table-selesai">
                                        <thead>
                                            <tr>
                                                <th>No. Antrean</th>
                                                <th>Nama Pasien</th>
                                                <th>Poli Tujuan</th>
                                                <th>Waktu Selesai</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($selesaiList as $selesai)
                                                <tr>
                                                    <td>
                                                        <span class="queue-number" style="color:var(--success)">
                                                            {{ $selesai->nomor_antrean }}
                                                        </span>
                                                    </td>
                                                    <td>{{ $selesai->pasien?->nama_pasien ?? '-' }}</td>
                                                    <td>{{ $selesai->poli_tujuan }}</td>
                                                    <td>{{ $selesai->updated_at->format('H:i') }} WIB</td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="4" class="empty">Belum ada antrean yang selesai dilayani hari ini.</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>
    </main>
</div>

<div id="toast" class="toast"></div>

<!-- Bootstrap JS untuk Accordion -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    // ✨ FUNGSI PENCARIAN TABEL
    function filterTable(inputElement, tableId) {
        const filter = inputElement.value.toLowerCase();
        const table = document.getElementById(tableId);
        const rows = table.getElementsByTagName('tr');

        // Mulai dari index 1 karena index 0 adalah <thead>
        for (let i = 1; i < rows.length; i++) {
            const row = rows[i];
            // Jika baris tersebut adalah baris "empty" (tidak ada data), lewati
            if (row.classList.contains('empty') || row.querySelector('.empty')) continue; 
            
            let textValue = row.textContent || row.innerText;
            if (textValue.toLowerCase().indexOf(filter) > -1) {
                row.style.display = "";
            } else {
                row.style.display = "none";
            }
        }
    }

    function showToast(message) {
        const toast = document.getElementById('toast');
        toast.textContent = message;
        toast.classList.add('show');
        clearTimeout(window.toastTimer);
        window.toastTimer = setTimeout(() => toast.classList.remove('show'), 2500);
    }

    function bunyikanSuara(nomor, poli) {
        if (!('speechSynthesis' in window)) {
            showToast('Browser tidak mendukung suara otomatis.');
            return;
        }

        window.speechSynthesis.cancel();

        const nomorDieja = String(nomor).replace(/-/g, ' ');
        const ucapan = new SpeechSynthesisUtterance(
            `Nomor antrean ${nomorDieja}, silakan menuju ${poli}`
        );

        ucapan.lang = 'id-ID';
        ucapan.rate = 0.85;
        ucapan.pitch = 1;

        window.speechSynthesis.speak(ucapan);
    }

    function updateStatus(id, status, afterSuccess = null) {
        return fetch(`/petugas/antrean/${id}/update-status`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            },
            body: JSON.stringify({ status })
        })
        .then(response => {
            if (!response.ok) throw new Error('Server mengembalikan error.');
            return response.json();
        })
        .then(data => {
            if (!data.success) {
                throw new Error(data.message || 'Gagal memperbarui status antrean.');
            }

            if (typeof afterSuccess === 'function') afterSuccess(data);
            return data;
        });
    }

    // Fungsi Verifikasi: Pasien online sudah datang, masukkan ke antrean fisik
    function verifikasiKedatangan(id) {
        if (!confirm('Pasien sudah hadir di loket? Masukkan ke antrean fisik?')) return;

        updateStatus(id, 'menunggu')
            .then(() => {
                showToast('Pasien berhasil diverifikasi dan masuk antrean.');
                location.reload();
            })
            .catch(error => {
                console.error(error);
                showToast(error.message || 'Gagal memverifikasi pasien.');
            });
    }

    // Fungsi Lewati: Pasien online tidak datang / hangus
    function lewatiBooking(id) {
        if (!confirm('Tandai pasien ini tidak hadir (lewati)?')) return;

        updateStatus(id, 'dilewati')
            .then(() => {
                showToast('Booking pasien dilewati.');
                location.reload();
            })
            .catch(error => {
                console.error(error);
                showToast(error.message || 'Gagal melewati booking.');
            });
    }

    // Memanggil antrean baru dari waiting list.
    function panggilAntreanBaru(button) {
        const id = button.dataset.id;
        const nomor = button.dataset.nomor;
        const poli = button.dataset.poli;

        button.disabled = true;
        button.textContent = 'Memproses...';

        updateStatus(id, 'dipanggil')
            .then(() => {
                localStorage.setItem('pemicuSuara', JSON.stringify({ nomor, poli }));
                location.reload();
            })
            .catch(error => {
                button.disabled = false;
                button.textContent = '🔊 Panggil';
                console.error(error);
                showToast(error.message || 'Gagal memanggil antrean.');
            });
    }

    // Memanggil ulang nomor yang sedang aktif pada poli tertentu.
    function panggilUlang(poliKey) {
        const numberBox = document.getElementById(`num-${poliKey}`);
        const patientBox = document.getElementById(`patient-${poliKey}`);

        if (!numberBox) return;

        const nomor = numberBox.textContent.trim();
        const poliNames = {
            umum: 'Poli Umum',
            gigi: 'Poli Gigi',
            kia: 'KIA / KB',
            imun: 'Imunisasi',
            lansia: 'Lansia'
        };

        if (nomor === '-' || !numberBox.dataset.id) {
            showToast('Tidak ada antrean aktif pada poli ini.');
            return;
        }

        bunyikanSuara(nomor, poliNames[poliKey] || patientBox.textContent.trim());
    }

    // Selesaikan atau lewati nomor aktif.
    function ubahStatusAktif(poliKey, statusBaru) {
        const numberBox = document.getElementById(`num-${poliKey}`);
        const id = numberBox?.dataset.id;

        if (!id || !numberBox || numberBox.textContent.trim() === '-') {
            showToast('Tidak ada panggilan aktif yang bisa diproses.');
            return;
        }

        const actionText = statusBaru === 'selesai' ? 'menyelesaikan' : 'melewati';

        if (!confirm(`Yakin ingin ${actionText} antrean ${numberBox.textContent.trim()}?`)) {
            return;
        }

        updateStatus(id, statusBaru)
            .then(() => location.reload())
            .catch(error => {
                console.error(error);
                showToast(error.message || 'Gagal memperbarui status antrean.');
            });
    }

    // Mengembalikan antrean terlewat ke daftar menunggu.
    function kembalikanKeAntrean(id) {
        if (!confirm('Kembalikan antrean ini ke daftar menunggu?')) return;

        updateStatus(id, 'menunggu')
            .then(() => location.reload())
            .catch(error => {
                console.error(error);
                showToast(error.message || 'Gagal mengembalikan antrean.');
            });
    }

    // Suara diputar setelah reload ketika antrean baru dipanggil.
    document.addEventListener('DOMContentLoaded', function () {
        const pemicu = localStorage.getItem('pemicuSuara');

        if (!pemicu) return;

        try {
            const data = JSON.parse(pemicu);
            localStorage.removeItem('pemicuSuara');

            setTimeout(() => {
                bunyikanSuara(data.nomor, data.poli);
            }, 600);
        } catch (error) {
            localStorage.removeItem('pemicuSuara');
            console.error('Data suara tidak valid:', error);
        }
    });
</script>
</body>
</html>