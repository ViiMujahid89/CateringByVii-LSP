<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Catering by Vii — Sajian Istimewa untuk Momen Anda</title>
    <meta name="description" content="Catering by Vii menghadirkan pengalaman kuliner premium untuk acara pernikahan, corporate, dan privat. Hidangan autentik dengan sentuhan chef profesional.">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,700;1,400;1,700&family=Cormorant+Garamond:ital,wght@0,300;0,400;1,300&family=Lato:wght@300;400;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* =============================================
           CATERING BY VII — DESIGN SYSTEM TOKENS
           ============================================= */
        :root {
            --color-primary:        #2C1810;
            --color-primary-light:  #4A2C1A;
            --color-accent:         #8B6914;
            --color-accent-warm:    #C4922A;
            --color-bg-light:       #FAFAF8;
            --color-bg-card:        #FFFFFF;
            --color-bg-overlay:     rgba(255, 255, 255, 0.93);
            --color-text-body:      #3D3D3D;
            --color-text-muted:     #888888;
            --color-text-light:     #FFFFFF;
            --color-border:         #D9D3C7;
            --color-border-dark:    #2C1810;

            --font-serif:   'Playfair Display', Georgia, serif;
            --font-serif-lg:'Cormorant Garamond', Georgia, serif;
            --font-sans:    'Lato', sans-serif;

            --max-width:    1200px;
            --section-pad:  100px;
            --section-pad-sm: 60px;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            background-color: var(--color-bg-light);
            color: var(--color-text-body);
            font-family: var(--font-sans);
            font-weight: 400;
            line-height: 1.7;
            overflow-x: hidden;
        }

        /* ---- REUSABLE UTILITIES ---- */
        .container {
            max-width: var(--max-width);
            margin: 0 auto;
            padding: 0 40px;
        }

        .section {
            padding: var(--section-pad) 0;
        }

        /* Divider dekoratif dua garis */
        .divider {
            display: flex;
            flex-direction: column;
            gap: 4px;
            margin: 20px 0;
        }
        .divider span {
            display: block;
            width: 38px;
            height: 2px;
            background-color: var(--color-border-dark);
        }
        .divider.centered {
            align-items: center;
        }
        .divider.light span { background-color: var(--color-border); }

        /* =============================================
           NAVBAR
           ============================================= */
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            background: var(--color-bg-card);
            border-bottom: 1px solid var(--color-border);
            height: 72px;
            display: flex;
            align-items: center;
            transition: box-shadow 0.3s ease;
        }

        .navbar.scrolled {
            box-shadow: 0 2px 20px rgba(44, 24, 16, 0.08);
        }

        .navbar .container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
        }

        .navbar-brand {
            display: flex;
            flex-direction: column;
            line-height: 1.1;
            text-decoration: none;
        }
        .navbar-brand .small-label {
            font-family: var(--font-serif);
            font-style: italic;
            font-size: 11px;
            color: var(--color-text-muted);
            letter-spacing: 0.05em;
        }
        .navbar-brand .brand-name {
            font-family: var(--font-serif);
            font-size: 22px;
            font-weight: 700;
            font-style: italic;
            color: var(--color-primary);
            letter-spacing: 0.02em;
        }
        .brand-underline {
            width: 38px;
            height: 2px;
            background: var(--color-primary);
            margin-top: 3px;
        }

        .navbar-nav {
            display: flex;
            align-items: center;
            gap: 36px;
            list-style: none;
        }
        .navbar-nav a {
            font-family: var(--font-sans);
            font-size: 14px;
            font-weight: 400;
            color: var(--color-text-body);
            text-decoration: none;
            letter-spacing: 0.04em;
            position: relative;
            padding-bottom: 2px;
            transition: color 0.25s;
        }
        .navbar-nav a::after {
            content: '';
            position: absolute;
            bottom: -1px;
            left: 0;
            width: 0;
            height: 1px;
            background: var(--color-accent);
            transition: width 0.3s ease;
        }
        .navbar-nav a:hover { color: var(--color-accent); }
        .navbar-nav a:hover::after { width: 100%; }

        .navbar-actions {
            display: flex;
            align-items: center;
            gap: 14px;
        }
        .btn-outline-dark {
            font-family: var(--font-sans);
            font-size: 13px;
            font-weight: 400;
            letter-spacing: 0.05em;
            color: var(--color-primary);
            border: 1px solid var(--color-border-dark);
            background: transparent;
            padding: 7px 20px;
            text-decoration: none;
            transition: background 0.25s, color 0.25s;
            cursor: pointer;
        }
        .btn-outline-dark:hover {
            background: var(--color-primary);
            color: var(--color-text-light);
        }
        .btn-dark {
            font-family: var(--font-sans);
            font-size: 13px;
            font-weight: 700;
            letter-spacing: 0.07em;
            color: var(--color-text-light);
            background: var(--color-primary);
            border: 1px solid var(--color-primary);
            padding: 8px 22px;
            text-decoration: none;
            text-transform: uppercase;
            transition: background 0.25s, border-color 0.25s;
            cursor: pointer;
        }
        .btn-dark:hover {
            background: var(--color-primary-light);
            border-color: var(--color-primary-light);
        }

        /* =============================================
           HERO SECTION
           ============================================= */
        .hero {
            position: relative;
            height: 100vh;
            min-height: 600px;
            display: flex;
            align-items: flex-end;
            padding-bottom: 80px;
            overflow: hidden;
        }

        .hero-bg {
            position: absolute;
            inset: 0;
            background-image: url('https://images.unsplash.com/photo-1414235077428-338989a2e8c0?w=1600&auto=format&fit=crop&q=80');
            background-size: cover;
            background-position: center;
            transform: scale(1.05);
            transition: transform 8s ease-out;
        }
        .hero-bg.loaded { transform: scale(1); }

        .hero-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(
                to bottom,
                rgba(0,0,0,0.15) 0%,
                rgba(0,0,0,0.25) 50%,
                rgba(0,0,0,0.5) 100%
            );
        }

        .hero-content {
            position: relative;
            z-index: 2;
            text-align: center;
            width: 100%;
        }

        .hero-title {
            font-family: var(--font-serif-lg);
            font-size: clamp(2.8rem, 6vw, 5.5rem);
            font-weight: 300;
            color: var(--color-text-light);
            letter-spacing: 0.12em;
            text-transform: uppercase;
            line-height: 1.15;
            margin-bottom: 28px;
            text-shadow: 0 2px 20px rgba(0,0,0,0.3);
        }

        .hero-divider {
            display: flex;
            justify-content: center;
            flex-direction: column;
            align-items: center;
            gap: 5px;
        }
        .hero-divider span {
            display: block;
            width: 34px;
            height: 1.5px;
            background: rgba(255,255,255,0.7);
        }

        /* Scroll indicator */
        .scroll-indicator {
            position: absolute;
            bottom: 30px;
            right: 30px;
            z-index: 10;
            display: flex;
            flex-direction: column;
            gap: 8px;
        }
        .scroll-dot {
            width: 8px;
            height: 8px;
            border: 1px solid rgba(255,255,255,0.6);
            border-radius: 50%;
            cursor: pointer;
            transition: background 0.25s;
        }
        .scroll-dot.active {
            background: rgba(255,255,255,0.9);
        }

        /* =============================================
           ABOUT / MEET THE CHEF SECTION
           ============================================= */
        .about-section {
            display: flex;
            min-height: 580px;
            background: var(--color-bg-card);
        }

        .about-photo {
            flex: 0 0 50%;
            position: relative;
            overflow: hidden;
            background: #e8e4df;
        }
        .about-photo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: top center;
            display: block;
        }

        .about-content {
            flex: 1;
            display: flex;
            align-items: center;
            padding: 80px 80px 80px 70px;
            background: var(--color-bg-card);
        }

        .about-inner { max-width: 420px; }

        .about-heading {
            font-family: var(--font-serif);
            font-size: 2.6rem;
            font-weight: 400;
            color: var(--color-primary);
            margin-bottom: 0;
        }

        .about-body {
            font-size: 14.5px;
            color: var(--color-text-body);
            line-height: 1.85;
            margin-bottom: 32px;
        }

        .about-contact {
            font-size: 13px;
            color: var(--color-text-muted);
            letter-spacing: 0.02em;
            border-top: 1px solid var(--color-border);
            padding-top: 20px;
        }
        .about-contact a {
            color: var(--color-accent);
            text-decoration: none;
        }
        .about-contact a:hover { text-decoration: underline; }

        /* =============================================
           MENU CARDS SECTION
           ============================================= */
        .menu-section {
            position: relative;
            padding: var(--section-pad) 0;
            overflow: hidden;
        }

        .menu-section-bg {
            position: absolute;
            inset: 0;
            background-image: url('https://images.unsplash.com/photo-1556909114-f6e7ad7d3136?w=1600&auto=format&fit=crop&q=80');
            background-size: cover;
            background-position: center;
            opacity: 0.25;
        }

        .menu-section > .container {
            position: relative;
            z-index: 2;
        }

        .menu-cards-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 28px;
        }

        .menu-card {
            background: var(--color-bg-card);
            padding: 48px 36px 40px;
            text-align: center;
            box-shadow: 0 4px 30px rgba(44, 24, 16, 0.08);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .menu-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 12px 40px rgba(44, 24, 16, 0.14);
        }

        .menu-card-icon {
            width: 90px;
            height: 90px;
            border: 1.5px solid var(--color-border-dark);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 24px;
            color: var(--color-primary);
        }
        .menu-card-icon svg {
            width: 40px;
            height: 40px;
            stroke: var(--color-primary);
            fill: none;
            stroke-width: 1.2;
        }

        .menu-card-title {
            font-family: var(--font-serif);
            font-size: 1.5rem;
            font-weight: 400;
            color: var(--color-accent);
            margin-bottom: 0;
            line-height: 1.3;
        }

        .menu-card .divider {
            margin: 14px auto;
            align-items: center;
        }

        .menu-card-desc {
            font-size: 13.5px;
            color: var(--color-text-muted);
            line-height: 1.7;
            margin-bottom: 24px;
        }

        .menu-card-link {
            font-size: 13px;
            color: var(--color-text-body);
            text-decoration: none;
            letter-spacing: 0.04em;
            transition: color 0.25s;
        }
        .menu-card-link:hover { color: var(--color-accent); }

        /* =============================================
           FARM TO TABLE / FEATURE BANNER
           ============================================= */
        .feature-section {
            position: relative;
            min-height: 600px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .feature-bg {
            position: absolute;
            inset: 0;
            background-image: url('https://images.unsplash.com/photo-1504674900247-0877df9cc836?w=1600&auto=format&fit=crop&q=80');
            background-size: cover;
            background-position: center;
        }

        .feature-panel {
            position: relative;
            z-index: 2;
            background: var(--color-bg-overlay);
            padding: 60px 70px;
            text-align: center;
            min-width: 420px;
            max-width: 520px;
        }

        .feature-heading {
            font-family: var(--font-serif);
            font-size: 2.2rem;
            font-weight: 400;
            color: var(--color-primary);
            margin-bottom: 6px;
        }

        .feature-subheading {
            font-family: var(--font-serif);
            font-size: 1rem;
            font-weight: 400;
            color: var(--color-text-body);
            line-height: 1.5;
            margin-bottom: 0;
        }
        .feature-subheading em { color: var(--color-accent); font-style: normal; }

        .feature-menu-list {
            list-style: none;
            margin: 24px 0 32px;
        }
        .feature-menu-list li {
            font-size: 13.5px;
            color: var(--color-text-body);
            padding: 4px 0;
            letter-spacing: 0.02em;
        }
        .feature-menu-list li.highlight { color: var(--color-accent); }

        .btn-outlined {
            display: inline-block;
            font-family: var(--font-sans);
            font-size: 13px;
            letter-spacing: 0.06em;
            color: var(--color-primary);
            border: 1px solid var(--color-primary);
            padding: 10px 30px;
            text-decoration: none;
            transition: background 0.25s, color 0.25s;
        }
        .btn-outlined:hover {
            background: var(--color-primary);
            color: var(--color-text-light);
        }

        /* =============================================
           TESTIMONIAL SECTION
           ============================================= */
        .testimonial-section {
            background: var(--color-bg-light);
            padding: var(--section-pad) 0;
            position: relative;
            overflow: hidden;
        }

        .testimonial-deco {
            position: absolute;
            top: 0; bottom: 0;
            width: 220px;
            opacity: 0.07;
            background-size: contain;
            background-repeat: no-repeat;
            background-position: center;
        }
        .testimonial-deco.left  { left: 0;  background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 200 400'%3E%3Cellipse cx='100' cy='200' rx='80' ry='180' stroke='%232C1810' stroke-width='2' fill='none'/%3E%3Cline x1='100' y1='20' x2='100' y2='380' stroke='%232C1810' stroke-width='1.5'/%3E%3Cline x1='20' y1='200' x2='180' y2='200' stroke='%232C1810' stroke-width='1.5'/%3E%3C/svg%3E"); }
        .testimonial-deco.right { right: 0; background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 200 400'%3E%3Crect x='20' y='40' width='160' height='200' rx='4' stroke='%232C1810' stroke-width='2' fill='none'/%3E%3Cpath d='M20 80 Q100 120 180 80' stroke='%232C1810' stroke-width='1.5' fill='none'/%3E%3C/svg%3E"); }

        .testimonial-inner {
            position: relative;
            z-index: 2;
            text-align: center;
            max-width: 660px;
            margin: 0 auto;
        }

        .quote-mark {
            font-family: var(--font-serif);
            font-size: 5rem;
            line-height: 0.6;
            color: var(--color-primary);
            display: block;
            margin-bottom: 28px;
            opacity: 0.85;
        }

        .testimonial-quote {
            font-family: var(--font-serif);
            font-size: 1.6rem;
            font-weight: 400;
            color: var(--color-primary);
            line-height: 1.5;
            margin-bottom: 32px;
        }

        .testimonial-avatar {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            overflow: hidden;
            margin: 0 auto 12px;
            border: 2px solid var(--color-border);
        }
        .testimonial-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .testimonial-author {
            font-size: 12.5px;
            letter-spacing: 0.06em;
            color: var(--color-text-muted);
        }

        /* =============================================
           FOOTER
           ============================================= */
        .footer {
            background: var(--color-primary);
            color: rgba(255,255,255,0.65);
            padding: 60px 0 40px;
        }

        .footer-grid {
            display: grid;
            grid-template-columns: 1.5fr 1fr 1fr;
            gap: 48px;
            margin-bottom: 48px;
        }

        .footer-brand-name {
            font-family: var(--font-serif);
            font-size: 1.3rem;
            font-weight: 700;
            font-style: italic;
            color: var(--color-text-light);
            margin-bottom: 12px;
        }
        .footer-brand-desc {
            font-size: 13px;
            line-height: 1.8;
        }

        .footer-heading {
            font-family: var(--font-serif);
            font-size: 0.85rem;
            font-weight: 700;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: var(--color-text-light);
            margin-bottom: 16px;
        }

        .footer-links {
            list-style: none;
        }
        .footer-links li { margin-bottom: 8px; }
        .footer-links a {
            font-size: 13px;
            color: rgba(255,255,255,0.55);
            text-decoration: none;
            transition: color 0.25s;
        }
        .footer-links a:hover { color: var(--color-text-light); }

        .footer-bottom {
            border-top: 1px solid rgba(255,255,255,0.1);
            padding-top: 28px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 12px;
        }

        /* =============================================
           ANIMATIONS
           ============================================= */
        .fade-in {
            opacity: 0;
            transform: translateY(24px);
            transition: opacity 0.7s ease, transform 0.7s ease;
        }
        .fade-in.visible {
            opacity: 1;
            transform: translateY(0);
        }
        .fade-in-delay-1 { transition-delay: 0.1s; }
        .fade-in-delay-2 { transition-delay: 0.2s; }
        .fade-in-delay-3 { transition-delay: 0.3s; }
    </style>
</head>
<body>
    <!-- =========================================
         NAVBAR
         ========================================= -->
    <nav class="navbar" id="navbar">
        <div class="container">
            <!-- Brand -->
            <a href="/" class="navbar-brand">
                <span class="small-label">Chef</span>
                <span class="brand-name">Catering by Vii</span>
                <span class="brand-underline"></span>
            </a>

            <!-- Nav Links -->
            <ul class="navbar-nav" id="nav-links">
                <li><a href="#beranda">Beranda</a></li>
                <li><a href="#tentang">Tentang Kami</a></li>
                <li><a href="#menu">Menu</a></li>
                <li><a href="#kontak">Kontak</a></li>
            </ul>

            <!-- Actions -->
            <div class="navbar-actions">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="btn-outline-dark">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="btn-outline-dark">Masuk</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn-dark">Daftar</a>
                        @endif
                    @endauth
                @endif
            </div>
        </div>
    </nav>

    <!-- =========================================
         HERO SECTION
         ========================================= -->
    <section class="hero" id="beranda">
        <div class="hero-bg" id="heroBg"></div>
        <div class="hero-overlay"></div>

        <div class="hero-content">
            <h1 class="hero-title">
                Sajian Istimewa<br>
                Untuk Momen Anda
            </h1>
            <div class="hero-divider">
                <span></span>
                <span></span>
            </div>
        </div>

        <!-- Scroll dots -->
        <div class="scroll-indicator">
            <div class="scroll-dot active" data-section="beranda"></div>
            <div class="scroll-dot" data-section="tentang"></div>
            <div class="scroll-dot" data-section="menu"></div>
            <div class="scroll-dot" data-section="feature"></div>
            <div class="scroll-dot" data-section="testimonial"></div>
        </div>
    </section>

    <!-- =========================================
         ABOUT / MEET THE CHEF
         ========================================= -->
    <section class="about-section" id="tentang">
        <div class="about-photo">
            <img
                src="https://images.unsplash.com/photo-1577219491135-ce391730fb2c?w=900&auto=format&fit=crop&q=80"
                alt="Chef Catering by Vii"
                loading="lazy"
            >
        </div>
        <div class="about-content">
            <div class="about-inner fade-in">
                <h2 class="about-heading">Tentang Kami</h2>
                <div class="divider">
                    <span></span>
                    <span></span>
                </div>
                <p class="about-body">
                    Catering by Vii hadir untuk memberikan pengalaman kuliner terbaik di setiap acara Anda.
                    Dengan sentuhan koki profesional dan bahan-bahan pilihan segar, kami menghadirkan
                    hidangan autentik yang memanjakan selera — mulai dari acara pernikahan, corporate event,
                    hingga jamuan privat eksklusif.
                </p>
                <div class="about-contact">
                    Telp: <a href="tel:+6281234567890">+62 812-3456-7890</a> &nbsp;|&nbsp;
                    Email: <a href="mailto:hello@cateringbyvii.id">hello@cateringbyvii.id</a>
                </div>
            </div>
        </div>
    </section>

    <!-- =========================================
         MENU CARDS SECTION
         ========================================= -->
    <section class="menu-section" id="menu">
        <div class="menu-section-bg"></div>
        <div class="container">
            <div class="menu-cards-grid">

                <!-- Card 1: Paket Pernikahan -->
                <div class="menu-card fade-in fade-in-delay-1">
                    <div class="menu-card-icon">
                        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2z"/>
                            <path d="M8 12l2 2 4-4"/>
                            <circle cx="12" cy="12" r="3"/>
                        </svg>
                    </div>
                    <h3 class="menu-card-title">Paket<br>Pernikahan</h3>
                    <div class="divider">
                        <span></span>
                        <span></span>
                    </div>
                    <p class="menu-card-desc">
                        Hidangan mewah 5–10 kursus untuk hari spesial Anda, dengan dekorasi sajian yang elegan
                    </p>
                    <a href="#" class="menu-card-link">Lihat Menu &rsaquo;</a>
                </div>

                <!-- Card 2: Pilihan Chef -->
                <div class="menu-card fade-in fade-in-delay-2">
                    <div class="menu-card-icon">
                        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 2a4 4 0 014 4v1h1a2 2 0 012 2v1H5V9a2 2 0 012-2h1V6a4 4 0 014-4z"/>
                            <rect x="3" y="11" width="18" height="2" rx="1"/>
                            <path d="M5 13v7a1 1 0 001 1h12a1 1 0 001-1v-7"/>
                        </svg>
                    </div>
                    <h3 class="menu-card-title">Pilihan<br>Chef</h3>
                    <div class="divider">
                        <span></span>
                        <span></span>
                    </div>
                    <p class="menu-card-desc">
                        Pilih bahan favorit Anda, chef kami akan meracik menu terbaik sesuai selera
                    </p>
                    <a href="#" class="menu-card-link">Lihat Menu &rsaquo;</a>
                </div>

                <!-- Card 3: Corporate Event -->
                <div class="menu-card fade-in fade-in-delay-3">
                    <div class="menu-card-icon">
                        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M19 3H5a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2V5a2 2 0 00-2-2z"/>
                            <path d="M9 9h6M9 12h6M9 15h4"/>
                        </svg>
                    </div>
                    <h3 class="menu-card-title">Corporate<br>Event</h3>
                    <div class="divider">
                        <span></span>
                        <span></span>
                    </div>
                    <p class="menu-card-desc">
                        Sajian profesional untuk rapat, seminar, dan acara perusahaan dengan kesan tak terlupakan
                    </p>
                    <a href="#" class="menu-card-link">Lihat Menu &rsaquo;</a>
                </div>

            </div>
        </div>
    </section>

    <!-- =========================================
         FARM TO TABLE / FEATURE BANNER
         ========================================= -->
    <section class="feature-section" id="feature">
        <div class="feature-bg"></div>
        <div class="feature-panel fade-in">
            <h2 class="feature-heading">Menu Andalan</h2>
            <p class="feature-subheading">
                Sekilas tentang <em>Menu Spesial</em><br>Musim Ini
            </p>
            <div class="divider centered">
                <span></span>
                <span></span>
            </div>
            <ul class="feature-menu-list">
                <li class="highlight">Soto Betawi Premium dengan Kuah Santan Segar</li>
                <li>Ayam Bakar Bumbu Rempah Nusantara</li>
                <li class="highlight">Rendang Wagyu dengan Kelapa Muda</li>
                <li>Gado-gado Segar dengan Bumbu Kacang Pilihan</li>
                <li class="highlight">Nasi Liwet dengan Lauk Pauk Tradisional</li>
                <li>Es Dawet Ayu & Minuman Tradisional Spesial</li>
            </ul>
            <a href="#menu" class="btn-outlined">Lihat Semua Menu</a>
        </div>
    </section>

    <!-- =========================================
         TESTIMONIAL SECTION
         ========================================= -->
    <section class="testimonial-section" id="testimonial">
        <div class="testimonial-deco left"></div>
        <div class="testimonial-deco right"></div>

        <div class="container">
            <div class="testimonial-inner fade-in">
                <span class="quote-mark">&ldquo;</span>
                <p class="testimonial-quote">
                    Makanan yang luar biasa enak.<br>
                    Chef yang ramah dan profesional.
                </p>
                <div class="testimonial-avatar">
                    <img
                        src="https://images.unsplash.com/photo-1580489944761-15a19d654956?w=200&auto=format&fit=crop&q=80"
                        alt="Pelanggan Catering by Vii"
                    >
                </div>
                <p class="testimonial-author">Siti Rahma, Jakarta</p>
            </div>
        </div>
    </section>

    <!-- =========================================
         FOOTER
         ========================================= -->
    <footer class="footer" id="kontak">
        <div class="container">
            <div class="footer-grid">
                <div>
                    <div class="footer-brand-name">Catering by Vii</div>
                    <p class="footer-brand-desc">
                        Menghadirkan pengalaman kuliner premium untuk setiap momen berharga Anda.
                        Dibuat dengan cinta dan bahan-bahan terbaik pilihan chef profesional.
                    </p>
                </div>
                <div>
                    <div class="footer-heading">Navigasi</div>
                    <ul class="footer-links">
                        <li><a href="#beranda">Beranda</a></li>
                        <li><a href="#tentang">Tentang Kami</a></li>
                        <li><a href="#menu">Menu</a></li>
                        <li><a href="#kontak">Kontak</a></li>
                    </ul>
                </div>
                <div>
                    <div class="footer-heading">Kontak</div>
                    <ul class="footer-links">
                        <li><a href="tel:+6281234567890">+62 812-3456-7890</a></li>
                        <li><a href="mailto:hello@cateringbyvii.id">hello@cateringbyvii.id</a></li>
                        <li>Jakarta, Indonesia</li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <span>&copy; {{ date('Y') }} Catering by Vii. Seluruh hak cipta dilindungi.</span>
                <span>Dibuat dengan &hearts; di Indonesia</span>
            </div>
        </div>
    </footer>

    <script>
        // Navbar scroll effect
        const navbar = document.getElementById('navbar');
        window.addEventListener('scroll', () => {
            navbar.classList.toggle('scrolled', window.scrollY > 40);
        });

        // Hero background parallax load
        const heroBg = document.getElementById('heroBg');
        window.addEventListener('load', () => {
            heroBg.classList.add('loaded');
        });

        // Fade-in on scroll (Intersection Observer)
        const fadeEls = document.querySelectorAll('.fade-in');
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.12 });
        fadeEls.forEach(el => observer.observe(el));

        // Scroll dots active state
        const sections = ['beranda', 'tentang', 'menu', 'feature', 'testimonial'];
        const dots = document.querySelectorAll('.scroll-dot');

        window.addEventListener('scroll', () => {
            let current = sections[0];
            sections.forEach(id => {
                const el = document.getElementById(id);
                if (el && window.scrollY >= el.offsetTop - 200) {
                    current = id;
                }
            });
            dots.forEach(dot => {
                dot.classList.toggle('active', dot.dataset.section === current);
            });
        });
    </script>
</body>
</html>
