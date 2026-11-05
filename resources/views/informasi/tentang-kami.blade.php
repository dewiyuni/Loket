<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang Kami - Puskesmas Sidorejo</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #f8fafc;
            color: #334155;
            line-height: 1.6;
        }

        .container {
            max-width: 1000px;
            margin: 0 auto;
            padding: 0 24px;
        }

        /* HEADER PAGE - HIJAU MODERN SENADA BERANDA */
        .page-header {
            background: linear-gradient(135deg, #00875a, #006644);
            color: #ffffff;
            padding: 25px 0 25px;
            margin-bottom: 20px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        .page-header h1 {
            color: #ffffff;
            font-size: 32px;
            font-weight: 800;
            margin-bottom: 8px;
            letter-spacing: -0.5px;
        }

        .page-header p {
            color: rgba(255, 255, 255, 0.9);
            font-size: 16px;
            max-width: 600px;
        }

        .btn-kembali {
            display: inline-block;
            margin-bottom: 15px;
            background: rgba(255, 255, 255, 0.2);
            color: #ffffff;
            padding: 6px 14px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 13px;
            text-decoration: none;
            transition: background 0.2s;
        }

        .btn-kembali:hover {
            background: rgba(255, 255, 255, 0.3);
            text-decoration: none;
        }

        /* CONTENT STYLES */
        .content-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 32px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
            margin-bottom: 40px;
        }

        .content-card h3 {
            color: #0f172a;
            font-size: 20px;
            margin-bottom: 16px;
            border-bottom: 2px solid #f1f5f9;
            padding-bottom: 10px;
        }

        .content-card p {
            margin-bottom: 16px;
            color: #475569;
            font-size: 15px;
            text-align: justify;
        }

        .vision-mission {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 24px;
            margin-top: 24px;
        }

        .vm-box {
            background: #f8fafc;
            padding: 20px;
            border-radius: 8px;
            border-left: 4px solid #00875a;
        }

        .vm-box h4 {
            color: #0f172a;
            margin-bottom: 10px;
            font-size: 16px;
        }

        .vm-box ul {
            padding-left: 20px;
            color: #475569;
            font-size: 14px;
        }

        .vm-box ul li {
            margin-bottom: 6px;
        }

        /* STRUKTUR ORGANISASI STYLES */
        .org-chart {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 24px;
            width: 100%;
        }

        .org-level-1 {
            display: flex;
            justify-content: center;
            margin-bottom: 0px;
            width: 100%;
        }

        .org-level-2 {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
            width: 100%;
            margin-top: 0;
        }

        .org-box {
            background: #ffffff;
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            padding: 18px 16px;
            text-align: center;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
            transition: transform 0.2s;
        }

        .org-box:hover {
            transform: translateY(-3px);
            border-color: #00875a;
        }

        .org-box.leader {
            background: #f0fdf4;
            border-color: #00875a;
            max-width: 320px;
            margin: 0 auto;
        }

        .org-box .role {
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            color: #00875a;
            margin-bottom: 4px;
        }

        .org-box .name {
            font-size: 15px;
            font-weight: 600;
            color: #0f172a;
            margin-bottom: 4px;
        }

        .org-box .nip {
            font-size: 12px;
            color: #64748b;
        }

        .line-down {
            width: 2px;
            height: 24px;
            background-color: #cbd5e1;
            margin: 0 auto;
        }
    </style>
</head>
<body>

    <!-- HEADER HALAMAN -->
    <div class="page-header">
        <div class="container">
            <a href="{{ url('/beranda') }}" class="btn-kembali">← Kembali ke Beranda</a>
            <h1>Tentang Kami</h1>
            <p>Mengenal lebih dekat profil, visi, dan komitmen pelayanan kesehatan Puskesmas Sidorejo.</p>
        </div>
    </div>

    <!-- KONTEN UTAMA -->
    <div class="container">
        <!-- CARD PROFIL & VISI MISI -->
        <div class="content-card">
            <h3>🏥 Profil Puskesmas Sidorejo</h3>
            <p>
                Puskesmas Sidorejo merupakan pusat kesehatan masyarakat yang berdedikasi untuk memberikan pelayanan kesehatan tingkat pertama yang bermutu, merata, dan terjangkau bagi seluruh masyarakat. Kami berkomitmen untuk mengutamakan keselamatan pasien serta meningkatkan derajat kesehatan masyarakat melalui upaya promotif, preventif, kuratif, dan rehabilitatif.
            </p>
            <p>
                Didukung oleh tenaga medis dan paramedis yang profesional serta fasilitas penunjang yang memadai, kami terus berinovasi dalam memberikan kemudahan layanan, salah satunya melalui sistem pendaftaran antrean online ini.
            </p>

            <div class="vision-mission">
                <!-- VISI -->
                <div class="vm-box">
                    <h4>🌟 Visi</h4>
                    <p>Menjadi pusat pelayanan kesehatan yang terdepan, mandiri, dan dipercaya masyarakat menuju kecamatan sehat.</p>
                </div>

                <!-- MISI -->
                <div class="vm-box">
                    <h4>🎯 Misi</h4>
                    <ul>
                        <li>Memberikan pelayanan kesehatan yang bermutu dan berorientasi pada kepuasan pasien.</li>
                        <li>Mendorong kemandirian masyarakat untuk hidup sehat.</li>
                        <li>Meningkatkan profesionalisme sumber daya manusia kesehatan.</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- CARD STRUKTUR ORGANISASI -->
        <div class="content-card">
            <h3>👥 Struktur Organisasi Puskesmas</h3>
            <p>Susunan pimpinan dan penanggung jawab layanan kesehatan di Puskesmas Sidorejo.</p>
            
            <div class="org-chart">
                <!-- PIMPINAN UTAMA (Kepala Puskesmas) -->
                <div class="org-level-1">
                    <div class="org-box leader">
                        <div class="role">Kepala Puskesmas</div>
                        <div class="name">dr. H. Ahmad Fauzi, M.Kes</div>
                        <div class="nip">NIP. 19800101 200604 1 003</div>
                    </div>
                </div>

                <div class="line-down"></div>

                <!-- SUSUNAN / BIDANG DI BAWAHNYA -->
                <div class="org-level-2">
                    <div class="org-box">
                        <div class="role">Kasubbag Tata Usaha</div>
                        <div class="name">Siti Aminah, S.Kep., Ns</div>
                        <div class="nip">NIP. 19850512 201001 2 005</div>
                    </div>
                    <div class="org-box">
                        <div class="role">Koordinator Pelayanan Medis</div>
                        <div class="name">dr. Dian Puspitasari</div>
                        <div class="nip">NIP. 19900315 201503 2 001</div>
                    </div>
                    <div class="org-box">
                        <div class="role">Koordinator Kesmas & P2P</div>
                        <div class="name">Budi Santoso, SKM</div>
                        <div class="nip">NIP. 19880720 201101 1 002</div>
                    </div>
                    <div class="org-box">
                        <div class="role">Penanggung Jawab Farmasi</div>
                        <div class="name">Rina Wati, Apt</div>
                        <div class="nip">NIP. 19921205 201903 2 003</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>
    </div>

    <!-- FOOTER HALAMAN -->
    <footer style="text-align: center; padding: 30px 0; margin-top: 40px; border-top: 1px solid #e2e8f0; color: #64748b; font-size: 13px;">
        <div class="container">
            <p>&copy; 2026 Puskesmas Sidorejo. Sistem Informasi Antrean Online Pasien.</p>
        </div>
    </footer>

</body>
</html>