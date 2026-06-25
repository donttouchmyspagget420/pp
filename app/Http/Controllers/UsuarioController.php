<?php

namespace App\Http\Controllers;

use App\Enums\ColorAccente;
use App\Enums\Roles;
use App\Models\Configuracion;
use App\Models\Rol;
use App\Models\Usuario;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\View\View;


class UsuarioController extends Controller
{


    public function show(int $id): View
    {
        $usr = Usuario::withCount('siguidores', 'siguiendo')->findOrFail($id);

        return view('perfil.show', compact('usr'));
    }

    public function destroy(int $id): RedirectResponse
    {
        Usuario::where('id', $id)->delete();
        return back();
    }

    public function editOrStore(Request $request): RedirectResponse
    {
        if (!($request->id == Auth::id() || $request->user()->hasRole(Roles::Admin->value))) {
            return back()->with('error', 'no hackeas por favor');
        }

        $this->validate($request);

        if ($request->id == null) {
            $user = Usuario::create([
                'username' => $request->username,
                'nombre' => $request->nombre,
                'correo' => $request->correo,
                'password' => Hash::make($request->password),
                'fk_rol' => Rol::where('nombre', $request->rol)->value('id'),
            ]);

            $user->configUsuario()->create([
                'color' => $request->color,
                'correoPublico' => $request->correoPublico,
                'ubicacionPublico' => $request->ubicacionPublico,
                'educacionPublico' => $request->educacionPublico,
                'telePublico' => $request->telePublico
            ]);

            $user->perfilUsuario()->create([
                'pfp' => $imagen ?? Configuracion::value('pfpPorDefecto' . ucfirst($request->rol)),
                'ubicacion' => $request->ubicacion,
                'educacion' => $request->educacion,
                'tele' => $request->tele,
                'sobre' => $request->sobre,
            ]);
        } else {
            $user = Usuario::findOrFail($request->id);

            $user->update([
                'username' => $request->username,
                'nombre' => $request->nombre,
                'correo' => $request->correo,
                'password' => Hash::make($request->password),
                'fk_rol' => Rol::where('nombre', $request->rol)->value('id'),
            ]);

            $user->configUsuario()->update([
                'color' => $request->color,
                'correoPublico' => $request->correoPublico ?? false,
                'ubicacionPublico' => $request->ubicacionPublico ?? false,
                'educacionPublico' => $request->educacionPublico ?? false,
                'telePublico' => $request->telePublico ?? false
            ]);

            $user->perfilUsuario()->update([
                'pfp' => $imagen ?? $user->perfilUsuario->pfp,
                'ubicacion' => $request->ubicacion ?? $user->perfilUsuario->ubicacion,
                'educacion' => $request->educacion ?? $user->perfilUsuario->educacion,
                'tele' => $request->tele ?? $user->perfilUsuario->tele,
                'sobre' => $request->sobre ?? $user->perfilUsuario->sobre,
            ]);
        }

        return redirect()->route('perfil.show', $request->id)->with('success', 'cambiado o creado exitosamente');
    }

    public function showEdit(int $id): View
    {
        $usr = Usuario::withCount('siguidores', 'siguiendo')->findOrFail($id);

        return view('perfil.edit', compact('usr'));
    }

    public function showStore(): View
    {
        return view('perfil.store');
    }


