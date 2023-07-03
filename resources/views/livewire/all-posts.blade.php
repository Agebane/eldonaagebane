<div>

<div class="row">
<div class="col-md-6 mb-3">
    <label for="" class="form-label">Pesquisar</label>
    <input type="text" class="form-control" placeholder="pesquisar" wire:model='pesquisar'>
</div>


<div class="col-md-2 mb-3">
    <label for="" class="form-label">Categoria</label>
    <select class="form-select" wire:model='categoria'>
    <option value="">Não selecionado</option>  
    @foreach(\App\Models\Subcategoria::whereHas('posts')->get() as $categoria)  
        <option value="{{$categoria->id}}">{{$categoria->nome_subcategoria}}</option>
    @endforeach
    
    </select>
</div>

@if(auth()->user()->type==1)
<div class="col-md-2 mb-3">
    <label for="" class="form-label">Usuário</label>
    <select class="form-select" wire:model='usuario'>
        <option value="">Não selecionado</option>
        @foreach(\App\Models\User::whereHas('posts')->get() as $usuario)  
        <option value="{{$usuario->id}}">{{$usuario->name}}</option>
    @endforeach
    </select>
</div>
@endif




<div class="col-md-2 mb-3">
    <label for="" class="form-label">Ordernar</label>
    <select class="form-select" wire:model='ordenar'>
        <option value="asc">Crescente</option>
        <option value="desc">Decrescente</option>
    </select>
</div>


</div>
   
   <div class="row row-cards">
   
   
   @forelse($posts as $post)
   <div class="col-md-6 col-lg-3">
   <div class="card">
       <img src="/storage/images/post_images/{{$post->featured_image}}" alt="" class="card-img-top">
       <div class="card-body p-2">
   
       <h3 class="m-0 mb-1">{{$post->post_title}}</h3>
       </div>
       <div class="d-flex">
           <a href="{{route('author.posts.edit-post',['post_id'=>$post->id])}}" class="card-btn">Editar</a>
           <a href="" wire:click.prevent='deletePost({{$post->id}})' class="card-btn">Apagar</a>
   
       </div>
   </div>
   
   </div>
   @empty
   
   <span class="text-danger">Nenhuma Publicação encontrada</span>
   @endforelse
   </div>

   <div class="d-block mt-2">
   {{$posts->links('livewire::simple-bootstrap')}}

   </div>
   
   </div>