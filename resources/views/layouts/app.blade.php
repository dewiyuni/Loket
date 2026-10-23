<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Puskesmas Sejahtera')</title>
<meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<style>

    /* ==========================================
   STYLE FOOTER CERAH UNTUK LAYAR TV
   ========================================== */
.main-footer {
    background: #ffffff;
    border-radius: 16px;
    padding: 1vw 2vw 0.8vw 2vw;
    margin-top: 1.5vw;
    box-shadow: 0 -4px 6px -1px rgba(0,0,0,0.02), 0 4px 6px -1px rgba(0,0,0,0.05);
    border-bottom: 6px solid #059669; /* Senada dengan header hijau mint */
    flex-shrink: 0; /* Mencegah footer gepeng/terpotong */
}

/* Mengatur 3 info kolom berjajar ke samping */
.footer-info-grid {
    display: flex;
    flex-direction: row;
    gap: 2vw;
    justify-content: space-between;
    border-bottom: 1px solid #f1f5f9;
    padding-bottom: 0.8vw;
}

.footer-info-item {
    display: flex;
    align-items: center;
    gap: 1vw;
    flex: 1;
    background: #f8fafc;
    padding: 0.8vw 1.2vw;
    border-radius: 10px;
    border: 1px solid #e2e8f0;
}

/* Aksen khusus untuk kolom perhatian agar lebih kontras */
.footer-info-item.item-warning {
    background: #fff7ed;
    border-color: #ffedd5;
}

.footer-badge {
    font-size: 1.8vw;
    line-height: 1;
}

.footer-content h4 {
    margin: 0;
    font-size: 1.1vw;
    color: #0f172a;
    font-weight: 700;
}

.footer-content p {
    margin: 2px 0 0 0;
    font-size: 0.95vw;
    color: #475569;
    font-weight: 500;
    white-space: nowrap; /* Mencegah teks turun ke bawah agar hemat tempat */
}

/* Style Teks Hak Cipta */
.footer-copyright {
    text-align: center;
    font-size: 0.85vw;
    color: #94a3b8;
    margin-top: 0.6vw;
    font-weight: 500;
}

</style>

<body>

    {{-- NAVBAR --}}
    @include('components.navbar')


    {{-- ISI HALAMAN --}}
    @yield('content')


{{-- FOOTER MONITOR ANTREAN --}}
<footer class="main-footer">
    <!-- Grid Informasi (Jam, Perhatian, Kontak) -->
    <div class="footer-info-grid">
        <!-- Item 1: Jam Operasional -->
        <div class="footer-info-item">
            <span class="footer-badge">🕒</span>
            <div class="footer-content">
                <h4>Jam Operasional</h4>
                <p>Senin - Jumat • 07.30 - 14.00 WIB</p>
            </div>
        </div>

        <!-- Item 2: Perhatian -->
        <div class="footer-info-item item-warning">
            <span class="footer-badge">⚠️</span>
            <div class="footer-content">
                <h4>Perhatian</h4>
                <p>Harap datang 15 menit sebelum estimasi waktu</p>
            </div>
        </div>

        <!-- Item 3: Hubungi Kami -->
        <div class="footer-info-item">
            <span class="footer-badge">📞</span>
            <div class="footer-content">
                <h4>Hubungi Kami</h4>
                <p>(0274) 1234567 • puskesmasejahtera@example.id</p>
            </div>
        </div>
    </div>

    <!-- Baris Hak Cipta / Copyright Paling Bawah -->
    <div class="footer-copyright">
        © {{ date('Y') }} Puskesmas Sejahtera • Layanan Informasi Antrean Digital
    </div>
</footer>

</body>
</html>