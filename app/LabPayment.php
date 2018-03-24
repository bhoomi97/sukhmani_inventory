<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LabPayment extends Model
{
    protected $fillable = [
       'id', 'contractor_id', 'amount', 'site_id','date','comment'
    ];

    protected $table = 'lab_payment';
    
    public function contractor(){
        return $this->hasOne('App\LabContractor','id','contractor_id');    	
    }

}
