<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Etiqueta extends Model
{
    use HasFactory;

    protected $table = 'etiquetas';

    protected $fillable = ['nombre'];

    public $timestamps = false;

    public function publicaciones(): BelongsToMany
    {
        return $this->belongsToMany(Publicacion::class, 'etiquetas_publicaciones', 'fk_etiqueta', 'fk_publicacion');
    }
}
