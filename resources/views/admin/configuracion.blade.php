@extends('layouts.template')

@section('title', 'configuracion')

@section('contenido')

@if ($errors->any())
    <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <p><strong>{{ $error }}</strong></p>
            @endforeach
    </div>
@endif

 <div class="container mt-5">
      <h1 class="text-start">Configuraciones</h1>
      <form action="/admin/configuracion" method="post" class="border p-5">
        @csrf

        <h2 class="text-center">Apariencia</h2>

        <hr>

        <div class="row">
          <div class="col-6">
            <div class="container">
              <label class="fs-5" for="sel">Color Accento - Usuario</label>
              <select class="form-select" aria-label="Default select example" id="sel" name="colorAccentoUsuario">
                <option selected>Seleccione</option>
                <option value="aqua">aqua</option>
                <option value="rojo">rojo</option>
                <option value="blanco">blanco</option>
                <option value="negro">negro</option>
                <option value="verde">verde</option>
              </select>
            </div>
          </div>

          <div class="col-6">
            <div class="container">
              <label class="fs-5" for="inputGroupFile04">pfp por defecto - Usuario</label>
              <input type="file" class="form-control" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04"
                aria-label="Upload" name="pfpPorDefectoUsuario">
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-6">
            <div class="container">
              <label class="fs-5" for="sel">Color Accento - Editor</label>
              <select class="form-select" aria-label="Default select example" id="sel" name="colorAccentoEditor">
                <option selected>Seleccione</option>
                <option value="aqua">aqua</option>
                <option value="rojo">rojo</option>
                <option value="blanco">blanco</option>
                <option value="negro">negro</option>
                <option value="verde">verde</option>
              </select>
            </div>
          </div>

          <div class="col-6">
            <div class="container">
              <label class="fs-5" for="inputGroupFile04">pfp por defecto - Editor</label>
              <input type="file" class="form-control" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04"
                aria-label="Upload" name="pfpPorDefectoEditor">
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-6">
            <div class="container">
              <label class="fs-5" for="sel">Color Accento - Admin</label>
              <select class="form-select" aria-label="Default select example" id="sel" name="colorAccentoAdmin">
                <option selected>Seleccione</option>
                <option value="aqua">aqua</option>
                <option value="rojo">rojo</option>
                <option value="blanco">blanco</option>
                <option value="negro">negro</option>
                <option value="verde">verde</option>
              </select>
            </div>
          </div>

          <div class="col-6">
            <div class="container">
              <label class="fs-5" for="inputGroupFile04">pfp por defecto - Admin</label>
              <input type="file" class="form-control" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04"
                aria-label="Upload" name="pfpPorDefectoAdmin">
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
                  <input class="form-check-input" type="checkbox" role="switch" id="switchCheckDefault" checked name="removerComentariosEditores">
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
                  <input class="form-check-input" type="checkbox" role="switch" id="switchCheckDefault" checked name="modificarComentariosUsuarios">
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
              <input class="form-control" type="number" id="switchCheckDefault" name="limiteDePublicaciones">
            </div>
          </div>
          <div class="col-6">
            <div class="container">
              <label class="form-check-label" for="switchCheckDefault">
                Límite de número de comentarios por persona
              </label>
              <input class="form-control" type="number" id="switchCheckDefault" name="limiteDeComentarios">
            </div>
          </div>
        </div>



      </form>
    </div>

@endsection
