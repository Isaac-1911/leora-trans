<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCarRequest;
use App\Http\Requests\UpdateCarRequest;
use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cars = Car::latest()->paginate(10);

        return view('admin.cars.index', compact('cars'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCarRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('thumbnail')){
            $data['thumbnail'] = $request->file('thumbnail')->store('cars', 'public');
        }

        Car::create($data);

        return back()->with('success', 'Car Stored!');

    }

    /**
     * Display the specified resource.
     */
    public function show(Car $car)
    {
        return view('admin.cars.show', compact('car'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Car $car)
    {
        return view('admin.cars.edit', compact('car'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCarRequest $request, Car $car)
    {

        $data = $request->validated();

        if ($request->hasFile('thumbnail')){

            if ($car->thumbnail && Storage::disk('public')->exists($car->thumbnail)){
                Storage::disk('public')->delete($car->thumbnail);
            }

            $data['thumbnail'] = $request->file('thumbnail')->store('cars', 'public');

        }

        $car->update($data);

        return back()->with('success', 'Car Updated!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Car $car)
    {
        if ($car->thumbnail && Storage::disk('public')->exists($car->thumbnail)){
            Storage::disk('public')->delete($car->thumbnail);
        }

        $car->delete();

        return back()->with('success', 'Car Deleted');
    }
}
