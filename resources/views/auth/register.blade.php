<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar Akun — CateringByVii</title>
    <meta name="description" content="Daftar akun baru di CateringByVii untuk memesan katering.">
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
            flex: 0 0 38%; position: relative; overflow: hidden;
            display: flex; flex-direction: column; justify-content: space-between;
        }
        .auth-left-bg {
            position: absolute; inset: 0;
            background-image: url('https://images.unsplash.com/photo-1467003909585-2f8a72700288?w=800&auto=format&fit=crop&q=80');
            background-size: cover; background-position: center;
        }
        .auth-left-overlay {
            position: absolute; inset: 0;
            background: linear-gradient(160deg, rgba(44,24,16,0.82) 0%, rgba(44,24,16,0.65) 60%, rgba(44,24,16,0.88) 100%);
        }
        .auth-left-content { position: relative; z-index: 2; padding: 52px 48px; flex: 1; display: flex; flex-direction: column; justify-content: space-between; }
        .brand-name { font-family: var(--font-serif); font-style: italic; font-size: 1.6rem; color: #fff; font-weight: 400; }
        .brand-label { font-size: 10px; letter-spacing: 0.15em; color: rgba(255,255,255,0.5); margin-bottom: 4px; }
        .brand-line { width: 36px; height: 2px; background: rgba(255,255,255,0.4); margin-top: 8px; }
        .auth-tagline h2 { font-family: var(--font-serif); font-size: 1.5rem; font-weight: 300; color: #fff; line-height: 1.3; }
        .auth-tagline p { font-size: 13px; color: rgba(255,255,255,0.6); margin-top: 12px; line-height: 1.7; }
        .step-list { margin-top: 24px; list-style: none; display: flex; flex-direction: column; gap: 10px; }
        .step-list li { display: flex; align-items: flex-start; gap: 10px; font-size: 13px; color: rgba(255,255,255,0.75); }
        .step-num { background: var(--color-accent-warm); color: #fff; border-radius: 50%; width: 22px; height: 22px; display: flex; align-items: center; justify-content: center; font-size: 11px; font-weight: 700; flex-shrink: 0; margin-top: 1px; }

        .auth-right { flex: 1; background: #fff; display: flex; align-items: center; justify-content: center; padding: 48px 60px; overflow-y: auto; }
        .auth-form-wrap { width: 100%; max-width: 400px; }
        .auth-heading { margin-bottom: 28px; }
        .auth-heading h1 { font-family: var(--font-serif); font-size: 1.6rem; font-weight: 400; color: var(--color-primary); }
        .auth-heading p { font-size: 13px; color: #888; margin-top: 6px; }
        .auth-divider { display: flex; flex-direction: column; gap: 4px; margin: 12px 0 20px; }
        .auth-divider span { display: block; width: 30px; height: 2px; background: var(--color-primary); }

        .form-group { margin-bottom: 16px; }
        .form-label { display: block; font-size: 12px; font-weight: 600; letter-spacing: 0.05em; text-transform: uppercase; color: #555; margin-bottom: 6px; }
        .form-control { width: 100%; padding: 10px 14px; border: 1px solid #d8d3cc; border-radius: 6px; font-size: 14px; font-family: var(--font-sans); transition: border-color 0.2s; }
        .form-control:focus { outline: none; border-color: var(--color-accent); box-shadow: 0 0 0 3px rgba(139,105,20,0.1); }
        .form-error { font-size: 12px; color: #c0392b; margin-top: 4px; }
        .form-hint { font-size: 12px; color: #888; margin-top: 4px; }
        textarea.form-control { resize: vertical; min-height: 80px; }

        .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }

        .btn-submit { width: 100%; padding: 13px; background: var(--color-primary); color: #fff; border: none; font-size: 13px; font-weight: 600; letter-spacing: 0.08em; text-transform: uppercase; cursor: pointer; transition: background 0.2s; border-radius: 6px; font-family: var(--font-sans); }
        .btn-submit:hover { background: var(--color-primary-light); }

        .auth-alt { text-align: center; margin-top: 18px; font-size: 13px; color: #888; }
        .auth-alt a { color: var(--color-accent); text-decoration: none; font-weight: 500; }

        .section-divider { border: none; border-top: 1px solid #ece8e2; margin: 20px 0; }
        .section-label { font-size: 10px; letter-spacing: 0.1em; text-transform: uppercase; color: #aaa; margin-bottom: 14px; }

        @media (max-width: 768px) {
            body { flex-direction: column; }
            .auth-left { min-height: 40vh; flex: none; }
            .auth-left-content { padding: 36px 32px; }
            .auth-right { padding: 36px 24px; }
            .form-row { grid-template-columns: 1fr; }
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
                <h2>Bergabung &amp; Nikmati Layanan Terbaik</h2>
                <p>Daftarkan akun Anda dan mulai pesan paket katering pilihan.</p>
                <ul class="step-list">
                    <li><span class="step-num">1</span> Isi form pendaftaran</li>
                    <li><span class="step-num">2</span> Tunggu verifikasi admin</li>
                    <li><span class="step-num">3</span> Login & pesan katering</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="auth-right">
        <div class="auth-form-wrap">
            <div class="auth-heading">
                <h1>Buat Akun Baru</h1>
                <div class="auth-divider"><span></span><span></span></div>
                <p>Lengkapi data di bawah untuk mendaftar sebagai pelanggan.</p>
            </div>

            <form method="POST" action="{{ route('register') }}" id="form-register">
                @csrf

                <div class="form-group">
                    <label class="form-label" for="name">Nama Lengkap</label>
                    <input type="text" id="name" name="name" class="form-control"
                        value="{{ old('name') }}" required autofocus placeholder="Nama Lengkap Anda">
                    @error('name') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label class="form-label" for="email">Email</label>
                    <input type="email" id="email" name="email" class="form-control"
                        value="{{ old('email') }}" required placeholder="nama@email.com">
                    @error('email') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label" for="password">Password</label>
                        <input type="password" id="password" name="password" class="form-control"
                            required autocomplete="new-password" placeholder="Min. 8 karakter">
                        @error('password') <div class="form-error">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="password_confirmation">Konfirmasi</label>
                        <input type="password" id="password_confirmation" name="password_confirmation"
                            class="form-control" required placeholder="Ulangi password">
                    </div>
                </div>

                <hr class="section-divider">
                <div class="section-label">Informasi Tambahan (Opsional)</div>

                <div class="form-group">
                    <label class="form-label" for="phone">Nomor Telepon</label>
                    <input type="text" id="phone" name="phone" class="form-control"
                        value="{{ old('phone') }}" placeholder="08xxxxxxxxxx">
                    @error('phone') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label class="form-label" for="address">Alamat</label>
                    <textarea id="address" name="address" class="form-control" placeholder="Alamat lengkap Anda">{{ old('address') }}</textarea>
                    @error('address') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <button type="submit" class="btn-submit" id="btn-register-submit">Daftar Sekarang</button>
            </form>

            <div class="auth-alt">
                Sudah punya akun? <a href="{{ route('login') }}" id="link-login">Masuk di sini</a>
            </div>
        </div>
    </div>
</body>
</html>
