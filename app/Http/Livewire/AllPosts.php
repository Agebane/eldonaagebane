<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Post;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class AllPosts extends Component
{
    use WithPagination; 
    public $perPage =10;
    public $pesquisar=null;
    public $usuario=null;
    public $categoria=null;
    public $ordenar='desc';

    protected $listeners=[
        'deletePostAction'
    ];

    public function mount(){
        $this->resetPage();
    }

    public function atualizarPesquisa(){
        $this->resetPage();
    }
    public function atualizarCategoria(){
        $this->resetPage();
    }
    public function atualizarUsuario(){
        $this->resetPage();
    }

    public function deletePost($id){
        $this->dispatchBrowserEvent('deletePost',[
            'title'=>'Você tem certeza?',
            'html'=>'Que deseja apagar esta publicação.',
            'id'=>$id
        ]);
    }
    public function deletePostAction($id){
        $post=Post::find($id);
        $path="storage/images/post_images/";
        $featured_image=$post->featured_image;


        if($featured_image != null && File::exists(public_path($path.$featured_image))){
            File::delete(public_path($path.$featured_image));
          }
     $delete_post=$post->delete();
     if( $delete_post){ 
     $this->showToastr('Publicação apagado com sucesso','success');   
    }else{
        $this->showToastr('Alguma coisa está errado','error'); 
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
        return view('livewire.all-posts'
        ,[
            'posts'=>auth()->user()->type==1 ?
            Post::search(trim($this->pesquisar))
            ->when($this->categoria, function($query){
                $query->where('categoria_id',$this->categoria);
            })
            ->when($this->usuario, function($query){
                $query->where('usuario_id',$this->usuario);
            })

            ->when($this->ordenar, function($query){
                $query->orderBy('id',$this->ordenar);
            })


             ->paginate($this->perPage):
             Post::search(trim($this->pesquisar))
             ->when($this->categoria, function($query){
                $query->where('categoria_id',$this->categoria);
            })


              ->where('usuario_id',auth()->id())
              ->when($this->ordenar, function($query){
                $query->orderBy('id',$this->ordenar);
            })
              ->paginate($this->perPage)
    ]);
    }
}
