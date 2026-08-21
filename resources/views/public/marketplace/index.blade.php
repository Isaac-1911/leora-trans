@extends('layouts.public')

@section('page-title', 'UMKM Desa Dadapan')

@section('content')

    <section class="public-page-header">
        <div class="public-container">
            <nav class="public-breadcrumb">
                <a href="{{ route('home') }}">Beranda</a>
                <span>/</span>
                <span>UMKM</span>
            </nav>
            <span class="public-eyebrow">Marketplace Desa</span>
            <h1 class="public-page-header__title">UMKM Desa Dadapan</h1>
            <p class="public-text">Temukan produk pilihan dan pelaku UMKM lokal Desa Dadapan.</p>
        </div>
    </section>

    <section class="public-tabs">
        <div class="public-container">
            <div class="public-tabs__nav">
                <a href="{{ route('marketplace.index', ['tab' => 'produk']) }}" class="public-tab-btn {{ $tab === 'produk' ? 'is-active' : '' }}">Semua Produk</a>
                <a href="{{ route('marketplace.index', ['tab' => 'umkm']) }}" class="public-tab-btn {{ $tab === 'umkm' ? 'is-active' : '' }}">Daftar UMKM</a>
            </div>
        </div>
    </section>

    <section class="public-section">
        <div class="public-container">

            @if ($tab === 'umkm')

                {{-- ===== TAB: DAFTAR UMKM ===== --}}
                <form method="GET" action="{{ route('marketplace.index') }}" class="public-search-bar">
                    <input type="hidden" name="tab" value="umkm">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" /></svg>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama UMKM..." class="public-search-bar__input">
                </form>

                @if ($sellers->isEmpty())
                    <p class="public-empty">Belum ada UMKM terdaftar.</p>
                @else
                    <div class="public-seller-grid">
                        @foreach ($sellers as $seller)
                            <a href="{{ route('marketplace.index', ['tab' => 'produk', 'seller' => $seller->id]) }}" class="public-seller-card">
                                <img src="{{ $seller->logo ? asset('storage/' . $seller->logo) : asset('images/placeholder-logo.png') }}" alt="{{ $seller->business_name }}" class="public-seller-card__logo">
                                <h3 class="public-seller-card__name">{{ $seller->business_name }}</h3>
                                <span class="public-seller-card__owner">{{ $seller->owner_name }}</span>
                                <span class="public-seller-card__count">{{ $seller->products_count }} produk</span>
                            </a>
                        @endforeach
                    </div>

                    <div class="public-pagination-wrap">{{ $sellers->links() }}</div>
                @endif

            @else

                {{-- ===== TAB: SEMUA PRODUK ===== --}}
                @if (request('seller'))
                    @php $activeSeller = $categories->isNotEmpty() ? \App\Models\SellerProfile::find(request('seller')) : null; @endphp
                    @if ($activeSeller)
                        <div class="public-active-filter">
                            Menampilkan produk dari <strong>{{ $activeSeller->business_name }}</strong>
                            <a href="{{ route('marketplace.index', ['tab' => 'produk']) }}">Hapus filter</a>
                        </div>
                    @endif
                @endif

                @if ($categories->isNotEmpty())
                    <div class="public-filter-chips">
                        <a href="{{ route('marketplace.index', array_filter(['tab' => 'produk', 'seller' => request('seller')])) }}" class="public-filter-chip {{ !request('category') ? 'is-active' : '' }}">Semua Kategori</a>
                        @foreach ($categories as $category)
                            <a href="{{ route('marketplace.index', array_filter(['tab' => 'produk', 'category' => $category->id, 'seller' => request('seller')])) }}" class="public-filter-chip {{ request('category') == $category->id ? 'is-active' : '' }}">{{ $category->name }}</a>
                        @endforeach
                    </div>
                @endif

                @if ($products->isEmpty())
                    <p class="public-empty">Belum ada produk yang tersedia.</p>
                @else
                    <div class="public-product-grid">
                        @foreach ($products as $product)
                            <a href="{{ route('marketplace.show', $product) }}" class="public-product-card">
                                <div class="public-product-card__media">
                                    <img src="{{ asset('storage/' . $product->thumbnail) }}" alt="{{ $product->name }}">
                                    <span class="public-badge">{{ $product->category->name }}</span>
                                </div>
                                <div class="public-product-card__body">
                                    <h3 class="public-product-card__title">{{ $product->name }}</h3>
                                    <span class="public-product-card__seller">{{ $product->sellerProfile->business_name }}</span>
                                    <span class="public-product-card__price">Rp{{ number_format($product->price, 0, ',', '.') }}</span>
                                </div>
                            </a>
                        @endforeach
                    </div>

                    <div class="public-pagination-wrap">{{ $products->links() }}</div>
                @endif

            @endif

        </div>
    </section>

@endsection
