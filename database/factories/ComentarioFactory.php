<?php

namespace Database\Factories;

use App\Models\Comentario;
use App\Models\Usuario;
use App\Models\Publicacion;
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
            'contenido' => fake()->sentences(),
            'fk_autor' => Usuario::factory(),
            'fk_publicacion' => Publicacion::factory(),
            'fk_comentario' => null,
            'likes' => rand(),
            'respuestas' => rand()
        ];
    }

    public function respuesta(): static
    {
        return $this->state(fn() => [
            'fk_comentario' => Comentario::factory()
        ]);
    }
}
