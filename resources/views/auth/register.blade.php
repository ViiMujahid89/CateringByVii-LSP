<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar Akun — CateringByVii</title>
    <meta name="description" content="Daftar akun baru di CateringByVii untuk memesan katering.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;1,400&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="auth-page">

    {{-- ── Panel Kiri — Branding ──────────────────────────────── --}}
    <div class="auth-left">
        <div class="auth-left-bg" style="background-image: url('https://images.unsplash.com/photo-1414235077428-338989a2e8c0?w=900&auto=format&fit=crop&q=80');"></div>
        <div class="auth-left-overlay"></div>
        <div class="auth-left-content">
            <div>
                <div class="auth-brand-label">Chef &amp; Catering</div>
                <div class="auth-brand-name">CateringByVii</div>
                <div class="auth-brand-line"></div>
            </div>
            <div class="auth-tagline">
                <h2>Bergabung &amp; Nikmati Layanan Terbaik</h2>
                <p>Daftarkan akun Anda dan mulai pesan paket katering pilihan untuk setiap momen spesial.</p>
                <ul class="auth-step-list">
                    <li><span class="auth-step-num">1</span> Isi form pendaftaran</li>
                    <li><span class="auth-step-num">2</span> Tunggu verifikasi admin</li>
                    <li><span class="auth-step-num">3</span> Login &amp; pesan katering</li>
                </ul>
            </div>
        </div>
    </div>

    {{-- ── Panel Kanan — Form ─────────────────────────────────── --}}
    <div class="auth-right auth-right--scroll">
        <div class="auth-form-wrap">
            <div class="auth-heading">
                <h1>Buat Akun Baru</h1>
                <div class="auth-divider"><span></span><span></span></div>
                <p>Lengkapi data di bawah untuk mendaftar sebagai pelanggan.</p>
            </div>

            @if($errors->any())
                <div class="alert-flash alert-error">{{ $errors->first() }}</div>
            @endif

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

                <div class="auth-form-row">
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

                <div class="auth-section-divider">
                    <span>Informasi Tambahan <em>(Opsional)</em></span>
                </div>

                <div class="form-group">
                    <label class="form-label" for="phone">Nomor Telepon</label>
                    <input type="text" id="phone" name="phone" class="form-control"
                        value="{{ old('phone') }}" placeholder="08xxxxxxxxxx">
                    @error('phone') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label class="form-label" for="address">Alamat</label>
                    <textarea id="address" name="address" class="form-control"
                        placeholder="Alamat lengkap Anda" rows="3">{{ old('address') }}</textarea>
                    @error('address') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <button type="submit" class="auth-submit-btn" id="btn-register-submit">Daftar Sekarang</button>
            </form>

            <div class="auth-alt">
                Sudah punya akun? <a href="{{ route('login') }}" id="link-login">Masuk di sini</a>
            </div>
        </div>
    </div>

</body>
</html>
