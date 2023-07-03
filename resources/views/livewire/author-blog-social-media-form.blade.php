<div>
<form method="post" wire:submit.prevent='updateBlogSocialMedia()'>
                        <div class="row">
                          <div class="col-md-6">
                          <div class="mb-3">
                            <label for="" class="form-label">Facebook</label>
                            <input type="text" class="form-control" placeholder="Url de pagina de Facebook" wire:model='facebook_url'>
                            <span class="text-danger">@error('facebook_url') {{ $message }} @enderror</span>
                          </div>
                          </div>
                          <div class="col-md-6">
                          <div class="mb-3">
                            <label for="" class="form-label">Instagram</label>
                            <input type="text" class="form-control" placeholder="Url de Instagram" wire:model='instagram_url'>
                            <span class="text-danger">@error('instagram_url') {{ $message }} @enderror</span>
                          </div>
                          </div>
                          <div class="col-md-6">
                          <div class="mb-3">
                            <label for="" class="form-label">Youtube</label>
                            <input type="text" class="form-control" placeholder="Url de canal de Youtube" wire:model='youtube_url'>
                            <span class="text-danger">@error('youtube_url') {{ $message }} @enderror</span>
                          </div>
                          </div>
                          <div class="col-md-6">
                          <div class="mb-3">
                            <label for="" class="form-label">LinkIn</label>
                            <input type="text" class="form-control" placeholder="Url de LinkIn" wire:model='linkedin_url'>
                            <span class="text-danger">@error('linkedin_url') {{ $message }} @enderror</span>
                          </div>
                          </div>

                        </div>
                        <button type="submit" class="btn btn-primary">Atualizar</button>
                       </form>
</div>
