<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">

    <title>
        Receipt {{ $payment->payment_code }}
    </title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 10px;
            color: #111;
            margin: 0;
            padding: 0;
        }

        .receipt {
            width: 260px;
            margin: 0 auto;
            padding: 10px 8px;
        }

        .center {
            text-align: center;
        }

        .brand {
            font-size: 16px;
            font-weight: bold;
            letter-spacing: .5px;
            margin-bottom: 3px;
        }

        .info {
            font-size: 9px;
            line-height: 1.35;
        }

        .line {
            border-top: 1px dashed #111;
            margin: 8px 0;
        }

        .row {
            width: 100%;
            display: table;
            margin-bottom: 3px;
        }

        .left {
            display: table-cell;
            text-align: left;
            vertical-align: top;
        }

        .right {
            display: table-cell;
            text-align: right;
            vertical-align: top;
            white-space: nowrap;
        }

        .label {
            color: #333;
        }

        .bold {
            font-weight: bold;
        }

        .item-name {
            font-weight: bold;
            margin-bottom: 2px;
        }

        .small {
            font-size: 9px;
            color: #333;
        }

        .total-row {
            font-size: 11px;
            font-weight: bold;
        }

        .footer {
            margin-top: 10px;
            text-align: center;
            font-size: 9px;
            line-height: 1.4;
        }

        .status {
            text-transform: uppercase;
            font-weight: bold;
        }

        .code {
            font-size: 9px;
            word-break: break-all;
        }
    </style>
</head>

<body>

    <div class="receipt">

        <div class="center">

            <div class="brand">
                LEONY BINTANG TRANS
            </div>

            <div class="info">
                Rental Mobil Jember<br>
                Jl. Karangrejo, Sumbersari, Jember<br>
                Telp: 081337522373<br>
                {{ $payment->payment_code }}
            </div>

        </div>

        <div class="line"></div>

        <div class="row">
            <div class="left">
                {{ \Carbon\Carbon::parse($payment->payment_date)->format('d-m-Y') }}
            </div>

            <div class="right">
                {{ \Carbon\Carbon::parse($payment->payment_date)->format('H:i:s') }}
            </div>
        </div>

        <div class="row">
            <div class="left">
                Booking
            </div>

            <div class="right bold">
                {{ $payment->booking->booking_code }}
            </div>
        </div>

        <div class="row">
            <div class="left">
                Customer
            </div>

            <div class="right">
                {{ $payment->booking->customer_name }}
            </div>
        </div>

        <div class="line"></div>

        <div class="item-name">
            1. {{ $payment->booking->car->name }}
        </div>

        <div class="row small">
            <div class="left">
                {{ $payment->booking->total_days }} hari x
                Rp {{ number_format($payment->booking->price_per_day, 0, ',', '.') }}
            </div>

            <div class="right">
                Rp {{ number_format($payment->booking->total_price, 0, ',', '.') }}
            </div>
        </div>

        <div class="row small">
            <div class="left">
                Plat nomor
            </div>

            <div class="right">
                {{ $payment->booking->car->plate_number }}
            </div>
        </div>

        <div class="row small">
            <div class="left">
                Durasi
            </div>

            <div class="right">
                {{ \Carbon\Carbon::parse($payment->booking->start_date)->format('d-m-Y') }}
                -
                {{ \Carbon\Carbon::parse($payment->booking->end_date)->format('d-m-Y') }}
            </div>
        </div>

        <div class="line"></div>

        <div class="row">
            <div class="left">
                Sub Total
            </div>

            <div class="right">
                Rp {{ number_format($payment->booking->total_price, 0, ',', '.') }}
            </div>
        </div>

        <div class="row total-row">
            <div class="left">
                Total
            </div>

            <div class="right">
                Rp {{ number_format($payment->booking->total_price, 0, ',', '.') }}
            </div>
        </div>

        <div class="row">
            <div class="left">
                Dibayar
            </div>

            <div class="right bold">
                Rp {{ number_format($payment->amount, 0, ',', '.') }}
            </div>
        </div>

        <div class="row">
            <div class="left">
                Sisa
            </div>

            <div class="right">
                Rp {{ number_format(max($payment->booking->total_price - $payment->amount, 0), 0, ',', '.') }}
            </div>
        </div>

        <div class="row">
            <div class="left">
                Status
            </div>

            <div class="right status">
                {{ $payment->status }}
            </div>
        </div>

        <div class="row">
            <div class="left">
                Verified
            </div>

            <div class="right">
                {{ $payment->verifier?->name ?? 'Not Verified' }}
            </div>
        </div>

        <div class="line"></div>

        <div class="footer">
            Terima kasih telah menggunakan<br>
            layanan Leony Bintang Trans<br><br>

            <span class="code">
                Receipt: {{ $payment->payment_code }}
            </span>
        </div>

    </div>

</body>
</html>
