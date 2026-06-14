<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PublicacionController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\UsuarioController;

Route::any('/', [PublicacionController::class, 'index'])->name('home');

Route::get('/publicacion/{id}', [PublicacionController::class, 'show'])->name('publicacion.show')->whereNumber('id');

Route::get('/categorias/{idCat?}/{idEt?}', [CategoriaController::class, 'show'])->name('categorias.show')->whereNumber('idCat')->whereNumber('idEt');

Route::get('/register', [AuthController::class, 'showRegister'])->name('auth.register');

Route::get('/login', [AuthController::class, 'showLogin'])->name('auth.login');

Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::get('/perfil/{id}', [UsuarioController::class, 'show'])->name('perfil.show')->whereNumber('id');

Route::middleware(['auth'])->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/usuario/remover', [AuthController::class, 'remover'])->name('usuario.remove');
});
