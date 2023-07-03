<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Nette\Utils\Random;
use Illuminate\Support\Facades\Mail;
use Livewire\WithPagination;
use Illuminate\Support\Facades\File;


class Usuarios extends Component
{

     use WithPagination;
    public $name, $email, $username, $author_type, $direct_publisher;
    public $search;
    public $perPage=4;
    public $selected_author_id;
    public $block = 0;
    
    protected $listeners=[
        'resetForms',
        'deleteAuthorAction'
    ];   
    public function mount(){
        $this->resetPage();
    }
    public function updatingSearch(){
        $this->resetPage();
    }  


    public function resetForms(){
        $this->name=$this->email=$this->username=$this->author_type=$this->direct_publisher = null;
        $this->resetErrorBag();
    }

    public function addUsuario(){
        $this->validate([

                'name'=>'required',
                'email'=>'required|email|unique:users,email',
                'username'=>'required|unique:users,username|min:6|max:20',
                'author_type'=>'required',
                'direct_publisher'=>'required',


            ],[
                'name.required'=>'Campo nome é obrigatório',
                'email.required'=>'Campo email é obrigatório',
                'email.unique'=>'Este email já existe deve usar outro',
                'username.unique'=>'Este nome de usuário já existe deve usar outro',
                'username.required'=>'Campo nome de usuário é obrigatório',
                'username.min'=>'Caráteres minimo deve ser 6',
                'username.max'=>'Caráteres maximo deve ser 20',
                'author_type.required'=>'Escolhe o tipo usuário',
                'direct_publisher.required'=>'Usuário específico para acesso',
        ]);
        if($this->isOnline()){
            
            $default_password='12345';

            $author=new User();
            $author->name=$this->name;
            $author->email=$this->email;
            $author->username=$this->username;
            $author->password=Hash::make($default_password);
            $author->type=$this->author_type;
            $author->direct_publish=$this->direct_publisher;
            $saved=$author->save();
            
            $data= array(
             'name'=>$this->name,
             'username'=>$this->username,
             'email'=>$this->email,
             'password'=>$default_password,
             'url'=>route('author.profile'),
            );
            $author_email=$this->email;
            $author_name=$this->name;
            if($saved){
               /*  Mail::send('new-author-email-template', $data, function($message) use ($author_email,$author_name){
                    $message->from('noreply@example.com','Eldona');
                    $message->to($author_email,$author_name)
                    ->subject('Criação de Conta');
                }); */
                $mail_body=view('new-author-email-template',$data)->render();
                $mailConfig= array(
                 'mail_from_email'=>env('EMAIL_FROM_ADDRESS'),
                 'mail_from_name'=>env('EMAIL_FROM_NAME'),
                 'mail_recipient_email'=>$author_email,
                 'mail_recipient_name'=>$author_name,
                 'mail_subject'=>'Criar conta',
                 'mail_body'=>$mail_body
                );
                sendMail($mailConfig);




                $this->showToastr('Novo usuário foi adicionado para site ','success');
                $this->name =$this->email= $this->username =$this->author_type= $this->direct_publisher=null;
                $this->dispatchBrowserEvent('hide_add_author_modal');


            }else{
                $this->showToastr('Alguma coisa está errado','error');
            }
            
    }else{
        $this->showToastr('Você está offline, verifica a sua conexão','error');
    }

    }
    
      public function editarUsuario($usuario){
       $this->selected_author_id =$usuario['id'];
       $this->name=$usuario['name'];
       $this->email=$usuario['email'];
       $this->username=$usuario['username'];
       $this->author_type=$usuario['type'];
       $this->direct_publisher=$usuario['direct_publish'];
       $this->block=$usuario['block'];
        $this->dispatchBrowserEvent('showEditAuthorModal');
        
      }

      public function  atualizarUsuario(){
        $this->validate([

                'name'=>'required',
                'email'=>'required|email|unique:users,email,'.$this->selected_author_id,
                'username'=>'required|min:6|max:20|unique:users,username,'.$this->selected_author_id,
                'author_type'=>'required',
                'direct_publisher'=>'required',

            ],[
                'name.required'=>'Campo nome é obrigatório',
                'email.required'=>'Campo email é obrigatório',
                'email.unique'=>'Este email já existe deve usar outro',
                'username.unique'=>'Este nome de usuário já existe deve usar outro',
                'username.required'=>'Campo nome de usuário é obrigatório',
                'username.min'=>'Caráteres minimo deve ser 6',
                'username.max'=>'Caráteres maximo deve ser 20',
                'author_type.required'=>'Escolhe o tipo usuário',
                'direct_publisher.required'=>'Usuário específico para acesso',
        ]);
          
        if($this->selected_author_id){
            $usuario=User::find($this->selected_author_id);
            $usuario->update([
             'name'=>$this->name,
             'email'=>$this->email,
             'username'=>$this->username,
             'type'=>$this->author_type,
             'block'=>$this->block,
             'direct_publish'=>$this->direct_publisher,
            ]);
            $this->showToastr('usuário atualizado com sucesso ','success');
            $this->dispatchBrowserEvent('hide_edit_author_modal');


        }
      }
         public function apagarUsuario($usuario){

          $this->dispatchBrowserEvent('apagarUsuario',[
           'title'=>'Você tem certeza?',
           'html'=>'Que deseja apagar usuário: <br><b>'.$usuario['name'].'</b>',
           'id'=>$usuario['id'],
         ]); 

      }

       public function deleteAuthorAction($id){
        $usuario=User::find($id);
        $pasta='back/dist/img/authors/';
        $foto_usuario = $usuario->getAttributes()['picture'];
        $toda_foto_usuario=$pasta.$foto_usuario;
        if($foto_usuario !=null || File::exists(public_path($toda_foto_usuario))){
            File::delete(public_path($toda_foto_usuario));
        }
        $usuario->delete();
        $this->showToastr('usuário apagado com sucesso','info');    
     } 
 
    public function showToastr($message,$type){
        return $this->dispatchBrowserEvent('showToastr',[
          'type'=>$type,
          'message'=>$message 
        ]);
      }
    
    public function isOnline($site="https://youtube.com/"){
        if(@fopen($site,"r")){
           return true;
        }else{
            return false; 
        }
    }



    public function render()
    {
        return view('livewire.usuarios',[
        'usuarios'=>User::search(trim($this->search))
        ->where('id','!=',auth()->id())->paginate($this->perPage),
    ]);
    }
}
