<?php

namespace Database\Factories;

use App\Models\Usuario;
use App\Enums\Roles;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends Factory<Usuario>
 */
class UsuarioFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'fk_rol' => fake()->randomElement(Roles::cases()),
            'pfp' => 'default.png',
            'nombre' => fake()->name(),
            'username' => fake()->unique()->userName(),
            'correo' => fake()->unique()->safeEmail(),
            'ubicacion' => fake()->country() . '|' . fake()->city(),
            'educacion' => 'Universidad Nacional del ' . fake()->word(),
            'siguidores' => rand(0, 1000),
            'siguiendo' => rand(0, 1000),
            'tele' => fake()->unique()->phoneNumber(),
            'password' => static::$password ??= Hash::make('password'),
        ];
    }
}
