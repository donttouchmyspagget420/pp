                                <div class="d-flex gap-5">
                                    @include('components.likes',['id' => $id,'likes' => $likes])
                                    @include('components.guardadas',['id' => $id,'guardadas' => $guardadas])
                                    @include('components.comentarios',['id' => $id,'comentarios' => $comentarios])
                                </div>
