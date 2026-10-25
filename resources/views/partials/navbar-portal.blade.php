<!-- Top Navbar -->
<header class="top-navbar">
    <div class="d-flex align-items-center">
        <img src="{{ asset('images/Logo-Sapi3.png') }}" alt="Logo" width="45" class="me-3">
        <div>
            <h1 class="dinas-title">Sistem Pakar Diagnosa Penyakit Menular Sapi</h1>
            
            <!-- PORTAL DINAMIS BERDASARKAN ROLE -->
            @auth
                @if(Auth::user()->role === 'admin')
                    <div class="admin-portal text-danger">ADMIN PORTAL</div>
                @elseif(Auth::user()->role === 'petugas')
                    <div class="admin-portal text-primary">PORTAL PETUGAS LAPANGAN</div>
                @elseif(Auth::user()->role === 'pakar')
                    <div class="admin-portal text-success">PORTAL PAKAR</div>
                @else
                    <div class="admin-portal text-secondary">PORTAL PETERNAK</div>
                @endif
            @endauth
        </div>
    </div>
    
    <!-- Bagian Kanan Navbar (Teks, Role Badge, & Tombol Logout) -->
    <div class="d-flex align-items-center">
        @auth
            <div class="me-3 text-end">
                <span class="d-block text-dark" style="font-size: 0.9rem;">
                    Hi, <strong>{{ Auth::user()->name }}</strong>
                </span>
                <span class="badge bg-secondary text-uppercase" style="font-size: 0.7rem;">
                    {{ Auth::user()->role }}
                </span>
            </div>
        @endauth
        
        <form action="{{ route('logout') }}" method="POST" class="d-inline mb-0">
            @csrf
            <button type="submit" class="btn btn-logout px-4 py-2">Logout</button>
        </form>
    </div>
</header>