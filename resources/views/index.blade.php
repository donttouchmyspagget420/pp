@extends('layouts.template')

@section('title','baseball, huh?')

@section('content')

    <h1 class="text-center"><strong>Top Noticias</strong></h1>


 <a href="pages/post.html"><img src="{{ asset('storage/') }}" class="img-fluid"></a>
        <div class="row">
          <div class="col-4">
            <h1><strong><i>Title</i></strong></h1>
            <a href="pages/perfil.html" class="link-info fs-3">John News</a>
          </div>
          <div class="col-4 mt-3">
            <div class="d-flex gap-1">
              <a href="pages/categorias.html" class="link-info">Cat</a>
              <a href="pages/categorias.html" class="link-info">|</a>
              <a href="pages/categorias.html" class="link-info">Tag</a>
              <p class="text-body-secondary">69.69.4200</p>
            </div>
            <div class="d-flex gap-5">
              <div class="d-flex gap-3">
                <button onclick="icon(this)" class="btn-icon">
                  <figure>
                    <img width="25" src="imgs/svgs/heart.svg" alt="heart">
                  </figure>
                </button>
                <p class="text-body-secondary">69</p>
              </div>
              <div class="d-flex gap-3">
                <button onclick="icon(this)" class="btn-icon">
                  <figure><img role="button" width="18" src="imgs/svgs/bookmark.svg" alt="bookmark"></figure>
                </button>
                <p class="text-body-secondary">69</p>
              </div>
              <div class="d-flex gap-3">
                <a href="pages/post.html#comment">
                  <figure><img role="button" width="18" src="imgs/svgs/comment.svg" alt="comments"></figure>
                </a>
                <p class="text-body-secondary">69</p>
              </div>
            </div>

          </div>
        </div>



@endsection
