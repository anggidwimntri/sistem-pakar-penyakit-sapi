<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun - Sistem Pakar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        body {
            background-color: #f4f7f6;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px 0;
        }
        .register-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            padding: 40px;
            width: 100%;
            max-width: 450px;
        }
        .btn-register {
            background-color: #1a4d2e;
            color: white;
            font-weight: 600;
        }
        .btn-register:hover {
            background-color: #133a22;
            color: white;
        }
    </style>
</head>
<body>

    <div class="register-card text-center">
        <!-- Logo -->
        <img src="{{ asset('images/Logo-Sapi3.png') }}" alt="Logo" width="65" class="mb-2">
        
        <h4 class="fw-bold text-success mb-1">Daftar Akun</h4>
        <p class="text-muted small mb-3">Buat akun baru untuk konsultasi Sapi</p>

        <!-- Pesan Error Validasi -->
        @if($errors->any())
            <div class="alert alert-danger py-2 small text-start">
                <ul class="mb-0 ps-3">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('register') }}" method="POST" class="text-start">
            @csrf
            
            <div class="mb-3">
                <label class="form-label small fw-bold text-secondary">Nama Lengkap</label>
                <input type="text" name="name" class="form-control" placeholder="Contoh: Budi Santoso" value="{{ old('name') }}" required autofocus>
            </div>

            <div class="mb-3">
                <label class="form-label small fw-bold text-secondary">Alamat Email</label>
                <input type="email" name="email" class="form-control" placeholder="Contoh: budi@gmail.com" value="{{ old('email') }}" required>
            </div>
            
            <div class="mb-3">
                <label class="form-label small fw-bold text-secondary">Password</label>
                <input type="password" name="password" class="form-control" placeholder="Minimal 6 karakter" required>
            </div>

            <div class="mb-4">
                <label class="form-label small fw-bold text-secondary">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" class="form-control" placeholder="Ulangi password" required>
            </div>
            
            <button type="submit" class="btn btn-register w-100 py-2">Daftar Sekarang</button>
        </form>
        
        <div class="mt-4 text-center">
            <p class="small text-muted mb-1">Sudah punya akun? 
                <a href="{{ route('login') }}" class="text-decoration-none text-success fw-bold">Login di sini</a>
            </p>
            <a href="/" class="text-decoration-none text-muted small">< Kembali ke Beranda</a>
        </div>
    </div>

</body>
</html>