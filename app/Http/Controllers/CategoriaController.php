<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Etiqueta;
use App\Models\Publicacion;
use Illuminate\View\View;
use Illuminate\Http\Request;

use Illuminate\Database\Eloquent\Builder;

class CategoriaController extends Controller
{
    public function show(Request $request): View
    {
        $idCat = $request->input('categoria');
        $idEt = $request->input('etiqueta');

        $pubNum = 18;

        $categorias = Categoria::all();
        $etiquetas = Etiqueta::all();

        $publicaciones = Publicacion::query();

        if ($idCat != null) {
            $publicaciones = $publicaciones->where('fk_categoria', $idCat);
        }

        if ($idEt != null) {
            $publicaciones = $publicaciones->whereHas('etiquetas', function (Builder $query) use ($idEt) {
                $query->where('fk_etiqueta', $idEt);
            });
        }

        $publicaciones = $publicaciones->with('autor:nombre,id', 'categorias:nombre,id', 'etiquetas')->withCount('likes', 'guardadas', 'comentario')->orderByDesc('likes_count')->paginate($pubNum);

        return view('categorias.show', compact('categorias', 'etiquetas', 'publicaciones'));
    }
}
