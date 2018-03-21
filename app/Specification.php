<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Specification extends Model
{
    protected $fillable = [
       'id', 'specification','vendor_id'
    ];

    public function vendor(){
        return $this->hasOne('App\Vendor','id','vendor_id');    	
    }

    protected $table = 'specifications';
}
