<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Masuk — CateringByVii</title>
    <meta name="description" content="Masuk ke akun CateringByVii Anda untuk memesan katering.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;1,400&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="auth-page">

    {{-- ── Panel Kiri — Branding ──────────────────────────────── --}}
    <div class="auth-left">
        <div class="auth-left-bg" style="background-image: url('https://images.unsplash.com/photo-1555244162-803834f70033?w=900&auto=format&fit=crop&q=80');"></div>
        <div class="auth-left-overlay"></div>
        <div class="auth-left-content">
            <div>
                <div class="auth-brand-label">Chef &amp; Catering</div>
                <div class="auth-brand-name">CateringByVii</div>
                <div class="auth-brand-line"></div>
            </div>
            <div class="auth-tagline">
                <h2>Rasa Terbaik<br>di Setiap Acara</h2>
                <p>Platform pemesanan katering profesional — pilih paket, pesan, dan nikmati sajian eksklusif untuk acara Anda.</p>
            </div>
        </div>
        <div class="auth-footer-bar">
            <span>&copy; {{ date('Y') }} CateringByVii</span>
            <a href="{{ route('home') }}">Kunjungi Halaman Utama &rsaquo;</a>
        </div>
    </div>

    {{-- ── Panel Kanan — Form ─────────────────────────────────── --}}
    <div class="auth-right">
        <div class="auth-form-wrap">
            <div class="auth-heading">
                <h1>Masuk ke Akun</h1>
                <div class="auth-divider"><span></span><span></span></div>
                <p>Masukkan email dan password Anda untuk mengakses platform.</p>
            </div>

            @if($errors->any())
                <div class="alert-flash alert-error">{{ $errors->first() }}</div>
            @endif

            <form method="POST" action="{{ route('login') }}" id="form-login">
                @csrf

                <div class="form-group">
                    <label class="form-label" for="email">Email</label>
                    <input type="email" id="email" name="email" class="form-control"
                        value="{{ old('email') }}" required autofocus autocomplete="email"
                        placeholder="nama@email.com">
                    @error('email') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label class="form-label" for="password">Password</label>
                    <input type="password" id="password" name="password" class="form-control"
                        required autocomplete="current-password" placeholder="••••••••">
                    @error('password') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div class="auth-check-row">
                    <input type="checkbox" id="remember" name="remember">
                    <label for="remember">Ingat saya</label>
                </div>

                <button type="submit" class="auth-submit-btn" id="btn-login-submit">Masuk</button>
            </form>

            <div class="auth-alt">
                Belum punya akun? <a href="{{ route('register') }}" id="link-register">Daftar sekarang</a>
            </div>
        </div>
    </div>

</body>
</html>
