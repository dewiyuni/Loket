<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Pasien Baru</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', sans-serif; }
        body { background-color: #f1f5f9; display: flex; height: 100vh; }
        .sidebar { width: 260px; background-color: #0f172a; color: #ffffff; padding: 24px 16px; }
        .sidebar-brand { font-size: 1.25rem; font-weight: 700; margin-bottom: 32px; padding-left: 12px; color: #38bdf8; }
        .sidebar-menu { list-style: none; display: flex; flex-direction: column; gap: 8px; }
        .menu-item a { display: flex; align-items: center; gap: 12px; padding: 12px; color: #94a3b8; text-decoration: none; border-radius: 8px; font-weight: 500; }
        .menu-item.active a, .menu-item a:hover { background-color: #1e293b; color: #ffffff; }
        .menu-item.active a { border-left: 4px solid #38bdf8; }
        .main-content { flex: 1; display: flex; flex-direction: column; overflow-y: auto; }
        .top-bar { background-color: #ffffff; height: 70px; display: flex; align-items: center; padding: 0 32px; border-bottom: 1px solid #e2e8f0; }
        .page-title { font-size: 1.25rem; font-weight: 600; color: #1e293b; }
        .content-body { padding: 32px; display: flex; justify-content: center; }
        .form-container { background: #ffffff; padding: 32px; border-radius: 12px; border: 1px solid #e2e8f0; width: 100%; max-width: 600px; }
        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; font-size: 0.9rem; font-weight: 600; color: #475569; margin-bottom: 6px; }
        .form-control { width: 100%; padding: 10px 14px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 0.95rem; outline: none; }
        .form-control:focus { border-color: #38bdf8; box-shadow: 0 0 0 3px rgba(56, 189, 248, 0.15); }
        .btn-submit { background-color: #2563eb; color: #ffffff; border: none; padding: 12px 24px; border-radius: 8px; font-weight: 600; cursor: pointer; width: 100%; font-size: 1rem; margin-top: 10px; }
        .btn-submit:hover { background-color: #1d4ed8; }
    </style>
</head>
<body>

    <!-- SIDEBAR NAVIGASI -->
    <aside class="sidebar">
        <div class="sidebar-brand">🏥 KLINIK HUB</div>
        <ul class="sidebar-menu">
            <li class="menu-item"><a href="/petugas/dashboard">📊 Dashboard</a></li>
            <li class="menu-item"><a href="#">⏳ Antrean</a></li>
            <li class="menu-item"><a href="#">👥 Data Pasien</a></li>
            <li class="menu-item active"><a href="/petugas/pendaftaran">📝 Pendaftaran</a></li>
            <li class="menu-item"><a href="#">📈 Laporan</a></li>
            <li class="menu-item"><a href="#">⚙️ Pengaturan</a></li>
        </ul>
    </aside>

    <!-- KONTEN UTAMA -->
    <main class="main-content">
        <div class="top-bar">
            <h1 class="page-title">Form Pendaftaran Pasien</h1>
        </div>

        <div class="content-body">
            <div class="form-container">
                <form action="{{ route('pendaftaran.simpan') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>NIK Pasien (16 Digit)</label>
                        <input type="text" name="nik" class="form-control" placeholder="Masukkan NIK" required maxlength="16">
                    </div>
                    <div class="form-group">
                        <label>Nama Lengkap Pasien</label>
                        <input type="text" name="nama_pasien" class="form-control" placeholder="Masukkan Nama Lengkap" required>
                    </div>
                    <div class="form-group" style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                        <div>
                            <label>Tanggal Lahir</label>
                            <input type="date" name="tanggal_lahir" class="form-control" required>
                        </div>
                        <div>
                            <label>Jenis Kelamin</label>
                            <select name="jenis_kelamin" class="form-control" required>
                                <option value="L">Laki-Laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Poli Tujuan</label>
                        <select name="poli_tujuan" class="form-control" required>
                            <option value="Poli Umum">Poli Umum</option>
                            <option value="Poli Gigi">Poli Gigi</option>
                            <option value="Poli KIA/Anak">Poli KIA / Anak</option>
                        </select>
                    </div>
                    <button type="submit" class="btn-submit">🎟️ Daftarkan Pasien & Cetak Nomor</button>
                </form>
            </div>
        </div>
    </main>

</body>
</html>
