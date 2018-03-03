<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    protected $fillable = [
       'id', 'subcategory','category_id'
    ];

    public function category(){
        return $this->hasOne('App\Category','id','category_id');    	
    }

    protected $table = 'subcategories';
}
