<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    // METODO PER COLLEGARE I TAG AI POST
    public function posts() {
        return $this->belongsToMany('App\Post');
    }
}
