@extends('layouts.template')

@section('title','usuarios')

@section('content')

 <div class="container mt-5" style="min-height:75vh">
      <h1 class="text-start">Gestión de Usuarios</h1>
      <hr>
      <form action="" class="input-group mt-5" method="get">
        <select class="form-select" id="inputGroupSelect02">
          <option selected>Seleccione...</option>
          @foreach($data as $usr)
            <option value="{{$usr->id}}">{{$usr->correo}}</option>
          @endforeach
        </select>
        <input type="radio" class="btn-check" id="btn-check" name="accion" value="modificar">
        <label class="btn btn-outline-warning" for="btn-check">Modificar</label>
        <input type="radio" class="btn-check" id="btn-check2" name="accion" value="eliminar">
        <label class="btn btn-outline-danger" for="btn-check2">Eliminar</label>
        <input type="radio" class="btn-check" id="btn-check3" name="accion" value="crear">
        <label class="btn btn-outline-success" for="btn-check3">Crear un usuario</label>
        <button class="btn btn-outline-info" type="submit">Enviar</button>
      </form>
      <h1 class="d-block d-lg-none mt-5 text-center">No podes verlo si escritorio</h1>
      <table class="table mt-5 d-none d-lg-block">
        <thead>
          <tr>
            <th scope="col">Id</th>
            <th scope="col">Pfp</th>
            <th scope="col">Nombre Completo</th>
            <th scope="col">Username</th>
            <th scope="col">Correo Electrónico</th>
            <th scope="col">Ubicación</th>
            <th scope="col">Educación</th>
            <th scope="col">Número de Teléfono</th>
            <th scope="col">Contraseña</th>
          </tr>
        </thead>
        <tbody>
            @foreach($data as $usr)
            <tr>
                <th scope="row">{{$usr->id}}</th>
                <td>
                  <a href="{{route('dashboard.like',$usr->id)}}"><img src="{{$usr->perfilUsuario->getPfp()}}" alt="pfp" width="32" height="32"
                    class="rounded-circle border border-{{$usr->perfilUsuario->color}} border-2"></a>
                </td>
                <td>{{$usr->nombre}}</td>
                <td>{{'@'.$usr->username}}</td>
                <td>{{$usr->correo}}</td>
                <td>{{$usr->perfilUsuario->ubicacion}}</td>
                <td>{{$usr->perfilUsuario->educacion}}</td>
                <td>{{$usr->perfilUsuario->tele}}</td>
                <td>******************</td>
            </tr>
            @endforeach
        </tbody>

      </table>

        {{$data->links()}}

@endsection

