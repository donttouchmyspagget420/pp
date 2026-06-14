<?php

namespace Database\Factories;

use App\Models\Publicacion;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Publicacion>
 */
class PublicacionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    /**
     * image y imageUrl formatter no trabaja: https://fakerphp.org/formatters/image/
     */
    public function definition(): array
    {
        return [
            'imagen' => 'https://picsum.photos/1035/680?random=' . fake()->numberBetween(1, 10000),
            'titulo' => fake()->sentence(rand(1, 3), true),
            'contenido' => implode("\n\n", fake()->paragraphs(6)),
            'descripcion' => fake()->paragraph(),
            'fecha' => now(),
        ];
    }
}
