<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;

class CarController extends Controller
{
    public function index()
    {
        $cars = Car::all();

        return response()->json($cars, 200);
    }

    public function show($car_id)
    {
        $car = Car::find($car_id);

        return response()->json($car, 200);
    }
}
