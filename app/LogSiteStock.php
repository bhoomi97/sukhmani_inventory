<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LogSiteStock extends Model
{
    protected $fillable = [
       'id', 'site_id', 'subcategory_id', 'rate', 'qty', 'amount', 'comment','user_id','date'
    ];

    public function subcategory(){
        return $this->hasOne('App\SubCategory','id','subcategory_id');    	
    }

    public function site(){
        return $this->hasOne('App\Site','id','site_id');    	
    }
    
    public function user(){
        return $this->hasOne('App\User','id','user_id');    	
    }

    protected $table = 'logsite_stock';

}
