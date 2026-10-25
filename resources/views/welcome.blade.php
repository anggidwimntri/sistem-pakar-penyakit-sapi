@extends ('layouts.app')

@section('content')
    <!-- 1. Area Utama (Hero Section) -->
    <div class="hero-section">
        <div class="container text-white">
            
            <!-- Badge -->
            <span class="badge badge-pakar rounded-pill px-3 py-2 mb-4 fs-6">
                <i class="bi bi-check-circle-fill me-1"></i> WEB SISTEM PAKAR
            </span>

            <!-- Judul Utama -->
            <h1 class="hero-heading mb-4">
                <span class="text-light-green">Sistem Pakar</span><br>
                <span class="text-white">Diagnosa Penyakit Menular</span><br>
                <span class="text-white">Sapi</span>
            </h1>

            <!-- Sub Judul -->
            <p class="hero-subheading mb-5">
                Kabupaten Aceh Utara
            </p>

            <!-- Tombol Aksi -->
            <a href="{{ route('konsultasi.form') }}" class="btn btn-mulai btn-lg rounded-3 px-5 py-3 shadow-lg">
                Mulai Sekarang
            </a>
            
        </div>
    </div>

    <!-- 2. Section Tambahan: Latar Belakang / Tentang Sistem -->
    <section class="py-5 bg-light">
        <div class="container py-4">
            <div class="row align-items-center g-5">
                <div class="col-lg-6">
                    <h2 class="fw-bold mb-3 text-dark">Tentang Sistem Pakar Sapi</h2>
                    <p class="text-muted lh-base">
                        Website ini dikembangkan untuk membantu para peternak dan petugas kesehatan hewan di wilayah <strong>Kabupaten Aceh Utara</strong> dalam mendeteksi secara dini gejala penyakit menular pada sapi. Dengan menerapkan metode <em>Certainty Factor</em>, sistem mampu memberikan tingkat kepastian diagnosa berdasarkan analisis gejala klinis yang diinputkan.
                    </p>
                    <p class="text-muted lh-base">
                        Tujuannya adalah untuk meminimalisir risiko penyebaran wabah penyakit dan memberikan penanganan awal yang tepat bagi ternak Anda.
                    </p>
                </div>
                <div class="col-lg-6 text-center">
                    <!-- Kamu bisa selipkan ilustrasi gambar sapi atau kantor di sini -->
                    <div class="p-4 bg-white shadow-sm rounded-4 border">
                        <i class="bi bi-shield-check text-success display-3 mb-3"></i>
                        <h4 class="fw-bold text-dark">Akurat & Terpercaya</h4>
                        <p class="text-muted small mb-0">Aturan gejala divalidasi langsung oleh pakar dokter hewan berpengalaman.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 3. Section Tambahan: Kontak & Informasi Singkat -->
    <section class="py-4 bg-white border-top">
        <div class="container text-center py-3">
            <h5 class="fw-bold text-dark mb-3">Butuh Bantuan atau Konsultasi Lanjutan?</h5>
            <p class="text-muted mb-3">Silakan hubungi instansi atau dinas peternak setempat untuk penanganan klinis lebih lanjut.</p>
            <div class="d-flex justify-content-center gap-4 text-secondary">
                <span><i class="bi bi-geo-alt-fill text-success me-1"></i> Kabupaten Aceh Utara, Aceh</span>
                <span><i class="bi bi-envelope-fill text-success me-1"></i> info@sipakarsapi.com</span>
                <span><i class="bi bi-telephone-fill text-success me-1"></i> (0645) 12345</span>
            </div>
        </div>
    </section>
@endsection