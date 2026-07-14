@extends('layouts.app')

@section('title', 'Pengumuman')

@section('content')
<div class="page-header">
    <h1 class="page-title">Pengumuman</h1>
    <p class="page-subtitle">Informasi terbaru dari CateringByVii.</p>
</div>

@if($announcements->isEmpty())
    <div class="card" style="text-align:center;padding:64px;color:#aaa;">
        <div style="font-size:48px;margin-bottom:16px;">📢</div>
        <div style="font-size:16px;">Belum ada pengumuman saat ini.</div>
    </div>
@else
    <div class="grid-3">
        @foreach($announcements as $announcement)
            <div class="card" style="padding:0;overflow:hidden;transition:transform 0.2s,box-shadow 0.2s;" onmouseover="this.style.transform='translateY(-3px)';this.style.boxShadow='0 8px 24px rgba(44,24,16,0.1)'" onmouseout="this.style.transform='';this.style.boxShadow=''">
                @if($announcement->image)
                    <img src="{{ asset('storage/' . $announcement->image) }}" alt="{{ $announcement->title }}"
                        style="width:100%;height:160px;object-fit:cover;">
                @else
                    <div style="height:100px;background:linear-gradient(135deg,#f5ede0,#e8d4b8);display:flex;align-items:center;justify-content:center;font-size:32px;">📢</div>
                @endif

                <div style="padding:20px;">
                    <div style="font-family:'Playfair Display',serif;font-size:1rem;font-weight:600;color:#2C1810;margin-bottom:8px;line-height:1.3;">
                        {{ $announcement->title }}
                    </div>
                    <div style="font-size:12px;color:#aaa;margin-bottom:12px;">
                        {{ $announcement->createdBy->name }} · {{ $announcement->created_at->format('d M Y') }}
                    </div>
                    <div style="font-size:13px;color:#666;line-height:1.6;margin-bottom:16px;display:-webkit-box;-webkit-line-clamp:3;-webkit-box-orient:vertical;overflow:hidden;">
                        {{ $announcement->content }}
                    </div>
                    <a href="{{ route('customer.announcements.show', $announcement) }}"
                        style="font-size:13px;color:#C4922A;font-weight:500;text-decoration:none;" id="btn-announcement-{{ $announcement->id }}">
                        Baca Selengkapnya →
                    </a>
                </div>
            </div>
        @endforeach
    </div>

    <div class="pagination-wrapper">
        {{ $announcements->links() }}
    </div>
@endif
@endsection
