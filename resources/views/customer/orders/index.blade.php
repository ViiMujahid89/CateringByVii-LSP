@extends('layouts.app')

@section('title', 'Pesanan Saya')

@section('content')
<div class="page-header-row">
    <div>
        <h1 class="page-title">Pesanan Saya</h1>
        <p class="page-subtitle">Riwayat dan status semua pesanan katering Anda.</p>
    </div>
    <a href="{{ route('customer.packages.index') }}" class="btn btn-accent" id="btn-buat-pesanan">
        + Buat Pesanan Baru
    </a>
</div>

<div class="card">
    @if($orders->isEmpty())
        <div style="text-align:center;padding:64px 0;color:#aaa;">
            <div style="font-size:48px;margin-bottom:16px;">📋</div>
            <div style="font-size:16px;margin-bottom:8px;">Belum ada pesanan</div>
            <a href="{{ route('customer.packages.index') }}" style="color:#C4922A;font-size:14px;">Mulai pesan sekarang →</a>
        </div>
    @else
        <table class="data-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Paket</th>
                    <th>Tanggal Acara</th>
                    <th>Qty</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td class="text-muted">{{ $order->id }}</td>
                        <td>
                            <div style="font-weight:500;">{{ $order->package->name }}</div>
                        </td>
                        <td>{{ $order->event_date->format('d M Y') }}</td>
                        <td>{{ $order->quantity }}</td>
                        <td style="font-weight:600;">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                        <td><span class="badge badge-{{ $order->status_badge }}">{{ $order->status_label }}</span></td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="{{ route('customer.orders.show', $order) }}" class="btn btn-outline btn-sm" id="btn-detail-{{ $order->id }}">Detail</a>
                                @if($order->status === 'waiting_payment' && !$order->payment)
                                    <a href="{{ route('customer.payments.create', $order) }}" class="btn btn-accent btn-sm" id="btn-bayar-{{ $order->id }}">Upload Bukti</a>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="pagination-wrapper">
            {{ $orders->links() }}
        </div>
    @endif
</div>
@endsection
