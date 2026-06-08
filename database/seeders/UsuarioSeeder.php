<?php

namespace Database\Seeders;

use App\Models\Usuario;
use App\Models\ConfigUsuario;
use App\Models\Rol;
use App\Enums\Roles;
use Illuminate\Database\Seeder;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = Rol::where('nombre', Roles::Admin)->first();
        $editor = Rol::where('nombre', Roles::Editor)->first();
        $user = Rol::where('nombre', Roles::Usuario)->first();

        Usuario::factory()->has(ConfigUsuario::factory())->for($admin)->count(1)->create();
        Usuario::factory()->has(ConfigUsuario::factory())->for($editor)->count(5)->create();
        Usuario::factory()->has(ConfigUsuario::factory())->hasAttached(Usuario::factory()->has(ConfigUsuario::factory())->count(5)->for($user), [], 'siguidores')->for($user)->count(5)->create();
    }
}
