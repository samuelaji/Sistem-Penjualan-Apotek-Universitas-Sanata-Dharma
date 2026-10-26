<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Apotek USD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .bg-maroon { background-color: #990000; }
        .text-maroon { color: #990000; }
        .btn-maroon { background-color: #990000; color: white; border: none; }
        .btn-maroon:hover { background-color: #7a0000; color: white; }
        .btn-outline-maroon { border-color: #990000; color: #990000; background-color: transparent; }
        .btn-outline-maroon:hover { background-color: #f8d7d7; color: #990000; border-color: #990000; }
        .box-sharp { border-radius: 0 !important; }
    </style>
</head>
<body class="bg-white d-flex flex-column m-0 p-0" style="min-height: 100vh;">

<!-- Bagian merah -->
<div class="bg-maroon text-white px-5 py-5">
    <div class="row align-items-center">
        <div class="col-md-8">
            <h1 class="fw-bold mb-3">Selamat Datang di Apotek<br>Universitas Sanata Dharma</h1>
            <p class="mb-0 fs-5">Silakan masuk untuk mengakses sistem penjualan apotek.</p>
        </div>
        <div class="col-md-4 text-center text-md-end mt-4 mt-md-0">
            <img src="{{ asset('images/logo-usd.png') }}" alt="Logo USD" style="max-height: 180px;">
        </div>
    </div>
</div>

<!-- Bagian putih bawah -->
<div class="flex-grow-1 px-5 py-5 d-flex align-items-start mt-4">
    <div class="row w-100">
        <!-- Kiri, Judul Login -->
        <div class="col-md-5 mb-4 mb-md-0">
            <h2 class="fw-bold mb-2">Login Staf Apotek</h2>
            <p class="text-muted">Masukkan kredensial Anda untuk melanjutkan.</p>
        </div>

        <!-- Kanan, Form Input -->
        <div class="col-md-7 col-lg-5">
            <form action="#" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="username" class="form-label fw-bold">Username</label>
                    <input type="text" class="form-control box-sharp py-2" id="username" name="username" placeholder="Masukkan username" required>
                    <div class="form-text">Gunakan akun staf Anda.</div>
                </div>

                <div class="mb-4">
                    <label for="password" class="form-label fw-bold">Password</label>
                    <input type="password" class="form-control box-sharp py-2" id="password" name="password" placeholder="Masukkan password" required>
                    <div class="form-text">Pastikan penulisan benar.</div>
                </div>

                <div class="d-flex gap-3 mt-5">
                    <button type="button" class="btn btn-outline-maroon box-sharp px-4 fw-bold">Lupa Password?</button>
                    <button type="submit" class="btn btn-maroon box-sharp px-5 fw-bold">Login</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
