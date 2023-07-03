@extends('back.layouts.pages-layout')
@section('pageTitle', isset($pageTitle) ?$pageTitle : 'Usuários')
@section('content')

@livewire('usuarios')

@endsection

@push('scripts')
<script>
    $(window).on('hidden.bs.modal', function(){
        Livewire.emit('resetForms');

    });
    
   window.addEventListener('hide_add_author_modal', function(event){
    $('#ad_usuario_modal').modal('hide');
   
});
window.addEventListener('showEditAuthorModal', function(event){
    $('#editar_usuario_modal').modal('show');
   
});

window.addEventListener('hide_edit_author_modal', function(event){
    $('#editar_usuario_modal').modal('hide');
   
});


window.addEventListener('apagarUsuario', function(event){
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
            Livewire.emit('deleteAuthorAction',event.detail.id);
        }
    });
   
});






</script>
@endpush
