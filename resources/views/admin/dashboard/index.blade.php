@extends('layouts.admin')

@section('title', 'Dashboard')

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
                DASHBOARD
            </h1>

            <p class="cars-subtitle">
                Welcome back, Admin
            </p>

        </div>

    </div>

</div>

<div class="dashboard-stats">

    <div class="dashboard-card">

        <div class="dashboard-icon">
            <i class="fa-solid fa-car"></i>
        </div>

        <span class="dashboard-label">
            TOTAL CARS
        </span>

        <h2>
            {{ $totalCars }}
        </h2>

    </div>

    <div class="dashboard-card">

        <div class="dashboard-icon dashboard-green">
            <i class="fa-solid fa-car"></i>
        </div>

        <span class="dashboard-label">
            AVAILABLE CARS
        </span>

        <h2>
            {{ $availableCars }}
        </h2>

    </div>

    <div class="dashboard-card">

        <div class="dashboard-icon dashboard-blue">
            <i class="fa-solid fa-calendar"></i>
        </div>

        <span class="dashboard-label">
            ACTIVE RENTALS
        </span>

        <h2>
            {{ $activeRentals }}
        </h2>

    </div>

    <div class="dashboard-card">

        <div class="dashboard-icon dashboard-money">
            <i class="fa-solid fa-dollar-sign"></i>
        </div>

        <span class="dashboard-label">
            MONTHLY REVENUE
        </span>

        <h2>
            Rp {{ number_format($monthlyRevenue, 0, ',', '.') }}
        </h2>

    </div>

</div>

<div class="dashboard-grid">

    <div class="dashboard-panel revenue-panel">

        <h3>
            REVENUE TREND
        </h3>

        <canvas id="revenueChart"></canvas>

    </div>

    <div class="dashboard-panel vehicle-panel">

        <h3>
            VEHICLE STATUS
        </h3>

        <canvas id="vehicleChart"></canvas>

    </div>

</div>

<div class="dashboard-grid">

    <div class="dashboard-panel">

        <div class="panel-header">

            <h3>
                RECENT BOOKINGS
            </h3>

            <a href="{{ route('admin.bookings.index') }}">
                VIEW ALL
            </a>

        </div>

        <table class="dashboard-table">

            <tbody>

                @foreach($recentBookings as $booking)

                    <tr>

                        <td width="100">

                            {{ $booking->booking_code }}

                        </td>

                        <td>

                            <strong>
                                {{ $booking->customer_name }}
                            </strong>

                            <br>

                            <small>
                                {{ $booking->car->name }}
                            </small>

                        </td>

                        <td width="120">

                            @switch($booking->booking_status)

                                @case('confirmed')
                                    <span class="badge badge-green">
                                        CONFIRMED
                                    </span>
                                @break

                                @case('ongoing')
                                    <span class="badge badge-blue">
                                        ONGOING
                                    </span>
                                @break

                                @case('completed')
                                    <span class="badge badge-gray">
                                        COMPLETED
                                    </span>
                                @break

                                @default
                                    <span class="badge badge-yellow">
                                        WAITING
                                    </span>

                            @endswitch

                        </td>

                    </tr>

                @endforeach

            </tbody>

        </table>

    </div>

    <div class="dashboard-panel">

        <div class="panel-header">

            <h3>
                RECENT PAYMENTS
            </h3>

            <a href="{{ route('admin.payments.index') }}">
                VIEW ALL
            </a>

        </div>

        <table class="dashboard-table">

            <tbody>

                @foreach($recentPayments as $payment)

                    <tr>

                        <td width="100">

                            {{ $payment->payment_code }}

                        </td>

                        <td>

                            <strong>

                                {{ $payment->booking->customer_name }}

                            </strong>

                            <br>

                            <small>

                                {{ \Carbon\Carbon::parse($payment->payment_date)->format('d M Y') }}

                            </small>

                        </td>

                        <td width="120">

                            @if($payment->status == 'approved')

                                <span class="badge badge-green">
                                    APPROVED
                                </span>

                            @elseif($payment->status == 'rejected')

                                <span class="badge badge-red">
                                    REJECTED
                                </span>

                            @else

                                <span class="badge badge-yellow">
                                    PENDING
                                </span>

                            @endif

                        </td>

                    </tr>

                @endforeach

            </tbody>

        </table>

    </div>

</div>

@endsection

@push('scripts')

<script>

const revenueCtx =
    document.getElementById(
        'revenueChart'
    );

new Chart(
    revenueCtx,
    {

        type:'bar',

        data:{

            labels:[
                'Jan',
                'Feb',
                'Mar',
                'Apr',
                'May',
                'Jun'
            ],

            datasets:[{

                label:'Revenue',

                data:[
                    12,
                    15,
                    18,
                    14,
                    20,
                    24
                ],

                backgroundColor:'#007aff',

                borderRadius:4

            }]

        },

        options:{

            responsive:true,

            maintainAspectRatio:false,

            plugins:{

                legend:{
                    display:false
                }

            },

            scales:{

                x:{

                    ticks:{
                        color:'#b0b0b0'
                    },

                    grid:{
                        color:'#2d2d2d'
                    }

                },

                y:{

                    ticks:{
                        color:'#b0b0b0'
                    },

                    grid:{
                        color:'#2d2d2d'
                    }

                }

            }

        }

    }
);

const vehicleCtx =
    document.getElementById(
        'vehicleChart'
    );

new Chart(
    vehicleCtx,
    {

        type:'doughnut',

        data:{

            labels:[
                'Available',
                'Rented',
                'Maintenance'
            ],

            datasets:[{

                data:[

                    {{ $availableCount }},

                    {{ $rentedCount }},

                    {{ $maintenanceCount }}

                ],

                backgroundColor:[

                    '#22c55e',

                    '#3b82f6',

                    '#facc15'

                ],

                borderWidth:1

            }]

        },

        options:{

            responsive:true,

            maintainAspectRatio:false,

            plugins:{

                legend:{

                    position:'bottom',

                    labels:{

                        color:'#fff'

                    }

                }

            }

        }

    }
);

</script>

@endpush
