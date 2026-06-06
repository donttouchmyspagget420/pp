<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\ColorAccente;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('config_usuarios', function (Blueprint $table) {
            $table->foreignId('fk_usuario')->unique()->constrained('usuarios', 'id')->onUpdate('cascade')->onDelete('cascade');
            $table->enum('color', ColorAccente::cases());
            $table->boolean('correoPublico')->default(false);
            $table->boolean('ubicacionPublico')->default(false);
            $table->boolean('educacionPublico')->default(false);
            $table->boolean('telePublico')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('config_usuarios');
    }
};
