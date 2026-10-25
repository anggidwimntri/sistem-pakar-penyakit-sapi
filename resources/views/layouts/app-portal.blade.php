<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Dashboard  - Sistem Pakar')</title>

    <link rel="icon" href="{{ asset('images/Logo-Sapi3.png') }}" type="image/png">
    
    <!-- CSS Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

</head>
<body>
    <!-- Memanggil file Navbar yang tadi kita pisahkan -->
    @include('partials.navbar-portal')
    @include('partials.sidebar-portal')

    <!-- Konten Utama yang akan berubah-ubah tiap halaman -->
    <main class="main-content">
        @yield('content')
    </main>


    <!-- Script Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>