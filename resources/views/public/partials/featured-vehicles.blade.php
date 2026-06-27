<section class="featured-vehicles" id="vehicles">
    <div class="public-container">

        <div class="section-title-row">
            <div class="section-side-stripe">
                <span></span>
                <span></span>
                <span></span>
            </div>

            <div>
                <h2>FEATURED VEHICLES</h2>
                <p>Explore our premium collection</p>
            </div>
        </div>

        <div class="vehicle-grid">
            @foreach ($cars as $car)
                <article class="vehicle-card">

                    <div class="vehicle-image-wrap">
                        <img
                            src="{{ $car->thumbnail ? asset('storage/' . $car->thumbnail) : asset('images/default-car.jpg') }}"
                            alt="{{ $car->brand }} {{ $car->name }}"
                            class="vehicle-image"
                        >

                        <span class="vehicle-status status-{{ $car->status }}">
                            {{ strtoupper($car->status) }}
                        </span>
                    </div>

                    <div class="vehicle-content">
                        <p class="vehicle-brand">{{ strtoupper($car->brand) }}</p>

                        <h3>{{ $car->name }}</h3>

                        <p class="vehicle-price">
                            Rp {{ number_format($car->price_per_day, 0, ',', '.') }}
                            <span>/day</span>
                        </p>

                        <a href="#" class="vehicle-detail-btn">
                            VIEW DETAILS
                            <span>→</span>
                        </a>
                    </div>

                </article>
            @endforeach
        </div>

        <div class="view-all-wrap">
            <a href="#" class="view-all-btn">
                VIEW ALL VEHICLES
                <span>→</span>
            </a>
        </div>

    </div>
</section>
