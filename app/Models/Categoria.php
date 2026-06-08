<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Categoria extends Model
{
    use HasFactory;

    protected $table = "categorias";

    protected $fillable = ['nombre'];

    public $timestamps = false;

    public function publicaciones(): BelongsToMany
    {
        return $this->belongsToMany(Publicacion::class, 'categorias_publicaciones', 'fk_categoria', 'fk_publicacion');
    }
}
