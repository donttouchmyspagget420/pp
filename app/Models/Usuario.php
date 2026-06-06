<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;

    protected $table = 'usuarios';

    protected $fillable = ['fk_rol', 'pfp', 'nombre', 'username', 'correo', 'ubicacion', 'educacion', 'siguidores', 'siguiendo', 'tele', 'password'];

    protected $hidden = ['password'];

    public $timestamps = false;

    public function configUsuario()
    {
        return $this->hasOne(ConfigUsuario::class, 'fk_usuario');
    }
}
