@extends('layouts.template')

@section('title', $pub->titulo)

@section('content')

    <div class="container row mx-auto mt-5">
      <div class="col-12 col-md-6">
        <img src="{{ $pub->getImagen() }}" class="img-fluid">
      </div>
      <div class="col-12 col-md-6 d-flex justify-content-around align-items-center">
        <div class="row">
          <h1>
            <p class="text-capitalized text-decoration-underline fs-1">
                    {{ $pub->titulo }}
            </p>
          </h1>
          <div class="d-flex gap-2 fs-5">
            <a href="{{ route('categorias.show', ['categoria' => $pub['categorias']['id']]) }}" class="link-{{$color}}">{{ $pub['categorias']['nombre'] }}</a>
          </div>
          <div class="d-flex gap-2 fs-5">
                @foreach($pub['etiquetas'] as $et)
                    <a href="{{route('categorias.show',['etiqueta' => $et->id])}}" class="link-{{$color}}">{{$et->nombre}}</a>
                @endforeach
          </div>
          <div class="d-flex gap-2 fs-4">
            <p class="fst-italic">by</p>
            <a href="{{ route('perfil.show', ['id' => $pub['autor']['id']]) }}" class="link-{{$color}}">{{ $pub['autor']['nombre'] }}</a>
          </div>
          <p class="text-body-secondary">{{ $pub->fecha }}</p>
            @include('components.likes_guardadas_comments',['likes' => $pub['likes_count'],'guardadas' => $pub['guardadas_count'],'comentarios' => count($coms),'id' => $pub->id])
            @auth
                @if(Auth::user()->hasRole(\App\Enums\Roles::Admin->value) || Auth::id() == $com['usuario']['id'])
                    <div class="d-flex gap-2">
                        <a class="btn btn-outline-warning" href="{{route('publicacion.edit', $pub->id)}}">Modificar</a>
                        <a class="btn btn-outline-danger" href="{{route('publicacion.destroy', $pub->id)}}">Eliminar</a>
                    </div>
                @endif
            @endauth
        </div>
      </div>
    </div>

    <hr class="mt-5">

    <div class="mx-auto d-flex flex-column gap-3 justify-content-around align-items-center w-50">
        {!! $pub->contenido !!}
    </div>

    <hr class="mt-5">

    <div class="container">
      <form action="/comentario/store" method="post" class="d-flex flex-column gap-5">
        @csrf
        <input type="hidden" value="{{Auth::id()}}" name="fk_autor">
        <input type="hidden" value="{{$pub->id}}" name="fk_publicacion">
        <label for="comment" class="fs-1">Comparta sus opiniones</label>
        <textarea name="contenido" id="comment" class="form-control" rows="10"></textarea>
        <button type="submit" class="btn btn-lg btn-outline-{{$color}}">Enviar</button>
      </form>

      <h2 class="text-end mt-5">{{ $coms->total() }} Comentarios</h2>
      <div class="comments d-flex flex-column gap-2 border p-5 rounded">
        @foreach($coms as $com)
            @include('components.comentario', ['com' => $com])
        @endforeach

        {{ $coms->links() }}
      </div>
    </div>


@endsection
