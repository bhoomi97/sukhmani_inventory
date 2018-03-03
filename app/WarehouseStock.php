<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WarehouseStock extends Model
{
	protected $fillable = [
       'id', 'subcategory_id', 'rate', 'qty', 'amount', 'comment'
    ];

    public function subcategory(){
        return $this->hasOne('App\SubCategory','id','subcategory_id');    	
    }
    
    protected $table = 'site_stock';
}
