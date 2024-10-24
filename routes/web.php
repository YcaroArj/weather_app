<?php

use App\Http\Controllers\FindWeatherController;
use Illuminate\Support\Facades\Route;

Route::get('/', [FindWeatherController::class, 'view']);
Route::post('/post', [FindWeatherController::class, 'findWeather'])->name('post.weather');
Route::get('/cidade/{city}', [FindWeatherController::class, 'viewWeather'])->name('weather.view');

Route::get('/cidade-nao-encontrada', function () {
    return view('404.app');
})->name('city.not.found');