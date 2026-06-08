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
        Schema::create('categorias_publicaciones', function (Blueprint $table) {
            $table->foreignId('fk_categoria')->constrained('categorias', 'id')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('fk_publicacion')->constrained('publicaciones', 'id')->onUpdate('cascade')->onDelete('cascade');
            $table->unique(['fk_publicacion', 'fk_categoria']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categorias_publicaciones');
    }
};
