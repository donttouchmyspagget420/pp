<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UsuarioController extends Controller
{
    public function show(int $id): View
    {
        $usr = Usuario::withCount('siguidores', 'siguiendo')->findOrFail($id);

        return view('perfil.show', compact('usr'));
    }

    public function store(Request $request): View
    {
        //todo
        return view('');
    }
}
