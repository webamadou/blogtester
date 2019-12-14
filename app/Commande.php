<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    protected $guarded = [];

    public function products(){
        return $this->belongsToMany('App\Products','commande_products');
    }
}
