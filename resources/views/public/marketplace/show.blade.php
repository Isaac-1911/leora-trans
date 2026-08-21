@extends('layouts.public')

@section('page-title', $product->name)
@section('page-description', Str::limit(strip_tags($product->description), 150))

@section('content')

    <section class="public-page-header">
        <div class="public-container">
            <nav class="public-breadcrumb">
                <a href="{{ route('home') }}">Beranda</a>
                <span>/</span>
                <a href="{{ route('marketplace.index') }}">UMKM</a>
                <span>/</span>
                <span>{{ Str::limit($product->name, 40) }}</span>
            </nav>
        </div>
    </section>

    <section class="public-section public-product-detail">
        <div class="public-container public-product-detail__grid">

            {{-- ===== GALERI GAMBAR ===== --}}
            <div class="public-product-gallery">
                <div class="public-product-gallery__main">
                    <img id="product-main-image" src="{{ asset('storage/' . $product->thumbnail) }}" alt="{{ $product->name }}">
                </div>

                @if ($product->images->isNotEmpty())
                    <div class="public-product-gallery__thumbs">
                        <button type="button" class="public-product-gallery__thumb is-active" data-image="{{ asset('storage/' . $product->thumbnail) }}">
                            <img src="{{ asset('storage/' . $product->thumbnail) }}" alt="Thumbnail utama">
                        </button>
                        @foreach ($product->images as $img)
                            <button type="button" class="public-product-gallery__thumb" data-image="{{ asset('storage/' . $img->image_url) }}">
                                <img src="{{ asset('storage/' . $img->image_url) }}" alt="Galeri produk">
                            </button>
                        @endforeach
                    </div>
                @endif
            </div>

            {{-- ===== INFO PRODUK ===== --}}
            <div class="public-product-info">
                <span class="public-badge--muted">{{ $product->category->name }}</span>
                <h1 class="public-product-info__title">{{ $product->name }}</h1>
                <span class="public-product-info__price">Rp{{ number_format($product->price, 0, ',', '.') }}</span>

                <div class="public-product-info__stock">
                    @if ($product->stock > 0)
                        <span class="public-badge admin-badge--success" style="background:#f0fdf4;color:#16a34a;">Stok tersedia ({{ $product->stock }})</span>
                    @else
                        <span class="public-badge" style="background:#fef2f2;color:#dc2626;">Stok habis</span>
                    @endif
                </div>

                <p class="public-product-info__desc">{{ $product->description }}</p>

                <div class="public-seller-mini-card">
                    <img src="{{ $product->sellerProfile->logo ? asset('storage/' . $product->sellerProfile->logo) : asset('images/placeholder-logo.png') }}" alt="{{ $product->sellerProfile->business_name }}">
                    <div>
                        <span class="public-seller-mini-card__name">{{ $product->sellerProfile->business_name }}</span>
                        <span class="public-seller-mini-card__owner">{{ $product->sellerProfile->owner_name }}</span>
                    </div>
                </div>

                @php
                    $waMessage = "Halo, saya tertarik dengan produk \"{$product->name}\" seharga Rp" . number_format($product->price, 0, ',', '.') . ". Apakah masih tersedia?";
                    $waLink = 'https://wa.me/' . $product->sellerProfile->whatsapp . '?text=' . rawurlencode($waMessage);
                @endphp

                <a href="{{ $waLink }}" target="_blank" rel="noopener" class="public-btn public-btn--whatsapp public-btn--lg">
                    <svg viewBox="0 0 24 24" fill="currentColor" style="width:19px;height:19px;margin-right:0.5rem;"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/><path d="M12.001 2.003c-5.514 0-9.998 4.484-9.998 9.997 0 1.762.462 3.484 1.34 5.001L2 22l5.116-1.341a9.96 9.96 0 0 0 4.885 1.243h.004c5.513 0 9.997-4.484 9.997-9.998 0-2.67-1.04-5.18-2.929-7.069a9.933 9.933 0 0 0-7.072-2.832zm5.848 15.845c-.248.7-1.443 1.375-1.99 1.457-.508.076-1.146.108-1.85-.117-.427-.135-.975-.315-1.674-.616-2.946-1.273-4.87-4.24-5.017-4.437-.147-.198-1.202-1.598-1.202-3.05 0-1.452.762-2.166 1.032-2.462.27-.297.588-.371.784-.371h.564c.18 0 .424-.068.663.507.248.594.842 2.05.916 2.199.075.148.124.322.024.52-.099.199-.148.322-.297.496-.148.174-.312.39-.446.523-.148.148-.303.31-.13.607.173.298.771 1.272 1.654 2.06 1.135 1.012 2.093 1.325 2.39 1.475.297.148.47.124.644-.075.173-.198.743-.867.94-1.164.198-.297.396-.248.669-.15.272.1 1.734.818 2.031.967.297.15.495.223.57.347.074.124.074.719-.174 1.413z"/></svg>
                    Pesan via WhatsApp
                </a>
            </div>

        </div>

        {{-- ===== PRODUK TERKAIT ===== --}}
        @if ($relatedProducts->isNotEmpty())
            <div class="public-container" style="margin-top: 5rem;">
                <h2 class="public-heading" style="text-align:left;">Produk Terkait</h2>
                <div class="public-product-grid">
                    @foreach ($relatedProducts as $related)
                        <a href="{{ route('marketplace.show', $related) }}" class="public-product-card">
                            <div class="public-product-card__media">
                                <img src="{{ asset('storage/' . $related->thumbnail) }}" alt="{{ $related->name }}">
                            </div>
                            <div class="public-product-card__body">
                                <h3 class="public-product-card__title">{{ $related->name }}</h3>
                                <span class="public-product-card__seller">{{ $related->sellerProfile->business_name }}</span>
                                <span class="public-product-card__price">Rp{{ number_format($related->price, 0, ',', '.') }}</span>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif
    </section>

@endsection

@push('scripts')
    <script src="{{ asset('js/public/product-gallery.js') }}" defer></script>
@endpush
