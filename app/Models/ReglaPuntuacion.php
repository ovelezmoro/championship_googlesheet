<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ReglaPuntuacion extends Model
{
    protected $table = 'reglas_puntuacion';
    protected $primaryKey = 'id_regla_puntuacion';

    protected $fillable = [
        'id_campeonato',
        'nombre_regla',
        'descripcion',
        'puntos_victoria_2_0',
        'puntos_victoria_2_1',
        'puntos_derrota_1_2',
        'puntos_derrota_0_2',
    ];

    public function campeonato(): BelongsTo
    {
        return $this->belongsTo(Campeonato::class, 'id_campeonato', 'id_campeonato');
    }

    public function criteriosDesempate(): HasMany
    {
        return $this->hasMany(CriterioDesempate::class, 'id_regla_puntuacion', 'id_regla_puntuacion');
    }
}
