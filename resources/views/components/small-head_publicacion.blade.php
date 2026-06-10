                <li class="list-group-item">
                        <div class="container row">
                            <div class="col-8">
                                <h6><strong>{{ $pub->titulo }}</strong></h6>
                                <div class="d-flex gap-3">
                                    <a href="{{ route('perfil.show', $pub['autor']['id']) }}" class="link-info">{{ $pub['autor']['nombre'] }}</a>
                                    <div class="d-flex gap-1">
                                        <a href="{{ route('categorias.show', $pub['categorias']['id'])}}" class="link-info">{{ $pub['categorias']['nombre'] }}</a>
                                    </div>
                                    <p class="text-body-secondary">{{ $pub->fecha }}</p>
                                </div>
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
                                        <p class="text-body-secondary">{{ $pub['guardadas_count'] }}</p>
                                    </div>
                                    <div class="d-flex gap-3">
                                        <a href="pages/post.html#comment">
                                            <figure><img role="button" width="18" src="{{ asset('storage/svgs/comment.svg') }}"
                                                    alt="comments"></figure>
                                        </a>
                                        <p class="text-body-secondary">{{ $pub['comentario_count'] }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4"><a href="{{ route('publicacion.show', $pub->id) }}"><img src="{{ $pub->getImagen() }}"
                                        alt="not" class="img-fluid"></a></div>
                        </div>
                    </li>
