@extends('layouts.template')

@section('title','registrarse')

@section('content')

    <div class="d-flex align-items-center justify-content-center" style="height: 82vh !important;">
      <form class="p-5 border" action="{{ route('auth.register') }}" method="post">
        <h1 class="text-center"><strong>Registrar</strong></h1>
        @csrf
        <div class="input-group input-group-lg mt-5">
          <span class="input-group-text">@</span>
          <input type="text" class="form-control" placeholder="nombre de usuario" name="username" required value="{{ old('username') }}">
          <input type="text" class="form-control" placeholder="nombre completo" name="nombre" required value="{{ old('nombre') }}">
        </div>
        <div class="input-group input-group-lg mt-5">
          <input type="email" class="form-control" placeholder="correo electrónico" name="email" required value="{{ old('email') }}">
          <input type="number" class="form-control" placeholder="número de teléfono" name="phone" value="{{ old('phone') }}">
        </div>
        <div class="input-group input-group-lg mt-5">
          <input type="password" class="form-control" placeholder="contraseña" name="password" required value="{{ old('password') }}">
          <input type="password" class="form-control" placeholder="confirmar la contraseña" name="password_confirmation" required value="{{ old('password_again') }}">
        </div>
        <div class="input-group input-group-lg mt-5">
          <button type="submit" class="btn btn-outline-info mx-auto">Registrar</button>
        </div>
      </form>
    </div>

@endsection


