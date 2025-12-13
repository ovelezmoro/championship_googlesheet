<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Campeonato extends Model
{
    protected $table = 'campeonatos';
    protected $primaryKey = 'id_campeonato';

    protected $fillable = [
        'nombre_campeonato',
        'descripcion',
        'deporte',
        'categoria_general',
        'fecha_inicio',
        'fecha_fin',
        'estado',
        'ubicacion',
        'detalle_ubicacion'
    ];

    protected $casts = [
        'fecha_inicio' => 'date',
        'fecha_fin'    => 'date',
    ];

    public function equipos(): HasMany
    {
        return $this->hasMany(Equipo::class, 'id_campeonato', 'id_campeonato');
    }

    public function jornadas(): HasMany
    {
        return $this->hasMany(Jornada::class, 'id_campeonato', 'id_campeonato');
    }

    public function reglasPuntuacion(): HasMany
    {
        return $this->hasMany(ReglaPuntuacion::class, 'id_campeonato', 'id_campeonato');
    }

    public function tablaPosiciones(): HasMany
    {
        return $this->hasMany(TablaPosicion::class, 'id_campeonato', 'id_campeonato');
    }
}
