@extends('layouts.app')

@section('title', 'Dashboard')
@section('meta_description', 'Dashboard pelanggan CateringByVii — pantau pesanan dan status Anda.')

@section('content')
<div class="page-header-row">
    <div>
        <h1 class="page-title">Selamat Datang, {{ auth()->user()->name }}!</h1>
        <p class="page-subtitle">Pantau pesanan dan status katering Anda di sini.</p>
    </div>
    <a href="{{ route('customer.packages.index') }}" class="btn btn-accent" id="btn-pesan-sekarang">
        <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        Pesan Sekarang
    </a>
</div>

{{-- Stats --}}
<div class="grid-3 mb-6">
    <div class="stat-card">
        <div class="stat-card-label">Total Pesanan</div>
        <div class="stat-card-value">{{ $stats['total_orders'] }}</div>
    </div>
    <div class="stat-card" style="border-left-color: #1a5fa8;">
        <div class="stat-card-label">Pesanan Aktif</div>
        <div class="stat-card-value" style="color:#1a5fa8;">{{ $stats['active_orders'] }}</div>
    </div>
    <div class="stat-card" style="border-left-color: #1a7a40;">
        <div class="stat-card-label">Pesanan Selesai</div>
        <div class="stat-card-value" style="color:#1a7a40;">{{ $stats['completed_orders'] }}</div>
    </div>
</div>

<div class="grid-2">
    {{-- Recent Orders --}}
    <div class="card">
        <div class="flex-between mb-4">
            <div class="section-title">Pesanan Terbaru</div>
            <a href="{{ route('customer.orders.index') }}" class="btn btn-outline btn-sm">Lihat Semua</a>
        </div>
        @forelse($recentOrders as $order)
            <div style="display:flex;justify-content:space-between;align-items:center;padding:12px 0;border-bottom:1px solid #f0ece6;">
                <div>
                    <div style="font-size:14px;font-weight:500;color:#2C1810;">{{ $order->package->name }}</div>
                    <div style="font-size:12px;color:#888;margin-top:2px;">
                        {{ $order->event_date->format('d M Y') }} · {{ $order->quantity }} porsi
                    </div>
                </div>
                <span class="badge badge-{{ $order->status_badge }}">{{ $order->status_label }}</span>
            </div>
        @empty
            <div style="text-align:center;padding:32px 0;color:#aaa;font-size:14px;">
                Belum ada pesanan. <a href="{{ route('customer.packages.index') }}" style="color:#C4922A;">Pesan sekarang!</a>
            </div>
        @endforelse
    </div>

    {{-- Latest Announcements --}}
    <div class="card">
        <div class="flex-between mb-4">
            <div class="section-title">Pengumuman Terbaru</div>
            <a href="{{ route('customer.announcements.index') }}" class="btn btn-outline btn-sm">Lihat Semua</a>
        </div>
        @forelse($latestAnnouncements as $announcement)
            <div style="padding:12px 0;border-bottom:1px solid #f0ece6;">
                <a href="{{ route('customer.announcements.show', $announcement) }}" style="text-decoration:none;">
                    <div style="font-size:14px;font-weight:500;color:#2C1810;margin-bottom:4px;">{{ $announcement->title }}</div>
                    <div style="font-size:12px;color:#888;">{{ $announcement->created_at->diffForHumans() }}</div>
                </a>
            </div>
        @empty
            <div style="text-align:center;padding:32px 0;color:#aaa;font-size:14px;">Belum ada pengumuman.</div>
        @endforelse
    </div>
</div>
@endsection
