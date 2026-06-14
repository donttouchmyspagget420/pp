<?php

namespace Database\Factories;

use App\Models\PerfilUsuario;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<PerfilUsuario>
 */
class PerfilUsuarioFactory extends Factory
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
            'pfp' => fake()->randomElement(['default.png', 'https://picsum.photos/640/480?random=' . fake()->numberBetween(1, 10000)]),
            'ubicacion' => fake()->country() . '|' . fake()->city(),
            'educacion' => 'Universidad Nacional del ' . fake()->word(),
            'tele' => fake()->unique()->phoneNumber(),
            'sobre' => fake()->catchPhrase()
        ];
    }
}
