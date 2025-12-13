<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Jornada extends Model
{
    protected $table = 'jornadas';
    protected $primaryKey = 'id_jornada';

    protected $fillable = [
        'id_campeonato',
        'numero_jornada',
        'nombre_jornada',
        'fecha_jornada',
    ];

    protected $casts = [
        'fecha_jornada' => 'date',
    ];

    public function campeonato(): BelongsTo
    {
        return $this->belongsTo(Campeonato::class, 'id_campeonato', 'id_campeonato');
    }

    public function partidos(): HasMany
    {
        return $this->hasMany(Partido::class, 'id_jornada', 'id_jornada');
    }
}
