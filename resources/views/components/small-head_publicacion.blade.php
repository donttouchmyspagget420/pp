                <li class="list-group-item">
                        <div class="container row">
                            <div class="col-8">
                                <h6><strong>{{ $pub->titulo }}</strong></h6>
                                <div class="d-flex gap-3">
                                    <a href="{{ route('perfil.show', $pub['autor']['id']) }}" class="link-{{$color}}">{{ $pub['autor']['nombre'] }}</a>
                                    <div class="d-flex gap-1">
                                        <a href="{{ route('categorias.show', ['categoria' => $pub['categorias']['id']])}}" class="link-{{$color}}">{{ $pub['categorias']['nombre'] }}</a>
                                    </div>
                                    <p class="text-body-secondary">{{ $pub->fecha }}</p>
                                </div>
                                @include('components.likes_guardadas_comments',['likes' => $pub['likes_count'],'guardadas' => $pub['guardadas_count'],'comentarios' => $pub['comentario_count']])
                            </div>
                            <div class="col-4"><a href="{{ route('publicacion.show', $pub->id) }}"><img src="{{ $pub->getImagen() }}" alt="img" class="img-fluid"></a></div>
                        </div>
                    </li>
