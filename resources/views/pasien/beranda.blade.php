@extends('layouts.app')

@section('title', 'Beranda - Puskesmas Sidorejo')

@section('content')
<style>/* ==========================================
   1. ATURAN PENGATURAN DASAR & FONTSharp
   ========================================== */
* {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}
html{scroll-behavior: smooth}
body { 
    background-color: #f8fafc; 
    font-family: 'Plus Jakarta Sans', 'Inter', system-ui, -apple-system, sans-serif;
    color: #1e293b;
    line-height: 1.6;
}

.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 24px;
}

/* Utilitas Kelas Sembunyi */
.d-none {
    display: none !important;
}

/* ==========================================
   2. HERO BANNER SECTION (BAGIAN ATAS)
   ========================================== */
.hero-section {
    background-color: #ffffff;
    padding: 60px 0;
    border-bottom: 1px solid #f1f5f9;
}

.hero-grid {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 40px;
}

.hero-text { 
    flex: 1; 
}

.hero-text h1 {
    font-size: 2.8rem;
    font-weight: 800;
    line-height: 1.2;
    margin-bottom: 16px;
    letter-spacing: -1px;
    color: #0f172a;
}

.hero-text h1 span { 
    color: #00875a; 
}

.hero-text p {
    color: #64748b;
    font-size: 1.1rem;
    margin-bottom: 32px;
}

/* Tombol Ambil Antrean */
.btn-success {
    background-color: #00875a;
    color: white;
    padding: 16px 32px;
    border-radius: 14px;
    font-weight: 700;
    font-size: 1.1rem;
    display: inline-flex;
    align-items: center;
    gap: 10px;
    border: none;
    cursor: pointer;
    box-shadow: 0 10px 25px rgba(0, 135, 90, 0.2);
    transition: all 0.25s ease;
}

.btn-success:hover { 
    background-color: #006644; 
    transform: translateY(-2px);
    box-shadow: 0 12px 28px rgba(0, 135, 90, 0.3);
}

.hero-image { 
    flex: 1; 
    text-align: right; 
}

.hero-image svg { 
    max-width: 100%; 
    height: auto; 
}

/* ==========================================
   3. PILIH POLI TUJUAN (GRID CARDS)
   ========================================== */
.poli-section { 
    padding: 70px 0; scroll-behavior: smooth; 
}

.section-title { 
    font-size: 1.6rem; 
    font-weight: 800; 
    margin-bottom: 32px; 
    color: #0f172a;
    letter-spacing: -0.5px;
}

.poli-grid {
    display: grid;
    grid-template-columns: repeat(5, 1fr);
    gap: 20px;
}

.poli-card {
    background-color: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 20px;
    padding: 30px 20px;
    text-align: center;
    cursor: pointer;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.02);
}

.poli-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 12px 25px rgba(0, 0, 0, 0.06);
    border-color: #00875a;
    background-color: #fcfdfd;
}

.poli-icon { 
    font-size: 2.5rem; 
    margin-bottom: 16px; 
    display: block; 
}

.poli-card h3 { 
    font-size: 1.15rem; 
    font-weight: 700; 
    margin-bottom: 8px; 
    color: #0f172a;
}

.poli-card p { 
    font-size: 0.85rem; 
    color: #64748b; 
    line-height: 1.4; 
}

/* ==========================================
   4. RESPONSIVE BREAKPOINTS (HP & TABLET)
   ========================================== */
@media (max-width: 1200px) {
    .poli-grid { 
        grid-template-columns: repeat(3, 1fr); 
    }
}

@media (max-width: 992px) {
    .hero-grid { 
        flex-direction: column; 
        text-align: center;
        gap: 30px;
    }
    .hero-image { 
        text-align: center; 
    }
    .hero-text h1 { 
        font-size: 2.2rem; 
    }
}

