@extends('layouts.admin')

@section('title', 'Detail Pembayaran')
@section('page_title', 'Detail Pembayaran #' . $payment->id)
@section('breadcrumb', 'Admin / Pembayaran / #' . $payment->id)

@section('topbar_actions')
    <a href="{{ route('admin.payments.index') }}" class="btn btn-outline btn-sm">&larr; Kembali</a>
@endsection

@section('content')
<div class="grid-2" style="align-items:start;">
    <div class="card">
        <div style="font-size:11px;letter-spacing:0.1em;text-transform:uppercase;color:#aaa;margin-bottom:16px;">Bukti Pembayaran</div>
        <img src="{{ asset('storage/' . $payment->proof_image) }}" alt="Bukti Transfer"
            style="width:100%;border-radius:8px;border:1px solid #e8e3dc;max-height:400px;object-fit:contain;">

        <div style="margin-top:16px;display:flex;flex-direction:column;gap:10px;">
            <div style="display:flex;justify-content:space-between;font-size:14px;border-bottom:1px solid #f0ece6;padding-bottom:10px;">
                <span class="text-muted">Status</span>
                <span class="badge badge-{{ $payment->status_badge }}">{{ $payment->status_label }}</span>
            </div>
            <div style="display:flex;justify-content:space-between;font-size:14px;border-bottom:1px solid #f0ece6;padding-bottom:10px;">
                <span class="text-muted">Jumlah Dibayar</span>
                <span style="font-weight:700;font-size:16px;color:#C4922A;">Rp {{ number_format($payment->amount, 0, ',', '.') }}</span>
            </div>
            <div style="display:flex;justify-content:space-between;font-size:14px;border-bottom:1px solid #f0ece6;padding-bottom:10px;">
                <span class="text-muted">Total Tagihan</span>
                <span style="font-weight:600;">Rp {{ number_format($payment->order->total_price, 0, ',', '.') }}</span>
            </div>
            @if($payment->verifiedBy)
            <div style="display:flex;justify-content:space-between;font-size:14px;">
                <span class="text-muted">Diverifikasi oleh</span>
                <span>{{ $payment->verifiedBy->name }}</span>
            </div>
            @endif
        </div>

        @if($payment->status === 'pending')
            <div style="border-top:1px solid #f0ece6;margin-top:20px;padding-top:20px;display:flex;gap:12px;">
                <form method="POST" action="{{ route('admin.payments.verify', $payment) }}" style="flex:1;" id="form-pay-show-approve">
                    @csrf @method('PATCH')
                    <input type="hidden" name="action" value="approved">
                    <button type="submit" class="btn btn-success" style="width:100%;justify-content:center;">✓ Setujui Pembayaran</button>
                </form>
                <form method="POST" action="{{ route('admin.payments.verify', $payment) }}" style="flex:1;" id="form-pay-show-reject">
                    @csrf @method('PATCH')
                    <input type="hidden" name="action" value="rejected">
                    <button type="submit" class="btn btn-danger" style="width:100%;justify-content:center;"
                        data-confirm="Tolak pembayaran ini?" data-form="form-pay-show-reject">✕ Tolak</button>
                </form>
            </div>
        @endif
    </div>

    <div class="card">
        <div style="font-size:11px;letter-spacing:0.1em;text-transform:uppercase;color:#aaa;margin-bottom:16px;">Informasi Pesanan</div>
        <div style="display:flex;flex-direction:column;gap:12px;font-size:14px;">
            <div style="display:flex;justify-content:space-between;border-bottom:1px solid #f0ece6;padding-bottom:10px;">
                <span class="text-muted">Pelanggan</span>
                <div style="text-align:right;"><div style="font-weight:500;">{{ $payment->order->user->name }}</div><div style="font-size:12px;color:#aaa;">{{ $payment->order->user->email }}</div></div>
            </div>
            <div style="display:flex;justify-content:space-between;border-bottom:1px solid #f0ece6;padding-bottom:10px;">
                <span class="text-muted">Paket</span>
                <span>{{ $payment->order->package->name }}</span>
            </div>
            <div style="display:flex;justify-content:space-between;border-bottom:1px solid #f0ece6;padding-bottom:10px;">
                <span class="text-muted">Jumlah</span>
                <span>{{ $payment->order->quantity }} unit</span>
            </div>
            <div style="display:flex;justify-content:space-between;">
                <span class="text-muted">Tanggal Acara</span>
                <span>{{ $payment->order->event_date->format('d F Y') }}</span>
            </div>
        </div>
    </div>
</div>
@endsection
