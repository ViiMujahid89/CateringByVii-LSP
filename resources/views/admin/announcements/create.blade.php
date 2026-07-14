@extends('layouts.admin')

@section('title', 'Buat Pengumuman')
@section('page_title', 'Buat Pengumuman')
@section('breadcrumb', 'Admin / Pengumuman / Buat')

@section('topbar_actions')
    <a href="{{ route('admin.announcements.index') }}" class="btn btn-outline btn-sm">&larr; Kembali</a>
@endsection

@section('content')
<div style="max-width:760px;">
    <div class="card">
        <form method="POST" action="{{ route('admin.announcements.store') }}" enctype="multipart/form-data" id="form-create-announcement">
            @csrf

            <div class="form-group">
                <label class="form-label" for="title">Judul Pengumuman</label>
                <input type="text" id="title" name="title" class="form-control"
                    value="{{ old('title') }}" required placeholder="Masukkan judul pengumuman...">
                @error('title') <div class="form-error">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label class="form-label" for="content">Isi Pengumuman</label>
                <textarea id="content" name="content" class="form-control" required
                    style="min-height:200px;" placeholder="Tuliskan isi pengumuman di sini...">{{ old('content') }}</textarea>
                @error('content') <div class="form-error">{{ $message }}</div> @enderror
            </div>

            <hr style="border:none;border-top:1px solid #ece8e2;margin:20px 0;">
            <div style="font-size:10px;letter-spacing:0.1em;text-transform:uppercase;color:#aaa;margin-bottom:16px;">Media (Opsional)</div>

            <div class="form-group">
                <label class="form-label" for="image">Gambar</label>
                <input type="file" id="image" name="image" class="form-control" accept="image/jpeg,image/png,image/webp">
                <div class="form-hint">Format: JPG, PNG, WebP. Maks. 2 MB.</div>
                @error('image') <div class="form-error">{{ $message }}</div> @enderror
                <div id="img-preview-wrap" style="display:none;margin-top:10px;">
                    <img id="img-preview" style="max-width:300px;border-radius:8px;border:1px solid #e8e3dc;">
                </div>
            </div>

            <div class="form-group">
                <label class="form-label" for="video_url">URL Video YouTube</label>
                <input type="url" id="video_url" name="video_url" class="form-control"
                    value="{{ old('video_url') }}" placeholder="https://www.youtube.com/watch?v=...">
                <div class="form-hint">Masukkan link YouTube untuk embed video di pengumuman.</div>
                @error('video_url') <div class="form-error">{{ $message }}</div> @enderror
            </div>

            <div style="display:flex;gap:12px;margin-top:24px;">
                <button type="submit" class="btn btn-accent" id="btn-submit-announcement">Simpan Pengumuman</button>
                <a href="{{ route('admin.announcements.index') }}" class="btn btn-outline">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.getElementById('image').addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = e => {
                document.getElementById('img-preview').src = e.target.result;
                document.getElementById('img-preview-wrap').style.display = 'block';
            };
            reader.readAsDataURL(file);
        }
    });
</script>
@endsection
