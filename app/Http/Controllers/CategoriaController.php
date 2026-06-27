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
        $request->validate([
            'categoria' => 'nullable|exists:categorias,id',
            'etiqueta' => 'nullable|array|min:1',
            'etiqueta.*' => 'exists:etiquetas,id'
        ], [
            'categoria.exists' => 'La categoría seleccionada no es válida.',
            'etiqueta.*.exists' => 'La etiqueta seleccionada no es válida.',
            'etiqueta.array' => 'El campo etiqueta debe ser un arreglo válido.',
            'etiqueta.min'   => 'Debes proporcionar al menos un elemento en etiqueta.',
        ]);

        $idCat = $request->categoria;
        $arrEt = $request->etiqueta;

        $categorias = Categoria::all();
        $etiquetas = Etiqueta::all();

        $publicaciones = Publicacion::query();

        if ($idCat != null) {
            $publicaciones = $publicaciones->where('fk_categoria', $idCat);
        }

        if ($arrEt != null) {
            $publicaciones = $publicaciones->whereHas('etiquetas', function (Builder $query) use ($arrEt) {
                $query->whereIn('fk_etiqueta', $arrEt);
            });
        }

        $publicaciones = $publicaciones->with('autor:nombre,id', 'categorias:nombre,id', 'etiquetas')->withCount('likes', 'guardadas', 'comentario')->orderByDesc('likes_count')->paginate(18)->withQueryString();

        return view('categorias.show', compact('categorias', 'etiquetas', 'publicaciones'));
    }

    public function editCategoria(Request $request): RedirectResponse
    {
        $data = $this->validate($request, 'categorias', true);

        $cat = Categoria::findOrFail($data['id']);

        $cat->update($data);

        return back()->with('session', 'cambiado exitosamente');
    }

    public function editEtiqueta(Request $request): RedirectResponse
    {
        $data = $this->validate($request, 'etiquetas', true);

        $et = Etiqueta::findOrFail($data['id']);

        $et->update($data);

        return back()->with('session', 'cambiado exitosamente');
    }

    public function storeCategoria(Request $request): RedirectResponse
    {
        $data = $this->validate($request, 'categorias', false);

        Categoria::create($data);

        return back()->with('session', 'creado exitosamente');
    }

    public function storeEtiqueta(Request $request): RedirectResponse
    {
        $data = $this->validate($request, 'etiquetas', false);

        Etiqueta::create($data);

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
        $et = Etiqueta::findOrFail($id);

        $et->delete();

        return back()->with('session', 'eliminado exitosamente');
    }

    private function validate(Request $request, string $table, bool $required)
    {
        $rules = [
            'nombre' => 'required|string|max:20|unique:' . $table . ',nombre'
        ];

        $msgs = [
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.string'   => 'El nombre debe ser un texto válido.',
            'nombre.max'      => 'El nombre no puede tener más de 20 caracteres.',
            'nombre.unique'   => 'El nombre ya existe.',
        ];

        if ($required) {
            $rules['id'] = 'required|exists:' . $table . ',id';
            $msgs['id.required'] = 'El identificador es obligatorio.';
            $msgs['id.exists'] = 'El identificador no existe.';
        }

        $data = $request->validate($rules, $msgs);

        return $data;
    }
}
