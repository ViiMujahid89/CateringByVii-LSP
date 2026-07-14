@extends('layouts.admin')

@section('title', 'Dashboard Admin')
@section('page_title', 'Dashboard')
@section('breadcrumb', 'Admin / Dashboard')

@section('content')
{{-- Stats Grid --}}
<div class="grid-4 mb-6">
    <div class="stat-card">
        <div class="stat-card-label">Total Pelanggan</div>
        <div class="stat-card-value">{{ $stats['total_users'] }}</div>
        <div class="stat-card-accent"></div>
    </div>
    <div class="stat-card" style="border-left: none; position: relative;">
        <div style="position:absolute;top:0;right:0;width:4px;height:100%;background:#c0392b;border-radius:0 8px 8px 0;"></div>
        <div class="stat-card-label">Akun Pending</div>
        <div class="stat-card-value" style="color:#c0392b;">{{ $stats['pending_users'] }}</div>
    </div>
    <div class="stat-card" style="border-left:none;position:relative;">
        <div style="position:absolute;top:0;right:0;width:4px;height:100%;background:#1a5fa8;border-radius:0 8px 8px 0;"></div>
        <div class="stat-card-label">Pesanan Pending</div>
        <div class="stat-card-value" style="color:#1a5fa8;">{{ $stats['pending_orders'] }}</div>
    </div>
    <div class="stat-card" style="border-left:none;position:relative;">
        <div style="position:absolute;top:0;right:0;width:4px;height:100%;background:#1a7a40;border-radius:0 8px 8px 0;"></div>
        <div class="stat-card-label">Pesanan Selesai</div>
        <div class="stat-card-value" style="color:#1a7a40;">{{ $stats['completed_orders'] }}</div>
    </div>
</div>

<div class="grid-2">
    {{-- Recent Orders --}}
    <div class="card">
        <div class="flex-between mb-4">
            <div class="section-title">Pesanan Terbaru</div>
            <a href="{{ route('admin.orders.index') }}" class="btn btn-outline btn-sm">Lihat Semua</a>
        </div>
        @forelse($recentOrders as $order)
            <div style="display:flex;justify-content:space-between;align-items:center;padding:12px 0;border-bottom:1px solid #f0ece6;">
                <div>
                    <div style="font-size:14px;font-weight:500;">{{ $order->user->name }}</div>
                    <div style="font-size:12px;color:#888;margin-top:2px;">{{ $order->package->name }} · {{ $order->event_date->format('d M Y') }}</div>
                </div>
                <span class="badge badge-{{ $order->status_badge }}">{{ $order->status_label }}</span>
            </div>
        @empty
            <div style="text-align:center;padding:32px 0;color:#aaa;font-size:14px;">Belum ada pesanan.</div>
        @endforelse
    </div>

    {{-- Pending Users --}}
    <div class="card">
        <div class="flex-between mb-4">
            <div class="section-title">Akun Menunggu Verifikasi</div>
            <a href="{{ route('admin.users.index') }}" class="btn btn-outline btn-sm">Lihat Semua</a>
        </div>
        @forelse($recentUsers as $user)
            <div style="display:flex;justify-content:space-between;align-items:center;padding:12px 0;border-bottom:1px solid #f0ece6;">
                <div>
                    <div style="font-size:14px;font-weight:500;">{{ $user->name }}</div>
                    <div style="font-size:12px;color:#888;margin-top:2px;">{{ $user->email }}</div>
                </div>
                <span class="badge badge-warning">Pending</span>
            </div>
        @empty
            <div style="text-align:center;padding:32px 0;color:#aaa;font-size:14px;">Tidak ada akun pending.</div>
        @endforelse
    </div>
</div>
@endsection
