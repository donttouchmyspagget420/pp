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
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fk_rol')->constrained('roles', 'id')->onUpdate('cascade')->onDelete('cascade');
            $table->string('pfp')->nullable();
            $table->string('nombre', 100);
            $table->string('username', 100)->unique();
            $table->string('correo')->unique();
            $table->string('ubicacion')->nullable();
            $table->string('educacion')->nullable();
            $table->string('tele', 20)->unique();
            $table->string('password');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
