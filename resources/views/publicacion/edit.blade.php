@extends('layouts.template')

@section('title', $pub->titulo)

@section('content')

  <form action="/publicacion/edit" method="post" enctype="multipart/form-data">
    @csrf
    <input type="hidden" value="{{$pub['id']}}" name="id">
    <div class="container row mx-auto mt-5">
      <div class="col-12 col-md-6">
        <img src="{{ $pub->getImagen() }}" class="img-fluid">
        <input type="file" class="form-control mt-2" name="imagen" accept="image/*">
      </div>
      <div class="col-12 col-md-6 d-flex justify-content-around align-items-center">
        <div class="row">
        <input class="form-control form-control-lg mb-3" type="text" placeholder="titulo" value="{{ $pub->titulo }}" name="titulo" required aria-label=".form-control-lg example">
        <select class="form-select" aria-label="Default select example" id="sel"   required name="categoria" >
            <option selected value="{{ $pub['categorias']['id'] }}">{{ $pub['categorias']['nombre'] }}</option>
            @foreach($cats as $cat)
                    <option value="{{$cat->id}}">{{$cat->nombre}}</option>
            @endforeach
        </select>
        <select class="form-select" aria-label="Default select example" id="sel"   required name="etiquetas[]" multiple size="2">
            @foreach($pub['etiquetas'] as $et)
                    <option selected value="{{$et->id}}">{{$et->nombre}}</option>
            @endforeach
            @foreach($ets as $et)
                    <option value="{{$et->id}}">{{$et->nombre}}</option>
            @endforeach
        </select>
          <div class="d-flex gap-2 fs-4">
            <p class="fst-italic">by</p>
          </div>
            <select class="form-select" aria-label="Default select example" id="sel"   required name="autor" >
                <option selected value="{{ $pub['autor']['id'] }}">{{ $pub['autor']['nombre'] }}</option>
                @foreach($usrs as $usr)
                        <option value="{{$usr->id}}">{{$usr->nombre}}</option>
                @endforeach
            </select>
            <input type="date" class="form-control" name="fecha" required value="{{ $pub->fecha }}">
        </div>
      </div>
    </div>

    <hr class="mt-5">

    <div class="mx-auto d-flex flex-column gap-3 justify-content-around align-items-center w-50">
        <label for="contenido">Contenido</label>
        <textarea id="contenido" name="contenido" required rows="20" class="w-100">
                {!! $pub->contenido !!}
        </textarea>
        <label for="descripcion">Descripcion</label>
        <textarea id="descripcion" name="descripcion" required rows="10" class="w-100">
                {{ $pub->descripcion }}
        </textarea>

    <input type="submit" value="Publicar" class="text-center btn btn-outline-{{$color}}">
    </div>

   </form>

@endsection
