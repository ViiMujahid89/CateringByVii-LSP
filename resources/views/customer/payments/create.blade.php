@extends('layouts.app')

@section('title', 'Upload Bukti Pembayaran')

@section('content')
<div class="page-header">
    <a href="{{ route('customer.orders.show', $order) }}" class="btn btn-outline btn-sm" style="margin-bottom:16px;">&larr; Kembali ke Pesanan</a>
    <h1 class="page-title">Upload Bukti Pembayaran</h1>
    <p class="page-subtitle">Pesanan #{{ $order->id }} — {{ $order->package->name }}</p>
</div>

<div class="grid-2" style="align-items:start;">
    <div class="card">
        <div style="font-size:11px;letter-spacing:0.1em;text-transform:uppercase;color:#aaa;margin-bottom:20px;">Form Upload Bukti</div>

        <form method="POST" action="{{ route('customer.payments.store', $order) }}"
            enctype="multipart/form-data" id="form-payment">
            @csrf

            <div class="form-group">
                <label class="form-label" for="amount">Jumlah yang Dibayar (Rp)</label>
                <input type="number" id="amount" name="amount" class="form-control"
                    value="{{ old('amount', $order->total_price) }}" required step="0.01">
                <div class="form-hint">Total tagihan: Rp {{ number_format($order->total_price, 0, ',', '.') }}</div>
                @error('amount') <div class="form-error">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label class="form-label" for="proof_image">Bukti Transfer / Screenshot</label>
                <input type="file" id="proof_image" name="proof_image" class="form-control"
                    accept="image/jpeg,image/png,image/webp" required>
                <div class="form-hint">Format: JPG, PNG, WebP. Maks. 2 MB.</div>
                @error('proof_image') <div class="form-error">{{ $message }}</div> @enderror
            </div>

            {{-- Preview --}}
            <div id="preview-wrap" style="display:none;margin-bottom:16px;">
                <div style="font-size:13px;color:#888;margin-bottom:8px;">Preview:</div>
                <img id="preview-img" style="width:100%;border-radius:8px;border:1px solid #e8e3dc;max-height:240px;object-fit:contain;">
            </div>

            <button type="submit" class="btn btn-accent" style="width:100%;justify-content:center;padding:14px;font-size:15px;" id="btn-submit-payment">
                Upload Bukti Pembayaran
            </button>
        </form>
    </div>

    <div class="card" style="position:sticky;top:84px;">
        <div style="font-size:11px;letter-spacing:0.1em;text-transform:uppercase;color:#aaa;margin-bottom:16px;">Ringkasan Pesanan</div>
        <div style="display:flex;flex-direction:column;gap:12px;">
            <div style="display:flex;justify-content:space-between;font-size:14px;">
                <span style="color:#888;">Paket</span>
                <span style="font-weight:600;">{{ $order->package->name }}</span>
            </div>
            <div style="display:flex;justify-content:space-between;font-size:14px;">
                <span style="color:#888;">Jumlah</span>
                <span>{{ $order->quantity }} unit</span>
            </div>
            <div style="display:flex;justify-content:space-between;font-size:14px;">
                <span style="color:#888;">Tanggal Acara</span>
                <span>{{ $order->event_date->format('d M Y') }}</span>
            </div>
            <div style="border-top:1px solid #f0ece6;padding-top:12px;display:flex;justify-content:space-between;">
                <span style="font-weight:600;">Total Tagihan</span>
                <span style="font-size:18px;font-weight:700;color:#C4922A;">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
            </div>
        </div>

        <div style="background:#fef9e7;border:1px solid #f0d97a;border-radius:6px;padding:14px;margin-top:16px;font-size:12px;color:#7a5c00;line-height:1.6;">
            ⚠️ Pastikan jumlah transfer sesuai dengan total tagihan. Bukti akan diverifikasi oleh admin.
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.getElementById('proof_image').addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = e => {
                document.getElementById('preview-img').src = e.target.result;
                document.getElementById('preview-wrap').style.display = 'block';
            };
            reader.readAsDataURL(file);
        }
    });
</script>
@endsection
