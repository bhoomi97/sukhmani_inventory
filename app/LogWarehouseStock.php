<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LogWarehouseStock extends Model
{
	protected $fillable = [
       'id', 'subcategory_id', 'rate', 'qty', 'amount', 'comment'
    ];

    public function subcategory(){
        return $this->hasOne('App\SubCategory','id','subcategory_id');    	
    }
    
    public function user(){
        return $this->hasOne('App\User','id','user_id');    	
    }

    protected $table = 'logwarehouse_stock';
}
