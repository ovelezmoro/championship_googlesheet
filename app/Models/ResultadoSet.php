<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ResultadoSet extends Model
{
    protected $table = 'resultados_sets';
    protected $primaryKey = 'id_resultado_set';
    public $timestamps = false;

    protected $fillable = [
        'id_partido',
        'numero_set',
        'puntos_local',
        'puntos_visitante',
    ];

    public function partido(): BelongsTo
    {
        return $this->belongsTo(Partido::class, 'id_partido', 'id_partido');
    }
}
