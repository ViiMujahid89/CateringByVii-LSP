@extends('layouts.admin')

@section('title', 'Tambah Paket')
@section('page_title', 'Tambah Paket Baru')
@section('breadcrumb', 'Admin / Paket / Tambah')

@section('content')
<div style="max-width:680px;">
    <div class="card">
        <form method="POST" action="{{ route('admin.packages.store') }}" enctype="multipart/form-data" id="form-tambah-paket">
            @csrf

            <div class="form-group">
                <label class="form-label" for="name">Nama Paket <span style="color:#c0392b;">*</span></label>
                <input type="text" id="name" name="name" class="form-control @error('name') is-error @enderror"
                    value="{{ old('name') }}" required placeholder="Contoh: Paket Bronze">
                @error('name') <div class="form-error">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label class="form-label" for="description">Deskripsi <span style="color:#c0392b;">*</span></label>
                <textarea id="description" name="description"
                    class="form-control @error('description') is-error @enderror"
                    required rows="4" placeholder="Jelaskan isi dan keunggulan paket ini...">{{ old('description') }}</textarea>
                @error('description') <div class="form-error">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label class="form-label" for="price">Harga (Rp) <span style="color:#c0392b;">*</span></label>
                <input type="number" id="price" name="price" class="form-control @error('price') is-error @enderror"
                    value="{{ old('price') }}" required min="0" step="1000" placeholder="50000">
                @error('price') <div class="form-error">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label class="form-label" for="image">Gambar Paket</label>
                <input type="file" id="image" name="image" class="form-control @error('image') is-error @enderror"
                    accept="image/*" onchange="previewImage(this)">
                <div class="form-hint">Format: JPG, PNG, WEBP. Maks. 2MB.</div>
                @error('image') <div class="form-error">{{ $message }}</div> @enderror
                <div id="img-preview" style="display:none;margin-top:12px;">
                    <img id="img-preview-src" src="" alt="Preview"
                        style="max-width:200px;max-height:140px;border-radius:8px;object-fit:cover;border:1px solid #e8e3dc;">
                </div>
            </div>

            <div class="form-group">
                <label class="form-label" for="category">Kategori Paket <span style="color:#c0392b;">*</span></label>
                <select id="category" name="category" class="form-control" required>
                    <option value="acara" {{ old('category') === 'acara' ? 'selected' : '' }}>🎉 Paket Acara</option>
                    <option value="box"   {{ old('category') === 'box'   ? 'selected' : '' }}>📦 Paket Box</option>
                </select>
                <div class="form-hint">Tentukan di seksi mana paket ini akan tampil kepada pelanggan.</div>
            </div>

            <div class="form-group">
                <label style="display:flex;align-items:center;gap:10px;cursor:pointer;">
                    <input type="checkbox" name="is_active" value="1" checked
                        style="width:16px;height:16px;accent-color:#2C1810;">
                    <span class="form-label" style="margin:0;">Paket Aktif (tampil ke pelanggan)</span>
                </label>
            </div>

            <div class="d-flex gap-2" style="margin-top:8px;">
                <button type="submit" class="btn btn-primary" id="btn-simpan-paket">Simpan Paket</button>
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
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => { img.src = e.target.result; preview.style.display = 'block'; };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endsection
@endsection
