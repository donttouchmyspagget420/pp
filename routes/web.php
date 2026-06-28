<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PublicacionController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ComentarioController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UsuarioController;

Route::any('/', [PublicacionController::class, 'index'])->name('home');

Route::get('/publicacion/show/{id}', [PublicacionController::class, 'show'])->name('publicacion.show')->whereNumber('id');

Route::get('/categorias/show', [CategoriaController::class, 'show'])->name('categorias.show');

Route::get('/auth/register', [AuthController::class, 'showRegister'])->name('auth.register');

Route::get('/auth/login', [AuthController::class, 'showLogin'])->name('auth.login');

Route::post('/auth/register', [AuthController::class, 'register'])->name('register');

Route::post('/auth/login', [AuthController::class, 'login'])->name('login');

Route::get('/perfil/show/{id}', [UsuarioController::class, 'show'])->name('perfil.show')->whereNumber('id');

Route::middleware(['auth'])->group(function () {
    Route::get('/perfil/edit/{id}', [UsuarioController::class, 'showEdit'])->name('perfil.edit')->whereNumber('id');

    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/usuario/remover', [AuthController::class, 'remover'])->name('usuario.remove');

    Route::get('/dashboard/like/{id}', [DashboardController::class, 'like'])->name('dashboard.like')->whereNumber('id');

    Route::get('/dashboard/comentarios/{id}', [DashboardController::class, 'comentarios'])->name('dashboard.comentarios')->whereNumber('id');

    Route::get('/dashboard/destacados/{id}', [DashboardController::class, 'destacados'])->name('dashboard.destacados')->whereNumber('id');

    Route::post('/perfil/edit', [UsuarioController::class, 'editOrStore']);

    Route::post('/comentario/store', [ComentarioController::class, 'store']);

    Route::post('/comentario/edit', [ComentarioController::class, 'edit']);

    Route::get('/comentario/destroy/{id}', [ComentarioController::class, 'destroy'])->name('comentario.destroy')->whereNumber('id');

    Route::get('/usuario/{idUsuario}/like/publicacion/{idPublicacion}', [PublicacionController::class, 'like'])->name('publicacion.like')->whereNumber('idUsuario')->whereNumber('idPublicacion');

    Route::get('/usuario/{idUsuario}/guardar/bookmark/{idPublicacion}', [PublicacionController::class, 'bookmark'])->name('publicacion.bookmark')->whereNumber('idUsuario')->whereNumber('idPublicacion');

    Route::get('/usuario/{idUsuario}/like/comentario/{idComentario}', [ComentarioController::class, 'like'])->name('comentario.like')->whereNumber('idUsuario')->whereNumber('idComentario');
});

Route::middleware(['auth', 'rol:admin,editor'])->group(function () {
    Route::get('/dashboard/misblogs/{id}', [DashboardController::class, 'misblogs'])->name('dashboard.misblogs')->whereNumber('id');

    Route::get('/publicacion/store', [PublicacionController::class, 'showStore'])->name('publicacion.store');

    Route::post('/publicacion/store', [PublicacionController::class, 'store']);

    Route::get('/publicacion/edit/{id}', [PublicacionController::class, 'showEdit'])->name('publicacion.edit')->whereNumber('id');

    Route::post('/publicacion/edit', [PublicacionController::class, 'edit']);

    Route::get('/publicacion/destroy/{id}', [PublicacionController::class, 'destroy'])->name('publicacion.destroy')->whereNumber('id');

    Route::get('/categoria/destroy/{id}', [CategoriaController::class, 'destroyCategoria'])->name('categoria.destroy')->whereNumber('id');

    Route::get('/etiqueta/destroy/{id}', [CategoriaController::class, 'destroyEtiqueta'])->name('etiqueta.destroy')->whereNumber('id');

    Route::get('/categorias/index', [CategoriaController::class, 'index'])->name('categorias.index');

    Route::post('/categoria/edit', [CategoriaController::class, 'editCategoria']);

    Route::post('/etiqueta/edit', [CategoriaController::class, 'editEtiqueta']);

    Route::post('/categoria/store', [CategoriaController::class, 'storeCategoria']);

    Route::post('/etiqueta/store', [CategoriaController::class, 'storeEtiqueta']);
});

Route::middleware(['auth', 'rol:admin'])->group(function () {
    Route::get('/dashboard/blogs/{id}', [DashboardController::class, 'blogs'])->name('dashboard.blogs')->whereNumber('id');

    Route::get('/admin/reportes', [AdminController::class, 'reportes'])->name('admin.reportes');

    Route::get('/admin/configuracion', [AdminController::class, 'configuracion'])->name('admin.configuracion');

    Route::get('/admin/usuarios', [AdminController::class, 'usuarios'])->name('admin.usuarios');

    Route::get('/admin/editores', [AdminController::class, 'editores'])->name('admin.editores');

    Route::get('/perfil/destroy/{id}', [UsuarioController::class, 'destroy'])->name('perfil.destroy')->whereNumber('id');

    Route::get('/perfil/store', [UsuarioController::class, 'showStore'])->name('perfil.store');

    Route::post('/admin/configuracion', [AdminController::class, 'editConfiguracion']);

    Route::post('/perfil/store', [UsuarioController::class, 'editOrStore']);
});
