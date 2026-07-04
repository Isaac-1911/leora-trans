@extends('public.layouts.public')

@section('content')
    @include('public.partials.navbar')

    <main class="vehicle-detail-page">

        <section class="vehicle-detail-media">
            <div class="public-container">

                <a href="{{ route('vehicles.index') }}" class="back-link">
                    <span>←</span>
                    BACK TO VEHICLES
                </a>

                <div class="detail-main-image-wrap">
                    <img src="{{ $car->thumbnail ? asset('storage/' . $car->thumbnail) : asset('images/default-car.jpg') }}"
                        alt="{{ $car->brand }} {{ $car->name }}" class="detail-main-image">

                    <span class="vehicle-status detail-status status-{{ $car->status }}">
                        {{ strtoupper($car->status) }}
                    </span>
                </div>

                {{-- <div class="detail-gallery-grid">

                    <div class="detail-thumb">
                        <img
                            src="{{ $car->thumbnail ? asset('storage/' . $car->thumbnail) : asset('images/default-car.jpg') }}"
                            alt="{{ $car->brand }} {{ $car->name }}"
                        >
                    </div>

                    @foreach ($car->images->take(2) as $image)
                        <div class="detail-thumb">
                            <img
                                src="{{ asset('storage/' . $image->image) }}"
                                alt="{{ $car->brand }} {{ $car->name }}"
                            >
                        </div>
                    @endforeach

                </div> --}}

            </div>
        </section>

        <section class="vehicle-detail-content">
            <div class="public-container">

                <div class="detail-layout">

                    <div class="detail-left">

                        <div class="detail-info-card">

                            <div class="detail-info-header">

                                <div>
                                    <p class="detail-brand">{{ strtoupper($car->brand) }}</p>

                                    <h1>
                                        {{ strtoupper($car->brand) }}
                                        {{ strtoupper($car->name) }}
                                    </h1>

                                    <p class="detail-meta">
                                        Year: {{ $car->year }}
                                        <span>•</span>
                                        Plate: {{ $car->plate_number }}
                                    </p>
                                </div>

                                <div class="detail-price-box">
                                    <strong>
                                        Rp {{ number_format($car->price_per_day, 0, ',', '.') }}
                                    </strong>
                                    <span>per day</span>
                                </div>

                            </div>

                            <div class="detail-m-stripe">
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>

                            <p class="detail-description">
                                {{ $car->description }}
                            </p>

                        </div>

                        <div class="spec-card">

                            <h2>SPECIFICATIONS</h2>

                            <div class="spec-grid">

                                <div class="spec-item">
                                    <div class="spec-icon">
                                        <i class="fa-solid fa-calendar-days"></i>
                                    </div>

                                    <div>
                                        <span>YEAR</span>
                                        <strong>{{ $car->year }}</strong>
                                    </div>
                                </div>

                                <div class="spec-item">
                                    <div class="spec-icon">
                                        <i class="fa-solid fa-id-card"></i>
                                    </div>

                                    <div>
                                        <span>PLATE NUMBER</span>
                                        <strong>{{ $car->plate_number }}</strong>
                                    </div>
                                </div>

                                <div class="spec-item">
                                    <div class="spec-icon">
                                        <i class="fa-solid fa-location-dot"></i>
                                    </div>

                                    <div>
                                        <span>LOCATION</span>
                                        <strong>
                                            {{ $car->car_location_link ? 'Available' : 'Not Set' }}
                                        </strong>
                                    </div>
                                </div>

                                <div class="spec-item">
                                    <div class="spec-icon">
                                        <i class="fa-solid fa-car"></i>
                                    </div>

                                    <div>
                                        <span>STATUS</span>
                                        <strong>{{ strtoupper($car->status) }}</strong>
                                    </div>
                                </div>

                            </div>

                        </div>

                    </div>

                    <aside class="booking-panel">

                        <h2>BOOK THIS VEHICLE</h2>

                        <form id="bookingWhatsappForm">

                            <label>RENTAL PERIOD</label>

                            <input type="date" id="startDate" name="start_date" required>

                            <input type="date" id="endDate" name="end_date" required>

                            <div class="booking-summary">

                                <div class="summary-row">
                                    <span>Daily Rate</span>
                                    <strong id="dailyRateText">
                                        Rp {{ number_format($car->price_per_day, 0, ',', '.') }}
                                    </strong>
                                </div>

                                <div class="summary-row">
                                    <span>Duration</span>
                                    <strong id="durationText">0 day</strong>
                                </div>

                                <div class="summary-stripe">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </div>

                                <div class="summary-total">
                                    <span>TOTAL</span>
                                    <strong id="totalPriceText">Rp 0</strong>
                                </div>

                            </div>

                            <button type="submit" class="booking-main-btn">
                                BOOK NOW
                            </button>

                            <a id="whatsappContactBtn" href="#" class="booking-wa-btn" target="_blank">
                                CONTACT VIA WHATSAPP
                            </a>

                            <p class="booking-help">
                                Need help? Contact our team for personalized assistance.
                            </p>

                        </form>

                    </aside>

                </div>

            </div>
        </section>

    </main>

    @include('public.partials.footer')

    <script>
        const carName = @json($car->brand . ' ' . $car->name);
        const carYear = @json($car->year);
        const plateNumber = @json($car->plate_number);
        const dailyRate = Number(@json($car->price_per_day));

        // Ganti nomor ini ke nomor WhatsApp admin Leora Trans
        const adminWhatsappNumber = '6281234567890';

        const startDateInput = document.getElementById('startDate');
        const endDateInput = document.getElementById('endDate');

        const durationText = document.getElementById('durationText');
        const totalPriceText = document.getElementById('totalPriceText');

        const bookingWhatsappForm = document.getElementById('bookingWhatsappForm');
        const whatsappContactBtn = document.getElementById('whatsappContactBtn');

        function formatRupiah(number) {
            return new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                maximumFractionDigits: 0
            }).format(number).replace('IDR', 'Rp');
        }

        function formatDateIndo(dateString) {
            if (!dateString) return '-';

            const date = new Date(dateString);

            return new Intl.DateTimeFormat('id-ID', {
                day: '2-digit',
                month: 'long',
                year: 'numeric'
            }).format(date);
        }

        function calculateBooking() {
            const startDate = startDateInput.value;
            const endDate = endDateInput.value;

            if (!startDate || !endDate) {
                return {
                    isValid: false,
                    duration: 0,
                    total: 0,
                };
            }

            const start = new Date(startDate);
            const end = new Date(endDate);

            if (end < start) {
                return {
                    isValid: false,
                    duration: 0,
                    total: 0,
                };
            }

            // Inclusive: tanggal 1 sampai tanggal 3 = 3 hari
            const diffTime = end.getTime() - start.getTime();
            const duration = Math.floor(diffTime / (1000 * 60 * 60 * 24)) + 1;
            const total = duration * dailyRate;

            return {
                isValid: true,
                duration,
                total,
            };
        }

        function updateSummary() {
            const result = calculateBooking();

            durationText.textContent = result.duration + (result.duration > 1 ? ' days' : ' day');
            totalPriceText.textContent = formatRupiah(result.total);

            return result;
        }

        function buildWhatsappUrl() {
            const result = updateSummary();

            if (!result.isValid) {
                return null;
            }

            const message =
                `Halo Admin Leora Trans, saya ingin booking mobil.

Detail Mobil:
- Mobil: ${carName}
- Tahun: ${carYear}
- Plat Nomor: ${plateNumber}
- Harga per Hari: ${formatRupiah(dailyRate)}

Detail Rental:
- Tanggal Mulai: ${formatDateIndo(startDateInput.value)}
- Tanggal Selesai: ${formatDateIndo(endDateInput.value)}
- Durasi: ${result.duration} hari
- Total Harga: ${formatRupiah(result.total)}

Mohon info ketersediaan dan proses booking selanjutnya.`;

            return `https://wa.me/${adminWhatsappNumber}?text=${encodeURIComponent(message)}`;
        }

        startDateInput.addEventListener('change', function() {
            endDateInput.min = startDateInput.value;

            if (endDateInput.value && endDateInput.value < startDateInput.value) {
                endDateInput.value = startDateInput.value;
            }

            updateSummary();
        });

        endDateInput.addEventListener('change', updateSummary);

        bookingWhatsappForm.addEventListener('submit', function(event) {
            event.preventDefault();

            const whatsappUrl = buildWhatsappUrl();

            if (!whatsappUrl) {
                alert('Tanggal rental belum valid. Pastikan tanggal selesai tidak lebih awal dari tanggal mulai.');
                return;
            }

            window.open(whatsappUrl, '_blank');
        });

        whatsappContactBtn.addEventListener('click', function(event) {
            event.preventDefault();

            const whatsappUrl = buildWhatsappUrl();

            if (!whatsappUrl) {
                const defaultMessage =
                    `Halo Admin Leora Trans, saya ingin bertanya tentang mobil ${carName}.`;

                window.open(
                    `https://wa.me/${adminWhatsappNumber}?text=${encodeURIComponent(defaultMessage)}`,
                    '_blank'
                );

                return;
            }

            window.open(whatsappUrl, '_blank');
        });

        updateSummary();
    </script>
@endsection
