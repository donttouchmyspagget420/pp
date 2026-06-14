<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Comentario extends Model
{
    use HasFactory;

    protected $table = 'comentarios';

    protected $fillable = ['contenido', 'fk_autor', 'fk_publicacion', 'fk_comentario'];

    public $timestamps = false;


    public function publicacion(): BelongsTo
    {
        return $this->belongsTo(Publicacion::class, 'fk_publicacion');
    }

    public function usuario(): BelongsTo
    {
        return $this->belongsTo(Usuario::class, 'fk_autor');
    }

    public function likes(): BelongsToMany
    {
        return $this->belongsToMany(Usuario::class, 'likes', 'fk_comentario', 'fk_autor');
    }
}
