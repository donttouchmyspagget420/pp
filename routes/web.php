<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PublicacionController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\UsuarioController;

Route::get('/', [PublicacionController::class, 'index']);

Route::get('/publicacion/{id}', [PublicacionController::class, 'show'])->name('publicacion.show');

Route::get('/categorias/{id}', [CategoriaController::class, 'show'])->name('categorias.show');

Route::get('/perfil/{id}', [UsuarioController::class, 'show'])->name('perfil.show');
