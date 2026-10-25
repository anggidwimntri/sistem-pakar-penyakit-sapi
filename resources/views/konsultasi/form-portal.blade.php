@extends ('layouts.app-portal')
<title>@yield('title', 'Konsultasi Sistem Pakar')</title>

@section('content')

    <!-- Konten Utama -->
    <div class="container py-4">
        
        <!-- Judul Halaman -->
        <div class="text-center mb-5">
            <h1 class="page-title">Formulir Konsultasi Digital</h1>
            <p class="text-muted">Sistem Pakar Diagnosis Penyakit Sapi. Silakan lengkapi data peternakan dan<br>observasi gejala untuk memulai analisis klinis berbasis data.</p>
        </div>

        <!-- Alert Error -->
        @if(session('error'))
            <div class="alert alert-danger shadow-sm border-0 rounded-3 mb-4">
                <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ session('error') }}
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger shadow-sm border-0 rounded-3 mb-4">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Form Wrapper Putih -->
        <form action="{{ route('konsultasi.process') }}" method="POST">
        @csrf
            
            <div class="form-wrapper mb-5">
                <div class="row g-5">
                    
                    <!-- Kolom Kiri: Identitas Peternak -->
                    <div class="col-lg-5 border-end-lg">
                        <div class="mb-2">
                            <span class="section-subtitle">Identitas Peternak</span>
                            <h3 class="section-title">Data Personal</h3>
                        </div>

                        <div class="mb-4">
                            <label class="form-label text-uppercase">Nama Lengkap</label>
                            <input type="text" name="nama_peternak" class="form-control custom-input" placeholder="Contoh: Ahmad Sulaiman" required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label text-uppercase">Nomor Telepon</label>
                            <input type="text" name="nomor_telepon" class="form-control custom-input" placeholder="Contoh: 081234567890">
                        </div>

                        <div class="mb-4">
                            <label class="form-label text-uppercase">Desa / Alamat Lengkap</label>
                            <textarea name="alamat" class="form-control custom-input" rows="4" placeholder="Jl. Raya Meurah Mulia, Kec. Aceh Utara..." required></textarea>
                        </div>
                    </div>

                    <!-- Kolom Kanan: Checklist Gejala & Pencarian -->
                    <div class="col-lg-7">
                        <div class="mb-3 d-flex justify-content-between align-items-end flex-wrap gap-2">
                            <div>
                                <span class="section-subtitle">Observasi Klinis</span>
                                <h3 class="section-title mb-1">Checklist Gejala & Pilih Bobot Keyakinan</h3>
                                <p class="text-muted small mb-0">Centang gejala yang dialami sapi, lalu tentukan tingkat keyakinannya.</p>
                            </div>
                        </div>

                        <!-- Input Kotak Pencarian Gejala -->
                        <div class="mb-3">
                            <div class="input-group shadow-sm">
                                <span class="input-group-text bg-white border-end-0 text-muted"><i class="bi bi-search"></i></span>
                                <input type="text" id="searchGejala" class="form-control border-start-0 ps-0 shadow-none" placeholder="Cari nama atau kode gejala (contoh: demam)...">
                            </div>
                        </div>

                        <!-- Area Scrollable untuk Gejala dengan Garis Pembatas -->
                        <div class="pe-2 border rounded-3 p-3 bg-light-subtle" style="max-height: 450px; overflow-y: auto;" id="gejalaContainer">
                            
                            @foreach($gejalas as $g)
                            <!-- Tambahkan class item-gejala untuk fungsi pencarian -->
                            <div class="gejala-card d-flex align-items-start border-bottom py-3 item-gejala">
                                <div class="form-check d-flex align-items-start w-100">
                                    <!-- Checkbox -->
                                    <input class="form-check-input me-3 mt-1" type="checkbox" name="gejala[{{ $g->id }}]" value="1" id="gejala_{{ $g->id }}">
                                    
                                    <!-- Teks Gejala -->
                                    <div class="flex-grow-1">
                                        <label class="form-check-label w-100 cursor-pointer" for="gejala_{{ $g->id }}">
                                            <div class="gejala-title fw-semibold text-dark">{{ $g->nama_gejala }}</div>
                                            <p class="gejala-desc text-muted small mb-0">Kode Klinis: {{ $g->kode_gejala }}</p>
                                        </label>
                                    </div>
                                    
                                    <!-- Pilihan Bobot CF User -->
                                    <div class="ms-3" style="min-width: 170px;">
                                        <select name="weights[{{ $g->id }}]" class="form-select form-select-sm select-weight shadow-none border-primary-subtle">
                                            <option value="" disabled selected>-- Pilih Keyakinan --</option>
                                            <option value="0.2">Sedikit Yakin (0.2)</option>
                                            <option value="0.4">Cukup Yakin (0.4)</option>
                                            <option value="0.6">Yakin (0.6)</option>
                                            <option value="0.8">Sangat Yakin (0.8)</option>
                                            <option value="1.0">Pasti (1.0)</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            @endforeach

                        </div>
                    </div>

                </div> <!-- End Row -->
                
                <!-- Tombol Submit Berwarna & Menarik -->
                <div class="row mt-5">
                    <div class="col-12 text-end">
                        <button type="submit" class="btn btn-primary btn-lg px-5 shadow fw-bold rounded-pill text-white" style="background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%); border: none;">
                            <i class="bi bi-cpu-fill me-2"></i> Proses Diagnosis Sekarang
                        </button>
                    </div>
                </div>

            </div> <!-- End Form Wrapper -->
        </form>

    </div>

    <!-- Script JavaScript untuk Fitur Pencarian & Urutan Otomatis Ke Atas -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let searchInput = document.getElementById('searchGejala');
            let container = document.getElementById('gejalaContainer');
            
            if (searchInput && container) {
                searchInput.addEventListener('input', function() {
                    let filter = this.value.toLowerCase().trim();
                    let items = Array.from(container.querySelectorAll('.item-gejala'));

                    // Pisahkan item yang cocok dan tidak cocok
                    let matchedItems = [];
                    let unmatchedItems = [];

                    items.forEach(function(item) {
                        let text = item.innerText.toLowerCase();
                        if (filter === "" || text.includes(filter)) {
                            item.style.display = "";
                            matchedItems.push(item); // Masukkan ke daftar yang cocok
                        } else {
                            item.style.display = "none";
                            unmatchedItems.push(item); // Masukkan ke daftar yang disembunyikan
                        }
                    });

                    // Jika ada kata kunci pencarian, susun ulang urutannya agar yang cocok naik ke paling atas
                    if (filter !== "") {
                        matchedItems.forEach(function(item) {
                            container.appendChild(item); // Pindahkan ke urutan atas container
                        });
                    }
                });
            }
        });
    </script>

@endsection