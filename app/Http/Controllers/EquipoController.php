<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use Illuminate\Http\Request;

class EquipoController extends Controller
{
    public function index()
    {
        return Equipo::with('campeonato')->get();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'id_campeonato'       => 'required|exists:campeonatos,id_campeonato',
            'nombre_equipo'       => 'required|string|max:100',
            'categoria_equipo'    => 'nullable|string|max:50',
            'nombre_representante'=> 'nullable|string|max:100',
            'telefono_contacto'   => 'nullable|string|max:20',
            'correo_contacto'     => 'nullable|email|max:120',
            'activo'              => 'boolean',
        ]);

        $equipo = Equipo::create($data);

        return response()->json($equipo, 201);
    }

    public function show(Equipo $equipo)
    {
        return $equipo->load('campeonato');
    }

    public function update(Request $request, Equipo $equipo)
    {
        $data = $request->validate([
            'nombre_equipo'        => 'sometimes|required|string|max:100',
            'categoria_equipo'     => 'nullable|string|max:50',
            'nombre_representante' => 'nullable|string|max:100',
            'telefono_contacto'    => 'nullable|string|max:20',
            'correo_contacto'      => 'nullable|email|max:120',
            'activo'               => 'boolean',
        ]);

        $equipo->update($data);

        return $equipo;
    }

    public function destroy(Equipo $equipo)
    {
        $equipo->delete();

        return response()->noContent();
    }
}
