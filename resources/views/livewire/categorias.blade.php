<div>
<div class="row mt-3">
          <div class="col-md-6 mb-3">

          <div class="card">
                      <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs">
                          <h4>Categorias</h4>
                         
                          <li class="nav-item ms-auto">
                            <a href="" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#categoria_modal">Adicionar categoria</a>
                          </li>
                        </ul>
                      </div>
                      <div class="card-body">
                      <div class="table-responsive">
                    <table class="table table-vcenter card-table table-striped">
                      <thead>
                        <tr>
                          <th>Nome de categoria</th>
                          <th>N. de subcategoria</th>
                          <th class="w-1"></th>
                        </tr>
                      </thead>
                      <tbody id="sortable_category">
                      @forelse($categorias as $categoria)

                     

                        <tr data-index="{{$categoria->id}}" data-ordering="{{$categoria->ordenando}}">
                          <td>{{$categoria->nome_categoria}}</td>
                          <td class="text-muted">
                          {{$categoria->subcategorias->count()}}
                          </td>
                          <td>
                            <div class="btn-group">
                            <a href="#" class="btn btn-sm btn-primary" wire:click.prevent='editarCategoria({{$categoria->id}})'
                            >Editar</a> &nbsp;
                            <a href="#" wire:click.prevent='deleteCategoria({{$categoria->id}})' class="btn btn-sm btn-danger">Apagar</a>
                            </div>
                           
                          </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3"> <span class="text-danger">Nenhuma categoria encontrada</span> </td>
                        </tr>

                      @endforelse 
                      </tbody>
                    </table>
                  </div>
                      </div>
                    </div>

          </div>
          <div class="col-md-6 mb-3">
          <div class="card">
                      <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs">
                          <h4>Subcategorias</h4>
                         
                          <li class="nav-item ms-auto">
                            <a href="" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#subcategoria_modal">Adicionar subcategoria</a>
                          </li>
                        </ul>
                      </div>
                      <div class="card-body">
                        
                      <div class="table-responsive">
                    <table class="table table-vcenter card-table table-striped">
                      <thead>
                        <tr>
                          <th>Nome de subcategoria</th>
                          <th>Categoria principal</th>
                          <th>N. de publicação</th>

                          <th class="w-1"></th>
                        </tr>
                      </thead>
                      <tbody id="sortable_subcategory">
                      @forelse($subcategorias as $subcategoria)
                      
                        <tr data-index="{{$subcategoria->id}}" data-ordering="{{$subcategoria->ordenando}}">
                          <td>{{$subcategoria->nome_subcategoria}}</td>
                          <td class="text-muted">
                          {{$subcategoria->categoria_principal !=0 ? $subcategoria->categoriaprincipal->nome_categoria :'-'}}
                          

                          </td>
                          <td>
                          {{$subcategoria->posts->count()}}
                          
                          </td>
                          <td>
                            <div class="btn-group">
                            <a href="#" class="btn btn-sm btn-primary" 
                            wire:click.prevent='editarSubCategoria({{$subcategoria->id}})'>Editar</a> &nbsp;
                            <a href="#" wire:click.prevent='deleteSubCategoria({{$subcategoria->id}})'  class="btn btn-sm btn-danger">Apagar</a>
                            </div>
                           
                          </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4"> <span class="text-danger">Nenhuma subcategoria encontrada</span> </td>
                        </tr>

                      @endforelse 
    
                      </tbody>
                    </table>
                  </div>
                      </div>
                    </div>
          </div>
          </div>

    <div wire:ignore.self class="modal modal-blur fade" id="categoria_modal" tabindex="-1" role="dialog" aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="false">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <form class="modal-content" method="POST"
        @if($updateCategoriaMode)
        wire:submit.prevent='atualizarCategoria()'
        @else
        wire:submit.prevent='adicianarCategoria()'
        @endif
        
        >
          <div class="modal-header">
            <h5 class="modal-title">{{ $updateCategoriaMode ? 'Atualizar categoria' : 'Adicionar categoria' }}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
          @if($updateCategoriaMode)
          <input type="hidden" wire:model='selected_categoria_id'>
          @endif


          <div class="mb-3">
        <label class="form-label">Nome de categoria</label>
        <input type="text" class="form-control" name="example-text-input" placeholder="Digite nome de categoria"
        wire:model='nome_categoria'>
        <span class="text-danger">@error('nome_categoria'){{$message}}@enderror</span>
         </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn me-auto" data-bs-dismiss="modal">Fechar</button>
            <button type="submit" class="btn btn-primary">{{ $updateCategoriaMode ? 'Atualizar' : 'Save' }}

            </button>
          </div>
         </form>
      </div>
    </div>


    <div wire:ignore.self class="modal modal-blur fade" id="subcategoria_modal" tabindex="-1" role="dialog" aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="false">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <form class="modal-content" method="POST"
        @if($updateSubCategoriaMode)
        wire:submit.prevent='atualizarSubCategoria()'
        @else
        wire:submit.prevent='adicionarSubCategoria()'
        @endif
        
        
        >
          <div class="modal-header">
            <h5 class="modal-title">{{ $updateSubCategoriaMode ? 'Atualizar Subcategoria' : 'Adicionar Subcategoria' }}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
          @if($updateSubCategoriaMode)
          <input type="hidden" wire:model='selected_subcategoria_id'>
          @endif

          <div class="mb-3">
                              <div class="form-label">Categoria principal</div>
                              <select class="form-select" wire:model="categoria_principal">
                              
                              <option value="0">--semcategoria--</option>
                              
                              @foreach(\App\Models\Categoria::all() as $categoria)
                              <option value="{{$categoria->id}}">{{$categoria->nome_categoria}}</option>
                              @endforeach

                              </select>
                              <span class="text-danger">@error('categoria_principal'){{$message}}@enderror</span>
                    </div>

                <div class="mb-3">
               <label class="form-label">Nome de subcategoria</label>
               <input type="text" class="form-control" name="example-text-input" placeholder="Digite nome de subcategoria"
               wire:model="nome_subcategoria">
               <span class="text-danger">@error('nome_subcategoria'){{$message}}@enderror</span>
               </div>
                </div>
          <div class="modal-footer">
            <button type="button" class="btn me-auto" data-bs-dismiss="modal">Fechar</button>
            <button type="submit" class="btn btn-primary">{{ $updateSubCategoriaMode ? 'Atualizar' : 'Save' }}</button>
          </div>
          </form>
      </div>
    </div>   



</div>
