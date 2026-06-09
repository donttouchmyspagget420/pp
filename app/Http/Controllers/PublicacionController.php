<?php

namespace App\Http\Controllers;

use App\Models\Publicacion;
use Illuminate\View\View;

class PublicacionController extends Controller
{
    public function index(): View
    {
        $pubs = Publicacion::withCount('likes')->orderByDesc('likes_count')->limit(5)->get();

        return view('index', compact('pubs'));
    }
}
