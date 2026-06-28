                                    <div class="d-flex gap-3">
                                        <a href="{{route('publicacion.show', $id) . '#comment'}}">
                                            <figure><img role="button" width="18" src="{{ asset('storage/svgs/comment-'.$color.'.svg') }}"
                                                    alt="comments"></figure>
                                        </a>
                                        <p class="text-body-secondary">{{$comentarios}}</p>
                                    </div>
