<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SiteStock extends Model
{
    protected $fillable = [
       'id', 'site_id', 'subcategory_id', 'rate', 'qty', 'amount', 'comment'
    ];

    public function subcategory(){
        return $this->hasOne('App\SubCategory','id','subcategory_id');    	
    }

    public function site(){
        return $this->hasOne('App\Site','id','site_id');    	
    }

    protected $table = 'site_stock';

}
