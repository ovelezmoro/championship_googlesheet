<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Revolution\Google\Sheets\Facades\Sheets;

class ChampionshipController extends Controller
{
    const PUNTOS_VICTORIA_2_0 = 3;
    const PUNTOS_VICTORIA_2_1 = 2;
    const PUNTOS_DERROTA_1_2  = 1;
    const PUNTOS_DERROTA_0_2  = 0;

    public function excel()
    {
        $data = Sheets::spreadsheet('1wwTVacYi8mx3t97SJ7vCjSXOwIH9FF0juOY5MVKNmME')
            ->sheet('Hoja 2')
            ->range('A2:R')
            ->all();

        return response()->json($data);
    }

    public function json()
    {
        $tabla = $this->generarTabla();
        return response()->json($tabla);
    }

    public function index()
    {
        $tabla = $this->generarTabla(); // Usa tu lógica actual para generar la tabla
        return view('championship.tabla', compact('tabla'));
    }

    public function generarTabla()
    {
        $data = Sheets::spreadsheet('1wwTVacYi8mx3t97SJ7vCjSXOwIH9FF0juOY5MVKNmME')
            ->sheet('Hoja 2')
            ->range('A2:R')
            ->all();

        // Aquí guardaremos todos los equipos por categoría/serie
        $tabla = [];

        foreach ($data as $fila) {
            $campo = $fila[1] ?? null;
            $categoria = $fila[2] ?? 'SIN CATEGORIA'; // Columna C
            $serie = $fila[3] ?? 'SIN SERIE';        // Columna D
            $local = $fila[4] ?? null;
            $visita = $fila[5] ?? null;

            if (!$local || !$visita) continue;

            // Usamos llave combinada para agrupar dentro de categoría/serie
            if (!isset($tabla[$categoria])) {
                $tabla[$categoria] = [];
            }
            if (!isset($tabla[$categoria][$serie])) {
                $tabla[$categoria][$serie] = [];
            }

            // Referencia al grupo actual
            $grupo = &$tabla[$categoria][$serie];

            // Inicializar equipos siempre
            foreach ([$local, $visita] as $equipo) {
                if (!isset($grupo[$equipo])) {
                    $grupo[$equipo] = [
                        'EQUIPO' => $equipo,
                        'PJ' => 0,
                        'G' => 0,
                        'P' => 0,
                        'SF' => 0,
                        'SC' => 0,
                        'PF' => 0,
                        'PC' => 0,
                        'PTOS' => 0,
                    ];
                }
            }

            // Si no hay campo, partido no jugado
            if (!$campo) continue;

            // Sets ganados
            $sets_local  = intval($fila[6] ?? 0);  // Columna G
            $sets_visita = intval($fila[8] ?? 0);  // Columna I

            // Puntos por set
            $set1_local  = intval($fila[9] ?? 0); // Columna J 
            $set1_visita = intval($fila[11] ?? 0); // Columna L
            $set2_local  = intval($fila[12] ?? 0); // Columna M
            $set2_visita = intval($fila[14] ?? 0); // Columna O
            $set3_local  = intval($fila[15] ?? 0); // Columna P
            $set3_visita = intval($fila[17] ?? 0); // Columna R

            // Puntos tabla
            if ($sets_local === 2 && $sets_visita === 0) {
                $ptos_local = self::PUNTOS_VICTORIA_2_0;
                $ptos_visita = self::PUNTOS_DERROTA_0_2;
            } elseif ($sets_local === 2 && $sets_visita === 1) {
                $ptos_local = self::PUNTOS_VICTORIA_2_1;
                $ptos_visita = self::PUNTOS_DERROTA_1_2;
            } elseif ($sets_visita === 2 && $sets_local === 0) {
                $ptos_visita = self::PUNTOS_VICTORIA_2_0;
                $ptos_local = self::PUNTOS_DERROTA_0_2;
            } elseif ($sets_visita === 2 && $sets_local === 1) {
                $ptos_visita = self::PUNTOS_VICTORIA_2_1;
                $ptos_local = self::PUNTOS_DERROTA_1_2;
            } else {
                $ptos_local = 0;
                $ptos_visita = 0;
            }

            // Actualizar estadísticas
            $grupo[$local]['PJ']++;
            $grupo[$local]['SF'] += $sets_local;
            $grupo[$local]['SC'] += $sets_visita;
            $grupo[$local]['PF'] += $set1_local + $set2_local + $set3_local;
            $grupo[$local]['PC'] += $set1_visita + $set2_visita + $set3_visita;
            $grupo[$local]['PTOS'] += $ptos_local;
            $grupo[$local][$sets_local > $sets_visita ? 'G' : 'P']++;

            $grupo[$visita]['PJ']++;
            $grupo[$visita]['SF'] += $sets_visita;
            $grupo[$visita]['SC'] += $sets_local;
            $grupo[$visita]['PF'] += $set1_visita + $set2_visita + $set3_visita;
            $grupo[$visita]['PC'] += $set1_local + $set2_local + $set3_local;
            $grupo[$visita]['PTOS'] += $ptos_visita;
            $grupo[$visita][$sets_visita > $sets_local ? 'G' : 'P']++;
        }

        // Calcular ratios y rank por grupo
        foreach ($tabla as $cat => &$series) {
            foreach ($series as $serieKey => &$equipos) {
                $equipos = collect($equipos)->map(function ($item) {
                    $item['RS'] = $item['SF'] - $item['SC']; //$item['SC'] > 0 ? round($item['SF'] / $item['SC'], 2) : $item['SF'];
                    $item['RP'] = $item['PF'] - $item['PC']; //$item['PC'] > 0 ? round($item['PF'] / $item['PC'], 2) : $item['PF'];
                    return $item;
                })->sortBy([
                           ['PTOS', 'desc'],
                           ['PF', 'desc']
                           ])->values();
                
                //->sortByDesc('PTOS')->values();

                // Rank
                foreach ($equipos as $i => &$equipo) {
                    $equipo['Rank'] = $i + 1;
                }
            }
        }

        return $tabla;
    }
}
