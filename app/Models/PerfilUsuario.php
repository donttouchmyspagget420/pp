<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerfilUsuario extends Model
{
    use HasFactory;

    protected $table = 'perfil_usuarios';

    protected $fillable = ['fk_usuario', 'pfp', 'ubicacion', 'educacion', 'tele'];

    public $timestamps = false;
}
