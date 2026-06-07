<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Usuario extends Model
{
    use HasFactory;

    protected $table = 'usuarios';

    protected $fillable = ['fk_rol', 'pfp', 'nombre', 'username', 'correo', 'ubicacion', 'educacion', 'siguidores', 'siguiendo', 'tele', 'password'];

    protected $hidden = ['password'];

    public $timestamps = false;

    public function configUsuario(): HasOne
    {
        return $this->hasOne(ConfigUsuario::class, 'fk_usuario');
    }

    public function rol(): BelongsTo
    {
        return $this->belongsTo(Rol::class, 'fk_rol');
    }
}
