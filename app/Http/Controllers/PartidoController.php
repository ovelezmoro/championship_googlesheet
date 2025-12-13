<?php

namespace App\Http\Controllers;

use App\Models\Partido;
use Illuminate\Http\Request;

class PartidoController extends Controller
{
    public function index()
    {
        return Partido::with('jornada', 'equipoLocal', 'equipoVisitante')
            ->orderBy('id_jornada')
            ->get();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'id_jornada'          => 'required|exists:jornadas,id_jornada',
            'id_equipo_local'     => 'required|exists:equipos,id_equipo',
            'id_equipo_visitante' => 'required|different:id_equipo_local|exists:equipos,id_equipo',
            'hora_partido'        => 'nullable|date_format:H:i',
            'cancha'              => 'nullable|string|max:50',
            'estado_partido'      => 'nullable|in:PROGRAMADO,EN_JUEGO,FINALIZADO,SUSPENDIDO',
            'observaciones'       => 'nullable|string|max:255',
        ]);

        $partido = Partido::create($data);

        return response()->json($partido, 201);
    }

    public function show(Partido $partido)
    {
        return $partido->load('jornada', 'equipoLocal', 'equipoVisitante', 'resultadosSets');
    }

    public function update(Request $request, Partido $partido)
    {
        $data = $request->validate([
            'hora_partido'   => 'nullable|date_format:H:i',
            'cancha'         => 'nullable|string|max:50',
            'estado_partido' => 'nullable|in:PROGRAMADO,EN_JUEGO,FINALIZADO,SUSPENDIDO',
            'observaciones'  => 'nullable|string|max:255',
        ]);

        $partido->update($data);

        return $partido;
    }

    public function destroy(Partido $partido)
    {
        $partido->delete();

        return response()->noContent();
    }
}
