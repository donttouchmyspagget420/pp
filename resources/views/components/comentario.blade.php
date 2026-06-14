        <div class="comment text-start d-flex gap-3">
          <img width="50" height="50" src="{{$com['usuario']->perfilUsuario->getPfp() }}" alt="avatar" class="rounded-circle">
          <div class="container">
            <h4>{{ $com['usuario']['nombre'] }}</h4>
            <a href="perfil.html?username=" class="link-{{$color}} fs-5">{{ $com['usuario']['username'] }}</a>
            <p class="fs-6">
                {{ $com->contenido }}
            </p>
            <div class="d-flex gap-5">
              <div class="d-flex gap-2">
                <button class="btn-icon" onclick="icon(this)">
                  <figure><img src="{{ asset('storage/svgs/heart-'.$color.'.svg') }}" alt="heart" width="25"></figure>
                </button>
                <p>{{ $com['likes_count'] }}</p>
              </div>
            </div>
        </div>
    </div>
