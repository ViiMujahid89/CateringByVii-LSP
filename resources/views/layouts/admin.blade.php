<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'CateringByVii') — Panel Admin</title>
    <meta name="description" content="@yield('meta_description', 'Panel administrasi CateringByVii')">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --color-primary: #2C1810;
            --color-primary-light: #4A2C1A;
            --color-accent: #8B6914;
            --color-accent-warm: #C4922A;
            --color-sidebar-bg: #1a1008;
            --color-sidebar-text: rgba(255,255,255,0.75);
            --color-sidebar-hover: rgba(196,146,42,0.15);
            --color-sidebar-active: rgba(196,146,42,0.25);
            --font-serif: 'Playfair Display', Georgia, serif;
            --font-sans: 'Inter', sans-serif;
        }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: var(--font-sans); background: #f4f2ee; min-height: 100vh; }

        /* Sidebar */
        .admin-sidebar {
            position: fixed; top: 0; left: 0; width: 260px; height: 100vh;
            background: var(--color-sidebar-bg); display: flex; flex-direction: column;
            z-index: 100; overflow-y: auto;
        }
        .sidebar-brand {
            padding: 28px 24px; border-bottom: 1px solid rgba(255,255,255,0.08);
        }
        .sidebar-brand-label {
            font-size: 10px; letter-spacing: 0.15em; text-transform: uppercase;
            color: rgba(255,255,255,0.4); margin-bottom: 4px;
        }
        .sidebar-brand-name {
            font-family: var(--font-serif); font-style: italic; font-size: 1.3rem;
            color: #fff; font-weight: 400;
        }
        .sidebar-nav { flex: 1; padding: 16px 0; }
        .sidebar-section-title {
            font-size: 10px; letter-spacing: 0.12em; text-transform: uppercase;
            color: rgba(255,255,255,0.3); padding: 16px 24px 8px;
        }
        .sidebar-link {
            display: flex; align-items: center; gap: 12px; padding: 11px 24px;
            color: var(--color-sidebar-text); text-decoration: none;
            font-size: 14px; font-weight: 400; transition: all 0.2s;
            border-left: 3px solid transparent;
        }
        .sidebar-link:hover {
            background: var(--color-sidebar-hover);
            color: #fff; border-left-color: var(--color-accent-warm);
        }
        .sidebar-link.active {
            background: var(--color-sidebar-active);
            color: #fff; border-left-color: var(--color-accent-warm); font-weight: 500;
        }
        .sidebar-link svg { width: 18px; height: 18px; flex-shrink: 0; opacity: 0.7; }
        .sidebar-link.active svg, .sidebar-link:hover svg { opacity: 1; }
        .sidebar-footer {
            padding: 16px 24px; border-top: 1px solid rgba(255,255,255,0.08);
        }
        .sidebar-user-name { font-size: 13px; color: #fff; font-weight: 500; }
        .sidebar-user-role { font-size: 11px; color: rgba(255,255,255,0.4); margin-top: 2px; }
        .sidebar-logout {
            display: flex; align-items: center; gap: 8px; margin-top: 12px;
            padding: 8px 12px; color: rgba(255,255,255,0.5); text-decoration: none;
            font-size: 13px; border: 1px solid rgba(255,255,255,0.1);
            border-radius: 4px; transition: all 0.2s; background: transparent; width: 100%; cursor: pointer;
        }
        .sidebar-logout:hover { color: #fff; border-color: rgba(255,255,255,0.3); }

        /* Main Content */
        .admin-main { margin-left: 260px; min-height: 100vh; display: flex; flex-direction: column; }
        .admin-topbar {
            background: #fff; border-bottom: 1px solid #e8e3dc;
            padding: 16px 32px; display: flex; justify-content: space-between; align-items: center;
        }
        .admin-topbar-title { font-size: 1.1rem; font-weight: 600; color: var(--color-primary); }
        .admin-topbar-breadcrumb { font-size: 12px; color: #888; margin-top: 2px; }
        .admin-content { flex: 1; padding: 32px; }

        /* Cards */
        .card {
            background: #fff; border: 1px solid #e8e3dc; border-radius: 8px; padding: 24px;
        }
        .stat-card {
            background: #fff; border: 1px solid #e8e3dc; border-radius: 8px;
            padding: 20px 24px; position: relative; overflow: hidden;
        }
        .stat-card-label { font-size: 12px; text-transform: uppercase; letter-spacing: 0.08em; color: #888; margin-bottom: 8px; }
        .stat-card-value { font-size: 2rem; font-weight: 700; color: var(--color-primary); line-height: 1; }
        .stat-card-accent { position: absolute; top: 0; right: 0; width: 4px; height: 100%; background: var(--color-accent-warm); }

        /* Tables */
        .data-table { width: 100%; border-collapse: collapse; }
        .data-table th {
            text-align: left; font-size: 11px; letter-spacing: 0.08em; text-transform: uppercase;
            color: #888; padding: 12px 16px; border-bottom: 2px solid #e8e3dc; font-weight: 600;
        }
        .data-table td { padding: 14px 16px; font-size: 14px; border-bottom: 1px solid #f0ece6; vertical-align: middle; }
        .data-table tr:hover td { background: #faf8f5; }
        .data-table tr:last-child td { border-bottom: none; }

        /* Badges */
        .badge {
            display: inline-flex; align-items: center; padding: 3px 10px;
            border-radius: 100px; font-size: 11px; font-weight: 600; letter-spacing: 0.03em;
        }
        .badge-warning { background: #fef9e7; color: #92650d; }
        .badge-success { background: #edf7f0; color: #1a7a40; }
        .badge-danger { background: #fdf0ef; color: #c0392b; }
        .badge-info { background: #eef4fd; color: #1a5fa8; }
        .badge-primary { background: #f0eaf8; color: #5c2d9e; }
        .badge-secondary { background: #f2f2f2; color: #666; }

        /* Buttons */
        .btn {
            display: inline-flex; align-items: center; gap: 6px; padding: 8px 16px;
            border-radius: 6px; font-size: 13px; font-weight: 500; text-decoration: none;
            cursor: pointer; border: none; transition: all 0.2s; white-space: nowrap;
        }
        .btn-primary { background: var(--color-primary); color: #fff; }
        .btn-primary:hover { background: var(--color-primary-light); }
        .btn-accent { background: var(--color-accent-warm); color: #fff; }
        .btn-accent:hover { background: var(--color-accent); }
        .btn-success { background: #1a7a40; color: #fff; }
        .btn-success:hover { background: #156334; }
        .btn-danger { background: #c0392b; color: #fff; }
        .btn-danger:hover { background: #a93226; }
        .btn-outline { background: transparent; border: 1px solid #d0ccc5; color: #555; }
        .btn-outline:hover { border-color: #999; color: #333; }
        .btn-sm { padding: 5px 12px; font-size: 12px; }
        .btn-xs { padding: 3px 8px; font-size: 11px; }

        /* Forms */
        .form-group { margin-bottom: 20px; }
        .form-label { display: block; font-size: 13px; font-weight: 500; color: #444; margin-bottom: 6px; }
        .form-control {
            width: 100%; padding: 10px 14px; border: 1px solid #d0ccc5; border-radius: 6px;
            font-size: 14px; font-family: var(--font-sans); transition: border-color 0.2s;
            background: #fff; color: #333;
        }
        .form-control:focus { outline: none; border-color: var(--color-accent); box-shadow: 0 0 0 3px rgba(139,105,20,0.1); }
        .form-error { font-size: 12px; color: #c0392b; margin-top: 4px; }
        .form-hint { font-size: 12px; color: #888; margin-top: 4px; }

        /* Alert flash */
        .alert-flash {
            padding: 12px 16px; border-radius: 6px; margin-bottom: 20px; font-size: 14px;
        }
        .alert-success { background: #edf7f0; border: 1px solid #a8ddb8; color: #1a7a40; }
        .alert-error { background: #fdf0ef; border: 1px solid #f5b7b1; color: #c0392b; }
        .alert-info { background: #eef4fd; border: 1px solid #aacbf5; color: #1a5fa8; }

        /* Pagination */
        .pagination-wrapper { display: flex; justify-content: center; margin-top: 24px; }

        /* Grid */
        .grid-2 { display: grid; grid-template-columns: repeat(2, 1fr); gap: 24px; }
        .grid-3 { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; }
        .grid-4 { display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; }
        .flex-between { display: flex; justify-content: space-between; align-items: center; }
        .mb-4 { margin-bottom: 16px; }
        .mb-6 { margin-bottom: 24px; }
        .mt-4 { margin-top: 16px; }
        .gap-2 { gap: 8px; }
        .d-flex { display: flex; }
        .flex-wrap { flex-wrap: wrap; }
        .text-muted { color: #888; font-size: 13px; }
        .text-sm { font-size: 13px; }
        .fw-600 { font-weight: 600; }
        .section-title {
            font-family: var(--font-serif); font-size: 1.2rem; font-weight: 400;
            color: var(--color-primary); margin-bottom: 4px;
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <aside class="admin-sidebar">
        <div class="sidebar-brand">
            <div class="sidebar-brand-label">Admin Panel</div>
            <div class="sidebar-brand-name">CateringByVii</div>
        </div>

        <nav class="sidebar-nav">
            <div class="sidebar-section-title">Utama</div>
            <a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                Dashboard
            </a>

            <div class="sidebar-section-title">Verifikasi</div>
            <a href="{{ route('admin.users.index') }}" class="sidebar-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                Verifikasi Akun
                @php $pendingUsers = \App\Models\User::where('role','pelanggan')->where('status','pending')->count(); @endphp
                @if($pendingUsers > 0)
                    <span style="margin-left:auto;background:#c4922a;color:#fff;border-radius:10px;font-size:10px;padding:2px 7px;font-weight:700;">{{ $pendingUsers }}</span>
                @endif
            </a>
            <a href="{{ route('admin.orders.index') }}" class="sidebar-link {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                Verifikasi Pesanan
                @php $pendingOrders = \App\Models\Order::where('status','pending')->count(); @endphp
                @if($pendingOrders > 0)
                    <span style="margin-left:auto;background:#c4922a;color:#fff;border-radius:10px;font-size:10px;padding:2px 7px;font-weight:700;">{{ $pendingOrders }}</span>
                @endif
            </a>
            <a href="{{ route('admin.payments.index') }}" class="sidebar-link {{ request()->routeIs('admin.payments.*') ? 'active' : '' }}">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>
                Verifikasi Pembayaran
                @php $pendingPayments = \App\Models\Payment::where('status','pending')->count(); @endphp
                @if($pendingPayments > 0)
                    <span style="margin-left:auto;background:#c4922a;color:#fff;border-radius:10px;font-size:10px;padding:2px 7px;font-weight:700;">{{ $pendingPayments }}</span>
                @endif
            </a>

            <div class="sidebar-section-title">Konten</div>
            <a href="{{ route('admin.announcements.index') }}" class="sidebar-link {{ request()->routeIs('admin.announcements.*') ? 'active' : '' }}">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/></svg>
                Pengumuman
            </a>
        </nav>

        <div class="sidebar-footer">
            <div class="sidebar-user-name">{{ auth()->user()->name }}</div>
            <div class="sidebar-user-role">Administrator</div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="sidebar-logout">
                    <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                    Keluar
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="admin-main">
        <div class="admin-topbar">
            <div>
                <div class="admin-topbar-title">@yield('page_title', 'Dashboard')</div>
                <div class="admin-topbar-breadcrumb">@yield('breadcrumb', 'Admin / Dashboard')</div>
            </div>
            <div class="d-flex gap-2">
                @yield('topbar_actions')
            </div>
        </div>

        <div class="admin-content">
            {{-- Flash Messages --}}
            @if(session('success'))
                <div class="alert-flash alert-success" id="flash-msg">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert-flash alert-error" id="flash-msg">{{ session('error') }}</div>
            @endif
            @if(session('info'))
                <div class="alert-flash alert-info" id="flash-msg">{{ session('info') }}</div>
            @endif

            @yield('content')
        </div>
    </main>

    <script>
        // SweetAlert flash messages
        @if(session('success'))
            Swal.fire({ icon: 'success', title: 'Berhasil!', text: @json(session('success')), timer: 3000, showConfirmButton: false, toast: true, position: 'top-end' });
        @endif
        @if(session('error'))
            Swal.fire({ icon: 'error', title: 'Gagal!', text: @json(session('error')), timer: 4000, showConfirmButton: false, toast: true, position: 'top-end' });
        @endif

        // Confirm delete
        document.querySelectorAll('[data-confirm]').forEach(el => {
            el.addEventListener('click', function(e) {
                e.preventDefault();
                const form = document.getElementById(el.dataset.form);
                Swal.fire({
                    title: el.dataset.confirm || 'Yakin?',
                    text: el.dataset.confirmText || 'Tindakan ini tidak bisa dibatalkan.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#c0392b',
                    cancelButtonColor: '#888',
                    confirmButtonText: 'Ya, lanjutkan',
                    cancelButtonText: 'Batal',
                }).then(result => { if (result.isConfirmed && form) form.submit(); });
            });
        });
    </script>

    @yield('scripts')
</body>
</html>
