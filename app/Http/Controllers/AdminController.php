<?php

namespace App\Http\Controllers;

use App\Models\Configuracion;
use App\Models\Publicacion;
use Illuminate\Http\Client\Response;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Validation\Rule;
use App\Enums\ColorAccente;
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

            'pfpPorDefectoUsuario' => ['required', 'image'],
            'pfpPorDefectoEditor'  => ['required', 'image'],
            'pfpPorDefectoAdmin'   => ['required', 'image'],

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

            'pfpPorDefectoEditor.required' => 'El campo pfpPorDefectoEditor es obligatorio.',
            'pfpPorDefectoEditor.image'    => 'El archivo de pfpPorDefectoEditor debe ser una imagen.',

            'pfpPorDefectoAdmin.required' => 'El campo pfpPorDefectoAdmin es obligatorio.',
            'pfpPorDefectoAdmin.image'    => 'El archivo de pfpPorDefectoAdmin debe ser una imagen.',

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

        Configuracion::update($data);

        return redirect()->route('home')->with('success', 'configuracion cambiado exitosamente');
    }

    public function usuarios(): View
    {
        return view('admin.usuarios');
    }

    public function editores(): View
    {
        return view('admin.editores');
    }

    public function configuraciones(): View
    {
        return view('admin.configuraciones');
    }
}
