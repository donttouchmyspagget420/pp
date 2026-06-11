                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card">
                        <img src="{{ $pub->getImagen() }}" alt="card-img" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title"><strong>{{ $pub->titulo }}</strong></h5>
                            <hr>
                            <div class="d-flex gap-5">
                                <a href="{{ route('perfil.show', $pub['autor']['id']) }}" class="link-info"><i>{{ $pub['autor']['nombre'] }}</i></a>
                                <div class="d-flex gap-1">
                                    <a href="{{ route('categorias.show', $pub['categorias']['id'])}}" class="link-info"><b> {{ $pub['categorias']['nombre'] }} </b></a>
                                </div>
                            </div>
                            <p class="card-text text-body-secondary">{{ $pub->descripcion }}
                            </p>
                            <div class="d-flex gap-5">
                                <div class="d-flex gap-3">
                                    <button onclick="icon(this)" class="btn-icon">
                                        <figure>
                                            <img width="25" src="{{ asset('storage/svgs/heart.svg') }}" alt="heart">
                                        </figure>
                                    </button>
                                    <p class="text-body-secondary">{{ $pub['likes_count'] }}</p>
                                </div>
                                <div class="d-flex gap-3">
                                    <button onclick="icon(this)" class="btn-icon">
                                        <figure><img role="button" width="18" src="{{ asset('storage/svgs/bookmark.svg') }}"
                                                alt="bookmark"></figure>
                                    </button>
                                    <p class="text-body-secondary">{{ $pub['guardadas_count'] }}<p>
                                </div>
                                <div class="d-flex gap-3">
                                    <a href="pages/post.html#comment">
                                        <figure><img role="button" width="18" src="{{ asset('storage/svgs/comment.svg') }}"
                                                alt="comments"></figure>
                                    </a>
                                    <p class="text-body-secondary">{{ $pub['comentario_count'] }}</p>
                                </div>
                            </div>
                            <p class="card-text text-body-secondary"><i>{{ $pub->fecha }}</i></p>
                            <hr>
                            <a href="{{ route('categorias.show', $pub['categorias']['id']) }}" class="btn btn-outline-info" role="button">Leer Más</a>
                        </div>
                    </div>
                </div>
