<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;

class CarController extends Controller
{
    public function index()
    {
        $sortPrice = request()->sortPrice;

        $newMakeFilter = array_filter(request()->makeFilter ?? []);
        $newYearFilter = array_filter(request()->yearFilter ?? []);

        $cars = Car::when(!empty($newMakeFilter), function ($query) use ($newMakeFilter) {
            return $query->whereIn('make', $newMakeFilter);
        })
            ->when(!empty($newYearFilter), function ($query) use ($newYearFilter) {
                return $query->whereIn('year', $newYearFilter);
            })
            ->orderBy('price', $sortPrice)
            ->get();

        $count = $cars->count();

        return response()->json(compact('cars', 'count'), 200);
    }

    public function show($car_id)
    {
        $car = Car::find($car_id);

        return response()->json($car, 200);
    }

    public function update($car_id)
    {

        $validated = request()->validate([
            'price' => 'required|numeric',
        ]);
        $car = Car::find($car_id);

        $car->update([
            'price' => $validated['price'],

        ]);

        return response()->json($car, 200);
    }
}
