<?php

use App\Http\Controllers\ChampionshipController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/championship', [ChampionshipController::class, 'index'])->name('fase.grupos');;
Route::get('/championship/json', [ChampionshipController::class, 'json']);
Route::get('/championship/excel', [ChampionshipController::class, 'excel']);
Route::get('/championship/fixture', [ChampionshipController::class, 'fixture'])->name('fase.semifinales');
