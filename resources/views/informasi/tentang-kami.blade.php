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

        /* HEADER PAGE */
        .page-header {
            background-color: #ffffff;
            padding: 40px 0 20px;
            border-bottom: 1px solid #e2e8f0;
            margin-bottom: 30px;
        }

        .page-header h1 {
            color: #0f172a;
            font-size: 28px;
            margin-bottom: 8px;
        }

        .page-header p {
            color: #64748b;
            font-size: 16px;
        }

        .btn-kembali {
            display: inline-block;
            margin-bottom: 16px;
            color: #0284c7;
            text-navigation: none;
            font-weight: 600;
            font-size: 14px;
            text-decoration: none;
        }

        .btn-kembali:hover {
            text-decoration: underline;
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
            border-left: 4px solid #0284c7;
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
    </div>

    <!-- STRUKTUR ORGANISASI -->
        <div class="content-card" style="margin-top: 30px;">
            <h3>👥 Struktur Organisasi Puskesmas</h3>
            <p>Susunan pimpinan dan penanggung jawab layanan kesehatan di Puskesmas Sidorejo.</p>
            
            <style>
                .org-chart {
                    display: flex;
                    flex-direction: column;
                    align-items: center;
                    margin-top: 30px;
                    width: 100%;
                }

                .org-level-1 {
                    display: flex;
                    justify-content: center;
                    margin-bottom: 30px;
                    width: 100%;
                }

                .org-level-2 {
                    display: grid;
                    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
                    gap: 20px;
                    width: 100%;
                }

                .org-box {
                    background: #ffffff;
                    border: 2px solid #e2e8f0;
                    border-radius: 10px;
                    padding: 16px;
                    text-align: center;
                    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
                    transition: transform 0.2s;
                }

                .org-box:hover {
                    transform: translateY(-3px);
                    border-color: #0284c7;
                }

                .org-box.leader {
                    background: #f0f9ff;
                    border-color: #0284c7;
                    max-width: 300px;
                    margin: 0 auto;
                }

                .org-box .role {
                    font-size: 12px;
                    font-weight: 700;
                    text-transform: uppercase;
                    color: #0284c7;
                    margin-bottom: 4px;
                }

                .org-box .name {
                    font-size: 15px;
                    font-weight: 600;
                    color: #0f172a;
                    margin-bottom: 2px;
                }

                .org-box .nip {
                    font-size: 12px;
                    color: #64748b;
                }

                /* Garis Penghubung Sederhana */
                .line-down {
                    width: 2px;
                    height: 20px;
                    background-color: #cbd5e1;
                    margin: 0 auto;
                }
            </style>

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

</body>
</html>