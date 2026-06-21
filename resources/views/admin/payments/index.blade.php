@extends('layouts.admin')

@section('title', 'Payments')

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
                    PAYMENT MANAGEMENT
                </h1>

                <p class="cars-subtitle">
                    Manage customer payment records
                </p>
            </div>
        </div>

        <button id="openAddPaymentModal" class="add-car-btn">

            + ADD PAYMENT

        </button>

    </div>
    <div class="booking-filter-card">

        <form method="GET" class="booking-filter">

            <button class="{{ request('status') == null ? 'active' : '' }}" name="status" value="">

                ALL

            </button>

            <button class="{{ request('status') == 'pending' ? 'active' : '' }}" name="status" value="pending">

                PENDING

            </button>

            <button class="{{ request('status') == 'approved' ? 'active' : '' }}" name="status" value="approved">

                APPROVED

            </button>

            <button class="{{ request('status') == 'rejected' ? 'active' : '' }}" name="status" value="rejected">

                REJECTED

            </button>

        </form>

    </div>
    <div class="booking-table-card">

        <table class="booking-table">

            <thead>

                <tr>

                    <th>
                        PAYMENT CODE
                    </th>

                    <th>
                        BOOKING
                    </th>

                    <th>
                        AMOUNT
                    </th>

                    <th>
                        DATE
                    </th>

                    <th>
                        STATUS
                    </th>

                    <th>
                        ACTIONS
                    </th>

                </tr>

            </thead>

            <tbody>

                @foreach ($payments as $payment)
                    <tr>

                        <td>
                            {{ $payment->payment_code }}
                        </td>

                        <td>
                            {{ $payment->booking->booking_code }}
                        </td>

                        <td>
                            Rp {{ number_format($payment->amount, 0, ',', '.') }}
                        </td>

                        <td>
                            {{ \Carbon\Carbon::parse($payment->payment_date)->format('d M Y') }}
                        </td>

                        <td>

                            <span
                                class="badge
        @if ($payment->status == 'approved') badge-green
        @elseif($payment->status == 'rejected')
            badge-red
        @else
            badge-yellow @endif">

                                {{ strtoupper($payment->status) }}

                            </span>

                        </td>

                        <td>

                            <div class="action-buttons actions-column">

                                <button class="btn-action btn-view" data-code="{{ $payment->payment_code }}"
                                    data-booking="{{ $payment->booking->booking_code }}"
                                    data-customer="{{ $payment->booking->customer_name }}"
                                    data-amount="{{ number_format($payment->amount, 0, ',', '.') }}"
                                    data-date="{{ $payment->payment_date }}"
                                    data-status="{{ strtoupper($payment->status) }}"
                                    data-proof="{{ asset('storage/' . $payment->proof_image) }}"
                                    data-verified="{{ $payment->verifiedBy?->name ?? 'Not Verified' }}">

                                    <i class="fa-solid fa-eye"></i>

                                </button>

                                <button class="btn-action btn-edit" data-id="{{ $payment->id }}"
                                    data-booking="{{ $payment->booking_id }}" data-amount="{{ $payment->amount }}"
                                    data-date="{{ \Carbon\Carbon::parse($payment->payment_date)->format('Y-m-d') }}"
                                    data-status="{{ $payment->status }}"
                                    data-proof="{{ asset('storage/' . $payment->proof_image) }}">

                                    <i class="fa-solid fa-pen"></i>

                                </button>

                                <button class="btn-action btn-delete" data-id="{{ $payment->id }}"
                                    data-code="{{ $payment->payment_code }}">

                                    <i class="fa-solid fa-trash"></i>

                                </button>
                            </div>

                        </td>

                    </tr>
                @endforeach

            </tbody>

        </table>

    </div>

    <div id="addPaymentModal" class="modal-overlay">

        <div class="modal-container">

            <div class="modal-header">

                <h2>
                    ADD PAYMENT
                </h2>

                <button id="closeAddPaymentModal">

                    ×

                </button>

            </div>

            <form action="{{ route('admin.payments.store') }}" method="POST" enctype="multipart/form-data">

                @csrf

                <div class="form-grid">

                    <div class="form-group">

                        <label>
                            BOOKING
                        </label>

                        <select name="booking_id" required>

                            <option value="">
                                Select Booking
                            </option>

                            @foreach ($bookings as $booking)
                                <option value="{{ $booking->id }}">

                                    {{ $booking->booking_code }}
                                    -
                                    {{ $booking->customer_name }}

                                </option>
                            @endforeach

                        </select>

                    </div>

                    <div class="form-group">

                        <label>
                            AMOUNT
                        </label>

                        <input type="number" name="amount" required>

                    </div>

                    <div class="form-group">

                        <label>
                            PAYMENT DATE
                        </label>

                        <input type="date" name="payment_date" required>

                    </div>

                    <div class="form-group">

                        <label>
                            STATUS
                        </label>

                        <select name="status" required>

                            <option value="pending">
                                Pending
                            </option>

                            <option value="approved">
                                Approved
                            </option>

                            <option value="rejected">
                                Rejected
                            </option>

                        </select>

                    </div>

                </div>

                <div class="form-group">

                    <label>
                        PAYMENT PROOF
                    </label>

                    <div class="upload-box" id="paymentUploadBox">

                        <input type="file" id="paymentProof" name="proof_image" accept="image/*" hidden>

                        <img id="paymentPreview" style="display:none;">

                        <div id="paymentUploadContent">

                            <span>
                                Upload Payment Proof
                            </span>

                            <small>
                                JPG, PNG, WEBP
                            </small>

                        </div>

                    </div>

                </div>

                <div class="modal-footer">

                    <button type="submit" class="btn-save">

                        ADD PAYMENT

                    </button>

                    <button type="button" id="closeAddPaymentModal2" class="btn-cancel">

                        CANCEL

                    </button>

                </div>

            </form>

        </div>

    </div>

    <div id="detailPaymentModal" class="modal-overlay">

        <div class="modal-container">

            <div class="modal-header">

                <h2>
                    PAYMENT DETAILS
                </h2>

                <button id="closeDetailPaymentModal">
                    ×
                </button>

            </div>

            <div class="detail-grid">

                <div class="detail-item">

                    <span class="detail-label">
                        PAYMENT CODE
                    </span>

                    <span id="paymentDetailCode" class="detail-value">
                    </span>

                </div>

                <div class="detail-item">

                    <span class="detail-label">
                        BOOKING CODE
                    </span>

                    <span id="paymentDetailBooking" class="detail-value">
                    </span>

                </div>

                <div class="detail-item">

                    <span class="detail-label">
                        CUSTOMER
                    </span>

                    <span id="paymentDetailCustomer" class="detail-value">
                    </span>

                </div>

                <div class="detail-item">

                    <span class="detail-label">
                        PAYMENT DATE
                    </span>

                    <span id="paymentDetailDate" class="detail-value">
                    </span>

                </div>

                <div class="detail-item">

                    <span class="detail-label">
                        AMOUNT
                    </span>

                    <span id="paymentDetailAmount" class="detail-value">
                    </span>

                </div>

                <div class="detail-item">

                    <span class="detail-label">
                        STATUS
                    </span>

                    <span id="paymentDetailStatus" class="detail-value">
                    </span>

                </div>

                <div class="detail-item">

                    <span class="detail-label">
                        VERIFIED BY
                    </span>

                    <span id="paymentDetailVerified" class="detail-value">
                    </span>

                </div>

            </div>

            <div class="detail-full">

                <span class="detail-label">
                    PAYMENT PROOF
                </span>

                <img id="paymentDetailProof" class="payment-proof-preview">

            </div>

            <div class="modal-footer">

                <button type="button" id="closeDetailPaymentModal2" class="btn-cancel">

                    CLOSE

                </button>

            </div>

        </div>

    </div>

    <div id="editPaymentModal" class="modal-overlay">

        <div class="modal-container">

            <div class="modal-header">

                <h2>
                    EDIT PAYMENT
                </h2>

                <button id="closeEditPaymentModal">
                    ×
                </button>

            </div>

            <form id="editPaymentForm" method="POST" enctype="multipart/form-data">

                @csrf
                @method('PUT')

                <div class="form-grid">

                    <div class="form-group">

                        <label>
                            BOOKING
                        </label>

                        <select id="editBookingId" name="booking_id" required>

                            @foreach ($bookings as $booking)
                                <option value="{{ $booking->id }}">

                                    {{ $booking->booking_code }}
                                    -
                                    {{ $booking->customer_name }}

                                </option>
                            @endforeach

                        </select>

                    </div>

                    <div class="form-group">

                        <label>
                            AMOUNT
                        </label>

                        <input type="number" id="editAmount" name="amount" required>

                    </div>

                    <div class="form-group">

                        <label>
                            PAYMENT DATE
                        </label>

                        <input type="date" id="editPaymentDate" name="payment_date" required>

                    </div>

                    <div class="form-group">

                        <label>
                            STATUS
                        </label>

                        <select id="editStatus" name="status">

                            <option value="pending">
                                Pending
                            </option>

                            <option value="approved">
                                Approved
                            </option>

                            <option value="rejected">
                                Rejected
                            </option>

                        </select>

                    </div>

                </div>

                <div class="form-group">

                    <label>
                        PAYMENT PROOF
                    </label>

                    <div class="upload-box" id="editPaymentUploadBox">

                        <input type="file" id="editProofImage" name="proof_image" accept="image/*" hidden>

                        <img id="editPaymentPreview">

                    </div>

                </div>

                <div class="modal-footer">

                    <button type="submit" class="btn-save">

                        UPDATE PAYMENT

                    </button>

                    <button type="button" id="closeEditPaymentModal2" class="btn-cancel">

                        CANCEL

                    </button>

                </div>

            </form>

        </div>

    </div>

    <div id="deletePaymentModal" class="modal-overlay">

        <div class="modal-container modal-sm">

            <div class="modal-header">

                <h2>
                    DELETE PAYMENT
                </h2>

                <button id="closeDeletePaymentModal">
                    ×
                </button>

            </div>

            <div class="delete-content">

                <p>
                    Are you sure you want to delete payment:
                </p>

                <h3 id="deletePaymentCode">
                </h3>

                <p class="delete-warning">
                    This action cannot be undone.
                </p>

            </div>

            <form id="deletePaymentForm" method="POST">

                @csrf
                @method('DELETE')

                <div class="modal-footer">

                    <button type="submit" class="btn-danger">

                        DELETE

                    </button>

                    <button type="button" id="closeDeletePaymentModal2" class="btn-cancel">

                        CANCEL

                    </button>

                </div>

            </form>

        </div>

    </div>
