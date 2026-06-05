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
        Schema::create('configuraciones', function (Blueprint $table) {
            $table->id();
            $table->enum('colorAccentoUsuario', ['aqua', 'rojo', 'blanco', 'negro', 'verde']);
            $table->enum('colorAccentoEditor', ['aqua', 'rojo', 'blanco', 'negro', 'verde']);
            $table->enum('colorAccentoAdmin', ['aqua', 'rojo', 'blanco', 'negro', 'verde']);
            $table->string('pfpPorDefectoUsuario');
            $table->string('pfpPorDefectoEditor');
            $table->string('pfpPorDefectoAdmin');
            $table->boolean('removerComentariosEditores');
            $table->boolean('modificarComentariosUsuarios');
            $table->bigInteger('limiteDePublicaciones');
            $table->bigInteger('limiteDeComentarios');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('configuraciones');
    }
};
