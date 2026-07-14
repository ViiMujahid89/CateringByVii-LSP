@extends('layouts.app')

@section('title', 'Dashboard — CateringByVii')
@section('meta_description', 'Dashboard pelanggan CateringByVii — pesan paket katering terbaik untuk acara Anda.')
@section('full_page', true)

@section('content')

{{-- ================================================================
     HERO SLIDER — 3 slide yang berganti-ganti otomatis

     ✏️  CARA MENGGANTI GAMBAR & TEKS:
     Setiap slide ada di dalam <div class="hero-slide">...</div>
     Ganti nilai 'background-image: url(...)' di style= setiap slide
     untuk mengubah gambar. Ganti juga teks judul, subtitle, dan
     URL tombol sesuai kebutuhan Anda.
     ================================================================ --}}
<section class="hero-section" id="hero-slider">

    {{-- ============================================================
         DAFTAR SLIDE — Edit bagian ini untuk mengubah isi slider

         Untuk setiap slide, Anda bisa mengganti:
           • background-image: url('URL_GAMBAR_ANDA') di style=
           • hero-eyebrow  : teks kecil di atas judul
           • hero-title    : judul besar (huruf kapital)
           • hero-subtitle : teks deskripsi di bawah judul
           • href pada tombol pertama (Aksi Utama)
           • Teks tombol pertama dan kedua
         ============================================================ --}}

    {{-- ===== SLIDE 1 ===== --}}
    {{-- 💡 Ganti URL gambar di bawah ini dengan foto katering milik Anda --}}
    <div class="hero-slide active"
         style="background-image: url('https://images.unsplash.com/photo-1555244162-803834f70033?w=1600&auto=format&fit=crop&q=80')">
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <div class="hero-text">
                {{-- 💡 Ganti teks sambutan di bawah ini --}}
                <div class="hero-eyebrow">Selamat Datang, {{ auth()->user()->name }}!</div>
                {{-- 💡 Ganti judul utama slide 1 --}}
                <h2 class="hero-title">CATERING BY VII</h2>
                {{-- 💡 Ganti subtitle slide 1 --}}
                <p class="hero-subtitle">SAJIAN TERBAIK DI<br>SETIAP ACARA ANDA</p>
                <div class="hero-actions">
                    {{-- 💡 Ganti href dan teks tombol utama slide 1 --}}
                    <a href="{{ route('customer.packages.index') }}" class="hero-btn-primary" id="btn-hero-pesan">
                        PESAN SEKARANG
                    </a>
                    {{-- 💡 Ganti href dan teks tombol sekunder slide 1 --}}
                    <a href="{{ route('customer.orders.index') }}" class="hero-btn-secondary">
                        Pesanan Saya
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- ===== SLIDE 2 ===== --}}
    {{-- 💡 Ganti URL gambar di bawah ini dengan foto katering milik Anda --}}
    <div class="hero-slide"
         style="background-image: url('https://images.unsplash.com/photo-1467003909585-2f8a72700288?w=1600&auto=format&fit=crop&q=80')">
        <div class="hero-overlay" style="background: linear-gradient(105deg, rgba(26,47,20,0.88) 0%, rgba(26,47,20,0.65) 55%, rgba(26,47,20,0.15) 100%);"></div>
        <div class="hero-content">
            <div class="hero-text">
                {{-- 💡 Ganti eyebrow slide 2 --}}
                <div class="hero-eyebrow">Menu Spesial Kami</div>
                {{-- 💡 Ganti judul utama slide 2 --}}
                <h2 class="hero-title">HIDANGAN<br>PILIHAN CHEF</h2>
                {{-- 💡 Ganti subtitle slide 2 --}}
                <p class="hero-subtitle">DIMASAK DENGAN BAHAN SEGAR<br>SETIAP HARINYA</p>
                <div class="hero-actions">
                    {{-- 💡 Ganti href dan teks tombol utama slide 2 --}}
                    <a href="{{ route('customer.packages.index') }}" class="hero-btn-primary">
                        LIHAT MENU
                    </a>
                    {{-- 💡 Ganti href dan teks tombol sekunder slide 2 --}}
                    <a href="{{ route('customer.announcements.index') }}" class="hero-btn-secondary">
                        Info Promo
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- ===== SLIDE 3 ===== --}}
    {{-- 💡 Ganti URL gambar di bawah ini dengan foto katering milik Anda --}}
    <div class="hero-slide"
         style="background-image: url('https://images.unsplash.com/photo-1414235077428-338989a2e8c0?w=1600&auto=format&fit=crop&q=80')">
        <div class="hero-overlay" style="background: linear-gradient(105deg, rgba(100,50,10,0.88) 0%, rgba(100,50,10,0.65) 55%, rgba(100,50,10,0.15) 100%);"></div>
        <div class="hero-content">
            <div class="hero-text">
                {{-- 💡 Ganti eyebrow slide 3 --}}
                <div class="hero-eyebrow">Untuk Acara Spesial Anda</div>
                {{-- 💡 Ganti judul utama slide 3 --}}
                <h2 class="hero-title">KATERING<br>EKSKLUSIF</h2>
                {{-- 💡 Ganti subtitle slide 3 --}}
                <p class="hero-subtitle">UNTUK PERNIKAHAN, ULANG TAHUN<br>DAN ACARA KORPORAT</p>
                <div class="hero-actions">
                    {{-- 💡 Ganti href dan teks tombol utama slide 3 --}}
                    <a href="{{ route('customer.packages.index') }}" class="hero-btn-primary">
                        KONSULTASI MENU
                    </a>
                    {{-- 💡 Ganti href dan teks tombol sekunder slide 3 --}}
                    <a href="{{ route('customer.orders.index') }}" class="hero-btn-secondary">
                        Cek Pesanan
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- Tombol navigasi kiri & kanan --}}
    <button class="hero-arrow hero-arrow-left" id="btn-slide-prev" aria-label="Slide sebelumnya">&#8249;</button>
    <button class="hero-arrow hero-arrow-right" id="btn-slide-next" aria-label="Slide berikutnya">&#8250;</button>

    {{-- Dot indicator di bawah slider --}}
    <div class="hero-dots">
        <button class="hero-dot active" data-slide="0" aria-label="Slide 1"></button>
        <button class="hero-dot" data-slide="1" aria-label="Slide 2"></button>
        <button class="hero-dot" data-slide="2" aria-label="Slide 3"></button>
    </div>
