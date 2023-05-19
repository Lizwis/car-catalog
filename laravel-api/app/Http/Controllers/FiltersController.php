<?php

namespace App\Http\Controllers;

use App\Models\Car;

class FiltersController extends Controller
{
    public function makeFilter()
    {
        $make = Car::select('make')->distinct()->get();

        return response()->json($make, 200);
    }

    public function yearFilter()
    {
        $year = Car::select('year')->distinct()->get();

        return response()->json($year, 200);
    }
}
