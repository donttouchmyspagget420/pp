<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

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
            'username' => 'required|min:4|max:100|alpha_num',
            'nombre' => 'required|min:2|max:100',
            'email' => 'required|max:255',
            'phone' => 'max:20|numeric',
            'password' => 'required|min:8|max:255|confirmed'
        ], [
            'username.required' => 'el nombre de usuario es obligatorio',
            'username.min' => 'minimo es 4 caracteres',
            'username.max' => 'maximo es 100 caracteres',
            'username.alpha_num' => 'solo letras,numeros,-,_ son permitidos',
            'nombre.required' => 'el nombre es obligatorio',
            'nombre.min' => 'minimo es 2 caracteres',
            'nombre.max' => 'maximo es 100 caracteres',
            'email.required' => 'el correo es obligatorio',
            'email.max' => 'maximo es 255 caracteres',
            'phone.max' => 'maximo es 20 caracteres',
            'phone.numeric' => 'solo numeros',
            'password.required' => 'la contrasena obligatorio',
            'password.min' => 'minimo es 8 caracteres',
            'password.max' => 'maximo es 255 caracteres',
            'password.confirmed' => 'contrasenas no coinceden',
        ]);

        Usuario::create($request);

        return redirect('home');
    }

    public function login(): View
    {
        return view('home');
    }
}
