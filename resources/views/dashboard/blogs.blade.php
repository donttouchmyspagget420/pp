@extends('layouts.template')

@section('title','dashboard')

@section('content')

    <div class="container mt-5" style="min-height: 75vh">
        <h1 class="text-start">Dashboard</h1>
          <hr>
          <div class="row">
            <ul class="d-flex gap-5 fs-4 list-unstyled">
              <li>
                <a class="link-secondary link-underline-opacity-0" href="{{route('dashboard.like', $data['id'])}}">Me gusta {{$data['like_publicacion_count']}}</a>
              </li>
              <li>
                <a class="link-secondary link-underline-opacity-0" href="{{route('dashboard.comentarios', $data['id'])}}">
                  Tus Comentarios {{$data['comentario_count']}}
                </a>
              </li>
              <li>
                <a class="link-secondary link-underline-opacity-0" href="{{route('dashboard.destacados', $data['id'])}}">
                  Tus Destacados {{$data['guardadas_publicacion_count']}}
                </a>
              </li>
                <li>
                <a class="link-secondary link-underline-opacity-0" href="{{route('dashboard.misblogs', $data['id'])}}">Mis blogs {{$data['publicacion_count']}}</a>
              </li>
                <li>
                <a class="link-{{$color}}" href="{{route('dashboard.blogs', $data['id'])}}">
                    Blogs {{$pubs->total()}}
                </a>
              </li>
            <li>
            <a class="btn btn-outline-success" href="{{route('publicacion.crear')}}">
              Crear un blog
            </a>
          </li>
            </ul>
          </div>
          <hr>

        <div class="row mt-5">
                @foreach($pubs as $pub)
                    @include('components.card', ['pub' => $pub])
                @endforeach
        </div>
        {{ $pubs->links() }}
    </div>
@endsection
