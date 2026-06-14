@extends('layouts.template')

@section('title','home')

@section('content')
    @if(session('success'))
        <div class="alert alert-success" role="alert">
            <strong>{{ session('success') }}</strong>
        </div>
    @endif

    <h1 class="text-center"><strong>Top Noticias</strong></h1>

     <div class="container row mx-auto mt-5">

     @include('components.head_publicacion', ['pub' => $tops[0]])

            <div class="col-12 col-lg-6">
                <ol class="list-group list-group-flush">

                @for ($i = 1; $i < 5; $i++)
                    @include('components.small-head_publicacion', ['pub' => $tops[$i]])
                @endfor

                </ol>
            </div>
    </div>


    <hr class="mt-5">

    <h1 class="text-center mt-5"><strong>Noticas recientes</strong></h1>

    <div class="container mx-auto">
        <div class="row mt-5">
            @foreach ($recientes as $reciente)
                @include('components.card', ['pub' => $reciente])
            @endforeach
        </div>
    </div>



@endsection
