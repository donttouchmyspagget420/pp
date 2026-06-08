<?php

namespace Database\Factories;

use App\Models\ConfigUsuario;
use App\Enums\ColorAccente;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ConfigUsuario>
 */
class ConfigUsuarioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'color' => fake()->randomElement(ColorAccente::cases()),
            'correoPublico' => fake()->boolean(),
            'ubicacionPublico' => fake()->boolean(),
            'educacionPublico' => fake()->boolean(),
            'telePublico' => fake()->boolean()
        ];
    }
}
