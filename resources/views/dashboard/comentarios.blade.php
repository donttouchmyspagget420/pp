@extends('layouts.template')

@section('title','dashboard')

@section('content')

    <div class="container mt-5" style="min-height: 75vh">
        <h1 class="text-start">Dashboard</h1>
          <hr>
          <div class="row">
            <ul class="d-flex gap-5 fs-4 list-unstyled">
              <li>
                <a class="link-secondary link-underline-opacity-0" href="{{route('dashboard.like')}}">Me gusta {{$data['like_publicacion_count']}}</a>
              </li>
              <li>
                <a class="link-{{$color}}" href="{{route('dashboard.comentarios')}}">
                  Tus Comentarios {{$coms->total()}}
                </a>
              </li>
              <li>
                <a class="link-secondary link-underline-opacity-0" href="{{route('dashboard.destacados')}}">
                  Tus Destacados {{$data['guardadas_publicacion_count']}}
                </a>
              </li>
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
