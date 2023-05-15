<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CarController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FiltersController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'catalog/cars'], function () {
    Route::get('/', [CarController::class, 'index']);
    Route::get('/show/{car_id}', [CarController::class, 'show']);
});

Route::group(['prefix' => 'catalog/category'], function () {
    Route::get('/', [CategoryController::class, 'index']);
});

Route::group(['prefix' => 'filter'], function () {
    Route::get('/make', [FiltersController::class, 'makeFilter']);
});
