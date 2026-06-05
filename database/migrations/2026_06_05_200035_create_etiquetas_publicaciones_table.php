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
        Schema::dropIfExists('etiquetas_publicaciones');
    }
};
