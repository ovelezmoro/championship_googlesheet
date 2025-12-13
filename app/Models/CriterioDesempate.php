<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CriterioDesempate extends Model
{
    protected $table = 'criterios_desempate';
    protected $primaryKey = 'id_criterio_desempate';
    public $timestamps = false;

    protected $fillable = [
        'id_regla_puntuacion',
        'orden_criterio',
        'nombre_criterio',
        'activo',
    ];

    protected $casts = [
        'activo' => 'boolean',
    ];

    public function reglaPuntuacion(): BelongsTo
    {
        return $this->belongsTo(ReglaPuntuacion::class, 'id_regla_puntuacion', 'id_regla_puntuacion');
    }
}
