<?php

namespace App\Http\Controllers;

use App\Models\TablaPosicion;
use Illuminate\Http\Request;

class TablaPosicionController extends Controller
{
    public function index()
    {
        return TablaPosicion::with('campeonato', 'equipo')
            ->orderBy('id_campeonato')
            ->orderBy('puesto')
            ->get();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'id_campeonato'     => 'required|exists:campeonatos,id_campeonato',
            'id_equipo'         => 'required|exists:equipos,id_equipo',
            'partidos_jugados'  => 'integer|min:0',
            'partidos_ganados'  => 'integer|min:0',
            'partidos_perdidos' => 'integer|min:0',
            'sets_a_favor'      => 'integer|min:0',
            'sets_en_contra'    => 'integer|min:0',
            'diferencia_sets'   => 'integer',
            'puntos_a_favor'    => 'integer|min:0',
            'puntos_en_contra'  => 'integer|min:0',
            'diferencia_puntos' => 'integer',
            'puntos_totales'    => 'integer',
            'puesto'            => 'nullable|integer|min:1',
            'estado_tabla'      => 'in:PROVISIONAL,VALIDADA',
            'fecha_calculo'     => 'nullable|date',
        ]);

        $posicion = TablaPosicion::create($data);

        return response()->json($posicion, 201);
    }

    public function show(TablaPosicion $tablaPosicion)
    {
        return $tablaPosicion->load('campeonato', 'equipo');
    }

    public function update(Request $request, TablaPosicion $tablaPosicion)
    {
        $data = $request->validate([
            'partidos_jugados'  => 'integer|min:0',
            'partidos_ganados'  => 'integer|min:0',
            'partidos_perdidos' => 'integer|min:0',
            'sets_a_favor'      => 'integer|min:0',
            'sets_en_contra'    => 'integer|min:0',
            'diferencia_sets'   => 'integer',
            'puntos_a_favor'    => 'integer|min:0',
            'puntos_en_contra'  => 'integer|min:0',
            'diferencia_puntos' => 'integer',
            'puntos_totales'    => 'integer',
            'puesto'            => 'nullable|integer|min:1',
            'estado_tabla'      => 'in:PROVISIONAL,VALIDADA',
            'fecha_calculo'     => 'nullable|date',
        ]);

        $tablaPosicion->update($data);

        return $tablaPosicion;
    }

    public function destroy(TablaPosicion $tablaPosicion)
    {
        $tablaPosicion->delete();

        return response()->noContent();
    }
}
