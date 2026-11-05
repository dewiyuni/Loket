@extends('layouts.app')

@section('title', 'Beranda - Puskesmas Sejahtera')

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
        width: 100%; 
        max-width: 450px;
        border-radius: 12px;
        /* ✨ PERBAIKAN: Tambahkan padding dan batasi tinggi */
        padding: 24px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.2);
        animation: popIn 0.3s ease;
        
        max-height: 90vh; /* Maksimal 90% dari tinggi layar */
        overflow-y: auto; /* Bisa di-scroll jika formnya panjang */
    }

    /* ✨ PERBAIKAN: Agar scrollbar terlihat rapi di HP */
    .modal-content::-webkit-scrollbar {
        width: 6px;
    }
    .modal-content::-webkit-scrollbar-thumb {
        background-color: #cbd5e1;
        border-radius: 10px;
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


    <!-- ===============================================================================================================================================
       HALAMAN 1: CONTAINER BERANDA UTAMA PASIEN
       ================================================================================================================================================= -->
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
                    <div class="poli-card"
                        data-poli="Poli Umum"
                        data-nomor="{{ $nomorTerakhir['umum'] }}"
                        data-sekarang="{{ $antreanSekarang['umum'] }}">
                        <span class="poli-icon">🏥</span>
                        <h3>Poli Umum</h3>
                        <p>Layanan kesehatan umum</p>
                    </div>

                    <!-- Poli Gigi -->
                    
                    <div class="poli-card"
                        data-poli="Poli Gigi"
                        data-nomor="{{ $nomorTerakhir['gigi'] }}"
                        data-sekarang="{{ $antreanSekarang['gigi'] }}">
                        <span class="poli-icon">✨</span>
                        <h3>Poli Gigi</h3>
                        <p>Layanan kesehatan gigi dan mulut</p>
                        <!-- Menampilkan teks pendukung di bawah kartu -->
                    </div>
                    <!-- KIA / KB -->
                    <div class="poli-card"
                        data-poli="KIA / KB"
                        data-nomor="{{ $nomorTerakhir['kia'] }}"
                        data-sekarang="{{ $antreanSekarang['kia'] }}">                        
                        <span class="poli-icon">👶</span>
                        <h3>KIA / KB</h3>
                        <p>Kesehatan Ibu, anak dan KB</p>
                    </div>

                    <!-- Imunisasi -->
                    <div class="poli-card"
                        data-poli="Imunisasi"
                        data-nomor="{{ $nomorTerakhir['imun'] }}"
                        data-sekarang="{{ $antreanSekarang['imun'] }}">
                        <span class="poli-icon">💉</span>
                        <h3>Imunisasi</h3>
                        <p>Layanan imunisasi bayi & anak</p>
                    </div>

                    <!-- Lansia -->
                    <div class="poli-card"
                        data-poli="Lansia"
                        data-nomor="{{ $nomorTerakhir['lansia'] }}"
                        data-sekarang="{{ $antreanSekarang['lansia'] }}">
                        <span class="poli-icon">👴</span>
                        <h3>Lansia</h3>
                        <p>Layanan kesehatan lanjut usia</p>
                    </div>

                </div>
            </div>
        </section>
    </div>

 <!-- =======================================================================================================================================
            HALAMAN 2: CONTAINER STRUK TIKET ANTREAN PASIEN
     ======================================================================================================================================== -->
    <div id="halaman-tiket" class="d-none">
        <div class="container">
            <div class="ticket-wrapper" style="max-width: 600px; margin: 30px auto;">
                
                <!-- Tombol Kembali Ke Beranda -->
                <button class="btn-back" id="btn-kembali" style="margin-bottom: 15px;">
                    ← Kembali
                </button>

                <!-- Card Struk Tiket Utama -->
                <div class="ticket-card" id="ticket-to-download">
                    <div class="ticket-logo">
                        <div class="icon">✚</div>
                        <span>PUSKESMAS SEJAHTERA</span>
                    </div>
                    
                    <p class="ticket-title">Nomor Antrean Anda</p>
                    <div class="ticket-number" id="txt-nomor-antrean">U-000</div>
                    <p class="ticket-thanks">Terima kasih, nomor antrean Anda telah berhasil dibuat</p>

                    <!-- KODE BOOKING & QR CODE -->
                    <div class="booking-code-box" style="background: #f8f9fa; border: 2px dashed #0d6efd; padding: 15px; border-radius: 8px; margin: 15px 0; text-align: center;">
                        <span style="font-size: 0.85rem; color: #555; display: block; margin-bottom: 5px;">Kode Booking & QR Check-in:</span>
                        
                        <!-- Penampung QR Code -->
                        <div id="qrcode-container" style="display: flex; justify-content: center; margin-bottom: 8px;"></div>
                        
                        <!-- Teks Kode Booking -->
                        <strong id="txt-kode-booking" style="font-size: 1.2rem; letter-spacing: 2px; color: #0d6efd;">-</strong>
                    </div>

                    <!-- DATA IDENTITAS PASIEN -->
                    <div class="ticket-meta-grid" style="border-bottom: 1px dashed #ccc; padding-bottom: 10px; margin-bottom: 10px; display: flex; justify-content: space-between;">
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
                    <div class="ticket-meta-grid" style="display: flex; justify-content: space-between; margin-bottom: 10px;">
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

                    <!-- Info Antrean Berjalan & Estimasi -->
                    <div class="ticket-meta-grid2" style="margin-bottom: 15px;">
                        <div class="meta-box">
                            <div>
                                <span class="meta-label">⏳ Antrean Saat Ini</span>
                                <span class="meta-value" id="txt-antrean-sekarang">-</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="notice-box" style="background: #fff3cd; padding: 12px; border-radius: 8px; border: 1px solid #ffeeba;">
                        <div class="notice-text">
                            <h5 style="margin: 0 0 5px 0; color: #856404;">⚠️ Petunjuk Kedatangan</h5>
                            <p style="margin: 0; font-size: 0.9rem; color: #856404;">Saat tiba di Puskesmas, <strong>langsung menuju ke Ruang Tunggu Poli Tujuan</strong> dan tunjukkan/scan Kode Booking di atas. Tidak perlu mengantre lagi di loket pendaftaran.</p>
                        </div>
                    </div>

                    <!-- ✨ TOMBOL DOWNLOAD GAMBAR ✨ -->
                    <button type="button" id="btn-download-tiket" class="btn-download" style="width: 100%; margin-top: 20px; background-color: #00875a; color: white; border: none; padding: 12px; border-radius: 8px; font-weight: bold; cursor: pointer; font-size: 14px; display: flex; justify-content: center; align-items: center; gap: 8px;">
                        📥 Simpan Tiket ke Galeri
                    </button>

                    <!-- 🌟 TOMBOL BARU: SELESAI & KEMBALI -->
                    <button type="button" id="btn-selesai-tiket" style="width: 100%; margin-top: 10px; background-color: #e2e8f0; color: #475569; border: none; padding: 12px; border-radius: 8px; font-weight: bold; cursor: pointer; font-size: 14px; transition: 0.2s;">
                        ✅ Selesai & Kembali
                    </button>

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
            <input type="hidden" id="temp-poli">
            <input type="hidden" id="temp-nomor">
            <input type="hidden" id="temp-sekarang">

            <!-- Status Pasien -->
            <div class="form-group">
                <label class="form-label">Status Pasien</label>
                <div class="radio-group" style="display: flex; gap: 15px; margin-top: 5px;">
                    <label style="cursor: pointer; display: flex; align-items: center; gap: 5px;">
                        <input type="radio" name="status_pasien" value="lama" checked id="pop-radio-lama"> Pasien Lama
                    </label>
                    <label style="cursor: pointer; display: flex; align-items: center; gap: 5px;">
                        <input type="radio" name="status_pasien" value="baru" id="pop-radio-baru"> Pasien Baru
                    </label>
                </div>
            </div>

            <!-- Identitas (NIK / RM) -->
            <div class="form-group">
                <label id="pop-label-identitas" class="form-label" for="pop-identitas">NIK / Nomor Rekam Medis (RM)</label>
                <input type="text" id="pop-identitas" placeholder="Masukkan 16 Digit NIK atau No. RM" required class="form-input">
                <small id="pop-identitas-help" class="text-muted" style="font-size: 0.75rem; color: #666; display: block; margin-top: 4px;">
                    *Pasien lama dapat mengisi NIK KTP atau No. RM.
                </small>
            </div>

            <!-- Nama Pasien -->
            <div class="form-group">
                <label class="form-label" for="pop-nama">Nama Lengkap Pasien</label>
                <input type="text" id="pop-nama" placeholder="Sesuai KTP / KK" required class="form-input">
            </div>

            <!-- Tanggal Lahir -->
            <div class="form-group">
                <label class="form-label" for="pop-tanggal-lahir">Tanggal Lahir <span style="color:red">*</span></label>
                <input type="date" id="pop-tanggal-lahir" required class="form-input" max="<?= date('Y-m-d') ?>">
            </div>

            <!-- Jenis Kelamin -->
            <div class="form-group">
                <label class="form-label">Jenis Kelamin <span style="color:red">*</span></label>
                <div class="radio-group" style="display: flex; gap: 15px; margin-top: 5px;">
                    <label style="cursor: pointer; display: flex; align-items: center; gap: 5px;">
                        <input type="radio" name="jenis_kelamin" value="L" required> Laki-laki
                    </label>
                    <label style="cursor: pointer; display: flex; align-items: center; gap: 5px;">
                        <input type="radio" name="jenis_kelamin" value="P"> Perempuan
                    </label>
                </div>
            </div>

            <!-- No HP -->
            <div class="form-group">
                <label class="form-label" for="pop-no-hp">No. HP</label>
                <input type="tel" id="pop-no-hp" placeholder="08xxxxxxxxxx" class="form-input">
            </div>

            <!-- Metode Pembayaran -->
            <div class="form-group">
                <label class="form-label" for="pop-pembayaran">Metode Pembayaran</label>
                <select id="pop-pembayaran" required class="form-input">
                    <option value="Umum/Mandiri">Umum / Mandiri</option>
                    <option value="BPJS Kesehatan">BPJS Kesehatan</option>
                </select>
            </div>

            <!-- Tombol Submit -->
            <button type="submit" class="btn-submit-modal" style="margin-top: 15px; width: 100%;">🎟️ Konfirmasi & Ambil Antrean</button>
            
            <!-- Jarak aman di bawah -->
            <div style="height: 10px;"></div>
        </form>
    </div>
</div>
<!-- Load Library QR Code Terlebih Dahulu -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>

<!-- Library untuk menangkap elemen HTML jadi gambar -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/html-to-image/1.11.11/html-to-image.min.js"></script>

<script>
// Variabel Global untuk Notifikasi
let isTiketSaved = true; 
let isHalamanTiketAktif = false;

document.addEventListener("DOMContentLoaded", function () {
    // =========================================================================
    // 1. INISIALISASI ELEMEN
    // =========================================================================
    const kartuPoli = document.querySelectorAll(".poli-card");
    const tombolAmbilCepat = document.getElementById("btn-ambil-cepat");
    
    const halamanBeranda = document.getElementById("halaman-beranda");
    const halamanTiket = document.getElementById("halaman-tiket");
    const modalPendaftaran = document.getElementById("modal-pendaftaran");
    const formBiodata = document.getElementById("form-biodata-pasien");
    const btnCloseModal = document.getElementById("btn-close-modal");

    const tempPoli = document.getElementById("temp-poli");
    const tempNomor = document.getElementById("temp-nomor");
    const tempSekarang = document.getElementById("temp-sekarang");

    const popRadioLama = document.getElementById("pop-radio-lama");
    const popRadioBaru = document.getElementById("pop-radio-baru");
    const popLabelIdentitas = document.getElementById("pop-label-identitas");
    const popIdentitas = document.getElementById("pop-identitas");
    const helpIdentitas = document.getElementById("pop-identitas-help");

    const txtKodeBooking = document.getElementById("txt-kode-booking");
    const txtNomorAntrean = document.getElementById("txt-nomor-antrean");
    const txtPoliTujuan = document.getElementById("txt-poli-tujuan");
    const txtAntreanSekarang = document.getElementById("txt-antrean-sekarang");
    const txtJamDibuat = document.getElementById("txt-jam-dibuat");
    const txtNamaPasien = document.getElementById("txt-nama-pasien");
    const txtPenjaminanPasien = document.getElementById("txt-penjaminan-pasien");

    // =========================================================================
    // 2. LOGIKA MODAL & FORM
    // =========================================================================
    if (popRadioLama && popRadioBaru && popIdentitas) {
        popRadioLama.addEventListener("change", function() {
            if(this.checked) {
                if (popLabelIdentitas) popLabelIdentitas.innerText = "NIK / Nomor Rekam Medis (RM)";
                popIdentitas.placeholder = "Masukkan 16 Digit NIK atau No. RM";
                if (helpIdentitas) helpIdentitas.innerText = "*Pasien lama dapat mengisi NIK KTP atau No. RM.";
            }
        });
        popRadioBaru.addEventListener("change", function() {
            if(this.checked) {
                if (popLabelIdentitas) popLabelIdentitas.innerText = "Nomor Induk Kependudukan (NIK)";
                popIdentitas.placeholder = "Masukkan 16 Digit NIK KTP/KK";
                if (helpIdentitas) helpIdentitas.innerText = "*Pasien baru wajib menyertakan NIK KTP/KK.";
            }
        });
    }

    function bukaModalPendaftaran(poli, nomor, sekarang) {
        if(tempPoli) tempPoli.value = poli;
        if(tempNomor) tempNomor.value = nomor;
        if(tempSekarang) tempSekarang.value = sekarang;
        if(modalPendaftaran) modalPendaftaran.classList.remove("d-none");
    }

    if (btnCloseModal && modalPendaftaran && formBiodata) {
        btnCloseModal.addEventListener("click", () => {
            modalPendaftaran.classList.add("d-none");
            formBiodata.reset();
        });
    }

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
    // 3. LOGIKA SUBMIT FORM (API LARAVEL)
    // =========================================================================
    if (formBiodata) {
        formBiodata.addEventListener("submit", function(e) {
            e.preventDefault();

            const token = document.querySelector('meta[name="csrf-token"]');
            if (!token) {
                alert("Error: Tag <meta name='csrf-token'> belum dipasang di <head>!");
                return;
            }

            const statusPasienChecked = document.querySelector('input[name="status_pasien"]:checked');
            const jkChecked = document.querySelector('input[name="jenis_kelamin"]:checked');

            const formData = {
                temp_poli:       tempPoli ? tempPoli.value : '',
                status_pasien:   statusPasienChecked ? statusPasienChecked.value : 'lama',
                identitas:       popIdentitas ? popIdentitas.value.trim() : '',
                nama_pasien:     document.getElementById("pop-nama").value.trim(),
                tanggal_lahir:   document.getElementById("pop-tanggal-lahir").value,
                jenis_kelamin:   jkChecked ? jkChecked.value : '',
                no_hp:           document.getElementById("pop-no-hp").value.trim(),
                metode_pembayaran: document.getElementById("pop-pembayaran").value,
            };

            if (!/^\d{16}$/.test(formData.identitas)) {
                alert("NIK harus 16 digit angka.");
                return;
            }
            if (!formData.tanggal_lahir) {
                alert("Tanggal lahir wajib diisi.");
                return;
            }
            if (!formData.jenis_kelamin) {
                alert("Jenis kelamin wajib dipilih.");
                return;
            }

            fetch("/pasien/pendaftaran/simpan", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": token.getAttribute('content'),
                    "Accept": "application/json",
                },
                body: JSON.stringify(formData)
            })
            .then(async response => {
                const data = await response.json();
                if (!response.ok) {
                    if (data.errors) {
                        const list = Object.values(data.errors).flat().join("\n");
                        throw new Error("Validasi gagal:\n" + list);
                    }
                    throw new Error(data.message || `HTTP ${response.status}`);
                }
                return data;
            })
            .then(data => {
                if (!data.success) {
                    alert("Gagal: " + data.message);
                    return;
                }

                if (txtKodeBooking) txtKodeBooking.innerText = data.kode_booking;

                const qrContainer = document.getElementById("qrcode-container");
                if (qrContainer) {
                    qrContainer.innerHTML = "";
                    new QRCode(qrContainer, {
                        text: data.kode_booking,
                        width: 120,
                        height: 120,
                        colorDark: "#000000",
                        colorLight: "#ffffff",
                        correctLevel: QRCode.CorrectLevel.H
                    });
                }

                if (txtNomorAntrean) txtNomorAntrean.innerText = data.nomor_baru;
                if (txtPoliTujuan)   txtPoliTujuan.innerText   = data.poli_baru;
                if (txtAntreanSekarang) {
                    txtAntreanSekarang.innerText = tempSekarang ? (tempSekarang.value || "Belum dipanggil") : "Belum dipanggil";
                }
                if (txtNamaPasien)       txtNamaPasien.innerText       = formData.nama_pasien;
                if (txtPenjaminanPasien) txtPenjaminanPasien.innerText = formData.metode_pembayaran;

                const besok = new Date();
                besok.setDate(besok.getDate() + 1);
                if (txtJamDibuat) {
                    txtJamDibuat.innerText = besok.toLocaleDateString('id-ID', {
                        year: 'numeric', month: 'long', day: 'numeric'
                    }) + ", Mulai 07:30 WIB";
                }

                modalPendaftaran.classList.add("d-none");
                halamanBeranda.classList.add("d-none");
                halamanTiket.classList.remove("d-none");
                
                // ✅ TANDAI TIKET BELUM DISIMPAN (Aktifkan Notifikasi)
                isHalamanTiketAktif = true;
                isTiketSaved = false;

                formBiodata.reset();
                window.scrollTo({ top: 0, behavior: 'smooth' });
            })
            .catch(error => {
                console.error("Error:", error);
                alert(error.message);
            });
        });
    }

      // =========================================================================
    // 4. LOGIKA PEMBLOKIRAN TOMBOL KEMBALI & MENU NAVIGASI
    // =========================================================================
    function cekIzinKeluar(e) {
        // Jika sedang di halaman tiket DAN tiket belum disimpan
        if (isHalamanTiketAktif && !isTiketSaved) {
            e.preventDefault(); // Batalkan aksi pindah halaman
            alert("⚠️ Anda harus mengunduh tiket terlebih dahulu sebelum meninggalkan halaman ini!");
            return false; // Gagal keluar
        }
        return true; // Diizinkan keluar
    }

    const tombolKembali = document.getElementById("btn-kembali");
    
    // Cari semua link menu di navbar (biasanya ada di dalam tag <nav> atau <header>)
    // Kita ambil semua tag <a> yang ada di halaman
    const semuaLinkMenu = document.querySelectorAll('a'); 

    function kembaliKeBeranda(e) {
        if (e) e.preventDefault();
        
        // Cek apakah boleh keluar
        if (cekIzinKeluar(e)) {
            isTiketSaved = true; // Bypass peringatan
            if (halamanTiket && halamanBeranda) {
                halamanTiket.classList.add("d-none");
                halamanBeranda.classList.remove("d-none");
            }
        }
    }

    if (tombolKembali) tombolKembali.addEventListener("click", kembaliKeBeranda);

    // 🌟 PASANG PENGAMAN DI SEMUA MENU NAVBAR
    semuaLinkMenu.forEach(link => {
        // Kita blokir semua link <a> saat di halaman tiket
        link.addEventListener("click", function(e) {
            if (isHalamanTiketAktif && !isTiketSaved) {
                e.preventDefault(); // Jangan pindah halaman
                alert("⚠️ Anda harus mengunduh tiket terlebih dahulu sebelum membuka menu lain!");
            }
        });
    });

    // Observer deteksi halaman tiket
    const observerHalaman = new MutationObserver((mutations) => {
        mutations.forEach((mutation) => {
            if (mutation.attributeName === "class") {
                if (!halamanTiket.classList.contains("d-none")) {
                    isHalamanTiketAktif = true;
                } else {
                    isHalamanTiketAktif = false;
                }
            }
        });
    });
    if (halamanTiket) observerHalaman.observe(halamanTiket, { attributes: true });
    // =========================================================================
    // 5. LOGIKA TOMBOL DOWNLOAD GAMBAR
    // =========================================================================
    const btnDownload = document.getElementById('btn-download-tiket');
    const ticketElement = document.getElementById('ticket-to-download');
    
    if (btnDownload) {
        btnDownload.addEventListener('click', function() {
            if (!ticketElement) return;

            const originalText = btnDownload.innerHTML;
            btnDownload.innerHTML = '⏳ Sedang Memproses...';
            btnDownload.disabled = true;

            htmlToImage.toPng(ticketElement, {
                quality: 1.0,
                backgroundColor: '#ffffff',
                cacheBust: true 
            })
            .then(function (dataUrl) {
                const nomorAntrean = document.getElementById('txt-nomor-antrean').innerText || 'Antrean';
                const fileName = `Tiket_Antrean_${nomorAntrean}.png`;

                if (navigator.share) {
                    fetch(dataUrl)
                        .then(res => res.blob())
                        .then(blob => {
                            const file = new File([blob], fileName, { type: "image/png" });
                            navigator.share({
                                title: 'Tiket Antrean',
                                text: 'Simpan tiket antrean Anda.',
                                files: [file]
                            }).then(() => {
                                isTiketSaved = true; // ✅ Tandai sudah tersimpan
                                btnDownload.innerHTML = originalText;
                                btnDownload.disabled = false;
                            }).catch(err => {
                                console.log("Batal membagikan", err);
                                btnDownload.innerHTML = originalText;
                                btnDownload.disabled = false;
                            });
                        });
                } else {
                    const link = document.createElement('a');
                    link.download = fileName;
                    link.href = dataUrl;
                    link.click();

                    isTiketSaved = true; // ✅ Tandai sudah tersimpan
                    btnDownload.innerHTML = originalText;
                    btnDownload.disabled = false;
                }
            })
            .catch(function (error) {
                console.error("Gagal mengunduh gambar: ", error);
                alert("Maaf, gagal mengunduh tiket. Silakan screenshot manual.");
                btnDownload.innerHTML = originalText;
                btnDownload.disabled = false;
            });
        });
    }

    // =========================================================================
    // 6. LOGIKA TOMBOL SELESAI & KEMBALI BAWAH STRUK
    // =========================================================================
    const btnSelesai = document.getElementById('btn-selesai-tiket');
    if (btnSelesai) {
        btnSelesai.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Cek apakah boleh keluar (wajib download dulu)
            if (cekIzinKeluar(e)) {
                isTiketSaved = true; 
                document.getElementById("halaman-tiket").classList.add("d-none");
                document.getElementById("halaman-beranda").classList.remove("d-none");
                window.scrollTo({ top: 0, behavior: 'smooth' });
            }
        });
    }
});

// =========================================================================
// 7. EVENT PERINGATAN SAAT REFRESH / TUTUP TAB (BROWSER)
// =========================================================================
window.addEventListener('beforeunload', function (e) {
    if (isHalamanTiketAktif && !isTiketSaved) {
        const pesan = "Tiket antrean Anda belum disimpan! Yakin ingin keluar?";
        e.returnValue = pesan; 
        return pesan;          
    }
});

// =========================================================================
// 8. SCROLL RESTORATION
// =========================================================================
if (history.scrollRestoration) {
    history.scrollRestoration = 'manual';
}

window.addEventListener('load', function () {
    window.scrollTo({ top: 0, behavior: 'smooth' });
});
</script>
@endsection