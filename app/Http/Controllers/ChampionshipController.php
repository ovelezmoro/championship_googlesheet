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

        $tabla = [];

        foreach ($data as $fila) {
            $campo = $fila[1] ?? null;
            $local = $fila[4] ?? null;
            $visita = $fila[5] ?? null;

            if (!$local || !$visita) continue;

            // Inicializar equipos siempre
            foreach ([$local, $visita] as $equipo) {
                if (!isset($tabla[$equipo])) {
                    $tabla[$equipo] = [
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

            // Si no hay campo, partido no jugado, pero ya está inicializado
            if (!$campo) continue;

            // Sets ganados desde columnas G e I
            $sets_local  = intval($fila[6] ?? 0);  // Columna G
            $sets_visita = intval($fila[8] ?? 0);  // Columna I

            // Puntos por set
            $set1_local = intval($fila[10] ?? 0);
            $set1_visita = intval($fila[12] ?? 0);
            
            $set2_local = intval($fila[13] ?? 0);
            $set2_visita = intval($fila[15] ?? 0);
            
            $set3_local = intval($fila[16] ?? 0);
            $set3_visita = intval($fila[18] ?? 0);

            // Determinar puntos
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
            $tabla[$local]['PJ']++;
            $tabla[$local]['SF'] += $sets_local;
            $tabla[$local]['SC'] += $sets_visita;
            $tabla[$local]['PF'] += $set1_local + $set2_local + $set3_local;
            $tabla[$local]['PC'] += $set1_visita + $set2_visita + $set3_visita;
            $tabla[$local]['PTOS'] += $ptos_local;
            $tabla[$local][$sets_local > $sets_visita ? 'G' : 'P']++;

            $tabla[$visita]['PJ']++;
            $tabla[$visita]['SF'] += $sets_visita;
            $tabla[$visita]['SC'] += $sets_local;
            $tabla[$visita]['PF'] += $set1_visita + $set2_visita + $set3_visita;
            $tabla[$visita]['PC'] += $set1_local + $set2_local + $set3_local;
            $tabla[$visita]['PTOS'] += $ptos_visita;
            $tabla[$visita][$sets_visita > $sets_local ? 'G' : 'P']++;
        }

        // Calcular ratios y ordenar
        $tabla = collect($tabla)->map(function ($item) {
            $item['RS'] = $item['SC'] > 0 ? round($item['SF'] / $item['SC'], 2) : $item['SF'];
            $item['RP'] = $item['PC'] > 0 ? round($item['PF'] / $item['PC'], 2) : $item['PF'];
            return $item;
        })->sortByDesc('PTOS')->values();

        // Asignar Rank
        foreach ($tabla as $i => &$equipo) {
            $equipo['Rank'] = $i + 1;
        }

        return $tabla;
    }
}
