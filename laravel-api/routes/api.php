<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CarController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FiltersController;
use App\Http\Controllers\SoapController;




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
    Route::post('/', [CarController::class, 'index']);
    Route::get('/show/{car_id}', [CarController::class, 'show']);
    Route::post('/update/{car_id}', [CarController::class, 'update']);
});

Route::group(['prefix' => 'catalog/category'], function () {
    Route::get('/', [CategoryController::class, 'index']);
});

Route::group(['prefix' => 'filter'], function () {
    Route::get('/make', [FiltersController::class, 'makeFilter']);
    Route::get('/year', [FiltersController::class, 'yearFilter']);
});

Route::group(['prefix' => 'soap'], function () {
    Route::get('/', [SoapController::class, 'index']);
});
