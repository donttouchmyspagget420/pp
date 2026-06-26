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
            $table->string('descripcion');
            $table->foreignId('fk_autor')->constrained('usuarios', 'id')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('fk_categoria')->constrained('categorias', 'id')->onUpdate('cascade')->onDelete('cascade');
            $table->date('fecha')->useCurrent();
        });

        Schema::create('guardadas', function (Blueprint $table) {
            $table->foreignId('fk_autor')->constrained('usuarios', 'id')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('fk_publicacion')->constrained('publicaciones', 'id')->onUpdate('cascade')->onDelete('cascade');
            $table->unique(['fk_autor', 'fk_publicacion']);
        });

        Schema::create('etiquetas_publicaciones', function (Blueprint $table) {
            $table->foreignId('fk_publicacion')->constrained('publicaciones', 'id')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('fk_etiqueta')->constrained('etiquetas', 'id')->onUpdate('cascade')->onDelete('cascade');
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
