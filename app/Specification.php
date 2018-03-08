<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Specification extends Model
{
    protected $fillable = [
       'id', 'specification','subcategory_id'
    ];

    public function subcategory(){
        return $this->hasOne('App\SubCategory','id','subcategory_id');    	
    }

    protected $table = 'specifications';
}
