<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthorLoginForm extends Component
{

        public $login_id,$password;
        public $returnUrl;
        public function mount(){
            $this->returnUrl =request()->retornarUrl;
        }

        public function LoginHandler(){
           
         $fieldType= filter_var($this->login_id, FILTER_VALIDATE_EMAIL)?'email' : 'username';
            if($fieldType=='email'){
                $this->validate([
            'login_id'=>'required|email|exists:users,email',
                    'password'=>'required|min:5'
                   ],[
                    'login_id'=>'email ou nome de usuario é obrigatório',
                    'login_id.email'=>'Email Invalido',
                    'password.min'=>'Caráteres minimo deve ser 5', 
                    'login_id.exists'=>'Este email não esta registado',
                    'password.required'=>'palavra-passe é obrigatório',
            
               ]);

            }else{
                $this->validate([
            'login_id'=>'required|exists:users,username',
            'password'=>'required|min:5',
              
                ],[
                    'login_id.required'=>'email ou nome de usuario é obrigatório',
                    'login_id.exists'=>'Este usuario não esta registado no BD',
                    'password.required'=>'palavra-passe é obrigatório',
                ]);

            }

            $creds=array($fieldType=>$this->login_id, 'password'=>$this->password);
              if(Auth::guard('web')->attempt($creds)){
                $checkUser=User::where($fieldType,$this->login_id)->first();
                if($checkUser->blocked==1){
                 Auth::guard('web')->logout();  
                 return redirect()->route('author.login')->with('fail','Sua conta esta bloqueado.');
                }
                else{
                            // return redirect()->route('author.home');
                            if($this->returnUrl !=null){
                                return redirect()->to($this->returnUrl); 

                            }else{
                                redirect()->route('author.home'); 
                            }
                        }
            
                      }
                       else{
                        session()->flash('fail','email ou palavra-passe incorreto');
                      }
            
    
          

        //    $this->validate([
        //     'email'=>'required|email|exists:users,email',
        //     'password'=>'required|min:5'
        //    ],[
        //     'email.required'=>'Digite o seu email',
        //     'email.email'=>'Email Invalido',
        //     'email.exists'=>'Este email não esta registado no BD',
        //     'password.required'=>'palavra-passe é obrigatório'

        //    ]);

        //   $creds=array('email'=>$this->email, 'password'=>$this->password);
        //   if(Auth::guard('web')->attempt($creds)){
        //     $checkUser=User::where('email',$this->email)->first();
        //     if($checkUser->blocked==1){
        //      Auth::guard('web')->logout();  
        //      return redirect()->route('author.login')->with('fail','Sua conta esta bloqueado.');

        //     }else{
        //         return redirect()->route('author.home');
        //     }

        //   }
        //    else{
        //     session()->flash('fail','email ou palavra-passe incorreto');
        //   }

        }

    public function render()
    {
        return view('livewire.author-login-form');
    }
}