@media (max-width: 640px) {
    .poli-grid { 
        grid-template-columns: repeat(1, 1fr); 
        gap: 16px;
    }
    .hero-section {
        padding: 40px 0;
    }
    .poli-section {
        padding: 40px 0;scroll-behavior: smooth; 
    }
}
/* ==========================================
   5. INFORMASI FOOTER SECTION (HALAMAN 1)
   ========================================== */
.info-section { 
    background-color: #ffffff; 
    padding: 50px 0; 
    border-top: 1px solid #e2e8f0; 
}

.info-grid { 
    display: grid; 
    grid-template-columns: repeat(3, 1fr); 
    gap: 40px; 
}

.info-item { 
    display: flex; 
    gap: 20px; 
    align-items: flex-start;
}

.info-badge { 
    font-size: 2.2rem; 
    line-height: 1;
}

.info-content h4 { 
    font-size: 1.1rem; 
    font-weight: 700; 
    margin-bottom: 8px; 
    color: #0f172a;
}

.info-content p { 
    font-size: 0.9rem; 
    color: #64748b; 
    white-space: pre-line; 
    line-height: 1.5;
}

/* ==========================================
   6. STRUK TIKET ANTREAN (HALAMAN 2)
   ========================================== */
.ticket-wrapper {
    max-width: 580px;
    margin: 40px auto;
}

/* Tombol Kembali */
.btn-back {
    background: none;
    border: none;
    color: #64748b;
    font-size: 1rem;
    font-weight: 700;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 20px;
    transition: color 0.2s ease;
}

.btn-back:hover { 
    color: #0f172a; 
}

/* Card Struk */
.ticket-card {
    background-color: #ffffff;
    border-radius: 24px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.04);
    border: 1px solid #e2e8f0;
    padding: 40px;
    text-align: center;
}

.ticket-logo {
    display: inline-flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 30px;
}

.ticket-logo .icon {
    background-color: #00875a;
    color: white;
    width: 36px;
    height: 36px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 10px;
    font-size: 1.1rem;
    font-weight: bold;
}

.ticket-logo span {
    font-weight: 800;
    letter-spacing: 0.5px;
    font-size: 1.15rem;
    color: #0f172a;
}

.ticket-title { 
    font-size: 1.15rem; 
    color: #64748b; 
    margin-bottom: 8px; 
    font-weight: 600;
}

.ticket-number {
    font-size: 4.5rem;
    font-weight: 900;
    color: #00875a;
    line-height: 1.1;
    margin-bottom: 12px;
    letter-spacing: -1px;
}

.ticket-thanks { 
    color: #64748b; 
    font-size: 0.95rem; 
    margin-bottom: 35px; 
}

/* Grid Rincian Box di Struk */
/* Container Utama Grid Atas (2 Kolom) */
.ticket-meta-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 12px;
    margin-bottom: 16px;
    width: 100%;
}

/* Container Utama Grid Bawah (Spesial Lebar Penuh & Menonjol) */
.ticket-meta-grid2 {
    display: grid;
    grid-template-columns: 1fr;
    margin-bottom: 20px;
    width: 100%;
}

/* Base Style untuk Kotak Informasi */
.meta-box {
    background-color: #f8fafc;
    border-radius: 12px;
    padding: 14px;
    text-align: left;
    display: flex;
    align-items: center;
    gap: 12px;
    border: 1px solid #e2e8f0;
    transition: all 0.2s ease;
}

/* ✨ Desain Khusus untuk Kotak Antrean Saat Ini (Grid2) */
.ticket-meta-grid2 .meta-box {
    background-color: #f0fdf4; /* Latar belakang hijau sangat muda */
    border: 2px dashed #22c55e; /* Border putus-putus hijau */
    padding: 20px; /* Lebih luas */
    justify-content: center; /* Konten di dalam kotak otomatis rata tengah */
    text-align: center;
}

/* Pengaturan Ikon */
.meta-icon { 
    font-size: 1.5rem; 
    display: flex;
    align-items: center;
}

/* Label Teks Kecil */
.meta-label { 
    font-size: 0.75rem; 
    color: #64748b; 
    font-weight: 600;
    display: block; 
    margin-bottom: 4px;
}

