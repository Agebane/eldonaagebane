<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;

use Illuminate\Support\Facades\Hash;

class AuthorChangePasswordForm extends Component
{
    public $current_password,$new_password,$confirm_new_password;

    public function changePassword(){
        $this->validate([
            'current_password'=>[
             'required', function($attribute, $value, $fail){
              if(!Hash::check($value, User::find(auth('web')->id())->password)){
              return $fail(__('Palavra-passe atual está incorreto'));

              } 

             },   
            ],
            'new_password'=>'required|min:5|max:25',
             'confirm_new_password'=>'same:new_password'
        ],[

            'confirm_new_password.same'=>'A confirmação de palavra-passe deve ser igual a nova palavra-passe',
            'new_password.min'=>'Caráteres minimo deve ser 5', 
            'current_password.required'=>'Digite a sua palavra-passe atual',
            'new_password.required'=>'Digite a sua nova palavra-passe',
        ]);
       $query =User::find(auth('web')->id())->update([
        'password'=>Hash::make($this->new_password)  
       ]);

       if($query){
        $this->showToastr('A sua palavra-passe foi atualizado com sucesso.','success');
        $this->current_password= $this->new_password= $this->confirm_new_password=null;
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
        return view('livewire.author-change-password-form');
    }
}
