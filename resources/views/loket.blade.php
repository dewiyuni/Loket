<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Layanan Antrean Loket</title>
   
    <!-- Memanggil File CSS Manual Anda di Folder Public -->
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        body { 
            background-color: #f4f7f6; 
            font-family: 'Inter', sans-serif;
            color: #202124;
        }
        /* Membuat kotak/card antrean menjadi putih bersih dan elegan */
        .card-antrean { 
            background-color: #ffffff;
            border-radius: 16px; 
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            padding: 30px;
            border: 1px solid #e2e8f0;
            margin-top: 20px;
        }
        /* Mengubah tombol bawaan menjadi hijau modern khas fasilitas kesehatan */
        .btn-success {
            background-color: #00875a !important;
            color: white !important;
            border: none !important;
            padding: 16px 24px !important;
            border-radius: 12px !important;
            font-weight: bold !important;
            font-size: 1.1rem !important;
            cursor: pointer;
            width: 100%;
            display: block;
            transition: background-color 0.2s;
        }
        .btn-success:hover {
            background-color: #006644 !important;
        }
    </style>
</head>
<body>
    <div class="container py-5 text-center">
        <h1 class="fw-bold text-success mb-2">Layanan Antrean Loket</h1>
        <p class="text-muted mb-5">Silakan ambil nomor antrean secara mandiri di bawah ini</p>

        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card card-antrean bg-white p-5 mb-4">
                    <h3 class="fw-semibold text-secondary mb-4">Ambil Nomor Antrean</h3>
                    <!-- Tombol cetak antrean -->
                    <button class="btn btn-success btn-lg w-100 py-3 fw-bold shadow-sm mb-3">
                        [ A ] LOKET UTAMA
                    </button>
                    <p class="text-xs text-start text-danger mt-2">*Nomor antrean akan tercetak otomatis</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