/* Nilai Teks Utama */
.meta-value { 
    font-size: 0.95rem; 
    font-weight: 700; 
    color: #0f172a; 
}

/* ✨ Efek Spesial Huruf Kapital Besar Hijau di Grid2 */
.ticket-meta-grid2 .meta-label {
    color: #15803d; /* Warna label hijau gelap agar terbaca */
    font-size: 0.85rem;
    letter-spacing: 0.5px;
}

.ticket-meta-grid2 .meta-value {
    font-size: 1.75rem; /* Ukuran font dibuat jauh lebih besar */
    color: #16a34a; /* Warna font hijau cerah */
    text-transform: uppercase; /* Otomatis Kapital */
    display: block;
    margin-top: 4px;
}

/* ✨ Bonus: Desain Kotak Perhatian & Tombol bawah */
.notice-box {
    background-color: #fffbeb;
    border: 1px solid #fef3c7;
    border-radius: 12px;
    padding: 16px;
    margin-top: 16px;
}

.notice-text h5 {
    color: #b45309;
    margin: 0 0 4px 0;
    font-size: 0.95rem;
    font-weight: 700;
}

.notice-text p {
    color: #78350f;
    margin: 0;
    font-size: 0.85rem;
    line-height: 1.4;
}

.btn-status-view {
    width: 100%;
    background-color: #2563eb;
    color: white;
    border: none;
    border-radius: 8px;
    padding: 12px;
    font-weight: 600;
    font-size: 0.9rem;
    margin-top: 14px;
    cursor: pointer;
    transition: background 0.2s;
}

.btn-status-view:hover {
    background-color: #1d4ed8;
}

/* Pewarnaan Khusus Box Estimasi Hijau */
.status-box {
    background-color: #f0fdf4;
    border-color: #bbf7d0;
}

.meta-label-green {
    font-size: 0.75rem;
    color: #166534;
    font-weight: 600;
    display: block;
    margin-bottom: 2px;
}

.meta-value-green {
    font-size: 0.95rem;
    font-weight: 700;
    color: #15803d;
}

/* Box Catatan Peringatan Kuning Bawah */
.notice-box {
    background-color: #fffbeb;
    border: 1px solid #fef3c7;
    border-radius: 16px;
    padding: 20px;
    text-align: left;
    margin-top: 24px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 16px;
}

.notice-text h5 { 
    font-size: 0.95rem; 
    font-weight: 700; 
    margin-bottom: 4px; 
    color: #92400e; 
}

.notice-text p { 
    font-size: 0.85rem; 
    color: #b45309; 
    line-height: 1.4;
}

.btn-status-view {
    background-color: #00875a;
    color: white;
    border: none;
    padding: 12px 18px;
    border-radius: 10px;
    font-size: 0.85rem;
    font-weight: 700;
    cursor: pointer;
    white-space: nowrap;
    transition: background-color 0.2s;
    box-shadow: 0 4px 10px rgba(0, 135, 90, 0.15);
}

.btn-status-view:hover {
    background-color: #006644;
}

/* ==========================================
   7. RESPONSIF LANJUTAN (HP / LAYAR KECIL)
   ========================================== */
