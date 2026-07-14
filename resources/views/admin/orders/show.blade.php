@extends('layouts.admin')

@section('title', 'Detail Pesanan #' . $order->id)
@section('page_title', 'Detail Pesanan #' . $order->id)
@section('breadcrumb', 'Admin / Pesanan / #' . $order->id)

@section('topbar_actions')
    <a href="{{ route('admin.orders.index') }}" class="btn btn-outline btn-sm">&larr; Kembali</a>
@endsection

@section('content')
<div class="grid-2" style="align-items:start;">
    <div class="card">
        <div style="font-size:11px;letter-spacing:0.1em;text-transform:uppercase;color:#aaa;margin-bottom:16px;">Informasi Pesanan</div>
        <div style="display:flex;flex-direction:column;gap:14px;">
            <div style="display:flex;justify-content:space-between;border-bottom:1px solid #f5f2ee;padding-bottom:12px;">
                <span class="text-muted">Status</span>
                <span class="badge badge-{{ $order->status_badge }}">{{ $order->status_label }}</span>
            </div>
            <div style="display:flex;justify-content:space-between;border-bottom:1px solid #f5f2ee;padding-bottom:12px;">
                <span class="text-muted">Pelanggan</span>
                <div style="text-align:right;"><div style="font-weight:500;">{{ $order->user->name }}</div><div style="font-size:12px;color:#aaa;">{{ $order->user->email }}</div></div>
            </div>
            <div style="display:flex;justify-content:space-between;border-bottom:1px solid #f5f2ee;padding-bottom:12px;">
                <span class="text-muted">Paket</span>
                <span style="font-weight:500;">{{ $order->package->name }}</span>
            </div>
            <div style="display:flex;justify-content:space-between;border-bottom:1px solid #f5f2ee;padding-bottom:12px;">
                <span class="text-muted">Jumlah</span>
                <span>{{ $order->quantity }} unit</span>
            </div>
            <div style="display:flex;justify-content:space-between;border-bottom:1px solid #f5f2ee;padding-bottom:12px;">
                <span class="text-muted">Tanggal Acara</span>
                <span>{{ $order->event_date->format('d F Y') }}</span>
            </div>
            <div style="display:flex;justify-content:space-between;border-bottom:1px solid #f5f2ee;padding-bottom:12px;">
                <span class="text-muted">Total</span>
                <span style="font-size:16px;font-weight:700;color:#C4922A;">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
            </div>
            <div>
                <div class="text-muted" style="margin-bottom:6px;">Alamat</div>
                <div>{{ $order->delivery_address }}</div>
            </div>
            @if($order->notes)
            <div>
                <div class="text-muted" style="margin-bottom:6px;">Catatan</div>
                <div>{{ $order->notes }}</div>
            </div>
            @endif
        </div>

        @if($order->status === 'pending')
            <div style="border-top:1px solid #f0ece6;margin-top:20px;padding-top:20px;display:flex;gap:12px;">
                <form method="POST" action="{{ route('admin.orders.verify', $order) }}" style="flex:1;" id="form-show-approve">
                    @csrf @method('PATCH')
                    <input type="hidden" name="action" value="approved">
                    <button type="submit" class="btn btn-success" style="width:100%;justify-content:center;">✓ Setujui Pesanan</button>
                </form>
                <form method="POST" action="{{ route('admin.orders.verify', $order) }}" style="flex:1;" id="form-show-reject">
                    @csrf @method('PATCH')
                    <input type="hidden" name="action" value="rejected">
                    <button type="submit" class="btn btn-danger" style="width:100%;justify-content:center;"
                        data-confirm="Tolak pesanan ini?" data-form="form-show-reject">✕ Tolak</button>
                </form>
            </div>
        @endif
    </div>

    {{-- Payment Info --}}
    <div class="card">
        <div style="font-size:11px;letter-spacing:0.1em;text-transform:uppercase;color:#aaa;margin-bottom:16px;">Informasi Pembayaran</div>
        @if($order->payment)
            <span class="badge badge-{{ $order->payment->status_badge }}" style="margin-bottom:16px;">{{ $order->payment->status_label }}</span>
            <div style="display:flex;justify-content:space-between;margin-bottom:12px;font-size:14px;">
                <span class="text-muted">Jumlah Dibayar</span>
                <span style="font-weight:700;">Rp {{ number_format($order->payment->amount, 0, ',', '.') }}</span>
            </div>
            @if($order->payment->proof_image)
                <img src="{{ asset('storage/' . $order->payment->proof_image) }}" alt="Bukti Transfer"
                    style="width:100%;border-radius:8px;border:1px solid #e8e3dc;">
            @endif
            @if($order->payment->verifiedBy)
                <div style="margin-top:12px;font-size:12px;color:#888;">Diverifikasi oleh: {{ $order->payment->verifiedBy->name }} pada {{ $order->payment->verified_at->format('d M Y H:i') }}</div>
            @endif
        @else
            <div style="text-align:center;padding:40px;color:#aaa;font-size:14px;">Belum ada pembayaran.</div>
        @endif
    </div>
</div>
@endsection
