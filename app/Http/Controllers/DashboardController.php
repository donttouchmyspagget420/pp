<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\Usuario;

class DashboardController extends Controller
{
    public function index(): View
    {
        $usr =  Usuario::withCount('likePublicacion', 'guardadasPublicacion', 'comentario')->findOrFail(Auth::id());

        return View('dashboard.dashboard', compact('usr'));
    }
}
