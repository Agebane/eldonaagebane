<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    protected $fillable=[
        'nome_categoria',
        'ordenando',
   
       ];
     public function subcategorias(){
        return $this->hasMany(SubCategoria::class,'categoria_principal','id');
     }


}
