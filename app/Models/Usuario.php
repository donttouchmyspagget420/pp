<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Usuario extends Model
{
    use HasFactory;

    protected $table = 'usuarios';

    protected $fillable = ['fk_rol', 'pfp', 'nombre', 'username', 'correo', 'ubicacion', 'educacion', 'siguidores', 'siguiendo', 'tele', 'password'];

    protected $hidden = ['password'];

    public $timestamps = false;

    public function configUsuario(): HasOne
    {
        return $this->hasOne(ConfigUsuario::class, 'fk_usuario');
    }

    public function rol(): BelongsTo
    {
        return $this->belongsTo(Rol::class, 'fk_rol');
    }

    public function siguidores(): BelongsToMany
    {
        return $this->belongsToMany(Usuario::class, 'siguidores', 'fk_siguidor', 'fk_siguido');
    }

    public function likeComentario(): BelongsToMany
    {
        return $this->belongsToMany(Comentario::class, 'likes', 'fk_autor', 'fk_comentario');
    }

    public function likePublicacion(): BelongsToMany
    {
        return $this->belongsToMany(Publicacion::class, 'likes', 'fk_autor', 'fk_publicacion');
    }

    public function guardadasPublicacion(): BelongsToMany
    {
        return $this->belongsToMany(Publicacion::class, 'guardadas', 'fk_autor', 'fk_publicacion');
    }
}
