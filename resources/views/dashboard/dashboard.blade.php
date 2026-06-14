@extends('layouts.template')

@section('title','dashboard')

@section('content')

    <div class="container mt-5">
        <h1 class="text-start">Dashboard</h1>
          <hr>
          <div class="row">
            <ul class="d-flex gap-5 fs-4 list-unstyled">
              <li>
                <a class="link-{{$color}}" href="user_dashboard.html">Me gusta {{$usr['like_publicacion_count']}}</a>
              </li>
              <li>
                <a class="link-secondary link-underline-opacity-0" href="user_comentarios.html">
                  Tus Comentarios {{$usr['guardadas_publicacion_count']}}
                </a>
              </li>
              <li>
                <a class="link-secondary link-underline-opacity-0" href="user_dashboard-destacados.html">
                  Tus Destacados {{$usr['comentario_count']}}
                </a>
              </li>
            </ul>
          </div>
          <hr>

        <div class="row">
            <div class="col-12 col-md-6 col-lg-4">
            </div>
        </div>
    </div>

@endsection
