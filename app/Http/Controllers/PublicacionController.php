<?php

namespace App\Http\Controllers;

use App\Models\Comentario;
use App\Models\Publicacion;
use Illuminate\View\View;

class PublicacionController extends Controller
{
    public function index(): View
    {
        $tops = Publicacion::with('autor:nombre,id', 'categorias:nombre,id', 'etiquetas')->withCount('likes', 'guardadas', 'comentario')->orderByDesc('likes_count')->limit(5)->get();
        $recientes = Publicacion::with('autor:nombre,id', 'categorias:nombre,id', 'etiquetas')->withCount('likes', 'guardadas', 'comentario')->orderByDesc('fecha')->limit(9)->get();

        return view('index', compact('tops', 'recientes'));
    }

    public function show(int $id): View
    {
        $pub = Publicacion::with('autor:nombre,id', 'categorias:nombre,id', 'etiquetas')->withCount('likes', 'guardadas')->findOrFail($id);
        $coms = Comentario::with('usuario')->withCount('likes')->where('fk_publicacion', $pub->id)->paginate(10);

        return view('publicacion.show', compact('pub', 'coms'));
    }
}
