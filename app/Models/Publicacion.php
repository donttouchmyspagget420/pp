<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publicacion extends Model
{
    use HasFactory;

    protected $table = 'publicaciones';

    protected $fillable = ['imagen', 'titulo', 'contenido', 'fk_autor', 'fecha', 'destacados'];

    public $timestamps = false;
}
