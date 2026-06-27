                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card">
                        <img src="{{ $pub->getImagen() }}" alt="card-img" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title"><strong>{{ $pub->titulo }}</strong></h5>
                            <hr>
                            <div class="d-flex gap-5">
                                <a href="{{ route('perfil.show', $pub['autor']['id']) }}" class="link-{{ $color }}"><i>{{ $pub['autor']['nombre'] }}</i></a>
                                <div class="d-flex gap-1">
                                    <a href="{{ route('categorias.show', ['categoria' => $pub['categorias']['id']])}}" class="link-{{ $color }}"><b> {{ $pub['categorias']['nombre'] }} </b></a>
                                </div>
                            </div>
                            <p class="card-text text-body-secondary">{{ $pub->descripcion }}
                            </p>
                                @include('components.likes_guardadas_comments',['likes' => $pub['likes_count'],'guardadas' => $pub['guardadas_count'],'comentarios' => $pub['comentario_count'],'id' => $pub->id])
                            <p class="card-text text-body-secondary"><i>{{ $pub->fecha }}</i></p>
                            <hr>
                                    <div class="d-flex gap-5">
                                        <a href="{{ route('publicacion.show',$pub->id) }}" class="btn btn-outline-{{ $color }}" role="button">Leer Más</a>
                                        @auth
                                            @if(Auth::user()->hasRole(\App\Enums\Roles::Admin->value) || Auth::id() == $com['usuario']['id'])
                                                    <a class="btn btn-outline-warning" href="{{route('publicacion.edit', $pub->id)}}">Modificar</a>
                                                    <a class="btn btn-outline-danger" href="{{route('publicacion.destroy', $pub->id)}}">Eliminar</a>
                                            @endif
                                        @endauth
                                    </div>
                        </div>
                    </div>
                </div>
