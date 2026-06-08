<?php

namespace Database\Seeders;

use App\Models\Comentario;
use App\Models\Publicacion;
use App\Models\Usuario;
use Illuminate\Database\Seeder;

class ComentarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $publicaciones = Publicacion::all();
        $usuarios = Usuario::all();
        $comentarios = [];


        foreach ($publicaciones as $pub) {
            array_push($comentarios, Comentario::factory()->hasAttached($usuarios->random(), [], 'likes')->for($usuarios->random())->for($pub)->create());
        }

        foreach ($publicaciones as $pub) {
            Comentario::factory()->hasAttached($usuarios->random(), [], 'likes')->for($usuarios->random())->for($pub)->for($comentarios[array_rand($comentarios)])->create();
        }
    }
}
