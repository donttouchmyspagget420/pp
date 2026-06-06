<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    use HasFactory;

    protected $table = 'comentarios';

    protected $fillable = ['contenido', 'fk_autor', 'fk_publicacion', 'fk_comentario', 'likes', 'respuestas'];

    public $timestamps = false;
}
