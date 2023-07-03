<div>
    
<form method="POST" wire:submit.prevent='updateGeneralSettings()'>
    <div class="row">
 <div class="col-md-6">
 <div class="md-3">
 <label for="" class="form-label">Nome do Site</label>
 <input type="text" class="form-control" placeholder="Digite nome do site" wire:model='blog_name'>
 @error('blog_name')
 <span class="text-danger">{{$message}}</span>

 @enderror
 </div>
 <div class="md-3">
 <label for="" class="form-label">Email do Site</label>
 <input type="text" class="form-control" placeholder="Digite email do site" wire:model='blog_email'>
 @error('blog_email')
 <span class="text-danger">{{$message}}</span>

 @enderror
 </div>
 <div class="md-3">
 <label for="" class="form-label">Descriçaõ do Site</label>
 <textarea name="" class="form-control" id="" cols="3" rows="3" wire:model='blog_description'></textarea>
 @error('blog_description')
 <span class="text-danger">{{$message}}</span>

 @enderror
  </div>
  <br>
  <button class="btn btn-primary">Salvar Mudança</button>
                    
                    
 </div>

 </div>
</form>
</div>
