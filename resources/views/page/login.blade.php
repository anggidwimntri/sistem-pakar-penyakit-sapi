<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Pakar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f7f6;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            padding: 40px;
            width: 100%;
            max-width: 450px;
        }
        .btn-login {
            background-color: #1a4d2e;
            color: white;
            font-weight: 600;
        }
        .btn-login:hover {
            background-color: #133a22;
            color: white;
        }
    </style>
</head>
<body>

    <div class="login-card text-center">
        <img src="{{ asset('images/Logo-Sapi3.png') }}" alt="Logo" width="80" class="mb-1">
        <h4 class="fw-bold text-success mb-3">Login</h4>
        <p class="text-muted small mb-4">Sistem Pakar Diagnosa Penyakit Menular Sapi</p>

        {{-- TAMBAHKAN KODE INI UNTUK MUNCULKAN PESAN SUKSES --}}
        @if(session('success'))
            <div class="alert alert-success py-2 small text-start">
                <i class="bi bi-check-circle-fill me-1"></i> {{ session('success') }}
            </div>
        @endif


        @if($errors->any())
            <div class="alert alert-danger py-2 small">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="mb-3 text-start">
                <label class="form-label small fw-bold text-secondary">Alamat Email</label>
                <input type="email" name="email" class="form-control" placeholder="Contoh: admin@dinas.com" value="{{ old('email') }}" required autofocus>
            </div>
            
            <div class="mb-4 text-start">
                <label class="form-label small fw-bold text-secondary">Password</label>
                <input type="password" name="password" class="form-control" placeholder="Masukkan password" required>
            </div>
            
            <button type="submit" class="btn btn-login w-100 py-2">Masuk ke Dashboard</button>
        </form>
        
        <div class="mt-4 text-center">

    <a href="/" class="text-decoration-none text-muted small">< Kembali ke Beranda</a>
    </div>
    </div>

</body>
</html>