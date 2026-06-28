                                    <div class="d-flex gap-3">
                                        <a href="{{route('publicacion.bookmark', ['idUsuario' => Auth::id() ?? 0,'idPublicacion' => $id])}}" class="btn-icon">
                                            <figure>
                                            @if(Auth::user()->guardadasPublicacion->contains($id))
                                            <img role="button" width="18" src="{{ asset('storage/svgs/bookmark-filled-'.$color.'.svg') }}"
                                                    alt="bookmark">
                                            @else
                                            <img role="button" width="18" src="{{ asset('storage/svgs/bookmark-'.$color.'.svg') }}"
                                                    alt="bookmark">
                                            @endif
                                            </figure>
                                        </a>
                                        <p class="text-body-secondary">{{$guardadas}}</p>
                                    </div>
