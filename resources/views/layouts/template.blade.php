<!doctype html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title')</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  <link rel="stylesheet" href="{{asset('css/style.css')}}">
</head>

<body>
  <!--                                                                                       HEADER                                                                -->
  <header>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
      <div class="container">
        @if (!Auth::check())
            <a class="navbar-brand" href="{{ route('home') }}"><img src="{{ asset('storage/logo_AI_GENERATED.png') }}" alt="Logo" width="100"></a>
        @else
            <div class="dropdown">
                <img class="rounded-circle border border-3 border-{{ $color }}" src="{{ Auth::user()->perfilUsuario->getPfp() }}" alt="pfp" style="width: 50px" data-bs-toggle="dropdown">
              <ul class="dropdown-menu">
                <li><a class="dropdown-item link-{{ $color }}" href="{{ route('perfil.show',Auth::user()->id) }}">Perfil</a></li>
                <li><a class="dropdown-item link-{{ $color }}" href="{{ route('dashboard.like',Auth::user()->id)}}">Dashboard</a></li>
                <li><a class="dropdown-item link-danger" href="{{ route('logout') }}">Quitar</a></li>
                <li><a class="dropdown-item link-danger" href="{{ route('usuario.remove') }}">Remover la cuenta</a></li>
              </ul>
            </div>
        @endif
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto ms-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" href="{{ route('home') }}">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('categorias.show') }}" role="button" aria-expanded="false">
                Categorías
              </a>
            </li>
            @auth
                @if(Auth::user()->hasRole(\App\Enums\Roles::Admin->value) || Auth::user()->hasRole(\App\Enums\Roles::Editor->value))
                    <li class="nav-item">
                      <a class="nav-link" href="{{ route('categorias.index') }}" role="button" aria-expanded="false">
                       Gestión de Categorías
                      </a>
                    </li>
                @endif
                @if(Auth::user()->hasRole(\App\Enums\Roles::Admin->value))
                    <li class="nav-item">
                      <a class="nav-link" href="{{ route('admin.usuarios') }}" role="button" aria-expanded="false">
                        Usuarios
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="{{ route('admin.editores') }}" role="button" aria-expanded="false">
                        Editores
                      </a>
                    </li>                    <li class="nav-item">
                      <a class="nav-link" href="{{ route('admin.reportes') }}" role="button" aria-expanded="false">
                        Reportes
                      </a>
                    </li>                    <li class="nav-item">
                      <a class="nav-link" href="{{ route('admin.configuracion') }}" role="button" aria-expanded="false">
                        Configuración
                      </a>
                    </li>
                @endif
            @endauth
          </ul>
          <form class="d-flex" role="search">
            <input class="form-control" type="search" placeholder="Buscar por palabras claves"
              aria-label="Search" />
          </form>
            @if (!Auth::check())
              <div class="text-end ms-3 d-flex gap-2">
                <a href="{{ route('auth.register') }}" class="btn btn-outline-{{ $color }}" role="button">Registrar</a>
                <a href="{{ route('auth.login') }}" class="btn btn-outline-{{ $color }}" role="button">Log in</a>
              </div>
            @endif
          <button class="btn-icon ms-3" role="button" onclick="toggle(this)">
            <img id="toggleMode" src="{{ asset('storage/svgs/sun.svg') }}" alt="" width="50">
          </button>
        </div>
      </div>
    </nav>
  </header>
    @if(session('success'))
        <div class="alert alert-success" role="alert">
            <strong>{{ session('success') }}</strong>
        </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <p><strong>{{ $error }}</strong></p>
                @endforeach
        </div>
    @endif

    <section class="mt-5" style="min-height:75vh !important">
        @yield('content')
    </section>


  <!--                                                                                       VOOTER                                                                -->
  <footer class="mt-5">
    <hr>
    <p class="text-body-secondary text-center">@2026 Copyright Amangeldiuly Madi</p>
  </footer>

  <!--                                                                                       SCRIPTS                                                                -->
  <script src="{{asset('js/script.js')}}"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
    crossorigin="anonymous"></script>
</body>


</html>


