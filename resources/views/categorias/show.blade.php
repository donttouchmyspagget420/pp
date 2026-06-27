@extends('layouts.template')

@section('title','categorias')

@section('content')

    <div class="container mt-5">
      <form action="{{route('categorias.show')}}" method="get" class="input-group rounded-pill">
        <div class="input-group mb-3">
          <select class="form-select" name="categoria">
            <option selected value="">Seleccione una categoría</option>
                @foreach ($categorias as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->nombre }}</option>
                @endforeach
          </select>
        </div>
        <div class="input-group mb-3">
          <select class="form-select" name="etiqueta[]" multiple size="2">
                @foreach ($etiquetas as $et)
                    <option value="{{ $et->id }}">{{ $et->nombre }}</option>
                @endforeach
          </select>
          <button class="btn btn-outline-{{$color}}" type="submit">Buscar</button>
        </div>
      </form>



      <div class="categorias border mt-5">
        <div class="row">
            @foreach ($publicaciones as $pub)
                @include('components.card', ['pub' => $pub])
            @endforeach

            <div class="mt-3">
                {{ $publicaciones->links() }}
            </div>
        </div>
      </div>

    </div>

@endsection
