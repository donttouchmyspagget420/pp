<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConfigUsuario extends Model
{
    use HasFactory;

    protected $table = 'config_usuarios';

    protected $fillable = ['fk_usuario', 'color', 'correoPublico', 'ubicacionPublico', 'educacionPublico', 'telePublico'];

    public $timestamps = false;
}
