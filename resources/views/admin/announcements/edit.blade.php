@extends('layouts.admin')

@section('title', 'Edit Pengumuman')
@section('page_title', 'Edit Pengumuman')
@section('breadcrumb', 'Admin / Pengumuman / Edit')

@section('topbar_actions')
    <a href="{{ route('admin.announcements.index') }}" class="btn btn-outline btn-sm">&larr; Kembali</a>
@endsection

@section('content')
<div style="max-width:760px;">
    <div class="card">
        <form method="POST" action="{{ route('admin.announcements.update', $announcement) }}" enctype="multipart/form-data" id="form-edit-announcement">
            @csrf @method('PUT')

            <div class="form-group">
                <label class="form-label" for="title">Judul Pengumuman</label>
                <input type="text" id="title" name="title" class="form-control"
                    value="{{ old('title', $announcement->title) }}" required>
                @error('title') <div class="form-error">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label class="form-label" for="content">Isi Pengumuman</label>
                <textarea id="content" name="content" class="form-control" required
                    style="min-height:200px;">{{ old('content', $announcement->content) }}</textarea>
                @error('content') <div class="form-error">{{ $message }}</div> @enderror
            </div>

            <hr style="border:none;border-top:1px solid #ece8e2;margin:20px 0;">
            <div style="font-size:10px;letter-spacing:0.1em;text-transform:uppercase;color:#aaa;margin-bottom:16px;">Media (Opsional)</div>

            <div class="form-group">
                <label class="form-label" for="image">Gambar</label>
                @if($announcement->image)
                    <div style="margin-bottom:10px;">
                        <div style="font-size:12px;color:#888;margin-bottom:6px;">Gambar saat ini:</div>
                        <img src="{{ asset('storage/' . $announcement->image) }}" style="max-width:200px;border-radius:6px;border:1px solid #e8e3dc;">
                    </div>
                @endif
                <input type="file" id="image" name="image" class="form-control" accept="image/jpeg,image/png,image/webp">
                <div class="form-hint">Kosongkan jika tidak ingin mengubah gambar. Format: JPG, PNG, WebP. Maks. 2 MB.</div>
                @error('image') <div class="form-error">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label class="form-label" for="video_url">URL Video YouTube</label>
                <input type="url" id="video_url" name="video_url" class="form-control"
                    value="{{ old('video_url', $announcement->video_url) }}" placeholder="https://www.youtube.com/watch?v=...">
                @error('video_url') <div class="form-error">{{ $message }}</div> @enderror
            </div>

            <div style="display:flex;gap:12px;margin-top:24px;">
                <button type="submit" class="btn btn-accent" id="btn-update-announcement">Simpan Perubahan</button>
                <a href="{{ route('admin.announcements.index') }}" class="btn btn-outline">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
