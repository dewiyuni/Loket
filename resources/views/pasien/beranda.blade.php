@extends('layouts.app')

@section('title', 'Beranda - Puskesmas Sidorejo')

@section('content')

    <h1>
        Layanan Antrean
        <br>
        <span>Puskesmas Sejahtera</span>
    </h1>

    <p>
        Dapatkan nomor antrean secara online
        lebih mudah, cepat, dan nyaman.
    </p>

    <a href="{{ url('/ambil-antrian') }}">
        Ambil Nomor Antrean
    </a>

@endsection