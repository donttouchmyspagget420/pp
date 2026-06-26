<?php

namespace App\Http\Controllers;

use App\Enums\Roles;
use App\Models\Comentario;
use App\Models\Usuario;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ComentarioController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $data = $this->validate($request);
        Comentario::create($data);
        return back()->with('success', 'creado exitosamente');
    }

    public function edit(Request $request): RedirectResponse
    {
        $data = $this->validate($request);
        $request->validate(['id' => 'required|exists:comentarios,id'], [
            'id.required' => 'El id es obligatorio.',
            'id.exists' => 'El id seleccionado no existe.',
        ]);
        $com = Comentario::findOrFail($request->id);
        $com->update($data);
        return back()->with('success', 'cambiado exitosamente');
    }

    private function validate(Request $request)
    {
        $data = $request->validate([
            'fk_autor' => 'required|exists:usuarios,id',
            'fk_publicacion' => 'required|exists:publicaciones,id',
            'contenido' => 'required|string|max:500'
        ], [
            'fk_autor.required' => 'El autor es obligatorio.',
            'fk_autor.exists' => 'El autor seleccionado no existe.',

            'fk_publicacion.required' => 'La publicación es obligatoria.',
            'fk_publicacion.exists' => 'La publicación seleccionada no existe.',

            'fk_comentario.exists' => 'El comentario seleccionado no existe.',

            'contenido.required' => 'El contenido es obligatorio.',
            'contenido.string' => 'El contenido debe ser un texto.',
            'contenido.max' => 'El contenido no puede superar los 500 caracteres.'
        ]);

        if (Auth::id() == $request->fk_autor || Usuario::findOrFail(Auth::id())->hasRole(Roles::Admin->value)) {
            return $data;
        }

        return back()->withErrors(['No tiene permisos']);
    }

    public function destroy(int $id): RedirectResponse
    {
        $com = Comentario::findOrFail($id);

        if ($com->fk_autor == Auth::id() || Usuario::findOrFail(Auth::id())->hasRole(Roles::Admin->value)) {
            $com->delete();
            return back()->with('session', 'eliminado exitosamente');
        }

        return back()->withErrors(['No tiene permisos']);
    }
}
