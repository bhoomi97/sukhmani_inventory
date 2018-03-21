<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SiteStock extends Model
{
    protected $fillable = [
       'id', 'site_id', 'specification_id', 'rate', 'qty', 'amount', 'comment','user_id','date'
    ];

    public function specification(){
        return $this->hasOne('App\Specification','id','specification_id');    	
    }

    public function site(){
        return $this->hasOne('App\Site','id','site_id');    	
    }
    
    public function user(){
        return $this->hasOne('App\User','id','user_id');        
    }

    protected $table = 'site_stock';

}
