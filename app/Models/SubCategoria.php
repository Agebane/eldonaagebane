<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategoria extends Model
{
    use HasFactory;
    protected $fillable=[
        'nome_subcategoria',
        'slug',
        'categoria_principal',
        'ordenando',
   
       ];

       public function categoriaprincipal(){
        // return $this->hasOne(Categoria::class,'id','categoria_principal');
        return $this->belongsTo(Categoria::class,'categoria_principal','id');
       }
    
    public function posts(){
        return $this->hasMany(Post::class, 'categoria_id','id');
    }

}
