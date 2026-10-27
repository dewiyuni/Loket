<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monitor Antrean Real-Time</title>
    <style>
        * { box-sizing: border-box; }
        
        body { 
            font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; 
            background: #f0f4f8; 
            margin: 0; 
            padding: 1.5vw; 
            color: #1e293b;
            height: 100vh;
            display: flex;
            flex-direction: column;
            overflow: hidden; /* Mengunci total layar TV agar tidak ada scrollbar */
        }

        .container { 
            display: flex;
            flex-direction: column;
            height: 100%;
            width: 100%;
        }

        /* Header Cerah Responsif */
        .header { 
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #ffffff;
            padding: 1vw 2vw; 
            border-radius: 12px; 
            margin-bottom: 1.5vw;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);
            border-left: 6px solid #059669;
            flex-shrink: 0;
            position: relative;
            min-height: 5.5vw;
        }
        .header-text {
            width: 100%;
            text-align: center;
        }
        .header-text h1 { 
            margin: 0; 
            font-size: 2.2vw; /* Responsif mengikuti lebar layar TV */
            color: #0f172a; 
            font-weight: 800;
        }
        .header-text p { 
            margin: 2px 0 0; 
            color: #64748b; 
            font-size: 1.1vw; 
            font-weight: 500;
        }
        
        .header .btn { 
            position: absolute;
            right: 2vw; /* Jarak dari sisi kanan header */
            top: 50%;
            transform: translateY(-50%); /* Membuat tombol pas di tengah secara vertikal */
            display: inline-flex; 
            align-items: center;
            justify-content: center;
            padding: 0.5vw 1vw; 
            background: #f1f5f9; 
            color: #475569; 
            text-decoration: none; 
            border-radius: 6px; 
            font-size: 1.2vw; /* Sedikit diperbesar agar ikon panah terlihat jelas */
            border: 1px solid #cbd5e1;
            z-index: 10;
        }

        /* Flexbox Horizontal: Memaksa 1 Baris Mutlak */
        .grid-poli { 
            display: flex;
            flex-direction: row; 
            gap: 1.5vw; 
            flex-grow: 1; 
            width: 100%;
            min-height: 0;
        }

        /* Kartu Poli Responsif */
        .card-poli { 
            background: #ffffff; 
            border-radius: 16px; 
            padding: 1.5vw; 
            box-shadow: 0 10px 15px -3px rgba(0,0,0,0.05);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 75%;
            flex: 1; 
            min-width: 0; 
            border: 1px solid #e2e8f0;
        }
        
        .poli-title { 
            display: flex; 
            align-items: center; 
            gap: 0.8vw; 
            border-bottom: 2px solid #f1f5f9;
            padding-bottom: 0.8vw;
            flex-shrink: 0;
        }
        .poli-title h2 { 
            margin: 0; 
            font-size: 1.6vw; /* Diperkecil agar nama poli tidak tabrakan */
            color: #0f172a; 
            font-weight: 700;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .poli-icon { font-size: 2vw; }
        
        /* Box Nomor Utama - Dibuat Lebih Proporsional */
        .box-nomor { 
            background: #d1fae5; 
            border: 2px dashed #059669; 
            border-radius: 12px; 
            padding: 1vw 0.5vw; 
            text-align: center; 
            display: flex;
            flex-direction: column;
            justify-content: center;
            flex-grow: 1; 
            margin: 1vw 0;
        }
        .box-nomor small { 
            display: block; 
            color: #065f46; 
            font-weight: 700; 
            text-transform: uppercase; 
            font-size: 0.9vw; /* Ukuran label diperkecil */
            letter-spacing: 0.1em; 
        }
        .nomor-aktif { 
            font-size: 5vw; /* Menggunakan ukuran dinamis, tidak akan merusak layout */
            font-weight: 900; 
            color: #047857; 
            font-family: 'Impact', 'Arial Black', sans-serif; 
            margin-top: 2px; 
            display: block; 
            line-height: 1;
        }
        
        /* Box Nomor Dilewati - Diperluas ke Bawah & Teks Fleksibel */
        .box-dilewati { 
            background: #ffedd5; 
            border: 1px solid #ea580c; 
            border-radius: 10px; 
            padding: 0.8vw 1vw; 
            display: flex;
            flex-direction: column; /* Mengubah susunan ke bawah agar muat banyak nomor */
            gap: 4px;
            flex-shrink: 0;
            max-height: 35%; /* Membatasi tinggi maksimum box dilewati */
            overflow-y: auto; /* Jika nomor terlewat sangat banyak, box ini bisa di-scroll internal */
        }
        .box-dilewati small { 
            font-weight: 700; 
            color: #c2410c; 
            font-size: 0.9vw;
        }
        .nomor-dilewati { 
            color: #ea580c; 
            font-weight: 800; 
            font-family: 'Courier New', Courier, monospace; 
            font-size: 1.3vw; /* Diperkecil agar menampung deretan angka (misal: A01, A05, A09) */
            letter-spacing: 1px;
            white-space: normal; /* Mengizinkan teks membungkus/turun ke bawah di dalam kotak */
            word-break: break-word; 
            line-height: 1.2;
        }
        
        .btn { 
            display: inline-block; 
            padding: 0.5vw 1vw; 
            background: #f1f5f9; 
            color: #475569; 
            text-decoration: none; 
            border-radius: 6px; 
            font-weight: 600; 
            font-size: 0.9vw;
            border: 1px solid #cbd5e1;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="header"> 
        <div class="header-text">
            <h1>📊 Monitor Status Antrean Loket</h1>
            <p>Data diperbarui secara real-time • Hari Ini: {{ \Carbon\Carbon::today()->translatedFormat('d F Y') }}</p>
        </div>
        <a href="/beranda" class="btn">🔙</a>
    </div>

    <div class="grid-poli">
        @foreach($rekapAntrean as $poli)
        <div class="card-poli">
            <div class="poli-title">
                <span class="poli-icon">{{ $poli['icon'] }}</span>
                <h2>{{ $poli['nama'] }}</h2>
            </div>
            
            <div class="box-nomor">
                <small>Antrean Sedang Dipanggil</small>
                <span class="nomor-aktif">{{ $poli['sekarang'] }}</span>
            </div>

            <!-- Box Dilewati yang lebih adaptif menampung banyak data -->
            <div class="box-dilewati">
                <small>⚠️ Dilewati:</small>
                <span class="nomor-dilewati">{{ $poli['dilewati'] ?? '-' }}</span>
            </div>
        </div>
        @endforeach
    </div>
</div>

</body>
</html>
