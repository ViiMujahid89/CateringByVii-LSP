@extends('layouts.admin')

@section('title', 'Verifikasi Pembayaran')
@section('page_title', 'Verifikasi Pembayaran')
@section('breadcrumb', 'Admin / Pembayaran')

@section('content')
<div class="d-flex gap-2 mb-6">
    @foreach(['pending' => 'Pending', 'approved' => 'Disetujui', 'rejected' => 'Ditolak', 'all' => 'Semua'] as $val => $label)
        <a href="{{ route('admin.payments.index', ['status' => $val]) }}"
            class="btn {{ $status === $val ? 'btn-primary' : 'btn-outline' }} btn-sm">{{ $label }}</a>
    @endforeach
</div>

<div class="card">
    @if($payments->isEmpty())
        <div style="text-align:center;padding:64px 0;color:#aaa;">
            <div style="font-size:48px;margin-bottom:16px;">💳</div>
            <div>Tidak ada pembayaran dengan status ini.</div>
        </div>
    @else
        <table class="data-table">
            <thead>
                <tr>
                    <th>#Pesanan</th>
                    <th>Pelanggan</th>
                    <th>Paket</th>
                    <th>Jumlah Bayar</th>
                    <th>Bukti</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($payments as $payment)
                    <tr>
                        <td class="text-muted">#{{ $payment->order_id }}</td>
                        <td>
                            <div style="font-weight:500;">{{ $payment->order->user->name }}</div>
                            <div style="font-size:12px;color:#aaa;">{{ $payment->order->user->email }}</div>
                        </td>
                        <td>{{ $payment->order->package->name }}</td>
                        <td style="font-weight:600;">Rp {{ number_format($payment->amount, 0, ',', '.') }}</td>
                        <td>
                            <a href="{{ asset('storage/' . $payment->proof_image) }}" target="_blank"
                                style="color:#C4922A;font-size:13px;text-decoration:none;">Lihat Bukti ↗</a>
                        </td>
                        <td><span class="badge badge-{{ $payment->status_badge }}">{{ $payment->status_label }}</span></td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="{{ route('admin.payments.show', $payment) }}" class="btn btn-outline btn-xs">Detail</a>
                                @if($payment->status === 'pending')
                                    <form method="POST" action="{{ route('admin.payments.verify', $payment) }}" id="form-pay-approve-{{ $payment->id }}">
                                        @csrf @method('PATCH')
                                        <input type="hidden" name="action" value="approved">
                                        <button type="submit" class="btn btn-success btn-xs">✓ Setujui</button>
                                    </form>
                                    <form method="POST" action="{{ route('admin.payments.verify', $payment) }}" id="form-pay-reject-{{ $payment->id }}">
                                        @csrf @method('PATCH')
                                        <input type="hidden" name="action" value="rejected">
                                        <button type="submit" class="btn btn-danger btn-xs"
                                            data-confirm="Tolak pembayaran ini?"
                                            data-form="form-pay-reject-{{ $payment->id }}">✕ Tolak</button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="pagination-wrapper">{{ $payments->links() }}</div>
    @endif
</div>
@endsection
