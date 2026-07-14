@extends('layouts.app')

@section('title', 'Buat Pesanan — ' . $package->name)

@section('content')
<div class="page-header">
    <a href="{{ route('customer.packages.index') }}" class="btn btn-outline btn-sm mb-4" style="margin-bottom:16px;">
        &larr; Kembali ke Daftar Paket
    </a>
    <h1 class="page-title">Buat Pesanan</h1>
    <p class="page-subtitle">Isi form di bawah untuk memesan paket katering.</p>
</div>

<div class="grid-2" style="align-items:start;">

    {{-- Order Form --}}
    <div class="card">
        <div class="section-title" style="font-family:'Playfair Display',serif;font-size:1.1rem;color:#2C1810;margin-bottom:20px;">Detail Pemesanan</div>
        <form method="POST" action="{{ route('customer.orders.store') }}" id="form-order">
            @csrf
            <input type="hidden" name="package_id" value="{{ $package->id }}">

            <div class="form-group">
                <label class="form-label" for="quantity">Jumlah Porsi / Unit</label>
                <input type="number" id="quantity" name="quantity" class="form-control"
                    value="{{ old('quantity', 1) }}" min="1" required id="input-quantity">
                <div class="form-hint">Harga per unit: Rp {{ number_format($package->price, 0, ',', '.') }}</div>
                @error('quantity') <div class="form-error">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label class="form-label" for="event_date">Tanggal Acara</label>
                <input type="date" id="event_date" name="event_date" class="form-control"
                    value="{{ old('event_date') }}" required min="{{ date('Y-m-d', strtotime('+1 day')) }}">
                @error('event_date') <div class="form-error">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label class="form-label" for="delivery_address">Alamat Pengiriman / Lokasi Acara</label>
                <textarea id="delivery_address" name="delivery_address" class="form-control" required
                    placeholder="Masukkan alamat lengkap lokasi acara...">{{ old('delivery_address', auth()->user()->address) }}</textarea>
                @error('delivery_address') <div class="form-error">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label class="form-label" for="notes">Catatan Tambahan <span style="font-weight:400;color:#aaa;">(Opsional)</span></label>
                <textarea id="notes" name="notes" class="form-control"
                    placeholder="Misalnya: alergi makanan, permintaan khusus, dll...">{{ old('notes') }}</textarea>
                @error('notes') <div class="form-error">{{ $message }}</div> @enderror
            </div>

            <button type="submit" class="btn btn-accent" style="width:100%;justify-content:center;font-size:15px;padding:14px;" id="btn-submit-order">
                Buat Pesanan
            </button>
        </form>
    </div>

    {{-- Package Summary --}}
    <div>
        <div class="card" style="position:sticky;top:84px;">
            <div style="font-size:11px;letter-spacing:0.1em;text-transform:uppercase;color:#aaa;margin-bottom:12px;">Ringkasan Paket</div>
            <div style="font-family:'Playfair Display',serif;font-size:1.3rem;color:#2C1810;margin-bottom:8px;">{{ $package->name }}</div>
            <div style="font-size:13px;color:#666;line-height:1.7;margin-bottom:20px;">{{ $package->description }}</div>

            <div style="border-top:1px solid #f0ece6;padding-top:16px;">
                <div style="display:flex;justify-content:space-between;margin-bottom:8px;font-size:14px;">
                    <span style="color:#888;">Harga per unit</span>
                    <span style="font-weight:600;">Rp {{ number_format($package->price, 0, ',', '.') }}</span>
                </div>
                <div style="display:flex;justify-content:space-between;margin-bottom:8px;font-size:14px;">
                    <span style="color:#888;">Jumlah</span>
                    <span id="display-qty" style="font-weight:600;">1</span>
                </div>
                <div style="display:flex;justify-content:space-between;padding-top:12px;border-top:1px solid #f0ece6;font-size:16px;">
                    <span style="font-weight:600;color:#2C1810;">Total Estimasi</span>
                    <span id="display-total" style="font-weight:700;color:#C4922A;font-size:18px;">Rp {{ number_format($package->price, 0, ',', '.') }}</span>
                </div>
            </div>

            <div style="background:#faf8f5;border:1px solid #e8e3dc;border-radius:6px;padding:14px;margin-top:16px;font-size:12px;color:#888;line-height:1.6;">
                💡 Total harga adalah estimasi. Pesanan akan dikonfirmasi oleh admin sebelum pembayaran.
            </div>
        </div>
    </div>

</div>
@endsection

@section('scripts')
<script>
    const pricePerUnit = {{ $package->price }};
    const qtyInput = document.getElementById('quantity');
    const displayQty = document.getElementById('display-qty');
    const displayTotal = document.getElementById('display-total');

    function updateTotal() {
        const qty = parseInt(qtyInput.value) || 1;
        displayQty.textContent = qty;
        displayTotal.textContent = 'Rp ' + (pricePerUnit * qty).toLocaleString('id-ID');
    }

    qtyInput.addEventListener('input', updateTotal);
    updateTotal();
</script>
@endsection
