<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PublicacionController;

Route::get('/', [PublicacionController::class, 'index']);
