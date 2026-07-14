@extends('layouts.admin')

@section('title', 'Kelola Paket')
@section('page_title', 'Kelola Paket Katering')
@section('breadcrumb', 'Admin / Paket')

@section('topbar_actions')
    <a href="{{ route('admin.packages.create') }}" class="btn btn-accent" id="btn-tambah-paket">
        + Tambah Paket
    </a>
@endsection

@section('content')
<div class="card">
    @if($packages->isEmpty())
        <div style="text-align:center;padding:64px 0;color:#aaa;">
            <div style="font-size:48px;margin-bottom:16px;">🍽️</div>
            <div style="margin-bottom:16px;">Belum ada paket katering.</div>
            <a href="{{ route('admin.packages.create') }}" class="btn btn-accent btn-sm">Tambah Paket Pertama</a>
        </div>
    @else
        <table class="data-table">
            <thead>
                <tr>
                    <th>Gambar</th>
                    <th>Nama Paket</th>
                    <th>Harga</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($packages as $package)
                    <tr>
                        {{-- Thumbnail --}}
                        <td>
                            @if($package->image)
                                <img src="{{ asset('storage/' . $package->image) }}"
                                    alt="{{ $package->name }}"
                                    style="width:64px;height:48px;object-fit:cover;border-radius:6px;border:1px solid #e8e3dc;">
                            @else
                                <div style="width:64px;height:48px;background:#f5ede0;border-radius:6px;display:flex;align-items:center;justify-content:center;border:1px solid #e8e3dc;">
                                    <span style="font-size:18px;">🍽️</span>
                                </div>
                            @endif
                        </td>

                        {{-- Nama & deskripsi --}}
                        <td>
                            <div style="font-weight:600;color:#2C1810;">{{ $package->name }}</div>
                            <div class="text-muted" style="font-size:12px;max-width:280px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">
                                {{ $package->description }}
                            </div>
                        </td>

                        {{-- Harga --}}
                        <td style="font-weight:600;color:#C4922A;">
                            Rp {{ number_format($package->price, 0, ',', '.') }}
                        </td>

                        {{-- Status toggle --}}
                        <td>
                            <form method="POST"
                                action="{{ route('admin.packages.toggle', $package) }}"
                                id="form-toggle-{{ $package->id }}">
                                @csrf @method('PATCH')
                                <button type="submit"
                                    id="btn-toggle-{{ $package->id }}"
                                    class="pkg-toggle-btn {{ $package->is_active ? 'pkg-toggle-btn--active' : 'pkg-toggle-btn--inactive' }}"
                                    title="{{ $package->is_active ? 'Klik untuk nonaktifkan' : 'Klik untuk aktifkan' }}">
                                    <span class="pkg-toggle-dot"></span>
                                    <span class="pkg-toggle-label">
                                        {{ $package->is_active ? 'Aktif' : 'Nonaktif' }}
                                    </span>
                                </button>
                            </form>
                        </td>

                        {{-- Aksi --}}
                        <td>
                            <div class="d-flex gap-2">
                                <a href="{{ route('admin.packages.edit', $package) }}"
                                    class="btn btn-outline btn-sm" id="btn-edit-{{ $package->id }}">
                                    Edit / Gambar
                                </a>
                                <form method="POST" action="{{ route('admin.packages.destroy', $package) }}"
                                    onsubmit="return confirm('Hapus paket ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                        id="btn-hapus-{{ $package->id }}">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
