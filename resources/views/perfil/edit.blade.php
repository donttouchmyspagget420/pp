@extends('layouts.template')

@section('title', $usr->username)

@section('content')

@if ($errors->any())
    <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <p><strong>{{ $error }}</strong></p>
            @endforeach
    </div>
@endif

 <div class="container mt-5 p-5 border" style="min-height: 75vh">
    <form action="/perfil/edit" method="post" enctype="multipart/form-data">
        @csrf

        <input type="hidden" value="{{$usr->id}}" name="id">
        <input type="hidden" value="{{$usr->rol->nombre}}" name="rol">
            <div class="row">
                <figure class="col-12 col-md-6 col-lg-3">
                    <img src="{{ $usr->perfilUsuario->getPfp() }}" alt="pfp" class="rounded-circle" width="200" height="200">
                    <input type="file" class="form-control mt-2" name="pfp" accept="image/*">
                    <div class="form-check form-switch">
                      <input class="form-check-input" type="checkbox" role="switch" id="switchCheckDefault" name="pfpRemover" value="1">
                      <label class="form-check-label" for="switchCheckDefault">Remover el imagen</label>
                    </div>
                    <select class="form-select" aria-label="Default select example" id="sel"   required name="color">
                        <option selected value="{{$usr->configUsuario->color}}">{{$usr->configUsuario->color}}</option>
                        @foreach(\App\Enums\ColorAccente::cases() as $case)
                                <option value="{{$case}}">{{$case}}</option>
                        @endforeach
                    </select>
                </figure>
                <article class="col-12 col-md-6 col-lg-3 d-flex flex-column text-start justify-content-center">
                    <input class="form-control form-control-lg" type="text" placeholder="Nombre completo" value="{{ $usr->nombre }}"
                      name="nombre" required>
                    <div class="input-group">
                      <span class="input-group-text">@</span>
                      <input type="text" class="form-control" placeholder="Username" value="{{$usr->username }}" name="username" required>
                    </div>
                    <div class="d-flex gap-1">
                        <p class="text-body-secondary">Seguidores</p>
                        <p class="text-body-secondary">{{ $usr['siguidores_count'] }}</p>
                        <p class="text-body-secondary">|</p>
                        <p class="text-body-secondary">Seguiendo</p>
                        <p class="text-body-secondary">{{ $usr['siguiendo_count'] }}</p>
                    </div>
                </article>
                <hr>
                <div class="row">
                    <div class="col-12 col-md-4 p-0 border-end">
                        <article>
                            <h4>Informacción addicional:</h4>
                        </article>
                        <div class="d-flex flex-column mt-3">
                            <p class="fs-5 fw-bold">Correo Electrónico:</p>
                            <input type="email" class="form-control" placeholder="Correo Electrónico" value="{{ $usr->correo }}" required name="correo">
                            <div class="form-check form-switch">
                              <input class="form-check-input" type="checkbox" role="switch" id="switchCheckDefault" value="1" name="mostrarCorreo" checked>
                              <label class="form-check-label" for="switchCheckDefault">Mostrar al Público</label>
                            </div>
                        </div>
                        <div class="d-flex flex-column mt-3">
                            <p class="fs-5 fw-bold">Ubicación:</p>
                            <input type="text" class="form-control" placeholder="Ubicación" value="{{ $usr->perfilUsuario->ubicacion }}" name="ubicacion">
                            <div class="form-check form-switch">
                              <input class="form-check-input" type="checkbox" role="switch" id="switchCheckDefault" value="1" name="mostrarUbi" >
                              <label class="form-check-label" for="switchCheckDefault">Mostrar al Público</label>
                            </div>
                        </div>
                        <div class="d-flex flex-column mt-3">
                            <p class="fs-5 fw-bold">Educación:</p>
                            <input type="text" class="form-control" placeholder="Ubicación" value="{{ $usr->perfilUsuario->educacion }}" name="educacion">
                            <div class="form-check form-switch">
                              <input class="form-check-input" type="checkbox" role="switch" id="switchCheckDefault" value="1" name="mostraredu" >
                              <label class="form-check-label" for="switchCheckDefault">Mostrar al Público</label>
                            </div>
                        </div>
                        <div class="d-flex flex-column mt-3">
                            <p class="fs-5 fw-bold">Numero de telefono:</p>
                            <input type="text" class="form-control" placeholder="Ubicación" value="{{ $usr->perfilUsuario->tele  }}" name="tele">
                            <div class="form-check form-switch">
                              <input class="form-check-input" type="checkbox" role="switch" id="switchCheckDefault" value="1" name="mostrarTele" >
                              <label class="form-check-label" for="switchCheckDefault">Mostrar al Público</label>
                            </div>
                        </div>
                        <div class="d-flex flex-column mt-3">
                              <input type="password" class="form-control" placeholder="contraseña" name="password" required value="{{ old('password') }}">
                              <input type="password" class="form-control" placeholder="confirmar la contraseña" name="password_confirmation" required value="{{ old('password_confirmation') }}">
                        </div>
                    </div>
                    <div class="col-12 col-md-8">
                        <div class="container pt-3 font-monospace">
                            <h1 class="text-center fw-bold">Sobre Mí </h1>
                            <hr>
                            <textarea name="sobre" class="fw-light fs-5 w-100" placeholder="Sobre Mí" maxlength="800" rows="20">{{ $usr->perfilUsuario->sobre }}</textarea>
                        </div>

                    </div>
                        <div class="text-end">
                          <input type="submit" class="btn btn-outline-info" value="Guardar Cambios">
                          <input type="reset" class="btn btn-outline-warning" value="Resetear">
                        </div>
                </div>
            </div>

        </form>
        </div>

@endsection
