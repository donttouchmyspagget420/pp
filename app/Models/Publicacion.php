<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Publicacion extends Model
{
    use HasFactory;

    protected $table = 'publicaciones';

    protected $fillable = ['imagen', 'titulo', 'contenido', 'fk_autor', 'fecha', 'destacados', 'fk_categoria', 'descripcion'];

    public $timestamps = false;


    public function autor(): BelongsTo
    {
        return $this->belongsTo(Usuario::class, 'fk_autor');
    }

    public function categorias(): BelongsTo
    {
        return $this->belongsTo(Categoria::class, 'fk_categoria');
    }

    public function comentario(): HasMany
    {
        return $this->hasMany(Comentario::class, 'fk_publicacion');
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


    public function getImagen()
    {
        if (filter_var($this->imagen, FILTER_VALIDATE_URL)) {
            return $this->imagen;
        }

        return asset('storage/publicaciones/' . $this->imagen);
    }
}
