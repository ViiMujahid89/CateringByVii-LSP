<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Akun Menunggu Verifikasi — CateringByVii</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;1,400&family=Inter:wght@400;500&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        :root { --color-primary: #2C1810; --color-accent-warm: #C4922A; --font-serif: 'Playfair Display', Georgia, serif; --font-sans: 'Inter', sans-serif; }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: var(--font-sans); min-height: 100vh; background: #FAFAF8; display: flex; align-items: center; justify-content: center; }
        .pending-card { background: #fff; border: 1px solid #e8e3dc; border-radius: 12px; padding: 48px 56px; max-width: 520px; width: 90%; text-align: center; }
        .pending-icon { width: 72px; height: 72px; background: #fef9e7; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 24px; }
        .pending-icon svg { width: 36px; height: 36px; color: var(--color-accent-warm); }
        .pending-brand { font-family: var(--font-serif); font-style: italic; font-size: 1.1rem; color: var(--color-primary); margin-bottom: 20px; }
        .pending-title { font-family: var(--font-serif); font-size: 1.6rem; font-weight: 400; color: var(--color-primary); margin-bottom: 12px; }
        .pending-desc { font-size: 14px; color: #666; line-height: 1.75; margin-bottom: 28px; }
        .pending-steps { background: #fafaf8; border: 1px solid #e8e3dc; border-radius: 8px; padding: 20px 24px; margin-bottom: 28px; text-align: left; }
        .pending-steps-title { font-size: 11px; letter-spacing: 0.1em; text-transform: uppercase; color: #aaa; margin-bottom: 12px; }
        .pending-step { display: flex; align-items: center; gap: 12px; font-size: 13px; color: #555; margin-bottom: 10px; }
        .pending-step:last-child { margin-bottom: 0; }
        .step-dot { width: 8px; height: 8px; border-radius: 50%; background: var(--color-accent-warm); flex-shrink: 0; }
        .btn-back { display: inline-block; padding: 11px 24px; background: var(--color-primary); color: #fff; text-decoration: none; border-radius: 6px; font-size: 13px; font-weight: 500; }
        .btn-back:hover { background: #4A2C1A; }
    </style>
</head>
<body>
    <div class="pending-card">
        <div class="pending-icon">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
        </div>
        <div class="pending-brand">CateringByVii</div>
        <h1 class="pending-title">Menunggu Verifikasi</h1>
        <p class="pending-desc">
            Terima kasih telah mendaftar! Akun Anda sedang dalam proses verifikasi oleh admin.<br>
            Anda akan dapat masuk setelah akun disetujui.
        </p>

        <div class="pending-steps">
            <div class="pending-steps-title">Proses Selanjutnya</div>
            <div class="pending-step"><span class="step-dot"></span> Admin akan meninjau data pendaftaran Anda</div>
            <div class="pending-step"><span class="step-dot"></span> Anda akan mendapatkan notifikasi status akun</div>
            <div class="pending-step"><span class="step-dot"></span> Setelah disetujui, Anda bisa login dan memesan</div>
        </div>

        @if(session('success'))
            <p style="font-size:13px;color:#1a7a40;background:#edf7f0;border:1px solid #a8ddb8;padding:10px 14px;border-radius:6px;margin-bottom:20px;">
                {{ session('success') }}
            </p>
        @endif

        <a href="{{ route('login') }}" class="btn-back" id="link-back-login">Coba Masuk</a>
    </div>
</body>
</html>
