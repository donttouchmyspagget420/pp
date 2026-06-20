<?php

namespace App\Http\Controllers;

use App\Models\Configuracion;
use App\Models\Publicacion;
use App\Enums\Roles;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Validation\Rule;
use App\Enums\ColorAccente;
use App\Models\Rol;
use App\Models\Usuario;
use Illuminate\Http\RedirectResponse;

class AdminController extends Controller
{
    public function reportes(Request $request): View
    {
        $fecha = $request->fecha;
        $likes = Publicacion::query();
        $comentarios = Publicacion::query();

        if ($fecha != null) {
            switch ($fecha) {
                case "hoy":
                    $likes = $likes->where('fecha', now());
                    $comentarios = $comentarios->where('fecha', now());
                    break;
                case "semana":
                    $likes = $likes->whereBetween('fecha', [now()->startOfWeek(), now()->endOfWeek()]);
                    $comentarios = $comentarios->whereBetween('fecha', [now()->startOfWeek(), now()->endOfWeek()]);
                    break;
                case "mes":
                    $likes = $likes->whereBetween('fecha', [now()->startOfMonth(), now()->endOfMonth()]);
                    $comentarios = $comentarios->whereBetween('fecha', [now()->startOfMonth(), now()->endOfMonth()]);
                    break;
                case "ano":
                    $likes = $likes->whereBetween('fecha', [now()->startOfYear(), now()->endOfYear()]);
                    $comentarios = $comentarios->whereBetween('fecha', [now()->startOfYear(), now()->endOfYear()]);
                    break;
            }
        }

        $likes = $likes->with('autor:nombre,id', 'categorias:nombre,id', 'etiquetas')->withCount('likes', 'guardadas', 'comentario')->orderByDesc('likes_count')->limit(5)->get();
        $comentarios = $comentarios->with('autor:nombre,id', 'categorias:nombre,id', 'etiquetas')->withCount('likes', 'guardadas', 'comentario')->orderByDesc('comentario_count')->limit(5)->get();

        return view('admin.reportes', compact('likes', 'comentarios'));
    }

    public function editConfiguracion(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'colorAccentoUsuario' => ['required', Rule::enum(ColorAccente::class)],
            'colorAccentoEditor'  => ['required', Rule::enum(ColorAccente::class)],
            'colorAccentoAdmin'   => ['required', Rule::enum(ColorAccente::class)],

            'pfpPorDefectoUsuario' => ['required', 'image', 'max:5120'],
            'pfpPorDefectoEditor'  => ['required', 'image', 'max:5120'],
            'pfpPorDefectoAdmin'   => ['required', 'image', 'max:5120'],

            'removerComentariosEditores' => ['required', 'boolean'],
            'modificarComentariosUsuarios' => ['required', 'boolean'],

            'limiteDePublicaciones' => ['required', 'integer', 'min:1', 'max:999'],
            'limiteDeComentarios'   => ['required', 'integer', 'min:1', 'max:999'],
        ], [
            'colorAccentoUsuario.required' => 'El campo colorAccentoUsuario es obligatorio.',
            'colorAccentoUsuario.enum'     => 'El campo colorAccentoUsuario no tiene un valor válido.',

            'colorAccentoEditor.required' => 'El campo colorAccentoEditor es obligatorio.',
            'colorAccentoEditor.enum'     => 'El campo colorAccentoEditor no tiene un valor válido.',

            'colorAccentoAdmin.required' => 'El campo colorAccentoAdmin es obligatorio.',
            'colorAccentoAdmin.enum'     => 'El campo colorAccentoAdmin no tiene un valor válido.',

            'pfpPorDefectoUsuario.required' => 'El campo pfpPorDefectoUsuario es obligatorio.',
            'pfpPorDefectoUsuario.image'    => 'El archivo de pfpPorDefectoUsuario debe ser una imagen.',
            'pfpPorDefectoUsuario.max' => 'La imagen de pfpPorDefectoUsuario no puede superar los 5 MB.',

            'pfpPorDefectoEditor.required' => 'El campo pfpPorDefectoEditor es obligatorio.',
            'pfpPorDefectoEditor.image'    => 'El archivo de pfpPorDefectoEditor debe ser una imagen.',
            'pfpPorDefectoEditor.max' => 'La imagen de pfpPorDefectoEditor no puede superar los 5 MB.',

            'pfpPorDefectoAdmin.required' => 'El campo pfpPorDefectoAdmin es obligatorio.',
            'pfpPorDefectoAdmin.image'    => 'El archivo de pfpPorDefectoAdmin debe ser una imagen.',
            'pfpPorDefectoAdmin.max' => 'La imagen de pfpPorDefectoAdmin no puede superar los 5 MB.',

            'removerComentariosEditores.required' => 'El campo removerComentariosEditores es obligatorio.',
            'removerComentariosEditores.boolean'  => 'El campo removerComentariosEditores debe ser verdadero o falso.',

            'modificarComentariosUsuarios.required' => 'El campo modificarComentariosUsuarios es obligatorio.',
            'modificarComentariosUsuarios.boolean'  => 'El campo modificarComentariosUsuarios debe ser verdadero o falso.',

            'limiteDePublicaciones.required' => 'El campo limiteDePublicaciones es obligatorio.',
            'limiteDePublicaciones.integer'  => 'El campo limiteDePublicaciones debe ser un número entero.',
            'limiteDePublicaciones.min'      => 'El campo limiteDePublicaciones debe ser mayor o igual a 1.',
            'limiteDePublicaciones.max'      => 'El campo limiteDePublicaciones debe ser menor o igual a 999.',

            'limiteDeComentarios.required' => 'El campo limiteDeComentarios es obligatorio.',
            'limiteDeComentarios.integer'  => 'El campo limiteDeComentarios debe ser un número entero.',
            'limiteDeComentarios.min'      => 'El campo limiteDeComentarios debe ser mayor o igual a 1.',
            'limiteDeComentarios.max'      => 'El campo limiteDeComentarios debe ser menor o igual a 999.',
        ]);

        $files = ['pfpPorDefectoUsuario', 'pfpPorDefectoEditor', 'pfpPorDefectoAdmin'];

        foreach ($files as $file) {
            if (!$request->file($file)->isValid()) {
                return back()->with('error', "debe subir imagen valido en campo '$file'");
            }

            $nuevoNombre = time() . '.' . $request->file($file)->extension();

            $request->file($file)->storeAs('pfps', $nuevoNombre);

            $data[$file] = $nuevoNombre;
        }

        Configuracion::firstOrFail()->update($data);

        return redirect()->route('home')->with('success', 'configuracion cambiado exitosamente');
    }

    public function usuarios(): View
    {
        $rol = Rol::where('nombre', Roles::Usuario)->first();
        $data = Usuario::where('fk_rol', $rol->id)->paginate(20);

        return view('admin.usuarios', compact('data'));
    }

    public function editores(): View
    {
        $rol = Rol::where('nombre', Roles::Editor)->first();
        $data = Usuario::where('fk_rol', $rol->id)->paginate(20);

        return view('admin.editores', compact('data'));
    }

    public function configuracion(): View
    {
        return view('admin.configuracion');
    }
}
