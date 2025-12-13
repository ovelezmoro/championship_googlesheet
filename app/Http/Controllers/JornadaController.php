<?php

namespace App\Http\Controllers;

use App\Models\Jornada;
use Illuminate\Http\Request;

class JornadaController extends Controller
{
    public function index()
    {
        return Jornada::with('campeonato')->get();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'id_campeonato'  => 'required|exists:campeonatos,id_campeonato',
            'numero_jornada' => 'required|integer|min:1',
            'nombre_jornada' => 'nullable|string|max:100',
            'fecha_jornada'  => 'required|date',
        ]);

        $jornada = Jornada::create($data);

        return response()->json($jornada, 201);
    }

    public function show(Jornada $jornada)
    {
        return $jornada->load('campeonato', 'partidos');
    }

    public function update(Request $request, Jornada $jornada)
    {
        $data = $request->validate([
            'numero_jornada' => 'sometimes|required|integer|min:1',
            'nombre_jornada' => 'nullable|string|max:100',
            'fecha_jornada'  => 'sometimes|required|date',
        ]);

        $jornada->update($data);

        return $jornada;
    }

    public function destroy(Jornada $jornada)
    {
        $jornada->delete();

        return response()->noContent();
    }
}
