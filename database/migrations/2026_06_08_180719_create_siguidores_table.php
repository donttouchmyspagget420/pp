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
        Schema::create('siguidores', function (Blueprint $table) {
            $table->foreignId('fk_siguidor')->constrained('usuarios', 'id')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('fk_siguido')->constrained('usuarios', 'id')->onUpdate('cascade')->onDelete('cascade');
            $table->unique(['fk_siguidor', 'fk_siguido']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siguidores');
    }
};
