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
        Schema::create('comentarios', function (Blueprint $table) {
            $table->id();
            $table->text('contenido');
            $table->foreignId('fk_autor')->constrained('usuarios', 'id')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('fk_publicacion')->constrained('publicaciones', 'id')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('fk_comentario')->nullable()->constrained('comentarios', 'id')->onUpdate('cascade')->onDelete('cascade');
            $table->bigInteger('likes')->default(0);
            $table->bigInteger('respuestas')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comentarios');
    }
};
