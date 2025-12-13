<?php

use App\Http\Controllers\{
    CampeonatoController,
    EquipoController,
    JornadaController,
    PartidoController,
    TablaPosicionController
};

Route::apiResource('campeonatos', CampeonatoController::class);
Route::apiResource('equipos', EquipoController::class);
Route::apiResource('jornadas', JornadaController::class);
Route::apiResource('partidos', PartidoController::class);
Route::apiResource('tabla-posiciones', TablaPosicionController::class);
