<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Post extends Model
{
    use HasFactory;
    use Sluggable;
    protected $fillable=[
           'usuario_id',
           'categoria_id',
           'post_title',
           'post_slug',
          'post_content',
          'featured_image'
    ];

    public function sluggable(): array
    {
        return [
            'post_slug' => [
                'source' => 'pos_title'
            ]
        ];
    }
   public function scopeSearch($query,$term){
    $term="%$term%";
    $query->where(function($query) use ($term){
    $query->where('post_title','like',$term);   

    });
   }
    public function subcategoria(){
        return $this->belongsTo(Subcategoria::class, 'categoria_id','id');
    }
    public function author(){
        return $this->belongsTo(User::class, 'author_id','id');
    }

}
