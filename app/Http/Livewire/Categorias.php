<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Categoria;
use App\Models\SubCategoria;
use Illuminate\Support\Str;
use App\Models\Post;


class Categorias extends Component
{
    public $nome_categoria;
    public $selected_categoria_id;
    public $updateCategoriaMode=false;

    public $nome_subcategoria;
    public $selected_subcategoria_id;
    public $categoria_principal=0;
    public $updateSubCategoriaMode=false;

    protected $listeners=[
        'resetModalForm',
        'deleteCategoriaAction',
        'deleteSubCategoriaAction',
        'updateCategoryOrdening',
        'updateSubCategoryOrdening'
    ];
     public function resetModalForm(){
        $this->resetErrorBag();
        $this->nome_categoria=null;
        $this->nome_subcategoria=null;
        $this->categoria_principal=null;
     }


    public function adicianarCategoria(){
        $this->validate([
            
            'nome_categoria'=>'required|unique:categorias,nome_categoria',
        ],[
            'nome_categoria.required'=>'O campo nome de categoria é obrigatório',
            'nome_categoria.unique'=>'Nome de categoria já existe utliza outro nome!',

        ]);
        $categoria= new categoria();
        $categoria->nome_categoria= $this->nome_categoria;
        $saved=$categoria->save();

        if($saved){

            $this->dispatchBrowserEvent('hideCategoriasModal');
            $this->nome_categoria=null;
             $this->showToastr('Nova categoria foi adicionado com sucesso.','success');
            
           }
           else{
            $this->showToastr('Alguma coisa esta errado.','error');
           }
    }

    public function editarCategoria($id){
        $categoria=categoria::findOrFail($id);
        $this->selected_categoria_id = $categoria->id;
        $this->nome_categoria=$categoria->nome_categoria;
        $this->updateCategoriaMode=true;
        $this->resetErrorBag();
        $this->dispatchBrowserEvent('showcategoriaModal');
    }
    
   public function atualizarCategoria(){
    $this->validate([
            
        'nome_categoria'=>'required|unique:categorias,nome_categoria,'.$this->selected_categoria_id,
    ],[
        'nome_categoria.required'=>'O campo nome de categoria é obrigatório',
        'nome_categoria.unique'=>'Nome de categoria já existe utliza outro nome!',

    ]);
    
    $categoria=categoria::findOrFail($this->selected_categoria_id);
    $categoria->nome_categoria=$this->nome_categoria;
     $updated=$categoria->save();

     if($updated){

        $this->dispatchBrowserEvent('hideCategoriasModal');
        $this->updateCategoriaMode=null;
         $this->showToastr('Categoria atualizado com sucesso.','success');
        
       }
       else{
        $this->showToastr('Alguma coisa esta errado.','error');
       }
   }

   public function  adicionarSubCategoria(){
    $this->validate([
     
         'categoria_principal'=>'required',
        'nome_subcategoria'=>'required|unique:sub_categorias,nome_subcategoria',
    ],[
        'categoria_principal.required'=>'O campo categoria principal é obrigatório',
        'nome_subcategoria.required'=>'O campo nome de categoria é obrigatório',
        'nome_subcategoria.unique'=>'Nome de categoria já existe utliza outro nome!',

    ]);

    
        $subcategoria= new Subcategoria();
        $subcategoria->nome_subcategoria= $this->nome_subcategoria;
        $subcategoria->slug=Str::slug($this->nome_subcategoria);
        $subcategoria->categoria_principal= $this->categoria_principal;
        $saved=$subcategoria->save();

        if($saved){

            $this->dispatchBrowserEvent('hideSubCategoriasModal');
            $this->categoria_principal=null;
            $this->nome_subcategoria=null;

             $this->showToastr('Nova Subcategoria foi adicionado com sucesso.','success');
            
           }
           else{
            $this->showToastr('Alguma coisa esta errado.','error');
           }
   }
     
