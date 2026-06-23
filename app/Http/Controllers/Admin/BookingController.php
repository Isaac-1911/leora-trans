<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBookingRequest;
use App\Http\Requests\UpdateBookingRequest;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Car;
use Carbon\Carbon;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = Booking::with(
            'car'
        );

        if (
            request('status')
        ) {

            $query->where(
                'booking_status',
                request('status')
            );
        }

        $bookings =
            $query
            ->latest()
            ->get();

        /*
    |--------------------------------------------------------------------------
    | ADD BOOKING
    |--------------------------------------------------------------------------
    */

        $availableCars =
            Car::where(
                'status',
                'available'
            )
            ->whereDoesntHave(
                'bookings',
                function ($query) {

                    $query->whereIn(
                        'booking_status',
                        [
                            'confirmed',
                            'ongoing'
                        ]
                    );
                }
            )
            ->get();

        /*
    |--------------------------------------------------------------------------
    | EDIT BOOKING
    |--------------------------------------------------------------------------
    */

        $allCars =
            Car::orderBy(
                'name'
            )
            ->get();

        return view(
            'admin.bookings.index',
            compact(
                'bookings',
                'availableCars',
                'allCars'
            )
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookingRequest $request)
    {
        $booking = $request->validated();

        // Generate Booking Code
        $lastBooking = Booking::latest('id')->first();

        if ($lastBooking) {

            $lastNumber = (int) str_replace(
                'BK-',
                '',
                $lastBooking->booking_code
            );

            $nextNumber = $lastNumber + 1;
        } else {

            $nextNumber = 1;
        }

        $booking['booking_code'] =
            'BK-' . str_pad(
                $nextNumber,
                3,
                '0',
                STR_PAD_LEFT
            );

        // Hitung Total Hari
        $startDate = Carbon::parse(
            $booking['start_date']
        );

        $endDate = Carbon::parse(
            $booking['end_date']
        );

        $booking['total_days'] =
            max(
                1,
                $startDate->diffInDays($endDate)
            );

        // Ambil Harga Mobil
        $car = Car::findOrFail(
            $booking['car_id']
        );

        $booking['price_per_day'] =
            $car->price_per_day;

        // Hitung Total Harga
        $booking['total_price'] =
            $booking['price_per_day']
            *
            $booking['total_days'];

        // Default Status
        $booking['payment_status'] =
            'pending';

        $booking['booking_status'] =
            'waiting_payment';

        Booking::create($booking);

        return back()->with(
            'success',
            'Pesanan berhasil ditambahkan!'
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        UpdateBookingRequest $request,
        Booking $booking
    ) {

        $oldCar = $booking->car;

        $data = $request->validated();

        $car = Car::findOrFail(
            $data['car_id']
        );

        $startDate = Carbon::parse(
            $data['start_date']
        );

        $endDate = Carbon::parse(
            $data['end_date']
        );

        $data['total_days'] =
            max(
                1,
                $startDate->diffInDays($endDate)
            );

        $data['price_per_day'] =
            $car->price_per_day;

        $data['total_price'] =
            $data['total_days']
            *
            $data['price_per_day'];

        $booking->update($data);

        if (
            in_array(
                $booking->booking_status,
                [
                    'confirmed',
                    'ongoing'
                ]
            )
        ) {

            $car->update([
                'status' => 'rented'
            ]);
        } elseif (
            in_array(
                $booking->booking_status,
                [
                    'completed',
                    'cancelled'
                ]
            )
        ) {

            $car->update([
                'status' => 'available'
            ]);
        }

        if (
            $oldCar &&
            $oldCar->id !== $car->id
        ) {

            $oldCar->update([
                'status' => 'available'
            ]);
        }

        return back()->with(
            'success',
            'Booking Updated!'
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Booking $booking
    ) {
        $booking->delete();

        return back()->with(
            'success',
            'Booking Deleted!'
        );
    }
}
