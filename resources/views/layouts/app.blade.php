<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- @yield('title') berfungsi agar judul tab browser bisa dinamis tiap halaman -->
    <title>@yield('title', 'Sistem Pakar Sapi')</title>
    <link rel="icon" href="{{ asset('images/Logo-Sapi3.png') }}" type="image/png">
    <!-- CSS Bootstrap 5 & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    
    <!-- Letakkan External CSS kamu di sini (atau tag <style> sementara) -->
    <style>
    
    </style>
</head>
<body>

    <!-- Memanggil file Navbar yang tadi kita pisahkan -->
    @include('partials.navbar')

    <!-- Konten Utama yang akan berubah-ubah tiap halaman -->
    <main>
        @yield('content')
    </main>

    <!-- Script Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

