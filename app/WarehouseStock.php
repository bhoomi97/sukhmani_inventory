<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WarehouseStock extends Model
{
	protected $fillable = [
       'id', 'specification_id', 'rate', 'qty', 'amount', 'comment', 'purchased_by', 'recieved_by'
    ];

    public function subcategory(){
        return $this->hasOne('App\SubCategory','id','subcategory_id');    	
    }
    
    public function user(){
        return $this->hasOne('App\User','id','user_id');    	
    }

    protected $table = 'warehouse_stock';
}
