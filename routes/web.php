<?php

use App\Http\Controllers\ChampionshipController;
use \App\Http\Controllers\ConfigurationController;
use Illuminate\Support\Facades\Route;


Route::view('/{any?}', 'welcome')->where('any', '.*');

Route::get('/admin/teams', [ConfigurationController::class, 'teams'])->name('upn.configuration.teams');
Route::get('/admin/series', [ConfigurationController::class, 'series'])->name('upn.configuration.series');
Route::get('/admin/championship', [ConfigurationController::class, 'championship'])->name('upn.configuration.championship');

Route::get('/championship', [ChampionshipController::class, 'index'])->name('fase.grupos');;
Route::get('/championship/fixture', [ChampionshipController::class, 'fixture'])->name('fase.semifinales');
Route::get('/championship/json', [ChampionshipController::class, 'json']);
Route::get('/championship/excel', [ChampionshipController::class, 'excel']);


Route::get('/upn/championship', [ChampionshipController::class, 'indexUpn'])->name('upn.fase.grupos');;
Route::get('/upn/championship/fixture', [ChampionshipController::class, 'fixtureUpn'])->name('upn.fase.semifinales');
