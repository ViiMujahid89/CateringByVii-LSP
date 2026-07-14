@extends('layouts.admin')

@section('title', 'Verifikasi Pesanan')
@section('page_title', 'Manajemen Pesanan')
@section('breadcrumb', 'Admin / Pesanan')

@section('content')
<div class="d-flex gap-2 mb-6">
    @foreach(['pending' => 'Pending', 'waiting_payment' => 'Menunggu Bayar', 'completed' => 'Selesai', 'rejected' => 'Ditolak', 'all' => 'Semua'] as $val => $label)
        <a href="{{ route('admin.orders.index', ['status' => $val]) }}"
            class="btn {{ $status === $val ? 'btn-primary' : 'btn-outline' }} btn-sm">{{ $label }}</a>
    @endforeach
</div>

<div class="card">
    @if($orders->isEmpty())
        <div style="text-align:center;padding:64px 0;color:#aaa;">
            <div style="font-size:48px;margin-bottom:16px;">📋</div>
            <div>Tidak ada pesanan dengan status ini.</div>
        </div>
    @else
        <table class="data-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Pelanggan</th>
                    <th>Paket</th>
                    <th>Tanggal Acara</th>
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
                            <div style="font-weight:500;">{{ $order->user->name }}</div>
                            <div style="font-size:12px;color:#aaa;">{{ $order->user->email }}</div>
                        </td>
                        <td>{{ $order->package->name }}</td>
                        <td>{{ $order->event_date->format('d M Y') }}</td>
                        <td style="font-weight:600;">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                        <td><span class="badge badge-{{ $order->status_badge }}">{{ $order->status_label }}</span></td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="{{ route('admin.orders.show', $order) }}" class="btn btn-outline btn-xs">Detail</a>
                                @if($order->status === 'pending')
                                    <form method="POST" action="{{ route('admin.orders.verify', $order) }}" id="form-order-approve-{{ $order->id }}">
                                        @csrf @method('PATCH')
                                        <input type="hidden" name="action" value="approved">
                                        <button type="submit" class="btn btn-success btn-xs">✓ Setujui</button>
                                    </form>
                                    <form method="POST" action="{{ route('admin.orders.verify', $order) }}" id="form-order-reject-{{ $order->id }}">
                                        @csrf @method('PATCH')
                                        <input type="hidden" name="action" value="rejected">
                                        <button type="submit" class="btn btn-danger btn-xs"
                                            data-confirm="Tolak pesanan #{{ $order->id }}?"
                                            data-confirm-text="Pesanan akan ditolak dan tidak bisa dikembalikan."
                                            data-form="form-order-reject-{{ $order->id }}">✕ Tolak</button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="pagination-wrapper">{{ $orders->links() }}</div>
    @endif
</div>
@endsection
