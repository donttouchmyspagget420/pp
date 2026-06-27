        <div class="comment text-start d-flex gap-3">
          <img width="50" height="50" src="{{$com['usuario']->perfilUsuario->getPfp() }}" alt="avatar" class="rounded-circle">
          <div class="container">
            <h4>{{ $com['usuario']['nombre'] }}</h4>
            <a href="{{route('perfil.show',$com['usuario']['id'])}}" class="link-{{$color}} fs-5">{{'@' . $com['usuario']['username'] }}</a>
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
                @auth
                    @if(Auth::user()->hasRole(\App\Enums\Roles::Admin->value) || Auth::id() == $com['usuario']['id'])
                        <div class="d-flex gap-2">
                            <button class="btn btn-outline-warning" onclick="mod(this,'/comentario/edit')">Modificar</button>
                            <a class="btn btn-outline-danger" href="{{route('comentario.destroy', $com->id)}}">Eliminar</a>
                        </div>
                        <div>
                            <form action='' method='post' class="input-group visually-hidden" >
                                @csrf
                                <input type="hidden" value="{{$com->id}}" name="id">
                                <input type="hidden" value="{{$com['usuario']['id']}}" name="fk_autor">
                                <input type="hidden" value="{{$com['fk_publicacion']}}" name="fk_publicacion">
                                <input class='form-control' name='contenido'>
                                <input class='btn btn-outline-{{$color}}' type='submit' value='enviar'>
                            </form>
                        </div>
                    @endif
                @endauth
        </div>
    </div>
