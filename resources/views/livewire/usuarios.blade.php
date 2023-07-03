<div>
<div class="page-header d-print-none mb-2">
            <div class="row align-items-center">
              <div class="col">
                <h2 class="page-title">
                  Usuários
                </h2>
                
              </div>
              <!-- Page title actions -->
              <div class="col-auto ms-auto d-print-none">
                <div class="d-flex">
                  <input type="search" class="form-control d-inline-block w-9 me-3" placeholder="Pesquisar Usuário" wire:model='search'>
                  <a href="#" class="btn btn-primary" data-bs-target='#ad_usuario_modal' data-bs-toggle='modal'>
                    <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                     Novo usuário
                  </a>
                </div>
              </div>
            </div>
          </div>


          <div class="row row-cards">
          @forelse($usuarios as $usuario)

         


              <div class="col-md-6 col-lg-3">
                <div class="card">
                  <div class="card-body p-4 text-center">
                    <span class="avatar avatar-xl mb-3 avatar-rounded" style="background-image: url({{$usuario->picture}})"></span>
                    <h3 class="m-0 mb-1"><a href="#">{{$usuario->name}}</a></h3>
                    <div class="text-muted">{{$usuario->email}}</div>
                    <div class="mt-3">
                      <span class="badge bg-purple-lt">{{$usuario->authorType->name}}</span>
                    </div>
                  </div>
                  <div class="d-flex">
                    <a href="#" wire:click.prevent='editarUsuario({{$usuario}})'  class="card-btn">Editar</a>
                    <a href="#" wire:click.prevent='apagarUsuario({{$usuario}})' class="card-btn" >Apagar</a>
                  </div>
                </div>
              </div>


              @empty
              <span class="text-danger">Usuario não foi encontrado!</span>
              @endforelse
              
            </div>   
            
            <div class="row mt-4">

            {{$usuarios->links('livewire::simple-bootstrap')}}
            </div>





            {{--Modals--}}

       <div wire:ignore.self class="modal modal-blur fade" id="ad_usuario_modal" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Adicionar Usuário</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form wire:submit.prevent='addUsuario()' method="post">
            <div class="mb-3">
            <label class="form-label">Nome</label>
            <input type="text" class="form-control" name="example-text-input" placeholder="Digite nome" wire:model='name'>
            <span class="text-danger">@error('name') {{ $message }} @enderror</span>
            </div>
            <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="text" class="form-control" name="example-text-input" placeholder="Digite email" wire:model='email'>
            <span class="text-danger">@error('email') {{ $message }} @enderror</span>
            </div>
            <div class="mb-3">
            <label class="form-label">Nome de Usuário</label>
            <input type="text" class="form-control" name="example-text-input" placeholder="Digite nome de usuário" wire:model='username' >
            <span class="text-danger">@error('username') {{ $message }} @enderror</span>
            </div>

            <div class="form-group mb-3 ">
                      <label class="form-label">Tipo de Usuário</label>
                      <div>
                        <select class="form-select" wire:model='author_type' >
                          <option value="">Não selecinado</option>
                          @foreach(\App\Models\Type::all() as $type)
                          <option value="{{$type->id}}">{{$type->name}}</option>

                          @endforeach
                        </select>
                      </div>
                      <span class="text-danger">@error('author_type') {{ $message }} @enderror</span>
                    </div>

                    <div class="mb-3">
                            <div class="form-label">Editor direto</div>
                            <div>
                              <label class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="direct_publisher" value="0"  wire:model='direct_publisher'>
                                <span class="form-check-label">Não</span>
                              </label>
                              <label class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="direct_publisher" value="1" wire:model='direct_publisher'>
                                <span class="form-check-label">Sim</span>
                              </label>
                            </div>
                            <span class="text-danger">@error('direct_publisher') {{ $message }} @enderror</span>
                          </div>

                          <div class="modal-footer">
            <button type="button" class="btn me-auto" data-bs-dismiss="modal">Sair</button>
            <button type="submit" class="btn btn-primary">Guardar</button>
          </div>      


            </form> 

          </div>
          
        </div>
      </div>
    </div>


    <div wire:ignore.self class="modal modal-blur fade" id="editar_usuario_modal" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Editar Usuário</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form wire:submit.prevent='atualizarUsuario()' method="post">
              <input type="hidden" wire:model='selected_author_id'>
            <div class="mb-3">
            <label class="form-label">Nome</label>
            <input type="text" class="form-control" name="example-text-input" placeholder="Digite nome" wire:model='name'>
            <span class="text-danger">@error('name') {{ $message }} @enderror</span>
            </div>
            <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="text" class="form-control" name="example-text-input" placeholder="Digite email" wire:model='email'>
            <span class="text-danger">@error('email') {{ $message }} @enderror</span>
            </div>
            <div class="mb-3">
            <label class="form-label">Nome de Usuário</label>
            <input type="text" class="form-control" name="example-text-input" placeholder="Digite nome de usuário" wire:model='username' >
            <span class="text-danger">@error('username') {{ $message }} @enderror</span>
            </div>

            <div class="form-group mb-3 ">
                      <label class="form-label">Tipo de Usuário</label>
                      <div>
                        <select class="form-select" wire:model='author_type' >
                          @foreach(\App\Models\Type::all() as $type)
                          <option value="{{$type->id}}">{{$type->name}}</option>

                          @endforeach
                        </select>
                      </div>
                      <span class="text-danger">@error('author_type') {{ $message }} @enderror</span>
                    </div>

                    <div class="mb-3">
                            <div class="form-label">Editor direto</div>
                            <div>
                              <label class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="direct_publisher" value="0"  wire:model='direct_publisher'>
                                <span class="form-check-label">Não</span>
                              </label>
                              <label class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="direct_publisher" value="1" wire:model='direct_publisher'>
                                <span class="form-check-label">Sim</span>
                              </label>
                            </div>
                            <span class="text-danger">@error('direct_publisher') {{ $message }} @enderror</span>
                          </div>

                          <div class="mb-3">
                            <div class="form-label">Bloqueio</div>
                            <label class="form-check form-switch">
                              <input class="form-check-input" type="checkbox" checked="" wire:model='block'>
                              <span class="form-check-label"></span>
                            </label>
                           
                          </div>


                          <div class="modal-footer">
            <button type="button" class="btn me-auto" data-bs-dismiss="modal">Sair</button>
            <button type="submit" class="btn btn-primary">Atualizar</button>
          </div>      


            </form> 

          </div>
          
        </div>
      </div>
    </div>


</div>
