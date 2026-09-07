<!-- 1. CSS Internal Khusus Navbar Premium & Responsif -->
<style>
    /* ==========================================
       DESAIN NAVBAR PREMIUM & RESPONSIF
       ========================================== */
    .navbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        background-color: #ffffff;
        padding: 16px 8%;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03);
        position: sticky;
        top: 0;
        z-index: 1000;
        font-family: 'Plus Jakarta Sans', 'Inter', system-ui, sans-serif;
    }

    /* --- Area Logo Puskesmas --- */
    .logo-area {
        display: flex;
        align-items: center;
        gap: 14px;
        text-decoration: none;
        color: #1e293b;
        z-index: 1001; /* Tetap di atas saat menu mobile aktif */
    }

    .logo-icon {
        background-color: #00875a;
        color: white;
        font-size: 1.3rem;
        width: 42px;
        height: 42px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        box-shadow: 0 8px 16px rgba(0, 135, 90, 0.16);
        transition: transform 0.3s ease;
    }

    .logo-area:hover .logo-icon {
        transform: scale(1.05);
    }

    .logo-text {
        display: flex;
        flex-direction: column;
        line-height: 1.2;
    }

    .logo-text span {
        font-size: 0.7rem;
        letter-spacing: 1.5px;
        color: #64748b;
        font-weight: 700;
    }

    .logo-text strong {
        font-size: 1.25rem;
        color: #00875a;
        font-weight: 800;
        letter-spacing: -0.5px;
    }

    /* --- Menu Navigasi Tengah (Desktop) --- */
    .nav-menu {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .nav-menu a {
        text-decoration: none;
        color: #64748b;
        font-weight: 600;
        font-size: 0.95rem;
        padding: 10px 18px;
        border-radius: 10px;
        transition: all 0.25s ease;
        position: relative;
    }

    .nav-menu a:hover {
        color: #00875a;
        background-color: #f0fdf4;
    }

    .nav-menu a.active {
        color: #00875a;
        background-color: #e6f4ea;
    }

    /* --- Tombol Masuk Petugas --- */
    .nav-menu .btn-petugas {
        background-color: #00875a;
        color: #ffffff;
        padding: 10px 22px;
        border-radius: 10px;
        font-weight: 700;
        box-shadow: 0 4px 12px rgba(0, 135, 90, 0.2);
        margin-left: 10px;
    }

    .nav-menu .btn-petugas:hover {
        background-color: #006644;
        color: #ffffff;
        box-shadow: 0 6px 16px rgba(0, 135, 90, 0.3);
        transform: translateY(-1px);
    }

    /* --- Tombol Hamburger Menu (Hanya Muncul di HP/Tablet) --- */
    .menu-toggle {
        display: none;
        flex-direction: column;
        gap: 6px;
        background: none;
        border: none;
        cursor: pointer;
        padding: 4px;
        z-index: 1001;
    }

    .menu-toggle span {
        display: block;
        width: 26px;
        height: 3px;
        background-color: #1e293b;
        border-radius: 2px;
        transition: all 0.3s ease;
    }

    /* ==========================================
       MEDIA QUERIES (RESPONSIVE SCREEN)
       ========================================== */
    @media (max-width: 992px) {
        .navbar {
            padding: 16px 5%;
        }

        .menu-toggle {
            display: flex; /* Munculkan tombol hamburger */
        }

        /* Mengubah susunan menu menjadi dropdown melayang penuh dari atas */
        .nav-menu {
            position: absolute;
            top: -400px; /* Tersembunyi di atas layar sebelum diklik */
            left: 0;
            width: 100%;
            background-color: #ffffff;
            flex-direction: column;
            padding: 24px 5%;
            gap: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
            border-top: 1px solid #f1f5f9;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            opacity: 0;
            pointer-events: none;
        }

        /* Ketika class 'open' dipicu via JavaScript */
        .nav-menu.open {
            top: 74px; /* Turun tepat di bawah navbar */
            opacity: 1;
            pointer-events: auto;
        }

        .nav-menu a {
            width: 100%;
            text-align: center;
            padding: 14px;
        }

        .nav-menu .btn-petugas {
            margin-left: 0;
            margin-top: 8px;
            width: 100%;
        }

        /* Efek Animasi Tombol Hamburger Menjadi Tanda Silang (X) */
        .menu-toggle.active span:nth-child(1) {
            transform: translateY(9px) rotate(45deg);
        }
        .menu-toggle.active span:nth-child(2) {
            opacity: 0;
        }
        .menu-toggle.active span:nth-child(3) {
            transform: translateY(-9px) rotate(-45deg);
        }
    }
</style>

<!-- 2. Struktur HTML Navbar Baru -->
<nav class="navbar">
    <a href="{{ url('/') }}" class="logo-area">
        <div class="logo-icon">✚</div>
        <div class="logo-text">
            <span>PUSKESMAS</span>
            <strong>Sejahtera</strong>
        </div>
    </a>

    <!-- Tombol Hamburger Responsif -->
    <button class="menu-toggle" id="mobile-toggle" aria-label="Buka Menu">
        <span></span>
        <span></span>
        <span></span>
    </button>

    <div class="nav-menu" id="nav-list">
        <a href="{{ url('/') }}" class="active">Beranda</a>
        <a href="{{ url('/cek-antrian') }}">Cek Antrean</a>
        <a href="{{ url('/informasi') }}">Informasi</a>
        <a href="{{ url('/tentang-kami') }}">Tentang Kami</a>
        <a href="{{ url('/petugas/login') }}" class="btn-petugas">Masuk Petugas</a>
    </div>
</nav>

<!-- 3. JavaScript Otomatis Menu Aktif & Mobile Toggle -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        // --- 1. Logika Pendeteksi Menu Aktif Otomatis ---
        const navLinks = document.querySelectorAll(".nav-menu a");
        const currentUrl = window.location.href;

        navLinks.forEach(link => {
            if (link.href === currentUrl) {
                navLinks.forEach(item => item.classList.remove("active"));
                link.classList.add("active");
            }
        });

        // --- 2. Logika Klik Menu Hamburger Lipat ---
        const mobileToggle = document.getElementById("mobile-toggle");
        const navList = document.getElementById("nav-list");

        mobileToggle.addEventListener("click", function () {
            // Pasang / lepas class penanda animasi aktif
            this.classList.toggle("active");
            navList.classList.toggle("open");
        });
        
        // Otomatis tutup menu jika pengguna mengklik area luar menu mobile
        document.addEventListener("click", function(event) {
            if (!navList.contains(event.target) && !mobileToggle.contains(event.target)) {
                mobileToggle.classList.remove("active");
                navList.classList.remove("open");
            }
        });
    });
</script>
