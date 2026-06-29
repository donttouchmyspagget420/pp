<?php

namespace App\Http\Controllers;

use App\Enums\Roles;
use App\Models\Categoria;
use App\Models\Comentario;
use App\Models\Configuracion;
use App\Models\Etiqueta;
use App\Models\Publicacion;
use App\Models\Rol;
use App\Models\Usuario;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PublicacionController extends Controller
{
    public function index(): View
    {
        $tops = Publicacion::with('autor:nombre,id', 'categorias:nombre,id')->withCount('likes', 'guardadas', 'comentario')->orderByDesc('likes_count')->limit(5)->get();
        $recientes = Publicacion::with('autor:nombre,id', 'categorias:nombre,id')->withCount('likes', 'guardadas', 'comentario')->orderByDesc('fecha')->limit(9)->get();

        return view('index', compact('tops', 'recientes'));
    }

    public function show(int $id): View
    {
        $pub = Publicacion::with('autor:nombre,id', 'categorias:nombre,id', 'etiquetas')->withCount('likes', 'guardadas')->findOrFail($id);
        $coms = Comentario::with('usuario')->withCount('likes')->where('fk_publicacion', $pub->id)->paginate(10);

        return view('publicacion.show', compact('pub', 'coms'));
    }

    public function showEdit(int $id): View
    {
        $rol = Rol::where('nombre', Roles::Usuario->value)->value('id');
        $pub = Publicacion::with('autor:nombre,id', 'categorias:nombre,id', 'etiquetas')->withCount('likes', 'guardadas')->findOrFail($id);
        $coms = Comentario::with('usuario')->withCount('likes')->where('fk_publicacion', $pub->id)->paginate(10);
        $cats = Categoria::all();
        $ets = Etiqueta::all();
        $usrs = Usuario::select('id', 'nombre')->whereNot('fk_rol', $rol)->get();

        return view('publicacion.edit', compact('pub', 'coms', 'cats', 'ets', 'usrs'));
    }

    public function showStore(): View
    {
        $cats = Categoria::all();
        $ets = Etiqueta::all();
        $rol = Rol::where('nombre', Roles::Usuario->value)->value('id');
        $usrs = Usuario::select('id', 'nombre')->whereNot('fk_rol', $rol)->get();

        return view('publicacion.store', compact('cats', 'ets', 'usrs'));
    }

    public function edit(Request $request): View
    {
        $request->validate(['id' => 'required|exists:publicaciones,id'], [
            'id.required' => 'El id es obligatoria.',
            'id.exists'   => 'El id seleccionada no es válida.',
        ]);

        $imagen = $this->validate($request);
        $pub = Publicacion::with('autor:nombre,id', 'categorias:nombre,id', 'etiquetas')->withCount('likes', 'guardadas')->findOrFail($request->id);
        $coms = Comentario::with('usuario')->withCount('likes')->where('fk_publicacion', $pub->id)->paginate(10);

        $pub->update([
            'imagen' => $imagen ?? $pub->imagen,
            'titulo' => $request->titulo,
            'contenido' => $request->contenido,
            'descripcion' => $request->descripcion,
            'fk_autor' => $request->autor,
            'fk_categoria' => $request->categoria,
            'fecha' => $request->fecha
        ]);

        $pub->etiquetas()->sync($request->etiquetas);

        return view('publicacion.show', compact('pub', 'coms'));
    }

    public function store(Request $request)
    {
        $usr = Usuario::findOrFail(Auth::id())->withCount('publicacion');
        $conf = Configuracion::firstOrFail();

        if ($usr['publicacion_count'] < $conf->limiteDePublicaciones) {

            $imagen = $this->validate($request);

            $request->validate([
                'imagen' => 'required|image|max:5192',
            ], [
                'imagen.required' => 'La imagen es obligatoria.',
                'imagen.image' => 'El archivo debe ser una imagen.',
                'imagen.max'   => 'La imagen no puede superar los 5MB.'
            ]);

            $pub = Publicacion::create([
                'imagen' => $imagen,
                'titulo' => $request->titulo,
                'contenido' => $request->contenido,
                'descripcion' => $request->descripcion,
                'fk_autor' => $request->autor,
                'fk_categoria' => $request->categoria,
                'fecha' => $request->fecha
            ]);

            $pub->etiquetas()->sync($request->etiquetas);

            $pub = Publicacion::with('autor:nombre,id', 'categorias:nombre,id', 'etiquetas')->withCount('likes', 'guardadas')->findOrFail($pub->id);
            $coms = Comentario::with('usuario')->withCount('likes')->where('fk_publicacion', $pub->id)->paginate(10);

            return view('publicacion.show', compact('pub', 'coms'));
        }
        return back()->withErrors(['demasiado comentarios']);
    }

    public function destroy(int $id): RedirectResponse
    {
        $pub = Publicacion::findOrFail($id);

        if ($pub->fk_autor == Auth::id() || Usuario::findOrFail(Auth::id())->hasRole(Roles::Admin->value)) {
            $pub->delete();
            return redirect()->route('home')->with('session', 'eliminado exitosamente');
        }

        return back()->withErrors(['No tiene permisos']);
    }

    private function validate(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'imagen' => 'nullable|image|max:5192',
            'categoria' => 'required|exists:categorias,id',
            'etiquetas' => 'required|array|min:1',
            'etiquetas.*' => 'exists:etiquetas,id',
            'autor' => 'required|exists:usuarios,id',
            'fecha' => 'required|date',
            'contenido' => 'required|string',
            'descripcion' => 'required|string|max:500',
        ], [
            'titulo.required' => 'El título es obligatorio.',
            'titulo.string'   => 'El título debe ser texto válido.',
            'titulo.max'      => 'El título no puede tener más de 255 caracteres.',

            'descripcion.required' => 'La descripción es obligatoria.',
            'descripcion.string'   => 'La descripción debe ser texto válido.',
            'descripcion.max'      => 'La descripción no puede tener más de 500 caracteres.',

            'imagen.image' => 'El archivo debe ser una imagen.',
            'imagen.max'   => 'La imagen no puede superar los 5MB.',

            'categoria.required' => 'La categoría es obligatoria.',
            'categoria.exists'   => 'La categoría seleccionada no es válida.',

            'etiquetas.required' => 'Debes seleccionar al menos una etiqueta.',
            'etiquetas.array'    => 'Las etiquetas deben enviarse en formato correcto.',
            'etiquetas.min'      => 'Debes seleccionar al menos una etiqueta.',
            'etiquetas.*.exists' => 'Una o más etiquetas seleccionadas no existen.',

            'autor.required' => 'El autor es obligatorio.',
            'autor.exists'   => 'El autor seleccionado no es válido.',

            'fecha.required' => 'La fecha es obligatoria.',
            'fecha.date'     => 'La fecha no tiene un formato válido.',

            'contenido.required' => 'El contenido es obligatorio.',
            'contenido.string'   => 'El contenido debe ser texto válido.'
        ]);

        if ($request->imagen != null && $request->file('imagen')->isValid()) {
            $nombre = time() . '.' . $request->file('imagen')->extension();

            $request->file('imagen')->storeAs('publicaciones', $nombre);
            return $nombre;
        } else {
            return null;
        }
    }

    public function like(int $idUsuario, int $idPublicacion): RedirectResponse
    {
        $like = Publicacion::findOrFail($idPublicacion)->likes();

        $exists = $like->wherePivot('fk_autor', $idUsuario)->exists();

        if ($exists) {
            $like->where('fk_autor', $idUsuario)->detach();
        } else {
            $like->attach(['fk_autor' => $idUsuario]);
        }
        return back();
    }

    public function bookmark(int $idUsuario, int $idPublicacion)
    {
        $guardar = Publicacion::findOrFail($idPublicacion)->guardadas();

        $exists = $guardar->wherePivot('fk_autor', $idUsuario)->exists();

        if ($exists) {
            $guardar->where('fk_autor', $idUsuario)->detach();
        } else {
            $guardar->attach(['fk_autor' => $idUsuario]);
        }
        return back();
    }

    public function search(Request $request): View
    {
        $publicaciones = Publicacion::with('autor:nombre,id', 'categorias:nombre,id')->withCount('likes', 'guardadas', 'comentario');
        $prompt = $request->prompt;

        if ($prompt != null) {
            $publicaciones = $publicaciones->whereLike('titulo', '%' . $prompt . '%');
        }

        $publicaciones = $publicaciones->paginate(18)->withQueryString();

        return view('publicacion.search', compact('publicaciones'));
    }
}
