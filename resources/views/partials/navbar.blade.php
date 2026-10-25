<!-- Navbar Bagian Atas -->
<nav class="navbar navbar-expand-lg navbar-custom bg-white">
    <!-- PERUBAHAN 1: Ganti container-fluid menjadi container agar tidak mepet layar -->
    <div class="container"> 
        
        <!-- LOGO & TEKS (Kiri) -->
        <a class="navbar-brand d-flex align-items-center" href="#">
            <img src="/images/Logo-Sapi3.png" alt="Logo SiPakar Sapi" width="55" height="55" class="me-2">
            <div class="d-flex flex-column justify-content-center">
                <span class="dinas-title mb-0">SiPakar Sapi</span>
            </div>
        </a>

        <!-- Tombol Hamburger untuk Mobile -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            
            <!-- PERUBAHAN 2: Tambahkan class 'center-menu' untuk ditarik ke tengah via CSS -->
            <ul class="navbar-nav mx-auto mb-2 mb-lg-0 gap-lg-4 center-menu">
                <li class="nav-item">
                    <!-- Menggunakan request()->is('/') untuk mengecek path beranda -->
                    <a class="nav-link custom-nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}">
                        Beranda
                    </a>
                </li>

                <li class="nav-item">
                    <!-- Menggunakan request()->routeIs() karena Anda memakai nama route (named route) -->
                    <a class="nav-link custom-nav-link {{ request()->routeIs('konsultasi.form') ? 'active' : '' }}" href="{{ route('konsultasi.form') }}">
                        Diagnosa
                    </a>
                </li>

<li class="nav-item dropdown">
                    <a class="nav-link custom-nav-link dropdown-toggle {{ request()->is('informasi*') ? 'active' : '' }}" href="#" id="navbarDropdownInformasi" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Informasi
                    </a>
                    <ul class="dropdown-menu border-0 shadow-sm rounded-3 mt-2" aria-labelledby="navbarDropdownInformasi">
                        <li><a class="dropdown-item py-2" href="{{ route('informasi.penyakit') }}">Daftar Penyakit Menular Sapi</a></li>
                        <li><a class="dropdown-item py-2" href="{{ route('informasi.panduan') }}">Cara Penggunaan Sistem</a></li>
                    </ul>
                </li>
            </ul>
            
            <!-- Tombol Kanan -->
            <div class="ms-auto d-flex align-items-center mt-2 mt-lg-0">
                <a href="/login" class="btn btn-login rounded-pill px-4 py-2">Login Admin</a>
            </div>
        </div>
    </div>
</nav>