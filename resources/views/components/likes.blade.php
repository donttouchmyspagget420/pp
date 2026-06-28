                                    <div class="d-flex gap-3">
                                        <a href="{{route('publicacion.like', ['idUsuario' => Auth::id() ?? 0,'idPublicacion' => $id])}}" class="btn-icon">
                                            <figure>
                                            @if(Auth::user()->likePublicacion->contains($id))
                                                <img width="25" src="{{ asset('storage/svgs/heart-filled-'.$color.'.svg') }}" alt="heart">
                                            @else
                                                <img width="25" src="{{ asset('storage/svgs/heart-'.$color.'.svg') }}" alt="heart">
                                            @endif
                                            </figure>
                                        </a>
                                        <p class="text-body-secondary">{{$likes}}</p>
                                    </div>
