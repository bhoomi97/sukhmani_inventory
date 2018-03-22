<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LabContractor extends Model
{
    protected $fillable = [
       'id', 'subcategory_id', 'contractor'
    ];

    protected $table = 'lab_contractor';
}
