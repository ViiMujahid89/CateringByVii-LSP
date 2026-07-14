@extends('layouts.app')

@section('title', $announcement->title)

@section('content')
<div class="page-header">
    <a href="{{ route('customer.announcements.index') }}" class="btn btn-outline btn-sm" style="margin-bottom:16px;">&larr; Kembali</a>
</div>

<div style="max-width:760px;margin:0 auto;">
    <div class="card">
        @if($announcement->image)
            <img src="{{ asset('storage/' . $announcement->image) }}" alt="{{ $announcement->title }}"
                style="width:100%;height:300px;object-fit:cover;border-radius:8px;margin-bottom:24px;">
        @endif

        <div style="font-size:11px;letter-spacing:0.1em;text-transform:uppercase;color:#aaa;margin-bottom:8px;">
            {{ $announcement->created_at->format('d F Y') }} · {{ $announcement->createdBy->name }}
        </div>

        <h1 style="font-family:'Playfair Display',serif;font-size:1.8rem;font-weight:600;color:#2C1810;line-height:1.3;margin-bottom:24px;">
            {{ $announcement->title }}
        </h1>

        <div style="font-size:15px;color:#444;line-height:1.85;white-space:pre-line;">
            {{ $announcement->content }}
        </div>

        {{-- Embedded Video --}}
        @if($announcement->hasVideo())
            <div style="margin-top:32px;">
                <div style="font-size:12px;letter-spacing:0.1em;text-transform:uppercase;color:#aaa;margin-bottom:12px;">Video</div>
                <div style="position:relative;padding-bottom:56.25%;height:0;overflow:hidden;border-radius:8px;">
                    <iframe
                        src="{{ $announcement->embed_url }}"
                        style="position:absolute;top:0;left:0;width:100%;height:100%;border:none;border-radius:8px;"
                        allowfullscreen
                        title="{{ $announcement->title }}">
                    </iframe>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
