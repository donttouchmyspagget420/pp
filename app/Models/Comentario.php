<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comentario extends Model
{
    use HasFactory;

    protected $table = 'comentarios';

    protected $fillable = ['contenido', 'fk_autor', 'fk_publicacion', 'fk_comentario', 'likes', 'respuestas'];

    public $timestamps = false;


    public function publicacion(): BelongsTo
    {
        return $this->belongsTo(Publicacion::class, 'fk_publicacion');
    }

    public function usuario(): BelongsTo
    {
        return $this->belongsTo(Usuario::class, 'fk_autor');
    }

    public function comentario(): BelongsTo
    {
        return $this->belongsTo(Comentario::class, 'fk_comentario');
    }
}