    private function validate(Request $request): string
    {

        $request->validate([
            'rol' => ['required', Rule::enum(Roles::class)],

            'nombre' => ['required', 'string', 'max:100'],
            'username' => ['required', 'string', 'max:100', Rule::unique('usuarios', 'username')->ignore($request->id)],
            'correo' => ['required', 'email', 'max:255', Rule::unique('usuarios', 'correo')->ignore($request->id)],
            'password' => ['required', 'string', 'max:255', 'confirmed'],

            'color' => ['required', Rule::enum(ColorAccente::class)],

            'ubicacion' => ['nullable', 'string', 'max:255'],
            'educacion' => ['nullable', 'string', 'max:255'],
            'tele' => ['nullable', 'string', 'max:20'],

            'sobre' => ['nullable', 'string', 'max:800'],

            'pfp' => ['nullable', 'image', 'max:5120'],
            'pfpRemover' => ['nullable', 'boolean'],

            'mostrarCorreo' => ['nullable', 'boolean'],
            'mostrarUbi' => ['nullable', 'boolean'],
            'mostraredu' => ['nullable', 'boolean'],
            'mostrarTele' => ['nullable', 'boolean'],
        ], [
            'rol.required' => 'No hackeas por favor',
            'rol.enum' => 'No hackeas por favor',

            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.string' => 'El nombre debe ser texto.',
            'nombre.max' => 'El nombre no puede superar los 255 caracteres.',

            'username.required' => 'El nombre de usuario es obligatorio.',
            'username.string' => 'El nombre de usuario debe ser texto.',
            'username.max' => 'El nombre de usuario no puede superar los 50 caracteres.',
            'username.unique' => 'Ese nombre de usuario ya está en uso.',

            'correo.required' => 'El correo electrónico es obligatorio.',
            'correo.email' => 'Debe introducir un correo electrónico válido.',
            'correo.max' => 'El correo electrónico no puede superar los 255 caracteres.',
            'correo.unique' => 'Ese correo electrónico ya está registrado.',

            'password.required' => 'La contraseña es obligatoria.',
            'password.string'   => 'La contraseña debe ser una cadena de texto.',
            'password.max'      => 'La contraseña no puede tener más de :max caracteres.',
            'password.confirmed' => 'El campo "contraseña" y su confirmación no coinciden.',

            'color.required' => 'El color de acento es obligatorio.',
            'color.enum' => 'El color de acento seleccionado no es válido.',

            'ubicacion.string' => 'La ubicación debe ser texto.',
            'ubicacion.max' => 'La ubicación no puede superar los 255 caracteres.',

            'educacion.string' => 'La educación debe ser texto.',
            'educacion.max' => 'La educación no puede superar los 255 caracteres.',

            'tele.string' => 'El número de teléfono debe ser texto.',
            'tele.max' => 'El número de teléfono no puede superar los 20 caracteres.',

            'sobre.string' => 'La descripción debe ser texto.',
            'sobre.max' => 'La descripción no puede superar los 800 caracteres.',

            'pfp.image' => 'La imagen de perfil debe ser una imagen válida.',
            'pfp.max' => 'La imagen de perfil no puede superar los 5 MB.',

            'pfpRemover.required' => 'Debe indicar si desea eliminar la imagen de perfil.',
            'pfpRemover.boolean' => 'El campo pfpRemover debe ser verdadero o falso.',

            'mostrarCorreo.required' => 'Debe indicar si desea mostrar el correo electrónico.',
            'mostrarCorreo.boolean' => 'El campo mostrarCorreo debe ser verdadero o falso.',

            'mostrarUbi.required' => 'Debe indicar si desea mostrar la ubicación.',
            'mostrarUbi.boolean' => 'El campo mostrarUbi debe ser verdadero o falso.',

            'mostraredu.required' => 'Debe indicar si desea mostrar la educación.',
            'mostraredu.boolean' => 'El campo mostraredu debe ser verdadero o falso.',

            'mostrarTele.required' => 'Debe indicar si desea mostrar el teléfono.',
            'mostrarTele.boolean' => 'El campo mostrarTele debe ser verdadero o falso.',
        ]);

        if ($request->pfpRemover ?? false) {
            return Configuracion::value('pfpPorDefecto' . ucfirst($request->rol));
        }

        if ($request->pfp != null && $request->file('pfp')->isValid()) {
            $nombre = time() . '.' . $request->file('pfp')->extension();

            $request->file('pfp')->storeAs('pfps', $nombre);
            return $nombre;
        } else {
            return '';
        }
    }
}
