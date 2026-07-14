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
                <div class="navbar-dropdown-wrap" id="navbar-dropdown-wrap">
                    <button class="navbar-user-btn" id="navbar-user-btn" onclick="toggleNavDropdown()" aria-haspopup="true" aria-expanded="false">
                        <span class="navbar-user-name">{{ auth()->user()->name }}</span>
                        <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" style="opacity:.6;transition:transform .2s;" id="navbar-chevron">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>

                    <div class="navbar-dropdown" id="navbar-dropdown" role="menu">
                        <a href="{{ route('customer.profile') }}" class="navbar-dropdown-item" role="menuitem">
                            <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                            Akun Saya
                        </a>
                        <div class="navbar-dropdown-divider"></div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="navbar-dropdown-item navbar-dropdown-item--danger" role="menuitem">
                                <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                                Keluar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Content -->
    @hasSection('full_page')
        @if(session('success') || session('error') || session('info'))
            <div style="max-width:1200px;margin:0 auto;padding:16px 24px 0;">
                @if(session('success'))<div class="alert-flash alert-success">{{ session('success') }}</div>@endif
                @if(session('error'))<div class="alert-flash alert-error">{{ session('error') }}</div>@endif
                @if(session('info'))<div class="alert-flash alert-info">{{ session('info') }}</div>@endif
            </div>
        @endif
        @yield('content')
    @else
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
    @endif

    <!-- Footer -->
    <footer class="site-footer">
        <div class="footer-inner">
            <div class="footer-col">
                <div class="footer-brand">CateringByVii</div>
                <p class="footer-desc">Platform pemesanan katering profesional untuk sajian terbaik di setiap acara Anda.</p>
            </div>
            <div class="footer-col">
                <div class="footer-col-title">Menu</div>
                <ul class="footer-links">
                    <li><a href="{{ route('customer.dashboard') }}">Dashboard</a></li>
                    <li><a href="{{ route('customer.packages.index') }}">Paket Katering</a></li>
                    <li><a href="{{ route('customer.orders.index') }}">Pesanan Saya</a></li>
                    <li><a href="{{ route('customer.announcements.index') }}">Pengumuman</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <div class="footer-col-title">Jam Operasional</div>
                <ul class="footer-links">
                    <li>Senin – Jumat: 08.00 – 20.00</li>
                    <li>Sabtu: 08.00 – 18.00</li>
                    <li>Minggu: 09.00 – 15.00</li>
                </ul>
            </div>
            <div class="footer-col">
                <div class="footer-col-title">Hubungi Kami</div>
                <ul class="footer-links">
                    <li>📞 +62 812 3456 7890</li>
                    <li>📧 info@cateringbyvii.com</li>
                    <li>📍 Jakarta, Indonesia</li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            &copy; {{ date('Y') }} CateringByVii — Sajian Terbaik di Setiap Acara
        </div>
    </footer>

    <script>
        @if(session('success'))
            Swal.fire({ icon: 'success', title: 'Berhasil!', text: @json(session('success')), timer: 3000, showConfirmButton: false, toast: true, position: 'top-end' });
        @endif
        @if(session('error'))
            Swal.fire({ icon: 'error', title: 'Gagal!', text: @json(session('error')), timer: 4000, showConfirmButton: false, toast: true, position: 'top-end' });
        @endif

        /* ── Navbar User Dropdown ── */
        function toggleNavDropdown() {
            const wrap   = document.getElementById('navbar-dropdown-wrap');
            const btn    = document.getElementById('navbar-user-btn');
            const chev   = document.getElementById('navbar-chevron');
            const isOpen = wrap.classList.toggle('open');
            btn.setAttribute('aria-expanded', isOpen);
            chev.style.transform = isOpen ? 'rotate(180deg)' : '';
        }

        document.addEventListener('click', function(e) {
            const wrap = document.getElementById('navbar-dropdown-wrap');
            if (wrap && !wrap.contains(e.target)) {
                wrap.classList.remove('open');
                const btn  = document.getElementById('navbar-user-btn');
                const chev = document.getElementById('navbar-chevron');
                if (btn)  btn.setAttribute('aria-expanded', 'false');
                if (chev) chev.style.transform = '';
            }
        });
    </script>
    @yield('scripts')
</body>
</html>