   public function editarSubCategoria($id){
    $subcategoria=Subcategoria::findOrFail($id);
    $this->selected_subcategoria_id = $subcategoria->id;
    $this->categoria_principal= $subcategoria->categoria_principal;
    $this->nome_subcategoria=$subcategoria->nome_subcategoria;
    $this->updateSubCategoriaMode=true;
    $this->resetErrorBag();
    $this->dispatchBrowserEvent('showSubCategoriaModal');
}

public function atualizarSubCategoria(){
    if($this->selected_subcategoria_id){ 
    $this->validate([
        'categoria_principal'=>'required',
        'nome_subcategoria'=>'required|unique:sub_categorias,nome_subcategoria,'.$this->selected_subcategoria_id,
    ],[
        
        'nome_subcategoria.required'=>'O campo nome de subcategoria é obrigatório',
        'nome_subcategoria.unique'=>'Nome de categoria já existe utliza outro nome!',
    ]);

    $subcategoria=SubCategoria::findOrFail($this->selected_subcategoria_id);
    $subcategoria->nome_subcategoria= $this->nome_subcategoria;
    $subcategoria->slug=Str::slug($this->nome_subcategoria);
    $subcategoria->categoria_principal= $this->categoria_principal;
    $updated=$subcategoria->save();

     if($updated){

        $this->dispatchBrowserEvent('hideSubCategoriasModal');
        $this->updateSubCategoriaMode=null;
         $this->showToastr('Subcategoria atualizado com sucesso.','success');
        
       }
       else{
        $this->showToastr('Alguma coisa esta errado.','error');
       }

    }
   }
   public function deleteCategoria($id){
      $categoria=Categoria::find($id);
    $this->dispatchBrowserEvent('deleteCategoria',[
        'title'=>'Você tem certeza?',
        'html'=>'Que deseja apagar categoria <b>'.$categoria->nome_categoria.'</b>',
        'id'=>$id
    ]);
}

public function deleteCategoriaAction($id){
    $categoria=Categoria::where('id',$id)->first();
    $subcategoria=SubCategoria::where('categoria_principal',$categoria->id)->whereHas('posts')->with('posts')->get();
    if(!empty ($subcategoria) && count($subcategoria)>0){
        $totalPosts=0;
        foreach($subcategoria as $subcat){
     $totalPosts +=Post::where('categoria_id',$subcat->id)->get()->count();
      
        }
        $this->showToastr('Esta categoria tem ('.$totalPosts.') publicaçao, não pode ser apagado','error');
    }else{
        Subcategoria::where('categoria_principal',$categoria->id)->delete();
        $categoria->delete();
        $this->showToastr('Categoria apagado com sucesso','info');
    }
}


public function deleteSubCategoria($id){
    $subcategoria=SubCategoria::find($id);
  $this->dispatchBrowserEvent('deleteSubCategoria',[
      'title'=>'Você tem certeza?',
      'html'=>'Que deseja apagar Subcategoria <b>'.$subcategoria->nome_subcategoria.'</b>',
      'id'=>$id
  ]);
}

public function deleteSubCategoriaAction($id){
    $subcategoria=SubCategoria::where('id',$id)->first();
    $posts=Post::where('categoria_id',$subcategoria->id)->get()->toArray();

    if(!empty ($posts) && count($posts)>0){
        $this->showToastr('Esta categoria tem ('.count($posts).') publicaçao, não pode ser apagado','error');

    }else{
        $subcategoria->delete();
        $this->showToastr('Subcategoria apagado com sucesso','info');
    }
   
}

public function updateCategoryOrdening($positions){
    //dd($positions);
    foreach($positions as $position){
        $index=$position[0];
        $newPosition=$position[1];
        Categoria::where('id',$index)->update([
        'ordenando'=>$newPosition
        ]);
        $this->showToastr('Categoria ordenado com sucesso','success');
    }
}

public function updateSubCategoryOrdening($positions){
    //dd($positions);
    foreach($positions as $position){
        $index=$position[0];
        $newPosition=$position[1];
        SubCategoria::where('id',$index)->update([
        'ordenando'=>$newPosition
        ]);
        $this->showToastr('Subcategoria atulizado com sucesso','success');
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
        return view('livewire.categorias',[
        'categorias'=>categoria::orderBy('ordenando','asc')->get(), 
        'subcategorias'=>Subcategoria::orderBy('ordenando','asc')->get()


        ]);
    }
}