@endsection

@push('scripts')
    <script>
        const addPaymentModal =
            document.getElementById(
                'addPaymentModal'
            );

        document
            .getElementById(
                'openAddPaymentModal'
            )
            .addEventListener('click', () => {

                addPaymentModal.classList.add(
                    'show'
                );

            });

        document
            .getElementById(
                'closeAddPaymentModal'
            )
            .addEventListener('click', () => {

                addPaymentModal.classList.remove(
                    'show'
                );

            });

        document
            .getElementById(
                'closeAddPaymentModal2'
            )
            .addEventListener('click', () => {

                addPaymentModal.classList.remove(
                    'show'
                );

            });

        const paymentProof =
            document.getElementById(
                'paymentProof'
            );

        const paymentPreview =
            document.getElementById(
                'paymentPreview'
            );

        const paymentUploadBox =
            document.getElementById(
                'paymentUploadBox'
            );

        const paymentUploadContent =
            document.getElementById(
                'paymentUploadContent'
            );

        paymentUploadBox.addEventListener(
            'click',
            () => {

                paymentProof.click();

            }
        );

        paymentProof.addEventListener(
            'change',
            function() {

                const file =
                    this.files[0];

                if (!file) return;

                const reader =
                    new FileReader();

                reader.onload =
                    function(e) {

                        paymentPreview.src =
                            e.target.result;

                        paymentPreview.style.display =
                            'block';

                        paymentUploadContent.style.display =
                            'none';

                    };

                reader.readAsDataURL(
                    file
                );

            }
        );

        const detailPaymentModal =
            document.getElementById(
                'detailPaymentModal'
            );

        document
            .querySelectorAll('.btn-view')
            .forEach(button => {

                button.addEventListener('click', () => {

                    document.getElementById(
                            'paymentDetailCode'
                        ).textContent =
                        button.dataset.code;

                    document.getElementById(
                            'paymentDetailBooking'
                        ).textContent =
                        button.dataset.booking;

                    document.getElementById(
                            'paymentDetailCustomer'
                        ).textContent =
                        button.dataset.customer;

                    document.getElementById(
                            'paymentDetailAmount'
                        ).textContent =
                        'Rp ' +
                        button.dataset.amount;

                    document.getElementById(
                            'paymentDetailDate'
                        ).textContent =
                        button.dataset.date;

                    document.getElementById(
                            'paymentDetailStatus'
                        ).textContent =
                        button.dataset.status;

                    document.getElementById(
                            'paymentDetailVerified'
                        ).textContent =
                        button.dataset.verified;

                    document.getElementById(
                            'paymentDetailProof'
                        ).src =
                        button.dataset.proof;

                    detailPaymentModal.classList.add(
                        'show'
                    );

                });

            });

        document
            .getElementById(
                'closeDetailPaymentModal'
            )
            .addEventListener('click', () => {

                detailPaymentModal.classList.remove(
                    'show'
                );

            });

        document
            .getElementById(
                'closeDetailPaymentModal2'
            )
            .addEventListener('click', () => {

                detailPaymentModal.classList.remove(
                    'show'
                );

            });

        const editPaymentModal =
            document.getElementById(
                'editPaymentModal'
            );

        const editPaymentForm =
            document.getElementById(
                'editPaymentForm'
            );

        document
            .querySelectorAll('.btn-edit')
            .forEach(button => {

                button.addEventListener('click', () => {

                    const id =
                        button.dataset.id;

                    editPaymentForm.action =
                        `/admin/payments/${id}`;

                    document.getElementById(
                            'editBookingId'
                        ).value =
                        button.dataset.booking;

                    document.getElementById(
                            'editAmount'
                        ).value =
                        button.dataset.amount;

                    document.getElementById(
                            'editPaymentDate'
                        ).value =
                        button.dataset.date;

                    document.getElementById(
                            'editStatus'
                        ).value =
                        button.dataset.status;

                    document.getElementById(
                            'editPaymentPreview'
                        ).src =
                        button.dataset.proof;

                    editPaymentModal.classList.add(
                        'show'
                    );

                });

            });

        document
            .getElementById(
                'closeEditPaymentModal'
            )
            .addEventListener('click', () => {

                editPaymentModal.classList.remove(
                    'show'
                );

            });

        document
            .getElementById(
                'closeEditPaymentModal2'
            )
            .addEventListener('click', () => {

                editPaymentModal.classList.remove(
                    'show'
                );

            });

        const editProofInput =
            document.getElementById(
                'editProofImage'
            );

        const editPreview =
            document.getElementById(
                'editPaymentPreview'
            );

        const editUploadBox =
            document.getElementById(
                'editPaymentUploadBox'
            );

        editUploadBox.addEventListener(
            'click',
            () => {

                editProofInput.click();

            }
        );

        editProofInput.addEventListener(
            'change',
            function() {

                const file =
                    this.files[0];

                if (!file) return;

                const reader =
                    new FileReader();

                reader.onload =
                    function(e) {

                        editPreview.src =
                            e.target.result;

                    };

                reader.readAsDataURL(
                    file
                );

            }
        );

        const deletePaymentModal =
            document.getElementById(
                'deletePaymentModal'
            );

        const deletePaymentCode =
            document.getElementById(
                'deletePaymentCode'
            );

        const deletePaymentForm =
            document.getElementById(
                'deletePaymentForm'
            );

        document
            .querySelectorAll('.btn-delete')
            .forEach(button => {

                button.addEventListener('click', () => {

                    const id =
                        button.dataset.id;

                    const code =
                        button.dataset.code;

                    deletePaymentCode.textContent =
                        code;

                    deletePaymentForm.action =
                        `/admin/payments/${id}`;

                    deletePaymentModal.classList.add(
                        'show'
                    );

                });

            });

        document
            .getElementById(
                'closeDeletePaymentModal'
            )
            .addEventListener('click', () => {

                deletePaymentModal.classList.remove(
                    'show'
                );

            });

        document
            .getElementById(
                'closeDeletePaymentModal2'
            )
            .addEventListener('click', () => {

                deletePaymentModal.classList.remove(
                    'show'
                );

            });
    </script>
@endpush
