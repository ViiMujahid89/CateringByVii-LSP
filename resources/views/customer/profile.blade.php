@extends('layouts.app')

@section('title', 'Akun Saya')
@section('meta_description', 'Lihat status akun dan kelola profil CateringByVii Anda.')

@section('content')
<div class="page-header-row">
    <div>
        <h1 class="page-title">Akun Saya</h1>
        <p class="page-subtitle">Kelola informasi akun dan keamanan Anda.</p>
    </div>
</div>

<div class="profile-layout">

    {{-- ── KOLOM KIRI: Info Akun + Ganti Password ─────────────── --}}
    <div class="profile-left">

        {{-- Status Akun --}}
        <div class="card profile-card">
            <div class="profile-avatar">
                {{ strtoupper(substr($user->name, 0, 1)) }}
            </div>
            <div class="profile-info-name">{{ $user->name }}</div>
            <div class="profile-info-email">{{ $user->email }}</div>

            <div class="profile-status-row">
                @if($user->status === 'approved')
                    <span class="badge badge-success profile-status-badge">
                        <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                        Akun Terverifikasi
                    </span>
                    <p class="profile-status-note">Akun Anda telah disetujui oleh admin dan dapat digunakan sepenuhnya.</p>
                @elseif($user->status === 'pending')
                    <span class="badge badge-warning profile-status-badge">
                        <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Menunggu Verifikasi
                    </span>
                    <p class="profile-status-note">Akun Anda sedang dalam proses tinjauan oleh admin. Mohon tunggu.</p>
                @else
                    <span class="badge badge-danger profile-status-badge">
                        <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                        Akun Ditolak
                    </span>
                    <p class="profile-status-note">Akun Anda tidak disetujui. Hubungi admin untuk informasi lebih lanjut.</p>
                @endif
            </div>

            <dl class="profile-meta">
                <dt>Bergabung</dt>
                <dd>{{ $user->created_at->format('d F Y') }}</dd>
                <dt>Telepon</dt>
                <dd>{{ $user->phone ?: '—' }}</dd>
                <dt>Alamat</dt>
                <dd>{{ $user->address ?: '—' }}</dd>
            </dl>
        </div>

        {{-- Ganti Password --}}
        <div class="card" style="margin-top: 20px;">
            <div class="profile-section-title">
                <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                Ganti Password
            </div>

            <form method="POST" action="{{ route('customer.profile.password') }}" id="form-change-password">
                @csrf
                <div class="form-group">
                    <label class="form-label" for="current_password">Password Saat Ini</label>
                    <input type="password" id="current_password" name="current_password"
                        class="form-control @error('current_password') is-error @enderror"
                        placeholder="Masukkan password lama" required>
                    @error('current_password')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label" for="password">Password Baru</label>
                    <input type="password" id="password" name="password"
                        class="form-control @error('password') is-error @enderror"
                        placeholder="Minimal 8 karakter" required>
                    @error('password')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label" for="password_confirmation">Konfirmasi Password Baru</label>
                    <input type="password" id="password_confirmation" name="password_confirmation"
                        class="form-control" placeholder="Ulangi password baru" required>
                </div>

                <button type="submit" class="btn btn-primary" style="width:100%;" id="btn-save-password">
                    Simpan Password Baru
                </button>
            </form>
        </div>
    </div>

    {{-- ── KOLOM KANAN: Pesanan Aktif + Riwayat ───────────────── --}}
    <div class="profile-right">

        {{-- Pesanan Aktif / Berlangsung --}}
        <div class="card" style="margin-bottom: 20px;">
            <div class="profile-section-title">
                <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                Pesanan Berlangsung
                <span class="badge badge-info" style="font-size:11px;padding:2px 8px;margin-left:4px;">{{ $activeOrders->count() }}</span>
            </div>

            @forelse($activeOrders as $order)
                <a href="{{ route('customer.orders.show', $order) }}" class="profile-order-row">
                    <div class="profile-order-left">
                        <div class="profile-order-pkg">{{ $order->package->name }}</div>
                        <div class="profile-order-meta">
                            {{ $order->event_date->format('d M Y') }} &middot; {{ $order->quantity }} porsi
                        </div>
                    </div>
                    <div class="profile-order-right">
                        <span class="badge badge-{{ $order->status_badge }}">{{ $order->status_label }}</span>
                        <div class="profile-order-price">Rp {{ number_format($order->total_price, 0, ',', '.') }}</div>
                    </div>
                </a>
            @empty
                <div class="empty-state" style="padding:32px 24px;">
                    <div class="text-4xl mb-2">📋</div>
                    <div>Tidak ada pesanan yang sedang berlangsung.</div>
                    <a href="{{ route('customer.packages.index') }}" class="text-[#C4922A] text-sm mt-2 inline-block">Pesan sekarang →</a>
                </div>
            @endforelse
        </div>

        {{-- Riwayat Pesanan --}}
        <div class="card">
            <div class="profile-section-title">
                <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                Riwayat Pesanan
                <span class="badge badge-secondary" style="font-size:11px;padding:2px 8px;margin-left:4px;">{{ $orderHistory->count() }}</span>
            </div>

            @forelse($orderHistory as $order)
                <a href="{{ route('customer.orders.show', $order) }}" class="profile-order-row">
                    <div class="profile-order-left">
                        <div class="profile-order-pkg">{{ $order->package->name }}</div>
                        <div class="profile-order-meta">
                            {{ $order->event_date->format('d M Y') }} &middot; {{ $order->quantity }} porsi
                        </div>
                    </div>
                    <div class="profile-order-right">
                        <span class="badge badge-{{ $order->status_badge }}">{{ $order->status_label }}</span>
                        <div class="profile-order-price">Rp {{ number_format($order->total_price, 0, ',', '.') }}</div>
                    </div>
                </a>
            @empty
                <div class="empty-state" style="padding:32px 24px;">
                    <div class="text-4xl mb-2">🗂️</div>
                    <div>Belum ada riwayat pesanan.</div>
                </div>
            @endforelse
        </div>

    </div>
</div>
@endsection
