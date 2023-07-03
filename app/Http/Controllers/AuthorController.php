<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\File;
use App\Models\Setting;

use App\Models\Post;
use Illuminate\Support\Str;
use Storage;
use Image;






class AuthorController extends Controller
{
   
   public function index(Request $request){
    return view('back.pages.home');
     
   }
   
   public function logout(){
      Auth::guard('web')->logout();
      return redirect()->route('author.login');
   }

   public function ResetForm(Request $request,$token=null){
      $data=[
        'pageTitle'=>'Reset Password'
      ];
      return view('back.pages.auth.reset',$data)->with(['token'=>$token,'email'=>$request->email]);
      
   }

 public function changeProfilePicture(Request $request){
   $user =User::find(auth('web')->id());
   $path ='back/dist/img/authors/';
   $file=$request->file('file');
   $old_picture= $user->getAttributes()['picture'];
   $file_path = $path.$old_picture;
   $new_picture_name='AIMG'.$user->id.time().rand(1,100000).'.jpg';

   if($old_picture != null && File::exists(public_path($file_path))){
      File::delete(public_path($file_path));
   }
   $upload=$file->move(public_path($path), $new_picture_name);
   if($upload){
      $user->update([ 
      'picture'=>$new_picture_name

      ]);
      return response()->json(['status'=>1, 'msg'=>'A sua foto do perfil foi alterado com sucesso.']);

   }else{
      return response()->json(['status'=>0, 'Alguma coisa esta errado']);
   }
 }
public function changeBlogLogo(Request $request){
    $settings=Setting::find(1);
    $logo_path= 'back/dist/img/logo-favicon';
    $old_logo=$settings->getAttributes()['blog_logo'];
    $file=$request->file('blog_logo');
    $filename=time().'_'.rand(1,100000).'_larablog_logo.png';

    if($request->hasFile('blog_logo')){
     if($old_logo != null && File::exists(public_path($logo_path.$old_logo))){
       File::delete(public_path($logo_path.$old_logo));
     }
     $upload= $file->move(public_path($logo_path),$filename);
     if($upload){
      $settings->update([
         'blog_logo'=>$filename
      ]);
      return response()->json(['status'=>1,'msg'=>'Logo foi alterado com sucesso.']);

     }else{
      return response()->json(['status'=>0,'msg'=>'Alguma coisa esta errado']);
     }

    }
}

public function changeBlogFavicon(Request $request){
   $settings=Setting::find(1);
   $favicon_path= 'back/dist/img/logo-favicon';
   $old_favicon=$settings->getAttributes()['blog_favicon'];
   $file=$request->file('blog_favicon');
   $filename=time().'_'.rand(1,2000).'_larablog_favicon.ico';

   
    if($old_favicon != null && File::exists(public_path($favicon_path.$old_favicon))){
      File::delete(public_path($favicon_path.$old_favicon));
    }
    $upload= $file->move(public_path($favicon_path),$filename);
    if($upload){
     $settings->update([
        'blog_favicon'=>$filename
     ]);
     return response()->json(['status'=>1,'msg'=>'Icon foi alterado com sucesso.']);

    }else{
     return response()->json(['status'=>0,'msg'=>'Alguma coisa esta errado']);
    }

}

public function createPost(Request $request){
   $request->validate([
            
      'post_title'=>'required|unique:posts,post_title',
      'post_content'=>'required',
      'post_category'=>'required|exists:sub_categorias,id',
      'featured_image'=>'required|mimes:jpeg,jpg,png|max:2024',
   ],[
      'post_title.required'=>'O campo titúlo de publicação é obrigatório',
      'post_content.required'=>'O campo conteúdo de publicação é obrigatório',
      'post_category.required'=>'O campo categoria de publicação é obrigatório',
      'featured_image.required'=>'O campo  de imagem é obrigatório',
      'featured_image.max'=>'O tamanho da imagem não pode ser superior que 2MB',

      
   ]);

   if($request->hasFile('featured_image')){
      $file=$request->file('featured_image');
      $path="storage/images/post_images/";

      $filename=time().'_'.$file->getClientOriginalName();
      $img=Image::make($file->getRealPath());
      $upload=$img->save(public_path($path.$filename));


      if($upload){
         $post = new Post();
         $post->usuario_id=auth()->id();
         $post->categoria_id=$request->post_category;
         $post->post_title=$request->post_title;
        // $post->post_slug=Str::slug($request->post_title);
         $post->post_content=$request->post_content;
         $post->featured_image=$filename;
         $post->post_tags=$request->post_tags;
         $saved=$post->save();
         if($saved){
      return response()->json(['code'=>1, 'msg'=>'Nova publicação adicionado com sucesso.']); 
         }
         else{
            return response()->json(['code'=>3, 'msg'=>'Alguma coisa esta errado']);
         }
      }

      else{
         return response()->json(['code'=>3, 'msg'=>'Alguma coisa esta errado']); 
      }  

   }
}

public function editPost(Request $request){
   if(!request()->post_id){
      return abort(400);
   }else{
      $post=Post::find(request()->post_id);
      $data=[
         'post'=>$post,
         'pageTitle'=>'Editar publicação',
      ];
      return view('back.pages.edit_post',$data);

   }

}
public function updatePost(Request $request){
   if($request->hasFile('featured_image')){
      $request->validate([
         'post_title'=>'required|unique:posts,post_title,'.$request->post_id,
         'post_content'=>'required',
         'post_category'=>'required|exists:sub_categorias,id',
         'featured_image'=>'required|mimes:jpeg,jpg,png|max:2024',
      ],[
         'post_content.required'=>'O campo conteúdo de publicação é obrigatório',
         'post_category.required'=>'O campo categoria de publicação é obrigatório',
         'featured_image.required'=>'O campo  de imagem é obrigatório',
      'featured_image.max'=>'O tamanho da imagem não pode ser superior que 2MB',

      ]);
      
      $file=$request->file('featured_image');
      $path="storage/images/post_images/";
      $filename=time().'_'.$file->getClientOriginalName();
      $img=Image::make($file->getRealPath());
      $upload=$img->save(public_path($path.$filename));
          
      if($upload){
         $old_post_image=Post::find($request->post_id)->featured_image;
         
         if($old_post_image!=null && File::exists(public_path($path.$old_post_image))){
            File::delete(public_path($path.$old_post_image));

         }


       $post=Post::find($request->post_id);
      $post->categoria_id=$request->post_category;
      $post->post_title=$request->post_title;
      $post->post_slug=null;
      $post->post_content=$request->post_content;
      $post->featured_image=$filename;
      $post->post_tags=$request->post_tags;
      $saved=$post->save();
      if($saved){
         return response()->json(['code'=>1,'msg'=>'Publicação foi atualizado com sucesso.']);
   
        }else{
         return response()->json(['code'=>3, 'msg'=>'Alguma coisa esta errado']);
        }

      }else{
         return response()->json(['code'=>3, 'msg'=>'Alguma coisa esta errado']);
      }

   }else{
      $request->validate([
         'post_title'=>'required|unique:posts,post_title,'.$request->post_id,
         'post_content'=>'required',
         'post_category'=>'required|exists:sub_categorias,id',
      ],[
         'post_content.required'=>'O campo conteúdo de publicação é obrigatório',
         'post_category.required'=>'O campo categoria de publicação é obrigatório',

      ]);
      $post=Post::find($request->post_id);
      $post->categoria_id=$request->post_category;
      $post->post_slug=null;
      $post->post_content=$request->post_content;
      $post->post_title=$request->post_title;
      $post->post_tags=$request->post_tags;
      $saved=$post->save();
     if($saved){
      return response()->json(['code'=>1,'msg'=>'Publicação foi atualizado com sucesso.']);

     }else{
      return response()->json(['code'=>3, 'msg'=>'Alguma coisa esta errado']);
     }



   }

}

}
