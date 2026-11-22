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
            margin: 0;
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(18px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-up {
            animation: fadeInUp 0.7s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }

        @keyframes auroraFlow1 {
            0% { transform: translate(-5%, -5%) scale(1) rotate(0deg); }
            50% { transform: translate(16%, 14%) scale(1.18) rotate(25deg); }
            100% { transform: translate(-8%, 20%) scale(1.05) rotate(-15deg); }
        }
        @keyframes auroraFlow2 {
            0% { transform: translate(5%, 5%) scale(1.05); }
            50% { transform: translate(-20%, -14%) scale(1.22); }
            100% { transform: translate(10%, -15%) scale(0.95); }
        }
        @keyframes auroraFlow3 {
            0% { transform: translate(0%, 0%) scale(1); }
            50% { transform: translate(-15%, 18%) scale(1.25); }
            100% { transform: translate(18%, -12%) scale(1.05); }
        }

        .auth-shell {
            min-height: 100vh;
            display: flex;
        }

        .brand-section {
            flex: 0 0 46%;
            background-color: #590000;
            position: relative;
            overflow: hidden;
            z-index: 2;
            box-shadow: 12px 0 40px rgba(15, 23, 42, 0.08);
        }

        .hero-brand-title {
            font-size: clamp(2.1rem, 3.1vw, 2.75rem);
            font-weight: 800;
            line-height: 1.15;
            letter-spacing: -1px;
            color: #ffffff;
        }

        .aurora-layer {
            position: absolute;
            border-radius: 50%;
            filter: blur(65px);
            z-index: -3;
            pointer-events: none;
            will-change: transform;
        }
        .aurora-1 {
            width: 620px;
            height: 620px;
            background: radial-gradient(circle, rgba(185, 28, 28, 0.85) 0%, rgba(139, 0, 0, 0) 70%);
            top: -22%;
            left: -18%;
            animation: auroraFlow1 12s ease-in-out infinite alternate;
        }
        .aurora-2 {
            width: 560px;
            height: 560px;
            background: radial-gradient(circle, rgba(225, 29, 72, 0.48) 0%, rgba(159, 18, 57, 0) 70%);
            bottom: -18%;
            right: -14%;
            animation: auroraFlow2 15s ease-in-out infinite alternate;
        }
        .aurora-3 {
            width: 460px;
            height: 460px;
            background: radial-gradient(circle, rgba(153, 27, 27, 0.75) 0%, rgba(127, 29, 29, 0) 70%);
            top: 28%;
            left: 22%;
            animation: auroraFlow3 17s ease-in-out infinite alternate;
        }

        .pattern-base {
            position: absolute;
            inset: 0;
            background-image: radial-gradient(rgba(255, 255, 255, 0.07) 1.5px, transparent 1.5px);
            background-size: 28px 28px;
            z-index: -2;
            pointer-events: none;
        }

        .pattern-spotlight {
            position: absolute;
            inset: 0;
            background-image: radial-gradient(rgba(255, 255, 255, 0.42) 1.8px, transparent 1.8px);
            background-size: 28px 28px;
            z-index: -1;
            pointer-events: none;
            opacity: 0;
            transition: opacity 0.35s ease;
            -webkit-mask-image: radial-gradient(240px circle at var(--x, 50%) var(--y, 50%), #000 0%, transparent 100%);
            mask-image: radial-gradient(240px circle at var(--x, 50%) var(--y, 50%), #000 0%, transparent 100%);
        }

        .cursor-glow {
            position: absolute;
            inset: 0;
            background: radial-gradient(320px circle at var(--x, 50%) var(--y, 50%), rgba(255, 255, 255, 0.08), transparent 75%);
            z-index: -1;
            pointer-events: none;
            opacity: 0;
            transition: opacity 0.35s ease;
        }

        .brand-section:hover .pattern-spotlight,
        .brand-section:hover .cursor-glow {
            opacity: 1;
        }

        .login-wrapper {
            flex: 1;
            background-color: #f1f5f9;
            background-image: radial-gradient(rgba(100, 116, 139, 0.24) 1.5px, transparent 1.5px);
            background-size: 26px 26px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            position: relative;
        }

        .login-card {
            width: 100%;
            max-width: 480px;
            background: #ffffff;
            border-radius: 24px;
            padding: 2.5rem 2.85rem 2.75rem;
            box-shadow: 0 12px 35px -5px rgba(15, 23, 42, 0.06);
            border: 1px solid #e2e8f0;
            position: relative;
            z-index: 5;
        }

        @keyframes mascotBob {
            0%, 100% { transform: translate3d(0, 0px, 0) rotate(-0.8deg); }
            50% { transform: translate3d(0, -6px, 0) rotate(0.8deg); }
        }
        @keyframes mascotBlink {
            0%, 92%, 100% { transform: scaleY(1); }
            96% { transform: scaleY(0.08); }
        }
        @keyframes errorShake {
            0%, 100% { transform: translateX(0) rotate(0deg); }
            20% { transform: translateX(-6px) rotate(-5deg); }
            40% { transform: translateX(6px) rotate(5deg); }
            60% { transform: translateX(-4px) rotate(-3deg); }
            80% { transform: translateX(4px) rotate(3deg); }
        }
        @keyframes tearFall {
            0% { transform: translateY(0px) scale(0.7); opacity: 0; }
            20% { transform: translateY(2px) scale(1); opacity: 0.95; }
            80% { transform: translateY(13px) scale(0.95); opacity: 0.85; }
            100% { transform: translateY(16px) scale(0.6); opacity: 0; }
        }

        .mascot-stage {
            position: relative;
            width: 120px;
            height: 88px;
            margin: 0 auto 0.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .mascot-float {
            position: relative;
            z-index: 2;
            will-change: transform;
            animation: mascotBob 3s ease-in-out infinite;
        }
        .mascot-svg {
            width: 116px;
            height: 88px;
            overflow: visible;
            shape-rendering: geometricPrecision;
            filter: drop-shadow(0 6px 12px rgba(15, 23, 42, 0.08));
        }
        .mascot-body-tilt {
            transform-box: fill-box;
            transform-origin: center bottom;
            transition: transform 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
        }
        .mascot-eyes {
            transform-box: fill-box;
            transform-origin: center;
            transition: transform 0.18s cubic-bezier(0.34, 1.56, 0.64, 1);
        }
        .eye-dot {
            transform-box: fill-box;
            transform-origin: center;
            animation: mascotBlink 4.5s infinite;
        }
        .mascot-hand {
            transform-box: fill-box;
            transform-origin: center;
            transition: transform 0.38s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        .mascot-sad-brows {
            opacity: 0;
            transition: opacity 0.25s ease;
        }
        .mascot-tear {
            opacity: 0;
            transform-box: fill-box;
            transform-origin: center top;
        }

        .mascot-svg.is-error .mascot-body-tilt {
            animation: errorShake 0.55s ease-in-out;
        }
        .mascot-svg.is-error .mascot-sad-brows {
            opacity: 1;
        }
        .mascot-svg.is-error .tear-left {
            animation: tearFall 1.5s ease-in infinite;
        }
        .mascot-svg.is-error .tear-right {
            animation: tearFall 1.5s ease-in infinite 0.75s;
        }

        .mascot-svg.cover-eyes .hand-left {
            transform: translate(13px, -36px);
        }
        .mascot-svg.cover-eyes .hand-right {
            transform: translate(-13px, -36px);
        }

        .mascot-svg.peek-eyes .hand-left {
            transform: translate(13px, -36px);
        }
        .mascot-svg.peek-eyes .hand-right {
            transform: translate(-10px, -17px);
        }

        .custom-input-group {
            border: 1.5px solid #e2e8f0;
            border-radius: 12px;
            transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
            background-color: #f8fafc;
            display: flex;
            align-items: center;
        }
        .custom-input-group:focus-within {
            background-color: #ffffff;
            border-color: #8B0000;
            box-shadow: 0 0 0 4px rgba(139, 0, 0, 0.08);
            transform: translateY(-1px);
        }
        .custom-input-group .input-group-text {
            background-color: transparent;
            border: none;
            color: #94a3b8;
            padding-right: 0;
            padding-left: 1rem;
            transition: all 0.25s cubic-bezier(0.34, 1.56, 0.64, 1);
        }
        .custom-input-group:focus-within .input-group-text {
            color: #8B0000;
            transform: scale(1.18) rotate(-6deg);
        }
        .custom-input-group .form-control {
            border: none;
            box-shadow: none;
            background: transparent;
            padding: 0.8rem 1rem;
            font-size: 0.95rem;
            color: #0f172a;
        }

        .btn-maroon {
            background-color: #8B0000;
            border-color: #8B0000;
            color: #ffffff;
            font-weight: 600;
            padding: 0.85rem 1.5rem;
            border-radius: 12px;
            transition: all 0.25s cubic-bezier(0.34, 1.56, 0.64, 1);
        }
        .btn-maroon:hover {
            background-color: #700000;
            border-color: #700000;
            color: #ffffff;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(139, 0, 0, 0.25);
        }
        .btn-maroon:active {
            transform: translateY(0) scale(0.98);
        }
    </style>
</head>
<body>

<div class="auth-shell">

    <div class="d-none d-lg-flex brand-section flex-column justify-content-between p-5 text-white" id="brandSection">

        <div class="aurora-layer aurora-1"></div>
        <div class="aurora-layer aurora-2"></div>
        <div class="aurora-layer aurora-3"></div>
        <div class="pattern-base"></div>
        <div class="pattern-spotlight"></div>
        <div class="cursor-glow"></div>

        <div class="d-flex align-items-center gap-3 animate-fade-up" style="animation-delay: 0.1s; z-index: 10;">
            <img src="{{ asset('images/logo-usd.png') }}" alt="Logo USD" style="height: 54px; width: auto; object-fit: contain;" onerror="this.style.display='none'">
            <div>
                <h5 class="fw-bold mb-0 tracking-wide text-white" style="letter-spacing: 0.5px;">SISTEM INFORMASI FARMASI</h5>
                <small class="text-white-50" style="font-size: 0.8rem; letter-spacing: 0.5px;">Cerdas • Humanis • Berintegritas</small>
            </div>
        </div>

        <div class="my-auto animate-fade-up" style="max-width: 520px; animation-delay: 0.3s; z-index: 10;">
            <h1 class="hero-brand-title mb-3">
                Apotek Universitas<br>Sanata Dharma
            </h1>
            <p class="text-white-50 fs-5 mb-0 lh-base fw-light">
                Platform pengelolaan inventaris obat, validasi resep, dan transaksi pelayanan terintegrasi.
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

    <div class="login-wrapper">

        <div class="login-card animate-fade-up" style="animation-delay: 0.15s;">

            <div class="d-lg-none text-center mb-3">
                <img src="{{ asset('images/logo-usd.png') }}" alt="Logo USD" style="height: 52px; margin-bottom: 8px;">
            </div>

            <div class="mascot-stage">
                <div class="mascot-float">
                    <svg class="mascot-svg {{ $errors->has('username') ? 'is-error' : '' }}" id="capsuleMascot" viewBox="0 0 140 100" xmlns="http://www.w3.org/2000/svg">
                        <defs>
                            <clipPath id="capsuleClip">
                                <rect x="41" y="12" width="58" height="78" rx="29"/>
                            </clipPath>
                        </defs>
                        <g class="mascot-body-tilt" id="mascotBody">
                            <g clip-path="url(#capsuleClip)">
                                <rect x="41" y="12" width="58" height="42" fill="#ffffff"/>
                                <rect x="41" y="54" width="58" height="36" fill="#8B0000"/>
                                <rect x="64" y="69" width="12" height="3.5" rx="1.75" fill="rgba(255,255,255,0.85)"/>
                                <rect x="68.25" y="64.75" width="3.5" height="12" rx="1.75" fill="rgba(255,255,255,0.85)"/>
                            </g>
                            <rect x="41" y="12" width="58" height="78" rx="29" fill="none" stroke="#cbd5e1" stroke-width="2"/>
                            <ellipse cx="49" cy="43" rx="4.5" ry="2.5" fill="#fda4af" opacity="0.85"/>
                            <ellipse cx="91" cy="43" rx="4.5" ry="2.5" fill="#fda4af" opacity="0.85"/>
                            <g class="mascot-sad-brows">
                                <path d="M 52 28 Q 57 27 61 24" fill="none" stroke="#0f172a" stroke-width="2" stroke-linecap="round"/>
                                <path d="M 88 28 Q 83 27 79 24" fill="none" stroke="#0f172a" stroke-width="2" stroke-linecap="round"/>
                            </g>
                            <g class="mascot-eyes" id="mascotEyes">
                                <g class="eye-dot">
                                    <circle cx="58" cy="35" r="4.5" fill="#0f172a"/>
                                    <circle cx="56.4" cy="33.2" r="1.5" fill="#ffffff"/>
                                    <circle cx="59.6" cy="36.6" r="0.8" fill="#ffffff"/>
                                </g>
                                <g class="eye-dot">
                                    <circle cx="82" cy="35" r="4.5" fill="#0f172a"/>
                                    <circle cx="80.4" cy="33.2" r="1.5" fill="#ffffff"/>
                                    <circle cx="83.6" cy="36.6" r="0.8" fill="#ffffff"/>
                                </g>
                            </g>
                            <path class="mascot-tear tear-left" d="M 55 39 C 55 39 52.5 42.5 52.5 44 A 2.5 2.5 0 1 0 57.5 44 C 57.5 42.5 55 39 55 39 Z" fill="#38bdf8"/>
                            <path class="mascot-tear tear-right" d="M 85 39 C 85 39 82.5 42.5 82.5 44 A 2.5 2.5 0 1 0 87.5 44 C 87.5 42.5 85 39 85 39 Z" fill="#38bdf8"/>
                            @if($errors->has('username'))
                                <path class="mascot-mouth" id="mascotMouth" d="M 64 47 Q 70 41 76 47" fill="none" stroke="#0f172a" stroke-width="2.2" stroke-linecap="round"/>
                            @else
                                <path class="mascot-mouth" id="mascotMouth" d="M 64 42 Q 70 48 76 42" fill="none" stroke="#0f172a" stroke-width="2.2" stroke-linecap="round"/>
                            @endif
                        </g>
                        <g class="mascot-hand hand-left">
                            <rect x="34" y="62" width="22" height="18" rx="9" fill="#8B0000" stroke="#ffffff" stroke-width="2"/>
                        </g>
                        <g class="mascot-hand hand-right">
                            <rect x="84" y="62" width="22" height="18" rx="9" fill="#8B0000" stroke="#ffffff" stroke-width="2"/>
                        </g>
                    </svg>
                </div>
            </div>

            <div class="mb-4 text-center">
                <h3 class="fw-bold text-dark mb-1">Masuk Sistem</h3>
                <p class="text-muted small mb-0">Masukkan kredensial Anda untuk melanjutkan.</p>
            </div>

            @error('username')
            <div class="alert alert-danger d-flex align-items-center mb-3 rounded-3 py-2 px-3 small border-0 bg-danger bg-opacity-10 text-danger" role="alert">
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
                    <label for="password" class="form-label fw-semibold text-secondary small mb-1">Kata Sandi</label>
                    <div class="custom-input-group">
                        <span class="input-group-text"><i class="bi bi-lock"></i></span>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan kata sandi" required>
                        <button class="btn border-0 text-secondary pe-3" type="button" id="togglePassword">
                            <i class="bi bi-eye" id="eyeIcon"></i>
                        </button>
                    </div>
                </div>

                <button type="submit" class="btn btn-maroon w-100 shadow-sm mt-2">
                    Masuk
                </button>
            </form>

        </div>
    </div>

</div>

<script>
    const togglePassword = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('password');
    const usernameInput = document.getElementById('username');
    const eyeIcon = document.getElementById('eyeIcon');

    const mascot = document.getElementById('capsuleMascot');
    const mascotBody = document.getElementById('mascotBody');
    const mascotEyes = document.getElementById('mascotEyes');
    const mascotMouth = document.getElementById('mascotMouth');

    let isErrorActive = {!! json_encode($errors->has('username')) !!};

    function clearErrorMood() {
        if (isErrorActive) {
            isErrorActive = false;
            mascot.classList.remove('is-error');
            mascotMouth.setAttribute('d', 'M 64 42 Q 70 48 76 42');
        }
    }

    function updateEyeTracking() {
        const len = usernameInput.value.length;
        const xOffset = Math.min(len * 0.55, 8) - 4;
        const tilt = (xOffset / 4) * 3.5;
        mascotEyes.style.transform = `translate(${xOffset}px, 3px)`;
        mascotBody.style.transform = `rotate(${tilt}deg)`;
    }

    usernameInput.addEventListener('focus', function() {
        mascot.classList.remove('cover-eyes', 'peek-eyes');
        if (!isErrorActive) {
            mascotMouth.setAttribute('d', 'M 64 42 Q 70 48 76 42');
            updateEyeTracking();
        }
    });

    usernameInput.addEventListener('input', function() {
        clearErrorMood();
        updateEyeTracking();
    });

    usernameInput.addEventListener('blur', function() {
        mascotEyes.style.transform = 'translate(0px, 0px)';
        mascotBody.style.transform = 'rotate(0deg)';
    });

    function updatePasswordMascotState() {
        clearErrorMood();
        const isShowingPassword = passwordInput.getAttribute('type') === 'text';
        mascotBody.style.transform = 'rotate(0deg)';
        if (isShowingPassword) {
            mascot.classList.remove('cover-eyes');
            mascot.classList.add('peek-eyes');
            mascotEyes.style.transform = 'translate(2px, 2px)';
            mascotMouth.setAttribute('d', 'M 65 43 Q 70 46 75 43');
        } else {
            mascot.classList.remove('peek-eyes');
            mascot.classList.add('cover-eyes');
            mascotEyes.style.transform = 'translate(0px, 0px)';
            mascotMouth.setAttribute('d', 'M 66 44 Q 70 46 74 44');
        }
    }

    passwordInput.addEventListener('focus', updatePasswordMascotState);

    passwordInput.addEventListener('blur', function(e) {
        if (e.relatedTarget === togglePassword) return;
        mascot.classList.remove('cover-eyes', 'peek-eyes');
        mascotEyes.style.transform = 'translate(0px, 0px)';
        mascotMouth.setAttribute('d', 'M 64 42 Q 70 48 76 42');
    });

    togglePassword.addEventListener('click', function () {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        eyeIcon.classList.toggle('bi-eye');
        eyeIcon.classList.toggle('bi-eye-slash');
        passwordInput.focus();
        updatePasswordMascotState();
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

    const brandSection = document.getElementById('brandSection');
    if (brandSection) {
        brandSection.addEventListener('mousemove', function(e) {
            const rect = brandSection.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;
            brandSection.style.setProperty('--x', x + 'px');
            brandSection.style.setProperty('--y', y + 'px');
        });
    }
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
