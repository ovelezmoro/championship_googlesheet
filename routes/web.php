<?php

use App\Http\Controllers\ChampionshipController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/championship', [ChampionshipController::class, 'index']);
Route::get('/championship/json', [ChampionshipController::class, 'json']);
Route::get('/championship/excel', [ChampionshipController::class, 'excel']);
