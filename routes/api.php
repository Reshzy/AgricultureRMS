<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PsgcController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// PSGC proxy endpoints (public)
Route::get('/psgc/regions', [PsgcController::class, 'regions']);
Route::get('/psgc/regions/{region}/provinces', [PsgcController::class, 'provincesByRegion']);
Route::get('/psgc/provinces/{province}/cities', [PsgcController::class, 'citiesByProvince']);
Route::get('/psgc/cities/{city}/barangays', [PsgcController::class, 'barangaysByCity']);
