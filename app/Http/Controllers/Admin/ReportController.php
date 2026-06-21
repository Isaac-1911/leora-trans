<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Car;
use App\Models\Payment;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function index()
    {
        $period = request('period', 'month');

        $startDate = now()->startOfMonth();

        switch ($period) {

            case '3months':

                $startDate =
                    now()->subMonths(3);

                break;

            case '6months':

                $startDate =
                    now()->subMonths(6);

                break;

            case 'year':

                $startDate =
                    now()->startOfYear();

                break;
        }

        /*
        |--------------------------------------------------------------------------
        | KPI CARDS
        |--------------------------------------------------------------------------
        */

        $totalRevenue =
            Payment::where(
                'status',
                'approved'
            )
            ->whereDate(
                'payment_date',
                '>=',
                $startDate
            )
            ->sum('amount');

        $totalBookings =
            Booking::where(
                'created_at',
                '>=',
                $startDate
            )
            ->count();

        $avgRentalDays =
            round(

                Booking::where(
                    'created_at',
                    '>=',
                    $startDate
                )
                ->avg(
                    'total_days'
                ) ?? 0,

                1

            );

        $totalCars =
            Car::count();

        $rentedCars =
            Car::where(
                'status',
                'rented'
            )->count();

        $utilizationRate =
            $totalCars > 0

            ? round(
                (
                    $rentedCars /
                    $totalCars
                ) * 100
            )

            : 0;

        /*
        |--------------------------------------------------------------------------
        | TOP VEHICLES
        |--------------------------------------------------------------------------
        */

        $topVehicles =
            Car::withCount(
                'bookings'
            )
            ->orderByDesc(
                'bookings_count'
            )
            ->take(5)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | REVENUE CHART
        |--------------------------------------------------------------------------
        */

        $revenueLabels = [];
        $revenueData = [];

        for ($i = 5; $i >= 0; $i--) {

            $month =
                Carbon::now()
                ->subMonths($i);

            $revenueLabels[] =
                $month->format('M');

            $revenueData[] =
                Payment::where(
                    'status',
                    'approved'
                )
                ->whereYear(
                    'payment_date',
                    $month->year
                )
                ->whereMonth(
                    'payment_date',
                    $month->month
                )
                ->sum('amount');
        }

        /*
        |--------------------------------------------------------------------------
        | BOOKING CHART
        |--------------------------------------------------------------------------
        */

        $bookingData = [];

        for ($i = 5; $i >= 0; $i--) {

            $month =
                Carbon::now()
                ->subMonths($i);

            $bookingData[] =
                Booking::whereYear(
                    'created_at',
                    $month->year
                )
                ->whereMonth(
                    'created_at',
                    $month->month
                )
                ->count();
        }

        /*
        |--------------------------------------------------------------------------
        | PROFIT ANALYSIS
        |--------------------------------------------------------------------------
        */

        $operatingCosts =
            0;

        $maintenanceCosts =
            0;

        $insuranceCosts =
            0;

        $netProfit =
            $totalRevenue
            - $operatingCosts
            - $maintenanceCosts
            - $insuranceCosts;

        return view(
            'admin.reports.index',
            compact(

                'period',

                'totalRevenue',
                'totalBookings',
                'avgRentalDays',
                'utilizationRate',

                'topVehicles',

                'revenueLabels',
                'revenueData',

                'bookingData',

                'operatingCosts',
                'maintenanceCosts',
                'insuranceCosts',
                'netProfit'
            )
        );
    }
}
