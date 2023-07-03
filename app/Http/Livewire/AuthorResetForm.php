<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str; 
use Illuminate\Support\random;

class AuthorResetForm extends Component
{

    public $email,$token,$new_password,$confirm_new_password;
    public function mount(){
        $this->email=request()->email;
        $this->token=request()->token;

    }

    public function ResetHandler(){
      $this->validate([
        'email'=>'required|email|exists:users,email',
        'new_password'=>'required|min:5',
      ],[
        'email.required'=>'O campo de email é obrigatório',
        'email.email'=>'Endereço email invalido',
        'email.exists'=>'Este email não está registado',
        'new_password.required'=>'Digite nova palavra-passe',
        'new_password.min'=>'Caráteres minimo deve ser 5', 
        'confirm_new_password'=>'Ambas campos devem ser iguais'      
      ]);

      $check_token = DB::table('password_resets')->where([
        'email'=>$this->email,
        'token'=>$this->token,
        ])->first();

        if(!$check_token){
          session()->flash('fail','invalido token');
        }
        else{
            User::where('email',$this->email)->update([
             'password'=>Hash::make($this->new_password)  
            ]);
            DB::table('password_resets')->where([
                'email'=>$this->email
            ])->delete();

            $success_token=Str::rondom(64);
            session()->flash('success','A sua palavra-passe foi atualizado com sucesso. Logar com o seu email e a sua palavra-passe');

            $this->redirectRoute('author.login',['tkn'=>$success_token,'UEmail'=>$this->email]);

        }

    }


    public function render()
    {
        return view('livewire.author-reset-form');
    }
}
