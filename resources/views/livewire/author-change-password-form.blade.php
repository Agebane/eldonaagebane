<div>
<form method="post" wire:submit.prevent='changePassword()'>
            <div class="row">
             <div class="col-md-4">
             <div class="mb-3">
              <label class="form-label">Palavra-passe Atual</label>
              <input type="password" class="form-control" name="example-text-input" placeholder="Palavra-passe Atual" wire:model='current_password'>
              <span class="text-danger">@error('current_password') {{ $message }} @enderror</span>
            </div>
             </div>
             <div class="col-md-4">
             <div class="mb-3">
              <label class="form-label">Nova Palavra-passe</label>
              <input type="password" class="form-control" name="example-text-input" placeholder="Nova Palavra-passe"  wire:model='new_password'>
              <span class="text-danger">@error('new_password') {{ $message }} @enderror</span>
               </div>
             </div>
             <div class="col-md-4">
             <div class="mb-3">
              <label class="form-label">Confirmar Palavra-passe</label>
              <input type="password" class="form-control" name="example-text-input" placeholder="Confirmar Palavra-passe" wire:model='confirm_new_password'>
              <span class="text-danger">@error('confirm_new_password') {{ $message }} @enderror</span>
               </div>
             </div>

            </div>
            <button type="submit" class="btn btn-primary">Mudar Palavra-passe</button>
          </form>
</div>
