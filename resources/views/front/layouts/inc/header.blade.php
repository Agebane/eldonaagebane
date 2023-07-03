<header class="navigation">   
  <div class="container" >
    <nav class="navbar navbar-expand-lg navbar-light px-0">
      <a class="navbar-brand order-1 py-0" href="/">
        <img loading="prelaod" decoding="async" class="img-fluid" src="{{blogInfo()->blog_logo}}" alt="{{blogInfo()->blog_name}}" style="max-width:100px">
      </a>
      <div class="navbar-actions order-3 ml-0 ml-md-4">
        <button aria-label="navbar toggler" class="navbar-toggler border-0" type="button" data-toggle="collapse"
          data-target="#navigation"> <span class="navbar-toggler-icon"></span>
        </button>
      </div>
      <form action="{{route('search_posts')}}" class="search order-lg-3 order-md-2 order-3 ml-auto">
        <input id="search-query" name="query" value="{{Request('query')}}" type="search" placeholder="Pesquisar..." autocomplete="on">
      </form>
      <div class="collapse navbar-collapse text-center order-lg-2 order-4" id="navigation">
        <ul class="navbar-nav mx-auto mt-3 mt-lg-0">
          <li class="nav-item"> <a class="nav-link" href="/">Inicio</a>
          </li>

             @foreach(\App\Models\Categoria::whereHas('subcategorias',function($q){
               $q->whereHas('posts');
             })->orderBy('ordenando','asc')->get() as $categoria)

          <li class="nav-item dropdown"> <a class="nav-link dropdown-toggle" href="#" role="button"
              data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              {{$categoria->nome_categoria}}
            </a>
            <div class="dropdown-menu"> 
            @foreach(\App\Models\SubCategoria::where('categoria_principal',$categoria->id)
               ->whereHas('posts')->orderBy('ordenando','asc')->get() as $subcategoria)
              <a class="dropdown-item" href="{{route('categoria_posts',$subcategoria->slug)}}">{{$subcategoria->nome_subcategoria}}</a>
              @endforeach
            </div>
          </li>
          @endforeach
          @foreach(\App\Models\SubCategoria::where('categoria_principal',0)
               ->whereHas('posts')->orderBy('ordenando','asc')->get() as $subcategoria)
               <li class="nav-item"> <a class="nav-link" href="{{route('categoria_posts',$subcategoria->slug)}}">{{$subcategoria->nome_subcategoria}}</a>
               </li>
               @endforeach
               <li class="nav-item"> <a class="nav-link" href="contact.html">Contato</a>
          </li>
        </ul>
      </div>
    </nav>
  </div>
</header>


