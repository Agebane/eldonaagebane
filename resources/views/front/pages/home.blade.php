
@extends('front.layouts.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle: 'Bem vindo')
@section('meta_tags')
  <meta name="robots" content="index,follow"/>
  <meta name="title" content="{{ blogInfo()->blog_name}}"/>


@section('content')


<div class="row no-gutters-lg">
        <div class="col-12">
          <h2 class="section-title">Últimas Publicações</h2>
        </div>
        <div class="col-lg-8 mb-5 mb-lg-0">
          <div class="row">
            <div class="col-12 mb-4">
              @if(single_latest_post())
              <article class="card article-card">
                <a href="{{route('read_post',['post_id'=>single_latest_post()->id])}}">
                  <div class="card-image">
                    <div class="post-info"> <span class="text-uppercase">{{date_formatter(single_latest_post()->created_at)}}</span>
                      <span class="text-uppercase">{{readDuration(single_latest_post()->post_title,single_latest_post()->post_content)}} @choice('min|mins',readDuration(single_latest_post()->post_title,single_latest_post()->post_content)) lido</span>
                    </div>
                    <img loading="lazy" decoding="async" src="/storage/images/post_images/{{single_latest_post()->featured_image}}" alt="Post Thumbnail" class="w-100">
                  </div>
                </a>
                <div class="card-body px-0 pb-1">
                  <h2 class="h1"><a class="post-title" href="{{route('read_post',['post_id'=>single_latest_post()->id])}}">{{(single_latest_post()->post_title)}}</a></h2>
                  <p class="card-text">{!! Str::ucfirst(words(single_latest_post()->post_content,20)) !!}</p>
                  <div class="content"> <a class="read-more-btn" href="{{route('read_post',['post_id'=>single_latest_post()->id])}}">Ler tudo</a>
                  </div>
                </div>
              </article>
              @endif
            </div>

            @foreach(latest_home_6post() as $item)

            <div class="col-md-6 mb-4">
              <article class="card article-card article-card-sm h-100">
                <a href="{{route('read_post',['post_id'=>$item->id])}}">
                  <div class="card-image">
                    <div class="post-info"> <span class="text-uppercase">{{date_formatter($item->created_at)}}</span>
                      <span class="text-uppercase">{{readDuration($item->post_title,$item->post_content)}}
                         @choice('min|mins',readDuration($item->post_title,$item->post_content)) lido</span>
                    </div>
                    <img loading="lazy" decoding="async" src="/storage/images/post_images/{{$item->featured_image}}" alt="Post Thumbnail" class="w-100">
                  </div>
                </a>
                <div class="card-body px-0 pb-0">
                  <h2><a class="post-title" href="{{route('read_post',['post_id'=>$item->id])}}">{{($item->post_title)}}</a></h2>
                  <p class="card-text">{!! Str::ucfirst(words($item->post_content,20)) !!}</p>
                  <div class="content"> <a class="read-more-btn" href="{{route('read_post',['post_id'=>$item->id])}}">Ler tudo</a>
                  </div>
                </div>
              </article>
            </div>
          
           @endforeach
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
      
        @if(recommended_post())
      <div class="col-lg-12 col-md-6">
        <div class="widget">
          <h2 class="section-title mb-3">Publicações</h2>
          <div class="widget-body">
            <div class="widget-list">
              @foreach(recommended_post() as $item)
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
      @endif
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
              
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
      </div>

@endsection


@push('scripts')

<script>

$("body").floatingSocialShare({
    buttons:[
		"facebook","linkedin","reddit","telegram","tumblr","twitter","viber","whatsapp"
	],
	text:"Enviar com:",
   url:"{{route('read_post',$item->post_slug)}}"

});

</script>



@endpush