@extends('layouts.app')

@section('content')
    <div class="py-5 bg-light border-bottom">
        <div class="container text-center">
            <h1 class="fw-bold text-dark">Panduan Penggunaan Sistem</h1>
            <p class="text-muted mb-0">Ikuti langkah-langkah mudah berikut untuk melakukan diagnosa penyakit pada sapi Anda.</p>
        </div>
    </div>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                
                <!-- Langkah 1 -->
                <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                    <div class="d-flex align-items-start">
                        <div class="bg-success text-white fw-bold rounded-circle d-flex align-items-center justify-content-center me-4 flex-shrink-0" style="width: 50px; height: 50px; font-size: 1.25rem;">
                            1
                        </div>
                        <div>
                            <h4 class="fw-bold text-dark mb-2">Buka Menu Diagnosa</h4>
                            <p class="text-muted mb-0">
                                Klik tombol <strong>"Diagnosa"</strong> pada menu navigasi bagian atas atau tombol "Mulai Sekarang" di halaman beranda untuk masuk ke halaman konsultasi awal.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Langkah 2 -->
                <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                    <div class="d-flex align-items-start">
                        <div class="bg-success text-white fw-bold rounded-circle d-flex align-items-center justify-content-center me-4 flex-shrink-0" style="width: 50px; height: 50px; font-size: 1.25rem;">
                            2
                        </div>
                        <div>
                            <h4 class="fw-bold text-dark mb-2">Pilih Gejala yang Dialami Sapi</h4>
                            <p class="text-muted mb-0">
                                Centang atau pilih gejala-gejala klinis yang sedang dirasakan atau terlihat pada fisik sapi Anda (misalnya: demam tinggi, nafsu makan turun, atau luka pada kuku).
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Langkah 3 -->
                <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                    <div class="d-flex align-items-start">
                        <div class="bg-success text-white fw-bold rounded-circle d-flex align-items-center justify-content-center me-4 flex-shrink-0" style="width: 50px; height: 50px; font-size: 1.25rem;">
                            3
                        </div>
                        <div>
                            <h4 class="fw-bold text-dark mb-2">Proses Perhitungan Sistem</h4>
                            <p class="text-muted mb-0">
                                Setelah semua gejala dipilih, sistem akan memproses data menggunakan metode <em>Certainty Factor (CF)</em> berdasarkan aturan bobot yang telah divalidasi oleh pakar dokter hewan.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Langkah 4 -->
                <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                    <div class="d-flex align-items-start">
                        <div class="bg-success text-white fw-bold rounded-circle d-flex align-items-center justify-content-center me-4 flex-shrink-0" style="width: 50px; height: 50px; font-size: 1.25rem;">
                            4
                        </div>
                        <div>
                            <h4 class="fw-bold text-dark mb-2">Lihat Hasil Diagnosa & Solusi</h4>
                            <p class="text-muted mb-0">
                                Anda akan langsung melihat hasil akhir berupa jenis penyakit terdeteksi, persentase tingkat keyakinan (tingkat akurasi), beserta saran penanganan awal yang harus dilakukan.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Tombol Aksi Cepat Bawah -->
                <div class="text-center mt-5">
                    <a href="{{ route('konsultasi.form') }}" class="btn btn-success btn-lg rounded-pill px-5 py-3 shadow-sm">
                        Mulai Konsultasi Sekarang <i class="bi bi-arrow-right ms-2"></i>
                    </a>
                </div>

            </div>
        </div>
    </div>
@endsection