<!-- Sidebar -->
<aside class="sidebar">
    <a href="{{ route('profile.edit') }}" class="text-decoration-none">
        <div class="user-profile-box d-flex align-items-center p-2 p-md-3 rounded-3 mb-3 bg-light">
            <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name ?? 'User') }}&background=2b5329&color=fff" alt="Profile" class="rounded-circle me-0 me-md-3" width="40" height="40">
            <!-- Teks disembunyikan di layar HP (< 768px), muncul di layar medium ke atas -->
            <div class="d-none d-md-block overflow-hidden">
                <p class="user-name fw-bold text-dark mb-0 text-truncate" style="font-size: 14px;">{{ Auth::user()->name ?? 'Pengguna' }}</p>
                <p class="user-role text-capitalize text-muted mb-0" style="font-size: 12px;">{{ Auth::user()->role ?? 'User' }}</p>
            </div>
        </div>
    </a>

    <!-- Navigation Berdasarkan Role -->
    <nav class="nav flex-column nav-sidebar">

        <!-- MENU KHUSUS ADMIN -->
        @if(Auth::user()->role === 'admin')
            <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                <i class="bi bi-grid-fill"></i> <span>Dashboard</span>
            </a>
            <a class="nav-link {{ request()->routeIs('admin.riwayat.index') ? 'active' : '' }}" href="{{ route('admin.riwayat.index') }}">
                <i class="bi bi-activity"></i> <span>Data Diagnosa</span>
            </a>
            <a class="nav-link {{ request()->routeIs('admin.penyakit*') ? 'active' : '' }}" href="{{ route('admin.penyakit.index') }}">
                <i class="bi bi-virus"></i> <span>Data Penyakit</span>
            </a>
            <a class="nav-link {{ request()->routeIs('admin.gejala*') ? 'active' : '' }}" href="{{ route('admin.gejala.index') }}">
                <i class="bi bi-clipboard2-pulse"></i> <span>Data Gejala</span>
            </a>
            <a class="nav-link {{ request()->routeIs('admin.pengetahuan*') ? 'active' : '' }}" href="{{ route('admin.pengetahuan.index') }}">
                <i class="bi bi-diagram-3"></i> <span>Pengetahuan</span>
            </a>
            <a class="nav-link {{ request()->routeIs('admin.artikel*') ? 'active' : '' }}" href="{{ route('admin.artikel.index') }}">
                <i class="bi bi-journal-text"></i> <span>Artikel</span>
            </a>
            <a class="nav-link {{ request()->routeIs('admin.users*') ? 'active' : '' }}" href="{{ route('admin.users.index') }}">
                <i class="bi bi-people"></i> <span>Kelola Pengguna</span>
            </a>
        @endif

        <!-- MENU KHUSUS PAKAR -->
        @if(Auth::user()->role === 'pakar')
            <a class="nav-link {{ request()->routeIs('pakar.dashboard') ? 'active' : '' }}" href="{{ route('pakar.dashboard') }}">
                <i class="bi bi-grid-fill"></i> <span>Dashboard</span>
            </a>
            <a class="nav-link {{ request()->routeIs('pakar.penyakit*') ? 'active' : '' }}" href="{{ route('pakar.penyakit.index') }}">
                <i class="bi bi-virus"></i> <span>Data Penyakit</span>
            </a>
            <a class="nav-link {{ request()->routeIs('pakar.gejala*') ? 'active' : '' }}" href="{{ route('pakar.gejala.index') }}">
                <i class="bi bi-clipboard2-pulse"></i> <span>Data Gejala</span>
            </a>
            <a class="nav-link {{ request()->routeIs('pakar.pengetahuan*') ? 'active' : '' }}" href="{{ route('pakar.pengetahuan.index') }}">
                <i class="bi bi-diagram-3"></i> <span>Basis Pengetahuan</span>
            </a>
        @endif

        <!-- MENU KHUSUS PETUGAS -->
        @if(Auth::user()->role === 'petugas')
            <a class="nav-link {{ request()->routeIs('petugas.dashboard') ? 'active' : '' }}" href="{{ route('petugas.dashboard') }}">
                <i class="bi bi-grid-fill"></i> <span>Dashboard</span>
            </a>
            <a class="nav-link {{ request()->routeIs('petugas.konsultasi*') ? 'active' : '' }}" href="{{ route('petugas.konsultasi') }}">
                <i class="bi bi-hospital"></i> <span>Mulai Diagnosa</span>
            </a>
            <a class="nav-link {{ request()->routeIs('petugas.riwayat*') ? 'active' : '' }}" href="{{ route('petugas.riwayat') }}">
                <i class="bi bi-clock-history"></i> <span>Riwayat Cek</span>
            </a>
            <a class="nav-link {{ request()->routeIs('petugas.referensi*') ? 'active' : '' }}" href="{{ route('petugas.referensi') }}">
                <i class="bi bi-journal-medical"></i> <span>Data Gejala & Penyakit</span>
            </a>
        @endif

        <!-- MENU KHUSUS USER / PETERNAK -->
        @if(Auth::user()->role === 'user')
            <a class="nav-link {{ request()->routeIs('user.dashboard') ? 'active' : '' }}" href="{{ route('user.dashboard') }}">
                <i class="bi bi-grid-fill"></i> <span>Beranda</span>
            </a>
            <a class="nav-link {{ request()->routeIs('user.konsultasi') ? 'active' : '' }}" href="{{ route('user.konsultasi') }}">
                <i class="bi bi-hospital"></i> <span>Mulai Konsultasi</span>
            </a>
            <a class="nav-link {{ request()->routeIs('riwayat.saya') ? 'active' : '' }}" href="{{ route('riwayat.saya') }}">
                <i class="bi bi-journal-medical"></i> <span>Hasil Diagnosa</span>
            </a>
            <a class="nav-link {{ request()->routeIs('user.informasi') ? 'active' : '' }}" href="{{ route('user.informasi') }}">
                <i class="bi bi-book-half"></i> <span>Informasi Penyakit</span>
            </a>
        @endif

    </nav>
</aside>