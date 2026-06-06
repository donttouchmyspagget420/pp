<?php

namespace Database\Factories;

use App\Models\EtiquetaPublicacion;
use App\Models\Etiqueta;
use App\Models\Publicacion;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<EtiquetaPublicacion>
 */
class EtiquetaPublicacionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'fk_publicacion' => Publicacion::factory(),
            'fk_etiqueta' => Etiqueta::factory()
        ];
    }
}
