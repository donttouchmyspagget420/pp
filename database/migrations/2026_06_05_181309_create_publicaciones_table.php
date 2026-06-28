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
        Schema::create('publicaciones', function (Blueprint $table) {
            $table->id();
            $table->string('imagen');
            $table->string('titulo');
            $table->text('contenido');
            $table->string('descripcion', 500);
            $table->foreignId('fk_autor')->nullable()->constrained('usuarios', 'id')->cascadeOnUpdate()->nullOnDelete();
            $table->foreignId('fk_categoria')->nullable()->constrained('categorias', 'id')->cascadeOnUpdate()->nullOnDelete();
            $table->date('fecha')->useCurrent();
        });

        Schema::create('guardadas', function (Blueprint $table) {
            $table->foreignId('fk_autor')->nullable()->constrained('usuarios', 'id')->cascadeOnUpdate()->nullOnDelete();
            $table->foreignId('fk_publicacion')->nullable()->constrained('publicaciones', 'id')->cascadeOnUpdate()->nullOnDelete();
            $table->unique(['fk_autor', 'fk_publicacion']);
        });

        Schema::create('etiquetas_publicaciones', function (Blueprint $table) {
            $table->foreignId('fk_publicacion')->nullable()->constrained('publicaciones', 'id')->cascadeOnUpdate()->nullOnDelete();
            $table->foreignId('fk_etiqueta')->nullable()->constrained('etiquetas', 'id')->cascadeOnUpdate()->nullOnDelete();
            $table->unique(['fk_publicacion', 'fk_etiqueta']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('publicaciones');
    }
};
