<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBookingRequest;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Car;
use Carbon\Carbon;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Booking::with('car');

        $cars = Car::all();

        if ($request->filled('status')) {
            $query->where('booking_status', $request->status);
        }

        $bookings = $query->latest()->paginate(10)->withQueryString();

        return view('admin.bookings.index', compact('bookings', 'cars'));
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
