<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\BookingController;
use Illuminate\Support\Facades\Route;

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
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->prefix('trips')->group(function(){
    Route::get('find-available-seats', [BookingController::class, 'findAvailableSeats']);
    Route::post('book-trip-seat', [BookingController::class, 'bookTripSeat']);
});
