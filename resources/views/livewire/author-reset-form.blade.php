<div>
@if(Session::get('faild'))
  <div class="alert alert-danger">
      {!!Session::get('fail')!!}

  </div>

@endif

@if(Session::get('success'))
  <div class="alert alert-danger">
      {!!Session::get('success')!!}

  </div>

@endif


<form class="card card-md"  method="post" wire:submit.prevent='ResetHandler()' autocomplete="off">
          <div class="card-body">
            <h2 class="card-title text-center mb-4">Restaurar palavra-passe</h2>
            <div class="mb-3">
              <label class="form-label">Email</label>
              <input type="text" class="form-control" placeholder="Digite endereço email" wire:model='email' disabled>
              <span class="text-danger">@error('email') {{$message}} @enderror</span>
              
            </div>
            <div class="mb-2">
              <label class="form-label">
                Nova Palavra-passe
                
              </label>
              <div class="input-group input-group-flat">
                <input type="password" class="form-control" placeholder="Nova Palavra-passe" autocomplete="off" wire:model='new_password'>
                <span class="input-group-text">
                  <a href="#" class="link-secondary" title="" data-bs-toggle="tooltip" data-bs-original-title="Show password"><!-- Download SVG icon from http://tabler-icons.io/i/eye -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><circle cx="12" cy="12" r="2"></circle><path d="M22 12c-2.667 4.667 -6 7 -10 7s-7.333 -2.333 -10 -7c2.667 -4.667 6 -7 10 -7s7.333 2.333 10 7"></path></svg>
                  </a>
                </span>      
              </div>

              <span class="text-danger">@error('new_password') {{$message}} @enderror</span>
             
            </div>
            <div class="mb-2">
              <label class="form-label">
               Confirmar Palavra-passe
                
              </label>
              <div class="input-group input-group-flat">
                <input type="password" class="form-control" placeholder="Confirmar palavra-passe" autocomplete="off" wire:model='confirm_new_password'>
                <span class="input-group-text">
                  <a href="#" class="link-secondary" title="" data-bs-toggle="tooltip" data-bs-original-title="Show password"><!-- Download SVG icon from http://tabler-icons.io/i/eye -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><circle cx="12" cy="12" r="2"></circle><path d="M22 12c-2.667 4.667 -6 7 -10 7s-7.333 -2.333 -10 -7c2.667 -4.667 6 -7 10 -7s7.333 2.333 10 7"></path></svg>
                  </a>
                </span>      
              </div>
              <span class="text-danger">@error('confirm_new_password') {{$message}} @enderror</span>
             
            </div>
            <div class="mb-2">
              <label class="form-check">
               <a href="{{ route('author.login') }}}">Voltar para pagina de login</a>
              </label>
            </div>
            <div class="form-footer">
              <button type="submit" class="btn btn-primary w-100">Restaurar palavra-passe</button>
            </div>
          </div>
          
          </form>
</div>
