@extends('back.layouts.pages-layout')
@section('pageTitle', isset($pageTitle) ?$pageTitle : 'Todas publicaão')
@section('content')

<div class="page-header d-print-none">
            <div class="row align-items-center">
              <div class="col">
                <h2 class="page-title">
                  Todas Publicação
                </h2>
              </div>
            </div>
          </div>
          @livewire('all-posts')

@endsection

@push('scripts')
<script>

window.addEventListener('deletePost', function(event){
    swal.fire({
      title:event.detail.title,
      imageWidth:48,
      imageHeight:48,
      html:event.detail.html,
      showCloseButton:true,
      showCancelButton:true,
      cancelButtonText:'Cancelar',
      confirmButtonText:'Sim, apagar',
      cancelButtonColor:'green',
      confirmButtonColor:'#d33',
      width:370,
      allowOutsideClick:false

    }).then(function(result){

        if(result.value){
            window.livewire.emit('deletePostAction',event.detail.id);
        }
    });

  });

    </script>
    @endpush