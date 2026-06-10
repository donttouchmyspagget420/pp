        <div class="col-12 col-lg-6">
                <a href="{{ route('publicacion.show', $pub->id) }}"><img src="{{ $pub->getImagen() }}" class="img-fluid"></a>
                <div class="row">
                    <div class="col-4">
                        <h2><strong><i>{{ $pub->titulo }}</i></strong></h2>
                        <a href="{{ route('perfil.show', $pub['autor']['id']) }}" class="link-info fs-5"><i> {{ $pub['autor']['nombre'] }} </i></a>
                    </div>
                    <div class="col-4 mt-3">
                        <div class="d-flex gap-3">
                            <a href="{{ route('categorias.show', $pub['categorias']['id'])}}" class="link-info"><b> {{ $pub['categorias']['nombre'] }} </b></a>
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
                                    <figure><img role="button" width="18" src="{{ asset('storage/svgs/bookmark.svg') }}" alt="bookmark">
                                    </figure>
                                </button>
                                <p class="text-body-secondary">{{ $pub['guardadas_count'] }}</p>
                            </div>
                            <div class="d-flex gap-3">
                                <a href="{{ route('publicacion.show', $pub->id) . '#comment' }}">
                                    <figure><img role="button" width="18" src="{{ asset('storage/svgs/comment.svg') }}" alt="comments">
                                    </figure>
                                </a>
                                <p class="text-body-secondary">{{ $pub['comentario_count'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
