<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Equipo extends Model
{
    protected $table = 'equipos';
    protected $primaryKey = 'id_equipo';

    protected $fillable = [
        'id_campeonato',
        'nombre_equipo',
        'categoria_equipo',
        'nombre_representante',
        'telefono_contacto',
        'correo_contacto',
        'activo',
    ];

    protected $casts = [
        'activo' => 'boolean',
    ];

    public function campeonato(): BelongsTo
    {
        return $this->belongsTo(Campeonato::class, 'id_campeonato', 'id_campeonato');
    }

    public function partidosLocal(): HasMany
    {
        return $this->hasMany(Partido::class, 'id_equipo_local', 'id_equipo');
    }

    public function partidosVisitante(): HasMany
    {
        return $this->hasMany(Partido::class, 'id_equipo_visitante', 'id_equipo');
    }

    public function posiciones(): HasMany
    {
        return $this->hasMany(TablaPosicion::class, 'id_equipo', 'id_equipo');
    }
}
