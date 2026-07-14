<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Akun Menunggu Verifikasi — CateringByVii</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;1,400&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="pending-page">

    <div class="pending-wrap">
        {{-- ── Icon --}}
        <div class="pending-icon">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
        </div>

        {{-- ── Brand --}}
        <div class="pending-brand">CateringByVii</div>

        {{-- ── Title & desc --}}
        <h1 class="pending-title">Menunggu Verifikasi</h1>
        <p class="pending-desc">
            Terima kasih telah mendaftar! Akun Anda sedang dalam proses verifikasi oleh admin.<br>
            Anda akan dapat masuk setelah akun disetujui.
        </p>

        {{-- ── Steps --}}
        <div class="pending-steps">
            <div class="pending-steps-title">Proses Selanjutnya</div>
            <div class="pending-step">
                <span class="pending-step-num">1</span>
                Admin akan meninjau data pendaftaran Anda
            </div>
            <div class="pending-step">
                <span class="pending-step-num">2</span>
                Anda akan mendapatkan notifikasi status akun
            </div>
            <div class="pending-step">
                <span class="pending-step-num">3</span>
                Setelah disetujui, Anda bisa login dan memesan
            </div>
        </div>

        {{-- ── Flash message --}}
        @if(session('success'))
            <div class="alert-flash alert-success" style="text-align:left;">
                {{ session('success') }}
            </div>
        @endif

        {{-- ── CTA --}}
        <a href="{{ route('login') }}" class="btn btn-primary" id="link-back-login"
            style="width:100%;justify-content:center;display:flex;">
            Coba Masuk
        </a>
        <a href="{{ route('home') }}" class="pending-home-link">← Kembali ke Beranda</a>
    </div>

</body>
</html>
