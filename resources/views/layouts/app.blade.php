<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'CateringByVii') — Pelanggan</title>
    <meta name="description" content="@yield('meta_description', 'Platform pemesanan katering CateringByVii')">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --color-primary:     #2C1810;
            --color-primary-light: #4A2C1A;
            --color-accent:      #8B6914;
            --color-accent-warm: #C4922A;
            --color-bg:          #FAFAF8;
            --color-border:      #E8E3DC;
            --font-serif: 'Playfair Display', Georgia, serif;
            --font-sans:  'Inter', sans-serif;
        }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: var(--font-sans); background: var(--color-bg); min-height: 100vh; display: flex; flex-direction: column; }

        /* Navbar */
        .customer-navbar {
            background: var(--color-primary); position: sticky; top: 0; z-index: 100;
            box-shadow: 0 2px 8px rgba(0,0,0,0.25);
        }
        .navbar-inner {
            max-width: 1200px; margin: 0 auto; padding: 0 24px;
            display: flex; align-items: center; justify-content: space-between; height: 64px;
        }
        .navbar-brand {
            font-family: var(--font-serif); font-style: italic; font-size: 1.3rem;
            color: #fff; text-decoration: none; font-weight: 400;
        }
        .navbar-nav { display: flex; align-items: center; gap: 4px; }
        .navbar-link {
            padding: 8px 16px; color: rgba(255,255,255,0.75); text-decoration: none;
            font-size: 14px; border-radius: 6px; transition: all 0.2s;
        }
        .navbar-link:hover, .navbar-link.active {
            background: rgba(255,255,255,0.12); color: #fff;
        }
        .navbar-user {
            display: flex; align-items: center; gap: 12px; padding-left: 16px;
            border-left: 1px solid rgba(255,255,255,0.15);
        }
        .navbar-user-name { font-size: 13px; color: rgba(255,255,255,0.8); }
        .navbar-logout-btn {
            padding: 6px 14px; border: 1px solid rgba(255,255,255,0.25); background: transparent;
            color: rgba(255,255,255,0.75); border-radius: 6px; font-size: 13px;
            cursor: pointer; transition: all 0.2s; text-decoration: none;
            font-family: var(--font-sans);
        }
        .navbar-logout-btn:hover { background: rgba(255,255,255,0.15); color: #fff; }

        /* Page */
        .page-wrapper { flex: 1; max-width: 1200px; margin: 0 auto; padding: 32px 24px; width: 100%; }
        .page-header { margin-bottom: 28px; }
        .page-title {
            font-family: var(--font-serif); font-size: 1.8rem; font-weight: 400;
            color: var(--color-primary); margin-bottom: 4px;
        }
        .page-subtitle { font-size: 14px; color: #888; }
        .page-header-row { display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 28px; }

        /* Cards */
        .card {
            background: #fff; border: 1px solid var(--color-border);
            border-radius: 10px; padding: 24px;
        }
        .stat-card {
            background: #fff; border: 1px solid var(--color-border); border-radius: 10px;
            padding: 20px 24px; border-left: 4px solid var(--color-accent-warm);
        }
        .stat-card-label { font-size: 12px; text-transform: uppercase; letter-spacing: 0.08em; color: #888; margin-bottom: 8px; }
        .stat-card-value { font-size: 2rem; font-weight: 700; color: var(--color-primary); }

        /* Package Cards */
        .package-card {
            background: #fff; border: 1px solid var(--color-border); border-radius: 10px;
            overflow: hidden; transition: transform 0.2s, box-shadow 0.2s;
        }
        .package-card:hover { transform: translateY(-3px); box-shadow: 0 8px 24px rgba(44,24,16,0.1); }
        .package-card-img { height: 180px; background: linear-gradient(135deg, #f5ede0, #e8d4b8); display: flex; align-items: center; justify-content: center; }
        .package-card-img img { width: 100%; height: 100%; object-fit: cover; }
        .package-card-body { padding: 20px; }
        .package-card-name { font-family: var(--font-serif); font-size: 1.1rem; font-weight: 600; color: var(--color-primary); margin-bottom: 8px; }
        .package-card-desc { font-size: 13px; color: #666; line-height: 1.6; margin-bottom: 16px; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; }
        .package-card-price { font-size: 1.2rem; font-weight: 700; color: var(--color-accent); margin-bottom: 16px; }
        .package-card-footer { border-top: 1px solid #f0ece6; padding: 16px 20px; }

        /* Badges */
        .badge {
            display: inline-flex; align-items: center; padding: 3px 10px;
            border-radius: 100px; font-size: 11px; font-weight: 600;
        }
        .badge-warning { background: #fef9e7; color: #92650d; }
        .badge-success { background: #edf7f0; color: #1a7a40; }
        .badge-danger { background: #fdf0ef; color: #c0392b; }
        .badge-info { background: #eef4fd; color: #1a5fa8; }
        .badge-primary { background: #f0eaf8; color: #5c2d9e; }
        .badge-secondary { background: #f2f2f2; color: #666; }

        /* Tables */
        .data-table { width: 100%; border-collapse: collapse; }
        .data-table th {
            text-align: left; font-size: 11px; letter-spacing: 0.08em; text-transform: uppercase;
            color: #888; padding: 12px 16px; border-bottom: 2px solid #e8e3dc; font-weight: 600;
        }
        .data-table td { padding: 14px 16px; font-size: 14px; border-bottom: 1px solid #f0ece6; vertical-align: middle; }
        .data-table tr:last-child td { border-bottom: none; }
        .data-table tr:hover td { background: #faf8f5; }

        /* Buttons */
        .btn {
            display: inline-flex; align-items: center; gap: 6px; padding: 10px 20px;
            border-radius: 6px; font-size: 14px; font-weight: 500; text-decoration: none;
            cursor: pointer; border: none; transition: all 0.2s;
        }
        .btn-primary { background: var(--color-primary); color: #fff; }
        .btn-primary:hover { background: var(--color-primary-light); }
        .btn-accent { background: var(--color-accent-warm); color: #fff; }
        .btn-accent:hover { background: var(--color-accent); }
        .btn-outline { background: transparent; border: 1px solid var(--color-border); color: #555; }
        .btn-outline:hover { border-color: #999; }
        .btn-sm { padding: 7px 14px; font-size: 13px; }
        .btn-danger { background: #c0392b; color: #fff; }

        /* Forms */
        .form-group { margin-bottom: 20px; }
        .form-label { display: block; font-size: 13px; font-weight: 500; color: #444; margin-bottom: 6px; }
        .form-control {
            width: 100%; padding: 10px 14px; border: 1px solid #d0ccc5; border-radius: 6px;
            font-size: 14px; font-family: var(--font-sans); transition: border-color 0.2s;
        }
        .form-control:focus { outline: none; border-color: var(--color-accent); box-shadow: 0 0 0 3px rgba(139,105,20,0.1); }
        .form-error { font-size: 12px; color: #c0392b; margin-top: 4px; }
        .form-hint { font-size: 12px; color: #888; margin-top: 4px; }
        textarea.form-control { resize: vertical; min-height: 100px; }

        /* Alert */
        .alert-flash { padding: 12px 16px; border-radius: 6px; margin-bottom: 20px; font-size: 14px; }
        .alert-success { background: #edf7f0; border: 1px solid #a8ddb8; color: #1a7a40; }
        .alert-error { background: #fdf0ef; border: 1px solid #f5b7b1; color: #c0392b; }
        .alert-info { background: #eef4fd; border: 1px solid #aacbf5; color: #1a5fa8; }

        /* Status Timeline */
        .timeline { display: flex; align-items: center; gap: 0; margin: 24px 0; }
        .timeline-step {
            flex: 1; display: flex; flex-direction: column; align-items: center; position: relative;
        }
        .timeline-step:not(:last-child)::after {
            content: ''; position: absolute; top: 16px; left: 50%; width: 100%;
            height: 2px; background: #e8e3dc; z-index: 0;
        }
        .timeline-step.done::after { background: var(--color-accent-warm); }
        .timeline-dot {
            width: 32px; height: 32px; border-radius: 50%; background: #e8e3dc;
            display: flex; align-items: center; justify-content: center;
            font-size: 14px; font-weight: 700; color: #888;
            position: relative; z-index: 1; border: 2px solid #fff;
            box-shadow: 0 0 0 2px #e8e3dc;
        }
        .timeline-step.done .timeline-dot { background: var(--color-accent-warm); color: #fff; box-shadow: 0 0 0 2px var(--color-accent-warm); }
        .timeline-step.active .timeline-dot { background: var(--color-primary); color: #fff; box-shadow: 0 0 0 2px var(--color-primary); }
        .timeline-label { font-size: 11px; text-align: center; margin-top: 8px; color: #888; max-width: 80px; }
        .timeline-step.done .timeline-label, .timeline-step.active .timeline-label { color: var(--color-primary); font-weight: 500; }

        /* Grids */
        .grid-2 { display: grid; grid-template-columns: repeat(2, 1fr); gap: 24px; }
        .grid-3 { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; }
        .grid-4 { display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; }
        .d-flex { display: flex; }
        .flex-between { display: flex; justify-content: space-between; align-items: center; }
        .gap-2 { gap: 8px; }
        .gap-3 { gap: 12px; }
        .mb-4 { margin-bottom: 16px; }
        .mb-6 { margin-bottom: 24px; }
        .mt-4 { margin-top: 16px; }
        .text-muted { color: #888; font-size: 13px; }
        .fw-600 { font-weight: 600; }

        /* Footer */
        .customer-footer {
            background: var(--color-primary); color: rgba(255,255,255,0.5);
            text-align: center; padding: 20px; font-size: 12px; margin-top: auto;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="customer-navbar">
        <div class="navbar-inner">
            <a href="{{ route('customer.dashboard') }}" class="navbar-brand">CateringByVii</a>
            <div class="navbar-nav">
                <a href="{{ route('customer.dashboard') }}" class="navbar-link {{ request()->routeIs('customer.dashboard') ? 'active' : '' }}">Dashboard</a>
                <a href="{{ route('customer.packages.index') }}" class="navbar-link {{ request()->routeIs('customer.packages.*') ? 'active' : '' }}">Paket Katering</a>
                <a href="{{ route('customer.orders.index') }}" class="navbar-link {{ request()->routeIs('customer.orders.*') ? 'active' : '' }}">Pesanan Saya</a>
                <a href="{{ route('customer.announcements.index') }}" class="navbar-link {{ request()->routeIs('customer.announcements.*') ? 'active' : '' }}">Pengumuman</a>
            </div>
            <div class="navbar-user">
                <span class="navbar-user-name">{{ auth()->user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="navbar-logout-btn">Keluar</button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Content -->
    <div class="page-wrapper">
        @if(session('success'))
            <div class="alert-flash alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert-flash alert-error">{{ session('error') }}</div>
        @endif
        @if(session('info'))
            <div class="alert-flash alert-info">{{ session('info') }}</div>
        @endif

        @yield('content')
    </div>

    <footer class="customer-footer">
        &copy; {{ date('Y') }} CateringByVii — Sajian Terbaik di Setiap Acara
    </footer>

    <script>
        @if(session('success'))
            Swal.fire({ icon: 'success', title: 'Berhasil!', text: @json(session('success')), timer: 3000, showConfirmButton: false, toast: true, position: 'top-end' });
        @endif
        @if(session('error'))
            Swal.fire({ icon: 'error', title: 'Gagal!', text: @json(session('error')), timer: 4000, showConfirmButton: false, toast: true, position: 'top-end' });
        @endif
    </script>
    @yield('scripts')
</body>
</html>
