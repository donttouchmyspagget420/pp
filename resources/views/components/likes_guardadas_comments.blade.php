                                <div class="d-flex gap-5">
                                    <div class="d-flex gap-3">
                                        <button onclick="icon(this)" class="btn-icon">
                                            <figure>
                                                <img width="25" src="{{ asset('storage/svgs/heart-'.$color.'.svg') }}" alt="heart">
                                            </figure>
                                        </button>
                                        <p class="text-body-secondary">{{$likes}}</p>
                                    </div>
                                    <div class="d-flex gap-3">
                                        <button onclick="icon(this)" class="btn-icon">
                                            <figure><img role="button" width="18" src="{{ asset('storage/svgs/bookmark-'.$color.'.svg') }}"
                                                    alt="bookmark"></figure>
                                        </button>
                                        <p class="text-body-secondary">{{$guardadas}}</p>
                                    </div>
                                    <div class="d-flex gap-3">
                                        <a href="pages/post.html#comment">
                                            <figure><img role="button" width="18" src="{{ asset('storage/svgs/comment-'.$color.'.svg') }}"
                                                    alt="comments"></figure>
                                        </a>
                                        <p class="text-body-secondary">{{$comentarios}}</p>
                                    </div>
                                </div>
