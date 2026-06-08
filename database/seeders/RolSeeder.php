<?php

namespace Database\Seeders;

use App\Models\Rol;
use App\Enums\Roles;
use Illuminate\Database\Seeder;

class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (Roles::cases() as $rol) {
            Rol::create(['nombre' => $rol]);
        }
    }
}
