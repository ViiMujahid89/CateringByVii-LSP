@extends('layouts.app')

@section('title', 'Paket Katering')
@section('meta_description', 'Pilih paket katering terbaik dari CateringByVii — paket acara dan paket box tersedia.')

@section('content')
<div class="page-header-row">
    <div>
        <h1 class="page-title">Paket Katering</h1>
        <p class="page-subtitle">Pilih paket yang sesuai dengan kebutuhan acara Anda.</p>
    </div>
</div>

@if($packages->isEmpty())
    <div class="card" style="text-align:center;padding:64px;">
        <div style="font-size:48px;margin-bottom:16px;">🍽️</div>
        <div style="font-size:16px;color:#888;">Belum ada paket katering tersedia.</div>
    </div>
@else
    @php
        $eventPackages = $packages->where('category', 'acara');
        $boxPackages   = $packages->where('category', 'box');
    @endphp

    {{-- ── PAKET ACARA ──────────────────────────────────────── --}}
    @if($eventPackages->isNotEmpty())
        <div class="pkg-section-header">
            <div class="pkg-section-title">
                <span class="pkg-section-icon">🎉</span>
                Paket Acara
            </div>
            <p class="pkg-section-desc">Solusi katering lengkap untuk acara besar — prasmanan, dekorasi, dan full service.</p>
        </div>

        <div class="grid-4 pkg-grid" style="margin-bottom: 48px;">
            @foreach($eventPackages as $package)
                <div class="package-card">
                    <div class="package-card-img">
                        @if($package->image)
                            <img src="{{ asset('storage/' . $package->image) }}" alt="{{ $package->name }}">
                        @else
                            <svg width="48" height="48" fill="none" viewBox="0 0 24 24" stroke="#C4922A" stroke-width="1" opacity="0.6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 15.546c-.523 0-1.046.151-1.5.454a2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.704 2.704 0 01-3 0A1.5 1.5 0 013 15.546V12a9 9 0 0118 0v3.546z"/>
                            </svg>
                        @endif
                    </div>
                    <div class="package-card-body">
                        <div class="package-card-name">{{ $package->name }}</div>
                        <div class="package-card-desc">{{ $package->description }}</div>
                        <div class="package-card-price">Rp {{ number_format($package->price, 0, ',', '.') }}</div>
                    </div>
                    <div class="package-card-footer">
                        <a href="{{ route('customer.orders.create', $package) }}"
                            class="btn btn-primary" style="width:100%;justify-content:center;"
                            id="btn-pesan-{{ $package->id }}">
                            Pesan Paket Ini
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    {{-- ── DIVIDER ──────────────────────────────────────────── --}}
    @if($eventPackages->isNotEmpty() && $boxPackages->isNotEmpty())
        <div class="pkg-divider"></div>
    @endif

    {{-- ── PAKET BOX ────────────────────────────────────────── --}}
    @if($boxPackages->isNotEmpty())
        <div class="pkg-section-header">
            <div class="pkg-section-title">
                <span class="pkg-section-icon">📦</span>
                Paket Box
            </div>
            <p class="pkg-section-desc">Praktis & terjangkau — nasi box dan snack box per kotak, cocok untuk rapat dan acara santai.</p>
        </div>

        <div class="grid-4 pkg-grid">
            @foreach($boxPackages as $package)
                <div class="package-card">
                    <div class="package-card-img">
                        @if($package->image)
                            <img src="{{ asset('storage/' . $package->image) }}" alt="{{ $package->name }}">
                        @else
                            <svg width="48" height="48" fill="none" viewBox="0 0 24 24" stroke="#C4922A" stroke-width="1" opacity="0.6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 15.546c-.523 0-1.046.151-1.5.454a2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.704 2.704 0 01-3 0A1.5 1.5 0 013 15.546V12a9 9 0 0118 0v3.546z"/>
                            </svg>
                        @endif
                    </div>
                    <div class="package-card-body">
                        <div class="package-card-name">{{ $package->name }}</div>
                        <div class="package-card-desc">{{ $package->description }}</div>
                        <div class="package-card-price">Rp {{ number_format($package->price, 0, ',', '.') }}</div>
                    </div>
                    <div class="package-card-footer">
                        <a href="{{ route('customer.orders.create', $package) }}"
                            class="btn btn-primary" style="width:100%;justify-content:center;"
                            id="btn-pesan-{{ $package->id }}">
                            Pesan Paket Ini
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
@endif
@endsection
