@extends('layouts.template')

@section('title', 'reportes')

@section('content')

    <div class="container mt-5">
      <h1 class="text-start">Reportes</h1>
      <hr>
          <form action="/admin/reportes" method="get">
              <div class="input-group mb-3">
                <select class="form-select" aria-label="Default select example" name="fecha">
                  <option selected>Selecciona</option>
                  <option value="hoy">Hoy</option>
                  <option value="semana">Este Semana</option>
                  <option value="mes">Este Mes</option>
                  <option value="ano">Este Año</option>
                </select>
                <button class="btn btn-outline-info" type="submit">Buscar</button>
              </div>
          </form>

      <div class="row mt-5">
        <div class="col-12 col-lg-6 p-5 border">
          <h3 class="text-start">Top 5 por los Likes</h3>
          <ol class="list-group list-group-numbered">
                @foreach($likes as $like)
                    @include('components.small-head_publicacion',['pub' => $like,'order' => [2,1]])
                @endforeach
          </ol>
        </div>
        <div class="col-12 col-lg-6 p-5 border">
          <h3 class="text-start">Top 5 por los Comentarios</h3>
          <ol class="list-group list-group-numbered">
                @foreach($comentarios as $comentario)
                    @include('components.small-head_publicacion',['pub' => $comentario,'order' => [2,1]])
                @endforeach
          </ol>
        </div>
      </div>

    </div>

@endsection
