<?php

namespace App\Http\Controllers;

use App\Models\Car;

class FiltersController extends Controller
{
    public function makeFilter()
    {
        $categories = Car::select('make')->distinct()->get();

        return response()->json($categories, 200);
    }
}
