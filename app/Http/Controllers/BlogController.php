<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\SubCategoria;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    public function categoriaPost(Request $request, $slug){
        
       if(!$slug){
        return abort(404);
       }else{
        $subcategoria=SubCategoria::where('slug', $slug)->first();
        if(!$subcategoria){
            return abort(404);  
        }else{
            $posts=Post::where('categoria_id',$subcategoria->id)
                        ->orderBy('created_at','desc')
                        ->paginate(6);
     $data=[
          'pageTitle'=>'Categoria -'.$subcategoria->nome_subcategoria,
          'categoria'=>$subcategoria,
           'posts'=>$posts                        

           ];
           return view('front.pages.categoria_publicado',$data);            
        }
       }

    }

public function searchBlog(Request $request){
    $query=request()->query('query');
    if($query && strlen($query)>=2){
        $searchValues=preg_split('/\s+/',$query, -1, PREG_SPLIT_NO_EMPTY);
        $posts=Post::query();
        $posts->where(function($q) use ($searchValues){
            foreach($searchValues as $value){
             $q->orWhere('post_title','LIKE', "%{$value}%");   
             $q->orWhere('post_tags','LIKE', "%{$value}%");
            }
        });
        $posts=$posts->with('subcategoria')
                    ->with('author')
                    ->orderBy('created_at','desc')
                    ->paginate(6);
                    
       $data=[
        'pageTitle'=>'Pesquisar por :: '.request()->query('query'),
        'posts'=>$posts
       ];
       return view('front.pages.search_posts',$data);            

    }else{
        return abort(404,'Pagina não encontrado a pesquisa deve com mais do que uma letra'); 
    }

}

public function readPost(Request $request){
    if(!request()->post_id){
       return abort(400);
    }else{
       $post=Post::find(request()->post_id);
         $post_tags=array(',',$post->post_title);
         $related_posts = Post::where('id','!=',$post->id)
         ->where(function($query) use($post_tags,$post){
              foreach($post_tags as $item){
        $query->orWhere('post_title','LIKE',"%$item%");
        
        

              }
         })
            ->inRandomOrder()
            ->take(3)
            ->get();

       $data=[
          
          'pageTitle'=>Str::ucfirst($post->post_title),
          'post'=>$post,
          'related_posts'=>$related_posts
       ];
       return view('front.pages.single_post',$data); 
 
    }
 
 }
}
