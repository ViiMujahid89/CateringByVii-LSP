@extends('layouts.admin')

@section('title', 'Pengumuman')
@section('page_title', 'Kelola Pengumuman')
@section('breadcrumb', 'Admin / Pengumuman')

@section('topbar_actions')
    <a href="{{ route('admin.announcements.create') }}" class="btn btn-accent" id="btn-tambah-pengumuman">
        + Buat Pengumuman
    </a>
@endsection

@section('content')
<div class="card">
    @if($announcements->isEmpty())
        <div style="text-align:center;padding:64px 0;color:#aaa;">
            <div style="font-size:48px;margin-bottom:16px;">📢</div>
            <div style="margin-bottom:16px;">Belum ada pengumuman.</div>
            <a href="{{ route('admin.announcements.create') }}" class="btn btn-accent btn-sm">Buat Pengumuman Pertama</a>
        </div>
    @else
        <table class="data-table">
            <thead>
                <tr>
                    <th>Judul</th>
                    <th>Dibuat Oleh</th>
                    <th>Tanggal</th>
                    <th>Media</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($announcements as $announcement)
                    <tr>
                        <td style="font-weight:500;max-width:300px;">{{ $announcement->title }}</td>
                        <td class="text-muted">{{ $announcement->createdBy->name }}</td>
                        <td class="text-muted">{{ $announcement->created_at->format('d M Y') }}</td>
                        <td>
                            <div class="d-flex gap-2">
                                @if($announcement->image) <span class="badge badge-info">Gambar</span> @endif
                                @if($announcement->video_url) <span class="badge badge-primary">Video</span> @endif
                                @if(!$announcement->image && !$announcement->video_url) <span class="text-muted">—</span> @endif
                            </div>
                        </td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="{{ route('admin.announcements.edit', $announcement) }}" class="btn btn-outline btn-xs" id="btn-edit-{{ $announcement->id }}">Edit</a>
                                <form method="POST" action="{{ route('admin.announcements.destroy', $announcement) }}" id="form-delete-{{ $announcement->id }}">
                                    @csrf @method('DELETE')
                                    <button type="button" class="btn btn-danger btn-xs"
                                        data-confirm="Hapus pengumuman ini?"
                                        data-confirm-text="Data pengumuman akan dihapus permanen."
                                        data-form="form-delete-{{ $announcement->id }}"
                                        id="btn-delete-{{ $announcement->id }}">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="pagination-wrapper">{{ $announcements->links() }}</div>
    @endif
</div>
@endsection
