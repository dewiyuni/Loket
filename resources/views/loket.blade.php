<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Layanan Antrean Loket</title>
    <!-- Menggunakan Bootstrap CDN agar tampilan langsung rapi dan modern -->
    <link href="https://jsdelivr.net" rel="stylesheet">
    <style>
        body { background-color: #f4f7f6; font-family: 'Segoe UI', sans-serif; }
        .card-antrean { border-radius: 15px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); }
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
