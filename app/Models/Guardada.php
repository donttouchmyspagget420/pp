<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guardada extends Model
{
    use HasFactory;

    protected $table = 'guardadas';

    protected $fillable = ['fk_autor', 'fk_publicacion'];

    public $timestamps = false;
}
