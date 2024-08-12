<?php

use App\Http\Controllers\WeatherController;
use Illuminate\Support\Facades\Route;

Route::get('/', [WeatherController::class, 'showWeather'])->name('weather');

// Route::get('/', function () {
//     return view('test');
// });
