<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - Sistem Penjualan Apotek Sanata Dharma</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        * { box-sizing: border-box; }
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f1f5f9;
            min-height: 100vh;
            overflow-x: hidden;
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-up {
            animation: fadeInUp 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }

        .brand-section {
            background-color: #630000;
            position: relative;
            overflow: hidden;
            z-index: 1;
        }
        .pattern-overlay {
            position: absolute;
            inset: 0;
            background-image: radial-gradient(rgba(255, 255, 255, 0.06) 2px, transparent 2px);
            background-size: 32px 32px;
            z-index: -1;
        }
        .orb {
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
            z-index: -2;
            animation: floatOrb 20s infinite alternate ease-in-out;
        }
        .orb-1 { width: 500px; height: 500px; background: #9d0208; top: -10%; left: -10%; }
        .orb-2 { width: 400px; height: 400px; background: #370617; bottom: -10%; right: -10%; animation-delay: -5s; }
        .orb-3 { width: 300px; height: 300px; background: #ff4d4d; top: 40%; left: 50%; opacity: 0.15; animation-duration: 25s; }

        @keyframes floatOrb {
            0% { transform: translate(0, 0) scale(1); }
            100% { transform: translate(40px, -40px) scale(1.1); }
        }

        .login-wrapper {
            background: linear-gradient(135deg, #f8fafc 0%, #fff0f2 100%);
            position: relative;
            overflow: hidden;
        }

        .login-wrapper::before {
            content: "";
            position: absolute;
            top: -20%; right: -20%;
            width: 400px; height: 400px;
            background: radial-gradient(circle, rgba(139, 0, 0, 0.04) 0%, transparent 70%);
            border-radius: 50%;
            pointer-events: none;
        }
        .login-card {
            width: 100%;
            max-width: 440px;
            background: #ffffff;
            border-radius: 24px;
            padding: 3rem 2.5rem;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.04);
            border: 1px solid rgba(0,0,0,0.02);
        }

        .custom-input-group {
            border: 1.5px solid #e2e8f0;
            border-radius: 12px;
            transition: all 0.2s ease-in-out;
            background-color: #fff;
            display: flex;
            align-items: center;
        }
        .custom-input-group:focus-within {
            border-color: #8B0000;
            box-shadow: 0 0 0 4px rgba(139, 0, 0, 0.08);
        }
        .custom-input-group .input-group-text {
            background-color: transparent;
            border: none;
            color: #94a3b8;
            padding-right: 0;
            padding-left: 1rem;
        }
        .custom-input-group .form-control {
            border: none;
            box-shadow: none;
            background: transparent;
            padding: 0.8rem 1rem;
            font-size: 0.95rem;
        }

        .btn-maroon {
            background-color: #8B0000;
            border-color: #8B0000;
            color: #ffffff;
            font-weight: 600;
            padding: 0.85rem 1.5rem;
            border-radius: 12px;
            transition: all 0.25s ease-in-out;
        }
        .btn-maroon:hover {
            background-color: #700000;
            border-color: #700000;
            color: #ffffff;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(139, 0, 0, 0.25);
        }
        .btn-maroon:active {
            transform: translateY(0);
        }
    </style>
</head>
<body>

<div class="container-fluid p-0">
    <div class="row g-0 min-vh-100">

        <div class="col-lg-6 d-none d-lg-flex brand-section flex-column justify-content-between p-5 text-white">

            <div class="pattern-overlay"></div>
            <div class="orb orb-1"></div>
            <div class="orb orb-2"></div>
            <div class="orb orb-3"></div>

            <div class="d-flex align-items-center gap-3 animate-fade-up" style="animation-delay: 0.1s; z-index: 10;">
                <img src="{{ asset('images/logo-usd.png') }}" alt="Logo USD" style="height: 54px; width: auto; object-fit: contain;" onerror="this.style.display='none'">
                <div>
                    <h5 class="fw-bold mb-0 tracking-wide text-white">UNIVERSITAS SANATA DHARMA</h5>
                    <small class="text-white-50" style="font-size: 0.8rem; letter-spacing: 0.5px;">Cerdas • Humanis • Berintegritas</small>
                </div>
            </div>

            <div class="my-auto animate-fade-up" style="max-width: 520px; animation-delay: 0.3s; z-index: 10;">
                <h1 class="display-4 fw-bolder mb-3 text-white lh-sm" style="letter-spacing: -1.5px;">
                    Apotek<br>Sanata Dharma
                </h1>
                <p class="text-white-50 fs-5 mb-0 lh-base fw-light">
                    Sistem informasi penjualan dan manajemen inventaris farmasi terintegrasi.
                </p>
            </div>

            <div class="d-flex justify-content-between align-items-end text-white-50 border-top border-white border-opacity-10 pt-4 animate-fade-up" style="animation-delay: 0.5s; z-index: 10;">

                <div>
                    <h2 class="fw-bold mb-0 text-white" id="live-time" style="letter-spacing: -1px;">00:00:00</h2>
                    <p class="text-white-50 mb-0 small" id="live-date">Memuat tanggal...</p>
                </div>

                <div class="text-end small">
                    <span class="d-block">&copy; {{ date('Y') }} Apotek USD</span>
                </div>

            </div>

        </div>

        <div class="col-lg-6 login-wrapper d-flex align-items-center justify-content-center p-4 p-md-5">

            <div class="login-card animate-fade-up" style="animation-delay: 0.2s;">

                <div class="d-lg-none text-center mb-4">
                    <img src="{{ asset('images/logo-usd.png') }}" alt="Logo USD" style="height: 60px; margin-bottom: 12px;">
                    <h5 class="fw-bold mb-0 text-dark">Apotek Sanata Dharma</h5>
                </div>

                <div class="mb-4 text-center text-lg-start">
                    <h3 class="fw-bold text-dark mb-1">Masuk Sistem</h3>
                    <p class="text-muted small">Masukkan kredensial Anda untuk melanjutkan.</p>
                </div>

                @error('username')
                <div class="alert alert-danger d-flex align-items-center mb-4 rounded-3 py-2 px-3 small border-0 bg-danger bg-opacity-10 text-danger" role="alert">
                    <i class="bi bi-exclamation-circle-fill me-2 fs-6"></i>
                    <div>{{ $message }}</div>
                </div>
                @enderror

                <form action="{{ route('login.process') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="username" class="form-label fw-semibold text-secondary small mb-1">Username</label>
                        <div class="custom-input-group">
                            <span class="input-group-text"><i class="bi bi-person"></i></span>
                            <input type="text" class="form-control" id="username" name="username" value="{{ old('username') }}" placeholder="Masukkan username" required autofocus>
                        </div>
                    </div>

                    <div class="mb-4">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <label for="password" class="form-label fw-semibold text-secondary small mb-0">Kata Sandi</label>
                        </div>
                        <div class="custom-input-group">
                            <span class="input-group-text"><i class="bi bi-lock"></i></span>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan kata sandi" required>
                            <button class="btn border-0 text-secondary pe-3" type="button" id="togglePassword">
                                <i class="bi bi-eye" id="eyeIcon"></i>
                            </button>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-maroon w-100 shadow-sm d-flex align-items-center justify-content-center gap-2 mt-4">
                        <span>Masuk ke Akun</span>
                        <i class="bi bi-arrow-right"></i>
                    </button>
                </form>

            </div>
        </div>

    </div>
</div>

<script>
    const togglePassword = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('password');
    const eyeIcon = document.getElementById('eyeIcon');

    togglePassword.addEventListener('click', function () {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        eyeIcon.classList.toggle('bi-eye');
        eyeIcon.classList.toggle('bi-eye-slash');
    });

    function updateClock() {
        const now = new Date();
        const timeString = now.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit', second: '2-digit' });
        document.getElementById('live-time').innerText = timeString;

        const dateOptions = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
        document.getElementById('live-date').innerText = now.toLocaleDateString('id-ID', dateOptions);
    }
    setInterval(updateClock, 1000);
    updateClock();
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
