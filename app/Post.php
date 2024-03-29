<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function category() {
        return $this->belongsTo('App\Category');
    }
    protected $fillable = ['title', 'content', 'slug', 'category_id'];

    // METODO PER COLLEGARE POST AI TAG
    public function tags() {
        return $this->belongsToMany('App\Tag');
    }
}
