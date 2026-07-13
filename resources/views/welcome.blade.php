<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Catering by Vii — Selamat Datang</title>
    <meta name="description" content="Selamat datang di Catering by Vii. Platform manajemen catering profesional untuk sajian terbaik di setiap acara Anda.">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,700;1,400;1,700&family=Cormorant+Garamond:ital,wght@0,300;0,400;1,300&family=Lato:wght@300;400;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* =============================================
           CATERING BY VII — DESIGN TOKENS (Shared)
           ============================================= */
        :root {
            --color-primary:        #2C1810;
            --color-primary-light:  #4A2C1A;
            --color-accent:         #8B6914;
            --color-accent-warm:    #C4922A;
            --color-bg-light:       #FAFAF8;
            --color-bg-card:        #FFFFFF;
            --color-text-body:      #3D3D3D;
            --color-text-muted:     #888888;
            --color-text-light:     #FFFFFF;
            --color-border:         #D9D3C7;
            --color-border-dark:    #2C1810;

            --font-serif:   'Playfair Display', Georgia, serif;
            --font-serif-lg:'Cormorant Garamond', Georgia, serif;
            --font-sans:    'Lato', sans-serif;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: var(--font-sans);
            background-color: var(--color-bg-light);
            color: var(--color-text-body);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* =============================================
           WELCOME LAYOUT
           ============================================= */
        .welcome-wrapper {
            display: flex;
            min-height: 100vh;
        }

        /* ---- Left Panel: Brand / Illustration ---- */
        .welcome-left {
            flex: 0 0 50%;
            position: relative;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .welcome-left-bg {
            position: absolute;
            inset: 0;
            background-image: url('https://images.unsplash.com/photo-1414235077428-338989a2e8c0?w=1200&auto=format&fit=crop&q=80');
            background-size: cover;
            background-position: center;
        }

        .welcome-left-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(
                160deg,
                rgba(44, 24, 16, 0.72) 0%,
                rgba(44, 24, 16, 0.55) 60%,
                rgba(44, 24, 16, 0.8) 100%
            );
        }

        .welcome-left-content {
            position: relative;
            z-index: 2;
            padding: 52px 56px;
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .brand-logo-area {
            display: flex;
            flex-direction: column;
            gap: 0;
        }
        .brand-label {
            font-family: var(--font-serif);
            font-style: italic;
            font-size: 11px;
            color: rgba(255,255,255,0.6);
            letter-spacing: 0.1em;
            margin-bottom: 4px;
        }
        .brand-name-hero {
            font-family: var(--font-serif);
            font-size: 2rem;
            font-weight: 700;
            font-style: italic;
            color: var(--color-text-light);
            line-height: 1.1;
        }
        .brand-line {
            width: 36px;
            height: 2px;
            background: rgba(255,255,255,0.5);
            margin-top: 8px;
        }

        .welcome-tagline {
            color: var(--color-text-light);
        }
        .welcome-tagline h2 {
            font-family: var(--font-serif-lg);
            font-size: clamp(1.8rem, 3vw, 2.8rem);
            font-weight: 300;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            line-height: 1.2;
            margin-bottom: 16px;
        }
        .welcome-tagline p {
            font-size: 13.5px;
            color: rgba(255,255,255,0.7);
            line-height: 1.75;
            max-width: 340px;
        }

        /* ---- Right Panel: Auth Forms ---- */
        .welcome-right {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--color-bg-card);
            padding: 60px 64px;
        }

        .welcome-right-inner {
            width: 100%;
            max-width: 380px;
        }

        /* Welcome heading atas form */
        .welcome-greeting {
            margin-bottom: 36px;
        }
        .welcome-greeting h1 {
            font-family: var(--font-serif);
            font-size: 1.8rem;
            font-weight: 400;
            color: var(--color-primary);
            margin-bottom: 8px;
        }
        .welcome-greeting p {
            font-size: 14px;
            color: var(--color-text-muted);
            line-height: 1.6;
        }

        /* Divider */
        .divider-small {
            display: flex;
            flex-direction: column;
            gap: 4px;
            margin: 14px 0 24px;
        }
        .divider-small span {
            display: block;
            width: 30px;
            height: 2px;
            background: var(--color-border-dark);
        }

        /* Auth Buttons */
        .auth-actions {
            display: flex;
            flex-direction: column;
            gap: 12px;
            margin-bottom: 32px;
        }

        .btn-primary-full {
            display: block;
            width: 100%;
            text-align: center;
            font-family: var(--font-sans);
            font-size: 13.5px;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: var(--color-text-light);
            background: var(--color-primary);
            border: 1px solid var(--color-primary);
            padding: 14px 24px;
            text-decoration: none;
            transition: background 0.25s, border-color 0.25s;
        }
        .btn-primary-full:hover {
            background: var(--color-primary-light);
            border-color: var(--color-primary-light);
        }

        .btn-secondary-full {
            display: block;
            width: 100%;
            text-align: center;
            font-family: var(--font-sans);
            font-size: 13.5px;
            font-weight: 400;
            letter-spacing: 0.06em;
            color: var(--color-primary);
            background: transparent;
            border: 1px solid var(--color-border-dark);
            padding: 14px 24px;
            text-decoration: none;
            transition: background 0.25s, color 0.25s;
        }
        .btn-secondary-full:hover {
            background: var(--color-primary);
            color: var(--color-text-light);
        }

        /* Auth divider */
        .auth-or {
            text-align: center;
            position: relative;
            margin: 4px 0;
        }
        .auth-or::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 1px;
            background: var(--color-border);
        }
        .auth-or span {
            position: relative;
            background: var(--color-bg-card);
            padding: 0 12px;
            font-size: 12px;
            color: var(--color-text-muted);
            letter-spacing: 0.06em;
        }

        /* Quick dashboard link (when already logged in) */
        .dashboard-panel {
            background: var(--color-bg-light);
            border: 1px solid var(--color-border);
            padding: 28px 32px;
            margin-bottom: 28px;
        }
        .dashboard-panel-label {
            font-size: 11px;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: var(--color-text-muted);
            margin-bottom: 8px;
        }
        .dashboard-panel h3 {
            font-family: var(--font-serif);
            font-size: 1.2rem;
            color: var(--color-primary);
            margin-bottom: 12px;
        }

        /* Feature highlights on right panel */
        .welcome-features {
            border-top: 1px solid var(--color-border);
            padding-top: 28px;
        }
        .welcome-features-title {
            font-size: 11px;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: var(--color-text-muted);
            margin-bottom: 16px;
        }
        .feature-list {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        .feature-list li {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            font-size: 13px;
            color: var(--color-text-body);
            line-height: 1.5;
        }
        .feature-list li::before {
            content: '—';
            color: var(--color-accent);
            flex-shrink: 0;
            margin-top: 1px;
        }

        /* ---- Bottom brand bar ---- */
        .welcome-footer-bar {
            position: absolute;
            bottom: 28px;
            left: 56px;
            right: 56px;
            z-index: 2;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .welcome-footer-bar span {
            font-size: 11px;
            color: rgba(255,255,255,0.45);
            letter-spacing: 0.04em;
        }
        .welcome-footer-bar a {
            font-size: 11px;
            color: rgba(255,255,255,0.55);
            text-decoration: none;
            letter-spacing: 0.04em;
            transition: color 0.2s;
        }
        .welcome-footer-bar a:hover { color: rgba(255,255,255,0.9); }

        /* ---- Responsive ---- */
        @media (max-width: 768px) {
            .welcome-wrapper { flex-direction: column; }
            .welcome-left { min-height: 45vh; flex: none; }
            .welcome-left-content { padding: 36px 32px; }
            .welcome-right { padding: 40px 32px; }
            .welcome-footer-bar { display: none; }
        }
    </style>
</head>
<body>
    <div class="welcome-wrapper">

        <!-- ============================
             LEFT PANEL — Brand Visual
             ============================ -->
        <div class="welcome-left">
            <div class="welcome-left-bg"></div>
            <div class="welcome-left-overlay"></div>

            <div class="welcome-left-content">
                <!-- Brand Logo -->
                <div class="brand-logo-area">
                    <span class="brand-label">Chef &amp; Catering</span>
                    <span class="brand-name-hero">Catering by Vii</span>
                    <span class="brand-line"></span>
                </div>

                <!-- Tagline -->
                <div class="welcome-tagline">
                    <h2>Rasa Terbaik<br>di Setiap Acara</h2>
                    <p>
                        Platform manajemen catering profesional — kelola menu, pesanan, dan
                        layanan Anda dalam satu dasbor yang elegan.
                    </p>
                </div>
            </div>

            <!-- Bottom bar inside left panel -->
            <div class="welcome-footer-bar">
                <span>&copy; {{ date('Y') }} Catering by Vii</span>
                <a href="/">Kunjungi Landing Page &rsaquo;</a>
            </div>
        </div>

        <!-- ============================
             RIGHT PANEL — Auth / Content
             ============================ -->
        <div class="welcome-right">
            <div class="welcome-right-inner">

                @auth
                    {{-- Logged in: Dashboard shortcut --}}
                    <div class="welcome-greeting">
                        <h1>Selamat Datang Kembali</h1>
                        <div class="divider-small">
                            <span></span>
                            <span></span>
                        </div>
                        <p>Anda telah masuk. Akses dasbor untuk mengelola catering Anda.</p>
                    </div>

                    <div class="dashboard-panel">
                        <div class="dashboard-panel-label">Akses Cepat</div>
                        <h3>Dasbor Saya</h3>
                        <a href="{{ url('/dashboard') }}" class="btn-primary-full">Buka Dasbor</a>
                    </div>

                @else
                    {{-- Guest: Login / Register --}}
                    <div class="welcome-greeting">
                        <h1>Masuk ke Akun Anda</h1>
                        <div class="divider-small">
                            <span></span>
                            <span></span>
                        </div>
                        <p>Akses platform manajemen catering eksklusif Anda.</p>
                    </div>

                    <div class="auth-actions">
                        @if (Route::has('login'))
                            <a href="{{ route('login') }}" class="btn-primary-full" id="btn-login">
                                Masuk
                            </a>
                        @endif

                        @if (Route::has('register'))
                            <div class="auth-or"><span>atau</span></div>
                            <a href="{{ route('register') }}" class="btn-secondary-full" id="btn-register">
                                Daftar Akun Baru
                            </a>
                        @endif
                    </div>
                @endauth

                <!-- Feature Highlights -->
                <div class="welcome-features">
                    <div class="welcome-features-title">Apa yang Anda Dapatkan</div>
                    <ul class="feature-list">
                        <li>Kelola menu dan paket catering dengan mudah</li>
                        <li>Lacak pesanan dan jadwal acara secara real-time</li>
                        <li>Laporan penjualan dan analitik bisnis</li>
                        <li>Tampilan profesional untuk klien Anda</li>
                    </ul>
                </div>

            </div>
        </div>

    </div><!-- end .welcome-wrapper -->
</body>
</html>
