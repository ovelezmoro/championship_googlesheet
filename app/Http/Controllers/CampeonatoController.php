<?php

namespace App\Http\Controllers;

use App\Models\Campeonato;
use Illuminate\Http\Request;

class CampeonatoController extends Controller
{
    public function index()
    {
        return Campeonato::with('equipos', 'jornadas')
            ->orderByDesc('creado_en')
            ->get();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre_campeonato' => 'required|string|max:100',
            'descripcion'       => 'nullable|string',
            'deporte'           => 'required|string|max:50',
            'categoria_general' => 'nullable|string|max:50',
            'fecha_inicio'      => 'required|date',
            'fecha_fin'         => 'nullable|date|after_or_equal:fecha_inicio',
            'estado'            => 'required|in:CONFIGURACION,EN_CURSO,FINALIZADO',
        ]);

        $campeonato = Campeonato::create($data);

        return response()->json($campeonato, 201);
    }

    public function show(Campeonato $campeonato)
    {
        return $campeonato->load('equipos', 'jornadas', 'tablaPosiciones');
    }

    public function update(Request $request, Campeonato $campeonato)
    {
        $data = $request->validate([
            'nombre_campeonato' => 'sometimes|required|string|max:100',
            'descripcion'       => 'nullable|string',
            'deporte'           => 'sometimes|required|string|max:50',
            'categoria_general' => 'nullable|string|max:50',
            'fecha_inicio'      => 'sometimes|required|date',
            'fecha_fin'         => 'nullable|date|after_or_equal:fecha_inicio',
            'estado'            => 'sometimes|required|in:CONFIGURACION,EN_CURSO,FINALIZADO',
        ]);

        $campeonato->update($data);

        return $campeonato;
    }

    public function destroy(Campeonato $campeonato)
    {
        $campeonato->delete();

        return response()->noContent();
    }
}
