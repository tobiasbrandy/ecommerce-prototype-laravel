<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'lastName', 'email', 'password', 'avatarPath'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function products(){
      return $this->hasMany('App\Product');
    }

    public function wishProducts(){
      return $this->belongsToMany('App\Product', 'wishlist');
    }

    public function shopProducts(){
      return $this->belongsToMany('App\Product', 'shoplist');
    }
}
