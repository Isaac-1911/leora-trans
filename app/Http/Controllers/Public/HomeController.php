<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Car;

class HomeController extends Controller
{
    public function index()
{
    $cars = Car::where('status', 'available')
        ->latest()
        ->take(3)
        ->get();

    return view('public.home', compact('cars'));
}
}
