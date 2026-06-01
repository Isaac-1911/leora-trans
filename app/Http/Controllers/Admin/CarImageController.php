<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCarImageRequest;
use App\Http\Requests\UpdateCarImageRequest;
use App\Models\Car;
use App\Models\CarImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CarImageController extends Controller
{
    public function store(StoreCarImageRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')
                ->store('car_images', 'public');
        }

        CarImage::create($data);

        return back()->with('success', 'Car Image Stored');
    }


    public function destroy(CarImage $carImage)
    {

        if ($carImage->image && Storage::disk('public')->exists($carImage->image)) {
            Storage::disk('public')->delete($carImage->image);
        }

        $carImage->delete();

        return back()->with('success', 'Car Image Deleted!');
    }
}
