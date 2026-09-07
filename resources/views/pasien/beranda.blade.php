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
    padding: 70px 0; 
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
        padding: 40px 0;
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
.ticket-meta-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 16px;
    margin-bottom: 16px;
}

.meta-box {
    background-color: #f8fafc;
    border-radius: 16px;
    padding: 16px;
    text-align: left;
    display: flex;
    align-items: center;
    gap: 14px;
    border: 1px solid #e2e8f0;
}

.meta-icon { 
    font-size: 1.6rem; 
}

.meta-label { 
    font-size: 0.75rem; 
    color: #64748b; 
    font-weight: 600;
    display: block; 
    margin-bottom: 2px;
}

.meta-value { 
    font-size: 0.95rem; 
    font-weight: 700; 
    color: #0f172a; 
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
        <section class="poli-section">
            <div class="container">
                <h2 class="section-title">Pilih Poli Tujuan</h2>
                <div class="poli-grid">
                    
                    <!-- Poli Umum -->
                    <div class="poli-card" data-poli="Poli Umum" data-nomor="A-027" data-sekarang="A-021">
                        <span class="poli-icon">🩺</span>
                        <h3>Poli Umum</h3>
                        <p>Layanan kesehatan umum</p>
                    </div>

                    <!-- Poli Gigi -->
                    <div class="poli-card" data-poli="Poli Gigi" data-nomor="B-014" data-sekarang="B-009">
                        <span class="poli-icon">🦷</span>
                        <h3>Poli Gigi</h3>
                        <p>Layanan kesehatan gigi dan mulut</p>
                    </div>

                    <!-- KIA / KB -->
                    <div class="poli-card" data-poli="KIA / KB" data-nomor="C-008" data-sekarang="C-005">
                        <span class="poli-icon">🤰</span>
                        <h3>KIA / KB</h3>
                        <p>Kesehatan Ibu, anak dan KB</p>
                    </div>

                    <!-- Imunisasi -->
                    <div class="poli-card" data-poli="Imunisasi" data-nomor="D-005" data-sekarang="D-002">
                        <span class="poli-icon">💉</span>
                        <h3>Imunisasi</h3>
                        <p>Layanan imunisasi bayi & anak</p>
                    </div>

                    <!-- Lansia -->
                    <div class="poli-card" data-poli="Lansia" data-nomor="E-019" data-sekarang="E-012">
                        <span class="poli-icon">🧓</span>
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
                <div class="ticket-number" id="txt-nomor-antrean">A-000</div>
                <p class="ticket-thanks">Terima kasih, nomor antrean Anda telah berhasil dibuat</p>

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

                <!-- Info Antrean Berjalan & Estimasi -->
                <div class="ticket-meta-grid">
                    <div class="meta-box">
                        <span class="meta-icon">🩺</span>
                        <div>
                            <span class="meta-label">Antrean Saat Ini</span>
                            <span class="meta-value" id="txt-antrean-sekarang">A-021</span>
                        </div>
                    </div>
                    <div class="meta-box status-box">
                        <span class="meta-icon">⏳</span>
                        <div>
                            <span class="meta-label-green">Estimasi Waktu Tunggu</span>
                            <span class="meta-value-green">± 30 Menit</span>
                        </div>
                    </div>
                </div>

                <!-- Catatan Perhatian Bawah -->
                <div class="notice-box">
                    <div class="notice-text">
                        <h5>Perhatian</h5>
                        <p>Silakan menunggu hingga nomor Anda dipanggil. Terima kasih.</p>
                    </div>
                    <button class="btn-status-view">👁️ Lihat Status Antrean</button>
                </div>
            </div>
        </div>
    </div>
<script>
document.addEventListener("DOMContentLoaded", function () {
    // 1. Ambil semua elemen kartu poli tujuan
    const kartuPoli = document.querySelectorAll(".poli-card");
    const tombolAmbilCepat = document.getElementById("btn-ambil-cepat");

    // 2. Fungsi utama untuk memicu perpindahan ke halaman struk nomor antrean
    function cetakNomorAntrean(namaPoli, nomorBaru, antreanBerjalan) {
        // Ambil elemen teks penampung di Halaman 2 (Struk)
        const txtNomorAntrean = document.getElementById("txt-nomor-antrean");
        const txtPoliTujuan = document.getElementById("txt-poli-tujuan");
        const txtAntreanSekarang = document.getElementById("txt-antrean-sekarang");
        const txtJamDibuat = document.getElementById("txt-jam-dibuat");
        
        const halamanBeranda = document.getElementById("halaman-beranda");
        const halamanTiket = document.getElementById("halaman-tiket");

        // Set waktu dibuat secara waktu nyata (Realtime)
        const waktuSekarang = new Date();
        const formatOpsi = { year: 'numeric', month: 'long', day: 'numeric' };
        const tanggalLokal = waktuSekarang.toLocaleDateString('id-ID', formatOpsi);
        const jamMenitLokal = String(waktuSekarang.getHours()).padStart(2, '0') + ':' + String(waktuSekarang.getMinutes()).padStart(2, '0');

        // Jika element struk ditemukan di halaman, suntikkan datanya
        if (txtNomorAntrean && txtPoliTujuan) {
            txtNomorAntrean.innerText = nomorBaru;
            txtPoliTujuan.innerText = namaPoli;
            if (txtAntreanSekarang) txtAntreanSekarang.innerText = antreanBerjalan;
            if (txtJamDibuat) txtJamDibuat.innerText = `${tanggalLokal}, ${jamMenitLokal} WIB`;

            // Efek Transisi Sembunyikan Beranda & Munculkan Tiket Struk
            halamanBeranda.classList.add("d-none");
            halamanTiket.classList.remove("d-none");

            // Gulir otomatis layar ke bagian paling atas agar struk langsung terbaca penuh
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }
    }

    // 3. Pasang fungsi klik ke setiap kartu poli tujuan
    kartuPoli.forEach(card => {
        card.addEventListener("click", function () {
            // Ambil data atribut dari HTML langsung
            const poli = this.getAttribute("data-poli");
            const nomor = this.getAttribute("data-nomor");
            const sekarang = this.getAttribute("data-sekarang");
            
            cetakNomorAntrean(poli, nomor, sekarang);
        });
    });

    // 4. Pasang fungsi klik untuk tombol ambil cepat di Banner Utama (Default ke Poli Umum)
    if (tombolAmbilCepat) {
        tombolAmbilCepat.addEventListener("click", function () {
            cetakNomorAntrean("Poli Umum", "A-027", "A-021");
        });
    }

    // 5. Fungsi Klik untuk tombol kembali ke Beranda utama dari struk
    const tombolKembali = document.getElementById("btn-kembali");
    const logoKembali = document.getElementById("nav-logo");
    const menuHome = document.getElementById("nav-home");

    function kembaliKeBeranda(e) {
        if(e) e.preventDefault();
        const halamanBeranda = document.getElementById("halaman-beranda");
        const halamanTiket = document.getElementById("halaman-tiket");
        
        if(halamanTiket && halamanBeranda) {
            halamanTiket.classList.add("d-none");
            halamanBeranda.classList.remove("d-none");
        }
    }

    if (tombolKembali) tombolKembali.addEventListener("click", kembaliKeBeranda);
    if (logoKembali) logoKembali.addEventListener("click", kembaliKeBeranda);
    if (menuHome) menuHome.addEventListener("click", kembaliKeBeranda);
});
document.addEventListener("DOMContentLoaded", function () {
    // =========================================================================
    // 1. INISIALISASI ELEMEN UTAMA
    // =========================================================================
    const kartuPoli = document.querySelectorAll(".poli-card");
    const tombolAmbilCepat = document.getElementById("btn-ambil-cepat");
    
    const halamanBeranda = document.getElementById("halaman-beranda");
    const halamanTiket = document.getElementById("halaman-tiket");

    const txtNomorAntrean = document.getElementById("txt-nomor-antrean");
    const txtPoliTujuan = document.getElementById("txt-poli-tujuan");
    const txtAntreanSekarang = document.getElementById("txt-antrean-sekarang");
    const txtJamDibuat = document.getElementById("txt-jam-dibuat");

    // =========================================================================
    // 2. FUNGSI UTAMA: GENERATE & CETAK NOMOR ANTREAN (PINDAH KE HALAMAN 2)
    // =========================================================================
    function cetakNomorAntrean(namaPoli, nomorBaru, antreanBerjalan) {
        if (!halamanBeranda || !halamanTiket) return;

        // Mendapatkan waktu cetak secara real-time berdasarkan waktu lokal komputer
        const waktuSekarang = new Date();
        const formatOpsi = { year: 'numeric', month: 'long', day: 'numeric' };
        const tanggalLokal = waktuSekarang.toLocaleDateString('id-ID', formatOpsi);
        
        // Memastikan menit selalu dua digit (contoh: 09:05, bukan 09:5)
        const jam = String(waktuSekarang.getHours()).padStart(2, '0');
        const menit = String(waktuSekarang.getMinutes()).padStart(2, '0');

        // Menyuntikkan data teks ke dalam elemen struk tiket
        if (txtNomorAntrean) txtNomorAntrean.innerText = nomorBaru;
        if (txtPoliTujuan) txtPoliTujuan.innerText = namaPoli;
        if (txtAntreanSekarang) txtAntreanSekarang.innerText = antreanBerjalan;
        if (txtJamDibuat) txtJamDibuat.innerText = `${tanggalLokal}, ${jam}:${menit} WIB`;

        // Proses transisi menyembunyikan halaman utama dan memunculkan struk
        halamanBeranda.classList.add("d-none");
        halamanTiket.classList.remove("d-none");

        // Otomatis gulir layar kembali ke paling atas agar struk tidak terpotong visualnya
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    // =========================================================================
    // 3. EVENT LISTENERS: PEMICU KLIK KARTU POLI & TOMBOL CEPAT
    // =========================================================================
    
    // Klik pada 5 Kartu Poli Tujuan
    kartuPoli.forEach(card => {
        card.addEventListener("click", function () {
            // Mengambil nilai data-attribute langsung dari struktur HTML
            const poli = this.getAttribute("data-poli");
            const nomor = this.getAttribute("data-nomor");
            const sekarang = this.getAttribute("data-sekarang");
            
            cetakNomorAntrean(poli, nomor, sekarang);
        });
    });

    // Klik pada Tombol Utama "Ambil Nomor Antrean" di Banner Atas (Default ke Poli Umum)
    if (tombolAmbilCepat) {
        tombolAmbilCepat.addEventListener("click", function () {
            cetakNomorAntrean("Poli Umum", "A-027", "A-021");
        });
    }

    // =========================================================================
    // 4. LOGIKA TOMBOL KEMBALI (DARI STRUK KE BERANDA)
    // =========================================================================
    const tombolKembali = document.getElementById("btn-kembali");
    const logoKembali = document.getElementById("nav-logo");
    const menuHome = document.getElementById("nav-home");

    function kembaliKeBeranda(e) {
        if (e) e.preventDefault();
        
        if (halamanTiket && halamanBeranda) {
            halamanTiket.classList.add("d-none");
            halamanBeranda.classList.remove("d-none");
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }
    }

    // Daftarkan aksi kembali jika elemen-elemen navigasi diklik
    if (tombolKembali) tombolKembali.addEventListener("click", kembaliKeBeranda);
    if (logoKembali) logoKembali.addEventListener("click", kembaliKeBeranda);
    if (menuHome) menuHome.addEventListener("click", kembaliKeBeranda);

    console.log("Sistem Antrean JS Berhasil Dimuat Terpisah!");
});

</script>
@endsection