<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePaymentRequest;
use App\Http\Requests\UpdatePaymentRequest;
use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PaymentController extends Controller
{
    public function index(Request $request)
    {
        $payments = Payment::with('booking')
            ->when(
                $request->status,
                fn($q) =>
                $q->where(
                    'status',
                    $request->status
                )
            )
            ->latest()
            ->get();

        $bookings = Booking::orderBy(
            'booking_code'
        )->get();

        return view(
            'admin.payments.index',
            compact(
                'payments',
                'bookings'
            )
        );
    }

    public function store(
        StorePaymentRequest $request
    ) {
        $data = $request->validated();

        $lastPayment =
            Payment::latest('id')
            ->first();

        if ($lastPayment) {

            $lastNumber =
                (int) str_replace(
                    'PAY-',
                    '',
                    $lastPayment->payment_code
                );

            $nextNumber =
                $lastNumber + 1;
        } else {

            $nextNumber = 1;
        }

        $data['payment_code'] =
            'PAY-' .
            str_pad(
                $nextNumber,
                3,
                '0',
                STR_PAD_LEFT
            );

        if (
            $request->hasFile(
                'proof_image'
            )
        ) {

            $data['proof_image'] =
                $request
                ->file('proof_image')
                ->store(
                    'payments',
                    'public'
                );
        }

        if (
            $data['status']
            === 'approved'
        ) {

            $data['verified_by'] =
                Auth::id();
        }

        Payment::create($data);

        $booking = Booking::findOrFail(
            $data['booking_id']
        );

        $booking->update([

            'payment_status' => match ($data['status']) {

                'approved' => 'paid',

                'rejected' => 'rejected',

                default => 'pending'
            }

        ]);

        return back()->with(
            'success',
            'Payment berhasil ditambahkan!'
        );
    }

    public function update(
        UpdatePaymentRequest $request,
        Payment $payment
    ) {
        $data = $request->validated();

        if (
            $request->hasFile(
                'proof_image'
            )
        ) {

            if (
                $payment->proof_image
            ) {

                Storage::disk('public')
                    ->delete(
                        $payment->proof_image
                    );
            }

            $data['proof_image'] =
                $request
                ->file('proof_image')
                ->store(
                    'payments',
                    'public'
                );
        }

        if (
            $data['status']
            === 'approved'
        ) {

            $data['verified_by'] =
                Auth::id();
        }

        $payment->update($data);

        $payment->booking->update([

            'payment_status' => match ($data['status']) {

                'approved' => 'paid',

                'rejected' => 'rejected',

                default => 'pending'
            }

        ]);

        return back()->with(
            'success',
            'Payment berhasil diperbarui!'
        );
    }

    public function destroy(
        Payment $payment
    ) {
        if (
            $payment->proof_image
        ) {

            Storage::disk('public')
                ->delete(
                    $payment->proof_image
                );
        }

        $payment->delete();

        return back()->with(
            'success',
            'Payment berhasil dihapus!'
        );
    }
}
