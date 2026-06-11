@extends('layouts.admin')

@section('title', 'Bookings')

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
                    BOOKING MANAGEMENT
                </h1>

                <p class="cars-subtitle">
                    Track and manage all reservations
                </p>
            </div>

        </div>

        <button class="add-car-btn" id="openAddCarModal">
            + ADD BOOKING
        </button>

    </div>

    <div class="booking-filter-card">

        <form method="GET" class="booking-filter">

            <button class="{{ request('status') == null ? 'active' : '' }}" name="status" value="">

                ALL

            </button>

            <button class="{{ request('status') == 'confirmed' ? 'active' : '' }}" name="status" value="confirmed">

                CONFIRMED

            </button>

            <button class="{{ request('status') == 'ongoing' ? 'active' : '' }}" name="status" value="ongoing">

                ONGOING

            </button>

            <button class="{{ request('status') == 'completed' ? 'active' : '' }}" name="status" value="completed">

                COMPLETED

            </button>

            <button class="{{ request('status') == 'cancelled' ? 'active' : '' }}" name="status" value="cancelled">

                CANCELLED

            </button>

        </form>


    </div>



    <div class="booking-table-card">

        <table class="booking-table">

            <thead>

                <tr>

                    <th>BOOKING CODE</th>
                    <th>CUSTOMER</th>
                    <th>VEHICLE</th>
                    <th>RENTAL PERIOD</th>
                    <th>TOTAL</th>
                    <th>PAYMENT</th>
                    <th>STATUS</th>
                    <th>ACTIONS</th>

                </tr>

            </thead>

            <tbody>

                @forelse($bookings as $booking)
                    <tr>

                        <td>
                            {{ $booking->booking_code }}
                        </td>

                        <td>

                            <span class="customer-name">
                                {{ $booking->customer_name }}
                            </span>

                            <span class="customer-phone">
                                {{ $booking->customer_phone }}
                            </span>

                        </td>

                        <td>

                            {{ $booking->car->name }}

                        </td>

                        <td>

                            <span class="rental-date">

                                {{ \Carbon\Carbon::parse($booking->start_date)->format('Y-m-d') }}
                                -

                                {{ \Carbon\Carbon::parse($booking->end_date)->format('Y-m-d') }}

                            </span>

                            <span class="rental-days">

                                {{ $booking->total_days }}
                                Days

                            </span>

                        </td>

                        <td>

                            Rp {{ number_format($booking->total_price, 0, ',', '.') }}

                        </td>

                        <td>

                            @if ($booking->payment_status == 'paid')
                                <span class="badge badge-green">
                                    PAID
                                </span>
                            @elseif($booking->payment_status == 'pending')
                                <span class="badge badge-yellow">
                                    PENDING
                                </span>
                            @else
                                <span class="badge badge-red">
                                    REJECTED
                                </span>
                            @endif

                        </td>

                        <td>

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

                                @case('cancelled')
                                    <span class="badge badge-red">
                                        CANCELLED
                                    </span>
                                @break

                                @default
                                    <span class="badge badge-yellow">
                                        WAITING
                                    </span>
                            @endswitch

                        </td>

                        <td>

                            <div class="booking-actions">

                                <button class="btn-action btn-view">
                                    <i class="fas fa-eye"></i>
                                </button>

                                <button class="btn-action btn-edit">
                                    <i class="fas fa-pen"></i>
                                </button>

                                <button class="btn-action btn-delete">
                                    <i class="fas fa-trash"></i>
                                </button>

                            </div>

                        </td>

                    </tr>

                    @empty

                        <tr>

                            <td colspan="8">

                                No bookings found.

                            </td>

                        </tr>
                    @endforelse

                </tbody>

            </table>

        </div>

    @endsection
