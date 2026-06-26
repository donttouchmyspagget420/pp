@extends('layouts.template')

@section('title', $usr->username)

@section('content')

 <div class="container mt-5 p-5 border" style="min-height: 75vh">
            <div class="row">
                <figure class="col-12 col-md-6 col-lg-3">
                    <img src="{{ $usr->perfilUsuario->getPfp() }}" alt="pfp" class="rounded-circle" width="200" height="200">
                </figure>
                <article class="col-12 col-md-6 col-lg-3 d-flex flex-column text-start justify-content-center">
                    <h2>{{ $usr->nombre }}</h2>
                    <p class="fs-4">{{'@' . $usr->username }}</p>
                    <div class="d-flex gap-1">
                        <p class="text-body-secondary">Seguidores</p>
                        <p class="text-body-secondary">{{ $usr['siguidores_count'] }}</p>
                        <p class="text-body-secondary">|</p>
                        <p class="text-body-secondary">Seguiendo</p>
                        <p class="text-body-secondary">{{ $usr['siguiendo_count'] }}</p>
                    </div>
                    @auth
                        @if(Auth::user()->id == $usr->id || Auth::user()->hasRole(\App\Enums\Roles::Admin->value))
                            <a href="{{route('perfil.edit', $usr->id)}}" class="btn btn-outline-{{$color}}">Editar Perfil</a>
                        @else
                            <a href="" class="btn btn-outline-{{$color}}">Seguir</a>
                        @endif
                    @endauth
                </article>
                <hr>
                <div class="row">
                    <div class="col-12 col-md-4 p-0 border-end">
                        <article>
                            <h4>Informacción addicional:</h4>
                        </article>
                        @if($usr->configUsuario->correoPublico || Auth::user()->hasRole(\App\Enums\Roles::Admin->value))
                            <div class="d-flex flex-column mt-3">
                                <p class="fs-5 fw-bold">Correo Electrónico:</p>
                                <p>{{ $usr->correo }}</p>
                            </div>
                        @endif
                        @if($usr->configUsuario->ubicacionPublico || Auth::user()->hasRole(\App\Enums\Roles::Admin->value))
                            <div class="d-flex flex-column mt-3">
                                <p class="fs-5 fw-bold">Ubicación:</p>
                                <p>{{ $usr->perfilUsuario->ubicacion }}</p>
                            </div>
                        @endif
                        @if($usr->configUsuario->educacionPublico || Auth::user()->hasRole(\App\Enums\Roles::Admin->value))
                            <div class="d-flex flex-column mt-3">
                                <p class="fs-5 fw-bold">Educación:</p>
                                <p>{{ $usr->perfilUsuario->educacion }}</p>
                            </div>
                        @endif
                        @if($usr->configUsuario->telePublico || Auth::user()->hasRole(\App\Enums\Roles::Admin->value))
                            <div class="d-flex flex-column mt-3">
                                <p class="fs-5 fw-bold">Numero de telefono:</p>
                                <p>{{ $usr->perfilUsuario->tele }}</p>
                            </div>
                        @endif
                        <!-- solo visible a dicho usuario -->
                        @auth
                            @if(Auth::user()->id == $usr->id || Auth::user()->hasRole(\App\Enums\Roles::Admin->value))
                                <div class="d-flex flex-column mt-3">
                                    <p class="fs-5 fw-bold">Tu Dashboard:</p>
                                    <a class="link-{{$color}}" href="{{ route('dashboard.like', $usr->id) }}">Me Gusta</a>
                                    <a class="link-{{$color}}" href="{{ route('dashboard.comentarios', $usr->id) }}">Mí comentarios</a>
                                    <a class="link-{{$color}}" href="{{ route('dashboard.destacados', $usr->id) }}">Mí destacados</a>
                                </div>
                            @endif
                        @endauth
                    </div>
                    <div class="col-12 col-md-8">
                        <div class="container pt-3 font-monospace">
                            <h1 class="text-center fw-bold">Sobre Mí </h1>
                            <hr>
                            <p class="fw-light fs-5" >{{ $usr->perfilUsuario->sobre }}</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>

@endsection
