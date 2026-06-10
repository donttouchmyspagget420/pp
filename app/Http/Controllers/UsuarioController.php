<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class UsuarioController extends Controller
{
    public function show(): View
    {
        //todo
        return view('perfil.show');
    }
}
