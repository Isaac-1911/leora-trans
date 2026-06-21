<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Car;
use App\Models\Payment;

class ReportController extends Controller
{
    public function index()
    {
        $totalRevenue =
            Payment::where(
                'status',
                'approved'
            )->sum('amount');

        $totalBookings =
            Booking::count();

        $avgRentalDays =
            round(
                Booking::avg(
                    'total_days'
                ) ?? 0,
                1
            );

        $utilizationRate =
            Car::count() > 0
            ? round(
                (
                    Car::where(
                        'status',
                        'rented'
                    )->count()
                    /
                    Car::count()
                ) * 100
            )
            : 0;

        $topVehicles =
            Car::withCount(
                'bookings'
            )
            ->orderByDesc(
                'bookings_count'
            )
            ->take(5)
            ->get();

        return view(
            'admin.reports.index',
            compact(
                'totalRevenue',
                'totalBookings',
                'avgRentalDays',
                'utilizationRate',
                'topVehicles'
            )
        );
    }
}
