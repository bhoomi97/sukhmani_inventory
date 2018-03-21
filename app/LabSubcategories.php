<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LabSubcategories extends Model
{
    protected $fillable = [
       'id', 'subcategory'
    ];

    protected $table = 'lab_subcategories';
}
