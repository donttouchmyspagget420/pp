<?php

namespace Database\Seeders;

use App\Models\Usuario;
use App\Models\ConfigUsuario;
use App\Models\Rol;
use App\Enums\Roles;
use App\Models\PerfilUsuario;
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

        Usuario::factory()->has(ConfigUsuario::factory())->has(PerfilUsuario::factory())->for($admin)->count(1)->create();
        Usuario::factory()->has(ConfigUsuario::factory())->has(PerfilUsuario::factory())->for($editor)->count(5)->create();

        $usuarios = Usuario::factory()->has(ConfigUsuario::factory())->has(PerfilUsuario::factory())->for($user);

        $usuarios->hasAttached($usuarios, [], 'siguidores')->count(100)->create();
    }
}
