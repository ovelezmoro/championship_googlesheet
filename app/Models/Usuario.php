<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Usuario extends Model
{
    protected $table = 'usuarios';
    protected $primaryKey = 'id_usuario';

    protected $fillable = [
        'nombre_completo',
        'correo',
        'clave_hash',
        'activo',
    ];

    protected $casts = [
        'activo' => 'boolean',
    ];

    public function usuarioRoles(): HasMany
    {
        return $this->hasMany(UsuarioRol::class, 'id_usuario', 'id_usuario');
    }

    public function logs(): HasMany
    {
        return $this->hasMany(LogAccion::class, 'id_usuario', 'id_usuario');
    }
}