</section>

{{-- ================================================================
     STATS STRIP
     ================================================================ --}}
<section class="stats-strip">
    <div class="strip-inner">
        <div class="strip-item">
            <div class="strip-icon">
                <svg width="28" height="28" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
            </div>
            <div>
                <div class="strip-val">{{ $stats['total_orders'] }}</div>
                <div class="strip-label">Total Pesanan</div>
            </div>
        </div>
        <div class="strip-divider"></div>
        <div class="strip-item">
            <div class="strip-icon" style="color:#1a5fa8;background:#eef4fd;">
                <svg width="28" height="28" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <div>
                <div class="strip-val" style="color:#1a5fa8;">{{ $stats['active_orders'] }}</div>
                <div class="strip-label">Pesanan Aktif</div>
            </div>
        </div>
        <div class="strip-divider"></div>
        <div class="strip-item">
            <div class="strip-icon" style="color:#1a7a40;background:#edf7f0;">
                <svg width="28" height="28" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <div>
                <div class="strip-val" style="color:#1a7a40;">{{ $stats['completed_orders'] }}</div>
                <div class="strip-label">Pesanan Selesai</div>
            </div>
        </div>
        <div class="strip-divider"></div>
        <div class="strip-item">
            <div class="strip-icon" style="color:#C4922A;background:#fef9e7;">
                <svg width="28" height="28" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>
            </div>
            <div>
                <div class="strip-val" style="color:#C4922A;">{{ $featuredPackages->count() }}</div>
                <div class="strip-label">Paket Tersedia</div>
            </div>
        </div>
    </div>
</section>

{{-- ================================================================
     FEATURED PACKAGES — Like "Weekly Deals" in Fresh Market
     ================================================================ --}}
<section class="packages-section">
    <div class="section-container">
        <div class="section-header">
            <h2 class="section-title">Paket Unggulan</h2>
            <p class="section-subtitle">Pilih paket katering yang sesuai dengan kebutuhan acara Anda. Kualitas terjamin, harga terjangkau.</p>
        </div>

        <div class="packages-slider-wrap">
            <button class="slider-arrow" id="pkg-prev" onclick="pkgSlide(-1)" aria-label="Previous">&#8249;</button>

            <div class="packages-viewport" id="packages-viewport">
                <div class="packages-track" id="packages-track">
                    @forelse($featuredPackages as $package)
                        <div class="pkg-card">
                            <div class="pkg-card-badge">Tersedia</div>
                            <div class="pkg-card-img">
                                @if($package->image)
                                    <img src="{{ asset('storage/' . $package->image) }}" alt="{{ $package->name }}">
                                @else
                                    <div class="pkg-card-img-placeholder">
                                        <svg width="40" height="40" fill="none" viewBox="0 0 24 24" stroke="#C4922A" stroke-width="1" opacity="0.5"><path stroke-linecap="round" stroke-linejoin="round" d="M21 15.546c-.523 0-1.046.151-1.5.454a2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.704 2.704 0 01-3 0A1.5 1.5 0 013 15.546V12a9 9 0 0118 0v3.546z"/></svg>
                                    </div>
                                @endif
                            </div>
                            <div class="pkg-card-body">
                                <div class="pkg-card-name">{{ $package->name }}</div>
                                <div class="pkg-card-line"></div>
                                <div class="pkg-card-price">Rp {{ number_format($package->price, 0, ',', '.') }}</div>
                            </div>
                            <div class="pkg-card-footer">
                                <a href="{{ route('customer.orders.create', $package) }}"
                                    class="pkg-order-btn" id="btn-pkg-{{ $package->id }}">
                                    Pesan
                                </a>
                            </div>
                        </div>
                    @empty
                        <div style="padding:60px;text-align:center;color:#aaa;width:100%;">Belum ada paket tersedia.</div>
                    @endforelse
                </div>
            </div>

            <button class="slider-arrow" id="pkg-next" onclick="pkgSlide(1)" aria-label="Next">&#8250;</button>
        </div>

        <div style="text-align:center;margin-top:32px;">
            <a href="{{ route('customer.packages.index') }}" class="btn-view-all">Lihat Semua Paket &rarr;</a>
        </div>
    </div>
