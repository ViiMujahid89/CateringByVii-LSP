@extends('layouts.app')

@section('title', 'Detail Pesanan #' . $order->id)

@section('content')
<div class="page-header">
    <a href="{{ route('customer.orders.index') }}" class="btn btn-outline btn-sm" style="margin-bottom:16px;">&larr; Kembali</a>
    <h1 class="page-title">Detail Pesanan #{{ $order->id }}</h1>
</div>

{{-- Status Timeline --}}
@php
    $steps = [
        ['label' => 'Pesanan Dibuat', 'key' => 'pending'],
        ['label' => 'Disetujui Admin', 'key' => 'approved'],
        ['label' => 'Bayar', 'key' => 'waiting_payment'],
        ['label' => 'Verifikasi Bayar', 'key' => 'payment_pending'],
        ['label' => 'Selesai', 'key' => 'completed'],
    ];
    $statusOrder = ['pending' => 0, 'approved' => 1, 'waiting_payment' => 2, 'payment_pending' => 3, 'completed' => 4, 'rejected' => -1];
    $currentStep = $statusOrder[$order->status] ?? 0;
    if ($order->payment && $order->status === 'waiting_payment') { $currentStep = 3; }
@endphp

<div class="card mb-6">
    <div class="timeline">
        @foreach($steps as $i => $step)
            <div class="timeline-step {{ $i < $currentStep ? 'done' : ($i === $currentStep ? 'active' : '') }}">
                <div class="timeline-dot">{{ $i + 1 }}</div>
                <div class="timeline-label">{{ $step['label'] }}</div>
            </div>
        @endforeach
    </div>

    @if($order->status === 'rejected')
        <div style="background:#fdf0ef;border:1px solid #f5b7b1;color:#c0392b;padding:12px 16px;border-radius:6px;text-align:center;font-size:14px;">
            ❌ Pesanan Anda telah ditolak. Silakan hubungi admin untuk informasi lebih lanjut.
        </div>
    @endif
</div>

<div class="grid-2" style="align-items:start;">

    {{-- Order Info --}}
    <div class="card">
        <div style="font-size:11px;letter-spacing:0.1em;text-transform:uppercase;color:#aaa;margin-bottom:16px;">Informasi Pesanan</div>

        <div style="display:flex;flex-direction:column;gap:14px;">
            <div style="display:flex;justify-content:space-between;border-bottom:1px solid #f5f2ee;padding-bottom:12px;">
                <span style="font-size:13px;color:#888;">Paket</span>
                <span style="font-size:14px;font-weight:600;">{{ $order->package->name }}</span>
            </div>
            <div style="display:flex;justify-content:space-between;border-bottom:1px solid #f5f2ee;padding-bottom:12px;">
                <span style="font-size:13px;color:#888;">Jumlah</span>
                <span style="font-size:14px;font-weight:600;">{{ $order->quantity }} unit</span>
            </div>
            <div style="display:flex;justify-content:space-between;border-bottom:1px solid #f5f2ee;padding-bottom:12px;">
                <span style="font-size:13px;color:#888;">Tanggal Acara</span>
                <span style="font-size:14px;font-weight:600;">{{ $order->event_date->format('d F Y') }}</span>
            </div>
            <div style="display:flex;justify-content:space-between;border-bottom:1px solid #f5f2ee;padding-bottom:12px;">
                <span style="font-size:13px;color:#888;">Status</span>
                <span class="badge badge-{{ $order->status_badge }}">{{ $order->status_label }}</span>
            </div>
            <div style="display:flex;justify-content:space-between;border-bottom:1px solid #f5f2ee;padding-bottom:12px;">
                <span style="font-size:13px;color:#888;">Total Harga</span>
                <span style="font-size:16px;font-weight:700;color:#C4922A;">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
            </div>
            <div>
                <span style="font-size:13px;color:#888;display:block;margin-bottom:6px;">Alamat Pengiriman</span>
                <span style="font-size:14px;">{{ $order->delivery_address }}</span>
            </div>
            @if($order->notes)
            <div>
                <span style="font-size:13px;color:#888;display:block;margin-bottom:6px;">Catatan</span>
                <span style="font-size:14px;">{{ $order->notes }}</span>
            </div>
            @endif
        </div>
    </div>

    {{-- Payment Info --}}
    <div>
        @if($order->status === 'waiting_payment' && !$order->payment)
            <div class="card" style="border-left:4px solid #C4922A;">
                <div style="font-size:11px;letter-spacing:0.1em;text-transform:uppercase;color:#aaa;margin-bottom:12px;">Aksi Diperlukan</div>
                <div style="font-size:14px;color:#555;margin-bottom:20px;line-height:1.7;">
                    Pesanan Anda telah disetujui. Silakan upload bukti pembayaran untuk melanjutkan proses.
                </div>
                <a href="{{ route('customer.payments.create', $order) }}" class="btn btn-accent" style="display:block;text-align:center;" id="btn-upload-bukti">
                    Upload Bukti Pembayaran
                </a>
            </div>
        @elseif($order->payment)
            <div class="card">
                <div style="font-size:11px;letter-spacing:0.1em;text-transform:uppercase;color:#aaa;margin-bottom:16px;">Status Pembayaran</div>
                <span class="badge badge-{{ $order->payment->status_badge }}" style="margin-bottom:16px;">{{ $order->payment->status_label }}</span>

                <div style="margin-top:12px;">
                    <div style="font-size:13px;color:#888;margin-bottom:6px;">Jumlah Dibayar</div>
                    <div style="font-size:16px;font-weight:700;">Rp {{ number_format($order->payment->amount, 0, ',', '.') }}</div>
                </div>

                @if($order->payment->proof_image)
                    <div style="margin-top:16px;">
                        <div style="font-size:13px;color:#888;margin-bottom:8px;">Bukti Pembayaran</div>
                        <img src="{{ asset('storage/' . $order->payment->proof_image) }}" alt="Bukti Transfer"
                            style="width:100%;border-radius:8px;border:1px solid #e8e3dc;max-height:240px;object-fit:contain;">
                    </div>
                @endif
            </div>
        @else
            <div class="card" style="text-align:center;padding:40px;color:#aaa;">
                <div style="font-size:32px;margin-bottom:12px;">💳</div>
                <div style="font-size:14px;">Menunggu konfirmasi admin untuk melanjutkan pembayaran.</div>
            </div>
        @endif
    </div>

</div>
@endsection
