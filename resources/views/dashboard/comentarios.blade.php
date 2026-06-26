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
                <a class="link-{{$color}}" href="{{route('dashboard.comentarios', $data['id'])}}">
                  Tus Comentarios {{$coms->total()}}
                </a>
              </li>
              <li>
                <a class="link-secondary link-underline-opacity-0" href="{{route('dashboard.destacados', $data['id'])}}">
                  Tus Destacados {{$data['guardadas_publicacion_count']}}
                </a>
              </li>
            @if($data->hasRole(\App\Enums\Roles::Editor->value) || $data->hasRole(\App\Enums\Roles::Admin->value))
                <li>
                    <a class="link-secondary link-underline-opacity-0" href="{{route('dashboard.misblogs', $data['id'])}}">
                      Mis Blogs {{$data['publicacion_count']}}
                    </a>
                  </li>
            @endif
            @if($data->hasRole(\App\Enums\Roles::Admin->value))
                <li>
                    <a class="link-secondary link-underline-opacity-0" href="{{route('dashboard.blogs', $data['id'])}}">
                      Blogs {{$data['blogs_count']}}
                    </a>
                  </li>
            @endif
            @if($data->hasRole(\App\Enums\Roles::Editor->value) || $data->hasRole(\App\Enums\Roles::Admin->value))
                <li>
                <a class="btn btn-outline-success" href="{{route('publicacion.store')}}">
                  Crear un blog
                </a>
              </li>
            @endif
            </ul>
          </div>
          <hr>


        <div class="comments d-flex flex-column gap-2 border p-5 rounded">
        @foreach($coms as $com)
            @include('components.comentario', ['com' => $com])
        @endforeach

        {{ $coms->links() }}
      </div>
    </div>
@endsection
