<?php

namespace Database\Seeders;

use App\Models\Configuracion;
use App\Enums\ColorAccente;
use Illuminate\Database\Seeder;

class ConfiguracionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Configuracion::create([
            'colorAccentoUsuario' => ColorAccente::AQUA,
            'colorAccentoEditor' => ColorAccente::VERDE,
            'colorAccentoAdmin' => ColorAccente::AZUL,
            'pfpPorDefectoUsuario' => 'default.png',
            'pfpPorDefectoEditor' => 'default-editor.png',
            'pfpPorDefectoAdmin' => 'default-admin.png',
            'removerComentariosEditores' => true,
            'modificarComentariosUsuarios' => false,
            'limiteDePublicaciones' => 1000,
            'limiteDeComentarios' => 1000
        ]);
    }
}
