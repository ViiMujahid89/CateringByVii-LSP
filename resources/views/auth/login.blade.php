<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Masuk — CateringByVii</title>
    <meta name="description" content="Masuk ke akun CateringByVii Anda untuk memesan katering.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        :root {
            --color-primary: #2C1810; --color-primary-light: #4A2C1A;
            --color-accent: #8B6914; --color-accent-warm: #C4922A;
            --font-serif: 'Playfair Display', Georgia, serif;
            --font-sans: 'Inter', sans-serif;
        }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: var(--font-sans); min-height: 100vh; display: flex; }

        .auth-left {
            flex: 0 0 45%; position: relative; overflow: hidden;
            display: flex; flex-direction: column; justify-content: space-between;
        }
        .auth-left-bg {
            position: absolute; inset: 0;
            background-image: url('https://images.unsplash.com/photo-1414235077428-338989a2e8c0?w=1200&auto=format&fit=crop&q=80');
            background-size: cover; background-position: center;
        }
        .auth-left-overlay {
            position: absolute; inset: 0;
            background: linear-gradient(160deg, rgba(44,24,16,0.78) 0%, rgba(44,24,16,0.6) 60%, rgba(44,24,16,0.85) 100%);
        }
        .auth-left-content {
            position: relative; z-index: 2; padding: 52px 56px;
            flex: 1; display: flex; flex-direction: column; justify-content: space-between;
        }
        .brand-name { font-family: var(--font-serif); font-style: italic; font-size: 1.8rem; color: #fff; font-weight: 400; }
        .brand-label { font-size: 10px; letter-spacing: 0.15em; color: rgba(255,255,255,0.5); margin-bottom: 4px; }
        .brand-line { width: 36px; height: 2px; background: rgba(255,255,255,0.4); margin-top: 8px; }
        .auth-tagline h2 {
            font-family: var(--font-serif); font-size: clamp(1.6rem, 2.5vw, 2.2rem);
            font-weight: 300; color: #fff; letter-spacing: 0.06em; line-height: 1.25;
        }
        .auth-tagline p { font-size: 13px; color: rgba(255,255,255,0.65); margin-top: 12px; line-height: 1.7; max-width: 320px; }
        .auth-footer-bar {
            position: absolute; bottom: 28px; left: 56px; right: 56px; z-index: 2;
            display: flex; justify-content: space-between;
        }
        .auth-footer-bar span, .auth-footer-bar a {
            font-size: 11px; color: rgba(255,255,255,0.4); text-decoration: none;
        }
        .auth-footer-bar a:hover { color: rgba(255,255,255,0.8); }

        .auth-right {
            flex: 1; background: #fff; display: flex; align-items: center;
            justify-content: center; padding: 60px 64px;
        }
        .auth-form-wrap { width: 100%; max-width: 380px; }
        .auth-heading { margin-bottom: 32px; }
        .auth-heading h1 { font-family: var(--font-serif); font-size: 1.7rem; font-weight: 400; color: var(--color-primary); }
        .auth-heading p { font-size: 13px; color: #888; margin-top: 6px; }
        .auth-divider { display: flex; flex-direction: column; gap: 4px; margin: 12px 0 24px; }
        .auth-divider span { display: block; width: 30px; height: 2px; background: var(--color-primary); }

        .form-group { margin-bottom: 18px; }
        .form-label { display: block; font-size: 12px; font-weight: 600; letter-spacing: 0.05em; text-transform: uppercase; color: #555; margin-bottom: 6px; }
        .form-control {
            width: 100%; padding: 11px 14px; border: 1px solid #d8d3cc; border-radius: 6px;
            font-size: 14px; font-family: var(--font-sans); transition: border-color 0.2s;
        }
        .form-control:focus { outline: none; border-color: var(--color-accent); box-shadow: 0 0 0 3px rgba(139,105,20,0.1); }
        .form-error { font-size: 12px; color: #c0392b; margin-top: 4px; }

        .check-row { display: flex; align-items: center; gap: 8px; margin-bottom: 20px; }
        .check-row input { width: 15px; height: 15px; accent-color: var(--color-primary); }
        .check-row label { font-size: 13px; color: #555; }

        .btn-submit {
            width: 100%; padding: 13px; background: var(--color-primary); color: #fff;
            border: none; font-size: 13px; font-weight: 600; letter-spacing: 0.08em;
            text-transform: uppercase; cursor: pointer; transition: background 0.2s;
            border-radius: 6px; font-family: var(--font-sans);
        }
        .btn-submit:hover { background: var(--color-primary-light); }

        .auth-alt { text-align: center; margin-top: 20px; font-size: 13px; color: #888; }
        .auth-alt a { color: var(--color-accent); text-decoration: none; font-weight: 500; }
        .auth-alt a:hover { text-decoration: underline; }

        .alert-error { background: #fdf0ef; border: 1px solid #f5b7b1; color: #c0392b; padding: 10px 14px; border-radius: 6px; font-size: 13px; margin-bottom: 16px; }

        @media (max-width: 768px) {
            body { flex-direction: column; }
            .auth-left { min-height: 40vh; flex: none; }
            .auth-left-content { padding: 36px 32px; }
            .auth-right { padding: 40px 28px; }
            .auth-footer-bar { display: none; }
        }
    </style>
</head>
<body>
    <div class="auth-left">
        <div class="auth-left-bg"></div>
        <div class="auth-left-overlay"></div>
        <div class="auth-left-content">
            <div>
                <div class="brand-label">Chef &amp; Catering</div>
                <div class="brand-name">CateringByVii</div>
                <div class="brand-line"></div>
            </div>
            <div class="auth-tagline">
                <h2>Rasa Terbaik<br>di Setiap Acara</h2>
                <p>Platform pemesanan katering profesional — pilih paket, pesan, dan nikmati sajian eksklusif untuk acara Anda.</p>
            </div>
        </div>
        <div class="auth-footer-bar">
            <span>&copy; {{ date('Y') }} CateringByVii</span>
            <a href="{{ route('landing') }}">Kunjungi Halaman Utama &rsaquo;</a>
        </div>
    </div>

    <div class="auth-right">
        <div class="auth-form-wrap">
            <div class="auth-heading">
                <h1>Masuk ke Akun</h1>
                <div class="auth-divider"><span></span><span></span></div>
                <p>Masukkan email dan password Anda untuk mengakses platform.</p>
            </div>

            @if($errors->any())
                <div class="alert-error">{{ $errors->first() }}</div>
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

                <div class="check-row">
                    <input type="checkbox" id="remember" name="remember">
                    <label for="remember">Ingat saya</label>
                </div>

                <button type="submit" class="btn-submit" id="btn-login-submit">Masuk</button>
            </form>

            <div class="auth-alt">
                Belum punya akun? <a href="{{ route('register') }}" id="link-register">Daftar sekarang</a>
            </div>
        </div>
    </div>
</body>
</html>
