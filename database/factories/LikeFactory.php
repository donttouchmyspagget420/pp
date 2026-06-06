<?php

namespace Database\Factories;

use App\Models\Comentario;
use App\Models\Like;
use App\Models\Publicacion;
use App\Models\Usuario;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Like>
 */
class LikeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'fk_autor' => Usuario::factory(),
            'fk_publicacion' => null,
            'fk_comentario' => null
        ];
    }


    public function publicacion(): static
    {
        return $this->state(fn() => [
            'fk_publicacion' => Publicacion::factory()
        ]);
    }


    public function comentario(): static
    {
        return $this->state(fn() => [
            'fk_comentario' => Comentario::factory()
        ]);
    }
}
