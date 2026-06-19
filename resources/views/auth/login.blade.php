@extends('layouts.template')

@section('title','loguearse')

@section('content')

@if ($errors->any())
    <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <p><strong>{{ $error }}</strong></p>
            @endforeach
    </div>
@endif

    <div class="d-flex align-items-center justify-content-center" style="height: 82vh !important;">
      <form class="p-5 border" action="/auth/login" method="post">
        <h1 class="text-center"><strong>Log In</strong></h1>
        <div class="input-group input-group-lg mt-5">
          <input type="email" class="form-control" placeholder="correo electrónico" name="correo">
        </div>
        <div class="input-group input-group-lg mt-5">
          <input type="password" class="form-control" placeholder="contraseña" name="password">
        </div>
        <div class="input-group input-group-lg mt-5">
          <button type="submit" class="btn btn-{{$color}} mx-auto">Log In</button>
        </div>
      </form>
    </div>

@endsection


