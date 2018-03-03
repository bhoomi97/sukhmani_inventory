<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
	protected $fillable = [
       'id', 'site_name','status','user_id'
    ];

    public function createduser(){
        return $this->hasOne('App\User','id','created_user_id');    	
    }

    public function deleteduser(){
        return $this->hasOne('App\User','id','deleted_user_id');    	
    }

    protected $table = 'sites';
}
