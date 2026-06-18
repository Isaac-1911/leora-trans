<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Car;
use App\Models\Payment;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        /*
        |--------------------------------------------------------------------------
        | KPI CARDS
        |--------------------------------------------------------------------------
        */

        $totalCars =
            Car::count();

        $availableCars =
            Car::where(
                'status',
                'available'
            )->count();

        $activeRentals =
            Booking::whereIn(
                'booking_status',
                [
                    'confirmed',
                    'ongoing'
                ]
            )->count();

        $monthlyRevenue =
            Payment::where(
                'status',
                'approved'
            )->sum('amount');

        /*
        |--------------------------------------------------------------------------
        | VEHICLE STATUS CHART
        |--------------------------------------------------------------------------
        */

        $availableCount =
            Car::where(
                'status',
                'available'
            )->count();

        $rentedCount =
            Car::where(
                'status',
                'rented'
            )->count();

        $maintenanceCount =
            Car::where(
                'status',
                'maintenance'
            )->count();

        /*
        |--------------------------------------------------------------------------
        | RECENT BOOKINGS
        |--------------------------------------------------------------------------
        */

        $recentBookings =
            Booking::with('car')
            ->latest()
            ->take(5)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | RECENT PAYMENTS
        |--------------------------------------------------------------------------
        */

        $recentPayments =
            Payment::with('booking')
            ->latest()
            ->take(5)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | REVENUE TREND (6 BULAN TERAKHIR)
        |--------------------------------------------------------------------------
        */

        $revenueTrend =
            Payment::select(
                DB::raw('MONTH(payment_date) as month'),
                DB::raw('SUM(amount) as total')
            )
            ->where('status', 'approved')
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total')
            ->toArray();

        return view(
            'admin.dashboard.index',
            compact(

                'totalCars',
                'availableCars',
                'activeRentals',
                'monthlyRevenue',

                'availableCount',
                'rentedCount',
                'maintenanceCount',

                'recentBookings',
                'recentPayments',

                'revenueTrend'
            )
        );
    }
}
