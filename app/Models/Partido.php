<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Partido extends Model
{
    protected $table = 'partidos';
    protected $primaryKey = 'id_partido';

    protected $fillable = [
        'id_jornada',
        'id_equipo_local',
        'id_equipo_visitante',
        'hora_partido',
        'cancha',
        'estado_partido',
        'observaciones',
    ];

    protected $casts = [
        'hora_partido' => 'datetime:H:i',
    ];

    public function jornada(): BelongsTo
    {
        return $this->belongsTo(Jornada::class, 'id_jornada', 'id_jornada');
    }

    public function equipoLocal(): BelongsTo
    {
        return $this->belongsTo(Equipo::class, 'id_equipo_local', 'id_equipo');
    }

    public function equipoVisitante(): BelongsTo
    {
        return $this->belongsTo(Equipo::class, 'id_equipo_visitante', 'id_equipo');
    }

    public function resultadosSets(): HasMany
    {
        return $this->hasMany(ResultadoSet::class, 'id_partido', 'id_partido');
    }
}
