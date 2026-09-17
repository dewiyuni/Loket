<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monitor Antrean Real-Time</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #f1f5f9; margin: 0; padding: 20px; color: #1e293b; }
        .container { max-width: 1200px; margin: 0 auto; }
        .header { text-align: center; margin-bottom: 30px; background: #17233b; color: white; padding: 20px; border-radius: 12px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); }
        .header h1 { margin: 0; font-size: 24px; }
        .header p { margin: 5px 0 0; color: #94a3b8; font-size: 14px; }
        
        /* Grid Layout untuk Kartu Poli */
        .grid-poli { display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 20px; }
        .card-poli { background: white; border-radius: 12px; padding: 20px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); border-top: 5px solid #2563eb; }
        
        .poli-title { display: flex; align-items: center; gap: 10px; margin-bottom: 15px; }
        .poli-title h2 { margin: 0; font-size: 20px; color: #1e293b; }
        .poli-icon { font-size: 24px; }
        
        /* Box Nomor Utama */
        .box-nomor { background: #eff6ff; border: 2px dashed #bfdbfe; border-radius: 8px; padding: 15px; text-align: center; margin-bottom: 15px; }
        .box-nomor small { display: block; color: #1e40af; font-weight: 600; text-transform: uppercase; font-size: 12px; letter-spacing: 0.05em; }
        .nomor-aktif { font-size: 36px; font-weight: 800; color: #2563eb; font-family: monospace; margin-top: 5px; display: block; }
        
        /* Box Nomor Dilewati */
        .box-dilewati { background: #fff5f5; border: 1px solid #fed7d7; border-radius: 8px; padding: 10px 15px; }
        .box-dilewati small { font-weight: 700; color: #9b1c1c; display: block; margin-bottom: 2px; }
        .nomor-dilewati { color: #c53030; font-weight: 600; font-family: monospace; font-size: 14px; word-break: break-all; }
        
        .footer-btn { text-align: center; margin-top: 30px; }
        .btn { display: inline-block; padding: 12px 24px; background: #475569; color: white; text-decoration: none; border-radius: 8px; font-weight: 600; transition: background 0.2s; }
        .btn:hover { background: #334155; }
    </style>
</head>
<body>

<div class="container">
    <div class="header">
        <h1>📊 Monitor Status Antrean Loket</h1>
        <p>Data diperbarui secara real-time • Hari Ini: {{ \Carbon\Carbon::today()->translatedFormat('d F Y') }}</p>
    </div>

    <div class="grid-poli">
        @foreach($rekapAntrean as $poli)
        <div class="card-poli">
            <div class="poli-title">
                <span class="poli-icon">{{ $poli['icon'] }}</span>
                <h2>{{ $poli['nama'] }}</h2>
            </div>
            
            <!-- Tampilan Antrean Sekarang -->
            <div class="box-nomor">
                <small>Antrean Sedang Dipanggil</small>
                <span class="nomor-aktif">{{ $poli['sekarang'] }}</span>
            </div>

            <!-- Tampilan Nomor yang Dilewati -->
            <div class="box-dilewati">
                <small>⚠️ Nomor Dilewati/Lewat:</small>
                <span class="nomor-dilewati">{{ $poli['dilewati'] }}</span>
            </div>
        </div>
        @endforeach
    </div>

    <div class="footer-btn">
        <a href="/beranda" class="btn">🔙 Kembali ke Beranda</a>
    </div>
</div>

</body>
</html>
