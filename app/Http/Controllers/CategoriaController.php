<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Etiqueta;
use App\Models\Publicacion;
use App\Models\Usuario;
use Illuminate\View\View;
use Illuminate\Http\Request;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\RedirectResponse;

class CategoriaController extends Controller
{
    public function index(): View
    {
        $categorias = Categoria::all();
        $etiquetas = Etiqueta::all();

        return view('categorias.index', compact('categorias', 'etiquetas'));
    }

    public function show(Request $request): View
    {
        $idCat = $request->categoria;
        $idEt = $request->etiqueta;

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

        $publicaciones = $publicaciones->with('autor:nombre,id', 'categorias:nombre,id', 'etiquetas')->withCount('likes', 'guardadas', 'comentario')->orderByDesc('likes_count')->paginate(18);

        return view('categorias.show', compact('categorias', 'etiquetas', 'publicaciones'));
    }

    public function editCategoria(Request $request): RedirectResponse
    {
        $data = $this->validate($request, 'categorias', true);

        $cat = Categoria::findOrFail($data['id']);

        $cat->update($data['nombre']);

        return back()->with('session', 'cambiado exitosamente');
    }

    public function editEtiqueta(Request $request): RedirectResponse
    {
        $data = $this->validate($request, 'etiquetas', true);

        $et = Categoria::findOrFail($data['id']);

        $et->update($data['nombre']);

        return back()->with('session', 'cambiado exitosamente');
    }

    public function storeCategoria(Request $request): RedirectResponse
    {
        $data = $this->validate($request, 'categorias', false);

        Categoria::create($data['nombre']);

        return back()->with('session', 'creado exitosamente');
    }

    public function storeEtiqueta(Request $request): RedirectResponse
    {
        $data = $this->validate($request, 'etiquetas', false);

        Etiqueta::create($data['nombre']);

        return back()->with('session', 'creado exitosamente');
    }

    public function destroyCategoria(int $id): RedirectResponse
    {
        $cat = Categoria::findOrFail($id);

        $cat->delete();

        return back()->with('session', 'eliminado exitosamente');
    }

    public function destroyEtiqueta(int $id): RedirectResponse
    {
        $et = Categoria::findOrFail($id);

        $et->delete();

        return back()->with('session', 'eliminado exitosamente');
    }

    private function validate(Request $request, string $table, bool $required)
    {
        $data = $request->validate([
            'id' => ($required) ? 'required' : 'nullable' . '|exists:' . $table . ',id',
            'nombre' => 'required|string|max:20|unique:' . $table . ',nombre'
        ], [
            'id.required'     => 'El identificador es obligatorio.',
            'id.exists'     => 'El identificador no existe.',
            'nombre.required' => 'El contenido es obligatorio.',
            'nombre.string'   => 'El contenido debe ser un texto válido.',
            'nombre.max'      => 'El contenido no puede tener más de 20 caracteres.',
            'nombre.unique'   => 'El contenido ya existe.',
        ]);

        return $data;
    }
}
