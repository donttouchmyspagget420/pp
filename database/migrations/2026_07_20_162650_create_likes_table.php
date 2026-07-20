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
        Schema::create('likes', function (Blueprint $table) {
            $table->foreignId('fk_autor')->constrained('usuarios', 'id')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('fk_publicacion')->nullable()->constrained('publicaciones', 'id')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('fk_comentario')->nullable()->constrained('comentarios', 'id')->cascadeOnUpdate()->cascadeOnDelete();
            $table->unique(['fk_autor', 'fk_publicacion']);
            $table->unique(['fk_autor', 'fk_comentario']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('likes');
    }
};
