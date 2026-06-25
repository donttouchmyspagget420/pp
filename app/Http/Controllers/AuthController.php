<?php

namespace App\Http\Controllers;

use App\Enums\Roles;
use App\Models\Configuracion;
use App\Models\Rol;
use App\Models\Usuario;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin(): View
    {
        return view('auth.login');
    }

    public function showRegister(): View
    {
        return view('auth.register');
    }

    public function register(Request $request): RedirectResponse
    {
        $request->validate([
            'username' => 'required|min:4|max:100|regex:/^[A-Za-z0-9._]+$/|unique:usuarios,username',
            'nombre' => 'required|min:2|max:100',
            'correo' => 'required|email|max:255|unique:usuarios,correo',
            'tele' => 'nullable|string|max:20',
            'password' => 'required|min:8|max:255|confirmed'
        ], [
            'username.required' => 'El campo "nombre de usuario" es obligatorio.',
            'username.min' => 'El campo "nombre de usuario" debe tener al menos 4 caracteres.',
            'username.max' => 'El campo "nombre de usuario" no puede superar los 100 caracteres.',
            'username.regex' => 'El campo "nombre de usuario" solo puede contener letras, números, puntos (.) y guiones bajos (_).',
            'username.unique' => 'Este nombre de usuario ya está en uso.',

            'nombre.required' => 'El campo "nombre" es obligatorio.',
            'nombre.min' => 'El campo "nombre" debe tener al menos 2 caracteres.',
            'nombre.max' => 'El campo "nombre" no puede superar los 100 caracteres.',

            'correo.required' => 'El campo "correo electrónico" es obligatorio.',
            'correo.email' => 'El campo "correo electrónico" debe ser un correo válido.',
            'correo.max' => 'El campo "correo electrónico" no puede superar los 255 caracteres.',
            'correo.unique' => 'Este correo electrónico ya está registrado.',

            'tele.max' => 'El campo "teléfono" no puede superar los 20 caracteres.',
            'tele.string' => 'El campo "teléfono" debe ser texto válido.',

            'password.required' => 'El campo "contraseña" es obligatorio.',
            'password.min' => 'El campo "contraseña" debe tener al menos 8 caracteres.',
            'password.max' => 'El campo "contraseña" no puede superar los 255 caracteres.',
            'password.confirmed' => 'El campo "contraseña" y su confirmación no coinciden.',
        ]);
        $rol = Rol::where('nombre', Roles::Usuario)->firstOrFail();

        $usuario = Usuario::create([
            'username' => $request->username,
            'nombre' => $request->nombre,
            'correo' => $request->correo,
            'password' => Hash::make($request->password),
            'fk_rol' => $rol->id,
        ]);

        Auth::login($usuario, true);

        $perfilInicial = [
            'tele' => $request->tele,
            'pfp' => Configuracion::select('pfpPorDefectoUsuario')->firstOrFail()
        ];

        $usuario->configUsuario()->create();
        $usuario->perfilUsuario()->create($perfilInicial);

        return redirect()->route('home')->with('success', 'Registrado exisitosamente!');
    }

    public function login(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'correo' => 'required|email|max:255',
            'password' => 'required|min:8|max:255'
        ], [
            'correo.required' => 'El correo electrónico es obligatorio.',
            'correo.email' => 'Debe ingresar un correo electrónico válido.',
            'correo.max' => 'El correo electrónico no puede superar los 255 caracteres.',

            'password.required' => 'La contraseña es obligatoria.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'password.max' => 'La contraseña no puede superar los 255 caracteres.',
        ]);

        if (Auth::attempt($data, true)) {
            $request->session()->regenerate();

            return redirect()->route('home')->with('success', 'Logueado exisitosamente!');
        }

        return back()->withErrors([
            'correo' => 'El correo o la contraseña son incorrectos.',
        ])->onlyInput('correo');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('home');
    }

    public function remover(Request $request): RedirectResponse
    {
        $user = Auth::user();

        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        Usuario::where('id', $user->id)->delete();

        return redirect()->route('home')->with('success', 'Eliminado exisitosamente!');
    }
}
