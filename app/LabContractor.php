<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LabContractor extends Model
{
    protected $fillable = [
       'id', 'subcategory_id', 'contractor'
    ];

    protected $table = 'lab_contractor';
    
    public function subcategory(){
        return $this->hasOne('App\LabSubcategories','id','subcategory_id');    	
    }

}
