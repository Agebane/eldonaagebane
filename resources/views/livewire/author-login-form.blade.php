<div>

@if(Session::get('fail'))
<div class="alert alert-danger">
 {{Session::get('fail')}}
</div>

@endif

@if(Session::get('success'))
<div class="alert alert-success">
 {{Session::get('success')}}
</div>
@endif

<form class="card card-md" wire:submit.prevent="LoginHandler()" action="." method="post" autocomplete="off">
          <div class="card-body">
            <h2 class="card-title text-center mb-4">Logar na sua conta</h2>
            <div class="mb-3">
              <label class="form-label">Digitar email ou nome</label>
              <input type="text" class="form-control" placeholder="Digite email ou nome" wire:model="login_id">
              @error('login_id')
               <span class="text-danger">{{$message}}</span>

              @enderror
            </div>
            <div class="mb-2">
              <label class="form-label">
                Palavra-passe
                <span class="form-label-description">
                  <a href="{{route('author.forgot-password')}}">Eu esqueci a minha palavra-passe</a>
                </span>
              </label>
              <div class="input-group input-group-flat">
                <input type="password" class="form-control" placeholder="Password" autocomplete="off" wire:model="password">
                <span class="input-group-text">
                  <a href="#" class="link-secondary" title="" data-bs-toggle="tooltip" data-bs-original-title="Show password"><!-- Download SVG icon from http://tabler-icons.io/i/eye -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><circle cx="12" cy="12" r="2"></circle><path d="M22 12c-2.667 4.667 -6 7 -10 7s-7.333 -2.333 -10 -7c2.667 -4.667 6 -7 10 -7s7.333 2.333 10 7"></path></svg>
                  </a>
                </span>      
              </div>
              @error('password')
               <span class="text-danger">{{$message}}</span>
              @enderror
            </div>
            <div class="mb-2">
              <label class="form-check">
                <input type="checkbox" class="form-check-input">
                <span class="form-check-label">Lembrar me disso</span>
              </label>
            </div>
            <div class="form-footer">
              <button type="submit" class="btn btn-primary w-100">Logar</button>
            </div>
          </div>
          
          </form>
</div>
