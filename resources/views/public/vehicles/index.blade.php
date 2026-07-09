@extends('public.layouts.public')

@section('content')
    @include('public.partials.navbar')

    <main class="fleet-page">

        {{-- <section class="fleet-header">
            <div class="public-container">

                <div class="section-title-row">
                    <div class="section-side-stripe">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>

                    <div>
                        <h2>OUR FLEET</h2>
                        <p>Premium vehicles for every occasion</p>
                    </div>
                </div>

            </div>
        </section> --}}

        <section class="fleet-filter">
            <div class="public-container">

                <form action="{{ route('vehicles.index') }}" method="GET" class="fleet-filter-form">

                    <div class="fleet-search">
                        <i class="fa-solid fa-magnifying-glass"></i>

                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari kendaraan...">
                    </div>

                    <div class="fleet-status-tabs">
                        <button type="submit" name="status" value="all"
                            class="{{ request('status', 'all') === 'all' ? 'active' : '' }}">
                            SEMUA
                        </button>

                        <button type="submit" name="status" value="available"
                            class="{{ request('status') === 'available' ? 'active' : '' }}">
                            TERSEDIA
                        </button>

                        <button type="submit" name="status" value="reserved"
                            class="{{ request('status') === 'reserved' ? 'active' : '' }}">
                            DIPESAN
                        </button>

                        <button type="submit" name="status" value="rented"
                            class="{{ request('status') === 'rented' ? 'active' : '' }}">
                            DIRENTAL
                        </button>
                    </div>

                </form>

            </div>
        </section>

        <section class="fleet-list">
            <div class="public-container">

                <p class="fleet-count">
                    Menampilkan {{ $cars->count() }} kendaraan
                </p>

                <div class="fleet-grid">

                    @forelse ($cars as $car)
                        <article class="fleet-card">

                            <div class="fleet-image-wrap">
                                <img src="{{ $car->thumbnail ? asset('storage/' . $car->thumbnail) : asset('images/default-car.jpg') }}"
                                    alt="{{ $car->brand }} {{ $car->name }}" class="fleet-image">

                                <span class="vehicle-status status-{{ $car->status }}">
                                    {{ strtoupper($car->status) }}
                                </span>
                            </div>

                            <div class="fleet-card-body">

                                <p class="fleet-brand">
                                    {{ strtoupper($car->brand) }}
                                </p>

                                <h3>
                                    {{ $car->name }}
                                </h3>

                                <div class="fleet-specs">
                                    <div>
                                        <span>TAHUN</span>
                                        <strong>{{ $car->year }}</strong>
                                    </div>

                                    <div>
                                        <span>JUMLAH KURSI</span>
                                        <strong>{{ $car->seats }}</strong>
                                    </div>
                                </div>

                                <p class="fleet-price">
                                    Rp {{ number_format($car->price_per_day, 0, ',', '.') }}
                                    <span>/hari</span>
                                </p>

                                <a href="{{ route('vehicles.show', $car) }}" class="vehicle-detail-btn">
                                    LIHAT DETAIL
                                    <span>→</span>
                                </a>

                            </div>

                        </article>
                    @empty
                        <div class="fleet-empty">
                            Tidak ada kendaraan yang ditemukan.
                        </div>
                    @endforelse

                </div>

            </div>
        </section>

    </main>

    @include('public.partials.footer')
@endsection
