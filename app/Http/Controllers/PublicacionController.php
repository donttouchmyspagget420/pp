<?php

namespace App\Http\Controllers;

use App\Models\Publicacion;
use Illuminate\View\View;

class PublicacionController extends Controller
{
    public function index(): View
    {
        $tops = Publicacion::with('autor:nombre,id', 'categorias:nombre,id', 'etiquetas')->withCount('likes', 'guardadas', 'comentario')->orderByDesc('likes_count')->limit(5)->get();
        $recientes = Publicacion::with('autor:nombre,id', 'categorias:nombre,id', 'etiquetas')->withCount('likes', 'guardadas', 'comentario')->orderByDesc('fecha')->limit(9)->get();

        return view('index', compact('tops'), compact('recientes'));
    }

    public function show(): View
    {
        //todo
        return view('publicacion.show');
    }
}
