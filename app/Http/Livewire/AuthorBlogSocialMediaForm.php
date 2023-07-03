<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\BlogSocialMedia;

class AuthorBlogSocialMediaForm extends Component
{

    public $blog_social_media;
    public $facebook_url, $instagram_url, $youtube_url,$linkedin_url;
    public function mount(){

        $this->blog_social_media=BlogSocialMedia::find(1);
        $this->facebook_url=$this->blog_social_media->bsm_facebook;
        $this->instagram_url=$this->blog_social_media->bsm_instagram;
        $this->youtube_url=$this->blog_social_media->bsm_youtube;
        $this->linkedin_url=$this->blog_social_media->bsm_linkedin;
    }
      public function updateBlogSocialMedia(){
        $this->validate([
            'facebook_url'=>'nullable|url',
            'instagram_url'=>'nullable|url',
            'youtube_url'=>'nullable|url',
            'linkedin_url'=>'nullable|url',
        ],[
        
     'facebook_url.url'=>'deve ser um link válido por exemplo (http://www.facebook.com)',
     'instagram_url.url'=>'deve ser um link válido por exemplo (http://www.instagram.com)',
     'youtube_url.url'=>'deve ser um link válido por exemplo (http://www.youtube.com)',
     'linkedin_url.url'=>'deve ser um link válido por exemplo (http://www.agebane.com)',

    ]);
     $update=$this->blog_social_media->update([
        'bsm_facebook'=>$this->facebook_url,
        'bsm_instagram'=>$this->instagram_url,
        'bsm_youtube'=>$this->youtube_url,
        'bsm_linkedin'=>$this->linkedin_url,

     ]);
      
     if($update){
        $this->showToastr('Link de rede social foi atualizado com sucesso .','success');
       }
       else{
        $this->showToastr('Alguma coisa esta errado.','error');
       }


      }

      public function showToastr($message,$type){
        return $this->dispatchBrowserEvent('showToastr',[
          'type'=>$type,
          'message'=>$message 
        ]);
      }




    public function render()
    {
        return view('livewire.author-blog-social-media-form');
    }
}
