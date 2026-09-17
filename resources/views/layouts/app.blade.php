<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Puskesmas Sejahtera')</title>
<meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>

    {{-- NAVBAR --}}
    @include('components.navbar')


    {{-- ISI HALAMAN --}}
    @yield('content')


    {{-- FOOTER --}}
    <footer>
        © {{ date('Y') }} Puskesmas Sejahtera
    </footer>

</body>
</html>