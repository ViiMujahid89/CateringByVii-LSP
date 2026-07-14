@extends('layouts.admin')

@section('title', 'Edit Paket')
@section('page_title', 'Edit Paket: ' . $package->name)
@section('breadcrumb', 'Admin / Paket / Edit')

@section('content')
<div style="max-width:680px;">
    <div class="card">
        <form method="POST" action="{{ route('admin.packages.update', $package) }}" enctype="multipart/form-data" id="form-edit-paket">
            @csrf @method('PUT')

            <div class="form-group">
                <label class="form-label" for="name">Nama Paket <span style="color:#c0392b;">*</span></label>
                <input type="text" id="name" name="name" class="form-control @error('name') is-error @enderror"
                    value="{{ old('name', $package->name) }}" required>
                @error('name') <div class="form-error">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label class="form-label" for="description">Deskripsi <span style="color:#c0392b;">*</span></label>
                <textarea id="description" name="description"
                    class="form-control @error('description') is-error @enderror"
                    required rows="4">{{ old('description', $package->description) }}</textarea>
                @error('description') <div class="form-error">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label class="form-label" for="price">Harga (Rp) <span style="color:#c0392b;">*</span></label>
                <input type="number" id="price" name="price" class="form-control @error('price') is-error @enderror"
                    value="{{ old('price', (int) $package->price) }}" required min="0" step="1000">
                @error('price') <div class="form-error">{{ $message }}</div> @enderror
            </div>

            {{-- ── Gambar ──────────────────────────────────────────── --}}
            <div class="form-group">
                <label class="form-label" for="image">Gambar Paket</label>

                @if($package->image)
                    <div style="margin-bottom:12px;display:flex;align-items:center;gap:16px;">
                        <img id="img-current"
                            src="{{ asset('storage/' . $package->image) }}"
                            alt="{{ $package->name }}"
                            style="width:120px;height:84px;object-fit:cover;border-radius:8px;border:1px solid #e8e3dc;">
                        <div>
                            <div style="font-size:12px;color:#888;margin-bottom:6px;">Gambar saat ini</div>
                            <div style="font-size:11px;color:#aaa;">Upload gambar baru di bawah untuk menggantinya</div>
                        </div>
                    </div>
                @endif

                <input type="file" id="image" name="image" class="form-control @error('image') is-error @enderror"
                    accept="image/*" onchange="previewImage(this)">
                <div class="form-hint">Format: JPG, PNG, WEBP. Maks. 2MB. Kosongkan jika tidak ingin ganti gambar.</div>
                @error('image') <div class="form-error">{{ $message }}</div> @enderror

                <div id="img-preview" style="display:none;margin-top:12px;">
                    <div style="font-size:12px;color:#888;margin-bottom:6px;">Preview gambar baru:</div>
                    <img id="img-preview-src" src="" alt="Preview"
                        style="max-width:200px;max-height:140px;border-radius:8px;object-fit:cover;border:2px solid #C4922A;">
                </div>
            </div>

            <div class="form-group">
                <label style="display:flex;align-items:center;gap:10px;cursor:pointer;">
                    <input type="checkbox" name="is_active" value="1"
                        {{ $package->is_active ? 'checked' : '' }}
                        style="width:16px;height:16px;accent-color:#2C1810;">
                    <span class="form-label" style="margin:0;">Paket Aktif (tampil ke pelanggan)</span>
                </label>
            </div>

            <div class="d-flex gap-2" style="margin-top:8px;">
                <button type="submit" class="btn btn-primary" id="btn-update-paket">Simpan Perubahan</button>
                <a href="{{ route('admin.packages.index') }}" class="btn btn-outline">Batal</a>
            </div>
        </form>
    </div>
</div>

@section('scripts')
<script>
function previewImage(input) {
    const preview = document.getElementById('img-preview');
    const img     = document.getElementById('img-preview-src');
    const current = document.getElementById('img-current');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
            img.src = e.target.result;
            preview.style.display = 'block';
            /* Dim gambar lama */
            if (current) current.style.opacity = '0.4';
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endsection
@endsection
