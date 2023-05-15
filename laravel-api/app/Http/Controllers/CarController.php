<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;

class CarController extends Controller
{
    public function index()
    {
        $makeFilter = request()->makeFilter;
        $sortPrice = request()->sortPrice;

        $newmakeFilter = array_filter($makeFilter ?? []);

        $cars = Car::when(!empty($newmakeFilter), function ($query) use ($newmakeFilter) {
            return $query->whereIn('make', $newmakeFilter);
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
}