</section>

{{-- ================================================================
     FITUR LAYANAN — Like the 3-column feature section
     ================================================================ --}}
<section class="features-section">
    <div class="section-container">
        <div class="features-grid">
            <div class="feature-item">
                <div class="feature-icon">
                    <svg width="40" height="40" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                </div>
                <h3 class="feature-title">Pesan dengan Mudah</h3>
                <p class="feature-desc">Pilih paket katering favorit Anda dan buat pesanan dalam beberapa langkah mudah. Tidak perlu antri atau telepon.</p>
            </div>
            <div class="feature-divider"></div>
            <div class="feature-item">
                <div class="feature-icon">
                    <svg width="40" height="40" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/>
                    </svg>
                </div>
                <h3 class="feature-title">Pengiriman ke Lokasi</h3>
                <p class="feature-desc">Katering kami siap diantar langsung ke lokasi acara Anda. Tepat waktu dan tersaji dengan rapi sesuai jadwal.</p>
            </div>
            <div class="feature-divider"></div>
            <div class="feature-item">
                <div class="feature-icon">
                    <svg width="40" height="40" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                    </svg>
                </div>
                <h3 class="feature-title">Kualitas Terjamin</h3>
                <p class="feature-desc">Bahan-bahan segar dipilih setiap hari. Dimasak oleh tim chef berpengalaman dengan standar kebersihan yang ketat.</p>
            </div>
        </div>
    </div>
</section>

{{-- ================================================================
     RECENT ORDERS + ANNOUNCEMENTS
     ================================================================ --}}
