@extends('front.layouts.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle: 'ver publicação')
@section('content')

<div class="row">
				<div class="col-lg-8 mb-5 mb-lg-0">
					<article>
						<img loading="lazy" decoding="async" src="/storage/images/post_images/{{$post->featured_image}}" alt="Post Thumbnail" class="w-100">
						<ul class="post-meta mb-2 mt-4">
							<li>
								<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" style="margin-right:5px;margin-top:-4px" class="text-dark" viewBox="0 0 16 16">
									<path d="M5.5 10.5A.5.5 0 0 1 6 10h4a.5.5 0 0 1 0 1H6a.5.5 0 0 1-.5-.5z"></path>
									<path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM2 2a1 1 0 0 0-1 1v11a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1H2z"></path>
									<path d="M2.5 4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H3a.5.5 0 0 1-.5-.5V4z"></path>
								</svg> <span>{{date_formatter($post->created_at)}}</span>
							</li>
						</ul>
						<h1 class="my-3">{{($post->post_title)}}</h1>
						
						<div class="content text-left">
							
						<p>{!! $post->post_content!!}</p>	
							
						</div>
					</article>
					<h3><a href="/">Voltar</a> </h3>

@if(count($related_posts)>0)
<div class="widget-list mt-5">
	<h2 class="mb-2">Publicação relacionado</h2>
	
	@foreach($related_posts as $item)
<a class="media align-items-center" href="{{route('read_post',['post_id'=>$item->id])}}">
<img loading="lazy" decoding="async" src="/storage/images/post_images/{{$item->featured_image}}" alt="Post Thumbnail" class="w-100">
<div class="media-body ml-3">
<h3 style="margin-top:-5px">{{($item->post_title)}}</h3>
<p class="mb-0 small">{!! Str::ucfirst(words($item->post_content,20)) !!}</p>
</div> 
</a>
@endforeach
</div>
@endif
					<div class="mt-5">
					<div id="disqus_thread"></div>
<script>
    /**
    *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
    *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables    */
    
    var disqus_config = function () {
    this.page.url ="{{route('read_post',$post->post_slug)}}";  // Replace PAGE_URL with your page's canonical URL variable
    this.page.identifier ="{{$post->id}}"; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
    };

    (function() { // DON'T EDIT BELOW THIS LINE
    var d = document, s = d.createElement('script');
    s.src = 'https://eldona-site.disqus.com/embed.js';
    s.setAttribute('data-timestamp', +new Date());
    (d.head || d.body).appendChild(s);
    })();
</script>
<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
						
					</div>
				</div>
        <div class="col-lg-4">
  <div class="widget-blocks">
    <div class="row">
      <div class="col-lg-12">
        <div class="widget">
          <div class="widget-body">
		  <img loading="lazy" decoding="async" src="/front/images/boss.jpg" alt="About Me" class="w-100 author-thumb-sm d-block">
            <h2 class="widget-title my-3">Eliseu Agebane</h2>
            <p class="mb-3 pb-2">Licenciado em Engenharia Informática pelo Instituto de formação superior Bimantecs Tenho dominio em Rede de computadores...
            </p> <a href="about.html" class="btn btn-sm btn-outline-primary">Saber
              mais</a>
          </div>
        </div>
      </div>
      <div class="col-lg-12 col-md-6">
        <div class="widget">
          <h2 class="section-title mb-3">Últimas publicações</h2>
          <div class="widget-body">
            <div class="widget-list">
			@foreach(latest_sidebar_posts($post->id) as $item)
              <a class="media align-items-center" href="{{route('read_post',['post_id'=>$item->id])}}">
                <img loading="lazy" decoding="async" src="/storage/images/post_images/{{$item->featured_image}}" alt="Post Thumbnail" class="w-100">
                <div class="media-body ml-3">
                  <h3 style="margin-top:-5px">{{($item->post_title)}}</h3>
                  <p class="mb-0 small">{!! Str::ucfirst(words($item->post_content,7)) !!}</p>

				  
                </div>
              </a>
            @endforeach

			



             
            </div>

			
          </div>



		  
        </div>
      </div>
      <div class="col-lg-12 col-md-6">
        <div class="widget">
          <h2 class="section-title mb-3">Categoria</h2>
          <div class="widget-body">
            <ul class="widget-list">
              <li><a href="#!">computador<span class="ml-auto">(3)</span></a>
              </li>
              <li><a href="#!">Eventos<span class="ml-auto">(2)</span></a>
              </li>
              <li><a href="#!">Destinatario<span class="ml-auto">(1)</span></a>
              </li>
              <li><a href="#!">internet<span class="ml-auto">(4)</span></a>
              </li>
              <li><a href="#!">Bloger<span class="ml-auto">(2)</span></a>
              </li>
              <li><a href="#!">Noticia<span class="ml-auto">(5)</span></a>
              </li>
              <li><a href="#!">Boa Vida<span class="ml-auto">(1)</span></a>
              </li>
              <li><a href="#!">Tipos<span class="ml-auto">(1)</span></a>
              </li>
              <li><a href="#!">Viagem<span class="ml-auto">(3)</span></a>
              </li>
              <li><a href="#!">website<span class="ml-auto">(4)</span></a>
              </li>
              <li><a href="#!">Eliseu<span class="ml-auto">(2)</span></a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
			</div>





















<!-- <div class="row">
				<div class="col-lg-8 mb-5 mb-lg-0">
					<article>
						<img loading="lazy" decoding="async" src="/storage/front/images/post_front/images/{{$post->featured_image}}" alt="Post Thumbnail" class="w-100">
						<ul class="post-meta mb-2 mt-4">
							<li>
								<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" style="margin-right:5px;margin-top:-4px" class="text-dark" viewBox="0 0 16 16">
									<path d="M5.5 10.5A.5.5 0 0 1 6 10h4a.5.5 0 0 1 0 1H6a.5.5 0 0 1-.5-.5z"></path>
									<path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM2 2a1 1 0 0 0-1 1v11a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1H2z"></path>
									<path d="M2.5 4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H3a.5.5 0 0 1-.5-.5V4z"></path>
								</svg> <span>{{date_formatter($post->created_at)}}</span>
							</li>
						</ul>
						<h1 class="my-3">{{($post->post_title)}}</h1>
						<ul class="post-meta mb-4">
							<li> <a href="{{route('categoria_posts',$post->subcategoria->slug)}}">{{$post->subcategoria->nome_subcategoria}}</a>
							</li>
						</ul>
						<div class="content text-left">
							<p>{!! $post->post_content!!}</p>

							
						</div>
					</article>

					
					
					
      <div class="col-lg-12 col-md-6">
        <div class="widget">
          <h2 class="section-title mb-3">Últimas publicações</h2>
          <div class="widget-body">
            <div class="widget-list">
              @foreach(latest_sidebar_posts($post->id) as $item)
              <a class="media align-items-center" href="{{route('read_post',['post_id'=>$item->id])}}">
                <img loading="lazy" decoding="async" src="/storage/front/images/post_front/images/{{$item->featured_image}}" alt="Post Thumbnail" class="w-100">
                <div class="media-body ml-3">
                  <h3 style="margin-top:-5px">{{($item->post_title)}}</h3>
                  <p class="mb-0 small">{!! Str::ucfirst(words($item->post_content,7)) !!}</p>
                </div>
              </a>
            @endforeach
            </div>
          </div>
        </div>
      </div>
  


                    @if(count($related_posts)>0)
					<div class="widget-list mt-5">
						<h2 class="mb-2">Publicação relacionado</h2>
						
                        @foreach($related_posts as $item)
              <a class="media align-items-center" href="{{route('read_post',['post_id'=>$item->id])}}">
                <img loading="lazy" decoding="async" src="/storage/front/images/post_front/images/{{$item->featured_image}}" alt="Post Thumbnail" class="w-100">
                <div class="media-body ml-3">
                  <h3 style="margin-top:-5px">{{($item->post_title)}}</h3>
                  <p class="mb-0 small">{!! Str::ucfirst(words($item->post_content,20)) !!}</p>
                </div> 
              </a>
             @endforeach
            </div>
			@endif
					
         
  </div>
</div>
</div>
 -->
@endsection


<!-- @push('scripts')

<script>

$("body").floatingSocialShare({
    buttons:[
		"facebook","linkedin","reddit","telegram","tumblr","twitter","viber","whatsapp"
	],
	text:"Enviar com:",
   url:"{{route('read_post',$post->post_slug)}}"

});

</script>



@endpush -->