<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UsuarioRol extends Model
{
    protected $table = 'usuario_rol';
    protected $primaryKey = 'id_usuario_rol';
    public $timestamps = false;

    protected $fillable = [
        'id_usuario',
        'id_rol',
        'id_campeonato',
    ];

    public function usuario(): BelongsTo
    {
        return $this->belongsTo(Usuario::class, 'id_usuario', 'id_usuario');
    }

    public function rol(): BelongsTo
    {
        return $this->belongsTo(Rol::class, 'id_rol', 'id_rol');
    }

    public function campeonato(): BelongsTo
    {
        return $this->belongsTo(Campeonato::class, 'id_campeonato', 'id_campeonato');
    }
}