<section class="info-section">
    <div class="section-container">
        <div class="info-grid">
            {{-- Recent Orders --}}
            <div class="info-card">
                <div class="info-card-header">
                    <div class="info-card-title">Pesanan Terbaru</div>
                    <a href="{{ route('customer.orders.index') }}" class="info-card-link">Lihat Semua &rarr;</a>
                </div>
                @forelse($recentOrders as $order)
                    <div class="order-row">
                        <div class="order-row-left">
                            <div class="order-row-pkg">{{ $order->package->name }}</div>
                            <div class="order-row-meta">{{ $order->event_date->format('d M Y') }} &middot; {{ $order->quantity }} porsi</div>
                        </div>
                        <div class="order-row-right">
                            <span class="badge badge-{{ $order->status_badge }}">{{ $order->status_label }}</span>
                            <div class="order-row-price">Rp {{ number_format($order->total_price, 0, ',', '.') }}</div>
                        </div>
                    </div>
                @empty
                    <div class="empty-state">
                        <div class="text-4xl mb-3">📋</div>
                        <div>Belum ada pesanan.</div>
                        <a href="{{ route('customer.packages.index') }}" class="text-[#C4922A] text-sm mt-2 inline-block">Mulai pesan sekarang →</a>
                    </div>
                @endforelse
            </div>

            {{-- Announcements --}}
            <div class="info-card">
                <div class="info-card-header">
                    <div class="info-card-title">Pengumuman</div>
                    <a href="{{ route('customer.announcements.index') }}" class="info-card-link">Lihat Semua &rarr;</a>
                </div>
                @forelse($latestAnnouncements as $ann)
                    <a href="{{ route('customer.announcements.show', $ann) }}" class="ann-row">
                        <div class="ann-row-img">
                            @if($ann->image)
                                <img src="{{ asset('storage/' . $ann->image) }}" alt="{{ $ann->title }}">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-xl bg-[#f5ede0]">📢</div>
                            @endif
                        </div>
                        <div class="ann-row-body">
                            <div class="ann-row-title">{{ $ann->title }}</div>
                            <div class="ann-row-date">{{ $ann->created_at->format('d M Y') }}</div>
                            <div class="ann-row-excerpt">{{ Str::limit($ann->content, 70) }}</div>
                        </div>
                    </a>
                @empty
                    <div class="empty-state">
                        <div class="text-4xl mb-3">📢</div>
                        <div>Belum ada pengumuman.</div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</section>

@endsection

@section('scripts')
<script>
/* ================================================================
   HERO SLIDER — Konfigurasi di sini

   heroAutoplay : true  = slider berpindah otomatis
                  false = tidak otomatis (hanya dengan tombol)

   heroInterval : waktu antar slide dalam milidetik
                  4000 = 4 detik, 6000 = 6 detik
   ================================================================ */
const heroAutoplay = true;   // 💡 Ubah ke false jika tidak mau auto-play
const heroInterval = 5000;   // 💡 Ubah angka ini untuk mempercepat/memperlambat

const slides = document.querySelectorAll('.hero-slide');
const dots   = document.querySelectorAll('.hero-dot');
let   currentSlide = 0;
let   autoplayTimer = null;

/* Fungsi berpindah ke slide tertentu berdasarkan index */
function goToSlide(index) {
    // Sembunyikan slide aktif
    slides[currentSlide].classList.remove('active');
    dots[currentSlide].classList.remove('active');

    // Hitung index slide berikutnya (looping)
    currentSlide = (index + slides.length) % slides.length;

    // Tampilkan slide baru dengan animasi
    slides[currentSlide].classList.add('active');
    dots[currentSlide].classList.add('active');

    // Jalankan ulang animasi teks
    const text = slides[currentSlide].querySelector('.hero-text');
    if (text) {
        text.style.animation = 'none';
        text.offsetHeight; // trigger reflow
        text.style.animation = '';
    }
}

/* Slide ke kiri (mundur) */
function heroPrev() {
    goToSlide(currentSlide - 1);
    resetAutoplay();
}

/* Slide ke kanan (maju) */
function heroNext() {
    goToSlide(currentSlide + 1);
    resetAutoplay();
}

/* Reset timer autoplay setelah interaksi manual */
function resetAutoplay() {
    if (!heroAutoplay) return;
    clearInterval(autoplayTimer);
    autoplayTimer = setInterval(() => goToSlide(currentSlide + 1), heroInterval);
}

/* Pasang event listener ke tombol panah */
document.getElementById('btn-slide-prev').addEventListener('click', heroPrev);
document.getElementById('btn-slide-next').addEventListener('click', heroNext);

/* Pasang event listener ke setiap dot */
dots.forEach(dot => {
    dot.addEventListener('click', function() {
        goToSlide(parseInt(this.dataset.slide));
        resetAutoplay();
    });
});

/* Dukungan swipe touch untuk mobile */
let touchStartX = 0;
const heroEl = document.getElementById('hero-slider');
heroEl.addEventListener('touchstart', e => { touchStartX = e.changedTouches[0].screenX; }, { passive: true });
heroEl.addEventListener('touchend', e => {
    const diff = touchStartX - e.changedTouches[0].screenX;
    if (Math.abs(diff) > 40) { diff > 0 ? heroNext() : heroPrev(); }
});

/* Mulai autoplay jika diaktifkan */
if (heroAutoplay) {
    autoplayTimer = setInterval(() => goToSlide(currentSlide + 1), heroInterval);
}

/* ================================================================
   PACKAGE SLIDER — Slider paket di bawah hero
   ================================================================ */
let pkgPos = 0;
const pkgTrack    = document.getElementById('packages-track');
const pkgViewport = document.getElementById('packages-viewport');

function getVisible() {
    return window.innerWidth >= 1024 ? 4 : window.innerWidth >= 768 ? 2 : 1;
}

function pkgSlide(dir) {
    const cards   = pkgTrack.querySelectorAll('.pkg-card');
    const total   = cards.length;
    const visible = getVisible();
    const maxPos  = Math.max(0, total - visible);

    pkgPos = Math.min(Math.max(pkgPos + dir, 0), maxPos);

    /* Hitung lebar satu card + gap (20px) */
    const card = pkgTrack.querySelector('.pkg-card');
    if (!card) return;
    const step = card.offsetWidth + 20;

    pkgTrack.style.transform = `translateX(-${pkgPos * step}px)`;

    /* Update state tombol */
    document.getElementById('pkg-prev').style.opacity = pkgPos <= 0 ? '0.35' : '1';
    document.getElementById('pkg-next').style.opacity = pkgPos >= maxPos ? '0.35' : '1';
}

/* Init state tombol */
window.addEventListener('load', () => pkgSlide(0));
window.addEventListener('resize', () => { pkgPos = 0; pkgSlide(0); });
</script>
@endsection
