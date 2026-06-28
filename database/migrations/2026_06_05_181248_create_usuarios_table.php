<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 20)->unique();
        });

        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fk_rol')->nullable()->constrained('roles', 'id')->cascadeOnUpdate()->nullOnDelete();
            $table->string('nombre', 100);
            $table->string('username', 100)->unique();
            $table->string('correo')->unique();
            $table->string('password');
            $table->string('remember_token', 100)->nullable();
        });

        Schema::create('siguidores', function (Blueprint $table) {
            $table->foreignId('fk_siguidor')->nullable()->constrained('usuarios', 'id')->cascadeOnUpdate()->nullOnDelete();
            $table->foreignId('fk_siguido')->nullable()->constrained('usuarios', 'id')->cascadeOnUpdate()->nullOnDelete();
            $table->unique(['fk_siguidor', 'fk_siguido']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roles');
        Schema::dropIfExists('usuarios');
        Schema::dropIfExists('siguidores');
    }
};
