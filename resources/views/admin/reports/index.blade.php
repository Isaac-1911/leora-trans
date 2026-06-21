@extends('layouts.admin')

@section('title', 'Reports')

@section('content')

    <div class="cars-header">

        <div class="cars-title-wrapper">

            <div class="m-stripe-vertical">

                <span class="blue-light"></span>
                <span class="blue-dark"></span>
                <span class="red"></span>

            </div>

            <div>

                <h1 class="cars-title">
                    REPORTS & ANALYTICS
                </h1>

                <p class="cars-subtitle">
                    Business performance insights
                </p>

            </div>

        </div>

    </div>

    <div class="report-filter-card">

        <div class="report-filter-left">
            <i class="fa-solid fa-calendar"></i>

            <span>
                Report Period
            </span>
        </div>

        <form method="GET" class="report-filter-right">

        <button class="report-filter-btn  {{ request('period') == 'month' || !request('period') ? 'active' : '' }}" name="period"
            value="month">

            THIS MONTH

        </button>

        <button class="report-filter-btn {{ request('period') == '3months' ? 'active' : '' }}" name="period" value="3months">

            LAST 3 MONTHS

        </button>

        <button class="report-filter-btn {{ request('period') == '6months' ? 'active' : '' }}" name="period" value="6months">

            LAST 6 MONTHS

        </button>

        <button class="report-filter-btn {{ request('period') == 'year' ? 'active' : '' }}" name="period" value="year">

            THIS YEAR

        </button>

    </form>
    </div>

    <div class="report-stats-grid">

        <div class="report-stat-card">

            <div class="report-icon">

                <i class="fa-solid fa-dollar-sign"></i>

            </div>

            <div class="report-stat-label">

                TOTAL REVENUE

            </div>

            <div class="report-stat-value">

                Rp {{ number_format($totalRevenue, 0, ',', '.') }}

            </div>

            <div class="report-stat-sub">

                Year to date

            </div>

        </div>

        <div class="report-stat-card">

            <div class="report-icon">

                <i class="fa-solid fa-calendar"></i>

            </div>

            <div class="report-stat-label">

                TOTAL BOOKINGS

            </div>

            <div class="report-stat-value">

                {{ $totalBookings }}

            </div>

            <div class="report-stat-sub">

                All bookings

            </div>

        </div>

        <div class="report-stat-card">

            <div class="report-icon">

                <i class="fa-solid fa-car"></i>

            </div>

            <div class="report-stat-label">

                UTILIZATION RATE

            </div>

            <div class="report-stat-value">

                {{ $utilizationRate }}%

            </div>

            <div class="report-stat-sub">

                Vehicle usage

            </div>

        </div>

        <div class="report-stat-card">

            <div class="report-icon">

                <i class="fa-solid fa-chart-line"></i>

            </div>

            <div class="report-stat-label">

                AVG. RENTAL DAYS

            </div>

            <div class="report-stat-value">

                {{ $avgRentalDays }}

            </div>

            <div class="report-stat-sub">

                Per booking

            </div>

        </div>

    </div>

    <div class="report-chart-grid">

        <div class="report-card">

            <h3>
                REVENUE TREND (MILLION RP)
            </h3>

            <canvas id="revenueTrendChart"></canvas>

        </div>

        <div class="report-card">

            <h3>
                BOOKINGS TREND
            </h3>

            <canvas id="bookingTrendChart"></canvas>

        </div>

    </div>

    <div class="report-card">

        <h3>
            TOP PERFORMING VEHICLES
        </h3>

        <table class="report-table">

            <thead>

                <tr>

                    <th>RANK</th>
                    <th>VEHICLE</th>
                    <th>BOOKINGS</th>

                </tr>

            </thead>

            <tbody>

                @foreach ($topVehicles as $index => $car)
                    <tr>

                        <td>

                            #{{ $index + 1 }}

                        </td>

                        <td>

                            {{ $car->name }}

                        </td>

                        <td>

                            {{ $car->bookings_count }}

                        </td>

                    </tr>
                @endforeach

            </tbody>

        </table>

    </div>

    <div class="report-card">

        <h3>
            PROFIT ANALYSIS (YTD)
        </h3>

        <table class="report-table">

            <tbody>

                <tr>

                    <td>
                        Gross Revenue
                    </td>

                    <td>
                        Rp {{ number_format($totalRevenue, 0, ',', '.') }}
                    </td>

                </tr>

                <tr>

                    <td>
                        Operating Costs
                    </td>

                    <td>
                        Rp 0
                    </td>

                </tr>

                <tr>

                    <td>
                        Maintenance
                    </td>

                    <td>
                        Rp 0
                    </td>

                </tr>

                <tr>

                    <td>
                        Insurance
                    </td>

                    <td>
                        Rp 0
                    </td>

                </tr>

                <tr>

                    <td>
                        NET PROFIT
                    </td>

                    <td>
                        Rp {{ number_format($totalRevenue, 0, ',', '.') }}
                    </td>

                </tr>

            </tbody>

        </table>

    </div>

@endsection
@push('scripts')
    <script>
        new Chart(
            document.getElementById(
                'revenueTrendChart'
            ), {

                type: 'line',

                data: {

                    labels: @json($revenueLabels),

                    datasets: [{

                        data: @json($revenueData),

                        borderColor: '#007aff',

                        tension: .4,

                        fill: false

                    }]

                },

                options: {

                    responsive: true,

                    maintainAspectRatio: false,

                    plugins: {
                        legend: {
                            display: false
                        }
                    }

                }

            }
        );

        new Chart(
            document.getElementById(
                'bookingTrendChart'
            ), {

                type: 'bar',

                data: {

                    labels: @json($revenueLabels),

                    datasets: [{

                        data: @json($bookingData),
                        backgroundColor: '#2b6dcc'

                    }]

                },

                options: {

                    responsive: true,

                    maintainAspectRatio: false,

                    plugins: {
                        legend: {
                            display: false
                        }
                    }

                }

            }
        );
    </script>
@endpush
