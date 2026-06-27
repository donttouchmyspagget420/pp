@extends('layouts.template')

@section('title','usuarios')

@section('content')

 <div class="container mt-5" >
      <h1 class="text-start">Gestión de Editores</h1>
      <hr>
    <div class="table-responsive">
      <table class="table mt-5">
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
            <th scope="col"></th>
            <th scope="col">  <a class="btn btn-outline-{{$color}}" href="{{route('perfil.store')}}">Crear</a ></th>
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
       <td> <a class="btn btn-outline-warning" href="{{route('perfil.edit',$usr->id)}}">Modificar</a></td>

       <td> <a class="btn btn-outline-danger" href="{{route('perfil.destroy',$usr->id)}}" >Eliminar</a></td>
            </tr>
            @endforeach
        </tbody>

        {{$data->links()}}
      </table>
</div>


@endsection

