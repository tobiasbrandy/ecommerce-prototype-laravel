<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];

    public function user(){
      return $this->belongsTo('App\User');
    }

    public function category(){
      return $this->belongsTo('App\Category');
    }

    public function wishUsers(){
      return $this->belongsToMany('App\User', 'wishlist');
    }

    public function shopUsers(){
      return $this->belongsToMany('App\User', 'shoplist');
    }
}
