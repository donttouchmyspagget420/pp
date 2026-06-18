<?php

namespace App\Http\Controllers;

use App\Models\Publicacion;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\Usuario;

class DashboardController extends Controller
{
    public function like(): View
    {
        $user = Usuario::findOrFail(Auth::id());

        $data =  Usuario::withCount('guardadasPublicacion', 'comentario')->findOrFail(Auth::id());

        $pubs = $user->likePublicacion()->with('autor:nombre,id', 'categorias:nombre,id')->withCount('likes', 'guardadas', 'comentario')->paginate(18);

        return View('dashboard.like', compact('data', 'pubs'));
    }

    public function comentarios(): View
    {
        $user = Usuario::findOrFail(Auth::id());

        $data =  Usuario::withCount('guardadasPublicacion', 'likePublicacion')->findOrFail(Auth::id());

        $coms = $user->comentario()->with('usuario:nombre,id')->withCount('likes')->paginate(4);

        return View('dashboard.comentarios', compact('data', 'coms'));
    }

    public function destacados(): View
    {
        $user = Usuario::findOrFail(Auth::id());

        $data =  Usuario::withCount('likePublicacion', 'comentario')->findOrFail(Auth::id());

        $pubs = $user->guardadasPublicacion()->with('autor:nombre,id', 'categorias:nombre,id')->withCount('likes', 'guardadas', 'comentario')->paginate(18);

        return View('dashboard.destacados', compact('data', 'pubs'));
    }

    public function misBlogs(): View
    {
        $user = Usuario::findOrFail(Auth::id());

        $data =  Usuario::withCount('likePublicacion', 'comentario', 'guardadasPublicacion')->findOrFail(Auth::id());

        $pubs = $user->publicacion()->with('autor:nombre,id', 'categorias:nombre,id')->withCount('likes', 'guardadas', 'comentario')->paginate(18);

        return View('dashboard.misblogs', compact('data', 'pubs'));
    }

    public function blogs(): View
    {
        $data =  Usuario::withCount('likePublicacion', 'comentario', 'publicacion', 'guardadasPublicacion')->findOrFail(Auth::id());

        $pubs = Publicacion::with('autor:nombre,id', 'categorias:nombre,id')->withCount('likes', 'guardadas', 'comentario')->paginate(18);

        return View('dashboard.blogs', compact('data', 'pubs'));
    }
}
