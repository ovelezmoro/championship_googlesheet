<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TablaPosicion extends Model
{
    protected $table = 'tabla_posiciones';
    protected $primaryKey = 'id_posicion';

    protected $fillable = [
        'id_campeonato',
        'id_equipo',
        'partidos_jugados',
        'partidos_ganados',
        'partidos_perdidos',
        'sets_a_favor',
        'sets_en_contra',
        'diferencia_sets',
        'puntos_a_favor',
        'puntos_en_contra',
        'diferencia_puntos',
        'puntos_totales',
        'puesto',
        'estado_tabla',
        'fecha_calculo',
    ];

    protected $casts = [
        'fecha_calculo' => 'datetime',
    ];

    public function campeonato(): BelongsTo
    {
        return $this->belongsTo(Campeonato::class, 'id_campeonato', 'id_campeonato');
    }

    public function equipo(): BelongsTo
    {
        return $this->belongsTo(Equipo::class, 'id_equipo', 'id_equipo');
    }
}
