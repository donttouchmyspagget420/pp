        <div class="col-12 col-lg-6">
                <a href="{{ route('publicacion.show', $pub->id) }}"><img src="{{ $pub->getImagen() }}" class="img-fluid"></a>
                <div class="row">
                    <div class="col-6">
                        <h3><strong><i>{{ $pub->titulo }}</i></strong></h3>
                        <i>by <a href="{{ route('perfil.show', $pub['autor']['id']) }}" class="link-{{$color}} fs-5"> {{ $pub['autor']['nombre'] }} </a></i>
                    </div>
                    <div class="col-6 mt-3">
                        <div class="d-flex gap-3">
                            <a href="{{ route('categorias.show', ['categoria' => $pub['categorias']['id']])}}" class="link-{{$color}}"><b> {{ $pub['categorias']['nombre'] }} </b></a>
                            <p class="text-body-secondary">{{ $pub->fecha }}</p>
                        </div>

                        @include('components.likes_guardadas_comments',['likes' => $pub['likes_count'],'guardadas' => $pub['guardadas_count'],'comentarios' => $pub['comentario_count'],'id' => $pub->id])
                        @auth
                            @if(Auth::user()->hasRole(\App\Enums\Roles::Admin->value) || Auth::id() == $pub['autor']['id'])
                                <div class="d-flex gap-2">
                                    <a class="btn btn-outline-warning" href="{{route('publicacion.edit', $pub->id)}}">Modificar</a>
                                    <a class="btn btn-outline-danger" href="{{route('publicacion.destroy', $pub->id)}}">Eliminar</a>
                                </div>
                            @endif
                        @endauth
                    </div>
                </div>
        </div>
