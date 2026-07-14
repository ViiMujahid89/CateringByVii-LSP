@extends('layouts.admin')

@section('title', 'Verifikasi Akun')
@section('page_title', 'Verifikasi Akun Pelanggan')
@section('breadcrumb', 'Admin / Verifikasi Akun')

@section('content')
{{-- Filter tabs --}}
<div class="d-flex gap-2 mb-6">
    @foreach(['pending' => 'Pending', 'approved' => 'Disetujui', 'rejected' => 'Ditolak', 'all' => 'Semua'] as $val => $label)
        <a href="{{ route('admin.users.index', ['status' => $val]) }}"
            class="btn {{ $status === $val ? 'btn-primary' : 'btn-outline' }} btn-sm">
            {{ $label }}
        </a>
    @endforeach
</div>

<div class="card">
    @if($users->isEmpty())
        <div style="text-align:center;padding:64px 0;color:#aaa;">
            <div style="font-size:48px;margin-bottom:16px;">✅</div>
            <div>Tidak ada akun dengan status <strong>{{ $status }}</strong>.</div>
        </div>
    @else
        <table class="data-table">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Telepon</th>
                    <th>Tanggal Daftar</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td style="font-weight:500;">{{ $user->name }}</td>
                        <td class="text-muted">{{ $user->email }}</td>
                        <td class="text-muted">{{ $user->phone ?? '—' }}</td>
                        <td class="text-muted">{{ $user->created_at->format('d M Y') }}</td>
                        <td>
                            <span class="badge badge-{{ $user->status === 'approved' ? 'success' : ($user->status === 'pending' ? 'warning' : 'danger') }}">
                                {{ ucfirst($user->status) }}
                            </span>
                        </td>
                        <td>
                            <div class="d-flex gap-2">
                                @if($user->status !== 'approved')
                                    <form method="POST" action="{{ route('admin.users.verify', $user) }}" id="form-approve-{{ $user->id }}">
                                        @csrf @method('PATCH')
                                        <input type="hidden" name="action" value="approved">
                                        <button type="submit" class="btn btn-success btn-xs" id="btn-approve-{{ $user->id }}">✓ Setujui</button>
                                    </form>
                                @endif
                                @if($user->status !== 'rejected')
                                    <form method="POST" action="{{ route('admin.users.verify', $user) }}" id="form-reject-{{ $user->id }}">
                                        @csrf @method('PATCH')
                                        <input type="hidden" name="action" value="rejected">
                                        <button type="submit" class="btn btn-danger btn-xs"
                                            data-confirm="Tolak akun {{ $user->name }}?"
                                            data-confirm-text="Akun pelanggan akan ditolak."
                                            data-form="form-reject-{{ $user->id }}"
                                            id="btn-reject-{{ $user->id }}">✕ Tolak</button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="pagination-wrapper">{{ $users->links() }}</div>
    @endif
</div>
@endsection
