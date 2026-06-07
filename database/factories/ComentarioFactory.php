<?php

namespace Database\Factories;

use App\Models\Comentario;
use App\Models\Publicacion;
use App\Models\Usuario;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Comentario>
 */
class ComentarioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'contenido' => fake()->paragraph(),
            'fk_autor' => Usuario::factory(),
            'fk_publicacion' => Publicacion::factory(),
            'fk_comentario' => Comentario::factory(),
            'likes' => rand(0, 1000),
            'respuestas' => rand(0, 1000)
        ];
    }
}
