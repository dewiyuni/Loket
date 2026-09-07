<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Layanan Antrean Puskesmas</title>
    <!-- Google Fonts untuk font yang lebih modern -->
    <link href="https://googleapis.com" rel="stylesheet">
    
    <style>
        /* ==========================================
           1. RESET & BASE STYLE
           ========================================== */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        body { 
            background: linear-gradient(135deg, #f0faf6 0%, #e8f5ee 100%); 
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: #2c3e50;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        /* ==========================================
           2. SPLASH CARD DESIGN
           ========================================== */
        .welcome-card { 
            background-color: #ffffff;
            border-radius: 24px; 
            box-shadow: 0 20px 40px rgba(0, 135, 90, 0.08);
            padding: 50px 40px;
            max-width: 480px;
            width: 100%;
            text-align: center;
            border: 1px solid rgba(226, 232, 240, 0.8);
            transition: all 0.4s ease;
        }

        /* Medis Logo Icon */
        .brand-logo {
            background-color: #e6f4ea;
            color: #00875a;
            font-size: 2.2rem;
            width: 70px;
            height: 70px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 18px;
            margin: 0 auto 25px auto;
            box-shadow: 0 8px 16px rgba(0, 135, 90, 0.15);
            animation: pulse 2s infinite;
        }

        .title-main {
            font-size: 1.8rem;
            font-weight: 800;
            color: #00875a;
            margin-bottom: 8px;
            letter-spacing: -0.5px;
        }
        .subtitle {
            font-size: 0.95rem;
            color: #64748b;
            margin-bottom: 35px;
            line-height: 1.5;
        }

        /* ==========================================
           3. INTERACTIVE BUTTON & LOADING SPIN
           ========================================== */
        .btn-enter {
            background-color: #00875a;
            color: white;
            border: none;
            padding: 16px 32px;
            border-radius: 14px;
            font-weight: 700;
            font-size: 1.1rem;
            cursor: pointer;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            box-shadow: 0 6px 20px rgba(0, 135, 90, 0.25);
            transition: all 0.3s ease;
            position: relative;
        }
        .btn-enter:hover { 
            background-color: #006644; 
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(0, 135, 90, 0.35);
        }
        .btn-enter:active {
            transform: translateY(0);
        }

        /* Animasi Lingkaran Loading */
        .spinner {
            display: none;
            width: 22px;
            height: 22px;
            border: 3px solid rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            border-top-color: white;
            animation: spin 0.8s linear infinite;
        }

        /* Keterangan Sistem di Bawah */
        .footer-note {
            margin-top: 30px;
            font-size: 0.8rem;
            color: #94a3b8;
            font-weight: 500;
        }

        /* ==========================================
           4. ANIMATION KEYFRAMES
           ========================================== */
        @keyframes spin {
            to { transform: rotate(360deg); }
        }
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }
    </style>
</head>
<body>

    <!-- CARD UTAMA SELAMAT DATANG -->
    <div class="welcome-card">
        <!-- Ikon Logo Medis Berkepak -->
        <div class="brand-logo">✚</div>
        
        <h1 class="title-main">Sistem Antrean Loket</h1>
        <p class="subtitle">Selamat datang di fasilitas layanan kesehatan digital mandiri Puskesmas Sejahtera.</p>

        <!-- Tombol Masuk Interaktif -->
        <button class="btn-enter" id="btnMasuk" onclick="prosesMasuk()">
            <span id="btnText">Masuk ke Layanan</span>
            <div class="spinner" id="loadingSpinner"></div>
        </button>

        <p class="footer-note">© 2026 Puskesmas Sejahtera. All Rights Reserved.</p>
    </div>

    <!-- ==========================================
       5. LOGIKA JAVASCRIPT LOADING DROPDOWN
       ========================================== -->
    <script>
        function prosesMasuk() {
            const btnMasuk = document.getElementById('btnMasuk');
            const btnText = document.getElementById('btnText');
            const spinner = document.getElementById('loadingSpinner');

            // 1. Kunci tombol agar tidak bisa diklik ganda selama loading
            btnMasuk.disabled = true;
            btnMasuk.style.backgroundColor = '#005236';
            btnMasuk.style.cursor = 'not-allowed';

            // 2. Ubah teks tombol dan munculkan animasi spinner
            btnText.innerText = 'Menghubungkan sistem...';
            spinner.style.display = 'block';

            // 3. Set waktu loading (3000ms = 3 detik) sebelum berpindah rute halaman
            setTimeout(function() {
                // Berpindah rute secara otomatis ke /beranda pasien
                window.location.href = "{{ url('/beranda') }}";
            }, 2000); 
        }
    </script>
</body>
</html>
