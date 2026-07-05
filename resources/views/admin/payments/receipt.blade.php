<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Receipt {{ $payment->payment_code }}</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #111;
        }

        .header {
            text-align: center;
            border-bottom: 2px solid #111;
            padding-bottom: 10px;
            margin-bottom: 16px;
        }

        .brand {
            font-size: 22px;
            font-weight: bold;
            letter-spacing: 1px;
        }

        .subtitle {
            font-size: 11px;
            color: #555;
        }

        .title {
            text-align: center;
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 18px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        td {
            padding: 6px 0;
            vertical-align: top;
        }

        .label {
            width: 38%;
            color: #555;
        }

        .value {
            font-weight: bold;
        }

        .line {
            border-top: 1px solid #ddd;
            margin: 14px 0;
        }

        .total {
            font-size: 16px;
            font-weight: bold;
        }

        .status {
            text-transform: uppercase;
            font-weight: bold;
        }

        .footer {
            margin-top: 28px;
            text-align: center;
            font-size: 10px;
            color: #666;
        }
    </style>
</head>

<body>

    <div class="header">
        <div class="brand">LEORA TRANS</div>
        <div class="subtitle">Rental Car Payment Receipt</div>
    </div>

    <div class="title">
        PAYMENT RECEIPT
    </div>

    <table>
        <tr>
            <td class="label">Payment Code</td>
            <td class="value">{{ $payment->payment_code }}</td>
        </tr>

        <tr>
            <td class="label">Booking Code</td>
            <td class="value">{{ $payment->booking->booking_code }}</td>
        </tr>

        <tr>
            <td class="label">Customer</td>
            <td class="value">{{ $payment->booking->customer_name }}</td>
        </tr>

        <tr>
            <td class="label">Phone</td>
            <td class="value">{{ $payment->booking->customer_phone }}</td>
        </tr>

        <tr>
            <td class="label">Vehicle</td>
            <td class="value">{{ $payment->booking->car->name }}</td>
        </tr>

        <tr>
            <td class="label">Plate Number</td>
            <td class="value">{{ $payment->booking->car->plate_number }}</td>
        </tr>

        <tr>
            <td class="label">Rental Period</td>
            <td class="value">
                {{ \Carbon\Carbon::parse($payment->booking->start_date)->format('d M Y') }}
                -
                {{ \Carbon\Carbon::parse($payment->booking->end_date)->format('d M Y') }}
            </td>
        </tr>

        <tr>
            <td class="label">Total Days</td>
            <td class="value">{{ $payment->booking->total_days }} Days</td>
        </tr>
    </table>

    <div class="line"></div>

    <table>
        <tr>
            <td class="label">Payment Date</td>
            <td class="value">
                {{ \Carbon\Carbon::parse($payment->payment_date)->format('d M Y H:i') }}
            </td>
        </tr>

        <tr>
            <td class="label">Payment Status</td>
            <td class="value status">{{ $payment->status }}</td>
        </tr>

        <tr>
            <td class="label">Verified By</td>
            <td class="value">
                {{ $payment->verifier?->name ?? 'Not Verified' }}
            </td>
        </tr>

        <tr>
            <td class="label total">Amount Paid</td>
            <td class="value total">
                Rp {{ number_format($payment->amount, 0, ',', '.') }}
            </td>
        </tr>
    </table>

    <div class="footer">
        This receipt was generated automatically by Leora Trans system.
    </div>

</body>
</html>
