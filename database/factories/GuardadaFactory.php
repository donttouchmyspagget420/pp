<?php

namespace Database\Factories;

use App\Models\Guardada;
use App\Models\Publicacion;
use App\Models\Usuario;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Guardada>
 */
class GuardadaFactory extends Factory
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
            'fk_publicacion' => Publicacion::factory()
        ];
    }
}
