<?php

namespace Database\Seeders;

use App\Enums\Roles;
use App\Models\Categoria;
use App\Models\Etiqueta;
use App\Models\Publicacion;
use App\Models\Rol;
use App\Models\Usuario;
use Illuminate\Database\Seeder;

class PublicacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categorias = Categoria::all();
        $usuarios = Usuario::all();
        $etiquetas = Etiqueta::all();
        $edit = Rol::where('nombre', Roles::Editor)->first();
        $editors = Usuario::where('fk_rol', $edit->id)->get();

        for ($i = 0; $i < 100; $i++) {
            Publicacion::factory()->hasAttached($usuarios->random(rand(0, $usuarios->count())), [], 'likes')->hasAttached($usuarios->random(rand(0, $usuarios->count())), [], 'guardadas')->hasAttached($etiquetas->random(rand(0, $etiquetas->count())), [], 'etiquetas')->for($categorias->random(), 'categorias')->for($editors->random(), 'autor')->create();
        }
    }
}
