<div>

@if(Session::get('success'))
<div class="alert alert-sucess">
    {{Session::get('success')}}
</div>
@endif

<form class="card card-md" method="get" wire:submit.prevent='ForgotHandler()'>
          <div class="card-body">
            <h2 class="card-title text-center mb-4">Esqueceu Palavra passe</h2>
            <p class="text-muted mb-4">Digite o seu endereço email e a sua palavra passe irá ser restaurado
              atravez do seu email.</p>
            <div class="mb-3">
              <label class="form-label">Endereço email</label>
              <input type="email" class="form-control" placeholder="Digite email" wire:model='email'>
              <span class="text-danger">@error('email') {{$message}} @enderror</span>
            </div>
            <div class="form-footer">
              <button class="btn btn-primary w-100" type="submit">
                <!-- Download SVG icon from http://tabler-icons.io/i/mail -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><rect x="3" y="5" width="18" height="14" rx="2"></rect><polyline points="3 7 12 13 21 7"></polyline></svg>
                Enviar link de reustauro de palavra-passe
              </button>
            </div>
          </div>
        </form>
</div>
