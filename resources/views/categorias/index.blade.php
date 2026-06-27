@extends('layouts.template')

@section('title','categorias')

@section('content')

 <div class="container mt-5">
      <h1 class="text-start">Gestión de Categorias</h1>
      <hr>
    <div class="table-responsive">
      <table class="table mt-5">
        <thead>
          <tr>
            <th scope="col">Id</th>
            <th scope="col">Nombre</th>
            <th scope="col"></th>
            <th scope="col"></th>
            <th scope="col"><button class="btn btn-outline-{{$color}}" onclick="mod(this,'/categoria/store')">Crear</button></th>
            <th scope="col">
                <form action='' method='post' class="input-group visually-hidden" >
                    @csrf
                    <input class='form-control' name='nombre'>
                    <input class='btn btn-outline-{{$color}}' type='submit' value='enviar'>
                </form>
            </th>
          </tr>
        </thead>
        <tbody>
            @foreach($categorias as $cat)
                <tr>
                    <th scope="row">{{$cat->id}}</th>
                    <td>{{$cat->nombre}}</td>
                    <td><a class="btn btn-outline-danger" href="{{route('categoria.destroy', $cat->id)}}">Eliminar</a></td>
                    <td><a class="btn btn-outline-{{$color}}" href="{{route('categorias.show', $cat->id)}}">Ver</a></td>
                    <td><button type="button" class="btn btn-outline-warning" onclick="mod(this,'/categoria/edit')">Modificar</button></td>
                    <td>
                        <form action='' method='post' class="input-group visually-hidden" >
                            @csrf
                            <input type="hidden" value="{{$cat->id}}" name="id">
                            <input class='form-control' name='nombre'>
                            <input class='btn btn-outline-{{$color}}' type='submit' value='enviar'>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
      </table>
      <h1 class="text-start">Gestión de Etiquetas</h1>
      <table class="table mt-5 ">
        <thead>
          <tr>
            <th scope="col">Id</th>
            <th scope="col">Nombre</th>
           <th scope="col"><th scope="col"> <th scope="col"><button class="btn btn-outline-{{$color}}" onclick="mod(this,'/etiqueta/store')">Crear</button></th> </th>    </th>
            <th scope="col">
                <form action='' method='post' class="input-group visually-hidden" >
                    @csrf
                    <input class='form-control' name='nombre'>
                    <input class='btn btn-outline-{{$color}}' type='submit' value='enviar'>
                </form>
            </th>
          </tr>
        </thead>
        <tbody>
            @foreach($etiquetas as $et)
                <tr>
                    <th scope="row">{{$et->id}}</th>
                    <td>{{$et->nombre}}</td>
                    <td><a class="btn btn-outline-danger" href="{{route('etiqueta.destroy', $et->id)}}">Eliminar</a></td>
                    <td><a class="btn btn-outline-{{$color}}" href="{{route('categorias.show', $et->id)}}">Ver</a></td>
                    <td><button type="button" class="btn btn-outline-warning" onclick="mod(this,'/etiqueta/edit')">Modificar</button></td>
                    <td>
                        <form action='' method='post' class="input-group visually-hidden" >
                            @csrf
                            <input type="hidden" value="{{$et->id}}" name="id">
                            <input class='form-control' name='nombre'>
                            <input class='btn btn-outline-{{$color}}' type='submit' value='enviar'>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>

      </table>
</div>

@endsection





