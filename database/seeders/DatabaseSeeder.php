<?php

namespace Database\Seeders;

use App\Models\Categoria;
use App\Models\Configuracion;
use App\Models\Etiqueta;
use App\Models\Usuario;
use App\Models\Rol;
use App\Enums\ColorAccente;
use App\Models\Comentario;
use App\Models\ConfigUsuario;
use App\Models\EtiquetaPublicacion;
use App\Models\Guardada;
use App\Models\Like;
use App\Models\Publicacion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Configuracion::create([
            'colorAccentoUsuario' => ColorAccente::AQUA,
            'colorAccentoEditor' => ColorAccente::VERDE,
            'colorAccentoAdmin' => ColorAccente::AZUL,
            'pfpPorDefectoUsuario' => 'default.png',
            'pfpPorDefectoEditor' => 'default-editor.png',
            'pfpPorDefectoAdmin' => 'default-admin.png',
            'removerComentariosEditores' => true,
            'modificarComentariosUsuarios' => false,
            'limiteDePublicaciones' => 1000,
            'limiteDeComentarios' => 1000
        ]);

        Categoria::factory()->count(10)->create();

        $etiqueta = Etiqueta::factory()->count(10)->create();

        $admin = Rol::create(['nombre' => 'admin']);
        $editor = Rol::create(['nombre' => 'editor']);
        $user = Rol::create(['nombre' => 'user']);


        Usuario::factory()->has(ConfigUsuario::factory())->for($admin)->count(1)->create();

        $editors = Usuario::factory()->has(ConfigUsuario::factory())->for($editor)->count(5)->create();
        $usuarios = Usuario::factory()->has(ConfigUsuario::factory())->for($user)->count(20)->create();

        $publicaciones = [];
        $comentarios = [];

        for ($i = 0; $i < 5; $i++) {
            array_push($publicaciones, Publicacion::factory()->for($editors->random())->create());
        }

        for ($i = 0; $i < 5; $i++) {
            array_push($comentarios, Comentario::factory()->for($usuarios->random())->for($publicaciones[0])->create());
        }

        foreach ($publicaciones as $pub) {
            $ran = $usuarios->random();
            array_push($comentarios, Like::factory()->publicacion()->recycle([$ran, $pub])->create());
        }

        foreach ($comentarios as $com) {
            $ran = $usuarios->random();
            array_push($comentarios, Like::factory()->comentario()->recycle([$ran, $com])->create());
        }

        foreach ($publicaciones as $pub) {
            $ran = $usuarios->random();
            array_push($comentarios, Guardada::factory()->recycle([$ran, $pub])->create());
        }

        foreach ($publicaciones as $pub) {
            $ran = $etiqueta->random();
            array_push($comentarios, EtiquetaPublicacion::factory()->recycle([$ran, $pub])->create());
        }
    }
}
