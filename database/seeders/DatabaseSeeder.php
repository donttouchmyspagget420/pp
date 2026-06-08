<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            ConfiguracionSeeder::class,
            CategoriaSeeder::class,
            EtiquetaSeeder::class,
            RolSeeder::class,
            UsuarioSeeder::class,
            PublicacionSeeder::class,
            ComentarioSeeder::class
        ]);
    }
}
