@extends('back.layouts.pages-layout')
@section('pageTitle', isset($pageTitle) ?$pageTitle : 'Categorias')
@section('content')

<div class="page-header d-print-none">
            <div class="row align-items-center">
              <div class="col">
                <h2 class="page-title">
                  Categorias & Subcategorias
                </h2>
              </div>
            </div>
          </div>

          @livewire('categorias')

@endsection

@push('scripts')
<script>
window.addEventListener('hideCategoriasModal',function(e){
    $('#categoria_modal').modal('hide');
});


window.addEventListener('showcategoriaModal',function(e){
    $('#categoria_modal').modal('show');
});

window.addEventListener('hideSubCategoriasModal',function(e){
    $('#subcategoria_modal').modal('hide');
});

window.addEventListener('showSubCategoriaModal',function(e){
    $('#subcategoria_modal').modal('show');
});

$('#categoria_modal,#subcategoria_modal').on('hidden.bs.modal', function(e){
  Livewire.emit('resetModalForm');


});
window.addEventListener('deleteCategoria', function(event){
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
            window.livewire.emit('deleteCategoriaAction',event.detail.id);
        }
    });

  });



  window.addEventListener('deleteSubCategoria', function(event){
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
            window.livewire.emit('deleteSubCategoriaAction',event.detail.id);
        }
    });

  });
$('table tbody#sortable_category').sortable({
    update:function(event, ui){
      $(this).children().each(function(index){
         if($(this).attr("data-ordering") !=(index+1)){
          $(this).attr("data-ordering",(index+1)).addClass("updated");
         } 
      });
       var positions = [];
      $(".updated").each(function(){
        positions.push([$(this).attr("data-index"),$(this).attr("data-ordering")]);
        $(this).removeClass("updated");
      });
      //alert(positions);
      window.livewire.emit("updateCategoryOrdening",positions);
    }
});


$('table tbody#sortable_subcategory').sortable({
    update:function(event, ui){
      $(this).children().each(function(index){
         if($(this).attr("data-ordering") !=(index+1)){
          $(this).attr("data-ordering",(index+1)).addClass("updated");
         } 
      });
       var positions = [];
      $(".updated").each(function(){
        positions.push([$(this).attr("data-index"),$(this).attr("data-ordering")]);
        $(this).removeClass("updated");
      });
      //alert(positions);
      window.livewire.emit("updateSubCategoryOrdening",positions);
    }
});

</script>
@endpush


