        <div class="col-12 col-lg-6">
                <a href="{{ route('publicacion.show', $pub->id) }}"><img src="{{ $pub->getImagen() }}" class="img-fluid"></a>
                <div class="row">
                    <div class="col-8">
                        <h2><strong><i>{{ $pub->titulo }}</i></strong></h2>
                        <a href="{{ route('perfil.show', $pub['autor']['id']) }}" class="link-{{$color}} fs-5"><i> {{ $pub['autor']['nombre'] }} </i></a>
                    </div>
                    <div class="col-4 mt-3">
                        <div class="d-flex gap-3">
                            <a href="{{ route('categorias.show', ['categoria' => $pub['categorias']['id']])}}" class="link-{{$color}}"><b> {{ $pub['categorias']['nombre'] }} </b></a>
                            <p class="text-body-secondary">{{ $pub->fecha }}</p>
                        </div>

                        @include('components.likes_guardadas_comments',['likes' => $pub['likes_count'],'guardadas' => $pub['guardadas_count'],'comentarios' => $pub['comentario_count'],'id' => $pub->id])
                    </div>
                </div>
        </div>
