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
        Schema::create('guardadas', function (Blueprint $table) {
            $table->foreignId('fk_autor')->constrained('usuarios', 'id')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('fk_publicacion')->constrained('publicaciones', 'id')->onUpdate('cascade')->onDelete('cascade');
            $table->unique(['fk_autor', 'fk_publicacion']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guardadas');
    }
};
