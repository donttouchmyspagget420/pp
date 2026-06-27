@extends('layouts.template')

@section('title', 'configuracion')

@section('content')

 <div class="container mt-5">
      <h1 class="text-start">Configuraciones</h1>
      <form action="/admin/configuracion" method="post" class="border p-5" enctype="multipart/form-data">
        @csrf

        <h2 class="text-center">Apariencia</h2>

        <hr>

        <div class="row">
          <div class="col-6">
            <div class="container">
              <label class="fs-5" for="sel">Color Accento - Usuario</label>
              <select class="form-select" aria-label="Default select example" id="sel" name="colorAccentoUsuario" required>
                <option selected>Seleccione</option>
                @foreach(\App\Enums\ColorAccente::cases() as $case)
                        <option value="{{$case}}">{{$case}}</option>
                @endforeach
              </select>
            </div>
          </div>

          <div class="col-6">
            <div class="container">
              <label class="fs-5" for="inputGroupFile04">pfp por defecto - Usuario</label>
              <input type="file" class="form-control" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04"
                aria-label="Upload" name="pfpPorDefectoUsuario" required accept="image/*">
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-6">
            <div class="container">
              <label class="fs-5" for="sel">Color Accento - Editor</label>
              <select class="form-select" aria-label="Default select example" id="sel" name="colorAccentoEditor"  required>
                <option selected>Seleccione</option>
                @foreach(\App\Enums\ColorAccente::cases() as $case)
                        <option value="{{$case}}">{{$case}}</option>
                @endforeach
              </select>
            </div>
          </div>

          <div class="col-6">
            <div class="container">
              <label class="fs-5" for="inputGroupFile04">pfp por defecto - Editor</label>
              <input type="file" class="form-control" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04"  required
                aria-label="Upload" name="pfpPorDefectoEditor" accept="image/*">
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-6">
            <div class="container">
              <label class="fs-5" for="sel">Color Accento - Admin</label>
              <select class="form-select" aria-label="Default select example" id="sel" name="colorAccentoAdmin"  required>
                <option selected>Seleccione</option>
                @foreach(\App\Enums\ColorAccente::cases() as $case)
                        <option value="{{$case}}">{{$case}}</option>
                @endforeach
              </select>
            </div>
          </div>

          <div class="col-6">
            <div class="container">
              <label class="fs-5" for="inputGroupFile04">pfp por defecto - Admin</label>
              <input type="file" class="form-control" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" required
                aria-label="Upload" name="pfpPorDefectoAdmin" accept="image/*">
            </div>
          </div>
        </div>


        <h2 class="text-center mt-5">Permisos</h2>

        <hr>

        <div class="row">
          <div class="col-6">
            <div class="container">
              <div class="input-group">
                <div class="form-check form-switch">
                  <input class="form-check-input" type="checkbox" role="switch" id="switchCheckDefault" checked name="removerComentariosEditores" value="1"  required value="{{old('removerComentariosEditores')}}">
                  <label class="form-check-label" for="switchCheckDefault">Editores pueden remover los
                    comentarios</label>
                </div>
              </div>
            </div>
          </div>
          <div class="col-6">
            <div class="container">
              <div class="input-group">
                <div class="form-check form-switch">
                  <input class="form-check-input" type="checkbox" role="switch" id="switchCheckDefault" checked name="modificarComentariosUsuarios" value="1" required value="{{old('modificarComentariosUsuarios')}}">
                  <label class="form-check-label" for="switchCheckDefault">
                    Usuarios pueden modificar su propio comentario
                  </label>
                </div>
              </div>
            </div>
          </div>
        </div>


        <h2 class="text-center mt-5">Limites</h2>

        <hr>
        <div class="row">
          <div class="col-6">
            <div class="container">
              <label class="form-check-label" for="switchCheckDefault">
                Límite de número de publicaciones por persona
              </label>
              <input class="form-control" type="number" id="switchCheckDefault" name="limiteDePublicaciones" required value="{{old('limiteDePublicaciones')}}">
            </div>
          </div>
          <div class="col-6">
            <div class="container">
              <label class="form-check-label" for="switchCheckDefault">
                Límite de número de comentarios por persona
              </label>
              <input class="form-control" type="number" id="switchCheckDefault" name="limiteDeComentarios" required value="{{old('limiteDeComentarios')}}">
            </div>
          </div>
        </div>

        <div class="row mt-5">
            <input type="submit" class="btn btn-outline-{{$color}} mx-auto" value="Enviar">
        </div>
      </form>
    </div>

@endsection
