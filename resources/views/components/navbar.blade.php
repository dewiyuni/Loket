<nav class="navbar">

    <a href="{{ url('/') }}" class="logo-area">

        <div class="logo-icon">
            ✚
        </div>

        <div class="logo-text">
            <span>PUSKESMAS</span>
            <strong>Sejahtera</strong>
        </div>

    </a>

    <div class="nav-menu">

        <a href="{{ url('/') }}" class="active">
            Beranda
        </a>

        <a href="{{ url('/cek-antrian') }}">
            Cek Antrean
        </a>

        <a href="{{ url('/informasi') }}">
            Informasi
        </a>

        <a href="{{ url('/tentang-kami') }}">
            Tentang Kami
        </a>

        <a href="{{ url('/petugas/login') }}" class="btn-petugas">
            Masuk Petugas
        </a>

    </div>

</nav>