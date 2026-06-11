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

        <button class="add-car-btn" id="openAddBookingModal">
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

                                <button class="btn-action btn-view" data-code="{{ $booking->booking_code }}"
                                    data-customer="{{ $booking->customer_name }}"
                                    data-phone="{{ $booking->customer_phone }}"
                                    data-address="{{ $booking->customer_address }}" data-car="{{ $booking->car->name }}"
                                    data-start="{{ $booking->start_date }}" data-end="{{ $booking->end_date }}"
                                    data-days="{{ $booking->total_days }}"
                                    data-price="{{ number_format($booking->price_per_day, 0, ',', '.') }}"
                                    data-total="{{ number_format($booking->total_price, 0, ',', '.') }}"
                                    data-payment="{{ strtoupper($booking->payment_status) }}"
                                    data-status="{{ strtoupper($booking->booking_status) }}"
                                    data-notes="{{ $booking->notes }}">

                                    <i class="fa-solid fa-eye"></i>

                                </button>

                                <button class="btn-action btn-edit" data-id="{{ $booking->id }}"
                                    data-customer="{{ $booking->customer_name }}"
                                    data-phone="{{ $booking->customer_phone }}"
                                    data-address="{{ $booking->customer_address }}" data-car="{{ $booking->car_id }}"
                                    data-start="{{ $booking->start_date }}" data-end="{{ $booking->end_date }}"
                                    data-payment-type="{{ $booking->payment_type }}"
                                    data-payment-status="{{ $booking->payment_status }}"
                                    data-booking-status="{{ $booking->booking_status }}"
                                    data-notes="{{ $booking->notes }}">

                                    <i class="fa-solid fa-pen"></i>

                                </button>

                                <button class="btn-action btn-delete" data-id="{{ $booking->id }}"
                                    data-code="{{ $booking->booking_code }}">

                                    <i class="fa-solid fa-trash"></i>

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

        <div id="addBookingModal" class="modal-overlay">

            <div class="modal-container">

                <div class="modal-header">
                    <button id="closeAddBookingModal">
                        ×
                    </button>

                    <h2>
                        ADD NEW BOOKING
                    </h2>


                </div>

                <form action="{{ route('admin.bookings.store') }}" method="POST">

                    @csrf

                    <div class="form-grid">

                        <div class="form-group">

                            <label>
                                CUSTOMER NAME
                            </label>

                            <input type="text" name="customer_name" required>

                        </div>

                        <div class="form-group">

                            <label>
                                PHONE NUMBER
                            </label>

                            <input type="text" name="customer_phone" required>

                        </div>

                        <div class="form-group">

                            <label>
                                VEHICLE
                            </label>

                            <select name="car_id" required>

                                <option value="">
                                    Select Vehicle
                                </option>

                                @foreach ($cars as $car)
                                    <option value="{{ $car->id }}">
                                        {{ $car->name }}
                                    </option>
                                @endforeach

                            </select>

                        </div>

                        <div class="form-group">

                            <label>
                                PAYMENT TYPE
                            </label>

                            <select name="payment_type">

                                <option value="dp">
                                    DP
                                </option>

                                <option value="full">
                                    Full
                                </option>

                            </select>

                        </div>

                        <div class="form-group">

                            <label>
                                START DATE
                            </label>

                            <input type="date" name="start_date" required>

                        </div>

                        <div class="form-group">

                            <label>
                                END DATE
                            </label>

                            <input type="date" name="end_date" required>

                        </div>

                    </div>

                    <div class="form-group">

                        <label>
                            CUSTOMER ADDRESS
                        </label>

                        <textarea name="customer_address" rows="3"></textarea>

                    </div>

                    <div class="form-group">

                        <label>
                            NOTES
                        </label>

                        <textarea name="notes" rows="4"></textarea>

                    </div>

                    <div class="modal-footer">

                        <button type="submit" class="btn-save">

                            ADD BOOKING

                        </button>

                        <button type="button" id="closeAddBookingModal2" class="btn-cancel">

                            CANCEL

                        </button>

                    </div>

                </form>

            </div>

        </div>

        <div id="detailBookingModal" class="modal-overlay">

            <div class="modal-container">

                <div class="modal-header">

                    <h2>
                        BOOKING DETAILS
                    </h2>

                    <button id="closeDetailBookingModal">
                        ×
                    </button>

                </div>

                <div class="detail-grid">

                    <div class="detail-item">

                        <span class="detail-label">
                            BOOKING CODE
                        </span>

                        <span id="detailCode" class="detail-value">
                        </span>

                    </div>

                    <div class="detail-item">

                        <span class="detail-label">
                            CUSTOMER
                        </span>

                        <span id="detailCustomer" class="detail-value">
                        </span>

                    </div>

                    <div class="detail-item">

                        <span class="detail-label">
                            PHONE
                        </span>

                        <span id="detailPhone" class="detail-value">
                        </span>

                    </div>

                    <div class="detail-item">

                        <span class="detail-label">
                            VEHICLE
                        </span>

                        <span id="detailCar" class="detail-value">
                        </span>

                    </div>

                    <div class="detail-item">

                        <span class="detail-label">
                            RENTAL PERIOD
                        </span>

                        <span id="detailPeriod" class="detail-value">
                        </span>

                    </div>

                    <div class="detail-item">

                        <span class="detail-label">
                            TOTAL DAYS
                        </span>

                        <span id="detailDays" class="detail-value">
                        </span>

                    </div>

                    <div class="detail-item">

                        <span class="detail-label">
                            PRICE PER DAY
                        </span>

                        <span id="detailPrice" class="detail-value">
                        </span>

                    </div>

                    <div class="detail-item">

                        <span class="detail-label">
                            TOTAL PRICE
                        </span>

                        <span id="detailTotal" class="detail-value">
                        </span>

                    </div>

                    <div class="detail-item">

                        <span class="detail-label">
                            PAYMENT STATUS
                        </span>

                        <span id="detailPayment" class="detail-value">
                        </span>

                    </div>

                    <div class="detail-item">

                        <span class="detail-label">
                            BOOKING STATUS
                        </span>

                        <span id="detailStatus" class="detail-value">
                        </span>

                    </div>

                </div>

                <div class="detail-full">

                    <span class="detail-label">
                        CUSTOMER ADDRESS
                    </span>

                    <p id="detailAddress"></p>

                </div>

                <div class="detail-full">

                    <span class="detail-label">
                        NOTES
                    </span>

                    <p id="detailNotes"></p>

                </div>

                <div class="modal-footer">

                    <button type="button" id="closeDetailBookingModal2" class="btn-cancel">

                        CLOSE

                    </button>

                </div>

            </div>

        </div>

        <div id="editBookingModal" class="modal-overlay">

            <div class="modal-container">

                <div class="modal-header">

                    <h2>
                        EDIT BOOKING
                    </h2>

                    <button id="closeEditBookingModal">
                        ×
                    </button>

                </div>

                <form id="editBookingForm" method="POST">

                    @csrf
                    @method('PUT')

                    <div class="form-grid">

                        <div class="form-group">

                            <label>
                                CUSTOMER NAME
                            </label>

                            <input type="text" id="editCustomerName" name="customer_name" required>

                        </div>

                        <div class="form-group">

                            <label>
                                PHONE NUMBER
                            </label>

                            <input type="text" id="editCustomerPhone" name="customer_phone" required>

                        </div>

                        <div class="form-group">

                            <label>
                                VEHICLE
                            </label>

                            <select id="editCarId" name="car_id" required>

                                @foreach ($cars as $car)
                                    <option value="{{ $car->id }}">
                                        {{ $car->name }}
                                    </option>
                                @endforeach

                            </select>

                        </div>

                        <div class="form-group">

                            <label>
                                PAYMENT TYPE
                            </label>

                            <select id="editPaymentType" name="payment_type">

                                <option value="dp">
                                    DP
                                </option>

                                <option value="full">
                                    FULL
                                </option>

                            </select>

                        </div>

                        <div class="form-group">

                            <label>
                                PAYMENT STATUS
                            </label>

                            <select id="editPaymentStatus" name="payment_status">

                                <option value="pending">
                                    Pending
                                </option>

                                <option value="paid">
                                    Paid
                                </option>

                                <option value="rejected">
                                    Rejected
                                </option>

                            </select>

                        </div>

                        <div class="form-group">

                            <label>
                                BOOKING STATUS
                            </label>

                            <select id="editBookingStatus" name="booking_status">

                                <option value="waiting_payment">
                                    Waiting Payment
                                </option>

                                <option value="confirmed">
                                    Confirmed
                                </option>

                                <option value="ongoing">
                                    Ongoing
                                </option>

                                <option value="completed">
                                    Completed
                                </option>

                                <option value="cancelled">
                                    Cancelled
                                </option>

                            </select>

                        </div>

                        <div class="form-group">

                            <label>
                                START DATE
                            </label>

                            <input type="date" id="editStartDate" name="start_date" required>

                        </div>

                        <div class="form-group">

                            <label>
                                END DATE
                            </label>

                            <input type="date" id="editEndDate" name="end_date" required>

                        </div>

                    </div>

                    <div class="form-group">

                        <label>
                            CUSTOMER ADDRESS
                        </label>

                        <textarea id="editCustomerAddress" name="customer_address" rows="3"></textarea>

                    </div>

                    <div class="form-group">

                        <label>
                            NOTES
                        </label>

                        <textarea id="editNotes" name="notes" rows="4"></textarea>

                    </div>

                    <div class="modal-footer">

                        <button type="submit" class="btn-save">

                            UPDATE BOOKING

                        </button>

                        <button type="button" id="closeEditBookingModal2" class="btn-cancel">

                            CANCEL

                        </button>

                    </div>

                </form>

            </div>

        </div>

        <div id="deleteBookingModal" class="modal-overlay">

            <div class="modal-container modal-sm">

                <div class="modal-header">

                    <h2>
                        DELETE BOOKING
                    </h2>

                    <button id="closeDeleteBookingModal">
                        ×
                    </button>

                </div>

                <div class="delete-content">

                    <p>
                        Are you sure you want to delete booking:
                    </p>

                    <h3 id="deleteBookingCode">
                    </h3>

                    <p class="delete-warning">
                        This action cannot be undone.
                    </p>

                </div>

                <form id="deleteBookingForm" method="POST">

                    @csrf
                    @method('DELETE')

                    <div class="modal-footer">

                        <button type="submit" class="btn-danger">

                            DELETE

                        </button>

                        <button type="button" id="closeDeleteBookingModal2" class="btn-cancel">

                            CANCEL

                        </button>

                    </div>

                </form>

            </div>

        </div>

    @endsection

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', () => {

                const bookingModal =
                    document.getElementById('addBookingModal');

                document
                    .getElementById('openAddBookingModal')
                    .addEventListener('click', () => {

                        bookingModal.classList.add('show');

                    });

                document
                    .getElementById('closeAddBookingModal')
                    .addEventListener('click', () => {

                        bookingModal.classList.remove('show');

                    });

                document
                    .getElementById('closeAddBookingModal2')
                    .addEventListener('click', () => {

                        bookingModal.classList.remove('show');

                    });

            });

            const detailModal =
                document.getElementById(
                    'detailBookingModal'
                );

            document
                .querySelectorAll('.btn-view')
                .forEach(button => {

                    button.addEventListener('click', () => {

                        document.getElementById(
                                'editPaymentStatus'
                            ).value =
                            button.dataset.paymentStatus;

                        document.getElementById(
                                'editBookingStatus'
                            ).value =
                            button.dataset.bookingStatus;

                        document.getElementById('detailCode').textContent =
                            button.dataset.code;

                        document.getElementById('detailCustomer').textContent =
                            button.dataset.customer;

                        document.getElementById('detailPhone').textContent =
                            button.dataset.phone;

                        document.getElementById('detailCar').textContent =
                            button.dataset.car;

                        document.getElementById('detailPeriod').textContent =
                            button.dataset.start +
                            ' - ' +
                            button.dataset.end;

                        document.getElementById('detailDays').textContent =
                            button.dataset.days + ' Days';

                        document.getElementById('detailPrice').textContent =
                            'Rp ' + button.dataset.price;

                        document.getElementById('detailTotal').textContent =
                            'Rp ' + button.dataset.total;

                        document.getElementById('detailPayment').textContent =
                            button.dataset.payment;

                        document.getElementById('detailStatus').textContent =
                            button.dataset.status;

                        document.getElementById('detailAddress').textContent =
                            button.dataset.address;

                        document.getElementById('detailNotes').textContent =
                            button.dataset.notes ?? '-';

                        detailModal.classList.add('show');

                    });

                });

            document
                .getElementById('closeDetailBookingModal')
                .addEventListener('click', () => {

                    detailModal.classList.remove('show');

                });

            document
                .getElementById('closeDetailBookingModal2')
                .addEventListener('click', () => {

                    detailModal.classList.remove('show');

                });

            const editModal =
                document.getElementById('editBookingModal');

            const editForm =
                document.getElementById('editBookingForm');

            document
                .querySelectorAll('.btn-edit')
                .forEach(button => {

                    button.addEventListener('click', () => {

                        const id =
                            button.dataset.id;

                        editForm.action =
                            `/admin/bookings/${id}`;

                        document.getElementById(
                                'editCustomerName'
                            ).value =
                            button.dataset.customer;

                        document.getElementById(
                                'editCustomerPhone'
                            ).value =
                            button.dataset.phone;

                        document.getElementById(
                                'editCustomerAddress'
                            ).value =
                            button.dataset.address;

                        document.getElementById(
                                'editCarId'
                            ).value =
                            button.dataset.car;

                        document.getElementById(
                                'editStartDate'
                            ).value =
                            button.dataset.start;

                        document.getElementById(
                                'editEndDate'
                            ).value =
                            button.dataset.end;

                        document.getElementById(
                                'editPaymentType'
                            ).value =
                            button.dataset.paymentType;

                        document.getElementById(
                                'editNotes'
                            ).value =
                            button.dataset.notes;

                        editModal.classList.add(
                            'show'
                        );

                    });

                });

            document
                .getElementById(
                    'closeEditBookingModal'
                )
                .addEventListener('click', () => {

                    editModal.classList.remove(
                        'show'
                    );

                });

            document
                .getElementById(
                    'closeEditBookingModal2'
                )
                .addEventListener('click', () => {

                    editModal.classList.remove(
                        'show'
                    );

                });

            const deleteBookingModal =
                document.getElementById(
                    'deleteBookingModal'
                );

            const deleteBookingCode =
                document.getElementById(
                    'deleteBookingCode'
                );

            const deleteBookingForm =
                document.getElementById(
                    'deleteBookingForm'
                );

            document
                .querySelectorAll('.btn-delete')
                .forEach(button => {

                    button.addEventListener('click', () => {

                        const id =
                            button.dataset.id;

                        const code =
                            button.dataset.code;

                        deleteBookingCode.textContent =
                            code;

                        deleteBookingForm.action =
                            `/admin/bookings/${id}`;

                        deleteBookingModal.classList.add(
                            'show'
                        );

                    });

                });

            document
                .getElementById(
                    'closeDeleteBookingModal'
                )
                .addEventListener('click', () => {

                    deleteBookingModal.classList.remove(
                        'show'
                    );

                });

            document
                .getElementById(
                    'closeDeleteBookingModal2'
                )
                .addEventListener('click', () => {

                    deleteBookingModal.classList.remove(
                        'show'
                    );

                });
        </script>
    @endpush
