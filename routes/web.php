<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PublicacionController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UsuarioController;

Route::any('/', [PublicacionController::class, 'index'])->name('home');

Route::get('/publicacion/{id}', [PublicacionController::class, 'show'])->name('publicacion.show')->whereNumber('id');

Route::get('/categorias', [CategoriaController::class, 'show'])->name('categorias.show');

Route::get('/auth/register', [AuthController::class, 'showRegister'])->name('auth.register');

Route::get('/auth/login', [AuthController::class, 'showLogin'])->name('auth.login');

Route::post('/auth/register', [AuthController::class, 'register'])->name('register');

Route::post('/auth/login', [AuthController::class, 'login'])->name('login');

Route::get('/perfil/{id}', [UsuarioController::class, 'show'])->name('perfil.show')->whereNumber('id');

Route::middleware(['auth'])->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/usuario/remover', [AuthController::class, 'remover'])->name('usuario.remove');

    Route::get('/dashboard/like', [DashboardController::class, 'like'])->name('dashboard.like');

    Route::get('/dashboard/comentarios', [DashboardController::class, 'comentarios'])->name('dashboard.comentarios');

    Route::get('/dashboard/destacados', [DashboardController::class, 'destacados'])->name('dashboard.destacados');
});

Route::middleware(['auth', 'rol:admin,editor'])->group(function () {
    Route::get('/dashboard/misblogs', [DashboardController::class, 'misblogs'])->name('dashboard.misblogs');

    Route::get('/dashboard/blogs', [DashboardController::class, 'blogs'])->name('dashboard.blogs');
});

Route::middleware(['auth', 'rol:admin'])->group(function () {
    Route::get('/admin/reportes', [AdminController::class, 'reportes'])->name('admin.reportes');

    Route::get('/admin/configuracion', [AdminController::class, 'configuracion'])->name('admin.configuracion');

    Route::get('/admin/usuarios', [AdminController::class, 'usuarios'])->name('admin.usuarios');

    Route::get('/admin/editores', [AdminController::class, 'editores'])->name('admin.editores');

    Route::post('/admin/configuracion', [AdminController::class, 'editConfiguracion']);
});
