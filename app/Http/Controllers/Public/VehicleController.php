<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Car;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function index(Request $request)
    {
        $query = Car::query();

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                    ->orWhere('brand', 'like', '%' . $request->search . '%')
                    ->orWhere('year', 'like', '%' . $request->search . '%')
                    ->orWhere('plate_number', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        $cars = $query->latest()->get();

        return view('public.vehicles.index', compact('cars'));
    }

    public function show(Car $car)
    {
        $car->load('images');

        return view('public.vehicles.show', compact('car'));
    }
}
