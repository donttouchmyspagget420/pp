<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Publicacion extends Model
{
    use HasFactory;

    protected $table = 'publicaciones';

    protected $fillable = ['imagen', 'titulo', 'contenido', 'fk_autor', 'fecha', 'destacados'];

    public $timestamps = false;


    public function autor(): BelongsTo
    {
        return $this->belongsTo(Usuario::class, 'fk_autor');
    }

    public function etiquetas(): BelongsToMany
    {
        return $this->belongsToMany(Etiqueta::class, 'etiquetas_publicaciones', 'fk_publicacion', 'fk_etiqueta');
    }

    public function likes(): BelongsToMany
    {
        return $this->belongsToMany(Usuario::class, 'likes', 'fk_publicacion', 'fk_autor');
    }

    public function guardadas(): BelongsToMany
    {
        return $this->belongsToMany(Usuario::class, 'guardadas', 'fk_publicacion', 'fk_autor');
    }

    public function categorias(): BelongsToMany
    {
        return $this->belongsToMany(Categoria::class, 'categorias_publicaciones', 'fk_publicacion', 'fk_categoria');
    }
}
