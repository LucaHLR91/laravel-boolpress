<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // COLLEGO TRAMITE METODO LA TABELLA PRINCIPALE ALLA SUBORDINATA
    protected $fillable = ['title', 'slug', 'category_id'];
    public function posts() {
        return $this->hasMany('App\Post');
    }
}