@media (max-width: 768px) {
    .info-grid, .ticket-meta-grid { 
        grid-template-columns: 1fr; 
        gap: 16px;
    }
    .notice-box {
        flex-direction: column;
        text-align: center;
    }
    .notice-text {
        text-align: center;
    }
    .btn-status-view {
        width: 100%;
    }
    .ticket-card {
        padding: 24px 16px;
    }
    .ticket-number {
        font-size: 3.5rem;
    }
}
/* Gaya Pop-up Modal Tengah */
.modal-overlay {
    position: fixed;
    top: 0; left: 0; width: 100%; height: 100%;
    background: rgba(0, 0, 0, 0.6);
    display: flex; justify-content: center; align-items: center;
    z-index: 9999;
    padding: 20px;
    box-sizing: border-box;
}
.modal-content {
    background: #ffffff;
    width: 100%; max-width: 450px;
    border-radius: 12px;
    padding: 24px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.2);
    animation: popIn 0.3s ease;
}
.modal-header {
    display: flex; justify-content: space-between; align-items: center;
    margin-bottom: 20px; border-bottom: 1px solid #eee; padding-bottom: 10px;
}
.modal-header h3 { margin: 0; color: #00875a; font-size: 1.15rem; }
.close-txt { background: none; border: none; font-size: 1.5rem; cursor: pointer; color: #999; }
.form-group { margin-bottom: 15px; text-align: left; }
.form-label { display: block; font-weight: bold; margin-bottom: 6px; font-size: 0.9rem; color: #333; }
.form-input { width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 6px; box-sizing: border-box; font-size: 0.9rem; }
.radio-group { display: flex; gap: 20px; font-size: 0.9rem; padding: 5px 0; }
.btn-submit-modal { width: 100%; background: #00875a; color: white; border: none; padding: 12px; border-radius: 6px; font-weight: bold; cursor: pointer; font-size: 1rem; margin-top: 10px; }
.btn-submit-modal:hover { background: #006644; }
.d-none { display: none !important; }

@keyframes popIn {
    from { transform: scale(0.8); opacity: 0; }
    to { transform: scale(1); opacity: 1; }
}

</style>
    <!-- ==========================================
       HALAMAN 1: CONTAINER BERANDA UTAMA PASIEN
       ========================================== -->
    <div id="halaman-beranda">
        <!-- HERO BANNER SECTION -->
        <section class="hero-section">
            <div class="container">
                <div class="hero-grid">
                    <div class="hero-text">
                        <h1>Layanan Antrean<br><span>Puskesmas Sejahtera</span></h1>
                        <p>Dapatkan nomor antrean secara online lebih mudah, cepat, dan nyaman.</p>
                        
                        <!-- Tombol Ambil Antrean Cepat -->
                        <button class="btn-success" id="btn-ambil-cepat">
                            🎟️ Ambil Nomor Antrean
                        </button>
                    </div>
                    <div class="hero-image">
                        <!-- Ilustrasi Gedung Puskesmas SVG -->
                        <svg width="450" height="280" viewBox="0 0 450 280" fill="none" xmlns="http://w3.org">
                            <rect width="450" height="280" rx="16" fill="#E6F4EA"/>
                            <rect x="100" y="80" width="250" height="200" fill="#FFFFFF" rx="8"/>
                            <rect x="130" y="40" width="190" height="40" fill="#00875a" rx="4"/>
                            <path d="M225 48V72M213 60H237" stroke="white" stroke-width="4" stroke-linecap="round"/>
                            <rect x="140" y="120" width="50" height="50" fill="#E8EAED" rx="4"/>
                            <rect x="260" y="120" width="50" height="50" fill="#E8EAED" rx="4"/>
                            <rect x="205" y="200" width="40" height="80" fill="#34A853" rx="2"/>
                        </svg>
                    </div>
                </div>
            </div>
        </section>

        <!-- PILIH POLI TUJUAN SECTION -->
        <section id="poli-section" class="poli-section">
            <div class="container">
                <h2 class="section-title">Pilih Poli Tujuan</h2>
                <div class="poli-grid">
                    
                    <!-- Poli Umum -->
                    <div class="poli-card" data-poli="Poli Umum" data-nomor="{{ $nomorTerakhir['umum'] }}" data-sekarang="{{ $antreanSekarang['umum'] }}">
                        <span class="poli-icon">🏥</span>
                        <h3>Poli Umum</h3>
                        <p>Layanan kesehatan umum</p>
                    </div>

                    <!-- Poli Gigi -->
                    
                    <div class="poli-card" data-poli="Poli Gigi" data-nomor="{{ $nomorTerakhir['gigi'] }}" data-sekarang="{{ $antreanSekarang['gigi'] }}">
                        <span class="poli-icon">✨</span>
                        <h3>Poli Gigi</h3>
                        <p>Layanan kesehatan gigi dan mulut</p>
                        <!-- Menampilkan teks pendukung di bawah kartu -->
                        <small style="color: #64748b; font-weight: 600; display: block; margin-top: 8px;">
                            Dipanggil: {{ $antreanSekarang['gigi'] }}
                        </small>
                    </div>
                    <!-- KIA / KB -->
                    <div class="poli-card" data-poli="KIA / KB" data-nomor="{{ $nomorTerakhir['kia'] }}" data-sekarang=""{{ $antreanSekarang['kia'] }}"">
                        <span class="poli-icon">👶</span>
                        <h3>KIA / KB</h3>
                        <p>Kesehatan Ibu, anak dan KB</p>
                    </div>

                    <!-- Imunisasi -->
                    <div class="poli-card" data-poli="Imunisasi" data-nomor="{{ $nomorTerakhir['imun'] }}" data-sekarang="{{ $antreanSekarang['imun'] }}">
                        <span class="poli-icon">💉</span>
                        <h3>Imunisasi</h3>
                        <p>Layanan imunisasi bayi & anak</p>
                    </div>

                    <!-- Lansia -->
                    <div class="poli-card" data-poli="Lansia" data-nomor="{{ $nomorTerakhir['lansia'] }}" data-sekarang="{{ $antreanSekarang['lansia'] }}">
                        <span class="poli-icon">👴</span>
                        <h3>Lansia</h3>
                        <p>Layanan kesehatan lanjut usia</p>
                    </div>

                </div>
            </div>
        </section>

        <!-- INFORMASI FOOTER SECTION -->
        <section class="info-section">
            <div class="container">
                <div class="info-grid">
                    <div class="info-item">
                        <span class="info-badge">🕒</span>
                        <div class="info-content">
                            <h4>Jam Operasional</h4>
                            <p>Senin - Jumat&#10;07.30 - 14.00 WIB</p>
                        </div>
                    </div>
                    <div class="info-item">
                        <span class="info-badge">⚠️</span>
                        <div class="info-content">
                            <h4>Perhatian</h4>
                            <p>Harap datang 15 menit sebelum estimasi waktu</p>
                        </div>
                    </div>
                    <div class="info-item">
                        <span class="info-badge">📞</span>
                        <div class="info-content">
                            <h4>Hubungi Kami</h4>
                            <p>(0274) 1234567&#10;puskesmassidorejo@example.id</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- ==========================================
   HALAMAN 2: CONTAINER STRUK TIKET ANTREAN PASIEN
   ========================================== -->
<div id="halaman-tiket" class="container d-none">
    <div class="ticket-wrapper">
        <!-- Tombol Kembali Ke Beranda -->
        <button class="btn-back" id="btn-kembali">
            ← Kembali
        </button>

        <!-- Card Struk Tiket Utama -->
        <div class="ticket-card">
            <div class="ticket-logo">
                <div class="icon">✚</div>
                <span>PUSKESMAS SEJAHTERA</span>
            </div>
            
            <p class="ticket-title">Nomor Antrean Anda</p>
            <div class="ticket-number" id="txt-nomor-antrean">U-000</div>
            <p class="ticket-thanks">Terima kasih, nomor antrean Anda telah berhasil dibuat</p>

            <!-- ==========================================
               TAMBAHAN: DATA IDENTITAS PASIEN
               ========================================== -->
            <div class="ticket-meta-grid" style="border-bottom: 1px dashed #ccc; padding-bottom: 10px; margin-bottom: 10px;">
                <div class="meta-box">
                    <span class="meta-icon">👤</span>
                    <div>
                        <span class="meta-label">Nama Pasien</span>
                        <span class="meta-value" id="txt-nama-pasien">-</span>
                    </div>
                </div>
                <div class="meta-box">
                    <span class="meta-icon">💳</span>
                    <div>
                        <span class="meta-label">Metode Bayar</span>
                        <span class="meta-value" id="txt-penjaminan-pasien">-</span>
                    </div>
                </div>
            </div>

            <!-- Detail Info Box Grid -->
<div class="ticket-meta-grid">
    <div class="meta-box">
        <span class="meta-icon">📋</span>
        <div>
            <span class="meta-label">Poli Tujuan</span>
            <span class="meta-value" id="txt-poli-tujuan">Poli Umum</span>
        </div>
    </div>
    <div class="meta-box">
        <span class="meta-icon">🕒</span>
        <div>
            <span class="meta-label">Waktu Dibuat</span>
            <span class="meta-value" id="txt-jam-dibuat">-</span>
        </div>
    </div>
</div>

<!-- Info Antrean Berjalan & Estimasi (Sudah Dioptimalkan) -->
<div class="ticket-meta-grid2">
    <div class="meta-box">
        <div>
            <span class="meta-label">⏳ Antrean Saat Ini</span>
            <span class="meta-value" id="txt-antrean-sekarang">U-021</span>
        </div>
    </div>
</div>

<!-- Catatan Perhatian Bawah -->
<div class="notice-box">
    <div class="notice-text">
        <h5>⚠️ Perhatian</h5>
        <p>Silakan menunggu hingga nomor Anda dipanggil. Terima kasih.</p>
    </div>
    <button class="btn-status-view">👁️ Lihat Status Antrean</button>
</div>

        </div>
    </div>
</div>
<!-- ==========================================
   POP-UP FORMULIR PENDAFTARAN (MODAL DI TENGAH)
   ========================================== -->
<div id="modal-pendaftaran" class="modal-overlay d-none">
    <div class="modal-content">
        <div class="modal-header">
            <h3>📋 Formulir Antrean - Kunjungan Besok</h3>
            <button type="button" id="btn-close-modal" class="close-txt">&times;</button>
        </div>
        <form id="form-biodata-pasien">
            <!-- Hidden Input untuk menyimpan data poli sementara -->
            <input type="hidden" id="temp-poli">
            <input type="hidden" id="temp-nomor">
            <input type="hidden" id="temp-sekarang">

            <!-- Pilihan Status Pasien -->
            <div class="form-group">
                <label class="form-label">Status Pasien</label>
                <div class="radio-group">
                    <label><input type="radio" name="status_pasien" value="lama" checked id="pop-radio-lama"> Pasien Lama</label>
                    <label><input type="radio" name="status_pasien" value="baru" id="pop-radio-baru"> Pasien Baru</label>
                </div>
            </div>

            <!-- Input Identitas Dinamis -->
            <div class="form-group">
                <label id="pop-label-identitas" class="form-label" for="pop-identitas">Nomor Rekam Medis (RM)</label>
                <input type="text" id="pop-identitas" placeholder="Contoh: 01-23-45" required class="form-input">
            </div>

            <!-- Nama Pasien -->
            <div class="form-group">
                <label class="form-label" for="pop-nama">Nama Lengkap Pasien</label>
                <input type="text" id="pop-nama" placeholder="Sesuai KTP / KK" required class="form-input">
            </div>

            <!-- Metode Pembayaran -->
            <div class="form-group">
                <label class="form-label" for="pop-pembayaran">Metode Pembayaran</label>
                <select id="pop-pembayaran" required class="form-input">
                    <option value="Umum/Mandiri">Umum / Mandiri</option>
                    <option value="BPJS Kesehatan">BPJS Kesehatan</option>
                </select>
            </div>

            <!-- Tombol Konfirmasi -->
            <button type="submit" class="btn-submit-modal">🎟️ Konfirmasi & Ambil Antrean</button>
        </form>
    </div>
</div>


<script>
document.addEventListener("DOMContentLoaded", function () {
    // =========================================================================
    // 1. INISIALISASI ELEMEN UTAMA & MODAL
    // =========================================================================
    const kartuPoli = document.querySelectorAll(".poli-card");
    const tombolAmbilCepat = document.getElementById("btn-ambil-cepat");
    
    const halamanBeranda = document.getElementById("halaman-beranda");
    const halamanTiket = document.getElementById("halaman-tiket");
    const modalPendaftaran = document.getElementById("modal-pendaftaran");
    const formBiodata = document.getElementById("form-biodata-pasien");
    const btnCloseModal = document.getElementById("btn-close-modal");

    // Elemen Input Penampung Sementara di Modal
    const tempPoli = document.getElementById("temp-poli");
    const tempNomor = document.getElementById("temp-nomor");
    const tempSekarang = document.getElementById("temp-sekarang");

    // Elemen Input Interaktif di Dalam Modal
    const popRadioLama = document.getElementById("pop-radio-lama");
    const popRadioBaru = document.getElementById("pop-radio-baru");
    const popLabelIdentitas = document.getElementById("pop-label-identitas");
    const popIdentitas = document.getElementById("pop-identitas");

    // Elemen Teks Pada Struk Halaman 2
    const txtNomorAntrean = document.getElementById("txt-nomor-antrean");
    const txtPoliTujuan = document.getElementById("txt-poli-tujuan");
    const txtAntreanSekarang = document.getElementById("txt-antrean-sekarang");
    const txtJamDibuat = document.getElementById("txt-jam-dibuat");
    const txtNamaPasien = document.getElementById("txt-nama-pasien");
    const txtPenjaminanPasien = document.getElementById("txt-penjaminan-pasien");

    // Control Input Label Identitas di Dalam Modal (KTP vs RM)
    if(popRadioLama && popRadioBaru) {
        popRadioLama.addEventListener("change", function() {
            if(this.checked) {
                popLabelIdentitas.innerText = "Nomor Rekam Medis (RM)";
                popIdentitas.placeholder = "Contoh: 01-23-45";
            }
        });
        popRadioBaru.addEventListener("change", function() {
            if(this.checked) {
                popLabelIdentitas.innerText = "Nomor Induk Kependudukan (NIK KTP)";
                popIdentitas.placeholder = "Contoh: 3404XXXXXXXXXXXX";
            }
        });
    }

    // Buka Modal & Simpan Data Poli yang Dipilih
    function bukaModalPendaftaran(poli, nomor, sekarang) {
        if(tempPoli) tempPoli.value = poli;
        if(tempNomor) tempNomor.value = nomor;
        if(tempSekarang) tempSekarang.value = sekarang;
        if(modalPendaftaran) modalPendaftaran.classList.remove("d-none");
    }

    // Tutup Modal
    if (btnCloseModal) {
        btnCloseModal.addEventListener("click", () => {
            modalPendaftaran.classList.add("d-none");
            formBiodata.reset();
        });
    }

    // =========================================================================
    // 2. LOGIKA KLIK KARTU POLI & TOMBOL CEPAT
    // =========================================================================
    kartuPoli.forEach(card => {
        card.addEventListener("click", function () {
            const poli = this.getAttribute("data-poli");
            const nomor = this.getAttribute("data-nomor");
            const sekarang = this.getAttribute("data-sekarang");
            
            bukaModalPendaftaran(poli, nomor, sekarang);
        });
    });

    if (tombolAmbilCepat) {
        tombolAmbilCepat.addEventListener("click", function () {
            const targetSection = document.getElementById("poli-section");
            if (targetSection) {
                targetSection.scrollIntoView({ behavior: "smooth" });
            }
        });
    }

    // =========================================================================
    // 3. 🌟 LOGIKA SUBMIT FORM (SUDAH DIPERBAIKI AGAR MASUK DATABASE & TAMPILKAN STRUK)
    // =========================================================================
    if (formBiodata) {
        formBiodata.addEventListener("submit", function(e) {
            e.preventDefault(); // Mencegah reload agar kita bisa kirim via AJAX Fetch

            const token = document.querySelector('meta[name="csrf-token"]');
            if (!token) {
                alert("Eror: Tag <meta name='csrf-token'> belum dipasang di dalam <head> HTML Anda!");
                return;
            }

            // Ambil values input dari form untuk dikirim ke Laravel
            const statusPasien = document.querySelector('input[name="status_pasien"]:checked').value;
            const identitas = document.getElementById("pop-identitas").value;
            const namaPasien = document.getElementById("pop-nama").value;
            const metodeBayar = document.getElementById("pop-pembayaran") ? document.getElementById("pop-pembayaran").value : 'Umum';

            // Data paket yang akan dikirimkan ke AntreanController
            const formData = {
                temp_poli: tempPoli.value,
                status_pasien: statusPasien,
                identitas: identitas,
                nama_pasien: namaPasien
            };

            // Menembak route simpan pendaftaran milik Laravel Backend
            fetch("/pasien/pendaftaran/simpan", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": token.getAttribute('content')
                },
                body: JSON.stringify(formData)
            })
            .then(response => response.json())
            .then(data => {
                // JIKA CODES CONTROLLER MENYATAKAN SUKSES DI DATABASE
                if (data.success) {
                    // --- SISTEM JADWAL: HITUNG TANGGAL BESOK ---
                    const hariIni = new Date();
                    const besok = new Date(hariIni);
                    besok.setDate(hariIni.getDate() + 1);

                    const formatOpsi = { year: 'numeric', month: 'long', day: 'numeric' };
                    const tanggalBesokLokal = besok.toLocaleDateString('id-ID', formatOpsi);

                    // Menyuntikkan nomor antrean dinamis yang baru saja di-generate asli dari database
                    if (txtNomorAntrean) txtNomorAntrean.innerText = data.nomor_baru;
                    if (txtPoliTujuan) txtPoliTujuan.innerText = data.poli_baru;
                    if (txtAntreanSekarang) txtAntreanSekarang.innerText = tempSekarang.value;
                    if (txtJamDibuat) txtJamDibuat.innerText = `${tanggalBesokLokal}, Mulai 07:30 WIB`;
                    if (txtNamaPasien) txtNamaPasien.innerText = namaPasien;
                    if (txtPenjaminanPasien) txtPenjaminanPasien.innerText = metodeBayar;

                    // Sembunyikan pop-up pendaftaran dan halaman depan, tampilkan struk tiket sukses
                    if (modalPendaftaran) modalPendaftaran.classList.add("d-none");
                    if (halamanBeranda) halamanBeranda.classList.add("d-none");
                    if (halamanTiket) halamanTiket.classList.remove("d-none");

                    // Reset form agar bersih kembali
                    formBiodata.reset();
                    window.scrollTo({ top: 0, behavior: 'smooth' });
                } else {
                    alert("Gagal memproses pendaftaran antrean: " + data.message);
                }
            })
            .catch(error => {
                console.error("Error:", error);
                alert("Terjadi kegagalan koneksi sistem ke backend database klinik.");
            });
        });
    }

    // =========================================================================
    // 4. LOGIKA TOMBOL KEMBALI
    // =========================================================================
    const tombolKembali = document.getElementById("btn-kembali");
    const logoKembali = document.getElementById("nav-logo");
    const menuHome = document.getElementById("nav-home");

    function kembaliKeBeranda(e) {
        if (e) e.preventDefault();
        if (halamanTiket && halamanBeranda) {
            halamanTiket.classList.add("d-none");
            halamanBeranda.classList.remove("d-none");
            window.location.reload(); // 🌟 Fitur Tambahan: Reload halus saat klik kembali agar angka counter 'data-nomor' di beranda ter-update dinamis
        }
    }

    if (tombolKembali) tombolKembali.addEventListener("click", kembaliKeBeranda);
    if (logoKembali) logoKembali.addEventListener("click", kembaliKeBeranda);
    if (menuHome) menuHome.addEventListener("click", kembaliKeBeranda);
});

// =========================================================================
// 5. LOGIKA SCROLL SMOOTH PADA ELEMEN UTAMA (FIXED)
// =========================================================================
if (history.scrollRestoration) {
    history.scrollRestoration = 'manual';
}

window.addEventListener('beforeunload', function () {
    window.scrollTo(0, 0); 
});

window.addEventListener('load', function () {
    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });
});
</script>


@endsection