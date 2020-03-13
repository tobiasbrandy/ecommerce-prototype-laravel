<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = [];

    public function product(){
      return $this->hasMany('App\Product');
    }

    public function parentCategory() {
      return $this->belongsTo("App\Category", "category_id");
    }

    public function childrenCategories() {
      return $this->hasMany("App\Category", "category_id");
    }
}
