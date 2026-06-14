<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Configuracion extends Model
{
    use HasFactory;

    protected $table = 'configuraciones';

    protected $fillable = ['colorAccentoUsuario', 'colorAccentoEditor', 'colorAccentoAdmin', 'pfpPorDefectoUsuario', 'pfpPorDefectoEditor', 'pfpPorDefectoAdmin', 'removerComentariosEditores', 'modificarComentariosUsuarios', 'limiteDePublicaciones', 'limiteDeComentarios'];

    public $timestamps = false;
}
