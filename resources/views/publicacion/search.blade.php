@extends('layouts.template')

@section('title','publicaciones')

@section('content')

    <div class="container mt-5">
                {{ $publicaciones->links() }}
      <div class="categorias border mt-5">
        <div class="row">
            @foreach ($publicaciones as $pub)
                @include('components.card', ['pub' => $pub])
            @endforeach

        </div>
      </div>

    </div>

@endsection
