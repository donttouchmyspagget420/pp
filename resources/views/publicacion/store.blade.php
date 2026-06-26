@extends('layouts.template')

@section('title', 'crear publicacion')

@section('content')

  <form action="/publicacion/store" method="post" enctype="multipart/form-data">
    @csrf
    <div class="container row mx-auto mt-5">
      <div class="col-12 col-md-6">
        <input type="file" class="form-control mt-2" name="imagen" accept="image/*">
      </div>
      <div class="col-12 col-md-6 d-flex justify-content-around align-items-center">
        <div class="row">
        <input class="form-control form-control-lg mb-3" type="text" placeholder="titulo" value="{{old('titulo')}}" name="titulo" required aria-label=".form-control-lg example">
        <select class="form-select" aria-label="Default select example" id="sel"   required name="categoria" >
            @foreach($cats as $cat)
                    <option value="{{$cat->id}}">{{$cat->nombre}}</option>
            @endforeach
        </select>
        <select class="form-select" aria-label="Default select example" id="sel"   required name="etiquetas[]" multiple size="2">
            @foreach($ets as $et)
                    <option value="{{$et->id}}">{{$et->nombre}}</option>
            @endforeach
        </select>
          <div class="d-flex gap-2 fs-4">
            <p class="fst-italic">by</p>
          </div>
            <select class="form-select" aria-label="Default select example" id="sel"   required name="autor" >
                @foreach($usrs as $usr)
                        <option value="{{$usr->id}}">{{$usr->nombre}}</option>
                @endforeach
            </select>
            <input type="date" class="form-control" name="fecha" required value="{{old('fecha')}}">
        </div>
      </div>
    </div>

    <hr class="mt-5">

    <div class="mx-auto d-flex flex-column gap-3 justify-content-around align-items-center w-50">
        <label for="contenido">Contenido</label>
        <textarea id="contenido" name="contenido" required rows="20" class="w-100">
        {{old('contenido')}}
        </textarea>
        <label for="descripcion">Descripcion</label>
        <textarea id="descripcion" name="descripcion" required rows="10" class="w-100">
        {{old('contenido')}}
        </textarea>

    <input type="submit" value="Publicar" class="text-center btn btn-outline-{{$color}}">
    </div>

   </form>

@endsection
