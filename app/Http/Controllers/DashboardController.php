<?php

namespace App\Http\Controllers;

use App\Enums\Roles;
use App\Models\Publicacion;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\Usuario;

class DashboardController extends Controller
{
    public function like(?int $id): View
    {
        $idUser = $id ?? Auth::id();

        $user = Usuario::findOrFail($idUser);

        $pubs = $user->likePublicacion()->with('autor:nombre,id', 'categorias:nombre,id')->withCount('likes', 'guardadas', 'comentario')->paginate(18);

        $data =  Usuario::withCount('guardadasPublicacion', 'comentario', 'publicacion')->findOrFail($idUser);

        if ($user->hasRole(Roles::Admin->value)) {
            $data['blogs_count'] = Publicacion::count();
        }

        return View('dashboard.like', compact('data', 'pubs'));
    }

    public function comentarios(?int $id): View
    {
        $idUser = $id ?? Auth::id();

        $user = Usuario::findOrFail(Auth::id());

        $data =  Usuario::withCount('guardadasPublicacion', 'likePublicacion', 'publicacion')->findOrFail($idUser);

        if ($user->hasRole(Roles::Admin->value)) {
            $data['blogs_count'] = Publicacion::count();
        }

        $coms = $user->comentario()->with('usuario:nombre,id')->withCount('likes')->paginate(4);

        return View('dashboard.comentarios', compact('data', 'coms', 'user'));
    }

    public function destacados(?int $id): View
    {
        $idUser = $id ?? Auth::id();

        $user = Usuario::findOrFail($idUser);

        $data =  Usuario::withCount('likePublicacion', 'comentario', 'publicacion')->findOrFail($idUser);

        if ($user->hasRole(Roles::Admin->value)) {
            $data['blogs_count'] = Publicacion::count();
        }

        $pubs = $user->guardadasPublicacion()->with('autor:nombre,id', 'categorias:nombre,id')->withCount('likes', 'guardadas', 'comentario')->paginate(18);

        return View('dashboard.destacados', compact('data', 'pubs'));
    }

    public function misBlogs(?int $id): View
    {
        $idUser = $id ?? Auth::id();

        $user = Usuario::findOrFail($idUser);

        $data =  Usuario::withCount('likePublicacion', 'comentario', 'guardadasPublicacion')->findOrFail($idUser);

        if ($user->hasRole(Roles::Admin->value)) {
            $data['blogs_count'] = Publicacion::count();
        }

        $pubs = $user->publicacion()->with('autor:nombre,id', 'categorias:nombre,id')->withCount('likes', 'guardadas', 'comentario')->paginate(18);

        return View('dashboard.misblogs', compact('data', 'pubs'));
    }

    public function blogs(?int $id): View
    {
        $idUser = $id ?? Auth::id();

        $data =  Usuario::withCount('likePublicacion', 'comentario', 'publicacion', 'guardadasPublicacion')->findOrFail($idUser);

        $pubs = Publicacion::with('autor:nombre,id', 'categorias:nombre,id')->withCount('likes', 'guardadas', 'comentario')->paginate(18);

        return View('dashboard.blogs', compact('data', 'pubs'));
    }
}
