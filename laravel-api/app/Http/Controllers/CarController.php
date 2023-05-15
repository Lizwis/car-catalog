<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;

class CarController extends Controller
{
    public function index()
    {
        $cars = Car::all();
        $count = $cars->count();

        return response()->json(compact('cars', 'count'), 200);
    }

    public function show($car_id)
    {
        $car = Car::find($car_id);

        return response()->json($car, 200);
    }
}
