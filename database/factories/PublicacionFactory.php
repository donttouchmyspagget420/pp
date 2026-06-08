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
    public function definition(): array
    {
        return [
            'imagen' => fake()->image(storage_path('app/public/publicaciones/'), 1035, 690),
            'titulo' => fake()->sentence(),
            'contenido' => fake()->paragraph(),
            'fecha' => now(),
        ];
    }
}
