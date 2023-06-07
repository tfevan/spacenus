<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\PlaceController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum','throttle:30,1')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('throttle:30,1')->controller(AuthController::class)->group(function() {
	Route::post('login', 'login');
	Route::post('register','register');
});

Route::middleware('auth:sanctum','throttle:30,1')->controller(PlaceController::class)->group(function() {
	Route::get('places', 'places');
});
