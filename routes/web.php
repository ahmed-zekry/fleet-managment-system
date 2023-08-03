<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\BusController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\TripController;
use App\Http\Controllers\Admin\BookingController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect('/dashboard');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('city', [CityController::class, 'index'])->name('city');
    Route::get('city/create', [CityController::class, 'create']);
    Route::get('city/edit/{city}', [CityController::class, 'create']);
    Route::post('city/delete/{city}', [CityController::class, 'delete']);

    Route::get('bus', [BusController::class, 'index'])->name('bus');
    Route::get('bus/create', [BusController::class, 'create']);
    Route::get('bus/edit/{bus}', [BusController::class, 'create']);
    Route::post('bus/delete/{bus}', [BusController::class, 'delete']);

    Route::get('trip', [TripController::class, 'index'])->name('trip');
    Route::get('trip/create', [TripController::class, 'create']);
    Route::get('trip/edit/{trip}', [TripController::class, 'create']);
    Route::post('trip/delete/{trip}', [TripController::class, 'delete']);

    Route::get('booking', [BookingController::class, 'index'])->name('booking');
});
